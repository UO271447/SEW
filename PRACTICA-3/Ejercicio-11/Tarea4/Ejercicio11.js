class Geolocalizacion {
    constructor() {
   
    }

    initMap() {
    
        const gijon = { lat: 43.5357300, lng: -5.6615200 };
        const zoom = 8;
        const mapaGijon = new google.maps.Map(document.getElementsByTagName('main')[0], {zoom: zoom, center: gijon  });
        const marcador = new google.maps.Marker({ position: gijon, map: mapaGijon });
    }
}
var geolocalizacion = new Geolocalizacion();