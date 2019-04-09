<template>
	<tr class="table-dark">
		<td>{{nopardons_date}}</td>
		<td>{{level}}</td>
		<td>{{offense}}</td>
		<td>{{sentence}}</td>
		<td><a :href="idlink" class="btn btn-info">Edit</a></td>
	</tr>

</template>
<script>
	export default {
		computed: {
			idlink() {
				return `/nopardons/${this.id}`;
			}
		},
		methods: {

		},
		props: ['id', 'nopardons_date', 'offense', 'sentence']

	}
</script>

