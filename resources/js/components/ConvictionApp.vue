<template>
	<div>
	        <!-- ERROR Message Container -->
        <div id="errormsgConv" v-if="errors.length"  class="alert alert-danger custom-alert">
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
                    <p style="width:75%;">A <strong>“OTN Number”</strong> is how the court keeps track of everything. You can find your OTN by <strong>(PLSE Needs to provide text!)</strong>. 
                    </p>
					<table style="width:75%;" class="table table-hover">
			            <thead>
			                <tr class="table-info">
			                    <th scope="col">Incident Date</th>
			                    <th scope="col">OTN</th>
			                    <th scope="col">&nbsp;</th>
			                    <th scope="col">&nbsp;</th>
			                </tr>
			            </thead>
						<tr v-for="conviction in convictions" v-bind:id="'con'+conviction.id" class="table-dark">
							<td class="text-black">{{ conviction.inc_date }}</td>
							<td class="text-black">{{ conviction.docket }}</td>
							<td><a v-on:click="edit(conviction.id)" class="btn btn-info">Edit</a></td>
							<td><a v-on:click="del(conviction.id)" class="btn btn-info">Delete</a></td>
						</tr>

					</table>
				    <form id="Convictionform" @submit.prevent="formSubmit">
					    <div class="form-group">
				    
						    <label for="inc_datefield">Incident Date:</label>&nbsp;(<i>MM/DD/YYYY)</i>
						    <input v-model="inc_datefield" style="width:35%;" class="form-control">
						    <label for="arr_datefield">Arrest Date:</label>&nbsp;(<i>MM/DD/YYYY)</i>
						    <input v-model="arr_datefield" style="width:35%;" class="form-control">
						    <label for="docketfield">OTN Number:</label>
						    <input v-model="docketfield" style="width:45%;" class="form-control" >
						    <label for="countyfield">County:</label>
						    <input v-model="countyfield" style="width:45%;" class="form-control">
						    <label for="incidentfield" style="width:55%;">What happened that caused you to be arrested?  Give the facts about what happened.<strong>BE SURE TO SAY HOW YOU WERE INVOLVED.</strong> If alcohol or drugs were involved, be sure to explain how they contributed to the choices you made and what you did wrong.</label>
						    <textarea v-model="incidentfield" style="width:55%;" rows="15" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<h5>OFFENSES</h5>
					    	<p>List the <strong>offenses</strong> that you were charged with as part of this 	conviction.</p>
					    	<label for="offensefield1">1. &nbsp;</label><input v-model="offensefield1" class="form-control" style="width:52%;display:inline;margin-left:7px;" ><br />
					    	<label for="offensefield2">2. &nbsp;</label><input v-model="offensefield2" class="form-control" style="width:52%;display:inline;margin-left:7px;" ><br />
					    	<label for="offensefield3">3. &nbsp;</label><input v-model="offensefield3" class="form-control" style="width:52%;display:inline;margin-left:7px;" ><br />
							<label for="offensefield4">4. &nbsp;</label><input v-model="offensefield4" class="form-control" style="width:52%;display:inline;margin-left:7px;" ><br />
							<label for="offensefield5">5. &nbsp;</label><input v-model="offensefield5" class="form-control" style="width:52%;display:inline;margin-left:7px;" ><br />
							<label for="offensefield6">6. &nbsp;</label><input v-model="offensefield6" class="form-control" style="width:52%;display:inline;margin-left:7px;" ><br />
							<label for="offensefield7">7. &nbsp;</label><input v-model="offensefield7" class="form-control" style="width:52%;display:inline;margin-left:7px;" ><br />
							<label for="offensefield8">8. &nbsp;</label><input v-model="offensefield8" class="form-control" style="width:52%;display:inline;margin-left:7px;" ><br />
							<label for="offensefield9">9. &nbsp;</label><input v-model="offensefield9" class="form-control" style="width:52%;display:inline;margin-left:7px;" ><br />
							<label for="offensefield10">10. &nbsp;</label><input v-model="offensefield10" class="form-control" style="width:52%;display:inline;" ><br />			
						</div>
							<button style="margin-top:10px;" class="btn btn-info">Save</button>
					</form>
				   
				</div>
			</div>
		</div>

 </div>

</template>

