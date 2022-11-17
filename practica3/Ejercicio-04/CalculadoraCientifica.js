class Calculadora{
    constructor(){
        this.pantalla = "";
        this.memory = 0;
        this.enter=false;
		this.operacion="";
		this.nx=0;
		this.simbolo="";
		this.AlmacenaValor="";
		document.addEventListener('keydown',(event) => {
            if(Number(event.key)){
                this.digitos(event.key);
            }
			if(event.key=='0'){
				this.digitos(event.key);
			}
            if(event.key == '+'){
                this.sumar();
            }
            if(event.key == '-'){
                this.restar();
            }
            if(event.key == '*'){
                this.multiplicacion();
            }
            if(event.key == '/'){
                this.division();
            }
            if(event.keyCode == 8){
                this.borrar();
            }
            if(event.keyCode == 13){
                this.igual();
            }
            if(event.key == '.'){
                this.punto();
            }
            if(event.key == 'r'){
                this.mrc();
            }
            if(event.key == 'n'){
                this.mMenos();
            }
            if(event.key == 'm'){
                this.mMas();
            }
			 if(event.key == 's'){
                this.raiz();
            }
			if(event.key == 'c'){
                this.cambiosigno();
            }
			if(event.key == 'p'){
                this.porcent();
            }
            
            
          });
    }
    
    sumar(){
       this.pantalla += "+"; 
	   this.AlmacenaValor+= "+";
       document.getElementsByTagName('input')[0].value = this.pantalla;
       this.enter=false;
    }
    digitos(disp){
        if(this.enter){
		    this.pantalla=String(Number(disp));
			this.AlmacenaValor=this.pantalla; 
             document.getElementsByTagName('input')[0].value = this.pantalla;
            this.enter=false;
        }
        else{
		if(this.pantalla.charAt(this.pantalla.length - 1)=="+"||this.pantalla.charAt(this.pantalla.length - 1)=="-"
			||this.pantalla.charAt(this.pantalla.length - 1)=="*"
			||this.pantalla.charAt(this.pantalla.length - 1)=="/"){
			this.simbolo=this.pantalla.charAt(this.pantalla.length - 1);
			this.AlmacenaValor=this.AlmacenaValor.substr(0,this.AlmacenaValor.length-1);
			this.AlmacenaValor=eval(this.AlmacenaValor)+this.simbolo;
			this.pantalla=this.AlmacenaValor;
			
		}
		this.nx=Number(disp);
        this.pantalla += String(this.nx); 
		this.AlmacenaValor+= Number(disp);
         document.getElementsByTagName('input')[0].value = this.pantalla;}
     }
     punto(){
        this.pantalla += "."; 
		this.AlmacenaValor+= ".";
         document.getElementsByTagName('input')[0].value = this.pantalla;
        this.enter=false;
     }
     restar(){
        this.pantalla += "-"; 
		this.AlmacenaValor+= "-";
         document.getElementsByTagName('input')[0].value = this.pantalla;
        this.enter=false;

     }
     multiplicacion(){
        this.pantalla += "*";
		this.AlmacenaValor+= "*";
         document.getElementsByTagName('input')[0].value = this.pantalla;
        this.enter=false;
     }
    division(){
        this.pantalla += "/";
		this.AlmacenaValor+= "/";	
         document.getElementsByTagName('input')[0].value = this.pantalla;
        this.enter=false;
     }
     igual(){
		//AQUI ALMACENA EL VALOR QUE SE HA SUMADO RESTADO ...
		var lengthn=this.getNumber();
		if(lengthn>0){
			var numero = this.pantalla.substr(this.pantalla.length-lengthn,this.pantalla.length);
			var rest = this.pantalla.substr(0,this.pantalla.length-lengthn);
			var signo= rest.charAt(rest.length - 1);
			this.simbolo=signo;
			this.operacion=numero;
		}
		//SI ES LA PRIMERA VEZ QUE SE DA AL BOTON "="
		if(this.enter==false){
			this.pantalla= eval(this.AlmacenaValor);
			try { 
				 document.getElementsByTagName('input')[0].value = Number(this.pantalla);
				this.enter=true;
			}
			catch(err) {
			 document.getElementsByTagName('input')[0].value = "Error = " + err;
			
			}}
		//SI NO ES LA PRIMERA VEZ QUE SE DA AL BOTON "="
		else{
			this.pantalla= eval(this.pantalla+this.simbolo+this.operacion);
			this.AlmacenaValor=this.pantalla;
			 document.getElementsByTagName('input')[0].value = Number(this.pantalla);
		}
		}
    borrar(){
        this.pantalla = "";
		this.AlmacenaValor= "";
         document.getElementsByTagName('input')[0].value  = "";
        this.enter=false;
    }
    
    mMas(){
        this.memory += Number( parseInt( document.getElementsByTagName('input')[0].value ));
    }
    
    mMenos(){
        this.memory -= Number(parseInt( document.getElementsByTagName('input')[0].value ));
    }
    
    mrc(){
        document.getElementsByTagName('input')[0].value  = this.memory; 
    }
	cambiosigno(){
		this.nx=Number(this.pantalla);
		this.nx=-this.nx;
		this.pantalla = String(this.nx);
		this.AlmacenaValor = String(this.nx);
		this.nx=0;
		 document.getElementsByTagName('input')[0].value = Number(this.pantalla);
		this.enter=false;
    }
	raiz(){
		this.nx=Number(this.pantalla);
		this.pantalla = '√'+Number(this.pantalla);
		 document.getElementsByTagName('input')[0].value  = this.pantalla;
		this.AlmacenaValor = eval(this.nx**(1/2)); 
		this.enter=false;
	}
	porcent() { 
         var lengthn=this.getNumber();
		 var numero = this.pantalla.substr(this.pantalla.length-lengthn,this.pantalla.length);		 
		 var rest = this.pantalla.substr(0,this.pantalla.length-lengthn);
		 var op1 = this.pantalla.substr(0,this.pantalla.length-lengthn-1);
		 var signo= rest.charAt(rest.length - 1);
		 this.pantalla+='%'
		 document.getElementsByTagName('input')[0].value = this.pantalla;
		 numero=numero/100; //dividir por 100 el número
		 if(signo=="+" || signo=="-")
			 this.AlmacenaValor=op1+signo+op1+"*"+numero;
		 else
			this.AlmacenaValor=rest+numero; 
		 this.pantalla=this.AlmacenaValor;
		
         }

	getNumber(){
		//RETORNA LA LONGITUD DE UN OPERANDO2
        var oper = false;
        for (let i = 0; i < this.pantalla.length; i++) {
            if(this.pantalla.charAt(i) == "+" || this.pantalla.charAt(i) == "-" || this.pantalla.charAt(i) == "*" || this.pantalla.charAt(i) == "/"){
                oper = true;
                break;
            }
        }
        if(oper){
            var c = 0;
            for(let i=this.pantalla.length-1; i >= 0; i--){  
                if(!isNaN(this.pantalla.charAt(i))|| this.pantalla.charAt(i)=="."){
                    c++;
                }else{
                    return c;
                }
            }
        }else{
            return this.pantalla.length;
        }
    }
}

