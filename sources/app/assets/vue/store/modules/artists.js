import ArtistsApi from '../../api/artist';

// state
const state = {
  artists: []
};

// actions
const actions = {
  async updateArtistsList({commit, state}) {
    // commit('FETCHING_BOOKS');
    const artists = await ArtistsApi.getArtists();
    console.log('store', artists)
    commit('UPDATE_ARTISTS', artists);
  },
};

// getters
const getters = {
  getArtists(state) {
  }
};

const mutations = {
  ['UPDATE_ARTISTS'](state, artists) {
    state.artists = artists;
  },

};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}