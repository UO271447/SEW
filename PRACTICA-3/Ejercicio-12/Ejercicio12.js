
class Archivo {
    constructor(){}

    cargar(files) {
		
        if (window.File && window.FileReader && window.FileList && window.Blob) {

			var output='';
            var nBytes = 0;
            var archivos=files;
            var nArchivos = archivos.length;
			var fecha='';
            for (var i = 0; i < nArchivos; i++) {
                nBytes += archivos[i].size;
            }

            var nombres = "";
			var tipos='<p> Tipo/s: ';
			var contenido='';
            for(var i = 0; i < nArchivos; i++){
                nombres += "<p> Archivo[" + i + "] = " + archivos[i].name+'</p>' ;
            
            var tipoTexto = /text.plain/;
            var tipoXML = /text.xml/;
            var tipoJSON = /application.*/;
			
            var a=archivos[i].type;
			fecha= '<p> Fecha de Modificacion : '+archivos[i].lastModifiedDate+ '</p>';

            if (a.match(tipoTexto)||a.match(tipoXML)||a.match(tipoJSON)) 
               {
				contenido+='<pre> Contenido '+i+': </pre>';
                this.read(archivos[i],i,nArchivos);
				tipos+= a+" ";
            }}
			tipos+='</p>'
			output+='<p> Numero de Archivos '+nArchivos+ '</p>';
			output+='<p> Tamaño '+ nBytes + " bytes"+ '</p>';
			output+=nombres;
			output+=fecha;
			output+=tipos;
			output+=contenido;
			document.getElementsByTagName('section')[0].innerHTML = '<h2> DATOS </h2>' + output;				
			
        }

        else {
            document.write("<p> ¡¡¡ Este navegador NO soporta el API File y este programa puede no funcionar correctamente !!! </p>");
        }
    }
    read(archivo,i,numero){
  
        var lector = new FileReader();
        lector.onload = function (evento) {
			if(i==0)
				$('pre').text(lector.result ); 
			else if(i==numero-1)
				
				$('pre:last-child()').text(lector.result );
			
			else{
				var x=i+9
				$('pre:nth-child('+x+')').text(lector.result );
			}
          }      
        lector.readAsText(archivo);
 
        }
      

    
}
var archivo = new Archivo();