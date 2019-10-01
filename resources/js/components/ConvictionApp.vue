<template>
	<div>
	        <!-- ERROR Message Container -->
        <div id="errormsgConv" v-if="errors.length" style="position:fixed;top:1%;width:65%;z-index:1000;" class="alert alert-danger">
            <button type="button" class="close" v-on:click="errors = []">&times;</button>
            <strong>Please correct the following errors:</strong>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
        </div>   
	    <div class="card text-white bg-secondary mb-3">
            <div class="card-body">
                <h5 class="card-title text-warning">QUESTIONS ABOUT THE CONVICTION YOU WANT PARDONED FOR</h5>
                <div class="card-text">
                    <p style="width:75%;">A <strong>“docket number”</strong> is how the court keeps track of everything. Usually the docket number will have “CP” or “MC” at the beginning, then 2 numbers, then two more initials like “CR” “MD” “SA” or “SU”, then other numbers.</p>
                    <p>  <strong>YOU HAVE TO GET ALL OF THESE NUMBERS RIGHT</strong> otherwise you will have to start over.
                    </p>
					<table style="width:75%;" class="table table-hover">
			            <thead>
			                <tr class="table-info">
			                    <th scope="col">Date</th>
			                    <th scope="col">Docket No.</th>
			                    <th scope="col">&nbsp;</th>
			                    <th scope="col">&nbsp;</th>
			                </tr>
			            </thead>

						<conviction-component
							v-for="conviction in convictions"
							v-bind="conviction"
							:key="conviction.id"
							@edit="edit"
						></conviction-component>

					</table>
				    <div class="form-group">
				    <form id="Convictionform" @submit.prevent="formSubmit">
					    <label for="inc_datefield">Incident Date:</label>&nbsp;(<i>MM/DD/YYYY)</i>
					    <input v-model="inc_datefield" style="width:35%;" class="form-control">
					    <label for="arr_datefield">Arrest Date:</label>&nbsp;(<i>MM/DD/YYYY)</i>
					    <input v-model="arr_datefield" style="width:35%;" class="form-control">
					    <label for="docketfield">Docket Number</label>
					    <input v-model="docketfield" style="width:45%;" class="form-control" >
					    <label for="incidentfield" style="width:55%;">What happened that caused you to be arrested?  Give the facts about what happened.<strong>BE SURE TO SAY HOW YOU WERE INVOLVED.</strong> If alcohol or drugs were involved, be sure to explain how they contributed to the choices you made and what you did wrong.</label>
					    <textarea v-model="incidentfield" style="width:55%;" class="form-control"></textarea>\   
					    <button style="margin-top:10px;" class="btn btn-info">Save</button>
					</form>
					</div>
					<div id="condetails" class="form-group" style="display:none;padding-top:20px;">	
			            <h5 class="card-title text-warning">QUESTIONS ABOUT THE CRIMES IN YOUR CONVICTION</h5>
	
			                <p class="h5">What offenses were associated with this incident?</p>
			                <div class="card text-white card-warning">
			                    <div class="card-body">
			                        <p class="card-title">Add each offense related to the incident below.</p>
			                
			                        <div class="card-text">
			                            <div id="crimeapp" :conid="con_id"></div>
			                        </div>
			                    </div>
			                </div>
				     </div>	
				</div>
			</div>
		</div>

 </div>

</template>

<script>
	import { checkdate } from '../app.js'

	function Conviction({id, inc_date, arr_date, docket, incident}) {
		this.id = id;
		this.inc_date = inc_date;
		this.arr_date = arr_date
		this.docket = docket;
		this.incident = incident;
	}

	import convictionComponent from './ConvictionComponent.vue';

	export default {
		data() {
				return {
					convictions: [],
					errors: [],
					app_id: $("#appid").attr("appid"), //from appid in blade
					con_id: '0',
					inc_datefield: '',
					arr_datefield: '',
					docketfield: '',
					incidentfield: '',
					working:false
				}
				
		},
		methods: {
			formSubmit: function(event) {

				//check form values for errors
				this.checkForm();

				if(!this.errors.length){
			        axios.post('/api/convictions/'+this.app_id, ({ 
			        	inc_date: this.inc_datefield,
			        	arr_date: this.arr_datefield,
			        	docket: this.docketfield,
			        	incident: this.incidentfield,
			        	app_id: this.app_id
			        	 }))
			        .then(({ data }) => {
			          this.convictions.push({ data });
			          this.con_id = data.id;
			          this.inc_datefield = '';
			          this.arr_datefield = '';
			          this.docketfield = '';
			          this.incidentfield = '';
			          this.successmsg = '';

			        //display other forms
			        $('#condetails').show();

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
			read() {
				axios.get('/api/convictions/'+this.app_id).then(({ data }) => {
					data.forEach(conviction => {
						this.convictions.push(new Conviction(conviction));
					});
				});
			},
			nextid() {
				axios.get('/api/conviction/next').then(({ data }) =>{
					this.con_id = data[0].AUTO_INCREMENT;
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
        	this.errors = [];
		        
		        if(!checkdate(this.inc_datefield)){
		        	this.errors.push("Please enter a proper date MM/DD/YYYY for Incident Date.");
		        }
		        if(!checkdate(this.arr_datefield)){
		        	this.errors.push("Please enter a proper date MM/DD/YYYY for Arrest Date.");
		        }
		        if(!this.docketfield){
		            this.errors.push("Please provide a docket number.");
		        }
		        if(!this.incidentfield){
		        	this.errors.push("Please provide a description of your conviction.");
		        }
      
      		}
		},
		components: {
				convictionComponent
		},
		created() {
				this.read();
				this.nextid();
		}

	}
</script>
