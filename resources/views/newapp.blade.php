@extends('layouts.index')

    @section('head')
    @endsection

    @section('header')
 	@endsection
    
    @section('content')
    <script>
        function nostatus() {
            $("#noStatus").show();
            $("#newapp").hide();
        }

        function changestatus() {
            $("#noStatus").hide();
            $("#newapp").show();
        }
    </script>
    <div class="container">
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
        @include('layouts.errors')
        <div class="row">
            <div id="newapp" class="col-lg-8 text-center">
                <p>
                    <h5>So, are you ready to get started?</h5>
                    <form class="form-horizontal records" method="POST" action="users">
                            <fieldset>
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <input type="hidden" name="status" value="applicant" />
                            <input type="hidden" name="id" value="{{$user_id}}" />
                            <!--<input type="submit" class="btn btn-info text-center" value="Yes" />-->
                            <button class="btn btn-info text-center">Yes</button>&nbsp;&nbsp;
                            <a id="noBtn" class="btn btn-info" onclick="nostatus()">No</a>
                            </fieldset>
                    </form>
                    
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
 	@endsection