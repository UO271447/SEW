<?php
session_start();
if(!isset($_SESSION['calculadora']))
{
    $_SESSION['calculadora'] = new CalculadoraCientifica();
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
		$this->display=$numero;
		$this->AlmacenaValor=$this->display;
		$this->enter=false;	
	}
	else{
		if(substr($this->display, - 1)=="+"||substr($this->display, - 1)=="-"
			||substr($this->display, - 1)=="*"
			||substr($this->display, - 1)=="/"){
			$this->simbolo=substr($this->display, - 1);
			$this->AlmacenaValor=substr($this->AlmacenaValor,0,-1);
			$this->AlmacenaValor=eval("return $this->AlmacenaValor;").$this->simbolo;
			$this->display=$this->AlmacenaValor;
			
		}
		
		 $this->display.=$numero;
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
  $this->result = eval("return $this->display**(1/2);");
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
        for ($i = 0; $i < strlen($this->display); $i++) {
            if(substr($this->display,$i,1) == "+" || substr($this->display,$i,1) == "-" || substr($this->display,$i,1) == "*" || substr($this->display,$i,1) == "/"){
				$oper= true;
				$this->haveop=true;
                break;
            }
        }
        if($oper){
            $c = 0;
			
            for($i=strlen($this->display)-1; $i >= 0; $i--){
                if(is_numeric(substr($this->display,$i,1))|| substr($this->display,$i,1)=="."){
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
		$this->AlmacenaValor='';	  
         $lengthn=$this->getNumber();
		 $op1 = substr($this->display,0,-2);
		 $numero =substr($this->display,-$lengthn);
		 $rest = substr($this->display,0,-$lengthn);
		 $signo= substr($rest, -1);
		 $this->display .='%';
		 $numero=$numero/100; //dividir por 100 el número
		 if($signo=="+" || $signo=="-"){
			 print_r($this->AlmacenaValor);

			 $this->AlmacenaValor .=$op1;
			 print_r($this->AlmacenaValor);
			 $this->AlmacenaValor .=$signo;	
			 print_r($this->AlmacenaValor);			 
			 $this->AlmacenaValor .=$op1;
			 print_r($this->AlmacenaValor);
			 $this->AlmacenaValor .="*";
			 print_r($this->AlmacenaValor);
			 $this->AlmacenaValor .=$numero;
			 print_r($this->AlmacenaValor);
			 
		 }
		 else{
			$this->AlmacenaValor .= $rest; 
			$this->AlmacenaValor .= $numero;
		 }
			$this->display=eval("return $this->AlmacenaValor;");
		
         }
  public function resultado(){
	  
	  $lengthn=$this->getNumber();
		if($lengthn>=1 && $this->haveop==true){
			$numero =substr($this->display,-$lengthn);
			$rest = substr($this->display,0,-$lengthn);
			$signo= substr($rest, -1);
			$this->simbolo=$signo;
			$this->operacion=$numero;
			
		}
	if($this->enter==false){
		try {
			$this->result = eval("return $this->display;");
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
			$this->display=eval("return $this->AlmacenaValor;");
		}
 }



}

class CalculadoraCientifica extends CalculadoraMilan{
    public $arco;
	public $hiperbolic;
	public $seno;
	public $coseno;
	public $tangente;
	public $rad;
	public $grad;
	public $vecesPulsado;
	public $deg;
	public function __constructor () {
        parent::__constructor();
		$this->arco=false;
		$this->hiperbolic=false;
		$this->seno='';
		$this->coseno='';
		$this->tangente='';
		$this->rad=false;
		$this->grad=false;
		$this->vecesPulsado=0;
		$this->deg='';
      }
	public function clearMemory () {
        $this->memory =0;
        $this->getResultado();
      } 
	public function getRad(){
		return $this->deg;
	}
	public function putRadianes () {
        if($this->vecesPulsado==0){
			$this->deg='DEG';
			$this->rad=false;
			$this->grad=false;
			$this->vecesPulsado++;
			return $this->deg;
		}
		else if($this->vecesPulsado==1){
			$this->deg='RAD';
			$this->rad=true;
			$this->grad=false;
			$this->vecesPulsado++;
			return $this->deg;
		}
		else{
			$this->deg='GRA';
			$this->rad=false;
			$this->grad=true;
			$this->vecesPulsado=0;;
			return $this->deg;
		}
      }  
	public function saveMemory () {
        $this->memory = $this->display; 
        $this->getResultado();
      }  
	 public function delet () {
        $this->display= substr(strval($this->display),0,strlen($this->display)-1);
        $this->getResultado();
      } 
	 public function factorial () {
        $n = $this->display;
        $total = 1;
        $i;
        for ($i = 1; $i <= $n; $i++) { 
            $total = $total * $i;
        }
        $this->display = $total;
        $this->getResultado();
      }
	  public function resultado(){
        try {
			$this->result = eval("return $this->display;");
			$this->display= $this->result;
			$this->setEnterTrue();
			$this->AlmacenaValor=$this->result;
		
		}
		catch (Exception $e) {
        $this->result = "Error: " .$e->getMessage();
	  }}
	  public function calcularOp($op) {
        $n = $this->display;
        $this->delet();
		print_r($n);
        if($op == 'log')
        $this->display .= log10($n);
        else if($op == 'sin'){
			if($this->rad && !$this->grad){
				if($this->arco==false){
					if($this->hiperbolic==false)
						$this->display = sin(floatval($n)); 
					else
						$this->display = sinh(floatval($n)); 
			}
			else{
				if($this->hiperbolic==false)
					$this->display = asin(floatval($n));
				else
					$this->display = asinh(floatval($n));
			}
		}
		else if(!$this->rad && !$this->grad){
				if($this->arco==false){
					if($this->hiperbolic==false)
						$this->display = sin(floatval($n)* pi()/180); 
					else
						$this->display = sinh(floatval($n)); 
				}
				else{
					if($this->hiperbolic==false)
						$this->display = asin(floatval($n))*180/pi();
				else
					$this->display = asinh(floatval($n));
			}
		}
		else{
			if($this->arco==false){
					if($this->hiperbolic==false)
						$this->display = sin(floatval($n)/63.661977); 
					else
						$this->display = sinh(floatval($n)); 
				}
				else{
					if($this->hiperbolic==false)
						$this->display = asin(floatval($n))*63.661977;
					else
					$this->display = asinh(floatval($n));
				}
		}
		}
        else if($op == 'cos'){
			if($this->rad && !$this->grad){
				if($this->arco==false){
					if($this->hiperbolic==false)
						$this->display = cos(floatval($n)); 
					else
						$this->display = cosh(floatval($n)); 
			}
			else{
				if($this->hiperbolic==false)
					$this->display = acos(floatval($n));
				else
					$this->display = acosh(floatval($n));
			}
		}
		else if(!$this->rad && !$this->grad){
				if($this->arco==false){
					if($this->hiperbolic==false)
						$this->display = cos(floatval($n)* pi()/180); 
					else
						$this->display = cosh(floatval($n)); 
				}
				else{
					if($this->hiperbolic==false)
						$this->display = acos(floatval($n))*180/pi();
				else
					$this->display = acosh(floatval($n));
			}
		}
		else{
			if($this->arco==false){
					if($this->hiperbolic==false)
						$this->display = cos(floatval($n)/63.661977); 
					else
						$this->display = cosh(floatval($n)); 
				}
				else{
					if($this->hiperbolic==false)
						$this->display = acos(floatval($n))*63.661977;
					else
					$this->display = acosh(floatval($n));
				}
		}
		}
        else if($op == 'tan'){
			if($this->rad && !$this->grad){
				if($this->arco==false){
					if($this->hiperbolic==false)
						$this->display = tan(floatval($n)); 
					else
						$this->display = tanh(floatval($n)); 
			}
			else{
				if($this->hiperbolic==false)
					$this->display = atan(floatval($n));
				else
					$this->display = atanh(floatval($n));
			}
		}
		else if(!$this->rad && !$this->grad){
				if($this->arco==false){
					if($this->hiperbolic==false)
						$this->display = tan(floatval($n)* pi()/180); 
					else
						$this->display = tanh(floatval($n)); 
				}
				else{
					if($this->hiperbolic==false)
						$this->display = atan(floatval($n))*180/pi();
				else
					$this->display = atanh(floatval($n));
			}
		}
		else{
			if($this->arco==false){
					if($this->hiperbolic==false)
						$this->display = tan(floatval($n)/63.661977); 
					else
						$this->display = tanh(floatval($n)); 
				}
				else{
					if($this->hiperbolic==false)
						$this->display = atan(floatval($n))*63.661977;
					else
					$this->display = atanh(floatval($n));
				}
		}
		}
        else if($op == 'log')
        $this->display .= log10(floatval($n));
        else if($op == 'e')
        $this->display .= exp(floatval($n));
        $this->getResultado();
      }
	  public function addDisplay($numero){
		 $this->display.=$numero;
		 $this->AlmacenaValor.=$numero;
		}
	   public function funcPi () {
        $this->display .= '*'. round(pi(), 2);
      }
	  public function DoArco(){
		if($this->arco==false){
				$this->arco=true;			
				
			}
			else{
				$this->arco=false;	
				
			}
		
	}
	public function hiperboli(){
	  if ($this->hiperbolic==false){
			
			$this->hiperbolic=true;
			$this->arco=false;
		}
		else{

			$this->hiperbolic=false;
			$this->arco=false;
		}
	}
	public function notacionCientifica(){
		$formato='%e';
		$num=floatval($this->display);
		$this->display=sprintf($formato, $num);
		
	}
	public function getSin(){
		if($this->arco==false && $this->hiperbolic==false) {
			$this->seno='sin';
			return $this->seno;
		}
		else if($this->arco==true && $this->hiperbolic==false) {
			$this->seno='sin-1';
			return $this->seno;
		}
		else if($this->arco==false && $this->hiperbolic==true) {
			$this->seno='sinh';
			return $this->seno;
		}
		else
			$this->seno='sinh-1';
			return $this->seno;
		
	}
	public function getCos(){
		if($this->arco==false && $this->hiperbolic==false) {
			$this->coseno='cos';
			return $this->coseno;
		}
		else if($this->arco==true && $this->hiperbolic==false) {
			$this->coseno='cos-1';
			return $this->coseno;
		}
		else if($this->arco==false && $this->hiperbolic==true) {
			$this->coseno='cosh';
			return $this->coseno;
		}
		else
			$this->coseno='cosh-1';
			return $this->coseno;
		
	}
	public function getTan(){
		if($this->arco==false && $this->hiperbolic==false) {
			$this->tangente='tan';
			return $this->tangente;
		}
		else if($this->arco==true && $this->hiperbolic==false) {
			$this->tangente='tan-1';
			return $this->tangente;
		}
		else if($this->arco==false && $this->hiperbolic==true) {
			$this->tangente='tanh';
			return $this->tangente;
		}
		else
			$this->tangente='tanh-1';
			return $this->tangente;
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
         $calculadora->addDisplay('*'); 
		 
        }
		if(isset($_POST['division'])){
		 $calculadora->setEnterFalse();
         $calculadora->addDisplay('/');  
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
         $calculadora->addDisplay('.');
		 		 
        }
		if(isset($_POST['igual'])){
         $calculadora->resultado();
		 $calculadora->setEnterTrue();		 
        }
		if(isset($_POST['ms'])){
         $calculadora->saveMemory();		 
        }
		if(isset($_POST['mc'])){
          $calculadora->clearMemory();	 
        }
		if(isset($_POST['cuadrado'])){
         $calculadora->addDisplay('**2');	 
        }
		if(isset($_POST['potencia'])){
         $calculadora->addDisplay('**');	 
        }
		if(isset($_POST['potenciade10'])){
         $calculadora->addDisplay('10**');	 
        }
		if(isset($_POST['pi'])){
         $calculadora->funcPi();	 
        }
		if(isset($_POST['factorial'])){
         $calculadora->factorial();	 
        }
		if(isset($_POST['parentesis'])){
         $calculadora->addDisplay($_POST['parentesis']);	 
        }
		if(isset($_POST['seno'])){
         $calculadora->calcularOp('sin');	 
        }
		if(isset($_POST['coseno'])){
         $calculadora->calcularOp('cos');	 
        }
		if(isset($_POST['tangente'])){
         $calculadora->calcularOp('tan');	 
        }
		if(isset($_POST['log'])){
         $calculadora->calcularOp('log');	 
        }
		if(isset($_POST['Exp'])){
         $calculadora->calcularOp('e');	 
        }
		if(isset($_POST['modulo'])){
         $calculadora->addDisplay('%');	 
        }
		if(isset($_POST['shift'])){
         $calculadora->DoArco();	 
        }
		if(isset($_POST['DEG'])){
         	$calculadora->putRadianes(); 
        }
		if(isset($_POST['HYP'])){
         $calculadora->hiperboli();	 
        }
		if(isset($_POST['FE'])){
         $calculadora->notacionCientifica();	 
        }
		if(isset($_POST['delete'])){
         $calculadora->delet();	 
        }
        
    }








echo "
<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <title>Calculadora Cientifica</title>
    <link rel='stylesheet' href='CalculadoraCientifica.css' />
</head>

<body>
    
    <h1>Calculadora Cientifica</h1>
<form action='#' method='post' name='Calculadoraientifica.php'>
	<h2>Calculadora</h2>
	<p>
    <label for='resultado'>Resultado</label>
    <input type='text' id='resultado' readonly disabled value=".$calculadora->getResultado()."  />
    </p>
<p>
<input type='submit' name='DEG' value=".$calculadora->getRad()." />
<input type='submit' name='HYP' value= 'HYP' />
<input type='submit' name='FE' value= 'F-E'  />
</p>
<p>
	<input type='submit' name='mc' value='MC' />
	<input type='submit' name='mrc' value= 'MR' />
	<input type='submit' name='mmenos' value= 'M-' />
	<input type='submit' name='mmas' value= 'M+'  />
	<input type='submit' name='ms' value= 'MS' />
</p>
<p>
	<input type='submit' name='cuadrado' value='x2' />
	<input type='submit' name='potencia' value='xy' />
	<input type='submit' name='seno' value=".$calculadora->getSin()."/>
	<input type='submit' name='coseno' value=".$calculadora->getCos()."/>
	<input type='submit' name='tangente' value=".$calculadora->getTan()."/>
</p>
<p>
	<input type='submit' name='raiz' value='√'  />
	<input type='submit' name='potenciade10' value='10x'  />
	<input type='submit' name='log' value='log'  />
	<input type='submit' name='Exp' value='Exp'  />
	<input type='submit' name='modulo' value='Mod'  />
</p>
<p>
	<input type='submit' name='shift' value='↑' />
	<input type='submit' name='CE' value='CE'  />
	<input type='submit' name='C' value='ON/C' />
	<input type='submit' name='delete' value='<x'  />
	<input type='submit' name='division' value='÷'  />
</p>
<p>
	<input type='submit' name='pi' value='π'  />
	<input type='submit' name='boton7' value='7'  />
	<input type='submit' name='boton8' value='8'  />
	<input type='submit' name='boton9' value='9' />
	<input type='submit' name='multi' value='x' />
</p>
<p>
	<input type='submit' name='factorial' value='n!'  />
	<input type='submit' name='boton4' value='4'  />
	<input type='submit' name='boton5' value='5'  />
	<input type='submit' name='boton6' value='6' />
	<input type='submit' name='menos' value='-'  />
</p>
<p>
	<input type='submit' name='cambiosigno' value='+/-'  />
	<input type='submit' name='boton1' value='1'  />
	<input type='submit' name='boton2' value='2'  />
	<input type='submit' name='boton3' value='3'  />
	<input type='submit' name='mas' value='+'  />
</p>
<p>
	<input type='submit' name='parentesis' value='('  />
	<input type='submit' name='parentesis' value=')'  />
	<input type='submit' name='boton0' value='0'  />
	<input type='submit' name='punto' value=','  /> 
	<input type='submit' name='igual' value='='  />
</p>
</form>
</html> ";
?>