<template>    
  <div class="container">
        <!-- ERROR Message Container -->
        <div id="errormsg" v-if="errors.length" class="alert alert-danger custom-alert">
            <button type="button" class="close" v-on:click="errors = []">&times;</button>
            <strong>Please correct the following errors:</strong>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
        </div>
        <!-- SUCCESS Message Container -->
        <div id="success" v-if="success === 'success'" class="alert alert-success custom-success">
            <h4>{{ successmsg }}</h4>
                <p><a id="nextbtn" :href="'/applications/level2/'+id" class="btn btn-info">Continue to Level 2</a></p>
        </div>        
        <form id="level1Form" @submit.prevent="formSubmit">
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
                    
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input v-model="first_name" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control" size="20" required />
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name: (<i>no initials</i>)</label>
                        <input v-model="middle_name" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control" />
                    </div>
                    <div class="form-group">                        
                        <label  for="last_name">Last Name:</label>
                        <input v-model="last_name" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control" required />
                    </div>
                    <div class="form-group">                        
                        <label class="" for="suffix">If you have something after your name like Jr, II, III, what is it?</label>
                        <input v-model="suffix" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control" />
                    </div>
                    <div class="form-group">                        
                        <label style="width:55%;" for="nickname">Have you ever gone by another name - like a nickname, or the name you had before you got married, or the same name you had in another marriage? <br /><br />Type in all of the other names you have been known by:
                        </label>
                        <input v-model="nickname" v-on:change="dataChange();" type="text" style="width:75%;" rows="4" class="form-control" />
                    </div>  
                    <div class="form-group">
                        <label for="birthdate">When were you born?<br /> <i>(use MM/DD/YYYY format)</i></label><br />
                        <input v-model="birthdate" v-on:change="dataChange();" style="width:25%;" type="text" class="form-control" required />  
                    </div>
                    <div class="form-group">
                        <label for="ssn">What is your Social Security Number?<br /><i>(Use format 111-11-1111)</i></label>
                        <input v-model="ssn" v-on:change="dataChange();" style="width:35%;" type="text" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <p>Are you male or female?</p>
                                    <label for="gender">
                                    <input v-model="gender" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="male" />
                                    Male</label>
                                    <label for="gender">
                                    <input v-model="gender" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="female" />
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
                                        <input v-model="race" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="White/Caucasion" />
                                            White/Caucasion
                                    </label>
                                    <label for="race">
                                        <input v-model="race" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="Black/African American" />
                                            Black/African
                                    </label>
                                    <label for="race">
                                        <input v-model="race" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="Asian" />
                                            Asian
                                    </label><br />
                                    <label for="race">
                                        <input v-model="race" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="Native American">
                                            Native American
                                    </label>
                                    <label for="race">
                                        <input v-model="race" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="Hispanic/Latino" />
                                            Hispanic/Latino
                                    </label>
                                    <label for="race">
                                        <input v-model="race" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="Other" />
                                            Other
                                    </label><br />
                                    <label for="race">
                                        <input v-model="race" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="Do Not Wish to Disclose" />
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
                            <input v-model="address" v-on:change="dataChange();" style="width:55%;" type="text" size="10" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="address2">Apartment Number:</label>
                            <input v-model="address2" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="city">Town or City:</label>
                            <input v-model="city" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="state">State:</label>
                            <input v-model="state" v-on:change="dataChange();" style="width:10%;" type="text"class="form-control" disabled />
                        </div>
                        <div class="form-group">
                            <label for="zipcode">Zip Code:</label>
                            <input v-model="zipcode" v-on:change="dataChange();" style="width:35%;" type="text" class="form-control" size="2" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address_time">How long have you lived at this address?</label>
                        <input v-model="address_time" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="phone">What is the best phone number to reach you at?</label>
                        <input v-model="phone" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control" />
                    </div>
                    <div class="form-group">    
                        <label for="phone2">Is there another number where you can be called?<br /> Like at work or through a friend?</label>
                        <input v-model="phone2" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control" />
                    </div>
                    <p>
                        Please enter information regarding your representation.
                    </p>
                    <div class="form-group">
                        <p style="width:35%;">
                            Please enter who is going to be representing you.
                        </p>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="representation">
                                        <input v-model="representation" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="Self" />
                                            Self
                                    </label>
                                    <label for="representation">
                                        <input v-model="representation" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="Friend" />
                                            Friend
                                    </label>
                                    <label for="representation">
                                        <input v-model="representation" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="Family" />
                                            Family
                                    </label><br />
                                    <label for="representation">
                                        <input v-model="representation" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="Attorney">
                                            Attorney
                                    </label>
                                    <label for="representation">
                                        <input v-model="representation" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="Board" />
                                            Board
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">    
                        <label for="repname">Please enter the name of your representative. </label>
                        <input v-model="rep_name" style="width:55%;" v-on:change="dataChange();" type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <p style="width:45%;" class="">
                            What's the address of your representative?
                        </p>
                        <div class="form-group">
                            <label for="repadd">Number and Street:</label>
                            <input v-model="rep_address" v-on:change="dataChange();" style="width:55%;" type="text" size="10" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="repadd2">Apartment Number:</label>
                            <input v-model="rep_address2" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="repcity">Town or City:</label>
                            <input v-model="rep_city" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="repstate">State:</label>
                            <input v-model="rep_state" v-on:change="dataChange();" style="width:10%;" type="text"class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="repzipcode">Zip Code:</label>
                            <input v-model="rep_zip" v-on:change="dataChange();" style="width:35%;" type="text" class="form-control" size="2" required />
                        </div>
                    </div>
                    <div class="form-group">    
                        <label for="repphone">What's the phone number of your representative?</label>
                        <input v-model="rep_phone" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control" />
                    </div>
                    <div class="form-group">    
                        <label for="repemail">What is the email address of your representative?</label>
                        <input v-model="rep_email" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control" />
                    </div>
                    <div class="row">
                        <div class="form-group">
                          <button v-if="level<=savelevel || change == 'y'" style="float:right;margin:20px;" class="btn btn-info">NEXT - LEVEL 2</button>
                          <a v-else :href="'/applications/level2/'+id" style="float:right;margin:20px;" class="btn btn-info">NEXT - LEVEL 2</a>                            
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </form>
    </div>
