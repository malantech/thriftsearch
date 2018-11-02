<style lang="scss">
    @import '~@/abstracts/_variables.scss';

    span.toggle-like{

        span.like-toggle{
            display: inline-block;
            cursor: pointer;
            color: #8E8E8E;
            font-size: 18px;
            margin-bottom: 5px;

            span.image-container{
                width: 35px;
                text-align: center;
                display: inline-block;
            }
        }

        span.like-count{
            font-family: "Lato", sans-serif;
            font-size: 12px;
            margin-left: 10px;
            color: #8E8E8E;
        }
    }
</style>
<template>
  <span class="toggle-like" v-show="userLoadStatus == 2 && user != ''">
    <span class="like like-toggle" v-on:click="likeYard( yard.id )" v-if="!liked && yardLoadStatus == 2 && yardLikeActionStatus != 1 && yardUnlikeActionStatus != 1">
      <span class="image-container">
        <img src="/img/unliked.svg"/>
      </span> Like?
    </span>
    <span class="un-like like-toggle" v-on:click="unlikeYard( yard.id )" v-if="liked && yardLoadStatus == 2 && yardLikeActionStatus != 1 && yardUnlikeActionStatus != 1">
      <span class="image-container">
        <img src="/img/liked.svg"/>
      </span> Liked
    </span>
    <loader v-show="yardLikeActionStatus == 1 || yardUnlikeActionStatus == 1 || yardLoadStatus != 2"
            :width="23"
            :height="23"
            :display="'inline-block'">
    </loader>
    <span class="like-count">
      {{ yard.likes_count }} likes
    </span>
  </span>
</template>
<script>
    import Loader from '../global/Loader.vue';

    export default {
        components: {
            Loader
        },

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

            /*
              Gets the yard load status from the Vuex state.
            */
            yardLoadStatus(){
                return this.$store.getters.getYardLoadStatus;
            },

            /*
              Gets the yard from the Vuex state.
            */
            yard(){
                return this.$store.getters.getYard;
            },

            /*
              Determines if the yard is liked or not.
            */
            liked(){
                return this.$store.getters.getYardLikedStatus;
            },

            /*
              Determines if the yard is still processing the like action.
            */
            yardLikeActionStatus(){
                return this.$store.getters.getYardLikeActionStatus;
            },

            /*
              Determines if the yard is still processing the un-like action.
            */
            yardUnlikeActionStatus(){
                return this.$store.getters.getYardUnlikeActionStatus;
            }
        },

        methods: {
            likeYard( yardID ){
                this.$store.dispatch( 'likeYard', {
                    id: this.yard.id
                });
            },

            unlikeYard( yardID ){
                this.$store.dispatch( 'unlikeYard', {
                    id: this.yard.id
                });
            }
        }
    }
</script>