<script>
	import { checkdate } from '../app.js'

	function Conviction({id, inc_date, arr_date, docket, incident, county, offense1, offense2, offense3,  offense4, offense5, offense6, offense7, offense8, offense9, offense10}) {
		this.id = id;
		this.inc_date = inc_date;
		this.arr_date = arr_date
		this.docket = docket;
		this.incident = incident;
		this.county = county;
		this.offense1 = offense1;
		this.offense2 = offense2;
		this.offense3 = offense3;
		this.offense4 = offense4;
		this.offense5 = offense5;
		this.offense6 = offense6;
		this.offense7 = offense7;
		this.offense8 = offense8;
		this.offense9 = offense9;
		this.offense10 = offense10;
	}


	//import convictionComponent from './ConvictionComponent.vue';

	export default {
		data() {
				return {
					convictions: [],
					crimes:[],
					errors: [],
					app_id: $("#appid").attr("appid"), //from appid in blade
					con_id: '0',
					inc_datefield: '',
					arr_datefield: '',
					docketfield: '',
					countyfield: '',
					incidentfield: '',
					offensefield1: '',
					offensefield2: '',
					offensefield3: '',
					offensefield4: '',
					offensefield5: '',
					offensefield6: '',
					offensefield7: '',
					offensefield8: '',
					offensefield9: '',
					offensefield10: '',
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
				        axios.post('/api/conviction/'+this.app_id, ({ 
				        	inc_date: this.inc_datefield,
				        	arr_date: this.arr_datefield,
				        	docket: this.docketfield,
				        	county: this.countyfield,
				        	incident: this.incidentfield,
				        	offense1: this.offensefield1,
				        	offense2: this.offensefield2,
				        	offense3: this.offensefield3,
				        	offense4: this.offensefield4,
				        	offense5: this.offensefield5,
				        	offense6: this.offensefield6,
				        	offense7: this.offensefield7,
				        	offense8: this.offensefield8,
				        	offense9: this.offensefield9,
				        	offense10: this.offensefield10,
				        	app_id: this.app_id
				        	 }))
				        .then(({ data }) => {
				          this.convictions.push(new Conviction(data));
				          this.inc_datefield = '';
				          this.arr_datefield = '';
				          this.docketfield = '';
				          this.countyfield = '';
				          this.incidentfield = '';
				          this.offensefield1 = '';
				          this.offensefield2 = '';
				          this.offensefield3 = '';
				          this.offensefield4 = '';
				          this.offensefield5 = '';
				          this.offensefield6 = '';
				          this.offensefield7 = '';
				          this.offensefield8 = '';
				          this.offensefield9 = '';
				          this.offensefield10 = '';
				          this.successmsg = '';
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
				this.convictions.length = 0;
				axios.get('/api/convictions/'+this.app_id).then(({ data }) => {
					data.forEach(conviction => {
						this.convictions.push(new Conviction(conviction));
					});
				});
			},
			update() {
				axios.put('/api/conviction/'+this.con_id, ({ 
					inc_date: this.inc_datefield,
		        	arr_date: this.arr_datefield,
		        	docket: this.docketfield,
		        	county: this.countyfield,
		        	incident: this.incidentfield,
        			offense1: this.offensefield1,
		        	offense2: this.offensefield2,
		        	offense3: this.offensefield3,
		        	offense4: this.offensefield4,
		        	offense5: this.offensefield5,
		        	offense6: this.offensefield6,
		        	offense7: this.offensefield7,
		        	offense8: this.offensefield8,
		        	offense9: this.offensefield9,
		        	offense10: this.offensefield10,
		        	app_id: this.app_id
		        }))
		        .then(({ data }) => {
		        	this.inc_datefield = '';
		        	this.arr_datefield = '';
		        	this.docketfield = '';
		        	this.countyfield = '';
		        	this.incidentfield = '';
		        	this.offensefield1 = '';
		        	this.offensefield2 = '';
		        	this.offensefield3 = '';
		        	this.offensefield4 = '';
		        	this.offensefield5 = '';
		        	this.offensefield6 = '';
		        	this.offensefield7 = '';
		        	this.offensefield8 = '';
		        	this.offensefield9 = '';
		        	this.offensefield10 = '';		        	
		        	//reset con object
		        	this.read();
		        });
			},
			edit(j) {
				this.editstatus = 'edit';			
				axios.get('/api/conviction/'+j).then(({ data }) => {
					data.forEach(conviction => {
						this.inc_datefield = conviction.inc_date;
			        	this.arr_datefield = conviction.arr_date;
			        	this.docketfield = conviction.docket;
			        	this.countyfield = conviction.county;
			        	this.incidentfield = conviction.incident;
			        	this.offensefield1 = conviction.offense1;
			        	this.offensefield2 = conviction.offense2;
			        	this.offensefield3 = conviction.offense3;
			        	this.offensefield4 = conviction.offense4;
			        	this.offensefield5 = conviction.offense5;
			        	this.offensefield6 = conviction.offense6;
			        	this.offensefield7 = conviction.offense7;
			        	this.offensefield8 = conviction.offense8;
			        	this.offensefield9 = conviction.offense9;
			        	this.offensefield10= conviction.offense10;
			        	this.con_id = j;
			        });
			    });

			},
			del(j) {
	
				axios.delete('/api/conviction/'+j).then(function (response) {
					console.log('conv deleted');
				});
				var conID = document.getElementById('con'+j);
				conID.style.display = "none";

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
		            this.errors.push("Please provide an OTN number.");
		        }
		        if(!this.countyfield){
		        	this.errors.push("Please provide a county.");
		        }
		        if(!this.incidentfield){
		        	this.errors.push("Please provide a description of your conviction.");
		        }
		        if(!this.offensefield1){
		        	this.errors.push("Please provide at least one offense.");
		        }
      
      		}
		},
		components: {
				//convictionComponent
		},
		created() {
				this.read();
		}

	}
</script>
