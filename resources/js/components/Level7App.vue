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
            <h4>Congrats on completing Level 7!</h4>
                <p><a id="nextbtn" :href="'/applications/level8/'+id" class="btn btn-info">Continue to Level 8</a></p>
        </div>
        <form id="level7Form" @submit.prevent="formSubmit">
            <div class="card text-white bg-secondary mb-3">
                
                <div class="card-body">
                    <h4 class="card-title text-warning">LEVEL 7: CRIMES YOU WANT A PARDON FOR</h4>
                    <div class="card-text">
                        <p>
                            You’re allowed to ask for a pardon for as many crimes as you want – there’s no maximum number – but you have to give lots of specific information about each crime you’ve been convicted of, and it has to be exactly right – or otherwise your application will get slowed down or you will have to start over.  You have to attach several official documents to your application before you can send it in, so you need to go to the courthouse where you were convicted and get them (we give you a checklist at the end), so think about doing that now. 
                        </p>
                        <p>
                            You might be able get some information about your convictions online.  Here’s how.  
                            <ul>
                                <li>
                                    Go to the <a class="has-warning" href="https://ujsportal.pacourts.us/DocketSheets/CP.aspx">Pennsylvania Supreme Court website</a>.
                                </li>
                                <li>
                                    Go down to the bottom of the page.  Under SEARCH TYPE choose PARTICIPANT NAME.  
                                </li>
                                <li>
                                    Type in your name (last name first) and your date of birth.  
                                </li>
                                <li>
                                    Below that, where it asks for COUNTY, fill in the name of the county where you were convicted.  (There are other options you can use, too.)  
                                </li>
                                <li>
                                    When you get the result, go over to the left and right click on the symbol.
                                </li>
                            </ul>
                            The OTN will tell you what happened in a particular case; the COURT SUMMARY should give a list of all of your court case.  Whether the list is complete could depend on how long ago your conviction was.
                        </p>  
                        <p>
                            On this form, you will be asked the same series of questions for every conviction you want a pardon for.  You can look through the list now, to see what you’ll need – just scroll down.
                        </p>
                    </div>
                </div>
            </div>
            <div id="convictionapp"></div>
        </form> 
        <div class="row form-group">
            <div style="float:left;" class="col-md-6">
                <a :href="'/applications/level6/'+id" style="margin:20px;" class="btn btn-info">BACK - LEVEL 6</a>
            </div>
            <div style="float:right;" class="col-md-6">
                <button style="margin:20px;" class="btn btn-info">NEXT - LEVEL 8</button>
            </div>
</div>     
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
            savelevel: 7

        }
    },
    methods: {
        mounted() {
        //get data for app_id form
        //window.axios.get(`/api/application/`+this.id).then(({ data }) => {
        //    if(this.level = data[0].status);

      },

      //send level 2 data to the ApplicationController update app status to level 2
      formSubmit: function(event) {      

        // //save reasons object to string
        // this.pardon_reasons = JSON.stringify(this.reasons);

        // //log entire model
        // console.log(this.model);

        // this.checkForm(); //validate form

        // //check level
        if(this.level < 7){this.level = 7; }

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