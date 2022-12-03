
class Clima{
constructor(){}
mostrarClima(str){
	var apikey = 'dd1441035731a87090db1c20ca938178';
	var ciudad = str;
	var unidades = '&units=metric';
	var idioma = '&lang=es';
	var url = 'https://api.openweathermap.org/data/2.5/weather?q=' + ciudad +unidades +  idioma + '&APPID=' + apikey;
	var error = "<h2>¡problemas! No puedo obtener información de <a href='http://openweathermap.org'>OpenWeatherMap</a></h2>";
	this.obtenerJSON(url,ciudad);	
}

  obtenerJSON(url,ciudad){
  $.getJSON(url, function (datos) {
    var output = '';
    var h=direccionViento(datos.wind.deg);
    function   direccionViento(dir){
    if(dir>=0 && dir <=30) return'N, ';
    else if(dir>30 && dir<60)  return'NE, ';
    else if(dir>=60 && dir<=120)  return'E, ';
    else if(dir>120 && dir<150)  return'SE, ';
    else if(dir>=150 && dir<=210)return'S, ';
    else if(dir>210 && dir<240)  return 'SW, ';
    else if(dir>=240 && dir<=300)  return 'W, ';
    else if(dir>300 && dir<330)  return 'NW, ';
    else if(dir>=330 && dir<=0)  return'N, ';
    else  return '';
     }
    var visibilidad=visibilidad(datos.visibility);
    function visibilidad(str){
      var num = parseInt(str);
      if(num>=10000) return'Buena, ' + str + ' metros';
      else if(num>=1000 && num<=4000) return'Mala, '+ str + ' metros';
      else if(num>4000 && num<10000) return 'Normal, ' + str + ' metros';
      else if(num<1000) return 'Niebla, ' + str + ' metros';
    }
    output += '<h2>' + datos.name + ' (' + datos.sys.country + ')</h2>';
    output += '<p>Latitud: ' + datos.coord.lat + '&emsp;Longitud: ' + datos.coord.lon + '</p>';
    output += '<p>' + '<img src="https://openweathermap.org/img/w/' + datos.weather[0].icon + '.png" alt="Imagen del tiempo"/>' + ' ' + datos.main.temp + 'ºC</p>';
    output += '<p>Presión: ' + datos.main.pressure + '  hPa</p>';
    output += '<p>Humedad: ' + datos.main.humidity + '%</p>';
    output += '<p>Amanecer/Atardecer: ' + new Date(datos.sys.sunrise * 1000).toLocaleTimeString() + '/'+ new Date(datos.sys.sunset * 1000).toLocaleTimeString()  + '</p>';
    output += '<p>Dirección del viento: '+ h  + ' ' + datos.wind.deg + '  grados.   Velocidad: ' + datos.wind.speed + ' m/s</p>';
    output += '<p>Visibilidad: ' +   visibilidad + '</p>';
    output += '<p>Nubosidad: ' + datos.clouds.all + ' %</p>';
    output += '<p>Fecha de la medida: ' + new Date(datos.dt * 1000).toLocaleTimeString() + ' ' + new Date(datos.dt * 1000).toLocaleDateString() + '</p>';
    const section = document.getElementsByTagName("section")[0];
	section.innerHTML=output;   
    })
  }
}
var clima= new Clima();
