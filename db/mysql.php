<?php
	class MySQLdBO{
		var $connection;
		public function connect($user="root", $password=123){
			$this->connection = @mysql_connect("mysql.phpwebapp.svc",$user,$password);
			if (!$conexion){
				return false;
			}
			return true;
		}
		
		public function execQuery($sqlQuery,$dataBase = NULL){
			if($database){
				@mysql_select_db($database,$this->connection);
			}
			$result =  @mysql_query($sqlQuery,$this->connection);
                        return $result;
		}
	}
	
	//Functions
	function createUser($user,$server="%",$password,$dbo){
            $query = "CREATE USER '" . $user . "'@'".$server."' ";
            if($password){
                $query .= "IDENTIFIED BY '" . $password ."' ";
            }
            $dbo->execQuery($query);
            $query = "CREATE USER '" . $user . "'@'".$server."' ";
            if($password){
                $query .= "IDENTIFIED BY '**********' ";
            }
            $GLOBALS['messagesSQL'][] = $query;
        }
        
        function dropUser($user,$server="%",$dbo){
            $query = "DROP USER '" . $user . "'@'".$server."' ";
            $dbo->execQuery($query);
            $GLOBALS['messagesSQL'][]= $query;
        }
        
        function grantPrivileges($user,$server,$privileges,$object,$grant=false,$dbo){
            $query = "GRANT " . implode(",", $privileges) . " ON " . $object .".* TO '" . $user . "'@'".$server."'";
            if($grant){
                $query .= " WITH GRANT OPTION";
            }
            $GLOBALS['messagesSQL'][]= $query;
            $dbo->execQuery($query);
         }
         
         function revokePrivileges($user,$server,$privileges,$object,$grant=false,$dbo){
            $query = "REVOKE " . implode(",", $privileges) . " PRIVILEGES ON " . $object .".* FROM '" . $user . "'@'".$server."'";
            $GLOBALS['messagesSQL'][]= $query;
            $dbo->execQuery($query);
            if(!$grant){
                $query = "REVOKE GRANT OPTION ON * . * FROM '$user'@'$server'";
                $dbo->execQuery($query);
                $GLOBALS['messagesSQL'][]= $query;
            }
         }
         
         function changePassword($user,$server="%",$password,$dbo){
            $query = "SET PASSWORD FOR '" . $user . "'@'".$server."' = PASSWORD('$password'); ";
            $dbo->execQuery($query);
            $query = "SET PASSWORD FOR '" . $user . "'@'".$server."' = PASSWORD('*******'); ";
            $GLOBALS['messagesSQL'][]= $query;
        }
	
	
?>
