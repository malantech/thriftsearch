/**
 * Adds the promise polyfill for IE 11
 */
require('es6-promise').polyfill();

/**
 * imports vue and vuex
 */
import Vue from 'vue'
import Vuex from 'vuex'

/**
 * initializes Vuex on Vue
 */
Vue.use( Vuex )

/**
 * imports all the modules used in the application to build the data store
 */
import { yards } from './modules/yards.js'
import { users } from './modules/users.js'
import { display } from './modules/display.js';
import { yardsTypes } from './modules/yardsTypes.js';

/**
 * exports our data store
 */
export default new Vuex.Store({
    modules: {
        yards,
        users,
        display,
        yardsTypes
    }
})