<?php
include_once 'TipoDato.php';

class Columna{
	var $name;
	var $tipoDato ;
	var $isNull;
	var $auto;
	var $isAutoIncrement;
	var $isUnique;
	var $isPrimary;

		function __construct($nombre,$nulo,$primario,$unico,$increment,$def=NULL){
			$this->name=$nombre;
			$this->isNull=$nulo;
			$this->isAutoIncrement=$increment;
			$this->isUnique=$unico;
			$this->isPrimary=$primario;
			$this->auto=$def;
		}
	function tipoDato($objTipoDato){
		$this->tipoDato=$objTipoDato;
	}
}

function sqlColumna($columna){
	$cadena=" ";
	$cadena .=$columna->name;
	
	$cadena .=sqlDato($columna->tipoDato);
	
	
		if(!$columna->isNull){
		$cadena .=" NOT NULL ";
	}
	$valor=" ";
	if($columna->auto!=NULL){
		if($columna->tipoDato->tipo=="BIT" || $columna->tipoDato->tipo=="TINYINT" || $columna->tipoDato->tipo=="SMALLINT" || $columna->tipoDato->tipo=="MEDIUMINT"
		|| $columna->tipoDato->tipo=="INT" || $columna->tipoDato->tipo=="DOUBLE" || $columna->tipoDato->tipo=="FLOAT" || $columna->tipoDato->tipo=="NUMERIC"){
			$valor.=$columna->auto;
		}else{
			$valor="'".$columna->auto."'";
		}
		$cadena .=" DEFAULT ".$valor;
	}
	
	if($columna->isAutoIncrement){
		$cadena .=" AUTO_INCREMENT ";
	}
	
	if($columna->isUnique){
		$cadena .=" UNIQUE ";
	}
	
	if($columna->isPrimary){
		$cadena .=" PRIMARY KEy ";
	}

	return $cadena;
}

//print_r($arrayTipoDato);
//,$tipos=$arrayTipoDato

function formColumnaN($numColumna){
global $arrayTipoDato;
echo "<tr>";
echo "<td>Nombre col #".$numColumna."</td>";
echo "<td><input type='text' size='15' maxlength='15' name='nombreCol".$numColumna."'/>";
echo "<select name='tipoDato".$numColumna."'>";
foreach( $arrayTipoDato as $val ){
echo "<option value='".$val->tipo."'>".$val->tipo."</option>";
}
echo "</select>";
echo "<input type='text' size='4' maxlength='4' name='longitudCol".$numColumna."'/>";
echo "<input type='text' size='1' maxlength='1' name='precisionCol".$numColumna."'/>";
echo "<input type='checkbox' name='noNulo".$numColumna."'>No Nulo";
echo "<input type='checkbox' name='unico".$numColumna."'>Unico";
echo "<input type='checkbox' name='llavePrimaria".$numColumna."'>Llave Primaria";
echo "<input type='checkbox' name='increment".$numColumna."'>AutoIncrementable";
echo "<input type='checkbox' name='default".$numColumna."'>default";
echo "<input type='text' size='30' maxlength='30' name='defaultVal".$numColumna."'/>";
echo "</tr>";
echo "<br>";

}

//formColumnaN(1);
?>