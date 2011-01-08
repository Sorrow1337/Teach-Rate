<?php
class SystemClass
{

  public $dbHost, $dbName, $dbUser, $dbPass;
  public $dbConnection;
  public $average, $id, $vote;
  public $size, $color;

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

  public function data($id)
  {
		$query = mysql_query("SELECT * FROM teachers WHERE id=$id");
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

  public function details($id)
  {
    $this->database();
    if(is_numeric($id) && $id > 0 && $id < 255)
    {
      $this->data($id);
      if(mysql_num_rows(mysql_query("SELECT * FROM teachers WHERE id=$id LIMIT 0,1")))
      {
        $query = mysql_query("SELECT * FROM teachers WHERE id=$id");
        while ($data = mysql_fetch_assoc($query))
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

        echo '<div class="scriptdetail">
            <div class="images"><img src="'.$data['picture'].'"></div>
            <div class="meta">
              <div class="entry"><div class="title">Nom:</div> '.$data['sexe'].' '.$data['name'].' '.$data['surname'].'</div>
              <div class="entry"><div class="title">Matière:</div> '.$data['role'].'</div>
              <div class="entry"><div class="title">Note: </div>
                <div class="simpleRatings">
                  <form method="post" action="?page=submit" class="'.$styleClass.'" style="width:'.$totalWidth.'px; height:'.$imageHeight.'px">
                    <fieldset>
                      <input type="hidden" name="id" value="'.$id.'" />
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
      }
    }
    $this->close();
    header("Location: ?page=home&id=$id");
  }
}
?>