<?php
/**
 * DB
 * author:gaoshuo
 * time:2017-06-08 16:15:38
 **/
include_once('.env');
Class DB {
	private static $Instance;

	private function __construct() {
		
	}


	public static function getInstance() {
		if (!isset(self::$Instance)) {
			self::$Instance = new self();
		}

		return self::$Instance;
	}

	public function getCon(){
		$con = mysqli_connect('localhost', 'root', $DB_PASSWORD);
		if (!$con)
 		{
  			die('Could not connect: ' . mysql_error());
 		}
		mysqli_select_db($con, 'pachong');
		return $con;
	}


}

