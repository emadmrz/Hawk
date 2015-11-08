@extends('profile.layout')

@section('content')
    @include('profile.partials.post',['route'=>'user']);
    @include('profile.partials.info')
    @role('user')
        @include('profile.partials.education')
    @endrole
    @include('profile.partials.biography')
    @role('legal')
    @include('profile.partials.map')
    @endrole
    @include('profile.partials.shop')
    @include('home.partials.offer') {{-- Why? --}}
    @include('profile.partials.skill')
@endsection

@section('side')
    @include('partials.profileProgress')
    @include('partials.addonShop')
    @include('partials.addSkill')
    @include('profile.partials.latestArticles')
    @include('profile.partials.latestPosts')
    @include('partials.groupAdd')
@endsection

@section('script')
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&language=fa"></script>
    @role('user')
    <script>
        $(document).ready(function(){

            $('#education_table_edit').find('a[data-editable]').editable({
                url: '/profile/education/update',
                title: 'ویرایش',
                params: function(params) {
                    //originally params contain pk, name and value
                    params._token = $('input[name="_token"]').val();
                    return params;
                }
            });

            $('#education_table_edit').find('#status').editable({
                value: $(this).val(),
                url: '/profile/education/update',
                title: 'ویرایش',
                params: function(params) {
                    //originally params contain pk, name and value
                    params._token = $('input[name="_token"]').val();
                    return params;
                },
                source: [
                    {value: 0, text: 'در حال تحصیل'},
                    {value: 1, text: 'فارغ التحصیل'},
                ]
            });
        });
    </script>
    @endrole

    @role('legal')
    <script>
        $(window).ready(function(){
            console.log({{ $location->lat }});
            console.log({{ $location->lng }});
            var  myLat = '{{ $location->lat }}';
            var  myLng = '{{ $location->lng }}';
            var gmarkers = [];
            if(myLat != '' && myLng !=''){
                var latlng = new google.maps.LatLng(myLat, myLng);
            }else{
                var latlng = new google.maps.LatLng(35.744588, 51.444045);
            }


            var mapOptions = {
                center: latlng,
                zoom: 15,
                scrollWheel: false
            };

            var marker = new google.maps.Marker({
                position: latlng,
                url: '/',
                animation: google.maps.Animation.DROP
            });
            gmarkers.push(marker);

            var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
            marker.setMap(map);
            map.set('scrollwheel', false); //Disable scrollwheel from here
            google.maps.event.addListener(map, 'click', function(event) {
                removeMarkers();
                var marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map,
                    animation: google.maps.Animation.DROP
                });
                gmarkers.push(marker);
                console.log(event.latLng.lat())
                console.log(event.latLng.lng())
                var form = $("#my_location_form");
                form.find("#lat").val(event.latLng.lat());
                form.find("#lng").val(event.latLng.lng());
                $("#MapReport").html('موقعیت انتخابی جدید بر روی نقشه ثبت شد.')
            });

            $("#MyLocation").click(function(){
                getLocation();
            });

            function getLocation() {
                $("#MapReport").html('<i class="fa fa-spinner fa-spin" ></i>');
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                } else {
                    console.log("Geolocation is not supported by this browser.");
                }
            }

            function showPosition(position) {
                console.log(position.coords.latitude);
                console.log(position.coords.longitude);
                var Currentlatlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                removeMarkers();
                var marker = new google.maps.Marker({
                    position: Currentlatlng,
                    url: '/',
                    animation: google.maps.Animation.DROP
                });
                marker.setMap(map);
                map.panTo(Currentlatlng);
                gmarkers.push(marker);
                var form = $("#my_location_form");
                form.find("#lat").val(position.coords.latitude);
                form.find("#lng").val(position.coords.longitude);
                $("#MapReport").html('موقعیت کنونی شما بر روی نقشه ثبت شد.')
            }
            function showError(error) {
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        console.log("User denied the request for Geolocation.")
                        $("#MapReport").html('اجازه دسترسی به موقعیت مکانی شما داده نشد.')
                        break;
                    case error.POSITION_UNAVAILABLE:
                        console.log("Location information is unavailable.")
                        $("#MapReport").html('اطلاعات موقعیت مکانی شما در دسترسی نیست. اتصال به اینترنت را بررسی نمایید.');
                        break;
                    case error.TIMEOUT:
                        console.log("The request to get user location timed out.")
                        $("#MapReport").html('تلاش برای دسترسی به موقعیت مکانی شما بیش از اندازه طولانی شد. اتصال اینترنت خود را چک نمایید.');
                        break;
                    case error.UNKNOWN_ERROR:
                        console.log("An unknown error occurred.")
                        $("#MapReport").html('خطای ناشناس رخ داد. اتصال به اینترنت را بررسی نمایید.');
                        break;
                }
            }

            function removeMarkers(){
                for(i=0; i<gmarkers.length; i++){
                    gmarkers[i].setMap(null);
                }
            }

        });
    </script>
    @endrole
@endsection