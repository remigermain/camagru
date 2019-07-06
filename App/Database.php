<?php

namespace App;

use \PDO;

class	Database
{
	private $db_info
	private $pdo;

	public function __construct($db_name, $db_user = 'root', $db_pass = 'rootpass', $db_host = '172.18.0.2')
	{
		$this->db_name = $db_name;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db_host = $db_host;
	}

	private function getPDO()
	{
		if ($this->pdo === null)
		{
			$this->pdo = new PDO('mysql:dbname=' . $this->db_name . ';host=' . $this->db_host, $this->db_user, $this->db_pass);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
		}
		return ($this->pdo);
	}

	public function query($statement, $class_name)
	{
		$req = $this->getPDO()->query($statement);
		$datas = $req->fetchall(PDO::FETCH_CLASS, $class_name);
		return ($datas);
	}

	public function prepare($statement, $attributes, $class_name, $one = false)
	{
		$req = $this->getPDO()->prepare($statement);
		$req->execute($attributes);
		$req->setFetchMode(PDO::FETCH_CLASS, $class_name);
		if ($one)
			$datas = $req->fetch();
		else
			$datas = $req->fetchAll();
		return ($datas);

	}
}

?>
