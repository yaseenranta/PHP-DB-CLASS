<?php
/** Author : Muhammad Yaseen Ranta | Email : yaseenranta76@gmail.com **/
class YR_database
{

	private $host;
	private $dbname;
	private $username;
	private $password;
	private $query;
	private $setAttribute;
	public $HoldResults = true;
	private $where;
	private $limit;
	private $select;
	private $colum_name;
	private $colum_value;
	
	
	function __construct($host,$dbname,$username,$password){
	
		//$config =  config\get_config();
		$this->host = $host;
		$this->dbname = $dbname;
		$this->username = $username;
		$this->password = $password;
		$this->connection();
	}
	
	/** Database connection method **/
	private function connection()
	{
		try
		{
			return new \PDO("mysql:host=$this->host;dbname=$this->dbname;",$this->username,$this->password);
		}catch(PDOException $e)
		{
			die('Database not connect...'.$e->getMessage());	
		}	
	}
	/**
		BuildQuery() method build insert,update,delete and where clause query
	**/
	private function BuildQuery()
	{	
		$connection = $this->connection();
		
		$SetAttribute = $this->setAttribute;
		foreach($SetAttribute as  $AttributeKey => $AttributeValue)
		{
			$connection->setAttribute($AttributeKey,$AttributeValue);
		}
		$query  = $this->query;
		//$where = $this->where;
		
		$qw = '';
 		if(!empty($this->where)){
				$query .= " where ";
			foreach($this->where as $wk => $wv){
				$qw .= "$wk = :$wk AND ";	
			}
			$query .= $qw;
			
			$query = rtrim($query, ' ');
			$query = rtrim($query, 'AND');
			$query = rtrim($query, ' ');
			
		}
		if($this->limit != '') { $query .= $this->limit; }
			
		$q = $connection->prepare($query);

		if(!empty($this->where)){				
			foreach($this->where as $wk => &$wv){
				$q->bindParam(":$wk",$wv);
			}
		}
	
		if(!empty($this->bindParam)){			
			foreach($this->bindParam as $ck => &$cv){
				//echo ":$ck";
				$q->bindParam(":$ck",$cv);
			}
		}
		//var_dump($q);
		$q->execute();
		
		if($this->HoldResults != false){
			$this->HoldResults = $q->fetchall();
		}
	}
	
	/**
		param $key, $value
		set pdo attribute
	**/
	public function setAttribute($key,$value)
	{
		$this->setAttribute[$key] = $value;		
	}
	
	/** 
		Param $query
		Run Custom Query
	**/
	
	public function query($query)
	{
		$this->query = $query;
		$this->BuildQuery();
	}	
	
	public function select($column_name){
		$this->select  = "select $column_name ";
	}
	
	public function from($tablename){
		
		$this->query = $this->select."from $tablename";
		$this->BuildQuery();
	}
	
	/**
		param $key,$value
		set $where array key and value
	**/	
	public function where($key,$value = '')
	{
		if(is_array($key)){
			foreach($key as $k => $v){
				$this->where[$k] = $v;
			}			
		}else{
		    	$this->where[$key] = $value;
		}
	}
	/**
		param $start,$end.1 parameter is require and 2 is optional
		return string $limit variable 
	**/
	public function limit($start,$end = '')
	{
		if(!empty($start) && $end ==''){
			$this->limit = " LIMIT $start";
		}elseif(!empty($start) && !empty($end)){
			$this->limit = " LIMIT $start,$end";
		}else{
			$this->limit = "";
		}
			return $this->limit;	
	}
	
	/**
		param : no paramter pass in results method 
		return: result of query in the form of associative array 
	**/
	public function results()
	{
	//	$this->BuildQuery();
		return $this->HoldResults;
	}
	/**
		param : $tablename. pass name of table
		return all result of current table
	**/
	public function get($tablename)
	{
		$this->query = "select * from $tablename";
		//$this->HoldResults = true;
		$this->BuildQuery();
	}
	
	/**
		param : $tablename. pass name of table
		return one result of current table
	**/
	public function getOne($tablename)
	{
		$this->limit(1);
		$this->get($tablename);
		
//		$this->BuildQuery();
	}
	
	public function insert($colum_name,$tablename){
		$col_name = '';
		$col_val = '';
		foreach($colum_name as $ckey => $cvalue) {
				$col_name .= $ckey .', ';
				$col_val .= ':'.$ckey .', ';
		}
		
		$this->colum_name = trim($col_name,', ');
		$this->colum_value = trim($col_val,', ');	
		$this->query = "insert into $tablename ($this->colum_name) values ($this->colum_value)";
		$this->bindParam = $colum_name;
		$this->HoldResults = false;	
		$this->BuildQuery();
		
	}
	
	public function update($col_name,$tablename){
		$col_set = '';
		foreach($col_name as $ckey => $cvalue) {
				$col_set .= $ckey .' = :'.$ckey .',';
		}
		
		$set = trim($col_set,',');	
		$this->query = "update $tablename set $set";
	
		$this->bindParam = $col_name;
		$this->HoldResults = false;	
		$this->BuildQuery();
	}
		
	/**
		Delete Record to table method
	**/

	public function delete($tablename){
		
		$this->query = "delete from $tablename";
		$this->HoldResults = false;
		$this->BuildQuery();
	}
	
}   

//$db = new YR_database();
//$db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
//$db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC); 

	

?>