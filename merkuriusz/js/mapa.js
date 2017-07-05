/* MAPA */
$(function(){
	if( $('#map').length ){
		$('#map').gmap3({
	    map: {
	        options: {
	            center: [50.021314, 20.996375],
	            zoom: 15,
	            panControl: false,
	            zoomControl: false
	        }
	    },
	    marker: {
	        values:[{
	            latLng: [50.021314, 20.996375],
	            data: 'Szpitalna 25B, 33-100 Tarnów'
	        }],
	          options: {
         	   icon: new google.maps.MarkerImage('http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/themes/merkuriusz/img/pin_merkuriusz.png', new google.maps.Size(47, 59, "px", "px"))
       			},
	        events:{
	            click: function(marker, event, context) {
	                var map = $(this).gmap3('get'),
	                    infowindow = $(this).gmap3({get:{name:'infowindow'}});
	                if (infowindow) {
	                    infowindow.open(map, marker);
	                    infowindow.setContent(context.data);
	                } else {
	                    $(this).gmap3({
	                        infowindow: {
	                            anchor: marker,
	                            options: {content: context.data}
	                        }
	                    });
	                }
	            }
	        }
	    }
	});
	}
	
});