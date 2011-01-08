<?php
class SystemClass
{

  public $dbHost, $dbName, $dbUser, $dbPass;
  public $dbConnection;
  public $average, $id, $vote, $cookieUnblock, $ipUnblock;
  public $size, $color;
  public $page;

  public function database()
  {
    $this->dbConnection = mysql_connect($this->dbHost, $this->dbUser, $this->dbPass) or die(mysql_error());
    mysql_select_db($this->dbName) or die(mysql_error());
    mysql_query("SET NAMES 'utf8'");
  }

  public function close()
  {
		mysql_close($this->dbConnection);
	}

  public function tableCheck()
  {
    if(mysql_num_rows(mysql_query("SHOW TABLES LIKE 'ratinItems'")))
    {
      // Nothing beacaus table already exist
    }
    else
    {
      mysql_query("CREATE TABLE ratinItems (
      id INT UNSIGNED NULL AUTO_INCREMENT PRIMARY KEY ,
      uniqueName VARCHAR(50) NOT NULL ,
      totalVotes INT UNSIGNED DEFAULT '0' NOT NULL ,
      totalPoints INT UNSIGNED DEFAULT '0' NOT NULL ,
      UNIQUE (uniqueName)
      ) ENGINE = MYISAM;");
    }
  }

  public function cookieCheck($id)
  {
    if(isset($_COOKIE['rate']))
    {
      $this->cookieUnblock = TRUE;
      $cookieArray = explode(".",$_COOKIE['rate']);
      $cookieArrayCount = count($cookieArray);
      for($i = 0; $i < $cookieArrayCount; $i++)
      {
        if($cookieArray[$i] == $id)
        {
          $this->cookieUnblock = FALSE;
          break;
        }
      }
    }
    else
    {
      $this->cookieUnblock = TRUE;
    }
  }

  public function ipCheck($id)
  {
    if(mysql_num_rows(mysql_query("SELECT * FROM ipcheck WHERE ip='".$_SERVER['REMOTE_ADDR']."' AND idBlock=$id LIMIT 0,1")))
    {
      $this->ipUnblock = FALSE;
    }
    else
    {
      $this->ipUnblock = TRUE;
    }
  }

  public function data($id = NULL)
  {
    if(isset($id) && $id != ''){ $this->id = $id; }
    $query = mysql_query("SELECT * FROM teachers WHERE id=$this->id");
    $data = mysql_fetch_array($query);
    if($data['votes'] == 0)
    {
      $this->average=0; $this->vote=0; $this->decAVG=0;
    }
    else
    {
      $average = $data['votes']*5;
      $average = $data['points']/$average;
      $this->average = round($average*100);
      $this->vote = $data['votes'];
    }
	}

  public function details()
  {
    $this->database();
    if(is_numeric($this->id) && $this->id > 0 && $this->id < 255)
    {
      $this->data();
      if(mysql_num_rows(mysql_query("SELECT * FROM teachers WHERE id=$this->id LIMIT 0,1")))
      {
        switch ($this->size)
        {
			    case "small":
            $imageWidth = 16; $imageHeight = 16;
            break;
			    case "medium":
            $imageWidth = 20; $imageHeight = 20;
            break;
			    case "large":
            $imageWidth = 24; $imageHeight = 24;
            break;
          default:
            die("SimpleRatings: Not a valid size, please check spelling");
            break;
        }
        $styleClass = 'stars'.$this->size.$this->color;
        $totalWidth = $imageWidth * 5;

        $query = mysql_query("SELECT * FROM teachers WHERE id=$this->id");
        while ($data = mysql_fetch_assoc($query))
        {
          echo '<div class="scriptdetail">
          <div class="images"><img src="'.$data['picture'].'"></div>
          <div class="meta">
            <div class="entry"><div class="title">Nom:</div> '.$data['sexe'].' '.$data['name'].' '.$data['surname'].'</div>
            <div class="entry"><div class="title">Matière:</div> '.$data['role'].'</div>
            <div class="entry"><div class="title">Note: </div>
              <div class="simpleRatings">
                <form method="post" action="?page=submit" class="'.$styleClass.'" style="width:'.$totalWidth.'px; height:'.$imageHeight.'px">
                  <fieldset>
                    <input type="hidden" name="id" value="'.$this->id.'" />
                    <input type="submit" name="rated" value="1" style="width:20%; z-index:5" />
                    <input type="submit" name="rated" value="2" style="width:40%; z-index:4" />
                    <input type="submit" name="rated" value="3" style="width:60%; z-index:3" />
                    <input type="submit" name="rated" value="4" style="width:80%; z-index:2" />
                    <input type="submit" name="rated" value="5" style="width:100%; z-index:1" />
                  </fieldset>
                  <div class="average" style="width:'.$this->average.'%"></div>
                </form>
              </div>
            </div>
            <div class="entry"><div class="title">Stats: </div> '.$this->vote.' Votes</div>
          </div>
          <div class="description">
            '.$data['details'].'
          </div>
          </div>';
        }
      }
    }
    $this->close();
  }

