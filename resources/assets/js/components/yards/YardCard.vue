<style scoped lang="scss">
    @import '~@/abstracts/_variables.scss';

    div.yard-card{
        border:1px solid #dddddd;
        border-radius: 5px;
        box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);
        padding: 15px 5px;
        margin-top: 20px;
        cursor: pointer;
        -webkit-transform: scaleX(1) scaleY(1);
        transform: scaleX(1) scaleY(1);
        transition: .2s;

        span.title{
            display: block;
            text-align: center;
            color: black;
            font-size: 18px;
            font-weight: bold;
            font-family: 'Lato', sans-serif;
        }

        span.address{
            display: block;
            text-align: center;
            margin-top: 5px;
            color: $grey;
            font-family: 'Lato', sans-serif;

            span.street{
                font-size: 14px;
                display: block;
            }

            span.city{
                font-size: 14px;
            }

            span.state{
                font-size: 14px;
            }

            span.zip{
                font-size: 14px;
                display: block;
            }
        }

        &:hover{
            -webkit-transform: scaleX(1.041) scaleY(1.041);
            transform: scaleX(1.041) scaleY(1.041);
            transition: .2s;
        }
    }
</style>

<template>
    <div class="large-6 medium-6 small-6 cell yard-card-container" v-show="show">
        <router-link :to="{ 'name': 'yard', params: { 'id': yard.id } }">
            <div class="yard-card">
                <span class="title">{{ yard.name }}</span>
                <span class="myId">{{ yard.id }}</span>
                <span class="address">
                  <span class="street">{{ yard.address }}</span>
                  <span class="city">{{ yard.city }}</span> <span class="state">{{ yard.state }}</span>
                  <span class="zip">{{ yard.zip }}</span>
                </span>
            </div>
        </router-link>
    </div>
</template>

<script>
    export default {
    /*
      Imports the Event Bus to listen to filter updates
    */
    import { EventBus } from '../../event-bus.js';

    export default {
        props: ['yard'],

        data(){
            return {
                show: true
            }
        },

        methods: {
            panToLocation( yard ){
                EventBus.$emit('location-selected', { lat: parseFloat( yard.latitude ), lng: parseFloat( yard.longitude ) });
            }
        }
    }
</script>