<?php 

class Conexion extends mysqli
{
	
	public function __construct()
	{
		parent::__construct(SERVERBD,USERBD,PASSBD,BD);
		$this->query("SET NAMES 'utf8'");
		$this->connect_errno ? die('Connection Failed') : $x = 'Connected!';
		//echo $x;
		unset($x);
	}
    

 }


 ?>