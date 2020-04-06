<template>
	<div id="app">
	<div id="errormsg" v-if="errors.length" class="alert alert-danger custom-alert">
            <button type="button" class="close" v-on:click="errors = []">&times;</button>
            <strong>Please correct the following errors:</strong>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
        </div>

		<table style="width:75%" class="table table-hover">
            <thead>
                <tr class="table-info">
                	<th scope="col">Date</th>
                    <th scope="col">School</th>
                    <th scope="col">&nbsp</th>
                    <th scope="col">&nbsp</th>
                </tr>
            </thead>
			<tr v-for="education in educations" v-bind:id="'ed'+education.id" class="table-dark">
				<td class="text-black">{{ education.education_date }}</td>
				<td class="text-black">{{ education.location }}</td>
				<td><a v-on:click="edit(education.id)" class="btn btn-info">Edit</a></td>
				<td><a v-on:click="del(education.id)" class="btn btn-info">Delete</a></td>
			</tr>

		</table>
	<form id="Educationform" @submit.prevent="formSubmit">
	    <div class="form-group">
	    	<p>What type of school did you attend?<br />
	    	<label for="edtypefield">
                <input v-model="edtypefield" style="margin:5px;" type="radio" class="radio-inline" value="GED Program" />GED Program&nbsp;&nbsp;
            </label>
            <label for="edtypefield">
                <input v-model="edtypefield" style="margin:5px;" type="radio" class="radio-inline" value="Professional Certification" />Professional Certification
            </label>
            <label for="edtypefield">
                <input v-model="edtypefield" style="margin:5px;" type="radio" class="radio-inline" value="Trade School" />Trade School
            </label>
            <label for="edtypefield">
                <input v-model="edtypefield" style="margin:5px;" type="radio" class="radio-inline" value="College" />College
            </label></p>
	    	<label for="education_datefield">When did you start?</label>
	    	<input v-model="education_datefield" style="width:25%;" class="form-control">
		    <label for="locationfield">Where did you go back to school?</label>
		    <input v-model="locationfield" style="width:55%;" class="form-control">
		    <label for="programfield">What did you study?</label>
		    <input v-model="programfield" style="width:55%;" class="form-control" >

		</div>
		<div class="form-group">
            <p>Did you finish?<br />
            <label for="didfinishfield">
                <input v-model="didfinishfield" style="margin:5px;" type="radio" class="radio-inline" value="Yes" />Yes&nbsp;&nbsp;
            </label>
            <label for="didfinishfield">
                <input v-model="didfinishfield" style="margin:5px;" type="radio" class="radio-inline" value="No" />No
            </label>
            </p>
            <label for="finishfield">If yes, when did you finish?</label>
            <input v-model="finishfield" type="text" style="width:55%;"class="form-control" >
        </div>		
		<div class="form-group">
            <p>Did you get something at the end, like a certificate or a degree?<br />
            <label for="certfield">
                <input v-model="certfield" style="margin:5px;" type="radio" class="radio-inline" value="Yes" />Yes&nbsp;&nbsp;
            </label>
            <label for="certfield">
                <input v-model="certfield" style="margin:5px;" type="radio" class="radio-inline" value="No" />No
            </label>
            </p>
        </div>
        <div class="form-group">
		    <button style="margin-top:10px;" class="btn btn-info">Save</button>
		</div>
	</form>
	</div>

</template>

<script>
	import { checkdate } from '../app.js'
	
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

	export default {
		data() {
				return {
					educations: [],
					app_id: $("#appid").attr("appid"), //from appid in blade
					ed_id: '', 			
					errors: [],
					edtypefield: '',
					education_datefield:'',
					locationfield: '',
					programfield: '',
					didfinishfield: '',
					finishfield: '',
					certfield: '',
					working:false
				}
				
		},
		methods: {
			formSubmit: function(event) {
		        if(!this.editstatus)
				{
					//log entire model
        			console.log(this.model);

        			this.checkForm(); //validate form
        			if(!this.errors.length)
				    {
				        axios.post('/api/education/'+this.app_id, ({ 
				        	app_id: this.app_id,
				        	edtype: this.edtypefield,
				        	education_date: this.education_datefield,
				        	location: this.locationfield,
				        	program: this.programfield,
				        	didfinish: this.didfinishfield,
				        	finish: this.finishfield,
				        	cert: this.certfield
				        	 }))
				        .then(({ data }) => {
				          this.educations.push(new Education(data));
				          this.edtypefield = '';
				          this.education_datefield = '';
				          this.locationfield = '';
				          this.programfield = '';
				          this.didfinishfield = '';
				          this.finishfield = '';
				          this.certfield = '';
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
					        console.log(error.config);;
					    });
					}
				}
			    if(this.editstatus == 'edit')
			    {
			    	this.update();
			    }
			},
			read() {
				this.educations.length = 0; //empty array
				axios.get('/api/educations/'+this.app_id).then(({ data }) => {
					if(data.length > 0){data.forEach(education => {
						this.educations.push(new Education(education));
					});}
				});
			},
			update() {
				axios.put('/api/education/'+this.ed_id, ({ 
		        	app_id: this.app_id,
		        	edtype: this.edtypefield,
		        	education_date: this.education_datefield,
		        	location: this.locationfield,
		        	program: this.programfield,
		        	didfinish: this.didfinishfield,
		        	finish: this.finishfield,
		        	cert: this.certfield
		        }))
		        .then(({ data }) => {
		          this.educations.push(new Education(data));
		          this.edtypefield = '';
		          this.education_datefield = '';
		          this.locationfield = '';
		          this.programfield = '';
		          this.didfinishfield = '';
		          this.finishfield = '';
		          this.certfield = '';
		          //reset education list
		          this.read();
		        });
		        
			},
			edit(j) {
				this.editstatus = 'edit';			
				axios.get('/api/education/'+j).then(({ data }) => {
					data.forEach(education => {
			        	this.edtypefield = education.edtype;
			        	this.education_datefield = education.education_date;
			        	this.locationfield = education.location;
			        	this.programfield = education.program;
			        	this.didfinishfield = education.didfinish;
			        	this.finishfield = education.finish;
			        	this.certfield = education.cert;
			        	this.ed_id = j;
					});
				});				
			},
			del: (j) => {
				
				axios.delete('/api/education/'+j).then(function (response) {
					console.log('ed deleted');
				});
				var edID = document.getElementById('ed'+j);
				edID.style.display = "none";

			},
			//validate form fields - add errors to the error array
      		checkForm: function(e) {
      			this.errors = [];
      			if(!this.edtypefield){
      				this.errors.push('Please select a school type.');
      			}
      			if(!this.education_datefield){
            		this.errors.push('Date is required.');
        		}
        		if(!checkdate(this.education_datefield)){
            		this.errors.push('Please use MM/DD/YYYY for your dates.');
        		}
      		}
		},
		components: {
				//EducationComponent
		},
		created() {
				this.read();
		}

	}
</script>
