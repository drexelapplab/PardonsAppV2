<template>
	<tr class="table-dark">
		<td>{{crime}}</td>
		<td><a :href="idlink" class="btn btn-info">Edit</a></td>
	</tr>

</template>
<script>
	export default {
		computed: {
			idlink() {
				return `/crimes/${this.id}`;
			}
		},
		methods: {

		},
		props: ['id', 'crime_date', 'crime', 'sentence']

	}
</script>

