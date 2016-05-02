#PHP DB class use demo
First initialize YR_database class
$db = new YR_database();
Then set Attributes using $db->setAttribute() Method
$db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
$db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);

