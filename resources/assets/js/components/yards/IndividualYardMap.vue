<style scoped lang="scss">
    @import '~@/abstracts/_variables.scss';

    div#individual-yard-map{
        width: 700px;
        height: 500px;
        margin: auto;
        margin-bottom: 200px;
    }
</style>

<template>
    <div id="individual-yard-map">

    </div>
</template>

<script>
    export default {
        /*
          Defines the computed properties on the component.
        */
        computed: {
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
            }
        },

        /*
          Defines the variables we need to watch on the component.
        */
        watch: {
            /*
              The yard load status. When the yard load status equals 2
              we display the individual yard map. We have to wait until the
              yard is loaded so we get the lat and long for the yard.
            */
            yardLoadStatus(){
                if( this.yardLoadStatus == 2 ){
                    this.displayIndividualYardMap();
                }
            }
        },

        /*
          Defines the methods used by the component.
        */
        methods: {
            /*
              Displays the individual yard map.
            */
            displayIndividualYardMap(){
                /*
                  Builds the individual yard map.
                */
                this.map = new google.maps.Map(document.getElementById('individual-yard-map'), {
                    center: {lat: parseFloat( this.yard.latitude ), lng: parseFloat( this.yard.longitude )},
                    zoom: 13
                });

                /*
                  Defines the image used for the marker.
                */
                var image = '/img/coffee-marker.png';

                /*
                  Builds the marker for the yard on the map.
                */
                var marker = new google.maps.Marker({
                    position: { lat: parseFloat( this.yard.latitude ), lng: parseFloat( this.yard.longitude )},
                    map: this.map,
                    icon: image
                });
            }
        }
    }
</script>