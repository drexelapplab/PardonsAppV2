
@extends('layouts.index')

    @section('head')
    @endsection

    @section('header')
 	@endsection
    
    @section('content')
        <script>
        function opendash() {
            $("#dashboard").show();
            $("#newapp").hide();
        }
        function nostatus() {
            $("#noStatus").show();
            $("#newapp").hide();
        }
        function changestatus() {
            $("#noStatus").hide();
            $("#newapp").show();
        
        }
    </script>
        @if($status != 'new')
            <div id="newapp" style="display:none;" class="container">
        @else
            <div id="newapp" class="container">
        @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="h3">Welcome to PardonMe™</div>
                        <ol>
                            <li>
                                In Pennsylvania, you don’t have to have a lawyer to apply for a pardon.  You can do it yourself.  This program was created to help you do a better job than you might be able to do by yourself. It doesn’t give you any legal advice, and using it does not guarantee your application will get accepted or found to have “merit”.<br /><br />
                            </li>
                            <li>
                                When you’re done, this app will create the application form that’s all filled in.  Before you sign and send it in, think about asking a friend or a lawyer read it through first.  If it’s not complete, you might be forced to start all over.  And if it’s not accurate, that might hurt your chances for getting a pardon.<br /><br />
                            </li>
                            <li>
                                If you’d like some ideas on how to find a lawyer, maybe even a free one if you cannot afford one, check back on the website of PLSE – Philadelphia Lawyers for Social Equity, who created this app with a grant from the Thomas Skelton Harrison Foundation.<br /><br />
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div id="newapp" class="col-lg-8 text-center">
                        <p>
                            <h5>So, are you ready to get started?</h5>
                                    <a onclick="opendash()" class="btn btn-info text-center">Yes</a>&nbsp;&nbsp;
                                    <a id="noBtn" class="btn btn-info" onclick="nostatus()">No</a>
                        </p>

                    </div>
                    <div class="col-lg-8 text-center">
                        <div id="noStatus" style="display:none;" class="card text-white bg-secondary mb-3" style="max-width: 40rem;">
                        
                            <div class="card-body">
                                <h5 class="card-title text-warning">NOT READY TO APPLY?</h5>
                                <div class="card-text">
                                    <p>
                                        If you are not ready, there is a guide on the <a href="http://www.phillyplse.org" class="text-info">phillyplse.org</a> website, and a lot of helpful information about pardons in Pennsylvania.
                                    </p>
                                    <p><a class="text-info" onclick="changestatus()">Changed your mind?</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    @if($status == 'new')
        <div id="dashboard" style="display:none;" class="container">
    @else
        <div id="dashboard" class="container">
    @endif

            <div>
        		<div class="h3 text-info">PardonMe™ Dashboard</div>
                <div class="h4">
                    Welcome to the PardonMe system.
                </div>
            </div>
            
        @if(count($applications) > 0)
            <div>
                <h5>Application List</h5>
                <p>
                    Below is a list of the applications you've started.  You can click to the continue button to keep working on it, or view current Pardon App.
                </p>
                <table class="table table-hover">
                <thead>
                    <tr class="table-info">
                        <th scope="res">ID</th>
                        <th scope="res">App Date</th>
                        <th scope="res">Level</th>
                        <th scope="res">&nbsp;</th>
                        <th scope="res">&nbsp;</th>
                    </tr>
                </thead>
            
                @foreach($applications as $app)
                    <tr class="table-dark">
                        <td>{{$app->id}}</td>
                        <td>{{$app->created_at}}</td>
                        <td>{{$app->status}}</td>
                        <td><a href="applications/level{{$app->status+1}}/{{$app->id}}" class="btn btn-info">Continue</a></td>
                        <td><a href="/forms/{{$app->id}}" class="btn btn-success" target="_blank">View Form</a></td>
                    </tr>
                @endforeach  
                <tr class="table-dark">
                    <td colspan="5">
                        <a href="/applications/create" class="btn btn-info">New Application</a>
                    </td>
                </tr>

                </table>
            </div>
        @else
            <div>
                <h5>Let's Get Started!</h5>
                <p>
                    Let's get started with your pardon application.  This site will take you through the steps to collect your information and level up your Pardons Application.
                </p>
                <div>
                    <a href="/applications/create" class="btn btn-info">Start Your Application</a>
                </div>
            </div>
        @endif
    </div>

 	@endsection