import { YARD_CONFIG } from '../config.js';

export default {
    /**
     * GET /api/v1/yards
     * @returns {*}
     */
    getYards: function(){
        return axios.get( YARD_CONFIG.API_URL + '/yards' );
    },

    getYard: function( yardID ){
        return axios.get( YARD_CONFIG.API_URL + '/yards/' + yardID );
        console.log( 'yardID: ' + yardID);
    },

    postAddNewYard: function( name, address, city, state, zip, description, lat, lng ){
        /*
            Initialize the form data
        */
        let formData = new FormData();

        /*
            Add the form data we need to submit
        */

        formData.append('name', name);
        formData.append('address', address);
        formData.append('city', city);
        formData.append('state', state);
        formData.append('zip', zip);
        formData.append('description', zip);
        formData.append('lat', lat);
        formData.append('lng', lng);

        return axios.post( YARD_CONFIG.API_URL + '/yards',
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
        );
    },

    postLikeYard: function ( yardID ){
        return axios.post( YARD_CONFIG.API_URL + '/yards/' + yardID + '/like' );
    },

    deleteLikeYard: function ( yardID ){
        return axios.delete( YARD_CONFIG.API_URL + '/yards/' + yardID + '/like' );
    }

}