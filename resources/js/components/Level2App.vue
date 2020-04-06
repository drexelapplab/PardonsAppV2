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
                <p><a id="nextbtn" :href="'/applications/level3/'+id" class="btn btn-info">Continue to Level 3</a></p>
        </div>
        <form id="level2Form" @submit.prevent="formSubmit">
           <div class="card text-white bg-secondary mb-3">
                
                <div class="card-body">
                    <h4 class="card-title text-warning">LEVEL 2: WORK, JOBS, AND EDUCATION</h4>
                    <div class="card-text">
                        <p>The Board of Pardons wants to know what you have done with yourself after you finished serving your sentence.  In this section, you'll be asked about whether you've gone back to school, learned any new trade, and have been successful at getting and holding jobs.
                        </p>
                        <p>You are not required to have done any of these things before you ask for a parodon; but if you have, your success might help persuade the Board of Pardons that you have earned a pardon.  If you have not yet done these things, you might think about doing them before you apply for a pardon.
                        </p>
                        <p class="" ><b>Tell us about the job(s) you have now.</b> If you don't have a job today, tell us about the last job you had.</p>
                    </div>
                </div>
            </div>
            <div class="card text-white bg-secondary mb-3">
                
                <div class="card-body">
                    <h5 class="card-title text-warning">WORK EXPERIENCE</h5>
                    <div class="card-text">                      
                                <div class="form-group">
                                    <label for="job_how_long">Since your conviction, have you been able to work?</label>
                                    <select v-model="job_how_long" v-on:change="dataChange();" style="width:30%;" class="form-control">
                                        <option>Every Year</option>
                                        <option>Almost Every Year</option>
                                        <option>Most Years</option>
                                        <option>Some Years</option>
                                        <option>None</option>
                                    </select>
                                </div>
<!-- TODO save and display jobs to the Jobs table - include the current AppID!! -->
                    <div id="jobapp"></div>
                </div>
            </div>
        </div>
        <div class="card text-white bg-secondary mb-3">
            <div class="card-body">
                <h5 class="card-title text-warning">SCHOOL</h5>
                <div class="card-text">
                    <div class="form-group">
                        <p>
                            Have you gone back to school after you finished your sentence?
                        </p>

                        <label for="retschool_status">
                            <input v-model="retschool_status" v-on:change="dataChange();" onclick="showRetSchool()" style="margin:5px;" type="radio" class="radio-inline" value="Yes" :checked="retschool_status == 'Yes'" />Yes&nbsp;&nbsp;
                        </label>
                        <label for="retschool_status">
                            <input v-model="retschool_status" v-on:change="dataChange();"style="margin:5px;" onclick="hideRetSchool()" type="radio" class="radio-inline" value="No" :checked="retschool_status == 'No'" />No
                        </label>
                    </div>
                    <div id="retschoolForm" class="form-group" v-show="retschool_status == 'Yes'">
                        <div id="educationapp"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card text-white bg-secondary mb-3">
            <div class="card-body">
                <h5 class="card-title text-warning">RECOMMENDATIONS</h5>
                <div class="card-text">
                    <div class="form-group">
                        <p>Do you think someone there would be willing to write a letter of recommendation for you?<br />
                            <label for="rec_status">
                            <input v-model="rec_status" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" onclick="showRecommend()" value="Yes" :checked="rec_status == 'Yes'"/>Yes&nbsp;&nbsp;
                            </label>
                            <label for="rec_status">
                            <input v-model="rec_status" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" onclick="hideRecommend()" value="No" :checked="rec_status == 'No'" />No
                            </label>
                        </p>
                    </div>
                    <div id="recommendForm" v-show="rec_status == 'Yes'">
                        <div id="recommendapp"> </div>
                    </div>                        
                </div>
            </div>
        </div>
        <div class="card text-white bg-secondary mb-3">
            <div class="card-body">
                <h5 class="card-title text-warning">EXPERIENCES</h5>
                    <div class="card-text">

                        <div class="form-group">
                            <p>Has your conviction kept you from getting into any program or school, or from getting any job?<br />                                
                            <label for="con_status">
                                <input v-model="con_status" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="Yes" :checked="con_status == 'Yes'" />Yes&nbsp;&nbsp;
                            </label>
                            <label for="con_status">
                                <input v-model="con_status" v-on:change="dataChange();" style="margin:5px;" type="radio" class="radio-inline" value="No" :checked="con_status == 'No'" />No
                            </label></p>

                        </div>
                        <div class="form-group">
                            <label for="con_descr">Tell us about that. What did you apply for that you wanted to get in, but were not allowed in?</label>
                            <textarea v-model="con_descr" v-on:change="dataChange();" style="width:75%;" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
            </div>
        </div>

            <div class="row form-group">
                <div style="float:left;" class="col-md-6">
                  <a :href="'/applications/level1/'+id" style="margin:20px;" class="btn btn-info">BACK - LEVEL 1</a>
                </div>
                <div style="float:right;" class="col-md-6">
                    <button v-if="level<=savelevel || change == 'y'" style="margin:20px;" class="btn btn-info">NEXT - LEVEL 3</button>
                    <a v-else :href="'/applications/level3/'+id" style="margin:20px;" class="btn btn-info">NEXT - LEVEL 3</a>
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
            job_how_long: '',
            retschool_status: '',
            rec_status: '',
            con_status: '',
            con_descr: '',
            level: '',
            successmsg: '',
            nexturl: '',
            level: '',
            savelevel: 2,
            success: '',
            change: ''
        }
    },
    methods: {
        mounted() {
        //get data for app_id
        window.axios.get('/api/application/'+this.id).then(({ data }) => {
                    this.job_how_long = data[0].job_how_long;
                    this.retschool_status= data[0].retschool_status
                    this.rec_status = data[0].rec_status;
                    this.con_status = data[0].con_status;
                    this.con_descr = data[0].con_descr;
                    this.level = data[0].status;
                    });

      },

      //send level 2 data to the ApplicationController update app status to level 2
      formSubmit: function(event) {      

        //log entire model
        console.log(this.model);

        //check level
        if(this.level < 2){this.level = 2; }

        this.checkForm(); //validate form
        //if no errors then update data
        if(!this.errors.length){
            window.axios.put(`/api/applications/`+this.id, {id: this.id, job_how_long: this.job_how_long, retschool_status: this.retschool_status, rec_status: this.rec_status, con_status: this.con_status, con_descr: this.con_descr, level: this.level, savelevel: this.savelevel }).then(() => { 
                    //display success message
                    if(this.savelevel == this.level) {
                        this.success = 'success';
                        this.successmsg = 'Congrats on completing Level  2!';
                    }
                    else if(this.change == 'y') {
                        
                        this.success = 'success';
                        this.successmsg = 'Level 2 has been updated successfully.';
                    } 
                
            });
        }

      },
      //validate form fields - add errors to the error array
      checkForm: function(e) {
        if(!this.job_how_long){
            this.errors.push('How long have you held a job?');
        }
        if(!this.retschool_status){
            this.errors.push('Did you return to school?');
        }
        if(!this.rec_status){
            this.errors.push('Do you have any recommendations?');
        }
        if(!this.con_status){
            this.errors.push('Have you been denied a job or education?');
        }
        if(this.con_status === 'Yes' && !this.con_descr){
            this.errors.push('Please desribe your experience of being denied.');
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