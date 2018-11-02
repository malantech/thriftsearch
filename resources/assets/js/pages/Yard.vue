<style scoped lang="scss">
    @import '~@/abstracts/_variables.scss';

    div.yard-page{
        width:50%;
        margin:0px Auto;
        padding:30px;

        h2.yard-title{
            color: #342C0C;
            font-size: 36px;
            line-height: 44px;
            font-family: "Lato", sans-serif;
            font-weight: bolder;
            text-align: center;
        }

        h3{
            text-align: center;
            color: $secondary-color;
            font-family: 'Josefin Sans', sans-serif;
        }

        img.close-icon{
            float: right;
            cursor: pointer;
            margin-top: 10px;
        }

        label.yard-label{
            font-family: "Lato", sans-serif;
            text-transform: uppercase;
            font-weight: bold;
            color: black;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        div.yards-types{
            font-size: 16px;
            color: #666666;
            font-family: "Lato", sans-serif;
            border-radius: 4px;
            background-color: #F9F9FA;
            width: 150px;
            height: 57px;
            float: left;
            margin-right: 10px;
            margin-bottom: 10px;
            padding: 5px;
            cursor: pointer;
            position: relative;

            div.yards-types-container{
                position: absolute;
                top: 50%;
                transform: translateY(-50%);

                img.yards-types-icon{
                    display: inline-block;
                    margin-right: 10px;
                    margin-left: 5px;
                    width: 20px;
                    max-height: 30px;
                }

                span.yards-types-name{
                    display: inline-block;
                    width: calc( 100% - 40px);
                    vertical-align: middle;
                }
            }
        }

        div.address-container{
            color: #666666;
            font-size: 18px;
            line-height: 23px;
            font-family: "Lato", sans-serif;
            margin-bottom: 5px;

            span.address{
                display: block;
            }

            span.city-state{
                display: block;
            }

            span.zip{
                display: block;
            }
        }

        a.suggest-yard-edit{
            font-family: "Lato", sans-serif;
            color: #054E7A;
            font-size: 14px;
            display: inline-block;
            margin-top: 30px;
            text-decoration: underline;
        }

        /* Small only */
        @media screen and (max-width: 39.9375em) {
            div#yard-page{
                position: fixed;
                right: 0px;
                left: 0px;
                top: 0px;
                bottom: 0px;
                z-index: 99999;
            }
        }

        /* Medium only */
        @media screen and (min-width: 40em) and (max-width: 63.9375em) {

        }

        /* Large only */
        @media screen and (min-width: 64em) and (max-width: 74.9375em) {

        }
    }
</style>

<template>
    <div id="yard-page" v-if="yardLoadStatus == 2 || ( yardLoadStatus != 2 && ( yardLikeActionStatus == 1 || yardLikeActionStatus == 2 || yardUnlikeActionStatus == 1 || yardUnlikeActionStatus == 2 ) )">
        <router-link :to="{ name: 'yards' }">
            <img class="close-icon" src="/img/close-icon.svg"/>
        </router-link>
        <h2 class="yard-title">{{ yard.name }}</h2>
        <div class="grid-x">
            <div class="large-12 medium-12 small-12 cell">
                <toggle-like></toggle-like>
            </div>
        </div>       
        <div class="grid-x">
            <div class="large-12 medium-12 small-12 cell">
                <label class="yard-label">Yards Types</label>
                <div class="yards-types" v-for="name in yard.yards_types">
                    <div class="yards-types-container">
                        <img v-bind:src="method.icon+'.svg'" class="yards-types-icon"/> <span class="yards-types-name">{{ method.method }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid-x">
            <div class="large-12 medium-12 small-12 cell">
                <label class="yard-label">Location And Information</label>
                <div class="address-container">
                    <span class="address">{{ yard.address }}</span>
                    <span class="city-state">{{ yard.city }}, {{ yard.state }}</span>
                    <span class="zip">{{ yard.zip }}</span>
                </div>

                <br>
                <router-link :to="{ name: 'edityard', params: { id: yard.id } }" v-show="userLoadStatus == 2 && user != ''" class="suggest-yard-edit">
                    Suggest an edit
                </router-link>
                <a class="suggest-yard-edit" v-if="userLoadStatus == 2 && user == ''" v-on:click="loginToEdit()">
                    Sign in to make an edit
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    import { EventBus } from '../event-bus.js';

    /*
      Import the loader and yard map for use in the component.
    */
    import Loader from '../components/global/Loader.vue';
    import IndividualYardMap from '../components/yards/IndividualYardMap.vue';
    import ToggleLike from '../components/yards/ToggleLike.vue';

    export default {
        /*
          Defines the components used by the page.
        */
        components: {
            Loader,
            IndividualYardMap,
            ToggleLike
        },

        /*
          When created, load the yard based on the ID in the
          route parameter.
        */
        created(){
            this.$store.dispatch( 'loadYard', {
                id: this.$route.params.id
            });
        },

        watch: {
            '$route.params.id': function(){
                this.$store.dispatch( 'clearLikeAndUnlikeStatus' );
                this.$store.dispatch( 'loadYard', {
                    id: this.$route.params.id
                });
            },

            'yardLoadStatus': function(){
                if( this.yardLoadStatus == 2 ){
                    EventBus.$emit('location-selected', { lat: parseFloat( this.yard.latitude ), lng: parseFloat( this.yard.longitude ) });
                }

                if( this.yardLoadStatus == 3 ){
                    EventBus.$emit('show-error', { notification: 'Yard Not Found!'} );
                    this.$router.push({ name: 'yards' });
                }
            }
        },


        /*
          Defines the computed variables on the yard.
        */
        computed: {
            /*
              Grabs the yard load status from the Vuex state.
            */
            yardLoadStatus(){
                return this.$store.getters.getYardLoadStatus;
            },

            yardLikeActionStatus(){
                return this.$store.getters.getYardLikeActionStatus;
            },

            yardUnlikeActionStatus(){
                return this.$store.getters.getYardUnlikeActionStatus;
            },

            /*
              Grabs the yard from the Vuex state.
            */
            yard(){
                return this.$store.getters.getYard;
            },

            /*
              Gets the authenticated user.
            */
            user(){
                return this.$store.getters.getUser;
            },

            /*
              Gets the user's load status.
            */
            userLoadStatus(){
                return this.$store.getters.getUserLoadStatus();
            }
        },

        /*
          Defines the methods used by the component.
        */
        methods: {
            loginToEdit(){
                EventBus.$emit('prompt-login');
            }
        }
    }
</script>