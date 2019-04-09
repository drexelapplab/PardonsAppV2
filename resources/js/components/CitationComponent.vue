<template>
	<tr class="table-dark">
		<td>{{citation_date}}</td>
		<td>{{location}}</td>
		<td>{{offense}}</td>
		<td>{{disposition}}</td>
		<td><a :href="idlink" class="btn btn-info">Edit</a></td>
	</tr>

</template>
<script>
	export default {
		computed: {
			idlink() {
				return `/citations/${this.id}`;
			}
		},
		methods: {

		},
		props: ['id', 'citation_date', 'location','offense', 'disposition']

	}
</script>