class CalculadoraCientifica extends Calculadora {
	
	 constructor () {
		super()
		this.arco=false;
		this.rad=false;
		this.hiperbolic=false;
		document.addEventListener('keydown',(event) => {
            if(event.key=='d'){
				this.putRadianes();
			}
			if(event.key=='h'){
				this.hiperboli();
			}
			if(event.key=='f'){
				this.notacionCientifica();
			}
			if(event.key=='i'){
				this.calcularoperacion("sin");
			}
			if(event.key=='o'){
				this.calcularoperacion("cos");
			}
			if(event.key=='t'){
				this.calcularoperacion("tan");
			}
			if(event.key=='l'){
				this.calcularoperacion("log");
			}
			if(event.key=='e'){
				this.exponente();
			}
			if(event.key=='q'){
				this.cuadrado();
			}
			if(event.key=='w'){
				this.potencia();
			}
			if(event.key=='y'){
				this.potenciade10();
			}
			if(event.key=='u'){
				this.modulo();
			}
			if(event.keyCode==38){
				this.Doarco();
			}
			if(event.keyCode==37){
				this.eliminarUltimoCaracter();
			}
			if(event.key=='x'){
				this.pi();
			}
			if(event.key=='¡'){
				this.factorial();
			}
			if(event.key=='b'){
				this.parentesis('(');
			}
			if(event.key=='v'){
				this.parentesis(')');
			}
			if(event.key=='j'){
				this.clearMemory();
			}
			if(event.key=='g'){
				this.saveMemory();
			}
			
		});
    }
	notacionCientifica () {
    var n = document.getElementsByTagName('input')[0].value;
    document.getElementsByTagName('input')[0].value= parseFloat(n).toExponential(2);
  }
  
  digitos(disp){
        if(this.enter){
            this.pantalla = Number(disp);
			this.AlmacenaValor= Number(disp);			
            document.getElementsByTagName('input')[0].value = this.pantalla;
            this.enter=false;
        }
        else{
		this.nx=Number(disp);
        this.pantalla += String(this.nx);
		this.AlmacenaValor+= String(this.nx);
        document.getElementsByTagName('input')[0].value= this.pantalla;}
     }
	 igual(){
        this.pantalla= eval(this.AlmacenaValor);
        try { 
			document.getElementsByTagName('input')[0].value= Number(this.pantalla);
			this.enter=true;
        }
        catch(err) {
         document.getElementsByTagName('input')[0].value = "Error = " + err;
    }}
	factorial () {
		const n = Number(this.pantalla);
		var total = 1;
		var i;
		for (i = 1; i <= n; i++) {
			total = total * i;
        }
		this.pantalla=this.pantalla+'!';
		document.getElementsByTagName('input')[0].value = this.pantalla;
		this.AlmacenaValor = total;
    }
	
