<h3>Lista de usuarios existentes en el sistema.</h3>
<table border="0">
    <tr>
        <th>Usuario</th>
        <th>Host</th>
        <th>Editar</th>
        <th>Eliminar</th>
        <th>Permisos</th>        
</tr>
<?php
        foreach($users as $us){
            echo "<tr>";
            echo "<td>".$us->getUser()."</td>";
            echo "<td>".$us->getHost()."</td>";
            echo "<td><a href='index.php?action=editUser&user=".$us->getUser()."&server=".$us->getHost()."'><img src='theme/images/edit.png'></a></td>";
            echo "<td><a href='index.php?action=dropUser&userLogin=".$us->getUser()."@".$us->getHost()."'><img src='theme/images/userdel.png'></a></td>";
            echo "<td><a href='index.php?action=privilegios&user=".$us->getUser()."&server=".$us->getHost()."'><img src='theme/images/key.png'></a></td>";
            echo "</tr>";
        }
?>
</table>