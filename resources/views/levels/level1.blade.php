@extends('layouts.index')
<meta name="csrf-token" content="{{ csrf_token() }}">
    @section('head')
    @endsection

    @section('header')
    @endsection

    @section('content')
    
        @auth <!-- are you logged in? -->

        @include('progress.progress')
    
        <div class="container">
            
            <appid id="appid" appid="{{$application->id}}"></appid>
            <div id="level1app"></div>
        </div>
        @endauth
    @endsection