	Doarco(){
		if(!this.arco){
			if(!this.hiperbolic){
				this.arco=true;	
				document.getElementsByTagName('input')[11].value="arcsin";
				document.getElementsByTagName('input')[12].value="arccos";
				document.getElementsByTagName('input')[13].value="arctan";
			}
			else{
				this.arco=true;	
				document.getElementsByTagName('input')[11].value="arcsinh";
				document.getElementsByTagName('input')[12].value="arccosh";
				document.getElementsByTagName('input')[13].value="arctanh";
			}
		}
	}
	pi () {
    this.pantalla +='π' ;
	document.getElementsByTagName('input')[0].value = this.pantalla;
	this.AlmacenaValor +=  Math.PI.toPrecision(4);
    
	}
	notacionCientifica () {
    var n = document.getElementsByTagName('input')[0].value;
    document.getElementsByTagName('input')[0].value= parseFloat(n).toExponential(2);
		}
	parentesis (parentes) {
    this.pantalla += parentes;
	this.AlmacenaValor += parentes;
    document.getElementsByTagName('input')[0].value = this.pantalla;
	} 
    CE () {
        this.valorEnMemoria = "";
    }
	
	putSensHiperbolic(){
		if(this.hiperbolic){
			this.arco=false;
			
			document.getElementsByTagName('input')[11].value="sinh";
			document.getElementsByTagName('input')[12].value="cosh";
			document.getElementsByTagName('input')[13].value="tanh";
		}
		else{
			this.arco=false;
			document.getElementsByTagName('input')[11].value="sin";
			document.getElementsByTagName('input')[12].value="cos";
			document.getElementsByTagName('input')[13].value="tan";
		}
		
	}
	
