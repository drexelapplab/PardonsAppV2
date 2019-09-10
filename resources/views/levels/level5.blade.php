@extends('layouts.index')

    @section('head')
    @endsection

    @section('header')
    @endsection
    
    @section('content')
        @auth <!-- are you logged in? -->
        @include('progress.progress')
    <script>
        function showDrinkForm() {
            $("#drinkForm").show();
        }
        function hideDrinkForm() {
            $("#drinkForm").hide();
        }
    </script>
    <appid id="appid" appid="{{$application->id}}"></appid>
    <div class="container">
        <div id="level5app"></div>
    </div>

        @endauth
    @endsection