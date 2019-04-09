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
                    <th scope="col">Place</th>
                    <th scope="col">&nbsp</th>
                </tr>
            </thead>

			<religion-component
				v-for="religion in religions"
				v-bind="religion"
				:key="religion.id"
				@edit="edit"
			></religion-component>

		</table>
	<form id="relForm" @submit.prevent="formSubmit">
 
        <div class="form-group">
            <label for="rel_descrfield">What's the name of the place you go to worship?</label>
                <input v-model="rel_descrfield" style="width:45%;" type="text" class="form-control" />         
        </div>
        <div class="form-group">
        	<label for="rel_datefield">When did you start attending?<i>(mm/dd/yyyy)</i></label>
        		<input v-model="rel_datefield" style="width:25%;" class="form-control" />
        </div>
        <div class="form-group">
            <p>Do you volunteer there?</p>
            <label for="rel_volfield">
                <input v-model="rel_volfield" style="margin:5px;" type="radio" class="radio-inline" value="Yes" />Yes&nbsp;&nbsp;
            </label>
            <label for="rel_volfield">
                <input v-model="rel_volfield" style="margin:5px;" type="radio" class="radio-inline" value="No" />No
            </label>
        </div>
        <div class="form-group">
            <p>Do you teach or lead study groups there?</p>
            <label for="rel_teachfield">
                <input v-model="rel_teachfield" style="margin:5px;" type="radio" class="radio-inline" value="Yes" />Yes&nbsp;&nbsp;
            </label>
            <label for="rel_teach">
                <input v-model="rel_teachfield" style="margin:5px;" type="radio" class="radio-inline"value="No" />No
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
	
	function Religion({id, rel_descr, rel_date, rel_vol, rel_teach}) {
		this.id = id;
		this.rel_descr = rel_descr;
		this.rel_date = rel_date;
		this.rel_vol = rel_vol;
		this.rel_teach = rel_teach;
	}

	import religionComponent from './religionComponent.vue';

	export default {
		data() {
				return {
					religions: [],
					errors: [],
					app_id: $("#appid").attr("appid"), //from appid in blade template
					rel_descrfield:'',
					rel_datefield: '',
					rel_volfield: '',
					rel_teachfield: '',
					working:false
				}
				
		},
		methods: {
			formSubmit: function(event) {
				this.checkForm(); //validate form
				if(!this.errors.length){
					axios.post('/api/religions/'+this.app_id, ({ 
		        	app_id: this.app_id,
		        	rel_descr: this.rel_descrfield,
		        	rel_date: this.rel_datefield,
		        	rel_vol: this.rel_volfield,
		        	rel_teach: this.rel_teachfield
		        	 }))
		        	.then(({ data }) => {
		          	this.religions.push(new Religion(data));
	          		this.rel_descrfield = '';
					this.rel_datefield = '';
					this.rel_volfield = '';
					this.rel_teachfield = '';
					event.target.reset();
		        	});
				}

			},
			read() {
//TODO FORMAT RECOMMENDATION DATE
				axios.get('/api/religions/'+this.app_id).then(({ data }) => {
					data.forEach(religion => {
						this.religions.push(new Religion(religion));
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
      			if(!this.rel_datefield){
            		this.errors.push('Date is required.');
        		}
        		if(!checkdate(this.rel_datefield)){
            		this.errors.push('Please use MM/DD/YYYY for your dates.')
        		}
        	}

		},
		components: {
				religionComponent
		},
		created() {
				this.read();
		}

	}
</script>
