<?php
class SystemClass
{

  public $dbHost, $dbName, $dbUser, $dbPass;
  public $dbConnection;

  public function database()
  {
    $this->dbConnection = new PDO('mysql:host='.$this->dbHost.';dbname='.$this->dbName,$this->dbUser,$this->dbPass);
    $this->dbConnection->exec('SET NAMES utf8');
  }

  public function tableCheck()
  {
    $row = $this->dbConnection->query("SHOW TABLES LIKE 'ratinItems'");
    if($row->rowCount())
    {
      // Nothing beacaus table already exist
    }
    else
    {
      $this->dbConnection->query("CREATE TABLE ratinItems (
      id INT UNSIGNED NULL AUTO_INCREMENT PRIMARY KEY ,
      uniqueName VARCHAR(50) NOT NULL ,
      totalVotes INT UNSIGNED DEFAULT '0' NOT NULL ,
      totalPoints INT UNSIGNED DEFAULT '0' NOT NULL ,
      UNIQUE (uniqueName)
      ) ENGINE = MYISAM;");
    }
  }
}
?>