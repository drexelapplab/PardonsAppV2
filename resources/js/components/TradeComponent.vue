<template>
	<tr class="table-dark">
		<td>{{education_date}}</td>
		<td>{{location}}</td>
		<td><a :href="idlink" class="btn btn-info">Edit</a></td>
	</tr>

</template>
<script>
	export default {
		computed: {
			idlink() {
				return `/educations/${this.id}`;
			}
		},
		methods: {

		},
		props: ['id', 'education_date', 'location']

	}
</script>