	seno(){
			if(this.rad){
					if(this.hiperbolic){
						this.pantalla = "sinh(" + this.AlmacenaValor + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.sinh(eval(this.AlmacenaValor)));	
					}
					else{
						this.pantalla = "sin(" + this.AlmacenaValor + ")";
						document.getElementsByTagName('input')[0].value= this.pantalla;
						this.AlmacenaValor = String(Math.sin(eval(this.AlmacenaValor)));
					}
				}
				else{
					if(this.hiperbolic){
						this.pantalla = "sinh(" + this.AlmacenaValor + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.sinh(eval(this.AlmacenaValor)*Math.PI/180));
					}
					else{
						this.pantalla = "sin(" + this.AlmacenaValor + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.sin(eval(this.AlmacenaValor)*Math.PI/180));
					}
				}	
	}
	arcosin() {
		if(this.rad){
					if(this.hiperbolic){
						this.pantalla = "arcsinh(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value= this.pantalla;
						this.AlmacenaValor = String(Math.asinh(eval(this.AlmacenaValor)));
					}
					else{
						this.pantalla = "arcsin(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.asin(eval(this.AlmacenaValor)));
					}
				}
				else{
					if(this.hiperbolic){
						this.pantalla = "arcsinh(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value= this.pantalla;
						this.AlmacenaValor = String(Math.asinh(eval(this.AlmacenaValor)*Math.PI/180));
					}
					else{
						this.pantalla = "arcsin(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.asin(eval(this.AlmacenaValor)*Math.PI/180));
					}
				}
				this.putSensHiperbolic();
	}
  coseno(){
	  if(this.rad){
					if(this.hiperbolic){
						this.pantalla = "cosh(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.cosh(eval(this.AlmacenaValor)));
					}
					else{
						this.pantalla = "cos(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.cos(eval(this.AlmacenaValor)));	
					}
				}
				else{
					if(this.hiperbolic){
						this.pantalla = "cosh(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value= this.pantalla;
						this.AlmacenaValor = String(Math.cosh(eval(this.AlmacenaValor)*Math.PI/180));
					}
					else{
						this.pantalla = "cos(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.cos(eval(this.AlmacenaValor)*Math.PI/180));
					}
				}
			}
	arcocosin(){
		if(this.rad){
					if(this.hiperbolic){	
						this.pantalla = "arccosh(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.acosh(eval(this.AlmacenaValor)));	
					}
					else{
						this.pantalla = "arccos(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.acos(eval(this.AlmacenaValor)));
					}
				}
				else{
					if(this.hiperbolic){
						this.pantalla = "arccosh(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.acosh(eval(this.AlmacenaValor)*Math.PI/180));
					}
					else{
						this.pantalla = "arccos(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.acos(eval(this.AlmacenaValor)*Math.PI/180));
				
					}}
				this.putSensHiperbolic();
		
	}
	tan(){
		if(this.rad){
					if(this.hiperbolic){
						this.pantalla = "tanh(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.tanh(eval(this.AlmacenaValor)));
					}
					else{
						this.pantalla = "tan(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value= this.pantalla;
						this.AlmacenaValor = String(Math.tan(eval(this.AlmacenaValor)));
					}
				}
				else{
					if(this.hiperbolic){
						this.pantalla = "tanh(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.tanh(eval(this.AlmacenaValor)*Math.PI/180));
					}
					else{
						this.pantalla = "tan(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.tan(eval(this.AlmacenaValor)*Math.PI/180));
					}
				}	
	}
	arcotan(){
		if(this.rad){
					if(this.hiperbolic){
						this.pantalla = "arctanh(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.atanh(eval(this.AlmacenaValor)));
					}
					else{
						this.pantalla = "arctan(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.atan(eval(this.AlmacenaValor)));
					}
				}
				else{
					if(this.hiperbolic){
						this.pantalla = "arctanh(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.atanh(eval(this.AlmacenaValor)*Math.PI/180));
					}
					else{
						this.pantalla = "arctan(" + eval(this.AlmacenaValor) + ")";
						document.getElementsByTagName('input')[0].value = this.pantalla;
						this.AlmacenaValor = String(Math.atan(eval(this.AlmacenaValor)*Math.PI/180));
					}
				}
				this.putSensHiperbolic();	
	}
  calcularoperacion(op){
		this.nx=Number(this.AlmacenaValor)
		if(op == 'log' ){
			this.pantalla = "log(" + this.pantalla + ")";
			document.getElementsByTagName('input')[0].value = this.pantalla;
			this.AlmacenaValor = String(Math.log10(eval(this.AlmacenaValor)));
		}
		else if(op == 'sin'){
			if(!this.arco){
				this.seno();
			}
			else{
				this.arcosin();
			}
		}
		else if(op == 'cos'){
			if(!this.arco){
				this.coseno();
			}
			else{
				this.arcocosin();
			}
		}
		else if(op == 'tan'){
			if(!this.arco){		
				this.tan();
			}
			else{
				this.arcotan();	
			}
		}
		this.enter=false;
	}
	potenciade10(){
		this.pantalla += '*10**';
		this.AlmacenaValor += '*10**';
		document.getElementsByTagName('input')[0].value = this.pantalla;
		this.enter=false;
	}
	
	exponente(){
		this.pantalla += '*10**';
		this.AlmacenaValor += '*10**';
		document.getElementsByTagName('input')[0].value = this.pantalla;
		this.enter=false;
	}
	modulo(){
		this.pantalla += '%';
		document.getElementsByTagName('input')[0].value = this.pantalla;
		this.AlmacenaValor += '%';
		this.enter=false;
	}
	cuadrado(){
		this.pantalla += '**2';
		this.AlmacenaValor += '**2';
		this.AlmacenaValor =eval(this.AlmacenaValor );
		document.getElementsByTagName('input')[0].value = this.pantalla;
		this.enter=false;
	}
	potencia(){
		this.pantalla += '**';
		this.AlmacenaValor += '**';
		document.getElementsByTagName('input')[0].value = this.pantalla;
		this.enter=false;
	}
	 eliminarUltimoCaracter () {
		this.pantalla = this.pantalla.toString().substring(0, this.pantalla.length - 1);
		this.AlmacenaValor = this.pantalla;
		document.getElementsByTagName('input')[0].value = this.pantalla;
		 
  }
  clearMemory () {
    super.memory = '';
  }

  saveMemory () {
    super.memory = parseFloat(document.getElementsByTagName('input')[0].value);
  }
	
	putRadianes(){
		if (this.rad==false){
			document.getElementsByTagName('input')[1].value="RAD";
			this.rad=true;
		}
		else{
			document.getElementsByTagName('input')[1].value="DEG";
			this.rad=false;
		}
	}
	hiperboli(){
		if (this.hiperbolic==false){
			document.getElementsByTagName('input')[11].value="sinh";
			document.getElementsByTagName('input')[12].value="cosh";
			document.getElementsByTagName('input')[13].value="tanh";
			this.hiperbolic=true;
			this.arco=false;
		}
		else{
			document.getElementsByTagName('input')[11].value="sin";
			document.getElementsByTagName('input')[12].value="cos";
			document.getElementsByTagName('input')[13].value="tan";
			this.hiperbolic=false;
			this.arco=false;
		}
	}
    
}
const calculadoraCientifica = new CalculadoraCientifica();

