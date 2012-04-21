<?php
        $query = "SELECT  * FROM MYSQL.USER ";
        
        $result = $db->execQuery($query);
        echo mysql_error();
        $users = array();
        while($user=mysql_fetch_array($result)){
            $u = new User();
            $u->setUser ($user['User']);
            $u->setHost($user['Host']);
            $users[] = $u;
        }
        $view = 'listUser';
        $title = "Lista de Usuarios";
?>