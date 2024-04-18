import { createRouter, createWebHistory } from 'vue-router'

// import AppProductsList from '@/components/ProductsList';
// import AppProduct from '@/components/Product';
// import AppCart from '@/components/Cart';
import AppSignup from './vue/signup';
import AppE404 from './vue/E404';

const routes = [
	// {
	// 	name: 'catalog',
	// 	path: '/',
	// 	component: AppProductsList
	// },
	{
		name: 'signup',
		path: '/signup',
		component: AppSignup
	},
	{
		path: '/:any(.*)', // .*
		component: AppE404
	}
];

export default createRouter({
	routes,
	history: createWebHistory()
});
