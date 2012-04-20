<ul>
<?php
foreach($messagesOK as $mensaje){
    echo "<li class='info'>$mensaje</li>";
}
foreach($messagesError as $mensaje){
    echo "<li class='error'>$mensaje</li>";
}

foreach($messagesWarning as $mensaje){
    echo "<li class='warning'>$mensaje</li>";
}
foreach($messagesSQL as $mensaje){
    echo "<li class='sqlm'>$mensaje</li>";
}
?>
</ul>