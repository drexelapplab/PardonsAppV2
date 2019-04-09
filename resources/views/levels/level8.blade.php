@extends('layouts.index')

    @section('head')
    @endsection

    @section('header')
    @endsection
    
    @section('content')
        @auth <!-- are you logged in? -->
        @include('progress.progress')
    
        <div class="container">
            <div class="card text-white bg-secondary mb-3">
                
                <div class="card-body">
                    <h4 class="card-title text-warning">LEVEL 8: CONVICTIONS YOU DON'T WANT A PARDON FOR</h4>
                    <div class="card-text">
                        <p>
                            There’s no limit on the number of convictions you can ask for a pardon for at one time. The Board of Pardons is going to look at your entire record – all the crimes in Pennsylvania that you’ve been charged with and been found guilty of.
                        </p>
                        <p>
                            They won’t think you are greedy if you ask for pardons for all of them.  If you want to add another, click <a class="text-info" href="/level7/edit">HERE.</a>  But if you don't have a reason you don't want to ask for a pardon for one or more crimes you've been convictged of, this is the section when you talk about those other crimes.
                        </p>
                        
                    </div>
                </div>
            </div>
            <div class="card text-white bg-secondary mb-3" style="max-width: 40rem;">
                <div class="card-body">
                    <h5 class="card-title text-warning">CONVICTIONS YOU'RE <span class="text-info">NOT</span> ASKING A PARDON FOR</h5>
                    <div class="card-text">
                        <div id="nopardonsapp"></div>
                    </div>
                </div>
            </div>

        <div class="card text-white bg-secondary mb-3" style="max-width: 40rem;">
            <div class="card-body">
                <h5 class="card-title text-warning">JUVENILE COURT</h5>
                <div class="card-text">
                    <p>Next, we are going to ask you about offenses you were charged with when you were a child, that would have gone to Juvenile Court.</p>
                    <div id="youthcrimesapp"></div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div style="float:left;" class="col-md-6">
              <a href="level1" style="" class="btn btn-info">BACK - LEVEL 1</a>
            </div>
            <div style="float:right;" class="col-md-6">
                <a href="level9" class="btn btn-info">NEXT - LEVEL 9</a>
            </div>
        </div>
</div>

        @endauth
    @endsection