<template>
	<tr class="table-dark">
		<td>{{nocrimes_date}}</td>
		<td>{{offense}}</td>
		<td>{{result}}</td>
		<td><a :href="idlink" class="btn btn-info">Edit</a></td>
	</tr>

</template>
<script>
	export default {
		computed: {
			idlink() {
				return `/nocrimes/${this.id}`;
			}
		},
		methods: {

		},
		props: ['id', 'nocrimes_date', 'offense', 'result']

	}
</script>

