<template>
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
                	<th scope="col">Type</th>
                    <th scope="col">Name</th>
                    <th scope="col">Place</th>
                    <th scope="col">&nbsp</th>
                    <th scope="col">&nbsp</th>
                </tr>
            </thead>
			<tr v-for="recommend in recommends" v-bind:id="'rec'+recommend.id" class="table-dark">
				<td class="text-black">{{ recommend.type }}</td>
				<td class="text-black">{{ recommend.name }}</td>
				<td class="text-black">{{ recommend.place }}</td>
				<td><a v-on:click="edit(recommend.id)" class="btn btn-info">Edit</a></td>
				<td><a v-on:click="del(recommend.id)" class="btn btn-info">Delete</a></td>
			</tr>

		</table>
	<form id="Recommendform" @submit.prevent="formSubmit">
	    <div class="form-group">
	    	<label for="typefield">Type:</label>
	    	<select v-model="typefield" style="width:35%;" class="form-control" >
		    	<option v-for="rec in ['professional','personal']"
		    	:value="rec"
		    	:key="rec"
		    	:selected="rec === typefield ? 'selected' : ''"
		    	>
		    	{{ rec }}
		    	</option>
		    </select>
		    <label for="namefield">Name:</label>
		    <input v-model="namefield" style="width:55%;" class="form-control">
		    <label for="locationfield">What job or organization?</label>
		    <input v-model="locationfield" style="width:55%;" class="form-control" >
		    <label for="emailfield">Email:</label>
		    <input v-model="emailfield" style="width:45%;" class="form-control" >
		    <label for="phonefield">Phone:</label>
		    <input v-model="phonefield" style="width:45%;" class="form-control" >
		    <button style="margin-top:10px;" class="btn btn-info">Save</button>
		</div>
	</form>
	</div>

</template>

<script>
	function Recommend({id, type, name, location, email, phone}) {
		this.id = id;
		this.type = type;
		this.name = name;
		this.location = location;
		this.email = email;
		this.phone = phone;
	}

	//import RecommendComponent from './RecommendComponent.vue';

	export default {
		data() {
				return {
					recommends: [],
					errors: [],
					app_id: $("#appid").attr("appid"), //from appid in blade template
					rec_id: '',
					typefield:'',
					namefield: '',
					locationfield: '',
					emailfield: '',
					phonefield: '',
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
				        axios.post('/api/recommend/'+this.app_id, ({ 
				        	app_id: this.app_id,
				        	type: this.typefield,
				        	name: this.namefield,
				        	location: this.locationfield,
				        	email: this.emailfield,
				        	phone: this.phonefield
				        	 }))
				        .then(({ data }) => {
				          	this.recommends.push(new Recommend(data));
			          		this.typefield = '';
							this.namefield = '';
							this.locationfield = '';
							this.emailfield = '';
							this.phonefield = '';
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
				//TODO FORMAT RECOMMENDATION DATE
				this.recommends.length = 0;
				axios.get('/api/recommends/'+this.app_id).then(({ data }) => {
					if(data.length > 0){data.forEach(recommend => {
						this.recommends.push(new Recommend(recommend));
					});}
				});				
			},
			update() {
				axios.put('/api/recommend/'+this.rec_id, ({
					app_id: this.app_id,
		        	type: this.typefield,
		        	name: this.namefield,
		        	location: this.locationfield,
		        	email: this.emailfield,
		        	phone: this.phonefield
		        }))
		        .then(({ data }) => {
		          this.recommends.push(new Recommend(data));
		          this.typefield = '';
		          this.namefield = '';
		          this.locationfield = '';
		          this.emailfield = '';
		          this.phonefield = '';
		          this.read();
		        });	
			},
			edit(j) {
				this.editstatus = 'edit';			
				axios.get('/api/recommend/'+j).then(({ data }) => {
					data.forEach(recommend => {
					  this.typefield = recommend.type;
			          this.namefield = recommend.name;
			          this.locationfield = recommend.location;
			          this.emailfield = recommend.email;
			          this.phonefield = recommend.phone;
			          this.rec_id = j;
			        });
				});
			},
			del: (j) => {
	
				axios.delete('/api/recommend/'+j).then(function (response) {
					console.log('rec deleted');
				});
				var recID = document.getElementById('rec'+j);
				recID.style.display = "none";
			},
			//validate form fields - add errors to the error array
      		checkForm: function(e) {
      			this.errors = [];
      			if(!this.typefield){
      				this.errors.push('Please select a type.');
      			}
      			if(!this.namefield){
            		this.errors.push('Please enter a name.');
        		}
        		if(!this.phonefield){
            		this.errors.push('Please enter a phone number.');
        		}
        		if(!this.emailfield){
            		this.errors.push('Please enter an email.');
        		}
      		}
		},
		components: {
				//RecommendComponent
		},
		created() {
				this.read();
		}

	}
</script>
