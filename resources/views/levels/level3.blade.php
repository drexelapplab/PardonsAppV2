@extends('layouts.index')

    @section('head')
    @endsection

    @section('header')
    @endsection
    
    @section('content')
        @auth <!-- are you logged in? -->
        @include('progress.progress')
    <script>
        function showVolForm() {
            $("#volForm").show();
            //$("#newapp").hide();
        }

        function hideVolForm() {
            $("#volForm").hide();
            //$("#newapp").show();
        }
    </script>
    <appid id="appid" appid="{{$application->id}}"></appid>
    <div class="container">
        

            <div id="level3app"></div>

    </div>

</div>

        @endauth
    @endsection