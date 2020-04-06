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
                <p><a id="nextbtn" :href="'/applications/level5/'+id" class="btn btn-info">Continue to Level 5</a></p>
        </div>
        <form id="level4Form" @submit.prevent="formSubmit">
             <div class="card text-white bg-secondary mb-3">        
                <div class="card-body">
                    <h4 class="card-title text-warning">LEVEL 4: &nbsp;WHAT HAVE YOU LEARNED FROM YOUR EXPERIENCE WITH THE CRIMINAL JUSTICE SYSTEM?</h4>
                    <div class="card-text">
                        <p>
                            The Governor, and the Board of Pardons, want to know that whatever made you do what you did before, you won’t do again.  These questions will help tell them that.
                        </p>                      
                        <hr style="background-color:#f39c12;" />
                        <div class="form-group">
                            <label for="not_repeat" style="width:75%;">Most people could say that that they made mistakes about who they were with and where they went and won’t do it again.  How will the board know you won’t do it again?</label>
                            <textarea v-model="not_repeat" v-on:change="dataChange();" style="width:75%;" name="not_repeat" class="form-control">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label style="width:75%;" for="choice">After you finished serving your sentence, did you find yourself in the same kind of situation and make a different choice?  Tell us about that.</label>
                            <textarea v-model="choice" v-on:change="dataChange();" style="width:75%;" name="choice" class="form-control">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="teach" style="width:75%;">Have you used what you learned to teach other people (including your children) about how to avoid doing what you did? Tell us about that.</label>
                            <textarea v-model="teach" v-on:change="dataChange();" style="width:75%;" name="teach" class="form-control">
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row form-group">
                <div style="float:left;" class="col-md-6">
                  <a :href="'/applications/level3/'+id" style="margin:20px;" class="btn btn-info">BACK - LEVEL 3</a>
                </div>
                <div style="float:right;" class="col-md-6">
                    <button v-if="level<=savelevel || change == 'y'" style="margin:20px;" class="btn btn-info">NEXT - LEVEL 5</button>
              <a v-else :href="'/applications/level5/'+id" style="margin:20px;" class="btn btn-info">NEXT - LEVEL 5</a>
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
            not_repeat: '',
            choice: '',
            teach: '',
            level: '',
            savelevel: 4,
            successmsg: '',
            nexturl: '',
            success: '',
            change: ''
        }
    },
    methods: {
        mounted() {
        //get data for app_id form
        window.axios.get('/api/application/'+this.id).then(({ data }) => {
                    this.not_repeat= data[0].not_repeat;
                    this.choice = data[0].choice;
                    this.teach = data[0].teach;
                    this.level = data[0].status;
                    });

      },
      //send level 1 data to the ApplicationController update app status to level 1
      formSubmit: function(event) {

        //log entire model
        console.log(this.model);

        //check level
        if(this.level < 4){this.level = 4; }

        this.checkForm(); //validate form
        
        //if no errors then update data
        if(!this.errors.length){
            window.axios.put(`/api/applications/`+this.id, {id: this.id, 
                not_repeat: this.not_repeat, 
                choice: this.choice, 
                teach: this.teach, 
                level: this.level,
                savelevel: this.savelevel 
            })
            .then(() => { 
                //display success message
                if(this.savelevel == this.level) {
                    this.success = 'success';
                    this.successmsg = 'Congrats on completing Level  4!';
                }
                else if(this.change == 'y') {
                    
                    this.success = 'success';
                    this.successmsg = 'Level 4 has been updated successfully.';
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
        if(!this.not_repeat){
            this.errors.push('A response about not repeating your crime is required.');
        }
        if(!this.choice){
            this.errors.push('A response about your choices is required.');
        }
        if(!this.teach){
            this.errors.push('A response about teaching others is required.');
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