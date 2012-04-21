<?
$messagesOK = array();
$messagesWarning = array();
$messagesError = array();
$messagesSQL = array();


extract($_SERVER,EXTR_SKIP);
@extract($_SESSION,EXTR_SKIP);
extract($_COOKIE,EXTR_SKIP);
extract($_POST,EXTR_SKIP);
extract($_GET,EXTR_SKIP);  
if($boton) 
$carpeta="/backup";
{
	if (is_uploaded_file($HTTP_POST_FILES['archivo']['tmp_name'])) 
        {
		//copy($HTTP_POST_FILES['archivo']['tmp_name'],$HTTP_POST_FILES['archivo']['name']);
                if($HTTP_POST_FILES['archivo']['type']== 'application/octet-stream') 
                {		
				//copy($archivoSQL=$HTTP_POST_FILES['archivo']['tmp_name'], $HTTP_POST_FILES['archivo']['name']);
                                $archivoSQL=$HTTP_POST_FILES['archivo']['name'];
				$carpeta="backup/".$archivoSQL;
                                copy($HTTP_POST_FILES['archivo']['tmp_name'],$carpeta);
                                $subio = true;
                }
                
                //move_uploaded_file($_FILES['AUX']['tmp_name'], "C:\Users\Administrador\Documents\Dropbox\PHP HTML/{$_FILES['AUX']['name']}");
		//$subio = true;
                $aux=$_SERVER['DOCUMENT_ROOT'];
                //echo $aux;
                //echo "<br>";
                //echo '&nbsp';
                //echo $HTTP_POST_FILES;
                
                if($subio==true) {
		$messagesOK[] =  "El archivo subio con exito";
                //echo "<a href="Inicio.html">Regresar Menu Principal</a>"; 
                } else {
		$messagesError[] =  "El archivo no cumple con las reglas establecidas";
                //echo "<a href="Inicio.html">Regresar Menu Principal</a>"
                //echo '<td><a href="Inicio.html">Regresar Menu Principal</a></td>';  
                }
                
	}
	
}
$view = "loadSQL";
include_once("view/main.php")
?>
