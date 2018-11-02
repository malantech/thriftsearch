import { YARD_CONFIG } from '../config.js';

export default {
    getYardsTypes: function(){
        return axios.get( YARD_CONFIG.API_URL + '/yardstypes' );
    }
}