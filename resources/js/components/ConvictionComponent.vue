<template>
	<tr class="table-dark">
		<td>{{con_date}}</td>
		<td>{{docket}}</td>
		<td><a :href="idlink" class="btn btn-info">Edit</a></td>
		<td><a :href="dellink" class="btn btn-info">Delete</a></td>
	</tr>

</template>
<script>
	export default {
		computed: {
			idlink() {
				return `/convictions/${this.id}`;
			},
			dellink() {
				return `/convictions/${this.id}/delete`;
			}
		},
		methods: {

		},
		props: ['id', 'con_date', 'docket']

	}
</script>

