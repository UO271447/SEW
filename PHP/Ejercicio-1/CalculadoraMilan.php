<?php
session_start();
if(!isset($_SESSION['calculadora']))
{
    $_SESSION['calculadora'] = new CalculadoraMilan();
    $calculadora= $_SESSION['calculadora'];
}
else{
    $calculadora= $_SESSION['calculadora'];
}

class CalculadoraMilan{
public $display;
public $AlmacenaValor;
public $memory;
public $result;
public $enter;
public $simbolo;
public $operacion;

public function __constructor(){
    $this->display='';
    $this->memory=0;
    $this->result=0;
	$this->enter=false;
	$this->AlmacenaValor='';
	$this->simbolo='';
	$this->operacion='';
	$this->haveop=false;
}
public function addDisplay($numero){
	if($this->enter==true){
		if($numero!="+" && $numero!="-" && $numero!="*"&& $numero!="/"){
			$this->display=$numero;
		}
		$this->AlmacenaValor=$numero;
		$this->enter=false;	
	}
	else{
		if(substr($this->AlmacenaValor, - 1)=="+"||substr($this->AlmacenaValor, - 1)=="-"
			||substr($this->AlmacenaValor, - 1)=="*"
			||substr($this->AlmacenaValor, - 1)=="/"){
			$this->simbolo=substr($this->AlmacenaValor, - 1);
			$this->AlmacenaValor=substr($this->AlmacenaValor,0,-1);
			$var=eval("return $this->AlmacenaValor;").$this->simbolo;
			$this->AlmacenaValor=$var;
			$this->display = '';
		}
		if($numero!="+" && $numero!="-" && $numero!="*"&& $numero!="/"){
			$this->display.=$numero;
		}
		$this->AlmacenaValor.=$numero;
		
	}
   
}
public function C(){
    $this->display='';
	$this->AlmacenaValor='';
 }
 public function CE(){
    $this->memory=0;
 }
  public function mrc(){ 
     $this->display=$this->memory;
 }
 public function getResultado(){
     return $this->display;
 }
 public function cambioSigno(){
    $this->display = $this->display*-1;
	$this->AlmacenaValor = $this->display;
    $this->getResultado();
 }
 public function raiz(){
  $this->result = eval("return $this->AlmacenaValor**(1/2);");
  $this->AlmacenaValor=$this->result;
  $this->display=$this->result;
 }

