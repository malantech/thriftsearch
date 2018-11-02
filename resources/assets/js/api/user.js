import { YARD_CONFIG } from "../config.js";

export default {
    getUser: function(){
        return axios.get( YARD_CONFIG.API_URL + '/user' );
    }
}