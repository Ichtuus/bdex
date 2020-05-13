import Vue from 'vue'
import Vuex from 'vuex'
import apiLogin from '../../api/login';

Vue.use(Vuex);

const AUTHENTICATING = "AUTHENTICATING";
const AUTHENTICATING_SUCCESS = "AUTHENTICATING_SUCCESS";
const AUTHENTICATING_ERROR = "AUTHENTICATING_ERROR";
const PROVIDING_DATA_ON_REFRESH_SUCCESS = "PROVIDING_DATA_ON_REFRESH_SUCCESS";

const state = {
    isLoading: false,
    error: null,
    isAuthenticated: false,
    user: null
};

const actions = {
  async login({commit}, payload) {
    commit(AUTHENTICATING_ERROR, []);
    commit(AUTHENTICATING);
    try {
      const response = await apiLogin.login(
          payload.username,
          payload.email,
          payload.password
      );
      commit(AUTHENTICATING_SUCCESS, response.data);
      return response.data;
    } catch (error) {
      console.log('store_error',error.response)
      commit(AUTHENTICATING_ERROR, error.response.data.error);
    }
  },
  onRefresh({commit}, payload) {
    commit(PROVIDING_DATA_ON_REFRESH_SUCCESS, payload);
  }
};

const getters = {
  isLoading(state) {
    return state.isLoading;
  },
  hasError(state) {
    return state.error !== null;
  },
  error(state) {
    return state.error;
  },
  isAuthenticated(state) {
    return state.isAuthenticated;
  },
  // hasRole(state) {
  //   return role => {
  //     return state.user.roles.indexOf(role) !== -1;
  //   }
  // }
};

const mutations = {
  [AUTHENTICATING](state) {
    state.isLoading = true;
    state.error = null;
    state.isAuthenticated = false;
    state.user = null;
  },
  [AUTHENTICATING_SUCCESS](state, user) {
    state.isLoading = false;
    state.error = null;
    state.isAuthenticated = true;
    state.user = user;
  },
  [AUTHENTICATING_ERROR](state, error) {
    state.isLoading = false;
    state.error = error;
    state.isAuthenticated = false;
    state.user = null;
  },
  [PROVIDING_DATA_ON_REFRESH_SUCCESS](state, payload) {
    state.isLoading = false;
    state.error = null;
    state.isAuthenticated = payload.isAuthenticated;
    state.user = payload.user;
  }
};

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters
}