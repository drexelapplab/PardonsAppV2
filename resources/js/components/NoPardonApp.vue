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
                    <th scope="col">State/Federal</th>
                    <th scope="col">&nbsp</th>
                    <th scope="col">&nbsp</th>
                </tr>
            </thead>
			<tr v-for="nopardon in nopardons" v-bind:id="'np'+nopardon.id" class="table-dark">
				<td class="text-black">{{ nopardon.nopardons_date }}</td>
				<td class="text-black">{{ nopardon.level }}</td>
				<td><a v-on:click="edit(nopardon.id)" class="btn btn-info">Edit</a></td>
				<td><a v-on:click="del(nopardon.id)" class="btn btn-info">Delete</a></td>
			</tr>

		</table>
			<form id="Nopardonsform" @submit.prevent="formSubmit">
		    <div class="form-group">
			    <label for="nopardons_datefield">Date:</label>
			    <input v-model="nopardons_datefield" style="width:35%;" class="form-control">
			    <label for="levelfield">State or Federal?:</label>
			    <select v-model="levelfield" style="width:25%;" class="form-control">
			    	<option v-if="levelfield != ''" selected>{{ levelfield }}</option>
			    	<option>State</option>
			    	<option>Federal</option>
			    </select>
			    <label for="offensefield">Offense:</label>
			    <input v-model="offensefield" style="width:75%;" class="form-control" >		    
			    <label for="sentencefield">Sentence:</label>
			    <input v-model="sentencefield" style="width:75%;" class="form-control" >
			    <button style="margin-top:10px;" class="btn btn-info">Save</button>
			</div>
		</form>
	</div>

</template>

<script>
	import { checkdate } from '../app.js'
	
	function NoPardon({id, nopardons_date, level, offense, sentence}) {
		this.id = id;
		this.nopardons_date = nopardons_date;
		this.level = level;
		this.offense = offense;
		this.sentence = sentence;
	}

	export default {
		data() {
				return {
					nopardons: [],
					app_id: $("#appid").attr("appid"), //from appid in blade
					np_id: '', 			
					errors: [],
					nopardons_datefield: '',
					levelfield:'',
					offensefield: '',
					sentencefield: '',
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
				        axios.post('/api/nopardon/'+this.app_id, ({ 
				        	app_id: this.app_id,
				        	nopardons_date: this.nopardons_datefield,
				        	level: this.levelfield,
				        	offense: this.offensefield,
				        	sentence: this.sentencefield,
				        	 }))
				        .then(({ data }) => {
				          this.nopardons.push(new NoPardon(data));
				          this.nopardons_datefield = '';
				          this.levelfield = '';
				          this.offensefield = '';
				          this.sentencefield = '';
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
				this.nopardons.length = 0; //empty array
				axios.get('/api/nopardons/'+this.app_id).then(({ data }) => {
					if(data.length > 0){data.forEach(nopardon => {
						this.nopardons.push(new NoPardon(nopardon));
					});}
				});
			},
			update() {
				axios.put('/api/nopardon/'+this.np_id, ({ 
		        	app_id: this.app_id,
		        	nopardons_date: this.nopardons_datefield,
		        	level: this.levelfield,
		        	offense: this.offensefield,
		        	sentence: this.sentencefield
		        }))
		        .then(({ data }) => {
		          this.nopardons.push(new NoPardon(data));
		          this.nopardons_datefield = '';
		          this.levelfield = '';
		          this.offensefield = '';
		          this.sentencefield = '';
		          //reset adult list
		          this.read();
		        });
		        
			},
			edit(j) {
				this.editstatus = 'edit';			
				axios.get('/api/nopardon/'+j).then(({ data }) => {
					data.forEach(nopardon => {
			        	this.nopardons_datefield = nopardon.nopardons_date;
			        	this.levelfield = nopardon.level;
			        	this.offensefield = nopardon.offense;
			        	this.sentencefield = nopardon.sentence;
			        	this.np_id = j;
					});
				});				
			},
			del(j) {
	
				axios.delete('/api/nopardon/'+j).then(function (response) {
					console.log('np deleted');
				});
				var npID = document.getElementById('np'+j);
				npID.style.display = "none";

			},
			//validate form fields - add errors to the error array
      		checkForm: function(e) {
      			this.errors = [];
      			if(!this.levelfield){
      				this.errors.push('Please select either federal or state.');
      			}
      			if(!this.nopardons_datefield){
            		this.errors.push('Date is required.');
        		}
        		if(!checkdate(this.nopardons_datefield)){
            		this.errors.push('Please use MM/DD/YYYY for your dates.');
        		}
        		if(!this.offensefield){
        			this.errors.push('Please enter an offense.');
        		}
        		if(!this.sentencefield){
        			this.errors.push('Please enter a sentence for the offense.');
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
