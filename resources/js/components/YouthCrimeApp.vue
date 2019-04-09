<template>
	<div id="app">
		<table style="width:75%" class="table table-hover">
            <thead>
                <tr class="table-info">
                    <th scope="col">Date</th>
                    <th scope="col">Location</th>
                    <th scope="col">Offense</th>
                    <th scope="col">Adjudicated</th>
                    <th scope="col">Disposition</th>
                    <th scope="col">&nbsp</th>
                </tr>
            </thead>

			<youthcrime-component
				v-for="youthcrime in youthcrimes"
				v-bind="youthcrime"
				:key="youthcrime.id"
				@edit="edit"
			></youthcrime-component>

		</table>
	    <div class="form-group">
		    <label for="youth_datefield">Date:</label>
		    <input v-model="youth_datefield" style="width:35%;" class="form-control">
		    <label for="locationfield">Location:</label>
		    <input v-model="locationfield" style="width:75%;" class="form-control">
		    <label for="offensefield">Offense:</label>
		    <input v-model="offensefield" style="width:75%;" class="form-control">
		    <label for="adjudicatedfield">Adjudicated:</label>
		    <input v-model="adjudicatedfield" style="width:75%;" class="form-control" >
		    <label for="dispositionfield">Disposition:</label>
		    <input v-model="dispositionfield" style="width:75%;" class="form-control" >		    
		    <button @click="create()" style="margin-top:10px;" class="btn btn-info">Save</button>
		</div>
	</div>

</template>

<script>
	function YouthCrime({id, youth_date, location, offense, adjudicated, disposition}) {
		this.id = id;
		this.youthcrime = youthcrime;
		this.location = location;
		this.offense = offense;
		this.adjudicated = adjudicated;
		this.disposition = disposition;
	}

	import youthcrimeComponent from './YouthCrimeComponent.vue';

	export default {
		data() {
				return {
					youthcrimes: [],
					app_id: $("#appid").attr("appid"), //from appid in blade 					
					youth_datefield: '',
					locationfield: '',
					offensefield: '',
					adjudicatedfield: '',
					dispositionfield: '',
					working:false
				}
				
		},
		methods: {
			create() {

		        axios.post('/api/youthcrimes/store', ({
		        	app_id: this.app_id, 
		        	youth_date: this.youth_datefield,
		        	location: this.locationfield,
		        	offense: this.offensefield,
		        	adjudicated: this.adjudicatedfield,
		        	disposition: this.dispositionfield
		        	 }))
		        .then(({ data }) => {
		          this.youthcrimes.push({ data });
		        });
			},
			read() {
				axios.get('/api/youthcrimes/'+this.app_id).then(({ data }) => {
					data.forEach(youthcrime => {
						this.youthcrimes.push(new YouthCrime(youthcrime));
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
				youthcrimeComponent
		},
		created() {
				this.read();
		}

	}
</script>
