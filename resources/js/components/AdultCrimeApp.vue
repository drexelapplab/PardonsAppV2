<template>
	<div id="app">
		<table style="width:75%" class="table table-hover">
            <thead>
                <tr class="table-info">
                    <th scope="col">Date</th>
                    <th scope="col">County</th>
                    <th scope="col">State</th>
                    <th scope="col">Offense</th>
                    <th scope="col">Sentence</th>
                    <th scope="col">&nbsp</th>
                </tr>
            </thead>

			<adultcrime-component
				v-for="adultcrime in adultcrimes"
				v-bind="adultcrime"
				:key="adultcrime.id"
				@edit="edit"
			></adultcrime-component>

		</table>
	    <div class="form-group">
		    <label for="adult_datefield">Date of Incident:</label>
		    	<input v-model="adult_datefield" style="width:35%;" class="form-control">
		    <label for="chargesfield">Federal or State Charges:</label>
		    	<input v-model="chargesfield" style="width:75%;" class="form-control">
		    <label for="statefield">State:</label>
		    	<input v-model="statefield" style="width:75%;" class="form-control">
		    <label for="offensefield">Offense:</label>
		    	<input v-model="offensefield" style="width:75%;" class="form-control">
		    <label for="sentencefield">Sentence:</label>
		    	<input v-model="sentencefield" style="width:75%;" class="form-control" >		    
		    <button @click="create()" style="margin-top:10px;" class="btn btn-info">Save</button>
		</div>
	</div>

</template>

<script>
	function AdultCrime({id, adult_date, charges, state, offense, sentence}) {
		this.id = id;
		this.adult_date = youth_date;
		this.charges = charges;
		this.state = state;
		this.offense = offense;
		this.sentence = sentence;
	}

	import adultcrimeComponent from './AdultCrimeComponent.vue';

	export default {
		data() {
				return {
					adultcrimes: [],
					app_id: $("#appid").attr("appid"), //from appid in blade	
					adult_datefield: '',
					chargesfield: '',
					statefield: '',
					offensefield: '',
					sentencefield: '',
					working:false
				}
				
		},
		methods: {
			create() {
		        axios.post('/api/adultcrimes/store', ({
		        	app_id: this.app_id, 
		        	adult_date: this.adult_datefield,
		        	charges: this.chargesfield,
		        	state: this.statefield,
		        	offense: this.offensefield,
		        	sentence: this.sentencefield
		        	 }))
		        .then(({ data }) => {
		          this.adultcrimes.push({ data });
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
			},
			read() {
				axios.get('/api/adultcrimes/'+this.app_id).then(({ data }) => {
					data.forEach(adultcrime => {
						this.adultcrimes.push(new AdultCrime(adultcrime));
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
				adultcrimeComponent
		},
		created() {
				this.read();
		}

	}
</script>
