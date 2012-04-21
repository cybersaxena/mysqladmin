<?php 
$select="show databases";
$select=mysql_query($select); 
?>
Selecciona tu base de datos que deseas respaldar <br><br>

 <form action="" method="post">  
  <select name="db">
<?php
  while($row = mysql_fetch_row($select)){
?>
       <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
   }    
  ?>
  </select>
  <input type="submit" name="submit" value="Crear backup" />  
 </form>