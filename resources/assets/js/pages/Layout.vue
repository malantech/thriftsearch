<style scoped lang="scss">

    div#app-layout{
        div.show-filters{
            height: 90px;
            width: 23px;
            position: absolute;
            left: 0px;
            background-color: white;
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
            line-height: 90px;
            top: 50%;
            cursor: pointer;
            margin-top: -45px;
            z-index: 9;
            text-align: center;
        }
    }

</style>

<template>
    <div id="app-layout">
        <navigation></navigation>

        <router-view></router-view>

        <login-modal></login-modal>
    </div>
</template>

<script>
    import { EventBus } from '../event-bus.js';

    import Navigation from '../components/global/Navigation.vue';
    import LoginModal from '../components/global/LoginModal.vue';

    export default {
        components: {
            Navigation,
            LoginModal
        },

        created(){
            this.$store.dispatch( 'loadYards' );
            this.$store.dispatch( 'loadUser' );
            //this.$store.dispatch( 'loadYardsTypes' );
        },

        computed: {
            showFilters(){
                return this.$store.getters.getShowFilters;
            },

            addedYard(){
                return this.$store.getters.getAddedYard;
            },

            addYardStatus(){
                return this.$store.getters.getYardAddStatus;
            }
        },

        watch: {
            'addYardStatus': function(){
                if( this.addYardStatus == 2 ){
                    EventBus.$emit('show-success', {
                        notification: this.addedYard.name+' has been added!'
                    });
                }
            }
        },

        methods: {
            toggleShowFilters(){
                this.$store.dispatch( 'toggleShowFilters', { showFilters : !this.showFilters } );
            }
        }
    }
</script>