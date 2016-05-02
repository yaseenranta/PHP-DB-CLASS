#PHP DB class use demo
First initialize YR_database class <br>
$db = new YR_database(); <br>
Then set Attributes using $db->setAttribute() Method <br>
$db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION); <br>
$db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC); <br>

#SELECT QUERY
$db->select("column1,column2,column3");

$db->from("tablename");

$result = $db->results();

#where clause 
$db->select("column1,column2,column3");

$db->from("tablename");

$db->where('column_name','value');

$result = $db->results();

#GET TABLE RECORD
$db->get('tablename');

$result = $db->results();

#GET ONE RECORD OF TABLE
$db->getOne('tablename');

$result = $db->results();

#INSERT RECORD
$columnvalarray = [
	'username' => 'demouser',
	'description' => 'demo user description'
];

$db->insert($columnvalarray,'tablename');

#update RECORD
$columnvalarray = [
	'username' => 'demoupdated',
	'description' => 'demo user updated description'
];

$db->update($columnvalarray,'tablename');

$db->where('id',1);

#Delete RECORD
$columnvalarray = [
	'username' => 'demoupdated',
	'description' => 'demo user updated description'
];

$db->delete('tablename');

$db->where('id',1);

#More Method will be add soon........... 