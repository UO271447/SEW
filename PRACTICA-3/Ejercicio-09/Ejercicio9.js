
class Clima {
  constructor(){
      this.x=0;
      this.apikey = "dd1441035731a87090db1c20ca938178";
      this.tipo = "&mode=xml";
      this.unidades = "&units=metric";
      this.idioma = "&lang=es";  
      this.correcto = "¡Todo correcto! XML recibido de <a href='https://openweathermap.org/'>OpenWeatherMap</a>"
      this.ciudad;
  }
  cargarDatos(str){
	  this.ciudad=str;
      this.url = "https://api.openweathermap.org/data/2.5/weather?q=" + this.ciudad + this.tipo + this.unidades + this.idioma + "&APPID=" + this.apikey;
      $.ajax({
          dataType: "xml",
          url: this.url,
          method: 'GET',
          success: function(datos){
                  $("h5").text((new XMLSerializer()).serializeToString(datos));
                  var ciudad                = $('city',datos).attr("name");
                  var longitud              = $('coord',datos).attr("lon");
                  var latitud               = $('coord',datos).attr("lat");
                  var pais                  = $('country',datos).text();
                  var amanecer              = $('sun',datos).attr("rise");
                  var minutosZonaHoraria    = new Date().getTimezoneOffset();
                  var amanecerMiliSeg1970   = Date.parse(amanecer);
                      amanecerMiliSeg1970  -= minutosZonaHoraria * 60 * 1000;
                  var amanecerLocal         = (new Date(amanecerMiliSeg1970)).toLocaleTimeString("es-ES");
                  var oscurecer             = $('sun',datos).attr("set");          
                  var oscurecerMiliSeg1970  = Date.parse(oscurecer);
                      oscurecerMiliSeg1970  -= minutosZonaHoraria * 60 * 1000;
                  var oscurecerLocal        = (new Date(oscurecerMiliSeg1970)).toLocaleTimeString("es-ES");
                  var imagen=  $('weather',datos).attr("icon");
                  var temperatura           = $('temperature',datos).attr("value");
                  var temperaturaMin        = $('temperature',datos).attr("min");
                  var temperaturaMax        = $('temperature',datos).attr("max");
                  var temperaturaUnit       = $('temperature',datos).attr("unit");
                  var humedad               = $('humidity',datos).attr("value");
                  var humedadUnit           = $('humidity',datos).attr("unit");
                  var presion               = $('pressure',datos).attr("value");
                  var presionUnit           = $('pressure',datos).attr("unit");
                  var velocidadViento       = $('speed',datos).attr("value");
                  var nombreViento          = $('speed',datos).attr("name");
                  var direccionViento       = $('direction',datos).attr("value");
                  var codigoViento          = $('direction',datos).attr("code");
                  var nombreDireccionViento = $('direction',datos).attr("name");
                  var nubosidad             = $('clouds',datos).attr("value");
                  var nombreNubosidad       = $('clouds',datos).attr("name");
                  var visibilidad           = $('visibility',datos).attr("value");
                  var precipitacionValue    = $('precipitation',datos).attr("value");
                  var precipitacionMode     = $('precipitation',datos).attr("mode");
                  var descripcion           = $('weather',datos).attr("value");
                  var horaMedida            = $('lastupdate',datos).attr("value");
                  var horaMedidaMiliSeg1970 = Date.parse(horaMedida);
                      horaMedidaMiliSeg1970 -= minutosZonaHoraria * 60 * 1000;
                  var horaMedidaLocal       = (new Date(horaMedidaMiliSeg1970)).toLocaleTimeString("es-ES");
                  var fechaMedidaLocal      = (new Date(horaMedidaMiliSeg1970)).toLocaleDateString("es-ES");
                  
                  var  output = "<h2>Ciudad: " + ciudad + "</h2>";
                      output += "<p>Longitud: " + longitud + " grados</p>";
                      output += "<p>Latitud: " + latitud + " grados</p>";
                      output += "<p>País: " + pais + "</p>";
                      output += "<p>Amanece a las: " + amanecerLocal + "</p>";
                      output += "<p>Oscurece a las: " + oscurecerLocal + "</p>";
                      output += '<img src="https://openweathermap.org/img/w/' + imagen+'.png" alt="Imagen del tiempo"/>'
                      output += "<p>Temperatura: " + temperatura + " grados Celsius</p>";
                      output += "<p>Temperatura mínima: " + temperaturaMin + " grados Celsius</p>";
                      output += "<p>Temperatura máxima: " + temperaturaMax + " grados Celsius</p>";
                      output += "<p>Temperatura (unidades): " + temperaturaUnit + "</p>";
                      output += "<p>Humedad: " + humedad + " " + humedadUnit + "</p>";
                      output += "<p>Presión: " + presion + " " + presionUnit + "</p>";
                      output += "<p>Velocidad del viento: " + velocidadViento + " metros/segundo</p>";
                      output += "<p>Nombre del viento: " + nombreViento + "</p>";
                      output += "<p>Dirección del viento: " + direccionViento + " grados</p>";
                      output += "<p>Código del viento: " + codigoViento + "</p>";
                      output += "<p>Nombre del viento: " + nombreDireccionViento + "</p>";
                      output += "<p>Nubosidad: " + nubosidad + "</p>";
                      output += "<p>Nombre nubosidad: " + nombreNubosidad + "</p>";
                      output += "<p>Visibilidad: " + visibilidad + " metros</p>";
                      output += "<p>Precipitación valor: " + precipitacionValue + "</p>";
                      output += "<p>Precipitación modo: " + precipitacionMode + "</p>";
                      output += "<p>Descripción: " + descripcion + "</p>";
                      output += "<p>Hora de la medida: " + horaMedidaLocal + "</p>";
                      output += "<p>Fecha de la medida: " + fechaMedidaLocal + "</p>";
                      const section = document.getElementsByTagName("section")[0];
					  section.innerHTML=output;            
              },
          error:function(){
              $("h3").html("¡Tenemos problemas! No puedo obtener XML de <a href='https://openweathermap.org'>OpenWeatherMap</a>"); 
              $("h4").remove();
              $("h5").remove();
              $("p").remove();
              }
      });
    }
  
  crearElemento(tipoElemento, texto, insertarAntesDe){
      var elemento = document.createElement(tipoElemento); 
      elemento.innerHTML = texto;
      $(insertarAntesDe).before(elemento);
  }
  verXML(){
      this.crearElemento("h2","Datos en XML desde <a href='https://openweathermap.org'>OpenWeatherMap</a>"); 
      this.crearElemento("h3",this.correcto); 
      this.crearElemento("h4","XML");       
      this.crearElemento("h5",""); 
      this.crearElemento("h4","Datos"); 
      this.crearElemento("p",""); 
      this.cargarDatos();
  }
}
var clima = new Clima();