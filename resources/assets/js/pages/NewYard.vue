<style scoped lang="scss">
    @import '~@/abstracts/_variables.scss';

</style>

<template>
    <div class="page">
        <form>
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="large-12 medium-12 small-12 cell">
                        <label>Name
                            <input type="text" placeholder="Name the Yard" v-model="name">
                            <span class="validation" v-show="!validations.name.is_valid">{{ validations.name.text }}</span>
                        </label>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label>Address
                            <input type="text" placeholder="Street Address of the Yard" v-model="address">
                            <span class="validation" v-show="!validations.address.is_valid">{{ validations.address.text }}</span>
                        </label>
                    </div>
                    <div class="large-4 medium-4 small-4 cell">
                        <label>City
                            <input type="text" placeholder="City" v-model="city">
                            <span class="validation" v-show="!validations.city.is_valid">{{ validations.city.text }}</span>
                        </label>
                    </div>
                    <div class="large-4 medium-4 small-4 cell">
                        <label>State
                            <input type="text" placeholder="State" v-model="state">
                            <span class="validation" v-show="!validations.state.is_valid">{{ validations.state.text }}</span>
                        </label>
                    </div>
                    <div class="large-4 medium-4 small-4 cell">
                        <label>Zip
                            <input type="text" placeholder="Zip" v-model="zip">
                            <span class="validation" v-show="!validations.zip.is_valid">{{ validations.zip.text }}</span>
                        </label>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label>Description
                            <input type="text" placeholder="This isn't required but it's helpful to have a teaser for people to gain interest in your junk" v-model="description">
                            <span class="validation" v-show="!validations.description.is_valid">{{ validations.description.text }}</span>
                        </label>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <a class="button" v-on:click="submitNewYard()">Add New Yard +</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import { EventBus } from '../event-bus.js';
    import _ from 'lodash';
    import { YARD_CONFIG } from '../config.js';

    export default {
        data() {
            return {
                name: '',
                address: '',
                city: '',
                state: '',
                zip: '',
                description: '',
                validations: {
                    name: {
                        is_valid: true,
                        text: '',
                    },
                    address: {
                        is_valid: true,
                        text: '',
                    },
                    city: {
                        is_valid: true,
                        text: '',
                    },
                    state: {
                        is_valid: true,
                        text: '',
                    },
                    zip: {
                        is_valid: true,
                        text: '',
                    },
                    description: {
                        is_valid: true,
                        text: '',
                    }
                }
            }
        },

        methods: {
            submitNewYard(){
                if( this.validateNewYard() ){
                    this.$store.dispatch( 'addYard', {
                        name: this.name,
                        address: this.address,
                        city: this.city,
                        state: this.state,
                        zip: this.zip,
                        description: this.description
                    });
                }
            },

            validateNewYard(){
                let validNewYardForm = true;

                if( this.name.trim() == '' ){
                    validNewYardForm = false;
                    this.validations.name.is_valid = false;
                    this.validations.name.text = 'Please enter a name for your yard, this is what others will see.';
                }else{
                    this.validations.name.is_valid = true;
                    this.validations.name.text = '';
                }

                if( this.address.trim() == '' ){
                    validNewYardForm = false;
                    this.validations.address.is_valid = false;
                    this.validations.address.text = 'It would be good to add an address so people can find the yard sale, just sayin\'.';
                }else{
                    this.validations.address.is_valid = true;
                    this.validations.address.text = '';
                }

                if( this.city.trim() == '' ){
                    validNewYardForm = false;
                    this.validations.city.is_valid = false;
                    this.validations.city.text = 'Please enter a city';
                }else{
                    this.validations.city.is_valid = true;
                    this.validations.city.text = '';
                }

                if( this.state.trim() == '' ){
                    validNewYardForm = false;
                    this.validations.state.is_valid = false;
                    this.validations.state.text = 'Please enter the state, we are not that smart yet but we\'are working on it';
                }else{
                    this.validations.state.is_valid = true;
                    this.validations.state.text = '';
                }

                if( this.zip.trim() == '' ){
                    validNewYardForm = false;
                    this.validations.zip.is_valid = false;
                    this.validations.zip.text = 'A Zip is Key to let people know the general area and well, it\'s required so...';
                }else{
                    this.validations.zip.is_valid = true;
                    this.validations.zip.text = '';
                }

                return validNewYardForm;
            },

            clearForm(){

            }
        },


    }
</script>