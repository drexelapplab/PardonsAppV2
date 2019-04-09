<template>
	<tr class="table-dark">
		<td>{{nocitation_date}}</td>
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
				return `/nocitations/${this.id}`;
			}
		},
		methods: {

		},
		props: ['id', 'nocitation_date', 'location','offense', 'disposition']

	}
</script>

