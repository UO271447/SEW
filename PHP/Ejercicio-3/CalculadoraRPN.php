<?php
session_start();
if(!isset($_SESSION['calculadora']))
{
    $_SESSION['calculadora'] = new CalculadoraRPN();
    $calculadora= $_SESSION['calculadora'];
}
else{
    $calculadora= $_SESSION['calculadora'];
}
class CalculadoraRPN {
	protected $display;
	protected $stack;
	protected $memory;
	protected $arco;
	
	public function __constructor(){
      $this->display = '';
      $this->stack = array(); 
	  $this->memory = 0;
	  $this->arco = false;
  }
  public function push($ultimo) {
		print_r($this->display);
        array_unshift($this->stack,$ultimo);  
		print_r($this->stack);        
  }
  public function getResultado(){
     return $this->display;
 }
   public function vacia() {
        return empty($this->stack);
    }
	public function addDisplay($numero) {
		$this->display .= $numero;
	}
   public function pop() {
      if ($this->vacia()) {
          throw new RunTimeException('¡Pila vacía! No se pueden pop elementos');
      } else {
          return array_shift($this->stack);
      }
  }
  public function DoArco() {
      if ($this->arco) {
          $this->arco=false;
		  
      } else {
          $this->arco=true;
      }
  }
  public function sumar(){
	  if(count($this->stack)>1){
		$aux=$this->pop();
		$aux2=$this->pop();
		$var=floatval($aux)+floatval($aux2); 
		$this->push($var);
		$this->repaint();
	  }
	
  }
  public function restar(){
	if(count($this->stack)>1){
    $aux=$this->pop();
    $aux2=$this->pop();
    $var=floatval($aux)-floatval($aux2);
    $this->push($var);
	$this->repaint();
	}
  }
  public function  multiplicar(){
	if(count($this->stack)>1){
    $aux=$this->pop();
    $aux2=$this->pop();
    $var=floatval($aux)*floatval($aux2);
    $this->push($var);
	$this->repaint();
	}

 }
 public function division(){
  if(count($this->stack)>1){
	$aux=$this->pop();
	$aux2=$this->pop();
	$var=floatval($aux2)/floatval($aux);
	$this->push($var);
	$this->repaint();
  }
 }
 public function tangente(){
  if(count($this->stack)>0){
	$aux=$this->pop();
	if($this->arco==false)
		$var=tan($aux);
	else
	  $var=tan($aux);
	$this->push($var);
	$this->repaint();
  }
}
public function logaritmo(){
  if(count($this->stack)>0){
	$aux=$this->pop();
	$var=log10($aux);
	$this->push($var);
	$this->repaint();
  }
}
public function coseno(){
  if(count($this->stack)>0){
	$aux=$this->pop();
	 if($this->arco==false)
	$var=cos($aux);
	else
	  $var=acos($aux);
	$this->push($var);
	$this->repaint();
  }
}
public function seno(){
  if(count($this->stack)>0){
  $aux=$this->pop();
  if($this->arco==false)
	$var=sin($aux);
  else
	  $var=asin($aux);
  $this->push($var);
  $this->repaint();}
}
public function factorial(){
  if(count($this->stack)>0){
	$aux=$this->pop();
	$var=$this->calcularFactorial($aux);
	$this->push($var);
	$this->repaint();}
}
public function calcularFactorial($aux){
	$n = $aux;
    $total = 1;
    $i;
     for ($i = 1; $i <= $n; $i++) { 
          $total = $total * $i;
      }
	  
    return $total;
	
}

public function repaint(){
	$this->display='';
	for($i=count($this->stack);$i>=0;$i--){
		if(isset($this->stack[$i]))
			$this->display .= $this->stack[$i] ."\n";
	}
}
  
  public function C(){
	  $this->display='';
	  $this->stack=array();
  }
  public function raiz(){
	if(count($this->stack)>0){
		$aux=$this->pop();
		$var=$aux**(1/2);
		$this->push($var);
		$this->repaint();
	}
  }
  public function cuadrado(){
	if(count($this->stack)>0){
		$aux=$this->pop();
		$var=$aux**(2);
		$this->push($var);
		$this->repaint();
	}
  }
  public function potencia(){
	if(count($this->stack)>1){
		$aux=$this->pop();
		$aux2=$this->pop();
		$var=$aux2**($aux);
		$this->push($var);
		$this->repaint();
	}
  }
  public function funcPi(){
	if(count($this->stack)>0){
		$aux=$this->pop();
		$var=$aux*pi();
		$this->push($var);
		$this->repaint();
	}
  }
  public function delet(){
	if(count($this->stack)>0){
		$this->pop();
		$this->repaint();
	}
  }

