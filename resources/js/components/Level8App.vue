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
                    <p><a id="nextbtn" :href="'/applications/level9/'+id" class="btn btn-info">Continue to Level 9</a></p>
            </div>

            <form id="level8Form" @submit.prevent="formSubmit">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h4 class="card-title text-warning">LEVEL 8: ADDITIONAL CRIMINAL INFORMATION AND DRIVER HISTORY</h4>
                        <div class="card-text">
                            <p>
                            Aside from the offenses you are seeking a pardon for, have you ever, as an adult or juvenile, been:
                                <ul>
                                    <li>Arrested</li>
                                    <li>Taken into custody</li>
                                    <li>Held for investigation or questioning</li>
                                    <li>Charged by any law enforcement authority</li>
                                    <li>Convicted in any court</li>
                                </ul>
                            <strong>You are not required to list charges that were expunged.</strong>
                            </p>

                            <div class="form-group">
                                <label for="other_incidents">Since your conviction, do you have any of the above incidents to report?</label>
                                <select v-model="other_incidents" v-on:change="dataChange();" style="width:30%;" class="form-control">
                                    <option v-if="other_incidents" selected>{{ other_incidents }} </option>
                                    <option>No</option>
                                    <option>Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-warning">JUVENILE CHARGES, ADJUDICATIONS OF DELIQUENCY, AND/OR CONSENT DECREES</h5>
                        <div class="card-text">
                            <div id="youthcrimesapp"></div>
                        </div>
                    </div>
            </div>
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title text-warning">ADULT CHARGES</h5>
                    <div class="card-text">
                        <div id="nopardonsapp"></div>
                    </div>
                </div>
            </div>
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title text-warning">DRIVING CITATIONS</h5>
                    <div class="card-text">
                        <div id="citationsapp"></div>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div style="float:left;" class="col-md-6">
                  <a :href="'/applications/level7/'+id" style="margin:20px;" class="btn btn-info">BACK - LEVEL 7</a>
                </div>
                <div style="float:right;" class="col-md-6">
                    <button v-if="level<savelevel || change == 'y'" v-on:click="formSubmit()" style="margin:20px;" class="btn btn-info">NEXT - LEVEL 9</button>
                    <a v-else :href="'/applications/level9/'+id" class="btn btn-info">NEXT - LEVEL 9</a>
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
            other_incidents: '',
            level: '',
            successmsg: '',
            nexturl: '',
            check: '',
            savelevel: 8,
            success: '',
            change: ''

        }
    },
    methods: {
        mounted() {
        //get data for app_id form
            axios.get('/api/applications/'+this.id).then(({ data }) => {
                    data.forEach(application => {
                    this.other_incidents = application.other_incidents;
                    this.level = application.status;
                    });
                });
      },

      //send level 8 data to the ApplicationController update app status to level 8
      formSubmit: function(event) {      

        // log entire model
         console.log(this.model);

        this.checkForm(); //validate form

        // //check level
        if(this.level < 8){this.level = 8; }

        // //if no errors then update data
         if(!this.errors.length){
             window.axios.put(`/api/applications/`+this.id, {id: this.id, other_incidents: this.other_incidents, level: this.level, savelevel: this.savelevel}).then(() => { 
                      //display success message
                    if(this.savelevel == this.level) {
                        this.success = 'success';
                        this.successmsg = 'Congrats on completing Level  8!';
                    }
                    else if(this.change == 'y') {
                        
                        this.success = 'success';
                        this.successmsg = 'Level 8 has been updated successfully.';
                    } 
                
             });
         }

      },
      //validate form fields - add errors to the error array
      checkForm: function(e) {
        this.errors = [];
        if(!this.other_incidents){
           this.errors.push("Please select whether you have any other incidents to share.");
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