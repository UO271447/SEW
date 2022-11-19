class CalculadoraRPN{
    constructor(){
        this.pantalla = "";
        this.memory = 0;
		this.stack = new Array();
		this.arco=false;
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
			if(event.keyCode == 37){
                this.delet();
            }
			if(event.keyCode == 38){
                this.Doarco();
            }
            if(event.keyCode == 13){
                this.enter();
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
			if(event.key=='w'){
				this.potencia();
			}
			if(event.key=='y'){
				this.potenciade10();
			}
			if(event.key=='t'){
				this.calcularoperacion("tan");
			}
			if(event.key=='l'){
				this.calcularoperacion("log");
			}
			if(event.key=='i'){
				this.calcularoperacion("sin");
			}
			if(event.key=='o'){
				this.calcularoperacion("cos");
			}
            if(event.key=='f'){
				this.factorial();
			}
			if(event.key=='j'){
				this.clearMemory();
			}
			if(event.key=='g'){
				this.saveMemory();
			}
			if(event.key=='x'){
				this.pi();
			}
            
          });
    }
    
    sumar(){
       if(this.stack.length>=2){
		   var op1=this.stack.pop();
		   var op2=this.stack.pop();
		   var resultado=op1+op2;
		   this.stack.push(resultado);
		   this.repaint();
	   }
    }
	Doarco(){
		if(!this.arco){
				this.arco=true;	
				document.getElementsByTagName('input')[7].value="arcsin";
				document.getElementsByTagName('input')[8].value="arccos";
				document.getElementsByTagName('input')[9].value="arctan";
			}
		else{
			this.arco=false;
			document.getElementsByTagName('input')[7].value="sin";
			document.getElementsByTagName('input')[8].value="cos";
			document.getElementsByTagName('input')[9].value="tan";
		}
		}
    digitos(disp){
        this.pantalla += disp;
         document.getElementsByTagName('textarea')[0].value = this.pantalla;}
     
	 repaint(){
		 this.pantalla = "";
		 for (let i = 0; i < this.stack.length; i++) {
			 this.pantalla+=this.stack[i] + "\n";
			}
			document.getElementsByTagName("textarea")[0].value= this.pantalla; 
		 }
	 
     punto(){
        this.pantalla += ".";
        document.getElementsByTagName('textarea')[0].value = this.pantalla;}
	   
     
     restar(){
        if(this.stack.length>=2){
		   var op1=this.stack.pop();
		   var op2=this.stack.pop();
		   var resultado=op2-op1;
		   this.stack.push(resultado);
		   this.repaint();
	   }

     }
     multiplicacion(){
        if(this.stack.length>=2){
		   var op1=this.stack.pop();
		   var op2=this.stack.pop();
		   var resultado=op1*op2;
		   this.stack.push(resultado);
		   this.repaint();
	   }
     }
    division(){
        if(this.stack.length>=2){
		   var op1=this.stack.pop();
		   var op2=this.stack.pop();
		   var resultado=op2/op1;
		   this.stack.push(resultado);
		   this.repaint();
	   }
     }
     enter(){
			var actual= this.pantalla.charAt(this.pantalla.length-1)
			if(actual!="" && actual!="\n"){
				var last=new Array();
				last= this.pantalla.split("\n");
				var ultimo=last[last.length-1];
				this.stack.push(parseFloat(ultimo));
				this.pantalla += "\n";
				document.getElementsByTagName('textarea')[0].value=this.pantalla;
			}
		}
    borrar(){
        this.pantalla = "";
		this.stack= [];
        document.getElementsByTagName('textarea')[0].value  = this.pantalla;
    }
    
    mMas(){
		var last=new Array();
		last= this.pantalla.split("\n");
		var ultimo=last[last.length-1];
        this.memory += Number(ultimo);
    }
    
    mMenos(){
       var last=new Array();
	   last= this.pantalla.split("\n");
	   var ultimo=last[last.length-1];
       this.memory -= Number(ultimo);
    }
    
    mrc(){
		this.pantalla+=this.memory;
        document.getElementsByTagName('textarea')[0].value  = this.pantalla; 
    }
	cambiosigno(){
		if(this.stack.length>0){
            var n = this.stack.pop();
            this.stack.push(n*-1);
            this.repaint();
        }
    }
	raiz(){
		var n= this.stack.pop();
		var sqrt=Math.pow(n,1/2);
		this.stack.push(sqrt);
		this.repaint();
	}
	coseno(){
        if(this.stack.length>0){
            var n = this.stack.pop();
            var coseno = Math.cos(n);
            this.stack.push(coseno);
            this.repaint();
        }
    }
	seno(){
        if(this.stack.length>0){
            var n = this.stack.pop();
            var seno = Math.sin(n);
            this.stack.push(seno);
            this.repaint();
        }
    }
	tangente(){
        if(this.stack.length>0){
            var n = this.stack.pop();
            var tangente = Math.tan(n);
            this.stack.push(tangente);
            this.repaint();
        }
    }
	arcocosin(){
        if(this.stack.length>0){
            var n = this.stack.pop();
            var arcocoseno = Math.acos(n);
            this.stack.push(arcocoseno);
            this.repaint();
			this.Doarco();
        }
    }
	arcosin(){
        if(this.stack.length>0){
            var n = this.stack.pop();
            var arcoseno = Math.asin(n);
            this.stack.push(arcoseno);
            this.repaint();
			this.Doarco();
        }
    }
	arcotan(){
        if(this.stack.length>0){
            var n = this.stack.pop();
            var arcotangente = Math.atan(n);
            this.stack.push(arcotangente);
            this.repaint();
			this.Doarco();
        }
    }
	logaritmo(){
        if(this.stack.length>0){
            var n = this.stack.pop();
            var arcotangente = Math.log10(n);
            this.stack.push(arcotangente);
            this.repaint();
        }
    }
	
	delet(){
		if(this.stack.length>0){
			this.stack.pop();
            this.repaint();
		}	
	}
	cuadrado(){
		if(this.stack.length>0){
            var n = this.stack.pop();
            this.stack.push(n*n);
            this.repaint();
        }
		
	}
	potencia(){
		if(this.stack.length>0){
           var op1=this.stack.pop();
		   var op2=this.stack.pop();
		   var resultado=op2**op1;
		   this.stack.push(resultado);
		   this.repaint();
        }
		
	}
	
	pi(){
		if(this.stack.length>0){
           var op1=this.stack.pop();
		   var resultado=op1*Math.PI.toPrecision(4);
		   this.stack.push(resultado);
		   this.repaint();
        }
		
		
	}
	factorial(){
		if(this.stack.length>0){
           var n=this.stack.pop();
		   var fact=1;
		   for(var i=1;i<=n;i++){
			   fact*=i;
		   }
		   this.stack.push(fact);
		   this.repaint();
        }
		
	}
	calcularoperacion(op){
		this.nx=Number(this.AlmacenaValor)
		if(op == 'log' ){
			this.logaritmo();
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
				this.tangente();
			}
			else{
				this.arcotan();	
			}
		}
		this.enter=false;
	}
	clearMemory () {
    this.memory = '';
  }

  saveMemory () {
	var last=new Array();
	last= this.pantalla.split("\n");
	var ultimo=last[last.length-1];
    this.memory = parseFloat(ultimo);
  }
	
}
class CalculadoraEspecializada extends CalculadoraRPN {
	constructor () {
		super()
		this.med=0;
		this.varianz=0;
		document.addEventListener('keydown',(event) => {
			if(event.key=='d'){
				this.desviaciontipica();
			}  
			if(event.key=='v'){
				this.varianza();
			}
			if(event.key=='a'){
				this.media();
			} 
			if(event.key=='b'){
				this.moda();
			} 
			if(event.key=='h'){
				this.mediana();
			}
				
          });
	}
	
	
	media(){
		var valor=0;
		if(this.stack.length>0){
			for(var i=0;i<this.stack.length;i++){
				valor+=this.stack[i];
			}
			this.pantalla=Number(valor/this.stack.length)+"\n";
			document.getElementsByTagName('textarea')[0].value  = this.pantalla;
		}
			this.med=valor/this.stack.length;
	}
	moda(){
		var valor=0;
		if(this.stack.length>0){
			var masVeces1=0;
			var masVeces2=0;
			var posicion=0;
			for(var i=posicion;i<this.stack.length;i++){
				for(var j=0;j<this.stack.length;j++){
					if(this.stack[posicion]==this.stack[j]){
						masVeces2++;		
					}
				}
				if(masVeces1<masVeces2){
					masVeces1=masVeces2;
					masVeces2=0;
					valor=this.stack[posicion];
				}
				posicion++;
			}
			this.stack=[];
			this.pantalla=Number(valor)+"\n";
			this.stack.push(Number(valor));
			document.getElementsByTagName('textarea')[0].value  = this.pantalla;
		}	
	}
	mediana(){
		var pilaOrdenada= this.stack;
		pilaOrdenada= pilaOrdenada.sort();
		this.stack=[];
		this.pantalla= Number(pilaOrdenada[(pilaOrdenada.length-1)/2])+"\n";
		this.stack.push(Number(this.pantalla));
		document.getElementsByTagName('textarea')[0].value  = this.pantalla;
	}
	varianza(){
		this.varianz=0;
		this.media();
		for(var i = 0 ; i<this.stack.length; i++){
			var range=0;
			range = Math.pow(this.stack[i] - this.med,2);
			this.varianz = this.varianz + range;
			}
		this.varianz = this.varianz / this.stack.length;
		this.pantalla=Number(this.varianz)+"\n";
		this.stack=[];
		this.stack.push(Number(this.varianz));
		document.getElementsByTagName('textarea')[0].value  = this.pantalla;
	}
	desviaciontipica(){
		this.varianza();
		var desviacion= Math.pow(this.varianz,1/2);
		this.pantalla=Number(desviacion)+"\n";
		this.stack=[];
		this.stack.push(Number(desviacion));
		document.getElementsByTagName('textarea')[0].value  = this.pantalla;
	}
	
}
const calculadoraEspecializada = new CalculadoraEspecializada();