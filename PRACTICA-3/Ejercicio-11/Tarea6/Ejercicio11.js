class Geolocalizacion {
  constructor() {
    
  }

  mapaDinamico() {
    var centro = {lat: 43.3672702, lng: -5.8502461};
    var mapaGeoposicionado = new google.maps.Map(document.getElementsByTagName('main')[0],{
        zoom: 8,
        center:centro,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    
    var infoWindow = new google.maps.InfoWindow;
    if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Localizacion encontrada');
            infoWindow.open(mapaGeoposicionado);
            mapaGeoposicionado.setCenter(pos);
          }, function() {
            this.handleLocationError(true, infoWindow, mapaGeoposicionado.getCenter())});
        }
        else {
         this.handleLocationError(false, infoWindow, mapaGeoposicionado.getCenter());
        }
      }
      
  buscar(){
    var centro = {lat: 43.3672702, lng: -5.8502461};
    var mapaGeoposicionado = new google.maps.Map(document.getElementsByTagName('main')[0],{
        zoom: 8,
        center:centro,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    
    var infoWindow = new google.maps.InfoWindow;
    if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: parseFloat(document.getElementsByTagName('input')[1].value),
              lng: parseFloat(document.getElementsByTagName('input')[2].value)
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Localizacion encontrada');
            infoWindow.open(mapaGeoposicionado);
            mapaGeoposicionado.setCenter(pos);
          }, function() {
            this.handleLocationError(true, infoWindow, mapaGeoposicionado.getCenter())});
        }
        else {
         this.handleLocationError(false, infoWindow, mapaGeoposicionado.getCenter());

      }
  }
  handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
                          'Error: Ha fallado la geolocalizacion' :
                          'Error: Su navegador no soporta geolocalizacion');
    infoWindow.open(mapaGeoposicionado);
  }	  
	MostrarDatos(){
	var url = 'https://sedeaplicaciones.minetur.gob.es/ServiciosRESTCarburantes/PreciosCarburantes/EstacionesTerrestres/FiltroMunicipioProducto/4987/6';
	var error = "<h2>¡problemas! No puedo obtener información de <a href='https://sedeaplicaciones.minetur.gob.es'>Sede Aplicaciones</a></h2>";
	this.obtenerJSON(url);	
}

  obtenerJSON(url){
	
  $.getJSON(url, function (datos) {
	var lati='';
	var longitud='';
	var fl=0;
	var fl2=0;
    var ListaPrecio=datos.ListaEESSPrecio;
	for(var i=0; i< ListaPrecio.length;i++){
			isNumber(datos.ListaEESSPrecio[i].PrecioProducto);
			if(fl>fl2 && i>0){
				fl=fl2;
				isNumber(datos.ListaEESSPrecio[i].Latitud);
				lati = fl2;
				isNumber(datos.ListaEESSPrecio[i]["Longitud (WGS84)"]);
				longitud=fl2;
			}
			else{
				fl=fl2;
			}
			function isNumber(n) {
			n=n.replace(",",".");
			fl2=parseFloat(n);
			}	
		}
		var centro = {lat: 43.3672702, lng: -5.8502461};
    var mapaGeoposicionado = new google.maps.Map(document.getElementsByTagName('main')[0],{
        zoom: 8,
        center:centro,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    
    var infoWindow = new google.maps.InfoWindow;
    if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: Number(lati),
              lng: Number(longitud)
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Localizacion encontrada');
            infoWindow.open(mapaGeoposicionado);
            mapaGeoposicionado.setCenter(pos);
          }, function() {
            this.handleLocationError(true, infoWindow, mapaGeoposicionado.getCenter())});
        }
        else {
         this.handleLocationError(false, infoWindow, mapaGeoposicionado.getCenter());
        }
				
    })
	
  }

}
var geolocalizacion = new Geolocalizacion();
