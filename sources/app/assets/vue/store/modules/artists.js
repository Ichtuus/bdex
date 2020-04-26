import ArtistsApi from '../../api/artist';

// state
const state = {
  artists: [],
  isInitialized: false,
  errors: '',
  page: 1,
  filters: {
    next: ''
  },
};

// actions
const actions = {
  async updateArtistsList({commit, state}, {url}) {
    try {
      const artists = await ArtistsApi.getArtists({url, param: state.page});
      commit('ADD_PAGE');
      return artists;
    }catch(e) {
      commit('SET_ERROR', e);
      return [];
    }
  },
};

// getters
const getters = {
  getArtists(state) {
    return state.artists;
  },
  isInitialized(state) {
    return state.isInitialized;
  },
};

const mutations = {
  ['UPDATE_INITIALIZATION'](state, isInitialized){
    state.isInitialized = isInitialized;
  },
  ['SET_ERROR'](state, error) {
    state.errors = error;
  },
  ['ADD_PAGE'](state) {
    state.page += 1;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}