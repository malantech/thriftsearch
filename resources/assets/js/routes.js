import Vue from 'vue'
import VueRouter from 'vue-router'

import store from './store.js';

Vue.use( VueRouter )

export default new VueRouter({
    routes: [
        {
            path: '/',
            redirect: { name: 'home' },
            name: 'layout',
            component: Vue.component( 'Home', require( './pages/Layout.vue' ) ),
            children: [
                {
                    path: '/home',
                    name: 'home',
                    component: Vue.component( 'Home', require( './pages/Home.vue' ) )
                },
                {
                    path: '/yards',
                    name: 'yards',
                    component: Vue.component('Yards', require('./pages/Yards.vue') )
                },
                {
                    path: '/yards/:id',
                    name: 'yard',
                    component: Vue.component('Yard', require('./pages/Yard.vue') )
                },
                {
                    path: '/newyard',
                    name: 'newyard',
                    component: Vue.component( 'NewYard', require( './pages/NewYard.vue' ) )
                    //beforeEnter: requireAuth
                },
                {
                    path: '/yards/:id/edit',
                    name: 'edityard',
                    component: Vue.component( 'EditYard', require( './pages/EditYard.vue' ) )
                },
                {
                    path: '/users',
                    name: 'users',
                    component: Vue.component( 'Users', require( './pages/Users.vue' ) )
                    //beforeEnter: requireAuth
                },
                /*
                    Catch Alls
                */
                { path: '_=_', redirect: '/' }
            ]
        }

    ]
});
