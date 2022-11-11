class Calculadora{
    constructor(){
        this.pantalla = "";
        this.memory = 0;
        this.enter=false;
		this.nx=0;
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
            
            
          });
    }
    
    sumar(){
       this.pantalla += "+"; 
       document.getElementById('resultado').value = this.pantalla;
       this.enter=false;
    }
    digitos(disp){
        if(this.enter){
            this.pantalla = Number(disp); 
            document.getElementById('resultado').value = this.pantalla;
            this.enter=false;
        }
        else{
		this.nx=Number(disp)
        this.pantalla += String(this.nx); 
        document.getElementById('resultado').value = this.pantalla;}
     }
     punto(){
        this.pantalla += "."; 
        document.getElementById('resultado').value = this.pantalla;
        this.enter=false;
     }
     restar(){
        this.pantalla += "-"; 
        document.getElementById('resultado').value = this.pantalla;
        this.enter=false;

     }
     multiplicacion(){
        this.pantalla += "*"; 
        document.getElementById('resultado').value = this.pantalla;
        this.enter=false;
     }
    division(){
        this.pantalla += "/"; 
        document.getElementById('resultado').value = this.pantalla;
        this.enter=false;
     }
     igual(){
        this.pantalla= eval(this.pantalla)
        try { 
        document.getElementById('resultado').value = Number(this.pantalla);
        this.enter=true;
        }
        catch(err) {
         document.getElementById("resultado").value = "Error = " + err;
    }}
    borrar(){
        this.pantalla = "";
        document.getElementById('resultado').value = "";
        this.enter=false;
    }
    
    mMas(){
        this.memory += Number( parseInt(document.getElementById('resultado').value));
    }
    
    mMenos(){
        this.memory -= Number(parseInt(document.getElementById('resultado').value));
    }
    
    mrc(){
       document.getElementById('resultado').value = this.memory; 
    }
	cambiosigno(){
		this.nx=Number(this.pantalla);
		this.nx=-this.nx;
		this.pantalla = String(this.nx);
		this.nx=0;
		document.getElementById('resultado').value = Number(this.pantalla);
		this.enter=false;
    }
	raiz(){
		this.nx=Number(this.pantalla);
		this.nx=Math.sqrt(this.nx); //resolver raíz cuadrada.
		this.nx=Math.round((this.nx + Number.EPSILON) * 100) / 100
        this.pantalla = String(this.nx); //mostrar en pantalla resultado
		this.enter=false;
	}
	porcent() { 
         this.nx=Number(this.pantalla)
		 this.nx=this.nx/100 //dividir por 100 el número
         this.pantalla=String(this.nx); //mostrar en pantalla
         }
}
var calculadora = new Calculadora();