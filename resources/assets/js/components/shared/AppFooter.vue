<template>
	<footer>
		<hr>
		<div class="container">
			&copy;<span v-once>{{ siteName }}</span> <span v-once>{{ currentYear }},
			developed by inFutura</span>
		</div>
	</footer>
</template>

<script>
	import {siteName} from '../../config';

	export default {
		data() {
			return {
				siteName: siteName,
				currentYear: (new Date).getFullYear()
			}
		}
	}
</script>
