<?php

namespace App;
use \PDO;

class	Database
{
	private $db_name;
	private $db_user;
	private $db_pass;
	private $db_host;
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
			try {
				$this->pdo = new PDO('mysql:dbname=' . $this->db_name . ';host=' . $this->db_host, $this->db_user, $this->db_pass);
			}
			catch (Exception $error)
			{
				print_r($error);
			}
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
		}
		return ($this->pdo);
	}

	public function getquery($statement, $one = false)
	{
		$req = $this->getPDO()->query($statement);
		if ($one)
			$datas = $req->fetch();
		else
			$datas = $req->fetchAll();
		return ($datas);
	}
	
	public function setquery($statement)
	{
		$req = $this->getPDO()->query($statement);
		return ($req->rowCount());
	}

	public function getprepare($statement, $attributes, $one = false)
	{
		$req = $this->getPDO()->prepare($statement);
		$req->execute($attributes);
		if ($one)
			$datas = $req->fetch();
		else
			$datas = $req->fetchAll();
		return ($datas);

	}

	public function setprepare($statement, $attributes)
	{
		$req = $this->getPDO()->prepare($statement);
		$req->execute($attributes);
		return ($req->rowCount());
	}
}

?>
