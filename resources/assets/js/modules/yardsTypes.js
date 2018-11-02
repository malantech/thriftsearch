/*
|-------------------------------------------------------------------------------
| VUEX modules/brewmethods.js
|-------------------------------------------------------------------------------
| The Vuex data store for the brew methods
*/
import YardsTypeAPI from '../api/yardsType.js';

export const yardsTypes = {
    /*
      Defines the state being monitored for the module
    */
    state: {
        yardsTypes: [],
        yardsTypesLoadStatus: 0
    },

    actions: {
        loadYardsTypes( { commit } ){
            commit( 'setYardsTypesLoadStatus', 1 );

            YardsTypeAPI.getYardsTypes()
                .then( function( response ){
                    commit( 'setYardsTypes', response.data );
                    commit( 'setYardsTypesLoadStatus', 2 );
                })
                .catch( function(){
                    commit( 'setYardsTypes', [] );
                    commit( 'setYardsTypesLoadStatus', 3 );
                });
        }
    },

    mutations: {
        setYardsTypesLoadStatus( state, status ){
            state.yardsTypesLoadStatus = status;
        },

        setYardsTypes( state, yardsTypes ){
            state.yardsTypes = yardsTypes;
        }
    },

    getters: {
        getYardsTypes( state ){
            return state.yardsTypes;
        },

        getYardsTypesLoadStatus( state ){
            return state.yardsTypesLoadStatus;
        }
    }
}
