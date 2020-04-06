@extends('layouts.index')

    @section('head')
    @endsection

    @section('header')
 	@endsection
    
    @section('content')
    <div class="container">
        <div>
    		<div class="h3">Welcome to PardonMe™</div>
            <div class="h5">
            Help for completing an application for a pardon in Pennsylvania
            </div>
        </div><br />
        <div class="row">

            <div class="col-lg-12">
                <p>
                    This website is designed to assist people in completing the pardon process within Philadelphia.  

                Create an account to get started!
            </p><br />

            </div>

        </div>
        <div class="row">
            <div class="text-center">
                <a href="register" class="btn btn-info text-center">Create Account</a>&nbsp;&nbsp;
                <a href="login" class="btn btn-info">Already have an account? &nbsp;Login!</a>
            </div>
    		
    	</div>
    </div>
 	@endsection