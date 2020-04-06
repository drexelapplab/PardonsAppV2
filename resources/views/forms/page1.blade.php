<html>

	<style>

		.form {
			position:absolute;
			font-size:1.1em;
		}
		#requestor_name{
			top:160px;
			left:118px;
		}

		#address{
			top:190px;
			left:118px;
		}

		#city_state{
			top:219px;
			left:118px;
		}

		#phone{
			top:320px;
			left:42px;
			font-size:1.2em;
			letter-spacing:25px;
		}

		#first_name {
			top:365px;
			left:42px;
		}

		#middle_name {
			top:365px;
			left:240px;
		}

		#last_name {
			top:365px;
			left:452px;
		}

		#nickname {
			top:411px;
			left:42px;
		}

		#social {
			top:411px;
			left:238px;
		}

		#birthdate {
			top:411px;
			left:451px;
		}

		#gender {
			top:411px;
			left:580px;
		}

		#race {
			top:411px;
			left:640px;
		}



	</style>

	<body>
		<img width="100%" height="auto" src='/users/astutzman/webdev/pardonme/public/forms/form-page1.png' />
		<!--<img  style="position:absolute;left:6px;" width="54%" height="auto" src='/forms/form-page1.png' />-->
		<!-- Request Name and Address -->
		<span id="requestor_name" class="form">{{$application->first_name}} {{$application->middle_name}} {{$application->last_name}}</span>
		<span id="address" class="form">{{$application->address}} {{$application->address2}}</span>
		<span id="city_state" class="form">{{$application->city}}, {{$application->state}} {{$application->zipcode}}</span>

		<!-- Contact Info -->
		<span id="phone" class="form">{{$application->phone}}</span>
		<span id="first_name" class="form">{{$application->first_name}}</span>
		<span id="middle_name" class="form">{{$application->middle_name}}</span>
		<span id="last_name" class="form">{{$application->last_name}}</span>
		<span id="nickname" class="form">{{$application->social}}</span>
		<span id="social" class="form">{{$application->ssn}}</span>
		<span id="birthdate" class="form">{{$application->birthdate}}</span>
		<span id="gender" class="form">{{$application->gender}}</span>
		<span id="race" class="form">{{$application->race}}</span>
	</body>

</html>