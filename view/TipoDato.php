<?php

class tipoDato{
var $tipo;
var $len=0;
var $presicion;
var $signed="";
var $zerofill="";
var $esUnsigned=false;
var $esZeroFill=false;
var $conDefault;
var $conIncrement;
var $hasLen;
var $hasPrec;
	function __construct($dato,$len,$prec,$def,$incre){
		$this->tipo=$dato;
		$this->hasLen=$len;
		$this->hasPrec=$prec;
		$this->signed="";
		$this->zerofill="";
		$this->esUnsigned=false;
		$this->esZeroFill=false;
		$this->conDefault=$def;
		$this->conIncrement=$incre;
	}
	
	function presicion($tam,$dec=0){
		if($this->hasLen && is_numeric($tam)) 
			$this->len=$tam;
		if($this->hasPrec && is_numeric($dec))
			$this->presicion=$dec;
	}
	function esZeroFill($zero){
		$this->esZeroFill=$zero;
	}
	
		function esUnsigned($sign){
		$this->esUnsigned=$sign;
	}

	// para guardar en los tipos de dato seleccionado

	function zeroFill(){
		if($this->esZeroFill)
			$this->zerofill=" ZEROFILL ";
	}
	
		function unsigned(){
		if($this->esUnsigned)
			$this->signed=" UNSIGNED ";
	}
	
}

function sqlDato($tipoDato){
	$cadena=" ";
	$cadena .=$tipoDato->tipo;
	if($tipoDato->len>0){
		$cadena .="(".$tipoDato->len;
		if($tipoDato->hasPrec){
			$cadena .=",".$tipoDato->presicion;
		}
		
		$cadena .=")";

		if($tipoDato->esUnsigned){
			$cadena .=$tipoDato->signed;
		}
		
		if($tipoDato->esZeroFill){
			$cadena .=$tipoDato->zerofill;
		}
	}

	return $cadena;
}

	$arrayTipoDato= array();
	$tipoDato= new tipoDato("BIT",true,false,true,false);
	$tipoDato->presicion(1);
	$tipoDato->esUnsigned(false);
	$tipoDato->esZeroFill(false);
	$arrayTipoDato[0]=$tipoDato;
	
	$tipoDato= new tipoDato("TINYINT",true,false,true,true);
	$tipoDato->presicion(1);
	$tipoDato->esUnsigned(true);
	$tipoDato->esZeroFill(true);
	$arrayTipoDato[1]=$tipoDato;
	
	
	$tipoDato= new tipoDato("SMALLINT",true,false,true,true);
	$tipoDato->presicion(1);
	$tipoDato->esUnsigned(true);
	$tipoDato->esZeroFill(true);
	$arrayTipoDato[2]=$tipoDato;
	
	
	$tipoDato= new tipoDato("MEDIUMINT",true,false,true,true);
	$tipoDato->presicion(1);
	$tipoDato->esUnsigned(true);
	$tipoDato->esZeroFill(true);
	$arrayTipoDato[3]=$tipoDato;
	
	
	$tipoDato= new tipoDato("INT",true,false,true,true);
	$tipoDato->presicion(1);
	$tipoDato->esUnsigned(true);
	$tipoDato->esZeroFill(true);
	$arrayTipoDato[4]=$tipoDato;

	$tipoDato= new tipoDato("DOUBLE",true,true,true,true);
	$tipoDato->presicion(1,0);
	$tipoDato->esUnsigned(true);
	$tipoDato->esZeroFill(true);
	$arrayTipoDato[5]=$tipoDato;

	$tipoDato= new tipoDato("FLOAT",true,true,true,true);
	$tipoDato->presicion(1,0);
	$tipoDato->esUnsigned(true);
	$tipoDato->esZeroFill(true);
	$arrayTipoDato[6]=$tipoDato;

	$tipoDato= new tipoDato("NUMERIC",true,true,true,true);
	$tipoDato->presicion(1,0);
	$tipoDato->esUnsigned(true);
	$tipoDato->esZeroFill(true);
	$arrayTipoDato[7]=$tipoDato;

	$tipoDato= new tipoDato("DATE",false,false,true,false);
	$tipoDato->esUnsigned(false);
	$tipoDato->esZeroFill(false);
	$arrayTipoDato[8]=$tipoDato;

	$tipoDato= new tipoDato("TIME",false,false,true,false);
	$tipoDato->esUnsigned(false);
	$tipoDato->esZeroFill(false);
	$arrayTipoDato[9]=$tipoDato;

	$tipoDato= new tipoDato("TIMESTAMP",false,false,true,false);
	$tipoDato->esUnsigned(false);
	$tipoDato->esZeroFill(false);
	$arrayTipoDato[10]=$tipoDato;

	$tipoDato= new tipoDato("DATETIME",false,false,true,false);
	$tipoDato->esUnsigned(false);
	$tipoDato->esZeroFill(false);
	$arrayTipoDato[11]=$tipoDato;

	$tipoDato= new tipoDato("CHAR",true,false,true,false);
	$tipoDato->presicion(1);
	$tipoDato->esUnsigned(false);
	$tipoDato->esZeroFill(false);
	$arrayTipoDato[12]=$tipoDato;

	$tipoDato= new tipoDato("VARCHAR",true,false,true,false);
	$tipoDato->presicion(1);
	$tipoDato->esUnsigned(false);
	$tipoDato->esZeroFill(false);
	$arrayTipoDato[13]=$tipoDato;


	$tipoDato= new tipoDato("TEXT",false,false,false,false);
	$tipoDato->presicion(0);
	$tipoDato->esUnsigned(false);
	$tipoDato->esZeroFill(false);
	$arrayTipoDato[14]=$tipoDato;
	
	function copiaDato($dato){
	global $arrayTipoDato;
		foreach( $arrayTipoDato as $val ){
			if($val->tipo==$dato){
				return $val;
			}
		}
	}

/*
print_r($arrayTipoDato);

foreach( $arrayTipoDato as $val ){
echo sqlDato($val);
print "\n";
}
*/

?>