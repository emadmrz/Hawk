@extends('home.layout')

@section('header')
    @include('partials.navbar')
    @include('home.partials.cover')
@endsection

@section('content')
    @include('home.partials.info')
    @if($role == 'user')
        @include('home.partials.education')
    @endif
    @include('home.partials.biography')
    @if($role == 'legal')
        @include('home.partials.map')
    @endif
    @include('home.partials.shop')
    @include('home.partials.offer')
    @include('home.partials.skill')
@endsection

@section('side')
    @include('partials.profileProgress', ['userProfile'=>$user])
    @include('home.partials.latestArticles')
    @include('home.partials.latestPosts')
    @include('home.partials.friends')
@endsection

@section('full')
    @include('home.partials.relatedUsers')
@endsection

@section('script')
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&language=fa"></script>
    @if($role == 'legal')
    <script>
        $(window).ready(function(){
            console.log({{ $user->location->lat }});
            console.log({{ $user->location->lng }});
            var  myLat = '{{ $user->location->lat }}';
            var  myLng = '{{ $user->location->lng }}';
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
            var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
            marker.setMap(map);
            map.set('scrollwheel', false); //Disable scrollwheel from here

        });
    </script>
    @endif

    <script>
        {{--$(document).ready(function(){--}}
            {{--$.ajax({--}}
                {{--url : '/home/profile/related',--}}
                {{--type : 'post',--}}
                {{--data : {id: '{{ $user->id }}', _token: $('input[name="_token"]').val()},--}}
                {{--beforeSend: function(){--}}
                    {{--$("#related_users_container").html('<i class="fa fa-spin fa-spinner fa-3x text-muted"></i>');--}}
                {{--},--}}
                {{--complete: function(){--}}

                {{--},--}}
                {{--success: function(data){--}}

                {{--},--}}
                {{--error: function(xhr){--}}
                    {{--alert("An error occured: " + xhr.status + " " + xhr.statusText);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    </script>

@endsection