  public function submit($point,$id)
  {
    $this->database();
    $this->cookieCheck($id);
    $this->ipCheck($id);

    if($this->cookieUnblock && $this->ipUnblock)
    {
      if(is_numeric($point) && $point > 0 && $point < 6 && is_numeric($id) && $id > 0 && $id < 255)
      {
        if(mysql_num_rows(mysql_query("SELECT * FROM teachers WHERE id=$id LIMIT 0,1")))
        {
          if(isset($_COOKIE["rate"]) && $_COOKIE["rate"] != '')
          {
            $cookieData = $_COOKIE['rate'].'.'.$id;
          }
          else
          {
            $cookieData = $id;
          }
          $cookieExpire = time()+60*60*24*365;
          $cookieDomain = str_replace("www.",".",$this->website);
          setcookie("rate", $cookieData, $cookieExpire, "/", $cookieDomain);
          mysql_query("UPDATE teachers SET votes = votes + 1, points = points + $point WHERE id=$id");
          mysql_query("INSERT INTO ipcheck (ip,idBlock) VALUES ('".$_SERVER['REMOTE_ADDR']."',$id)");
        }
      }
      $this->close();
    }
    header("Location: ?page=details&id=$id");
  }

  public function menu()
  {
    switch($this->page)
    {
      case 'home':
        echo '<div class="tabs">
          <ul>
            <li class="active"><a href="?page=home"><img src="images/teach.png" /> Liste</a></li>
            <li><a href="?page=admin"><img src="images/settings.png" /> Admin</a></li>
          </ul>
        </div>';
        break;
      case 'details':
        echo '<div class="tabs">
          <ul>
            <li><a href="?page=home"><img src="images/teach.png" /> Liste</a></li>
            <li class="active"><a href="?page=details&id='.$this->id.'"><img src="images/details.png" /> Details</a></li>
            <li><a href="?page=comments&id='.$this->id.'"><img src="images/comment.png" /> 1 Commentaire(s)</a></li>
            <li><a href="?page=admin"><img src="images/settings.png" /> Admin</a></li>
          </ul>
        </div>';
        break;
      case 'comments':
        echo '<div class="tabs">
          <ul>
            <li><a href="?page=home"><img src="images/teach.png" /> Liste</a></li>
            <li><a href="?page=details&id='.$this->id.'"><img src="images/details.png" /> Details</a></li>
            <li class="active"><a href="?page=comments&id='.$this->id.'"><img src="images/comment.png" /> 1 Commentaire(s)</a></li>
            <li><a href="?page=admin"><img src="images/settings.png" /> Admin</a></li>
          </ul>
        </div>';
        break;
      case 'admin':
        echo '<div class="tabs">
          <ul>
            <li class="active"><a href="?page="><img src="images/details.png" /> Profs</a></li>
            <li><a href="?page="><img src="images/comment.png" /> Commentaires</a></li>
            <li><a href="?page="><img src="images/settings.png" /> Options</a></li>
          </ul>
        </div>';
        break;
      default:
        echo '<div class="tabs">
          <ul>
            <li class="active"><a href="?page=home"><img src="images/teach.png" /> Liste</a></li>
            <li><a href="?page=admin"><img src="images/settings.png" /> Admin</a></li>
          </ul>
        </div>';
        break;
    }
  }

  public function liste()
  {
    $this->database();

    if(mysql_num_rows(mysql_query("SELECT * FROM teachers LIMIT 0,1")))
    {
      $query = mysql_query("SELECT * FROM teachers");
      while ($data = mysql_fetch_assoc($query))
      {
        $this->data($data['id']);
        echo '<tr align="center">
            <td>'.$data['sexe'].' '.$data['name'].' '.$data['surname'].'</td>
            <td>'.$data['role'].'</td>
            <td>
              <div class="simpleRatings">
                <form method="post" action="#" class="stars'.$this->size.$this->color.'" style="width:100px; height:20px">
                  <div class="average" style="width:'.$this->average.'%"></div>
                </form>
              </div>
            </td>
            <td>'.$data['votes'].'</td>
            <td><a href="?page=details&id='.$data['id'].'"><img src="images/zoom.png" /></a></td>
          </tr>';
      }
    }
    else
    {
      echo 'Aucun professeurs';
    }
    
    $this->close();
  }
}
?>