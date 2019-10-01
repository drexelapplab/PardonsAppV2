<template>
    <div class="container">
        <!-- ERROR Message Container -->
        <div id="errormsg" v-if="errors.length" style="position:fixed;top:1%;width:65%;z-index:1000;" class="alert alert-danger">
                <button type="button" class="close" v-on:click="errors = []">&times;</button>
                <strong>Please correct the following errors:</strong>
                <ul>
                    <li v-for="error in errors">{{ error }}</li>
                </ul>
            </div>
            <!-- SUCCESS Message Container -->
            <div id="success" v-if="successmsg === 'success'" style="position:fixed;top:10%;width:65%;z-index:1100;left:15%;right:25%;" class="alert alert-success">
                <h4>Congrats on completing Level 8!</h4>
                    <p><a id="nextbtn" :href="'/applications/level9/'+id" class="btn btn-info">Continue to Level 9</a></p>
            </div>

            <form id="level8Form" @submit.prevent="formSubmit">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h4 class="card-title text-warning">LEVEL 8: ADDITIONAL CHARGES OR INCIDENTS</h4>
                        <div class="card-text">
                            <p>
                                Text regarding additional charges or incidents.
                            </p>
                            
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
                <div class="card text-white bg-secondary mb-3" style="max-width: 40rem;">
                    <div class="card-body">
                        <h5 class="card-title text-warning">ADULT CHARGES</h5>
                        <div class="card-text">
                            <p>Next, we are going to ask you about offenses you were charged with when you were an adult.</p>
                            <div id="adultcrimesapp"></div>
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
                <div class="row form-group">
                    <div style="float:left;" class="col-md-6">
                      <a :href="'/applications/level7/'+id" style="margin:20px;" class="btn btn-info">BACK - LEVEL 7</a>
                    </div>
                    <div style="float:right;" class="col-md-6">
                        <class="btn btn-info">NEXT - LEVEL 9</a>
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
            level: '',
            successmsg: '',
            nexturl: '',
            check: '',
            savelevel: 8

        }
    },
    methods: {
        mounted() {
        //get data for app_id form
        //window.axios.get(`/api/application/`+this.id).then(({ data }) => {
        //    if(this.level = data[0].status);

      },

      //send level 8 data to the ApplicationController update app status to level 8
      formSubmit: function(event) {      

        // //save reasons object to string
        // this.pardon_reasons = JSON.stringify(this.reasons);

        // //log entire model
        // console.log(this.model);

        // this.checkForm(); //validate form

        // //check level
        if(this.level < 8){this.level = 8; }

        // //if no errors then update data
         if(!this.errors.length){
             window.axios.put(`/api/applications/`+this.id, {id: this.id, level: this.level, savelevel: this.savelevel}).then(() => { 
                 //display success message
                 this.successmsg = 'success';
                
             });
         }

      },
      //validate form fields - add errors to the error array
      checkForm: function(e) {
        this.errors = [];
        //if(!this.pardon_reasons){
        //    this.errors.push("Please select the reasons you're seeking a pardon.");
        //}
      
      }
    },
    components: {
      
    },
    created() {
        this.mounted();
    }
  }
</script>