	 public function enter(){
			
			$actual= substr($this->display,-1);
			if($actual!="" && $actual!="\n"){
				$last=array();
				$last= explode("\n", $this->display);
				$ultimo=end($last);
				$this->push($ultimo);
				
				$this->display .= "\n";
			}
		}
		public function getSin(){
		if($this->arco==false) {
			$this->seno='sin';
			return $this->seno;
		}
		else{
			$this->seno='sin-1';
			return $this->seno;
		}	
	}
	public function getCos(){
		if($this->arco==false) {
			$this->coseno='cos';
			return $this->coseno;
		}
		else{
			$this->coseno='cos-1';
			return $this->coseno;
		}	
	}
	public function getTan(){
		if($this->arco==false) {
			$this->tangente='tan';
			return $this->tangente;
		}
		else{
			$this->tangente='tan-1';
			return $this->tangente;
		}
	}
		
}

if (count($_POST)>0) 
    {   
        if(isset($_POST['C'])){
         $calculadora->C(); 
        }
		if(isset($_POST['cambiosigno'])){
         $calculadora->cambioSigno(); 
        }
		if(isset($_POST['raiz'])){
         $calculadora->raiz(); 
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
         $calculadora->multiplicar(); 
		 
        }
		if(isset($_POST['division'])){
         $calculadora->division();  
        }
		if(isset($_POST['menos'])){
         $calculadora->restar(); 
		 
		}
		if(isset($_POST['mas'])){
         $calculadora->sumar();		 
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
         $calculadora->addDisplay('.');
		 		 
        }
		if(isset($_POST['enter'])){
         $calculadora->enter();	 
        }
		if(isset($_POST['ms'])){
         $calculadora->saveMemory();		 
        }
		if(isset($_POST['mc'])){
          $calculadora->clearMemory();	 
        }
		if(isset($_POST['cuadrado'])){
         $calculadora->cuadrado();	 
        }
		if(isset($_POST['potencia'])){
         $calculadora->potencia();	 
        }
		if(isset($_POST['pi'])){
         $calculadora->funcPi();	 
        }
		if(isset($_POST['factorial'])){
         $calculadora->factorial();	 
        }
		if(isset($_POST['seno'])){
         $calculadora->seno();	 
        }
		if(isset($_POST['coseno'])){
         $calculadora->coseno();	 
        }
		if(isset($_POST['tangente'])){
         $calculadora->tangente();	 
        }
		if(isset($_POST['log'])){
         $calculadora->logaritmo();	 
        }
		if(isset($_POST['shift'])){
         $calculadora->DoArco();	 
        }
		if(isset($_POST['delete'])){
         $calculadora->delet();	 
        }
        
    }
echo"
<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <title>Calculadora RPN</title>
    <link rel='stylesheet' href='CalculadoraRPN.css' />
</head>

<body>
    
    <h1>Calculadora RPN</h1>
    
<form action='#' method='post' name='CalculadoraRPN.php'>
	<h2> Calculadora </h2>
	<p>
    <label for='resultado'>Resultado</label>
    <textarea name='textarea' rows='10' cols='50' id='resultado' readonly disabled >" . $calculadora->getResultado() . "</textarea>
    </p>
<p>
	<input type='submit' name='mc' value='MC' />
	<input type='submit' name='mrc' value= 'MR' />
	<input type='submit' name='mmenos' value= 'M-'  />
	<input type='submit' name='mmas' value= 'M+'  />
	<input type='submit' name='ms' value= 'MS' />
</p>
<p>
	<input type='submit' name='cuadrado' value='x2' />
	<input type='submit' name='potencia' value='xy'  />
	<input type='submit' name='seno' value=".$calculadora->getSin()." />
	<input type='submit' name='coseno' value=".$calculadora->getCos()."  />
	<input type='submit' name='tangente' value=".$calculadora->getTan()." />
</p>
<p>
	<input type='submit' name='raiz' value='√'  />
	<input type='submit' name='log' value='log' />
	<input type='submit' name='C' value='C' />
	<input type='submit' name='delete' value='<x' />
	<input type='submit' name='cambiosigno' value='±'  />
</p>
<p>
	<input type='submit' name='pi' value='π'  />
	<input type='submit' name='boton7' value='7'  />
	<input type='submit' name='boton8' value='8'  />
	<input type='submit' name='boton9' value='9' />
	<input type='submit' name='division' value='÷'  />
</p>
<p>
	<input type='submit' name='factorial' value='n!'  />
	<input type='submit' name='boton4' value='4'  />
	<input type='submit' name='boton5' value='5'  />
	<input type='submit' name='boton6' value='6' />
	<input type='submit' name='multi' value='x' />

</p>
<p>
	<input type='submit' name='shift' value='↑' />
	<input type='submit' name='boton1' value='1'  />
	<input type='submit' name='boton2' value='2'  />
	<input type='submit' name='boton3' value='3'  />
	<input type='submit' name='menos' value='-'  />
</p>
<p>
	<input type='submit' name='boton0' value='0'  />
	<input type='submit' name='punto' value=','  /> 
	<input type='submit' name='enter' value='ENTER' />
	<input type='submit' name='mas' value='+'  />
</p>
</form>
</html>";
?>