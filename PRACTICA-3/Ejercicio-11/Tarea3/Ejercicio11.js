
"use strict";
class MapaEstaticoGoogle {
    constructor (){
        navigator.geolocation.getCurrentPosition(this.getPosicion.bind(this), this.verErrores.bind(this));
    }
    getPosicion(posicion){
        this.longitud         = posicion.coords.longitude; 
        this.latitud          = posicion.coords.latitude;  
        this.precision        = posicion.coords.accuracy;
        this.altitud          = posicion.coords.altitude;
        this.precisionAltitud = posicion.coords.altitudeAccuracy;
        this.rumbo            = posicion.coords.heading;
        this.velocidad        = posicion.coords.speed;       
    }
	 verErrores(error){
        switch(error.code) {
        case error.PERMISSION_DENIED:
            this.mensaje = "El usuario no permite la petición de geolocalización"
            break;
        case error.POSITION_UNAVAILABLE:
            this.mensaje = "Información de geolocalización no disponible"
            break;
        case error.TIMEOUT:
            this.mensaje = "La petición de geolocalización ha caducado"
            break;
        case error.UNKNOWN_ERROR:
            this.mensaje = "Se ha producido un error desconocido"
            break;
        }
    }
    getLongitud(){
        return this.longitud;
    }
    getLatitud(){
        return this.latitud;
    }
    getAltitud(){
        return this.altitud;
    }
    informacion(dondeVerlo){
        var ubicacion=document.getElementsByTagName('main')[0];
        var datos=''; 
        datos+='<p>Longitud: '+this.longitud +' grados</p>'; 
        datos+='<p>Latitud: '+this.latitud +' grados</p>';
        datos+='<p>Precisión de la latitud y longitud: '+ this.precision +' metros</p>';
        datos+='<p>Altitud: '+ this.altitude +' metros</p>';
        datos+='<p>Precisión de la altitud: '+ this.precisionAltitud +' metros</p>'; 
        datos+='<p>Rumbo: '+ this.rumbo +' grados</p>'; 
        datos+='<p>Velocidad: '+ this.velocidad +' metros/segundo</p>';
        ubicacion.innerHTML = datos;
    }
	getMapaEstaticoGoogle(dondeVerlo){
        var ubicacion=document.getElementsByTagName('main')[0];
        
        var apiKey = "&key=AIzaSyC6j4mF6blrc4kZ54S6vYZ2_FpMY9VzyRU";
        //URL: obligatoriamente https
        var url = "https://maps.googleapis.com/maps/api/staticmap?";
        //Parámetros
        // centro del mapa (obligatorio si no hay marcadores)
        var centro = "center=" + this.latitud + "," + this.longitud;
        //zoom (obligatorio si no hay marcadores)
        //zoom: 1 (el mundo), 5 (continentes), 10 (ciudad), 15 (calles), 20 (edificios)
        var zoom ="&zoom=15";
        //Tamaño del mapa en pixeles (obligatorio)
        var tamaño= "&size=800x600";
        //Escala (opcional)
        //Formato (opcional): PNG,JPEG,GIF
        //Tipo de mapa (opcional)
        //Idioma (opcional)
        //region (opcional)
        //marcadores (opcional)
        var marcador = "&markers=color:red%7Clabel:S%7C" + this.latitud + "," + this.longitud;
        //rutas. path (opcional)
        //visible (optional)
        //style (opcional)
        var sensor = "&sensor=false"; 
        
        this.imagenMapa = url + centro + zoom + tamaño + marcador + sensor + apiKey;
        ubicacion.innerHTML = "<img src='"+this.imagenMapa+"' alt='mapa estático google' />";
    }
}
var miMapa = new MapaEstaticoGoogle();

