@extends('layouts.index')

    @section('head')
    @endsection

    @section('header')
    @endsection
    
    

    @section('content')
        @auth <!-- are you logged in? -->

        @include('progress.progress')
    <script>
        function showRetSchool() {
            $("#retschoolForm").show();
            //$("#newapp").hide();
        }

        function hideRetSchool() {
            $("#retschoolForm").hide();
            //$("#newapp").show();
        }
        function showRecommend() {
            $("#recommendForm").show();
            //$("#newapp").hide();
        }
        function hideRecommend() {
            $("#recommendForm").hide();
            //$("#newapp").show();
        }
    </script>
    <appid id="appid" appid="{{$application->id}}"></appid>
    <div class="container">
        <div id="level2app"></div>
    </div>
        @endauth
    @endsection