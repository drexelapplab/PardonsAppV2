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
                <p><a id="nextbtn" :href="'/applications/level7/'+id" class="btn btn-info">Continue to Level 7</a></p>
        </div>
        <form id="level6Form" @submit.prevent="formSubmit">
             <div class="card text-white bg-secondary mb-3">
                
                <div class="card-body">
                    <h4 class="card-title text-warning">LEVEL 6: WHY DO YOU WANT A PARDON?</h4>
                    <div class="card-text">
                        <p>
                            There are lots of reasons people apply for a pardon.  In this section, you’ll be telling why you want a pardon, and if you need it quickly, why.  This is not a matter of just checking the boxes- it’s about explaining to the government why this is so important to you, and why they should make an exception for you. 
                        </p>                      
                    
                    <hr style="background-color:#f39c12;" />
                    <p class="h5">Do you need a pardon so that...</p>
                    
                    <div class="form-check">
                        <input v-model="reasons.citizenship" id="form-citizen" type="checkbox" class="form-check-input"  />
                        <label for="form-citizen" class="form-check-label">
                            you can apply for citizenship?
                        </label>
                    </div>
                    <div class="form-check">
                        <input v-model="reasons.parent" id="form-parent" type="checkbox" class="form-check-input" />
                        <label for="form-parent" class="form-check-label">
                            you can adopt a child or be a foster parent?
                        </label>
                    </div>
                    <div class="form-check">
                        <input v-model="reasons.community" id="form-community" type="checkbox" class="form-check-input" />
                        <label for="form-community" class="form-check-label">
                            you can do more things in your communty (such as volunteering, mentoring, coaching, school activities, etc.)?
                        </label>
                    </div>
                    <div class="form-check">
                        <input v-model="reasons.school" id="form-school" type="checkbox" class="form-check-input" />
                        <label for="form-school" class="form-check-label">
                            you can go back to school?
                        </label>
                    </div>
                    <div class="form-check">
                        <input v-model="reasons.job" id="form-job" type="checkbox" class="form-check-input" />
                        <label for="form-job" class="form-check-label">
                            can go get a better job, either with your current employer or a different one?
                        </label>
                    </div>
                    <div class="form-check">
                        <input v-model="reasons.gun" id="form-gun" type="checkbox" class="form-check-input" />
                        <label for="form-gun" class="form-check-label">
                            you can own a gun or firearm?
                        </label>
                    </div>
                    <div class="form-check">
                        <input v-model="reasons.housing" id="form-housing" type="checkbox" class="form-check-input" />
                        <label for="form-housing" class="form-check-label">
                            you can get better housing?
                        </label>
                    </div> 
                    <div class="form-check">
                        <input v-model="reasons.license" id="form-license" type="checkbox" class="form-check-input" />
                        <label for="form-license" class="form-check-label">
                            you can get a license that you need or want for a job?
                        </label>
                    </div>
                    <div class="form-check">
                        <input v-model="reasons.military" id="form-military" type="checkbox" class="form-check-input" />
                        <label for="form-military" class="form-check-label">
                            you want to join the military?
                        </label>
                    </div>
                    <div class="form-check">
                        <input v-model="reasons.travel" id="form-travel" type="checkbox" class="form-check-input" />
                        <label for="form-travel" class="form-check-label">
                          you can travel outside of the United States?
                        </label>
                    </div>
                    <div class="form-check">
                        <input v-model="reasons.personal" id="form-personal" type="checkbox" class="form-check-input" />
                        <label for="form-personal" class="form-check-label">
                            Do you need a pardon for personal reasons (like having to do with setting a good example for your children, or not having to think of yourself anymore as a criminal)?
                        </label>
                    </div>
                    
                    <hr style="background-color:#f39c12;" />
                    
                    <div class="form-group">
                        <p>Has living with a criminal record made your life more difficult?</p>
                        <label for="difficult_status">
                            <input v-model="difficult_status" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="Yes" :checked="difficult_status == 'Yes'" />Yes
                        </label>
                        <label for="difficult_status">
                            <input v-model="difficult_status" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="No" :checked="difficult_status == 'No'" />No
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="difficult_descr">If yes, tell us why.</label>
                        <textarea v-model="difficult_descr" style="width:75%;" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <p>Have you ever been denied a job or fired from a job because of your criminal record? Or have you been denied a promotion or pay increase in your current job because of your record?</p>
                        <label for="jobdenied_status">
                            <input v-model="jobdenied_status" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="Yes" :checked=
                            "jobdenied_status == 'Yes'" />Yes
                        </label>
                        <label for="jobdenied_status">
                            <input v-model="jobdenied_status" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="No" :checked="jobdenied_status == 'No'"/>No
                        </label>
                    </div>
                    <div class="form-group">
                        <label style="width:75%;" for="jobdenied_descr">If yes, explain what bad thing happened to you.</label>
                        <textarea v-model="jobdenied_descr" v-on:change="dataChange();" style="width:75%;" class="form-control"></textarea>
                    </div>
                    <hr style="background-color:#f39c12;" />
                    <div>
                        <p class="h6">You should also check to see if you have any letters or emails where they say that - it's important if you do, and you should attach them to your application. You might also think about going to talk to a lawyer about this.</p>
                    </div> 

                    <div class="row form-group">
                        <div style="float:left;" class="col-md-6">
                          <a :href="'/applications/level5/'+id" v-on:change="dataChange();" style="margin:20px;" class="btn btn-info">BACK - LEVEL 5</a>
                        </div>
                        <div style="float:right;" class="col-md-6">
                            <button v-if="level<=savelevel || change == 'y'" style="margin:20px;" class="btn btn-info">NEXT - LEVEL 7</button>
                            <a v-else :href="'/applications/level7/'+id" style="margin:20px;" class="btn btn-info">NEXT - LEVEL 7</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
        </form>      
    </div>
