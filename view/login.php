<h3>Acceso</h3>
Ingresa tu usuario y contrase&ntilde;a para acceder al sistema.
<form name='login' method='post' action='index.php?action=login.php'>
    <label for="user">Usuario: </label><input type="text" name="user" ></input><br>
    <label for="passwd">Contrase&ntilde;a: </label><input type="password" name="passwd" ></input><br>
    <input type="submit" name="ingresar"value="ingresar"><br>
    <label><?php echo $mensaje;?></label>
</form>
