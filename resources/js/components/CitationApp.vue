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

			<citation-component
				v-for="citation in citations"
				v-bind="citation"
				:key="citation.id"
				@edit="edit"
			></citation-component>

		</table>
	    <div class="form-group">
	    	<label for="citations_datefield">What date did you receive the ticket?</label>
	    	<input v-model="citations_datefield" style="width:35%;" class="form-control">
	    	<label for="locationfield">What county and state did you get the ticket in?</label>
	    	<input v-model="locationfield" style="width:75%;" class="form-control">
		    <label for="offensefield">What did you get the ticket for?</label>
		    <input v-model="offensefield" style="width:75%;" class="form-control">
		    <label for="dispositionfield">What penalty did you get? (points, fine, suspended license?)</label>
		    <input v-model="dispositionfield" style="width:75%;" class="form-control">
		    <button @click="create()" style="margin-top:10px;" class="btn btn-info">Save</button>
		</div>
	</div>

</template>

<script>
	function citation({id, citations_date, location, offense, disposition}) {
		this.id = id;
		this.citations_date = citations_date;
		this.location = location;
		this.offense = offense;
		this.disposition = disposition;
	}

	import citationComponent from './citationComponent.vue';

	export default {
		data() {
				return {
					citations: [],
					app_id: $("#appid").attr("appid"), //from appid in blade template						
					citations_datefield: '',
					locationfield: '',
					offensefield: '',
					dispositionfield: '',
					working:false
				}
				
		},
		methods: {
			create() {

		        axios.post('/api/citations/store', ({ 
		        	app_id: this.app_id,
		        	citations_date: this.citations_datefield,
		        	location: this.locationfield,
		        	offense: this.offensefield,
		        	result: this.dispositionfield
		        	 }))
		        .then(({ data }) => {
		          this.citations.push({ data });
		        });
			},
			read() {
				axios.get('/api/citations/'+this.app_id).then(({ data }) => {
					data.forEach(citation => {
						this.citations.push(new citation(citation));
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
				citationComponent
		},
		created() {
				this.read();
		}

	}
</script>
