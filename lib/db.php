<?php

/*
 * Class db
 */


Class db {
	private static $dbhost = 'localhost';
	private static $dbuser = MYSQL_USERNAME;
	private static $password = MYSQL_PASSWORD;
	private static $dbname = MYSQL_DATABASE;
	private static $instance = NULL;

	private function __construct(){

	}

	public static function getInstance(){
		if (self::$instance == NULL){
			self::$instance = new db();
		}
		return self::$instance;		
	} 

	public function mycon(){
		@mysql_connect(self::$dbhost,self::$dbuser,self::$password);

	}

	public function selectdb(){
		@mysql_select_db(self::$db);

	}

	public function createcon(){
		mysql_connect(self::$dbhost,self::$dbuser,self::$password);
		mysql_select_db(self::$dbname);
	} 

	public function fetch_array($sql){
		$result = $this->query($sql);
		$rs = mysql_fetch_array($result);
		return $rs;
	}

	public function query($sql){
		mysql_query("set names utf8");
		return mysql_query($sql);
	}

	public function close(){
		return  mysql_close();
	}
}









?>