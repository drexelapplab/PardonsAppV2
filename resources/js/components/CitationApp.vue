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
                    <th scope="res">Date</th>
                    <th scope="res">State/County</th>
                    <th scope="res">&nbsp;</th>
                    <th scope="res">&nbsp;</th>
                </tr>
            </thead>
			<tr v-for="citation in citations" v-bind:id="citation.id" class="table-dark">
				<td class="text-black">{{ citation.citations_date }}</td>
				<td class="text-black">{{ citation.location }}</td>
				<td><a v-on:click="edit(citation.id)" class="btn btn-info">Edit</a></td>
				<td><a v-on:click="del(citation.id)" class="btn btn-info">Delete</a></td>
			</tr>

		</table>
		<form id="Citationform" @submit.prevent="formSubmit">
		    <div class="form-group">
		    	<label for="citations_datefield">What date did you receive the citation/ticket? &nbsp;*(MM/DD/YYYY)</label>
		    	<input v-model="citations_datefield" style="width:35%;" class="form-control">
		    	<label for="locationfield">What county and state did you get the ticket in?</label>
		    	<input v-model="locationfield" style="width:75%;" class="form-control">
			    <label for="offensefield">What did you get the ticket for?</label>
			    <input v-model="offensefield" style="width:75%;" class="form-control">
			    <label for="penaltyfield">What penalty did you get? (points, fine, suspended license?)</label>
			    <input v-model="penaltyfield" style="width:75%;" class="form-control">
			    <button style="margin-top:10px;" class="btn btn-info">Save</button>
			</div>
		</form>
	</div>

</template>

<script>
	import { checkdate } from '../app.js'
	
	function Citation({id, citations_date, location, offense, penalty}) {
		this.id = id;
		this.citations_date = citations_date;
		this.location = location;
		this.offense = offense;
		this.penalty = penalty;
	}

	//import citationComponent from './citationComponent.vue';

	export default {
		data() {
				return {
					citations: [],
					app_id: $("#appid").attr("appid"), //from appid in blade template
					errors: [],						
					citations_datefield: '',
					locationfield: '',
					offensefield: '',
					penaltyfield: '',
					cit_id: '',
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
				        axios.post('/api/citation/'+this.app_id, ({ 
				        	app_id: this.app_id,
				        	citations_date: this.citations_datefield,
				        	location: this.locationfield,
				        	offense: this.offensefield,
				        	penalty: this.penaltyfield
				        	 }))
				        .then(({ data }) => {
				          this.citations.push(new Citation(data));
				          this.citations_datefield = '';
				          this.offensefield = '';
				          this.locationfield = '';
				          this.penaltyfield = '';
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
				this.citations.length = 0;
				axios.get('/api/citations/'+this.app_id).then(({ data }) => {
					if(data.length > 0){data.forEach(citation => {
						this.citations.push(new Citation(citation));
					});}
				});
			},
			update() {
				axios.put('/api/citation/'+this.cit_id, ({ 
		        	app_id: this.app_id,
		        	citations_date: this.citations_datefield,
		        	location: this.locationfield,
		        	offense: this.offensefield,
		        	adjudicated: this.adjudicatedfield,
		        	penalty: this.penaltyfield
		        }))
		        .then(({ data }) => {
		          this.citations.push(new Citation(data));
		          this.citations_datefield = '';
		          this.locationfield = '';
		          this.offensefield = '';
		          this.penaltyfield = '';
		          //reset citations list
		          this.read();
		        });
			},
			edit(j) {
				this.editstatus = 'edit';			
				axios.get('/api/citation/'+j).then(({ data }) => {
					data.forEach(citation => {
			        	this.citations_datefield = citation.citations_date;
			        	this.locationfield = citation.location;
			        	this.offensefield = citation.offense;
			        	this.penaltyfield = citation.penalty;
			        	this.cit_id = j;
					});

				});	
			},
			del(j) {
				axios.delete('/api/citation/'+j,({app_id: this.app_id})).then(function (response) {
					console.log('citation deleted');
				});
				var citID = document.getElementById(j);
				citID.style.display = "none";
			},
			//validate form fields - add errors to the error array
      		checkForm: function(e) {
      			this.errors = [];
      			if(!this.locationfield){
      				this.errors.push('Please provide the State you received the citation/ticket.');
      			}
      			if(!this.citations_datefield){
            		this.errors.push('Citation date is required.');
        		}
        		if(!checkdate(this.citations_datefield)){
            		this.errors.push('Please use MM/DD/YYYY for your dates.');
        		}
        		if(!this.offensefield){
        			this.errors.push('Please enter the offense.');
        		}
        		if(!this.penaltyfield){
        			this.errors.push('Please provide the penalty for your citation/ticket.');
        		}
      		}
		},
		components: {
				//citationComponent
		},
		created() {
				this.read();
		}

	}
</script>
