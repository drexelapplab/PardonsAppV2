<template id="job-form">
	
	<div id="app">
	<div id="errormsg" v-if="errors.length" style="position:fixed;top:1%;width:65%;z-index:1000;" class="alert alert-danger">
            <button type="button" class="close" v-on:click="errors = []">&times;</button>
            <strong>Please correct the following errors:</strong>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
        </div>

		<table style="width:75%" class="table table-hover">
            <thead>
                <tr class="table-info">
                    <th scope="res">Company</th>
                    <th scope="res">Position</th>
                    <th scope="res">&nbsp</th>
                    <th scope="res">&nbsp</th>
                </tr>
            </thead>
			<tr v-for="job in jobs" v-bind:id="'job'+job.id" class="table-dark">
				<td class="text-black">{{ job.company }}</td>
				<td class="text-black">{{ job.position }}</td>
				<td><a v-on:click="edit(job.id)" class="btn btn-info">Edit</a></td>
				<td><a v-on:click="del(job.id)" class="btn btn-info">Delete</a></td>
			</tr>

		</table>
	        <p style="width:75%;">
	         	What's the name of the company that you work for today?
                <br />
                <i>(If you work for more than one, tell us about one, and when you're done answering questions about that job, we'll start over.)</i>
            </p>
    <form id="jobform" @submit.prevent="formSubmit">
        <div class="form-group">

        	<input type="hidden" v-model="job_id" />

            <label for="companyfield">Company Name:</label>
            <input v-model="companyfield" style="width:75%;" type="text" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="timefield">How long have you worked for them?</label>
            <input v-model="timefield" style="width:75%;" type="text" class="form-control" />
        </div>
        <div class="form-group">                        
            <label for="positionfield">What is your job? What do you do for them?</label>
            <input v-model="positionfield" style="width:75%;" type="text" class="form-control" required />
        </div>
        <div class="form-group">                        
            <p>Have you received any promotions from them?<br />
            <label for="promotionsfield">
                <input v-model="promotionsfield" style="margin:5px;" type="radio" class="radio-inline" value="Yes" />Yes&nbsp;&nbsp;
            </label>
            <label for="promotionsfield">
                <input v-model="promotionsfield" style="margin:5px;" type="radio" class="radio-inline" value="No" />No
            </label>
            </p>

        </div>
        <div class="form-group">                        
            <label for="promo_descrfield">If yes, what promotions did you get? </label>
            <textarea v-model="promo_descrfield" style="width:75%;" rows="4" class="form-control" >    
            </textarea>
        </div> 
        <div clas="form-group">
            <p>Have you gotten any good performance evaluations from them?<br />
            <label for="evaluationfield">
                <input v-model="evaluationfield" style="margin:5px;" type="radio" class="radio-inline" value="Yes" />Yes&nbsp;&nbsp;
            </label>
            <label for="evalfield">
                <input v-model="evaluationfield" style="margin:5px;" type="radio" class="radio-inline" value="No" />No
            </label>
            </p>

        </div>
        <div class="form-group">
		    <button id="jobs-submit" style="margin-top:10px;" class="btn btn-info">Add</button>
		</div>
	</form>
	</div>

</template>


<script>
	import { checkdate } from '../app.js'

	function Job({id, company, position, time, promotions, promo_descr, evaluation}) {
		this.id = id;	
		this.company = company;
		this.position = position;
		this.time = time;
		this.promotions = promotions;
		this.promo_descr = promo_descr;
		this.evaluation = evaluation;
		//this.recommend = recommend;
		//this.recommend_name = recommend_name;
	}

	//import JobComponent from './JobComponent.vue';

	export default {
		data() {
				return {
					jobs: [],
					errors: [],
					app_id: $("#appid").attr("appid"), //from appid in blade template
					editstatus: '',
					job_id: '',
					companyfield: '',
					positionfield: '',
					timefield: '',
					promotionsfield: '',
					promo_descrfield: '',
					evaluationfield: '',
					working:false
				}
				
		},
		methods: {
			formSubmit: function(event) {
				
				if(!this.editstatus)
				{
	        		//send data to jobscontroller through api
			        axios.post('/api/job/'+this.app_id, ({ 
			        	app_id: this.app_id,
			        	company: this.companyfield,
			        	position: this.positionfield,
			        	time: this.timefield,
			        	promotions: this.promotionsfield,
			        	promo_descr: this.promo_descrfield,
			        	evaluation: this.evaluationfield
			        	//recommend: this.recommendfield,
			        	//recommend_name: this.recommend_namefield
			        	 }))
			        .then(({ data }) => {
			          this.jobs.push(new Job(data));
			          this.companyfield = '';
			          this.positionfield = '';
			          this.timefield = '';
			          this.promotionsfield = '';
			          this.promo_descrfield = '';
			          this.evaluationfield = '';
			          event.target.reset();
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
				        console.log(error.config);
				    });
			    }
			    if(this.editstatus == 'edit')
			    {
			    	this.update();
			    }

			},
			read() {
				this.jobs.length = 0; //empty array
				axios.get('/api/jobs/'+this.app_id).then(({ data }) => {
					if(data.length > 0){data.forEach(job => {
						this.jobs.push(new Job(job));
					});}
				});
			},
			update() {
				
			    	axios.put('/api/job/'+this.job_id, ({
			        	company: this.companyfield,
			        	position: this.positionfield,
			        	time: this.timefield,
			        	promotions: this.promotionsfield,
			        	promo_descr: this.promo_descrfield,
			        	evaluation: this.evaluationfield,
			        	app_id: this.app_id
			    	}))
			    	.then(({ data }) => {
			          this.companyfield = '';
			          this.positionfield = '';
			          this.timefield = '';
			          this.promotionsfield = '';
			          this.promo_descrfield = '';
			          this.evaluationfield = '';
			          this.editstatus = '';
			          this.read();
			          
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
			},
			edit: function(j) {
				this.editstatus = 'edit';			
				axios.get('/api/job/'+j).then(({ data }) => {
					data.forEach(job => {
					this.companyfield = job.company;
					this.positionfield = job.position;
					this.timefield = job.time;
					this.promotionsfield = job.promotions;
					this.promo_descrfield = job.promo_descr;
					this.evaluationfield = job.evaluation;
					this.job_id = j;
					});
				});
			},
			del: function(j) {
				//delete record
				//	this.errors.push('Deleting Record!');
				axios.delete('/api/job/'+j,({app_id: this.app_id})).then(function (response) {	console.log('job deleted');
				});
				var jobID = document.getElementById('job'+j);
				jobID.style.display = "none";
			},
			//validate form fields - add errors to the error array
      		checkForm: function(e) {

      		}
		},
		components: {
				//JobComponent
		},
		created() {
				this.read();
		}

	}
</script>
