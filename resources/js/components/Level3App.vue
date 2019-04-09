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
            <h4>Congrats on completing Level 3!</h4>
                <p>
                    <a id="nextbtn" :href="'/applications/level4/'+id" class="btn btn-info">Continue to Level 4
                    </a>
                </p>
        </div>
        <form id="level3Form" @submit.prevent="formSubmit">
        <div class="card text-white bg-secondary mb-3">
            
            <div class="card-body">
                <h4 class="card-title text-warning">LEVEL 3: THINGS YOU DO IN YOUR COMMUNITY</h4>
                <div class="card-text">
                    <p>
                        This is a really important part of your application, because the Board of Pardons and the Governor wants to see that you are a good citizen, and that often means someone who helps someone who is not part of their family.
                    </p>
                    <p>
                        We have lots of questions we hope will help you think about this, to help you think about what you do for others.  If you haven’t done much volunteering, you might think about doing more of it before you send in your application.
                    </p>
                    <p>
                        Do you want to do this section now, or skip ahead to the next section?
                    </p>
                    
                    <a class="btn btn-info" :href="nexturl">
                        Go to LEVEL 4
                    </a>
                </div>
            </div>
        </div>

        <div class="card text-white bg-secondary mb-3">
        
            <div class="card-body">
                <h5 class="card-title text-warning">HAVE YOU VOLUNTEERED?</h5>
                <div class="card-text">
                    <div class="form-group">
                        <label for="vol_status">
                            <input v-model="vol_status" onclick="showVolForm()" style="margin:5px;" type="radio" class="radio-inline" value="Yes" :checked="vol_status == 'Yes'"/>Yes&nbsp;&nbsp;
                        </label>
                        <label for="vol_status">
                            <input v-model="vol_status" style="margin:5px;" onclick="hideVolForm()" type="radio" class="radio-inline" value="No" :checked="vol_status == 'No'"/>No
                        </label>
                    </div>
                    
                    <div id="volForm" v-show="vol_status == 'Yes'" >
                        <div id="volunteerapp"></div>
                    </div>
                </div>
            </div>
        </div>
       <div class="card text-white bg-secondary mb-3">            
            <div class="card-body">
                <h5 class="card-title text-warning">RELIGIOUS WORK</h5>
                <div class="card-text">
                    <div class="form-group">
                            <input v-model="rel_status" style="margin:5px;" onclick="showRelForm()" type="radio" class="radio-inline" value="Yes" :checked="rel_status == 'Yes'" />Yes&nbsp;&nbsp;
                            <input v-model="rel_status" style="margin:5px;" onclick="hideRelForm()" type="radio" class="radio-inline" value="No" :checked="rel_status == 'No'" />No
                    </div>
                    <div id="relForm" v-show="rel_status == 'Yes'">
                        <div id="religionapp"></div>
                    </div>
                </div>
            </div>
        </div>                  
        <div class="row form-group">
            <div style="float:left;" class="col-md-6">
              <a :href="'/applications/level2/'+id" style="margin:20px;" class="btn btn-info">BACK - LEVEL 2</a>
            </div>
            <div style="float:right;" class="col-md-6">
              <button style="margin:20px;" class="btn btn-info">NEXT - LEVEL 4</button>
            </div>
        </div>
    </form>
    </div>
</template>

<script>
  function Level3 ({id, vol_status, rel_status, status}) {
    this.id = id;
    this.vol_status = vol_status;
    this.rel_status = rel_status;
    this.level = status;
  }

  
  export default {
    data(){
        //add data fields connected to the v-model in the template
        return{ 
            errors: [], //error array used for validating form data
            appdata: [],
            id: $("#appid").attr("appid"),
            nexturl: '/applications/level4/'+$("#appid").attr("appid"),
            backurl: '/applications/level2/'+$("#appid").attr("appid"),
            vol_status: '',
            rel_status: '',
            level: '',
            savelevel: '3',
            successmsg: ''
        }
    },
    methods: {
      mounted() {
        //get data for app_id form
        window.axios.get(`/api/application/`+this.id).then(({ data }) => {
                    this.vol_status = data[0].vol_status;
                    this.rel_status = data[0].rel_status;
                    });

      },
      //send level 3 data to the ApplicationController update app status to level 3
      formSubmit: function(event) {      

        //log entire model
        console.log(this.model);

        this.checkForm(); //validate form

        //check level
        if(this.level < 3){this.level = 3; }

        //if no errors then update data
        if(!this.errors.length){
            window.axios.put(`/api/applications/`+this.id, {id: this.id, vol_status: this.vol_status, rel_status: this.rel_status,level: this.level, savelevel: this.savelevel }).then(() => { 
                //display success message
                this.successmsg = 'success';
            });
        }

      },
      //validate form fields - add errors to the error array
      checkForm: function(e) {
        this.errors = [];
        if(!this.vol_status){
            this.errors.push('Have you volunteered?');
        }
        if(!this.rel_status){
            this.errors.push('Do you volunteer in a place of worship?');
        }         
        //e.preventDefault();
      }
    },
    components: {
      
    },
    created() {
        this.mounted();
    }
  }
</script>