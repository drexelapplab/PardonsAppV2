<template>
	<div id="app">
		<table style="width:75%" class="table table-hover">
            <thead>
                <tr class="table-info">
                	<th scope="col">Type</th>
                    <th scope="col">Name</th>
                    <th scope="col">Place</th>
                    <th scope="col">&nbsp</th>
                </tr>
            </thead>

			<recommend-component
				v-for="recommend in recommends"
				v-bind="recommend"
				:key="recommend.id"
				@edit="edit"
			></recommend-component>

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

	import RecommendComponent from './RecommendComponent.vue';

	export default {
		data() {
				return {
					recommends: [],
					app_id: $("#appid").attr("appid"), //from appid in blade template
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

		        axios.post('/api/recommends/'+this.app_id, ({ 
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
		        });
			},
			read() {
//TODO FORMAT RECOMMENDATION DATE
				axios.get('/api/recommends/'+this.app_id).then(({ data }) => {
					data.forEach(recommend => {
						this.recommends.push(new Recommend(recommend));
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
			}
		},
		components: {
				RecommendComponent
		},
		created() {
				this.read();
		}

	}
</script>
