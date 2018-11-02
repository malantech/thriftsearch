<style scoped lang="scss">
    @import '~@/abstracts/_variables.scss';

    nav.top-navigation{
        background-color: $grey;
        height: 50px;
        border-bottom: 2px solid #333333;
        color: #CCCCCC;
        font-family: 'Josefin Sans', sans-serif;
        padding:10px;

        a{
            font-family: 'Josefin Sans', sans-serif;
            color: #DDDDDD;

            &:hover{
                color: #FFFFFF;
            }
        }

        span.logo{
            border-right: 1px solid #333333;
            display: block;
            float: left;
            height: 50px;
            line-height: 50px;
            padding: 0px 20px 0px 20px;
            font-family: 'Josefin Sans', sans-serif;
            font-weight: bold;
            color: #888888;

            &:hover{
                color: white;
                background-color: #333333;
            }
        }

        ul.links{
            display: block;
            float: left;

            li{
                display: inline-block;
                list-style-type: none;
                line-height: 50px;

                a{
                    font-family: 'Lato', sans-serif;
                    font-weight: bold;
                    color: #000000;

                    &:hover{
                        color: #333333;
                    }
                }
            }
        }

        div.right{
            float: right;

            img.avatar{
                width: 40px;
                height: 40px;
                border-radius: 40px;
                margin-top: 5px;
                margin-right: 10px;
            }
        }
        .login { cursor:pointer; }
    }
</style>

<template>
    <nav class="top-navigation">
        <div class="grid-x">
            <div class="large-4 medium-4 small-4 cell">
                <router-link :to="{ name: 'home'}">
                    BuyTheYards
                </router-link>
                <router-link :to="{ name: 'yards'}"> |
                    Yards
                </router-link>
                <router-link :to="{ name: 'users'}"> |
                    Users
                </router-link>
            </div>
            <div class="large-4 medium-4 small-4 cell">
                <img class="avatar" v-if="user != '' && userLoadStatus == 2" :src="user.avatar" v-show="userLoadStatus == 2"/>
                <span class="logout" v-if="user != '' && userLoadStatus == 2" v-on:click="logout()">Logout</span>
                <span class="login" v-if="user == ''" v-on:click="login()">Login</span>- {{ user.id }}
                <span class="glyphicon-log-out"  v-on:click="logout()">Exit</span>
            </div>
        </div>
    </nav>
</template>

<script>
    import { EventBus } from '../../event-bus.js';

    export default {
        /*
          Defines the computed properties on the component.
        */
        computed: {
            /*
              Retrieves the User Load Status from Vuex
            */
            userLoadStatus(){
                return this.$store.getters.getUserLoadStatus();
            },

            /*
              Retrieves the User from Vuex
            */
            user(){
                return this.$store.getters.getUser;
            },

            showFilters(){
                return this.$store.getters.getShowFilters;
            }
        },

        methods: {
            login(){
                EventBus.$emit('prompt-login');
            },

            logout(){
                this.$store.dispatch('logoutUser');

                window.location = '/logout';
            },

            toggleShowFilters(){
                this.$store.dispatch( 'toggleShowFilters', { showFilters : !this.showFilters } );
            },

            setShowPopOut(){
                this.$store.dispatch( 'toggleShowPopOut', { showPopOut: true } );
            },

            clearFilters(){
                EventBus.$emit('clear-filters');
            }
        }
    }
</script>