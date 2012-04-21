<!--Representa s—lo el formularo de creaci—n de usuarios. -->
<h2>Asignaci&oacute;n/Revocaci&oacute;n de Privilegios.</h2>
<p>
Ingresa los datos del usuario que deseas agregar al sistema.
</p>
<form action="index.php?action=privilegios" method="post">
<label for="user">Usuario:</label><input type="text" name="user" value="<?php echo $user ?>"></input><br>
<label for="server">Servidor:</label><input type="text" name="server"  value="<?php echo $server ?>"></input><br>
<h3>Permisos.</h3>

<input type="checkbox" value="Y" name="UPDATE"><label for="UPDATE">UPDATE</label>
<input type="checkbox" value="Y" name="DELETE"><label for="DELETE">DELETE</label>
<input type="checkbox" value="Y" name="CREATE"><label for="CREATE">CREATE</label>
<input type="checkbox" value="Y" name="DROP"><label for="DROP">DROP</label><br>
<input type="checkbox" value="Y" name="RELOAD"><label for="RELOAD">RELOAD</label>
<input type="checkbox" value="Y" name="SHUTDOWN"><label for="SHUTDOWN">SHUTDOWN</label>
<input type="checkbox" value="Y" name="PROCESS"><label for="PROCESS">PROCESS</label>
<input type="checkbox" value="Y" name="INDEX"><label for="INDEX">INDEX</label>
<input type="checkbox" value="Y" name="ALTER"><label for="ALTER">ALTER</label>
<input type="checkbox" value="Y" name="SHOW DATABASES"><label for="SHOW DATABASES">SHOW DATABASES</label><br>
<input type="checkbox" value="Y" name="SUPER"><label for="SUPER">SUPER</label>
<input type="checkbox" value="Y" name="CREATE VIEW"><label for="CREATE VIEW">CREATE VIEW</label>
<input type="checkbox" value="Y" name="TRIGGER"><label for="TRIGGER">TRIGGER</label>
<input type="checkbox" value="Y" name="SHOW VIEW"><label for="SHOW VIEW">SHOW VIEW</label>
<input type="checkbox" value="Y" name="CREATE ROUTINE"><label for="CREATE ROUTINE">CREATE ROUTINE</label>
<input type="checkbox" value="Y" name="ALTER ROUTINE"><label for="ALTER ROUTINE">ALTER ROUTINE</label>
<input type="checkbox" value="Y" name="CREATE USER"><label for="CREATE USER">CREATE USER</label>
<input type="checkbox" value="Y" name="EXECUTE"><label for="EXECUTE">EXECUTE</label>
<input type="checkbox" value="Y" name="GRANT"><label for="GRANT">GRANT</label><br><br>
<input type="submit" name="grant" value="Guardar Cambios"></input>
</form>