</template>

<script>
  import { checkdate } from '../app.js'
  export default {
    data(){
        //add data fields connected to the v-model in the template
        return{ 
            errors: [], //error array used for validating form data
            id: $("#appid").attr("appid"),
            first_name: '',
            middle_name: '',
            last_name: '',
            suffix: '',
            nickname: '',
            birthdate: '',
            ssn: '',
            gender: '',
            race: '',
            address_time: '',
            address: '',
            address2: '',
            city: '',
            state: 'PA',
            zipcode: '', 
            phone: '',
            phone2: '',
            representation: '',
            rep_name: '',
            rep_address: '',
            rep_address2: '',
            rep_city: '',
            rep_state: '',
            rep_zip: '',
            rep_phone: '',
            rep_email: '',
            level: '',
            successmsg: '',
            nexturl: '',
            savelevel: 1,
            success: '',
            change: ''
        }
    },
    methods: {
        mounted() {
        //get data for app_id form
        window.axios.get(`/api/application/`+this.id).then(({ data }) => {
                    this.first_name = data[0].first_name;
                    this.last_name= data[0].last_name;
                    this.middle_name = data[0].middle_name;
                    this.suffix = data[0].suffix;
                    this.nickname = data[0].nickname;
                    this.birthdate = data[0].birthdate;
                    this.ssn = data[0].ssn;
                    this.gender = data[0].gender;
                    this.race = data[0].race;
                    this.address_time = data[0].address_time;
                    this.address = data[0].address;
                    this.address2 = data[0].address2;
                    this.city = data[0].city;
                    this.state = data[0].state;
                    this.zipcode = data[0].zipcode;
                    this.phone = data[0].phone;
                    this.phone2 = data[0].phone2;
                    this.level = data[0].status;
                    this.representation = data[0].representation
                    this.rep_name = data[0].rep_name
                    this.rep_address = data[0].rep_address
                    this.rep_address2 = data[0].rep_address2
                    this.rep_city = data[0].rep_city
                    this.rep_state = data[0].rep_state
                    this.rep_zip = data[0].rep_zip
                    this.rep_phone = data[0].rep_phone
                    this.rep_email = data[0].rep_email
                    });

      },
      //send level 1 data to the ApplicationController update app status to level 1
      formSubmit: function(event) {
        //get the application id from custom appid tag in blade template
        //this.id = $("#appid").attr("appid"); 

        //log entire model
        console.log(this.model);

        this.checkForm(); //validate form

        //check level
        if(this.level <= 1){this.level = 1; }

        //if no errors then update data
        if(!this.errors.length){
            window.axios.put(`/api/applications/`+this.id, ({id: this.id, first_name: this.first_name, middle_name: this.middle_name, last_name:this.last_name, suffix: this.suffix, nickname: this.nickname, birthdate: this.birthdate, ssn: this.ssn, gender: this.gender, race: this.race, address_time: this.address_time, address: this.address, address2: this.address2, state: this.state, city: this.city, zipcode: this.zipcode, phone: this.phone, phone2: this.phone2, representation: this.representation, rep_name: this.repname, rep_address: this.rep_address, rep_address2: this.rep_address2, rep_city: this.rep_city, rep_state: this.rep_state, rep_zip: this.rep_zip, rep_phone: this.rep_phone, rep_email: this.rep_email, level: this.level, savelevel: this.savelevel }))
            .then(({ data }) => { 
                    //display success message
                    if(this.savelevel == this.level) {
                        this.success = 'success';
                        this.successmsg = 'Congrats on completing Level  1!';
                    }
                    else if(this.change == 'y') {
                        
                        this.success = 'success';
                        this.successmsg = 'Level 1 has been updated successfully.';
                    }                
                
            })
            .catch((error) => {
                if (error.response) {
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                } else if (error.request) {
                    console.log(error.request);
                } else {
                    console.log('Error', error.message);
                }
                console.log(error.config);;
            });
        }

      },
      //validate form fields - add errors to the error array
      checkForm: function(e) {
        this.errors = [];
        if(!this.first_name){
            this.errors.push('First Name is required.');
        }
        if(!this.last_name){
            this.errors.push('Last Name is required.');
        }
        if(!this.birthdate){
            this.errors.push('Birthdate is required.');
        }
        if(!checkdate(this.birthdate)){
            this.errors.push('Please use MM/DD/YYYY for your birthday.')
        }
        if(!this.ssn){
            this.errors.push('SSN is required.');
        }
        if(!this.gender){
            this.errors.push('Gender is required.');
        }
        if(!this.race){
            this.errors.push('Race is required.');
        }
        if(!this.address_time){
            this.errors.push('Address Time is required.');
        }
        if(!this.address){
            this.errors.push('Street Address is required.');
        }
        if(!this.city){
            this.errors.push('City is required.');
        } 
        if(!this.phone){
            this.errors.push('Please provide a Phone number.');
        }              
        //e.preventDefault();
      },
    dataChange: function(){
            if(this.level >= this.savelevel) {
               this.change = 'y'; 
            }
           
        }
    },
    components: {
      
    },
    created() {
        this.mounted();
    }
  }
</script>