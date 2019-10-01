@extends('layouts.index')

    @section('head')
    @endsection

    @section('header')
    @endsection
    
    @section('content')
        @auth <!-- are you logged in? -->
        @include('progress.progress')
        <appid id="appid" appid="{{$application->id}}"></appid>
        <div class="container">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h4 class="card-title text-warning">LEVEL 10: <span class="text-info">FINAL LEVEL</span></h4>
                    <p>Provide the Following list of Recommendations:
                    <br>
                    <p>Provide the Following documents:
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div style="float:left;" class="col-md-6">
              <a href="'/applications/level8/'+id" style="margin:20px;" class="btn btn-info">BACK - LEVEL 8</a>
            </div>
            <div style="float:right;" class="col-md-6">
                <a href="level10" style="margin:20px;" class="btn btn-info">NEXT - LEVEL 10</a>
            </div>
        </div>
        @endauth
        @endsection