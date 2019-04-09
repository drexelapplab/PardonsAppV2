<template>
	<tr class="table-dark">
		<td>{{youth_date}}</td>
		<td>{{location}}</td>
		<td>{{offense}}</td>
		<td><a :href="idlink" class="btn btn-info">Edit</a></td>
	</tr>

</template>
<script>
	export default {
		computed: {
			idlink() {
				return `/youthcrimes/${this.id}`;
			}
		},
		methods: {

		},
		props: ['id', 'youth_date', 'location', 'offense'],


	}
</script>

