(function ($) {
    "use strict";
    $.fn.angelsmap = function (options) {
        var selector = $(this);
        var settings = $.extend({
            fullscreen: 'google-map',
            mobile: 'mobile-map',
            latitute: '40.714353',
            longitude: '-74.005973',
            mapmarker: '',
            zoom: 17,
            grayscale: true
        }, options);

        /* GOOGLE MAP FOR BIG SCREENS */

        function googlemap() {
            "use strict";
            // Coordinates
            var latlng = new google.maps.LatLng(settings.latitute, settings.longitude);

            var stylez = [
                {
                    featureType: "all",
                    elementType: "all",
                    stylers: [
                        {
                            saturation: -100
                        }
      ]
    }
];
            // Map Options
            var myMapOptions = {
                zoom: settings.zoom,
                scrollwheel: false,
                disableDefaultUI: true,
                mapTypeControl: true,
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.MEDIUM,
                    position: google.maps.ControlPosition.LEFT_TOP
                },
                center: latlng,
                mapTypeControlOptions: {
                    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'tehgrayz']
                }
            };

            var map = new google.maps.Map(document.getElementById(settings.fullscreen), myMapOptions);

            if (settings.grayscale === true) {
            var mapType = new google.maps.StyledMapType(stylez, {
                name: "Grayscale"
            });
            map.mapTypes.set('tehgrayz', mapType);
            map.setMapTypeId('tehgrayz');
            }
            
            // Map marker options
            var marker = new google.maps.Marker({
                draggable: false,
                animation: google.maps.Animation.DROP,
                icon: settings.mapmarker,
                map: map,
                position: latlng
            });
        }

        /* GOOGLE MAP FOR MOBILE DEVICES */

        function mobilemap() {
            "use strict";
            // Coordinates
            var latlng = new google.maps.LatLng(settings.latitute, settings.longitude);

            var stylez = [
                {
                    featureType: "all",
                    elementType: "all",
                    stylers: [
                        {
                            saturation: -100
                        }
      ]
    }
];
            // Map Options
            var myMapOptions = {
                zoom: settings.zoom,
                scrollwheel: false,
                disableDefaultUI: true,
                mapTypeControl: true,
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.MEDIUM,
                    position: google.maps.ControlPosition.LEFT_TOP
                },
                center: latlng,
                mapTypeControlOptions: {
                    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'tehgrayz']
                }
            };

            var map = new google.maps.Map(document.getElementById(settings.mobile), myMapOptions);

            if (settings.grayscale === true) {
            var mapType = new google.maps.StyledMapType(stylez, {
                name: "Grayscale"
            });
            map.mapTypes.set('tehgrayz', mapType);
            map.setMapTypeId('tehgrayz');
            }
            
            // Map marker options
            var marker = new google.maps.Marker({
                draggable: false,
                animation: google.maps.Animation.DROP,
                icon: settings.mapmarker,
                map: map,
                position: latlng
            });
        }

        googlemap();
        mobilemap();

        jQuery(window).on('resize orientationchange', function () {
            "use strict";
            if (jQuery(window).width() > 1024) {
                googlemap();
            } else {
                mobilemap();
            }
        });
    };

}(jQuery));