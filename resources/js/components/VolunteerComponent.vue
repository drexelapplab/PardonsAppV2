<template>
	<tr class="table-dark">
		<td>{{vol_date}}</td>
		<td>{{vol_helped}}</td>
		<td><a :href="idlink" class="btn btn-info">Edit</a></td>
	</tr>

</template>
<script>
	export default {
		computed: {
			idlink() {
				return `/volunteers/${this.id}`;
			}
		},
		methods: {

		},
		props: ['id', 'vol_date', 'vol_helped']

	}
</script>


