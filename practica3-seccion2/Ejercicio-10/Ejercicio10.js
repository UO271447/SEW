
class Gasolina{
constructor(){
}
MostrarDatos(str){
	var tipogasolina95=str
	var url = 'https://sedeaplicaciones.minetur.gob.es/ServiciosRESTCarburantes/PreciosCarburantes/EstacionesTerrestres/FiltroMunicipioProducto/4987/' + tipogasolina95;
	var error = "<h2>¡problemas! No puedo obtener información de <a href='https://sedeaplicaciones.minetur.gob.es'>Sede Aplicaciones</a></h2>";
	this.obtenerJSON(url);	
}

  obtenerJSON(url){
	
  $.getJSON(url, function (datos) {
	var output='';
	var fl=0;
	var fl2=0;
    var ListaPrecio=datos.ListaEESSPrecio;
	output +='<table>';
	output +='<thead>';
	output +='<tr>';
	output+='<th></th>'
	for(var i=0; i< ListaPrecio.length;i++){
		output += '<th>' + datos.ListaEESSPrecio[i].Dirección + ' (' + datos.ListaEESSPrecio[i].Localidad + ')</th>';	
	}
		output +='</tr>';
		output +='</thead>';
		output +='<tbody>';
		output +='<tr>';
		output +='</tr>';
		output +='<tr>';
		output += '<td>Latitud, Longitud: </td>';
		for(var i=0; i< ListaPrecio.length;i++){
			output += '<td>' + datos.ListaEESSPrecio[i].Latitud + datos.ListaEESSPrecio[i]["Longitud (WGS84)"]
			+ '</td>';
			
		}
		output +='</tr>';
		output +='<tr>';
		output += '<td>Horario: </td>';
		for(var i=0; i< ListaPrecio.length;i++){
			output += '<td>' +datos.ListaEESSPrecio[i].Horario +  '</td>';
		}
		output +='</tr>';
		output +='<tr>';
		output += '<td>Fecha: </td>';
		for(var i=0; i< ListaPrecio.length;i++){
			output += '<td>'+ datos.Fecha + '</td>';
		}
		output +='</tr>';
		output +='<tr>';
		output += '<td>Precio(€/Litro): </td>';
		for(var i=0; i< ListaPrecio.length;i++){
			isNumber(datos.ListaEESSPrecio[i].PrecioProducto);
			fl+=fl2;
			function isNumber(n) {
			n=n.replace(",",".");
			fl2=parseFloat(n);
			}
			output += '<td>'+ fl2+ '</td>';		
		}
		output +='</tr>';
		output +='<tr>';
		output += '<td>Rotulo: </td>';
		for(var i=0; i< ListaPrecio.length;i++){
			output += '<td>'+ datos.ListaEESSPrecio[i].Rótulo  + '</td>';	
		}
		output +='</tr>';
		output +='</tbody>'
		output +='</table>'
		output+= '<form>';
		output+='<input type="button" value="Media" onclick="gasolina.CalcularMedia()"/>'
		output+= '</form>';
		const section = document.getElementsByTagName("section")[0];
		section.innerHTML=output;   
    })
	
	this.ListaPrecio=this.ListaPrecio;
  }
  
  CalcularMedia(){
  var longitud=0;
  const filas=document.querySelectorAll('table tbody ');
  filas.forEach((fila) => {
   const filatr=fila.querySelectorAll('tr');
   var total=0;
   for(var i=4; i<5; i++) {
		const filatd=filatr[i].querySelectorAll('td');
		
		for(var i=1; i<filatd.length; i++) {
			total+=parseFloat(filatd[i].innerHTML);
			longitud+=1;
			}
   }
   const section = document.getElementsByTagName("section")[0];
   section.innerHTML+='<p> Media: '+parseFloat(total/longitud).toFixed(2)+ '</p> ';  
});
 }
  
}
var gasolina= new Gasolina();
