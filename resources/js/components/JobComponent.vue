<template>
	<tr :id="'job'+id" class="table-dark">
		<td class="text-black">{{company}}</td>
		<td class="text-black">{{position}}</td>
		<td><a v-on:click="edit(id)" class="btn btn-info">Edit</a></td>
	</tr>

</template>
<script>
	export default {
		computed: {
			idlink() {
				return `/jobs/${this.id}`;
			}
		},
		methods: {

		},
		props: ['id', 'company', 'position']

	}
</script>

