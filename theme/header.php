<div id="header">
    <div><h1><img src="theme/images/mysql.gif" width="200px"/> Admin</h1></div>
</div>
<nav id="navmenu" >
    <ul>
        <li><a href="index.php" >Inicio</a></li>
        <li>Usuarios
            <ul>
                <li><a href="index.php?action=listUser" >Listar</a></li>
                <li><a href="index.php?action=createUser" >Crear</a></li>
            </ul>
        </li>
        
        <li>Base de Datos
            <ul>
                <li><a href="resp01TRON.php" >Respaldar</a></li>
                <li><a href="ejemplo1TRON.php" >Cargar Respado</a></li>
                <li><a href="listar01.php" >Restaurar</a></li>
                <li><a href="nueva.php" >Crear</a></li>
                <li><a href="listar02.php" >Borrar</a></li>
                <li><a href="mostrar01.php" >Bitacora</a></li>
            </ul>
        </li>
        <li>Tablas
            <ul>
                <li><a href="index.php?action=crearTablaAction" >Crear</a></li>
                <li><a href="index.php?action=DeleteTable" >Borrar</a></li>
				 <li><a href="index.php?action=AlterTabla" >Alterar</a></li>
                <li><a href="index.php?action=GrantTabla" >Permisos</a></li>
				<li><a href="index.php?action=cambioBase" >Cambiar Base de Trabajo</a></li>
            </ul>
        </li>
        
    </ul>
   			
    </ul>
	
		<!-- PARTE SERGIO-->	
	
	
		<!-- PARTE SERGIO-->	
	
        <ul style="float:right">
        <li><?php if(isset($_SESSION['user'])) echo "Usuario: ".$_SESSION['user']; ?></li>
        <li><?php if(isset($_SESSION['base'])) echo "Base: ".$_SESSION['base']; ?></li>
        <li><a href="index.php?action=logout">Ingresar/Salir</a></li>
        </ul>
</nav>
