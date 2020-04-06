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
                <p><a id="nextbtn" :href="'/applications/level10/'+id" class="btn btn-info">Continue to Level 10</a></p>
        </div>
            <form id="level9Form" @submit.prevent="formSubmit">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h4 class="card-title text-warning">LEVEL 9: PERSONAL NARRATIVE</h4>
                        <div class="card-text">
                            <p>
                            The Board of Pardons is looking to understand your story. Use the information regarding your employment, education, and volunteering to provide a picture of your positive efforts since serving your sentence.  Use statements like the following to show your appreciation for this opportunity.
                            </p>
                            <p><strong>Example Phrases:</strong>
                                <ul>
                                    <li>"I'm thankful for this opportunity..."</li>
                                    <li>"I regret my prior actions..."</li>
                                    <li>other sentences?</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-warning">NARRATIVE</h5>
                    <div class="card-text">
                        <div class="row">
                            <div class="col-lg form-group">
                                
                                <textarea v-model="narrative" v-on:change="dataChange();"class="form-control" rows="20" />
                                
                            </div>
                            <div class="col-sm-5">
                                <div class="modal fade" id="exp-modal" tabindex="-1" role="dialog" aria-labelledby="Experience Details" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <p id="exp-details"></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4>Experience Information</h4>
                                <p>Use the information you provided below to assist with your narrative. If you need to add additional information, go to <a :href="'../level2/'+id"> Level 2 </a>and then return here. </p>
                                <div>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#jobs">Jobs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#schools">Education</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#volunteer">Vols</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#recs">
                                        Recs</a>
                                        </li>
                                    </ul>
                                </div>
                                <div id="narrative-content" class="tab-content">
                                    <div class="tab-pane fade active show" id="jobs">
                                        <p v-if="jobs.length == 0">No information provided.</p>                                       
                                        <ul v-else>
                                            <li v-for="job in jobs" v-bind:id="job.id"class="nar-tabs">
                                                <a href="#" data-toggle="modal" data-target="#exp-modal" v-on:click="updateModal('job'+job.id);">
                                                    {{ job.company }} - {{ job.position }}
                                                </a>
                                                <div v-bind:id="'job'+job.id" style="display:none;">
                                                    <div  class="nar-details">
                                                        <h5>Job Details</strong></h5>
                                                        <hr />
                                                        <ul>
                                                            <li><strong>Company:</strong> {{ job.company }} </li>
                                                            <li><strong>Position:</strong> {{ job.position }} </li>
                                                            <li><strong>Time:</strong> {{ job.time }}</li>
                                                            <li><strong>Promotions:</strong> {{ job.promotions }}</li>
                                                             <li><strong>Promotion Description: </strong>{{ job.promo_descr }}</li>
                                                            <li><strong>Good Evalutions: </strong>{{ job.evaluation }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="schools">
                                        <p v-if="educations.length == 0">No information provided.</p>                                        
                                        <ul v-else> 
                                            <li v-for="education in educations" v-bind:id="education.id"class="nar-tabs">
                                                    <a href="#" data-toggle="modal" data-target="#exp-modal" v-on:click="updateModal('ed'+school.id);">
                                                    {{ education.location }}
                                                    </a>
                                                <div v-bind:id="'ed'+education.id" style="display:none;">
                                                    <div  class="nar-details">
                                                        <h5>Education Details</h5>
                                                        <hr />
                                                        <ul>
                                                            <li><strong>Location:</strong> {{ education.location }}</li>
                                                            <li><strong>Type:</strong> {{ education.edtype }}</li>
                                                            <li><strong>Date:</strong> {{ education.education_date }}</li>
                                                            <li><strong>Program</strong> {{ education.program }}</li>
                                                            <li><strong>Certification:</strong> {{ education.cert }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="volunteer">
                                        <p v-if="volunteers.length == 0">No information provided.</p>
                                        <ul v-else>
                                            <li v-for="volunteer in volunteers" v-bind:id="volunteer.id" class="nar-tabs">
                                                <a href="#" data-toggle="modal" data-target="#exp-modal" v-on:click="updateModal('vol'+volunteer.id);">
                                                    {{ volunteer.vol_date }} - {{ volunteer.vol_helped }}
                                                </a>
                                                <div v-bind:id="'vol'+volunteer.id" style="display:none;">
                                                    <div  class="nar-details">
                                                        <h5>Volunteer Details</h5>
                                                        <hr />
                                                        <ul>
                                                            <li><strong>Date:</strong> {{ volunteer.vol_date}}</li>
                                                            <li><strong>Who Helped?:</strong> {{ volunteer.vol_helped }}</li>
                                                            <li><strong>Description:</strong> {{ volunteer.vol_descr }}</li>
                                                            <li><strong>Did you help organize it?</strong> {{ volunteer.vol_organize }}</li>
                                                        </ul>
                                                    </div>
                                                </div> 
                                            </li>
                                        </ul>                                      
                                    </div>
                                    <div class="tab-pane fade" id="recs">
                                        <p v-if="recommends.length == 0">No information provided.</p>
                                        <ul v-else>
                                            <li v-for="recommend in recommends" class="nar-tabs">                           
                                                <a href="#" data-toggle="modal" data-target="#exp-modal" v-on:click="updateModal('rec'+recommend.id);">
                                                    {{ recommend.name }} - {{ recommend.location }}
                                                </a>
                                                <div v-bind:id="'rec'+recommend.id" style="display:none;">
                                                    <div  class="nar-details">
                                                        <h5>Recommendation Details</h5>
                                                        <hr />
                                                        <ul>
                                                            <li><strong>Name:</strong> {{ recommend.name}}</li>
                                                            <li><strong>Type:</strong> {{ recommend.type }}</li>
                                                            <li><strong>Location:</strong> {{ recommend.location }}</li>
                                                            <li><strong>Email:</strong> {{ recommend.email }}</li>
                                                            <li><strong>Phone:</strong> {{ recommend.phone }}</li>
                                                        </ul>
                                                    </div>
                                                </div> 
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row form-group">
                    <div style="float:left;" class="col-md-6">
                        <a :href="'/applications/level8/'+id" style="margin:20px;" class="btn btn-info">BACK - LEVEL 8
                        </a>
                    </div>
                    <div style="float:right;" class="col-md-6">
                        <button v-if="level < savelevel || change=='y'" v-on:click="formSubmit()" style="margin:20px;" class="btn btn-info">NEXT - LEVEL 10</button>
                        <a v-else :href="'/applications/level10/'+id" class="btn btn-info">NEXT - LEVEL 10</a>
                    </div> 
                </div>              
            </form>
    </div>
</template>

<script>
    
    function Volunteer({id, vol_descr, vol_date, vol_helped, vol_organize, vol_time}) {
        this.id = id;
        this.vol_descr = vol_descr;
        this.vol_date = vol_date;
        this.vol_helped = vol_helped;
        this.vol_organize = vol_organize;
        this.vol_time = vol_time;
    }

    function Education({id, edtype, education_date, location, program, didfinish, finish, cert}) {
        this.id = id;
        this.edtype = edtype;
        this.education_date = education_date;
        this.location = location;
        this.program = program;
        this.didfinish = didfinish;
        this.finish = finish;
        this.cert = cert;
    }
    
    function Job({id, company, position, time, promotions, promo_descr, evaluation}) {
        this.id = id;   
        this.company = company;
        this.position = position;
        this.time = time;
        this.promotions = promotions;
        this.promo_descr = promo_descr;
        this.evaluation = evaluation;

    }

    function Recommend({id, type, name, location, email, phone}) {
        this.id = id;
        this.type = type;
        this.name = name;
        this.location = location;
        this.email = email;
        this.phone = phone;
    }
  export default {
    data(){
        //add data fields connected to the v-model in the template
        return{ 
            errors: [], //error array used for validating form data
            jobs: [],
            educations: [],
            recommends: [],
            volunteers: [],
            id: $("#appid").attr("appid"),
            narrative: '',
            level: '',
            successmsg: '',
            nexturl: '',
            check: '',
            savelevel: 9,
            success: '',
            change: '',
        }
    },
    methods: {
        mounted() {
            //get application info
            axios.get('/api/applications/'+this.id).then(({ data }) => {
                    data.forEach(application => {
                    this.narrative = application.narrative;
                    this.level = application.status;
                    });
                });
            //get volunteer info
            axios.get('/api/volunteers/'+this.id).then(({ data }) => {
                if(data.length > 0){data.forEach(volunteer => {
                    this.volunteers.push(new Volunteer(volunteer));
                });}
            });
            //get job info
            axios.get('/api/jobs/'+this.id).then(({ data }) => {
                    if(data.length > 0){data.forEach(job => {
                        this.jobs.push(new Job(job));
                    });}
                });
            //get education info
            axios.get('/api/educations/'+this.id).then(({ data }) => {
                    if(data.length > 0){data.forEach(education => {
                        this.educations.push(new Education(education));
                    });}
                });
            //get recommendation info
            axios.get('/api/recommends/'+this.id).then(({ data }) => {
                    if(data.length > 0){data.forEach(recommend => {
                        this.recommends.push(new Recommend(recommend));
                    });}
                });
        },
        //send level 9 data to the ApplicationController update app status to level 9
        formSubmit: function(event) {      

            // log entire model
             console.log(this.model);

            this.checkForm(); //validate form

            // //check level
            if(this.level < 9){this.level = 9; }

            //if no errors then update data
            if(!this.errors.length){
                window.axios.put(`/api/applications/`+this.id, {id: this.id, narrative: this.narrative, level: this.level, savelevel: this.savelevel}).then(() => { 
                    //display success message
                    if(this.savelevel == this.level && !this.change) {
                        this.success = 'success';
                        this.successmsg = 'Congrats on completing Level  9!';
                    }
                    else if(this.change == 'y') {
                        this.success = 'success';
                        this.successmsg = 'Level 9 has been updated successfully.';
                    } 
                
                });
            }

        },
        //validate form fields - add errors to the error array
        checkForm: function(e) {
            this.errors = [];
            if(!this.narrative){
                this.errors.push("Please supply a narrative.");
            }
      
        },
        dataChange: function(){
            
            if(this.level >= this.savelevel) {
               this.change = 'y'; 
            }
           
        },
        updateModal: function(m) {
            var exp = $('#'+m);
            var modal = $('#exp-details');
            modal.html("");
            modal.html(exp.html());
            }
    },
    components: {
      
    },
    created() {
        this.mounted();
    }
  }
</script>