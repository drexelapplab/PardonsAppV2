<template>
	<div id="app">
		<table style="width:75%" class="table table-hover">
            <thead>
                <tr class="table-info">
                	<th scope="col">Date</th>
                    <th scope="col">Crime</th>
                    <th scope="col">Sentence</th>
                    <th scope="col">&nbsp</th>
                </tr>
            </thead>

			<crime-component
				v-for="crime in crimes"
				v-bind="crime"
				:key="crime.id"
				@edit="edit"
			></crime-component>

		</table>
	    <div class="form-group">
	    	<label for="crime_datefield">Date:</label>
	    	<input v-model="crime_datefield" style="width:25%;" class="form-control">
		    <label for="crimefield">Crime:</label>
		    <input v-model="crimefield" style="width:75%;" class="form-control">
		    <label for="sentencefield">Sentence:</label>
		    <input v-model="sentencefield" style="width:75%;" class="form-control" >
		    <button @click="create()" style="margin-top:10px;" class="btn btn-info">Save</button>
		</div>
	</div>

</template>

<script>
	function Crime({id, crime_date, crime, sentence}) {
		this.id = id;
		this.crime_date;
		this.crime = crime;
		this.sentence = sentence;
	}

	import crimeComponent from './CrimeComponent.vue';

	export default {
		data() {
				return {
					crimes: [],
					app_id: $("#appid").attr("appid"), //from appid in blade
					crime_datefield:'',
					crimefield: '',
					sentencefield: '',
					working:false
				}
				
		},
		methods: {
			create() {

		        axios.post('/api/crimes/store', ({ 
		        	crime_date: this.crime_datefield,
		        	crime: this.crimefield,
		        	sentence: this.sentencefield
		        	 }))
		        .then(({ data }) => {
		          this.crimes.push({ data });
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
				axios.get('/api/crimes/'+this.app_id).then(({ data }) => {
					data.forEach(crime => {
						this.crimes.push(new Crime(crime));
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
				crimeComponent
		},
		created() {
				this.read();
		}

	}
</script>
