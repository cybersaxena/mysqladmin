<?php
    
    $user=$_REQUEST['user'];
    $server=$_REQUEST['server'];
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
        if(isset($_POST['SHOW DATABASES'])){
            $privileges[] = 'SHOW DATABASES';
        }
        if(isset($_POST['SUPER'])){
            $privileges[] = 'SUPER';
        }
        if(isset($_POST['CREATE VIEW'])){
            $privileges[] = 'CREATE VIEW';
        }
        if(isset($_POST['TRIGGER'])){
            $privileges[] = 'TRIGGER';
        }
        if(isset($_POST['SHOW VIEW'])){
            $privileges[] = 'SHOW VIEW';
        }
        if(isset($_POST['CREATE ROUTINE'])){
            $privileges[] = 'CREATE ROUTINE';
        }
        if(isset($_POST['ALTER ROUTINE'])){
            $privileges[] = 'ALTER ROUTINE';
        }
        if(isset($_POST['CREATE USER'])){
            $privileges[] = 'CREATE USER';
        }
        
        if(isset($_POST['EXECUTE'])){
            $privileges[] = 'EXECUTE';
        }
    
        $object = $_POST['DATABASE'];
        
        revokePrivileges($user,$server,array("ALL"),"*",isset($_POST['GRANT']),$db);
        echo mysql_error();
        grantPrivileges($user,$server,$privileges,"*",isset($_POST['GRANT']),$db);
        echo mysql_error();

        if($GLOBALS['m_err'] != null)
            $messagesOK[] = "Los privilegios se han aplicado de forma correcta para el usuario: $user@$server";
        else
            $messagesError[] = $GLOBALS['m_err'];
    }

        $view = "privilegesForm";
        $title = "Conceder / Revocar privilegios";
?>