  public function mAdd(){

    $this->memory=$this->memory + $this->display;

 }
 public function setEnterFalse(){
	  $this->enter=false;
 }
 public function setEnterTrue(){
	  $this->enter=true;
 }
 public function mMinus(){
     $this->memory=$this->memory-$this->display;

 }
 public function getNumber(){
		//RETORNA LA LONGITUD DE UN OPERANDO2
        $oper = false;
        for ($i = 0; $i < strlen($this->AlmacenaValor); $i++) {
            if(substr($this->AlmacenaValor,$i,1) == "+" || substr($this->AlmacenaValor,$i,1) == "-" || substr($this->AlmacenaValor,$i,1) == "*" || substr($this->AlmacenaValor,$i,1) == "/"){
				$oper= true;
				$this->haveop=true;
                break;
            }
        }
        if($oper){
            $c = 0;
			
            for($i=strlen($this->AlmacenaValor)-1; $i >= 0; $i--){
                if(is_numeric(substr($this->AlmacenaValor,$i,1))|| substr($this->AlmacenaValor,$i,1)=="."){
                    $c++;
                }else{
                    return $c;
                }
            }
        }else{
			$this->haveop=false;
            return strlen($this->display)-1;
        }
    }
  public function porcentaje() {
		 	
		   
         $lengthn=$this->getNumber();
		 $op1 = substr($this->AlmacenaValor,0,-2);
		 $numero =substr($this->AlmacenaValor,-$lengthn);
		 print_r($numero);
		 $rest = substr($this->AlmacenaValor,0,-$lengthn);
		 $signo= substr($rest, -1);
		 $this->display .='%';
		 $numero=$numero/100; //dividir por 100 el número
		 if($signo=="+" || $signo=="-"){

			 $this->AlmacenaValor =$op1;
			 $this->AlmacenaValor .=$signo;	
			 $this->AlmacenaValor .=$op1;

			 $this->AlmacenaValor .="*";
			 $this->AlmacenaValor .=$numero;
			 
		 }
		 else{
			$this->AlmacenaValor = $rest; 
			$this->AlmacenaValor .= $numero;
		 }
			$var=eval("return $this->AlmacenaValor;");
			$this->AlmacenaValor=$var;
		
         }
  public function resultado(){
	  
	  $lengthn=$this->getNumber();
		if($lengthn>=1 && $this->haveop==true){
			$numero =substr($this->AlmacenaValor,-$lengthn);
			$rest = substr($this->AlmacenaValor,0,-$lengthn);
			$signo= substr($rest, -1);
			$this->simbolo=$signo;
			$this->operacion=$numero;
			
		}
	if($this->enter==false){
		try {
			$this->result = eval("return $this->AlmacenaValor;");
			$this->display= $this->result;
			$this->setEnterTrue();
			$this->AlmacenaValor=$this->result;
		
		}
		catch (Exception $e) {
        $this->result = "Error: " .$e->getMessage();
		}
	}
	else{
			$this->AlmacenaValor .= $this->simbolo;
			$this->AlmacenaValor .= $this->operacion;
			
			$var=eval("return $this->AlmacenaValor;");
			$this->AlmacenaValor=$var;
			$this->display=$var;
		}
 }



}
if (count($_POST)>0) 
    {   
        if(isset($_POST['C'])){
         $calculadora->C(); 
        }
		if(isset($_POST['CE'])){
         $calculadora->CE(); 
        }
		if(isset($_POST['cambiosigno'])){
         $calculadora->cambioSigno(); 
        }
		if(isset($_POST['raiz'])){
         $calculadora->raiz(); 
        }
		if(isset($_POST['porcentaje'])){
         $calculadora->porcentaje(); 
        }
		if(isset($_POST['boton7'])){
         $calculadora->addDisplay($_POST['boton7']); 
        }
		if(isset($_POST['boton8'])){
         $calculadora->addDisplay($_POST['boton8']); 
        }
		if(isset($_POST['boton9'])){
         $calculadora->addDisplay($_POST['boton9']); 
        }
		if(isset($_POST['boton4'])){
         $calculadora->addDisplay($_POST['boton4']); 
        }
		if(isset($_POST['boton5'])){
         $calculadora->addDisplay($_POST['boton5']); 
        }
		if(isset($_POST['boton6'])){
         $calculadora->addDisplay($_POST['boton6']); 
        }
		if(isset($_POST['boton3'])){
         $calculadora->addDisplay($_POST['boton3']); 
        }
		if(isset($_POST['boton2'])){
         $calculadora->addDisplay($_POST['boton2']); 
        }
		if(isset($_POST['boton1'])){
         $calculadora->addDisplay($_POST['boton1']); 
        }
		if(isset($_POST['boton0'])){
         $calculadora->addDisplay($_POST['boton0']); 
        }
		if(isset($_POST['multi'])){
		 $calculadora->setEnterFalse();
         $calculadora->addDisplay($_POST['multi']); 
		 
        }
		if(isset($_POST['division'])){
		 $calculadora->setEnterFalse();
         $calculadora->addDisplay($_POST['division']); 
		 
        }
		if(isset($_POST['menos'])){
		 $calculadora->setEnterFalse();
         $calculadora->addDisplay($_POST['menos']); 
		 
		}
		if(isset($_POST['mas'])){
		 $calculadora->setEnterFalse();
         $calculadora->addDisplay($_POST['mas']);		 
        }
		if(isset($_POST['mrc'])){
         $calculadora->mrc(); 
        }
		if(isset($_POST['mmas'])){
         $calculadora->mAdd(); 
        }
		if(isset($_POST['mmenos'])){
         $calculadora->mMinus(); 
        }
		if(isset($_POST['punto'])){
		 $calculadora->setEnterFalse();
         $calculadora->addDisplay($_POST['punto']);
		 		 
        }
		if(isset($_POST['igual'])){
         $calculadora->resultado();
		 $calculadora->setEnterTrue();		 
        }
        
    }








echo "
<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <title>Calculadora basica</title>
    <link rel='stylesheet' href='CalculadoraMilan.css' />
</head>

<body>
    
    <h1>Calculadora basica</h1>
<form action='#' method='post' name='CalculadoraMilan.php'>
	<h2>Calculadora</h2>
	<p>
    <label for='resultado'>Resultado</label>
    <input type='text' id='resultado' readonly disabled value=".$calculadora->getResultado()."  />
    </p>
<p>
<input type='submit' name='C' value='ON/C' />
<input type='submit' name='CE' value='CE'/>
<input type='submit' name='cambiosigno' value='+/-'/>
<input type='submit' name='raiz' value='√'/>
<input type='submit' name='porcentaje' value='%'  />
<input type='submit' name='boton7' value='7'  />
<input type='submit' name='boton8' value='8'  />
<input type='submit' name='boton9' value='9' />
<input type='submit' name='multi' value='*' />
<input type='submit' name='division' value='/' />
<input type='submit' name='boton4' value='4'/>
<input type='submit' name='boton5' value='5'/>
<input type='submit' name='boton6' value='6'/>
<input type='submit' name='menos' value='-' />
<input type='submit' name='mrc' value='MRC' />
<input type='submit' name='boton1' value='1' />
<input type='submit' name='boton2' value='2' />
<input type='submit' name='boton3' value='3' />
<input type='submit' name='mas' value='+' />
<input type='submit' name='mmenos' value='M-'/>
<input type='submit' name='boton0' value='0' />
<input type='submit' name='punto' value='.' /> 
<input type='submit' name='igual' value='=' />
<input type='submit' name='mmas' value='M+' />
</p>
</form>
</html> ";
?>