<template>
	<tr class="table-dark">
		<td>{{rel_date}}</td>
		<td>{{rel_descr}}</td>
		<td><a :href="idlink" class="btn btn-info">Edit</a></td>
	</tr>

</template>
<script>
	export default {
		computed: {
			idlink() {
				return `/religions/${this.id}`;
			}
		},
		methods: {

		},
		props: ['id', 'rel_date', 'rel_descr']

	}
</script>


