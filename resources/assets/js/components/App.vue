<template>
	<div>
		<top-menu  v-show="user.comercial == 1 || user.tecnico== 1"></top-menu>
		<admin-menu v-show="user.root == 1 || user.admin == 1"></admin-menu>
		<transition name="fade" mode="out-in">
			<router-view></router-view>
		</transition>
		<app-footer></app-footer>
	</div>
</template>

<script>
	import TopMenu from './shared/TopMenu.vue';
	import AdminMenu from './shared/AdminMenu.vue';
	import AppFooter from './shared/AppFooter.vue';
	import {mapState} from 'vuex';

	export default {
		components: {
			'admin-menu': AdminMenu,
			'top-menu': TopMenu,
			'app-footer': AppFooter
		},
		methods: {
		},
		computed: mapState({
			user: state => state.auth
		})
	}
</script>
