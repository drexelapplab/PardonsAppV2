<template>
	<div id="app">
		<table style="width:75%" class="table table-hover">
            <thead>
                <tr class="table-info">
                	<th scope="col">Date</th>
                    <th scope="col">School</th>
                    <th scope="col">&nbsp</th>
                </tr>
            </thead>

			<education-component
				v-for="education in educations"
				v-bind="educations"
				:key="education.id"
				@edit="edit"
			></education-component>

		</table>
	<form id="Educationform" @submit.prevent="formSubmit">
	    <div class="form-group">
	    	<input v-model="edtypefield" type="hidden" value="school">
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
		    <button style="margin-top:10px;" class="btn btn-info">Add</button>
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

	import EducationComponent from './EducationComponent.vue';

	export default {
		data() {
				return {
					educations: [],
					app_id: $("#appid").attr("appid"), //from appid in blade 					
					edtypefield: 'school',
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
		        axios.post('/api/educations/store', ({ 
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
		          //this.edtypefield = '';
		          this.education_datefield = '';
		          this.locationfield = '';
		          this.programfield = '';
		          this.didfinishfield = '';
		          this.finishfield = '';
		          this.certfield = '';
		          event.target.reset();
		        });
			},
			read() {
//TODO FORMAT EDUCATION DATE
				axios.get('/api/educations/'+this.app_id).then(({ data }) => {
					data.forEach(education => {
						this.educations.push(new Education(education));
					});
				});
			},
			update() {
				//TODO
			},
			edit() {
				//TODO
			},
			del() {
				//TODO
			},
			//validate form fields - add errors to the error array
      		checkForm: function(e) {
      			if(!this.education_datefield){
            		this.errors.push('Date is required.');
        		}
        		if(!checkdate(this.education_datefield)){
            		this.errors.push('Please use MM/DD/YYYY for your dates.')
        		}
      		}
		},
		components: {
				EducationComponent
		},
		created() {
				this.read();
		}

	}
</script>
