<template>
	<div id="app">
		<table style="width:75%" class="table table-hover">
            <thead>
                <tr class="table-info">
                    <th scope="res">Date</th>
                    <th scope="res">State/County</th>
                    <th scope="res">Offense</th>
                    <th scope="res">Penalty</th>
                </tr>
            </thead>

			<nocitation-component
				v-for="nocitation in nocitations"
				v-bind="nocitation"
				:key="nocitation.id"
				@edit="edit"
			></nocitation-component>

		</table>
	    <div class="form-group">
	    	<label for="nocitations_datefield">What date did you receive the ticke?</label>
	    	<input v-model="nocitations_datefield" style="width:35%;" class="form-control">
	    	<label for="locationfield">What county and state did you get the ticket in?</label>
	    	<input v-model="locationfield" style="width:35%;" class="form-control">
		    <label for="offensefield">What did you get the ticket for?</label>
		    <input v-model="offensefield" style="width:35%;" class="form-control">
		    <label for="dispositionfield">What penalty did you get? (points, fine, suspended license?)</label>
		    <input v-model="dispositionfield" style="width:35%;" class="form-control">
		    <button @click="create()" style="margin-top:10px;" class="btn btn-info">Save</button>
		</div>
	</div>

</template>

<script>
	function nocitation({id, nocitations_date, location, offense, disposition}) {
		this.id = id;
		this.nocitations_date = nocitations_date;
		this.location = location;
		this.offense = offense;
		this.disposition = disposition;
	}

	import nocitationComponent from './NoCitationComponent.vue';

	export default {
		data() {
				return {
					nocitations: [],
					app_id: $("#appid").attr("appid"), //from appid in blade template
					nocitations_datefield: '',
					locationfield: '',
					offensefield: '',
					dispositionfield: '',
					working:false
				}
				
		},
		methods: {
			create() {
		        axios.post('/api/nocitations/store', ({ 
		        	app_id: this.app_id,
		        	nocitations_date: this.nocitations_datefield,
		        	location: this.locationfield,
		        	offense: this.offensefield,
		        	disposition: this.dispositionfield
		        	 }))
		        .then(({ data }) => {
		          this.nocitations.push({ data });
		        });
			},
			read() {
				axios.get('/api/nocitations/'+this.app_id).then(({ data }) => {
					data.forEach(nocitation => {
						this.nocitations.push(new nocitation(nocitation));
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
				nocitationComponent
		},
		created() {
				this.read();
		}

	}
</script>
