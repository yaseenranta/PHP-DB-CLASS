#PHP DB class use demo
First initialize YR_database class <br>
$db = new YR_database(); <br>
Then set Attributes using $db->setAttribute() Method <br>
$db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION); <br>
$db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC); <br>

