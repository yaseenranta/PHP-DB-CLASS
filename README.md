### First initialize Database class ###
    $db = new YR_database("localhost","testing","root","");
### Then set Attributes using $db->setAttribute() Method ###
    $db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);

### SELECT QUERY ###
    $result = $db
                ->select("column1,column2,column3")
                ->from("tablename")
                ->results();

### where clause ###
    $result = $db
        ->select("column1,column2,column3")
        ->from("tablename")
        ->where('column_name','value') 
        ->results();

### GET TABLE RECORD ###
    $result = $db
                ->get('tablename')
                ->results();

### GET ONE RECORD OF TABLE ###
    $db->getOne('tablename')
    $result = $db->results();

### INSERT RECORD ###
    $columnvalarray = [
        'username' => 'demouser',
        'description' => 'demo user description'
    ];
    $db->insert($columnvalarray,'tablename');

## UPDATE RECORD ###
    $columnvalarray = [
        'username' => 'demoupdated',
        'description' => 'demo user updated description'
    ];
    $db
        ->update($columnvalarray,'tablename')
        ->where('id',1);

### DELETE RECORD ###
$columnvalarray = [
	'username' => 'demoupdated',
	'description' => 'demo user updated description'
];

$db->delete('tablename');

$db->where('id',1);

### More Method will be add soon........... ###