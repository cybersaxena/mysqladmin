<?php
	class MySQLdBO{
		var $connection;
		public function connect($user="root", $password=null){
			$this->connection = mysql_connect("localhost",$user,$password);
			if (!$conexion){
				return false;
			}
			return true;
		}
		
		public function execQuery($sqlQuery,$dataBase = NULL){
			if($database){
				mysql_select_db($database,$this->connection);
			}
			return mysql_query($sqlQuery,$this->connection);
		}
	}
	
	//Functions
	function createUser($user,$server="%",$password,$dbo){
            $query = "CREATE USER '" . $user . "'@'".$server."' ";
            if($password){
                $query .= "IDENTIFIED BY '" . $password ."' ";
            }
            echo $query;
            $dbo->execQuery($query);
        }
        
        function dropUser($user,$server="%",$dbo){
            $query = "DROP USER '" . $user . "'@'".$server."' ";
            $dbo->execQuery($query);
        }
        
        function grantPrivileges($user,$server,$privileges,$object,$grant=false,$dbo){
            $query = "GRANT " . implode(",", $privileges) . " ON " . $object .".* TO '" . $user . "'@'".$server."'";
            if($grant){
                $query .= " WITH GRANT OPTION";
            }
            echo $query;
            echo mysql_error();
            $dbo->execQuery($query);
         }
         
         function revokePrivileges($user,$server,$privileges,$object,$grant=false,$dbo){
            $query = "REVOKE " . implode(",", $privileges) . " PRIVILEGES ON " . $object .".* FROM '" . $user . "'@'".$server."'";
            echo $query;
            $dbo->execQuery($query);
            echo mysql_error();
            if(!$grant){
                $query = "REVOKE GRANT OPTION ON * . * FROM '$user'@'$server'";
                $dbo->execQuery($query);
            }
         }
	
	
?>