</template>

<script>
  export default {
    data(){
        //add data fields connected to the v-model in the template
        return{ 
            errors: [], //error array used for validating form data
            id: $("#appid").attr("appid"),
            reasons: {
                citizenship: false,
                parent: false,
                community: false,
                school: false,
                job: false,
                gun: false,
                housing: false,
                license: false,
                military: false,
                travel: false,
                personal: false},
            pardon_reasons: '',
            difficult_status: '',
            difficult_descr: '',
            jobdenied_status: '',
            jobdenied_descr: '',
            successmsg: '',
            nexturl: '',
            check: '',
            level: '',
            savelevel: 6,
            success: '',
            change: ''
        }
    },
    methods: {
        mounted() {
        //get data for app_id form
        window.axios.get('/api/application/'+this.id).then(({ data }) => {
            if(data[0].pardon_reasons){this.reasons = JSON.parse(data[0].pardon_reasons)};
            this.difficult_status= data[0].difficult_status;
            this.difficult_descr = data[0].difficult_descr;
            this.jobdenied_status = data[0].jobdenied_status;
            this.jobdenied_descr = data[0].jobdenied_descr;
            this.level = data[0].status;
        });

      },

      //send level 2 data to the ApplicationController update app status to level 2
      formSubmit: function(event) {      

        //save reasons object to string
        this.pardon_reasons = JSON.stringify(this.reasons);

        //log entire model
        console.log(this.model);

        this.checkForm(); //validate form

        //check level
        if(this.level < 6){this.level = 6; }

        //if no errors then update data
        if(!this.errors.length){
            window.axios.put(`/api/applications/`+this.id, {id: this.id, pardon_reasons: this.pardon_reasons, difficult_status: this.difficult_status, difficult_descr: this.difficult_descr, jobdenied_status: this.jobdenied_status, jobdenied_descr: this.jobdenied_descr, level: this.level, savelevel: this.savelevel}).then(() => { 
                
                //display success message
                if(this.savelevel == this.level) {
                    this.success = 'success';
                    this.successmsg = 'Congrats on completing Level  6!';
                }
                else if(this.change == 'y') {
                    
                    this.success = 'success';
                    this.successmsg = 'Level 6 has been updated successfully.';
                } 
                
                
            });
        }

      },
      //validate form fields - add errors to the error array
      checkForm: function(e) {
        this.errors = [];
        if(!this.pardon_reasons){
            this.errors.push("Please select the reasons you're seeking a pardon.");
        }
        if(!this.difficult_status){
            this.errors.push('Please let us know if your conviction has made life harder.');
        }
        if(!this.difficult_descr && this.difficult_status == 'Yes'){
            this.errors.push('Please describe how your life became more difficult.');
        }
        if(!this.jobdenied_status){
            this.errors.push('Have you ever been denied a job?');
        }
        if(!this.jobdenied_descr && this.jobdenied_status == 'Yes'){
            this.errors.push('Describe how you were denied a job.');
        }        
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