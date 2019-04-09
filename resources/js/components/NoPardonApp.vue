<template>
	<div id="app">
		<table style="width:75%" class="table table-hover">
            <thead>
                <tr class="table-info">
                    <th scope="col">Date</th>
                    <th scope="col">State/Federal</th>
                    <th scope="col">Offense</th>
                    <th scope="col">Sentence</th>
                    <th scope="col">&nbsp;</th>
                </tr>
            </thead>

			<nopardon-component
				v-for="nopardon in nopardons"
				v-bind="nopardon"
				:key="nopardon.id"
				@edit="edit"
			></nopardon-component>

		</table>
	    <div class="form-group">
		    <label for="nopardons_datefield">Date:</label>
		    <input v-model="nopardons_datefield" style="width:35%;" class="form-control">
		    <label for="levelfield">State or Federal?:</label>
		    <input v-model="levelfield" style="width:75%;" class="form-control" >
		    <label for="offensefield">Offense:</label>
		    <input v-model="offensefield" style="width:75%;" class="form-control" >		    
		    <label for="sentencefield">Sentence:</label>
		    <input v-model="sentencefield" style="width:75%;" class="form-control" >
		    <button @click="create()" style="margin-top:10px;" class="btn btn-info">Save</button>
		</div>
	</div>

</template>

<script>
	function NoPardon({id, nopardons_date, level, offense, sentence}) {
		this.id = id;
		this.nopardons_date = nopardons_date;
		this.level = level;
		this.offense = offense;
		this.sentence = sentence;
	}

	import nopardonComponent from './NoPardonComponent.vue';

	export default {
		data() {
				return {
					nopardons: [],
					nopardons_datefield: '',
					levelfield: '',
					offensefield: '',
					sentencefield: '',
					working:false
				}
				
		},
		methods: {
			create() {

		        axios.post('/api/nopardons/store', ({ 
		        	nopardons_datefield: this.nopardons_datefield,
		        	level: this.levelfield,
		        	offense: this.offensefield,
		        	sentence: this.sentencefield
		        	 }))
		        .then(({ data }) => {
		          this.nopardons.push({ data });
		        });
			},
			read() {
				axios.get('/api/nopardons').then(({ data }) => {
					data.forEach(nopardon => {
						this.nopardons.push(new NoPardon(nopardon));
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
				nopardonComponent
		},
		created() {
				this.read();
		}

	}
</script>
