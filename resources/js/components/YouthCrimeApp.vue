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
                    <th scope="col">Location</th>
                    <th scope="col">&nbsp</th>
                    <th scope="col">&nbsp</th>
                </tr>
            </thead>
			<tr v-for="youthcrime in youthcrimes" v-bind:id="'yc'+youthcrime.id" class="table-dark">
				<td class="text-black">{{ youthcrime.youth_date }}</td>
				<td class="text-black">{{ youthcrime.location }}</td>
				<td><a v-on:click="edit(youthcrime.id)" class="btn btn-info">Edit</a></td>
				<td><a v-on:click="del(youthcrime.id)" class="btn btn-info">Delete</a></td>
			</tr>

		</table>
		<form id="YouthCrimeform" @submit.prevent="formSubmit">
		    <div class="form-group">
			    <label for="youth_datefield">Date: *(MM/DD/YYYY)</label>
			    <input v-model="youth_datefield" style="width:35%;" class="form-control">
			    <label for="locationfield">County (if known) & State:</label>
			    <input v-model="locationfield" style="width:75%;" class="form-control">
			    <label for="offensefield">Offense:</label>
			    <input v-model="offensefield" style="width:75%;" class="form-control">
		    	<p>Adjudicated Deliquent?<br />
		    	<label for="adjudicatedfield">
	                <input v-model="adjudicatedfield" style="margin:5px;" type="radio" class="radio-inline" value="Yes" />Yes&nbsp;&nbsp;
	            </label>
	            <label for="adjudicatedfield">
	                <input v-model="adjudicatedfield" style="margin:5px;" type="radio" class="radio-inline" value="No" />No
	            </label></p>
			    <label for="dispositionfield">Disposition/Sentence:</label>
			    <input v-model="dispositionfield" style="width:75%;" class="form-control" >
			    
			</div>	    
			<div class="form-group">
		    	<button style="margin-top:10px;" class="btn btn-info">Save</button>
			</div>
		</form>
	</div>

</template>

<script>
	import { checkdate } from '../app.js'

	function YouthCrime({id, youth_date, location, offense, adjudicated, disposition}) {
		this.id = id;
		this.youth_date = youth_date;
		this.location = location;
		this.offense = offense;
		this.adjudicated = adjudicated;
		this.disposition = disposition;
	}

	export default {
		data() {
				return {
					youthcrimes: [],
					app_id: $("#appid").attr("appid"), //from appid in blade
					errors: [],	
					editstatus: '',	
					youth_datefield: '',
					locationfield: '',
					offensefield: '',
					adjudicatedfield: '',
					dispositionfield: '',
					yc_id: '',
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
				        axios.post('/api/youthcrime/'+this.app_id, ({
				        	app_id: this.app_id, 
				        	youth_date: this.youth_datefield,
				        	location: this.locationfield,
				        	offense: this.offensefield,
				        	adjudicated: this.adjudicatedfield,
				        	disposition: this.dispositionfield
				        	 }))
				        .then(({ data }) => {
				          this.youthcrimes.push(new YouthCrime(data));
				          this.youth_datefield = ''; 
				          this.locationfield = '';
				          this.offensefield = '';
				          this.adjudicatedfield = '';
				          this.dispositionfield = '';
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
				}

			    if(this.editstatus == 'edit')
			    {
			    	
			    	this.update();
			    }

			},
			read() {
				this.youthcrimes.length = 0;
				axios.get('/api/youthcrimes/'+this.app_id).then(({ data }) => {
					if(data.length > 0){data.forEach(youthcrime => {
						this.youthcrimes.push(new YouthCrime(youthcrime));
					});}
				});
			},
			update() {
				
				axios.put('/api/youthcrime/'+this.yc_id, ({ 
		        	app_id: this.app_id,
		        	youth_date: this.youth_datefield,
		        	location: this.locationfield,
		        	offense: this.offensefield,
		        	adjudicated: this.adjudicatedfield,
		        	disposition: this.dispositionfield
		        }))
		        .then(({ data }) => {
		          this.youthcrimes.push(new YouthCrime(data));
		          this.youth_datefield = '';
		          this.locationfield = '';
		          this.offensefield = '';
		          this.adjudicatedfield = '';
		          this.dispositionfield = '';
		          //reset youth crimes list
		          this.read();
		        });

			},
			edit(j) {
				this.editstatus = 'edit';			
				axios.get('/api/youthcrime/'+j).then(({ data }) => {
					data.forEach(youthcrime => {
			        	this.youth_datefield = youthcrime.youth_date;
			        	this.locationfield = youthcrime.location;
			        	this.offensefield = youthcrime.offense;
			        	this.adjudicatedfield = youthcrime.adjudicated;
			        	this.dispositionfield = youthcrime.disposition;
					});

				});	
				this.yc_id = j;
			},
			del(j) {
				axios.delete('/api/youthcrime/'+j).then(function (response) {
					console.log('youth crime deleted');
				});
				var ycID = document.getElementById('yc'+j);
				ycID.style.display = "none";
			},
			//validate form fields - add errors to the error array
      		checkForm: function(e) {
      			this.errors = [];
      			if(!this.locationfield){
      				this.errors.push('Please provide the State and County (if known).');
      			}
      			if(!this.youth_datefield){
            		this.errors.push('Date is required.');
        		}
        		if(!checkdate(this.youth_datefield)){
            		this.errors.push('Please use MM/DD/YYYY for your dates.');
        		}
        		if(!this.offensefield){
        			this.errors.push('Please enter the offense.');
        		}
        		if(!this.adjudicatedfield){
        			this.errors.push('Please select if adjudicated or not.');
        		}
        		if(!this.dispositionfield){
        			this.errors.push('Please enter the disposition or sentence');
        		}
      		}
		},
		components: {
				//youthcrimeComponent
		},
		created() {
				this.read();
		}

	}
</script>
