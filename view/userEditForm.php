<!--Representa s—lo el formularo de creaci—n de usuarios. -->
<h2>Editar usuario</h2>
<p>
Cambia la contrase&ntilde;a
</p>
<form action="index.php?action=editUser" method="post">
<label for="user">Usuario:</label><input type="text" name="user" value="<?php echo $user ?>"></input><br>
<label for="server">Servidor:</label><input type="text" name="server" value="<?php echo $server ?>"></input><br>
<label for="password">Contrase&ntilde;a:</label><input type="password" name="password" ></input><br>
<input type="submit" name="edit" value="Crear"></input>
</form>