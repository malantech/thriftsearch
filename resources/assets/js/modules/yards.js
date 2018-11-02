import YardAPI from '../api/yard.js';

export const yards = {
    /**
     * status = 0 -> No loading has begun
     * status = 1 -> Loading has started
     * status = 2 -> Loading completed successfully
     * status = 3 -> Loading completed unsuccessfully
     */
    state: {
        yards: [],
        yardsLoadStatus: 0,

        yard: {},
        yardLoadStatus: 0,

        yardAddStatus: 0,

        yardLiked: false,

        yardLikeActionStatus: 0,
        yardUnlikeActionStatus: 0
    },

    actions: {
        loadYards({commit}) {
            commit('setYardsLoadStatus', 1);

            YardAPI.getYards()
                .then(function (response) {
                    commit('setYards', response.data);
                    commit('setYardsLoadStatus', 2);
                })
                .catch(function () {
                    commit('setYards', []);
                    commit('setYardsLoadStatus', 3);
                });
        },

        loadYard({commit}, data) {
            commit( 'setYardLikedStatus', false );
            commit('setYardLoadStatus', 1);

            YardAPI.getYard( data.id )
                .then(function (response) {
                    commit('setYard', response.data);
                    if( response.data.user_like.length > 0 ){
                        commit( 'setYardLikedStatus', true );
                    }
                    commit('setYardLoadStatus', 2);
                })
                .catch(function () {
                    commit('setYard', {} );
                    commit('setYardLoadStatus', 3);
                });
            //console.log( "getting to yards.js line 56");
        },

        addYard({commit, state, dispatch}, data) {
            commit('setYardAddedStatus', 1);

            YardAPI.postAddNewYard(data.name, data.address, data.city, data.state, data.zip, data.description)
                .then(function (response) {
                    commit('setYardAddedStatus', 2);
                    dispatch('loadYards');
                })
                .catch(function () {
                    commit('setYardAddedStatus', 3);
                });
        },

        likeYard({commit, state}, data) {
            commit('setYardLikeActionStatus', 1);

            YardAPI.postLikeYard(data.id)
                .then(function (response) {
                    commit('setYardLikedStatus', true);
                    commit('setYardLikeActionStatus', 2);
                })
                .catch(function () {
                    commit('setYardLikeActionStatus', 3);
                });
        },

        unlikeYard({commit, state}, data) {
            commit('setYardUnlikeActionStatus', 1);

            YardAPI.deleteLikeYard(data.id)
                .then(function (response) {
                    commit('setYardLikedStatus', false);
                    commit('setYardUnlikeActionStatus', 2);
                })
                .catch(function () {
                    commit('setYardUnlikeActionStatus', 3);
                });
        }
    },

    mutations: {
        setYards( state, yards ){
            state.yards = yards;
        },

        setYardsLoadStatus( state, status ){
            state.yardsLoadStatus = status;
        },

        setYard( state, yard){
            state.yard = yard;
        },

        setYardLoadStatus( state, status ){
            state.yardLoadStatus = status;
        },

        setYardAddedStatus( state, status ){
            state.yardAddStatus = status;
        },

        setYardLikedStatus( state, status ){

        },

        setYardLikeActionStatus( state, status ){

        },

        setYardUnlikeActionStatus( state, status ){

        },

    },

    getters: {
        getYards( state ){
            return state.yards;
        },

        getYardsLoadStatus( state ){
            return state.yardsLoadStatus;
        },

        getYard( state ){
            return state.yard;
        },

        getYardLoadStatus( state ){
            return state.yardLoadStatus;
        },

        getYardAddStatus( state ){
            return state.yardAddStatus;
        },

        getYardLikedStatus( state ){
            return state.yardLiked;
        },

        getYardLikeActionStatus( state ){
            return state.yardLikeActionStatus;
        },

        getYardUnlikeActionStatus( state ){
            return state.yardUnlikeActionStatus;
        }
    }
}