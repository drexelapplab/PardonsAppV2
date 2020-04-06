@extends('layouts.index')

    @section('head')
    @endsection

    @section('header')
    @endsection

    @section('content')
    
        @auth <!-- are you logged in? -->

        @include('progress.progress')
    
        <div class="container">
            <div style="width:90%;" class="card text-white bg-secondary mb-3">
                
                <div class="card-body">
                    <h4 class="card-title text-warning">LEVEL 1: WARM UP</h4>
                    <div class="card-text">
                        <p class="">Let’s start with your name and other personal information about you. You have to give this so the state police and the Board of Pardons can be sure they find all of the records that they need to process your application.
                        </p>

                        <p class="" >First, what is your real name – the one on your drivers license or your birth certificate?</p>

                        @include('layouts.errors')

                        <form class="form-horizontal records" method="POST" action="/applications/{{$newID}}/update">
                            <fieldset>
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$newID}}" />

                            <div class="form-group">
                                <label class="" for="first_name">First Name:</label>
                                <input style="width:55%;" type="text" class="form-control" name="first_name" size="20" required />
                            </div>
                            <div class="form-group">
                                <label class="" for="middle_name">Middle Name: (<i>no initials</i>)</label>
                                <input style="width:55%;" type="text" class="form-control" name="middle_name"  />
                            </div>
                            <div class="form-group">                        
                                <label  for="last_name">Last Name:</label>
                                <input style="width:55%;" type="text" class="form-control" name="last_name" required />
                            </div>
                            <div class="form-group">                        
                                <label class="" for="suffix">If you have something after your name like Jr, II, III, what is it?</label>
                                <input style="width:55%;" type="text" class="form-control" name="suffix"  required />
                            </div>
                            <div class="form-group">                        
                                <label style="width:55%;"  for="nickname">Have you ever gone by another name - like a nickname, or the name you had before you got married, or the same name you had in another marriage? <br /><br />Type in all of the other names you have been known by:
                                </label>
                                <input type="text" style="width:75%;" rows="4" class="form-control" name="nickname" required />
                            </div>  
                            <div class="form-group">
                                <label for="birthdate">When were you born?<br /> <i>(use 01/01/2000 format)</i></label><br />
                                <input style="width:25%;" type="text" class="form-control" name="birthdate" required />  
                            </div>
                            <div class="form-group">
                                <label class="" for="ssn">What is your Social Security Number?<br /><i>(Use format 111-11-1111)</i></label>
                                <input style="width:35%;" type="text" class="form-control" name="social" required />
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <p>Are you male or female?</p>
                                            <label for="gender">
                                            <input style="margin:5px;" type="radio" class="radio-inline" name="gender" value="male" />
                                            Male</label>
                                            <label for="gender">
                                            <input style="margin:5px;" type="radio" class="radio-inline" name="gender" value="female" />
                                            Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <p style="width:35%;">They want to know your race - you have to pick from one of these options:
                                </p>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="race">
                                                <input style="margin:5px;" type="radio" class="radio-inline" name="race" value="White/Caucaion" />
                                            White/Caucasion</label>
                                            <label for="race">
                                                <input style="margin:5px;" type="radio" class="radio-inline"  name="race" value="Black/African American" />
                                                    Black/African</label>
                                            <label for="race">
                                                <input style="margin:5px;" type="radio" class="radio-inline"  name="race" value="Asian" />
                                                    Asian
                                            </label><br />
                                            <label for="race">
                                                <input style="margin:5px;" type="radio" class="radio-inline"  name="race" value="Native American">
                                                    Native American
                                            </label>
                                            <label for="race">
                                                <input style="margin:5px;" type="radio" class="radio-inline"  name="race" value="Hispanic/Latino" />
                                                    Hispanic/Latino
                                            </label>
                                            <label for="race">
                                                <input style="margin:5px;" type="radio" class="radio-inline"  name="race" value="Other" />
                                                    Other
                                            </label><br />
                                            <label for="race">
                                                <input style="margin:5px;" type="radio" class="radio-inline" name="race" value="Do Not Wish to Disclose" />
                                                Do Not Wish to Disclose
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <p style="width:45%;" class="">Getting a pardon can take a few years.  You always want to be sure that they can get in touch with you.  As you back-up, you can give the phone number of a member of your family or a friend.  If you end up moving, be sure to let them know - this app has a form for you to use.</p>
                                 <p>
                                    What's the best place to send mail to you?
                                </p>
                                <div class="form-group">
                                    <label for="address">Number and Street:</label>
                                    <input style="width:55%;" type="text" size="10" class="form-control" name="address" required />
                                </div>
                                <div class="form-group">
                                    <label for="address2">Apartment Number:</label>
                                    <input style="width:55%;" type="text" class="form-control" name="address2" />
                                </div>
                                <div class="form-group">
                                    <label for="city">Town or City:</label>
                                    <input style="width:55%;" type="text" class="form-control" name="city" required/>
                                </div>
                                <div class="form-group">
                                    <label for="state">State:</label>
                                    <input style="width:10%;" type="text"class="form-control" name="state" value="PA" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="zipcode">Zip Code:</label>
                                    <input style="width:35%;" type="text" class="form-control" size="2" name="zipcode" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address_time">How long have you lived at this address?</label>
                                <input style="width:55%;" type="text" class="form-control"  />
                            </div>
                            <div class="form-group">
                                <label for="phone">What is the best phone number to reach you at?</label>
                                <input style="width:55%;" type="text" class="form-control" />
                            </div>
                            <div class="form-group">    
                                <label for="phone2">Is there another number where you can be called?<br /> Like at work or through a friend?</label>
                                <input style="width:55%;" type="text" class="form-control" name="phone2" />
                            </div>

                            <div class="row">
                                <div class="form-group">
                                  <div class="btn btn-info" onclick="$('#autosave').fadeIn('slow').animate({opacity: 1.0}, 1500).effect('pulsate', { times: 2 }, 800).fadeOut('slow');">Auto Save!</div>
                                  <button style="float:right;margin:20px;" class="btn btn-info">Next - Level 2</a>
                                </div>
                            </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endauth
    @endsection