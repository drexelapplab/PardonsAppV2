<template>    
  <div class="container">
        <div id="save-alert" style="display:none;" class="alert alert-success">
        <strong>Your application has been saved!</strong>
        </div>
        <div style="width:90%;" class="card text-white bg-secondary mb-3">  
            <div class="card-body">
                <h4 class="card-title text-warning">LEVEL 1: WARM UP</h4>
                <div class="card-text">
                    <p class="">
                        Let’s start with your name and other personal information about you. You have to give this so the state police and the Board of Pardons can be sure they find all of the records that they need to process your application.
                    </p>

                    <p>
                        First, what is your real name – the one on your drivers license or your birth certificate?
                    </p>
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input v-model="first_name" style="width:55%;" type="text" class="form-control" size="20" required />
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name: (<i>no initials</i>)</label>
                        <input v-model="middle_name" style="width:55%;" type="text" class="form-control" />
                    </div>
                    <div class="form-group">                        
                        <label  for="last_name">Last Name:</label>
                        <input v-model="last_name" style="width:55%;" type="text" class="form-control" required />
                    </div>
                    <div class="form-group">                        
                        <label class="" for="suffix">If you have something after your name like Jr, II, III, what is it?</label>
                        <input v-model="suffix" style="width:55%;" type="text" class="form-control" />
                    </div>
                    <div class="form-group">                        
                        <label style="width:55%;" for="nickname">Have you ever gone by another name - like a nickname, or the name you had before you got married, or the same name you had in another marriage? <br /><br />Type in all of the other names you have been known by:
                        </label>
                        <input v-model="nickname" type="text" style="width:75%;" rows="4" class="form-control" />
                    </div>  
                    <div class="form-group">
                        <label for="birthdate">When were you born?<br /> <i>(use 01/01/2000 format)</i></label><br />
                        <input v-model="birthdate" style="width:25%;" type="text" class="form-control" required />  
                    </div>
                    <div class="form-group">
                        <label for="ssn">What is your Social Security Number?<br /><i>(Use format 111-11-1111)</i></label>
                        <input v-model="social" style="width:35%;" type="text" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <p>Are you male or female?</p>
                                    <label for="gender">
                                    <input v-model="gender" style="margin:5px;" type="radio" class="radio-inline" value="male" />
                                    Male</label>
                                    <label for="gender">
                                    <input v-model="gender" style="margin:5px;" type="radio" class="radio-inline" value="female" />
                                    Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <p style="width:35%;">
                            They want to know your race - you have to pick from one of these options:
                        </p>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="race">
                                        <input v-model="race" style="margin:5px;" type="radio" class="radio-inline" value="White/Caucaion" />
                                            White/Caucasion
                                    </label>
                                    <label for="race">
                                        <input v-model="race" style="margin:5px;" type="radio" class="radio-inline" value="Black/African American" />
                                            Black/African
                                    </label>
                                    <label for="race">
                                        <input v-model="race" style="margin:5px;" type="radio" class="radio-inline" value="Asian" />
                                            Asian
                                    </label><br />
                                    <label for="race">
                                        <input v-model="race" style="margin:5px;" type="radio" class="radio-inline" value="Native American">
                                            Native American
                                    </label>
                                    <label for="race">
                                        <input v-model="race" style="margin:5px;" type="radio" class="radio-inline" value="Hispanic/Latino" />
                                            Hispanic/Latino
                                    </label>
                                    <label for="race">
                                        <input v-model="race" style="margin:5px;" type="radio" class="radio-inline" value="Other" />
                                            Other
                                    </label><br />
                                    <label for="race">
                                        <input v-model="race" style="margin:5px;" type="radio" class="radio-inline" value="Do Not Wish to Disclose" />
                                        Do Not Wish to Disclose
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <p style="width:45%;" class="">
                            Getting a pardon can take a few years.  You always want to be sure that they can get in touch with you.  As you back-up, you can give the phone number of a member of your family or a friend.  If you end up moving, be sure to let them know - this app has a form for you to use.
                        </p>
                         <p>
                            What's the best place to send mail to you?
                        </p>
                        <div class="form-group">
                            <label for="address">Number and Street:</label>
                            <input v-model="address" style="width:55%;" type="text" size="10" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="address2">Apartment Number:</label>
                            <input v-model="address2" style="width:55%;" type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="city">Town or City:</label>
                            <input v-model="city" style="width:55%;" type="text" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="state">State:</label>
                            <input v-model="state" style="width:10%;" type="text"class="form-control" disabled />
                        </div>
                        <div class="form-group">
                            <label for="zipcode">Zip Code:</label>
                            <input v-model="zipcode" style="width:35%;" type="text" class="form-control" size="2" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address_time">How long have you lived at this address?</label>
                        <input v-model="address_time" style="width:55%;" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="phone">What is the best phone number to reach you at?</label>
                        <input v-model="phone" style="width:55%;" type="text" class="form-control" />
                    </div>
                    <div class="form-group">    
                        <label for="phone2">Is there another number where you can be called?<br /> Like at work or through a friend?</label>
                        <input v-model="phone2" style="width:55%;" type="text" class="form-control" />
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div>{{ info }} </div>
                            <button @click="update()" style="float:right;margin:20px;" class="btn btn-info">
                                Next - Level 2
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
		data() {
				return {
					id: '',
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    suffix: '',
                    nickname: '',
                    birthdate: '',
                    social: '',
                    gender: '',
                    race: '',
                    address_time: '',
                    address: '',
                    address2: '',
                    city: '',
                    state: '',
                    zipcode: '',
                    ziggy: '',
                    phone: '',
                    phone2: '',
                    level: 1,
                    info: 'Response',
					working:false
				}
				
		},
		methods: {
			update() {
                this.id = $("#appid").attr("appid");
                alert('id:'+this.id);
                window.axios.put(`/api/applications/${this.id}`,{ 
		        	id: this.id, first_name: this.first_name, middle_name: this.middle_name, last_name:this.last_name, suffix: this.suffix, nickname: this.nickname, birthdate: this.birthdate, social: this.social, gender: this.gender, race: this.race, address_time: this.address_time, address: this.address, address2: this.address2, state: this.state, city: this.city, zipcode: this.zipcode, phone: this.phone, phone2: this.phone2, level: 1
		        	 }).then((response) => {this.info = response;})
			},
			read() {

			},
			create() {
				//TODO
			},
			edit() {
				//TODO
			},
			del() {
				//TODO
			},
            savealert() {
                $("#save-alert").fadeIn(200).delay(1000).fadeOut(200);     
            }

		},
		components: {
				
		},
		created() {
				this.savealert();
		}

	}
</script>
