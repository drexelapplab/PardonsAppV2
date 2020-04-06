<template>
	<div id="app">
		<table style="width:75%" class="table table-hover">
            <thead>
                <tr class="table-info">
                    <th scope="col">Offense</th>
                    <th scope="col">&nbsp</th>
                    <th scope="col">&nbsp</th>
                </tr>
            </thead>

			<tr v-for="crime in crimes" v-bind:id="crime.id" class="table-dark">
				<td class="text-black">{{crime.crime}}</td>
				<td><a v-on:click="edit(crime.id)" class="btn btn-info">Edit</a></td>
				<td><a v-on:click="del(crime.id)" class="btn btn-info">Delete</a></td>
			</tr>

		</table>
	    <div class="form-group">
		    <label for="crimefield">Offense:</label>
		    <input v-model="crimefield" style="width:75%;" class="form-control">
		    <button @click="create()" style="margin-top:10px;" class="btn btn-info">Save</button>
		</div>
	</div>

</template>

<script>
	function Crime({id, crime_date, crime, sentence}) {
		this.id = id;
		this.crime_date;
		this.crime = crime;
		this.sentence = sentence;
	}

	//import crimeComponent from './CrimeComponent.vue';

	export default {
		data() {
				return {
					crimes: [],
					app_id: $("#appid").attr("appid"), //from appid in blade
					con_id: '',
					crm_id: '0',
					crimefield: '',
					working:false
				}
				
		},
		methods: {
			create() {
				if(!this.editstatus)
				{
					//log entire model
        			console.log(this.model);

        			this.checkForm(); //validate form
        			if(!this.errors.length)
				    {
		        		axios.post('/api/crimes/store', ({ 
		        		crime: this.crimefield,
		        		con_id: this.con_id

			        	 }))
				        .then(({ data }) => {
				          this.crimes.push({ data });
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
				axios.get('/api/crimes/'+this.app_id).then(({ data }) => {
					data.forEach(crime => {
						this.crimes.push(new Crime(crime));
					});
				});
			},
			update() {
				axios.put('/api/crime/'+this.crm_id, ({ 
					crime: this.crimefield,
		        	con_id: this.con_id
		        }))
		        .then(({ data }) => {
		        	this.crimefield = '';
		        	this.con_idfield = '';
		        	this.app_idfield = '';
		        	//reset con object
		        	this.read();
		        });
			},
			edit(j) {
				this.editstatus = 'edit';			
				axios.get('/api/crime/'+j).then(({ data }) => {
					data.forEach(conviction => {
						this.crimefield = crime.crime;
			        	this.con_idfield = crime.con_id;
			        	this.crm_id = j;
			        });
			    });
			},
			del: (j) => {
				axios.delete('/api/crime/'+j,({app_id: this.app_id})).then(function (response) {
					console.log('offense deleted');
				});
				var crmID = document.getElementById(j);
				crmID.style.display = "none";
			},
			//validate form fields - add errors to the error array
      		checkForm: function(e) {
        	this.errors = [];
		        
		        if(!this.crimefield){
		        	this.errors.push("Please enter the offense in the field provided.");
		        }
		    }
		},
		components: {
				//crimeComponent
		},
		created() {
				this.read();
		}

	}
</script>
