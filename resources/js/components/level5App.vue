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
                <p><a id="nextbtn" :href="'/applications/level6/'+id" class="btn btn-info">Continue to Level 6</a></p>
        </div>
        <form id="level5Form" @submit.prevent="formSubmit">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h4 class="card-title text-warning">LEVEL 5: DRUGS & ALCOHOL</h4>
                    <div class="card-text">
                        <p>
                            A really high number of crimes are committed by people who are “under the influence” – they had used drugs, or had too much to drink, right before they committed the crime.
                        </p>
                        <p>
                            In a different part of this program, you’ll be asked about the role that drugs or alcohol had in the crime you were convicted of.  But in this section, we are asking about you today – and remember that it’s really, really important to tell the truth here.  Don’t say what you think they want to hear.  Be honest. 
                        </p>                      
                        <hr style="background-color:#f39c12;" />
                        <div class="form-group">
                            <p style="width:75%;">Today, are you still drinking alcohol or using drugs?</p>
                            <label for="drink_status">
                                <input v-model="drink_status" v-on:change="dataChange();" type="radio" style="margin:5px;" class="radio-inline" onclick="showDrinkForm()" value="Yes" :checked="drink_status == 'Yes'" />Yes&nbsp;&nbsp;
                            </label>
                            <label for="drink_status">
                                <input v-model="drink_status" v-on:change="dataChange();" type="radio" class="radio-inline" style="margin:5px;" onclick="hideDrinkForm()" value="No" :checked="drink_status == 'No'" />No&nbsp;
                            </label>
                        </div>
                        <div id="drinkForm" class="form-group" v-show="drink_status == 'Yes'">
                            <div class="form-group">
                                <label style="width:75%;" for="drink_time">How long has it been since you last drank alcohol?</label>
                                <input v-model="drink_time" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control"  />
                            </div>
                            <div class="form-group">
                                <label style="width:75%;" for="drugs_time">How long has it been since you last used drugs?</label>
                                <input v-model="drugs_time" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control"  />
                            </div>
                            <div class="form-group">
                                <p style="width:55%;">Did you ever go to some kind of program like Alcoholics Anonymous?</p>
                                <label for="aaprogram_status">
                                    <input v-model="aaprogram_status" v-on:change="dataChange();" type="radio" style="margin:5px;" class="radio-inline" value="Yes" :checked="aaprogram_status == 'Yes'" />Yes&nbsp;&nbsp;
                                </label>
                                <label for="aaprogram_status">
                                    <input v-model="aaprogram_status" v-on:change="dataChange();" type="radio" style="margin:5px;" class="radio-inline" value="No" :checked="aaprogram_status == 'No'" />No&nbsp;
                                </label>
                            </div>
                            <div class="form-group">
                                <label style="width:75%;" for="aaprogram_start">When did you start going?</label>
                                <input v-model="aaprogram_start" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control"  />
                            </div>
                            <div class="form-group">
                                <p style="width:75%;">Are you still going?</p>
                                <label for="aaprogram_still">
                                    <input v-model="aaprogram_still" v-on:change="dataChange();" type="radio" style="margin:5px;" class="radio-inline" value="Yes" :checked="aaprogram_still == 'Yes'" />Yes&nbsp;&nbsp;
                                </label>
                                <label for="aaprogram_still">
                                    <input v-model="aaprogram_still" v-on:change="dataChange();" type="radio" style="margin:5px;" class="radio-inline" name="aaprogram_still" value="No" :checked="aaprogram_still == 'No'" />No&nbsp;
                                </label>
                            </div>
                            <div class="form-group">
                                <label style="width:75%;" for="aaprogram_stopped">When did you stop going?</label>
                                <input v-model="aaprogram_stopped" v-on:change="dataChange();" style="width:55%;" type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label style="width:75%;" for="aaprogram_how">If you stopped, how have you done since stopping?</label>
                                <textarea v-model="aaprogram_how" v-on:change="dataChange();" style="width:55%;" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <p style="width:75%;">Have you ever tried to help someone else who had a drug or alcohol problem?</p>
                            <label for="aaprogram_helped">
                                <input v-model="aaprogram_helped" v-on:change="dataChange();" type="radio" style="margin:5px;" class="radio-inline" value="Yes" :checked="aaprogram_helped == 'Yes'" />Yes&nbsp;&nbsp;
                            </label>
                            <label for="aaprogram_helped">
                                <input v-model="aaprogram_helped" v-on:change="dataChange();" type="radio" style="margin:5px;" class="radio-inline" value="No" :checked="aaprogram_helped == 'No'" />No&nbsp;
                            </label>
                        </div>
                        <div class="form-group">
                            <label style="width:75%;" for="aaprogram_descr">If yes, tell us about that, like when it was, who it was, and what you did to help.</label>
                            <textarea v-model="aaprogram_descr" v-on:change="dataChange();" style="width:75%;" class="form-control"></textarea>
                        </div>


                        <div class="row form-group">
                            <div style="float:left;" class="col-md-6">
                              <a :href="'/applications/level4/'+id" style="margin:20px;" class="btn btn-info">BACK - LEVEL 4</a>
                            </div>
                            <div style="float:right;" class="col-md-6">
                                <button v-if="level<=savelevel || change == 'y'" style="margin:20px;" class="btn btn-info">NEXT - LEVEL 6</button>
                                <a v-else :href="'/applications/level6/'+id" style="margin:20px;" class="btn btn-info">NEXT - LEVEL 6</a>
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
            drink_status: '',
            drink_time: '',
            drugs_time: '',
            aaprogram_status: '',
            aaprogram_start: '',
            aaprogram_still: '',
            aaprogram_stopped: '',
            aaprogram_how: '',
            aaprogram_helped: '',
            aaprogram_descr: '',
            successmsg: '',
            nexturl: '',
            level: '',
            savelevel: 5,
            success: '',
            change: ''
        }
    },
    methods: {
        mounted() {
        //get data for app_id form
        window.axios.get('/api/application/'+this.id).then(({ data }) => {
                    this.drink_status = data[0].drink_status;
                    this.drink_time= data[0].drink_time;
                    this.drugs_time = data[0].drugs_time;
                    this.aaprogram_status = data[0].aaprogram_status;
                    this.aaprogram_start = data[0].aaprogram_start;
                    this.aaprogram_still = data[0].aaprogram_still;
                    this.aaprogram_stopped = data[0].aaprogram_stopped;
                    this.aaprogram_how = data[0].aaprogram_how;
                    this.aaprogram_helped = data[0].aaprogram_helped;
                    this.aaprogram_descr = data[0].aaprogram_descr;
                    this.level = data[0].status;
                    });

      },

      //send level 2 data to the ApplicationController update app status to level 2
      formSubmit: function(event) {      

        //log entire model
        console.log(this.model);

        this.checkForm(); //validate form

        //check level
        if(this.level < 5){this.level = 5; }

        //if no errors then update data
        if(!this.errors.length){
            window.axios.put(`/api/applications/`+this.id, {id: this.id, drink_status: this.drink_status, drink_time: this.drink_time, drugs_time: this.drugs_time, aaprogram_status: this.aaprogram_status, aaprogram_start: this.aaprogram_start, aaprogram_still: this.aaprogram_still, aaprogram_stopped: this.aaprogram_stopped, aaprogram_how: this.aaprogram_how, aaprogram_helped: this.aaprogram_helped, aaprogram_descr: this.aaprogram_descr, level: this.level, savelevel: this.savelevel}).then(() => { 
                
                //display success message
                if(this.savelevel == this.level) {
                    this.success = 'success';
                    this.successmsg = 'Congrats on completing Level  5!';
                }
                else if(this.change == 'y') {
                    
                    this.success = 'success';
                    this.successmsg = 'Level 5 has been updated successfully.';
                } 
                
                
            });
        }

      },
      //validate form fields - add errors to the error array
      checkForm: function(e) {
        this.errors = [];
        if(!this.drink_status){
            this.errors.push('Your drinking status is required.');
        }
        if(!this.drink_time && this.drink_status == 'Yes'){
            this.errors.push('Your drinking time frame is required.');
        }
        if(!this.drugs_time && this.drink_status == 'Yes'){
            this.errors.push('Your drug use time frame is required.');
        }
        if(!this.aaprogram_status && this.drink_status == 'Yes'){
            this.errors.push('Your AA Program status is reqiured');
        }
        if(!this.aaprogram_start && this.aaprogram_status == 'Yes'){
            this.errors.push('Let us know when you started in an AA Program.');
        }
        if(!this.aaprogram_still && this.aaprogram_status == 'Yes'){
            this.errors.push("Let us know if you're still attending an AA Program.");
        } 
        if(!this.aaprogram_stopped && this.aaprogram_still == 'No' && this.aaprogram_status == 'Yes'){
            this.errors.push('Let us know when you stopped attending an AA Program.');
        }
        if(!this.aaprogram_how && this.aaprogram_still == 'No' && this.aaprogram_status == 'Yes'){
            this.errors.push("Let us know how you're doing if you've stopped attending AA.");
        }
        if(!this.aaprogram_helped){
            this.errors.push('Have you helped someone else attend an AA Program?');
        }
        if(!this.aaprogram_descr && this.aaprogram_heped == 'Yes'){
            this.errors.push('Let us know how you helped someone else.');
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