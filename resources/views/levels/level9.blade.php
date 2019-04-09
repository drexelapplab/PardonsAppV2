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
                    <h4 class="card-title text-warning">LEVEL 9: <span class="text-info">FINAL LEVEL</span> - THINGS YOU HAVE BEEN CHARGED WITH BUT NOT FOUND GUILTY OF</h4>
                    <div class="card-text">
                        <p>
                            The Board of Pardons also wants to know about other things you’ve been arrested and charged with – when you were a child (juvenile court) or an adult, including driving tickets you have gotten.  You don’t need to give as much detail, but they do want to know the date you were charged with the offense, whether it was a federal, state, or traffic offense, whether you were found guilty of it, and what your punishment was.
                        </p> 

                        <p>
                            Try to do the best job you can answering the questions. If you cannot remember, say that.  But do your best, because the state police will be checking, too, and you don’t want to report something that’s different from what the police find, if you can avoid that.
                        </p>
                        <p>
                            If you have gone to court and had your criminal record expunged (erased) by a Court Order, there shouldn’t be any records in the courthouse to get or to check.  That might make it difficult to answer the questions.  You might also want to get advice from a lawyer about your options, and what might be best for you to do. 
                        </p>
                        
                    </div>
                </div>
            </div>
        <div class="card text-white bg-secondary mb-3" style="max-width: 40rem;">
            <div class="card-body">
                <h5 class="card-title text-warning">TRAFFIC CITATIONS</h5>
                <div class="card-text">
                    <p>Now, the last area: TRAFFIC CITATIONS. We are NOT asking about parking tickets.  The Board of Pardons will be getting a copy of your Pennsylvania Driving Record.  You need to get your record to answer the questions in this section.</p>
                    <div id="citationsapp"></div>
                </div>
            </div>
        </div>
        <div class="card text-white bg-secondary mb-3" style="max-width: 40rem;">
            <div class="card-body">
                <h5 class="card-title text-warning">ADDITIONAL CITATIONS</h5>
                <p>
                    Now, we just want to check to make sure you've though of everything that the Board wants to know about.  There are three in particular they ask about in the application.
                </p>
                
                <p>
                    Have you ever been convicted of any of the <strong>harrasment</strong>, <strong>underaged drinking</strong>, or <strong>disorderly conduct</strong>?
                </p>
                <p>
                    If you answered YES to any of those questions you may ask for a pardon for these convictions too.  
                </p>
                <p><a href="level7/edit" class="btn btn-info">Request an additional pardon?</a></p>
                <p>Otherwise, enter any additional non-traffic citations below. <i>(harassment, underage drinking, disorderly conduct, etc.)</i>
                <div id="nocitationsapp"></div>                  
            </div>
        </div>
        <div class="row form-group">
        <div style="float:left;" class="col-md-6">
          <a href="level8" style="margin:20px;" class="btn btn-info">BACK - LEVEL 8</a>
        </div>
        <div style="float:right;" class="col-md-6">
            <a href="dashboard" style="margin:20px;" class="btn btn-info">FINISHED!</a>
        </div>
</div>

        @endauth
    @endsection