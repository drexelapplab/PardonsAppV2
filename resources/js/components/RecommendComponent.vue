<template>
	<tr class="table-dark">
		<td>{{type}}</td>
		<td>{{name}}</td>
		<td>{{location}}</td>
		<td><a :href="idlink" class="btn btn-info">Edit</a></td>
	</tr>

</template>
<script>
	export default {
		computed: {
			idlink() {
				return `/recommends/${this.id}`;
			}
		},
		methods: {

		},
		props: ['id', 'type', 'name', 'location']

	}
</script>


