<template>
	<div id="app">
		<table style="width:75%" class="table table-hover">
            <thead>
                <tr class="table-info">
                    <th scope="res">Date</th>
                    <th scope="res">Offense</th>
                    <th scope="res">Result</th>
                    <th scope="res">&nbsp;</th>
                </tr>
            </thead>

			<nocrime-component
				v-for="nocrime in nocrimes"
				v-bind="nocrime"
				:key="nocrime.id"
				@edit="edit"
			></nocrime-component>

		</table>
	    <div class="form-group">
	    	<label for="nocrimes_datefield">Date:</label>
	    	<input v-model="nocrimes_datefield" style="width:25%;" class="form-control">
		    <label for="offensefield">Offense:</label>
		    <input v-model="offensefield" style="width:75%;" class="form-control">
		    <label for="resultfield">Result:</label>
		    <select v-model="resultfield" style="width:75%;" class="form-control" >
		    	<option v-for="res in ['expunged','non pros','withdrawn','dismissed','PWOV','ARD','not guilty','other']"
		    	:value="res"
		    	:key="res"
		    	:selected="res === resultfield ? 'selected' : ''"
		    	>
		    	{{ res }}
		    	</option>
		    </select>
		    <button @click="create()" style="margin-top:10px;" class="btn btn-info">Save</button>
		</div>
	</div>

</template>

<script>
	function NoCrime({id, nocrimes_date,offense, result}) {
		this.id = id;
		this.nocrimes_date = nocrimes_date;
		this.offense = offense;
		this.result = result;
	}

	import nocrimeComponent from './NoCrimeComponent.vue';

	export default {
		data() {
				return {
					nocrimes: [],
					app_id: $("#appid").attr("appid"), //from appid in blade 			 
					nocrimes_datefield: '',
					offensefield: '',
					resultfield: '',
					working:false
				}
				
		},
		methods: {
			create() {

		        axios.post('/api/nocrimes/'+this.app_id, ({
		        	app_id: this.app_id, 
		        	nocrimes_date: this.nocrimes_datefield,
		        	offense: this.offensefield,
		        	result: this.resultfield
		        	 }))
		        .then(({ data }) => {
		          this.nocrimes.push({ data });
		        });
			},
			read() {
				axios.get('/api/nocrimes/'+this.app_id).then(({ data }) => {
					data.forEach(nocrime => {
						this.nocrimes.push(new NoCrime(nocrime));
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
				nocrimeComponent
		},
		created() {
				this.read();
		}

	}
</script>
