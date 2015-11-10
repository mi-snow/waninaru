<?php
class DATABASE_CONFIG {

	public $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'user',
		'password' => 'password',
		'database' => 'test_database_name',
	);
	public $default = array(
		'datasource' => 'Database/Mysql', //MySQLに接続することを示す
		'persistent' => false, //接続の永続化をするかどうか
		'host' => 'localhost', //IPアドレスは127.0.0.1
		'login' => 'root', //ログインするID
		'password' => 'root', //ログインするpassword
		'database' => 'waninaru', //データベース名
		'encoding' => 'utf8' //charset
	);
}
