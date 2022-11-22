class Calculadora{
    constructor(){
        this.pantalla = "";
        this.memory = 0;
        this.enter=false;
		this.operacion="";
		this.nx=0;
		this.simbolo="";
		this.AlmacenaValor="";
		this.presionaTeclas();
		
    }
	presionaTeclas(){
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
		//Sirve para poder hacer pej: 3+3*2 = 6*2
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
		if(!isNaN(this.nx)){
			this.nx=-this.nx;
			this.pantalla = String(this.nx);
			this.AlmacenaValor = String(this.nx);
			this.nx=0;
			document.getElementsByTagName('input')[0].value = Number(this.pantalla);
			this.enter=false;
		}
		else{
			/*Si no es solo un numero o numeros y contiene algun simbolo como * + ...*/
			var lengthn=this.getNumber();
			var numero = this.pantalla.substr(this.pantalla.length-lengthn,this.pantalla.length);	
			var numero= -1*numero;
			var rest = this.pantalla.substr(0,this.pantalla.length-lengthn);
			if(rest.charAt(rest.length-1)=="-" && isNaN(rest.charAt(rest.length-2))){
				numero=numero*-1
				rest=rest.substr(0,rest.length-1);
			}
			this.pantalla=rest+numero;
			this.AlmacenaValor =this.pantalla;
			document.getElementsByTagName('input')[0].value = this.pantalla;
			this.enter=false;
		}
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
		 this.pantalla+='%';
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
	CE () {
        this.memory = "";
    }
}


var calculadora = new Calculadora();