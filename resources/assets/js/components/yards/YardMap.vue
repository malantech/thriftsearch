<style scoped lang="scss">
    @import '~@/abstracts/_variables.scss';

    div#yard-map-container {
        position: absolute;
        top: 75px;
        left: 0px;
        right: 0px;
        bottom: 0px;

        div#yard-map {
            position: absolute;
            top: 0px;
            left: 0px;
            right: 0px;
            bottom: 0px;
        }
    }
</style>

<template>
    <div id="yard-map-container">
        <div id="yard-map">

        </div>
    </div>
</template>

<script>
    export default {
        props: {
            'latitude': {
                type: Number,
                default: function () {
                    return 39.50
                }
            },
            'longitude': {
                type: Number,
                default: function () {
                    return -98.35
                }
            },
            'zoom': {
                type: Number,
                default: function () {
                    return 4
                }
            }
        },

        data(){
            return {
                markers: [],
                infoWindows: []
            }
        },

        computed: {
            yards(){
                return this.$store.getters.getYards;
            }
        },

        watch: {
            yards(){
                this.clearMarkers();
                this.buildMarkers();
            }
        },

        mounted() {
            this.map = new google.maps.Map(document.getElementById( 'yard-map' ), {
                center: {lat: this.latitude, lng: this.longitude },
                zoom: this.zoom
            });

            this.clearMarkers();
            this.buildMarkers();
        },

        methods: {
            buildMarkers(){
                this.markers = [];

                for( var i = 0; i < this.yards.length; i++ ){

                    var image = '/img/thriftshuffle-icon.png';

                    var marker = new google.maps.Marker({
                        position: { lat: parseFloat( this.yards[i].latitude ), lng: parseFloat( this.yards[i].longitude ) },
                        map: this.map,
                        icon: image,
                        yard: this.yards[i]
                    });

                    var contentString = '<div class="yards-info-window">' +
                        '<div class="yards-name">'+this.yards[i].name+'</div>' +
                        '<div class="yards-address">' +
                        '<span class="street">'+this.yards[i].address+'</span>' +
                        '<span class="city">'+this.yards[i].city+'</span> <span class="state">'+this.yards[i].state+'</span>' +
                        '<span class="zip">'+this.yards[i].zip+'</span>' +
                        ' <a href="/#/yards/'+this.yards[i].id+'">Visit</a>' +
                        '</div>' +
                        '</div>';

                    /*
                      Create the info window and add it to the local
                      array.
                    */
                    let infoWindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                    this.infoWindows.push( infoWindow );

                    /*
                      Add the event listener to open the info window for the marker.
                    */
                    marker.addListener('click', function() {
                        infoWindow.open(this.map, this);
                    });

                    this.markers.push( marker );
                }
            },

            clearMarkers(){
                for( var i = 0; i < this.markers.length; i++){
                    this.markers[i].setMap( null );
                }
            }
        }
    }
</script>