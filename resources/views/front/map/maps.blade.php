
<input style="visibility:hidden;height:0;width:0;display:none" id="{{ $searchTextField }}" ></input>
<div id="{{ $mapId }}" class="map__canvas rounded-[48px] {{ $mapHeight ?? '' }}" style="height: 350px;margin: 0.6em;"></div>
@push('js')

    @if(App()->getLocale() === 'ar')
        @once
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1pzxgf9AUfrWE2pLVQanO6Ti9a5lZDGo&libraries=places&region=eg&language=ar&sensor=true"></script>
        @endonce
    @else
        @once
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1pzxgf9AUfrWE2pLVQanO6Ti9a5lZDGo&libraries=places&region=eg&language=en&sensor=true"></script>
        @endonce

        @endif

    <!-- Google Map Plugin-->
    {{--    <script type="text/javascript" src="{{asset('frontend/js/gmap3.js')}}"></script>--}}
	@if(!config('custom.map_with_popup_when_click_on_marker'))
    <script>
        var longitude = "{{$longitude}}" ,
            latitude = "{{$latitude}}" ;

        $(function () {
            var lat = parseFloat(latitude) ,
                lng =parseFloat(longitude) ,
                latlng = new google.maps.LatLng(lat, lng),
                image = "{{ asset('front/image/marker.png') }}";
                //image = 'https://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';
            //zoomControl: true,
            //zoomControlOptions: google.maps.ZoomControlStyle.LARGE,
            var mapOptions = {
                    center: new google.maps.LatLng(lat, lng),
                    zoom: 13,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    panControl: true,
                    panControlOptions: {
                        position: google.maps.ControlPosition.TOP_RIGHT
                    },
                    zoomControl: true,
                    zoomControlOptions: {
                        style: google.maps.ZoomControlStyle.LARGE,
                        position: google.maps.ControlPosition.TOP_left
                    }
                },
                map = new google.maps.Map(document.getElementById('{{ $mapId }}'), mapOptions),
                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    icon: image
                });
            var input = document.getElementById('{{ $searchTextField }}');
            var autocomplete = new google.maps.places.Autocomplete(input, {
                types: ["geocode"]
            });
            autocomplete.bindTo('bounds', map);
            var infowindow = new google.maps.InfoWindow();
            // to make it read only [to show only the location]
            google.maps.event.addListener(map, 'click', function(event) {
                setMapOnAll(null);
                placeMarker(event.latLng);
            });
            // to make it insert
            // google.maps.event.addListener(autocomplete, 'place_changed', function (event) {
            //     infowindow.close();
            //     var place = autocomplete.getPlace();
            //     if (place.geometry.viewport) {
            //         map.fitBounds(place.geometry.viewport);
            //     } else {
            //         map.setCenter(place.geometry.location);
            //         map.setZoom(17);
            //     }
            //     moveMarker(place.name, place.geometry.location);
            //     $('.MapLat').val(place.geometry.location.lat());
            //     $('.MapLon').val(place.geometry.location.lng());
            // });
            // to make it for show only [to show the map only] [which can not be edit by any user ];
            google.maps.event.addListener(map, 'click', function (event) {
                $('.MapLat').val(event.latLng.lat());
                $('.MapLon').val(event.latLng.lng());
                infowindow.close();
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    "latLng":event.latLng
                }, function (results, status) {
                    // console.log(results, status);
                    if (status == google.maps.GeocoderStatus.OK) {
                        // console.log(results);
                        var lat = results[0].geometry.location.lat(),
                            lng = results[0].geometry.location.lng(),
                            placeName = results[0].address_components[0].long_name,
                            latlng = new google.maps.LatLng(lat, lng);
                        moveMarker(placeName, latlng);
                        $("#{{ $searchTextField }}").val(results[0].formatted_address);
                    }
                });
            });

            function moveMarker(placeName, latlng) {
                marker.setIcon(image);
                marker.setPosition(latlng);
                infowindow.setContent(placeName);
                //infowindow.open(map, marker);
            }
        });
    </script>
	@else
	
	<script>



             var locations = [
                 ['eg',26.549999,31.700001, 4],
                 ['Coogee Beach', 31.270931051013584, 30.783612555280957, 5],
                 ['Cronulla Beach', -34.028249, 151.157507, 3],
                 ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
                 ['Maroubra Beach', -33.950198, 151.259302, 1]
             ];

            // console.log('good');
            // console.log(locations);


        var map = new google.maps.Map(document.getElementById('{{ $mapId }}'), {
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: new google.maps.LatLng(26.549999, 31.700001),
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon:"{{ asset('front/image/marker.png') }}"
            });
			var infoWindoContent = `
			<div class="map__popup shadow-sm rounded-md">
				<a href="{{ route('view.product',['lang'=>$lang]) }}" class="block mb-3">
				<img class=" w-full object-cover map__img " src="{{ asset('front/image/product-1.png') }}">
				</a>	
				<div class="billboard__content px-3 pb-6">
						<a href="{{ route('view.product',['lang'=>$lang]) }}" class="product__title">T-POLE - EL MOHANDISEEN - CAIRO</a>	
						<div class="product__address flex items-center mt-3 ">
				<i class="fa-solid fa-location-dot mr-1 w-4  text-main bg-white hover:scale-110 transition-all duration-300 shrink-0"></i>
                    <p class="product__location text-xs font-normal capitalize md:font-medium">
                      Al Agouza Steps (October Bridge) ,Zamalek,Cairo , Egypt
                    </p>
                </div>
				</div>
			</div>
			
			`;

            marker.addListener('click', function() {
				infowindow.setContent(infoWindoContent)
                infowindow.open(map, marker);
            });


            google.maps.event.addListener(marker, 'click', (function(marker, i) {
	                return function() {
                    var latitude = locations[i][1] ;
                    var longitude = locations[i][2];

                    $.ajax({
                        type: 'get',
                        url: "/en",
                        data: {
                            '_token':"{{csrf_token()}}",
                            "longitude":longitude ,
                            'latitude':latitude

                        },
                        success: function (data) {
                            if(data.status)
                            {
                              //  $('#project_name').text(data.project.name);
                              //  document.getElementById('project_link').href="/projects/"+data.project.id ;
                              //  infowindow.setContent($('.project_content_modal')[0])

                            }
                        }, error: function (reject) {
                        }
                    });
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }


    </script>
	
	@endif

@endpush
