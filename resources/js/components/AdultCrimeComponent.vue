<template>
	<tr class="table-dark">
		<td>{{adult_date}}</td>
		<td>{{state}}</td>
		<td>{{offense}}</td>
		<td><a :href="idlink" class="btn btn-info">Edit</a></td>
	</tr>

</template>
<script>
	export default {
		computed: {
			idlink() {
				return `/adultcrimes/${this.id}`;
			}
		},
		methods: {

		},
		props: ['id', 'adult_date', 'state', 'offense'],


	}
</script>