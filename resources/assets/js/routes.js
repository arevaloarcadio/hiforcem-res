import Home from './components/home/Home.vue';
import Orders from './components/admin/Orders.vue';
import EditOrder from './components/admin/editOrder.vue';
import Ships from './components/admin/Ships.vue';
import EditShip from './components/admin/editShip.vue';
import Stats from './components/admin/Stats.vue';
import Users from './components/admin/Users.vue';
import Products from './components/admin/Products.vue';
import User from './components/admin/editUser.vue';
import Product from './components/admin/editProduct.vue';
import createUser from './components/admin/createUser.vue';
import createProduct from './components/admin/createProduct.vue';
import Login from './components/login/Login.vue';
import ProfileWrapper from './components/profile/ProfileWrapper.vue';
import Profile from './components/profile/Profile.vue';
import EditProfile from './components/profile/edit-profile/EditProfile.vue';
import EditPassword from './components/profile/edit-password/EditPassword.vue';

export default [
	{ 	path: '/', name: 'index', component: Home, meta: {} },
	{ 	path: '/login', name: 'login', component: Login, meta: {requiresGuest: true} },

	{ 	path: '/stats', name: 'stats', component: Stats, meta: {requiresAuth: true} },
	{ 	path: '/orders', name: 'orders', component: Orders, meta: {requiresAuth: true} },
	{ 	path: '/order/:id?', name: 'editOrder', component: EditOrder, meta: {} },
	{ 	path: '/ships', name: 'ships', component: Ships, meta: {requiresAuth: true} },
	{ 	path: '/ship/:id?', name: 'editShip', component: EditShip, meta: {} },
	{ 	path: '/items/:id?', name: 'order', component: Home, meta: {} },
	{ 	path: '/users', name: 'users', component: Users, meta: {requiresAuth: true} },
	{ 	path: '/products', name: 'products', component: Products, meta: {requiresAuth: true} },
	{ 	path: '/create-product', name: 'createProduct', component: createProduct, meta: {requiresAuth: true} },
	{ 	path: '/user/:id?', name: 'user', component: User, meta: {requiresAuth: true} },
	{ 	path: '/product/:id?', name: 'product', component: Product, meta: {requiresAuth: true} },
	{ 	path: '/create-user', name: 'createUser', component: createUser, meta: {requiresAuth: true} },
	

	{ 	path: '/profile', component: ProfileWrapper, children: [
			{ path: '', name: 'profile', component: Profile, meta: {requiresAuth: true} },
			{ path: 'edit-profile', name: 'profile.editProfile', component: EditProfile, meta: {requiresAuth: true} },
			{ path: 'edit-password', name: 'profile.editPassword', component: EditPassword, meta: {requiresAuth: true}},
			{ path: '*', redirect: { name: 'profile' } }
		]
	},
];