<?php
class SystemClass
{

  public $dbHost, $dbName, $dbUser, $dbPass;
  public $dbConnection;

  public function database()
  {
    $this->dbConnection = mysql_connect($this->dbHost, $this->dbUser, $this->dbPass) or die(mysql_error());
		mysql_select_db($this->dbName) or die(mysql_error());
    mysql_query("SET NAMES 'utf8'");
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

  public function details($id)
  {
    $this->database();
    if(is_numeric($id) && $id > 0 && $id < 255)
    {
      if(mysql_num_rows(mysql_query("SELECT * FROM teachers WHERE id=$id")))
      {
        $query = mysql_query("SELECT * FROM teachers WHERE id=$id");
        while ($data = mysql_fetch_assoc($query))
        {
            echo '<div class="scriptdetail">
                <div class="images"><img src="'.$data['picture'].'"></div>
                <div class="meta">
                  <div class="entry"><div class="title">Nom:</div> '.$data['sexe'].' '.$data['name'].' '.$data['surname'].'</div>
                  <div class="entry"><div class="title">Matière:</div> '.$data['role'].'</div>
                  <div class="entry"><div class="title">Note: </div>
                    <div class="simpleRatings">
                      <form method="post" action="#" class="starsmediumgreen" style="width:100px; height:20px">
                        <fieldset>
                          <input type="hidden" name="uniqueRateID" value="1" />
                          <input type="hidden" name="ratedJS" value="0" />
                          <input type="submit" name="rated" value="1" style="width:20%; z-index:5" />
                          <input type="submit" name="rated" value="2" style="width:40%; z-index:4" />
                          <input type="submit" name="rated" value="3" style="width:60%; z-index:3" />
                          <input type="submit" name="rated" value="4" style="width:80%; z-index:2" />
                          <input type="submit" name="rated" value="5" style="width:100%; z-index:1" />
                        </fieldset>
                        <div class="average" style="width:65%"></div>
                      </form>
                    </div>
                  </div>
                  <div class="entry"><div class="title">Stats: </div> '.$data['vote'].' Votes</div>
                </div>
                <div class="description">
                  '.$data['details'].'
                </div>
              </div>';
        }
      }
    }
  }
}
?>