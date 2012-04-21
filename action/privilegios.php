<?php
    
    $user=$_REQUEST['user'];
    $server=$_REQUEST['server'];
    $query = "SHOW DATABASES ";
        
    $result = $db->execQuery($query);
    $dbs = array();
    while($dba=mysql_fetch_array($result)){
        $dbs[] = $dba['Database'];
    }
    if($_POST['grant']){
        $privileges=array();
    
        if(isset($_POST['UPDATE'])){
            $privileges[] = 'UPDATE';
        }
        if(isset($_POST['DELETE'])){
            $privileges[] = 'DELETE';
        }
        if(isset($_POST['CREATE'])){
            $privileges[] = 'CREATE';
        }
        if(isset($_POST['DROP'])){
            $privileges[] = 'DROP';
        }
        if(isset($_POST['RELOAD'])){
            $privileges[] = 'RELOAD';
        }
        if(isset($_POST['SHUTDOWN'])){
            $privileges[] = 'SHUTDOWN';
        }
        if(isset($_POST['PROCESS'])){
            $privileges[] = 'PROCESS';
        }
        if(isset($_POST['INDEX'])){
            $privileges[] = 'INDEX';
        }
        if(isset($_POST['ALTER'])){
            $privileges[] = 'ALTER';
        }
        if(isset($_POST['SHOWDATABASES'])){
            $privileges[] = 'SHOW DATABASES';
        }
        if(isset($_POST['SUPER'])){
            $privileges[] = 'SUPER';
        }
        if(isset($_POST['CREATEVIEW'])){
            $privileges[] = 'CREATE VIEW';
        }
        if(isset($_POST['TRIGGER'])){
            $privileges[] = 'TRIGGER';
        }
        if(isset($_POST['SHOWVIEW'])){
            $privileges[] = 'SHOW VIEW';
        }
        if(isset($_POST['CREATEROUTINE'])){
            $privileges[] = 'CREATE ROUTINE';
        }
        if(isset($_POST['ALTERROUTINE'])){
            $privileges[] = 'ALTER ROUTINE';
        }
        if(isset($_POST['CREATEUSER'])){
            $privileges[] = 'CREATE USER';
        }
        
        if(isset($_POST['EXECUTE'])){
            $privileges[] = 'EXECUTE';
        }
        
        
        $object = $_POST['DATABASE'];
        
        revokePrivileges($user,$server,array("ALL"),$object,isset($_POST['GRANT']),$db);
        $revokeE = mysql_error();
        grantPrivileges($user,$server,$privileges,$object,isset($_POST['GRANT']),$db);
        $grantE = mysql_error();

        if($revokeE != null){
            $messagesError[] = $revokeE;
        }else  if($grantE != null){
            $messagesError[] = $grantE;
        }else
            $messagesOK[] = "Los privilegios se han aplicado de forma correcta para el usuario: $user@$server";

    }

        $view = "privilegesForm";
        $title = "Conceder / Revocar privilegios";
?>