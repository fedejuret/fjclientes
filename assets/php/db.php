<?php 
	
	class db{

		function Connect(){

			$db = new PDO('mysql:host=localhost;dbname=fjclientes', 'root', '');
			$db->exec("set names utf8");

			if($db){
				return $db;
			}

			return "";

		}
	}

 ?>