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
                	<th scope="col">Date</th>
                    <th scope="col">Who Helped?</th>
                    <th scope="col">&nbsp</th>
                    <th scope="col">&nbsp</th>
                </tr>
            </thead>
            <tr v-for="volunteer in volunteers" v-bind:id="'vol'+volunteer.id" class="table-dark">
				<td class="text-black">{{ volunteer.vol_date }}</td>
				<td class="text-black">{{ volunteer.vol_helped }}</td>
				<td><a v-on:click="edit(volunteer.id)" class="btn btn-info">Edit</a></td>
				<td><a v-on:click="del(volunteer.id)" class="btn btn-info">Delete</a></td>	
			</tr>

		</table>
	<form id="VolunteerForm" @submit.prevent="formSubmit">

            <p style="width:75%;">
                Is there anything else you can remember doing as a volunteer? It could be helping with other people’s children, or helping other people to read, or delivering food to them, or driving them places.  There are lots of things people do for other people.  What do you do?
            </p>
            <div class="form-group">
                <label for="vol_descrfield">Tell us about something you are doing (or did not long ago) as a volunteer.</label>
                <textarea v-model="vol_descrfield" style="width:55%;" class="form-control">
                </textarea>
            </div>
            <div class="form-group">

                <label for="vol_helpedfield">Who was helped by it?</label>
                    <input v-model="vol_helpedfield" style="width:55%;" type="text" class="form-control" />
                
            </div>
            <div class="form-group">
            	<label for="vol_datefield">When did you start volunteering? <i>(mm/dd/yyyy)</i></label>
            		<input v-model="vol_datefield" style="width:25%;" class="form-control" />
            	
            </div>

            <div class="form-group">
                <p>Did you help organize or were you in charge of it or a part of it?</p>
                <label for="vol_organizefield">
                    <input v-model="vol_organizefield" style="margin:5px;" type="radio" class="radio-inline" value="Yes" />Yes&nbsp;&nbsp;
                </label>
                <label for="vol_organizefield">
                    <input v-model="vol_organizefield" style="margin:5px;" type="radio" class="radio-inline" value="No" />No
                </label>
            </div>
            <div class="form-group">
                <p>Is this something you did more than once?</p>
                <label for="vol_timefield">
                    <input v-model="vol_timefield" style="margin:5px;" type="radio" class="radio-inline" value="Yes" />Yes&nbsp;&nbsp;
                </label>
                <label for="vol_timefield">
                    <input v-model="vol_timefield" style="margin:5px;" type="radio" class="radio-inline" value="No" />No
                </label>
            </div>
            <div class="form-group">
            	<button class="btn btn-info">Add</button>
        	</div>
		</form>
	</div>

</template>

<script>
	import { checkdate } from '../app.js'

	function Volunteer({id, vol_descr, vol_date, vol_helped, vol_organize, vol_time}) {
		this.id = id;
		this.vol_descr = vol_descr;
		this.vol_date = vol_date;
		this.vol_helped = vol_helped;
		this.vol_organize = vol_organize;
		this.vol_time = vol_time;
	}

	//import VolunteerComponent from './VolunteerComponent.vue';

	export default {
		data() {
				return {
					volunteers: [],
					errors: [],
					app_id: $("#appid").attr("appid"), //from appid in blade template
					vol_id: '',
					vol_descrfield:'',
					vol_datefield: '',
					vol_helpedfield: '',
					vol_organizefield: '',
					vol_timefield: '',
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
					if(!this.errors.length){
				        axios.post('/api/volunteer/'+this.app_id, ({ 
				        	app_id: this.app_id,
				        	vol_descr: this.vol_descrfield,
				        	vol_date: this.vol_datefield,
				        	vol_helped: this.vol_helpedfield,
				        	vol_organize: this.vol_organizefield,
				        	vol_time: this.vol_timefield
				        	 }))
				        .then(({ data }) => {
				          	this.volunteers.push(new Volunteer(data));
			          		this.vol_descrfield = '';
							this.vol_datefield = '';
							this.vol_helpedfield = '';
							this.vol_organizefield = '';
							this.vol_timefield = '';
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
				this.volunteers.length = 0;
				axios.get('/api/volunteers/'+this.app_id).then(({ data }) => {
					data.forEach(volunteer => {
						this.volunteers.push(new Volunteer(volunteer));
					});
				});
			},
			update() {
				axios.put('/api/volunteer/'+this.vol_id, ({ 
					app_id: this.app_id,
					vol_descr: this.vol_descrfield,
					vol_date: this.vol_datefield,
					vol_helped: this.vol_helpedfield,
					vol_organize: this.vol_organizefield,
					vol_time: this.vol_timefield
				}))
				.then(({data}) => {
					this.volunteers.push(new Volunteer(data));
					this.vol_descrfield = '';
					this.vol_datefield = '';
					this.vol_helpedfield = '';
					this.vol_organizefield = '';
					this.vol_timefield = '';
					//reset volunteer list
					this.read();
				});
			},
			edit(j) {
				this.editstatus = 'edit';			
				axios.get('/api/volunteer/'+j).then(({ data }) => {
					data.forEach(volunteer => {
						this.vol_descrfield = volunteer.vol_descr;
						this.vol_datefield = volunteer.vol_date;
						this.vol_helpedfield = volunteer.vol_helped;
						this.vol_organizefield = volunteer.vol_organize;
						this.vol_timefield = volunteer.vol_time;	
						this.vol_id = j;
					});
				});
			},
			del(j){
	
				axios.delete('/api/volunteer/'+j,({app_id: this.app_id})).then(function (response) {
					console.log('vol deleted');
				});
				var volID = document.getElementById('vol'+j);
				volID.style.display = "none";

			},
			//validate form fields - add errors to the error array
      		checkForm: function(e) {
      			if(!this.vol_datefield){
            		this.errors.push('Date is required.');
        		}
        		if(!checkdate(this.vol_datefield)){
            		this.errors.push('Please use MM/DD/YYYY for your dates.');
        		}
      		}
		},
		components: {
				//VolunteerComponent
		},
		created() {
				this.read();
		}

	}
</script>
