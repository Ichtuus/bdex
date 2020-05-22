import Vue from 'vue'
import Vuex from 'vuex'
import apiLogin from '../../api/login';

Vue.use(Vuex);

const AUTHENTICATING = "AUTHENTICATING";
const AUTHENTICATING_SUCCESS = "AUTHENTICATING_SUCCESS";
const AUTHENTICATING_ERROR = "AUTHENTICATING_ERROR";
const PROVIDING_DATA_ON_REFRESH_SUCCESS = "PROVIDING_DATA_ON_REFRESH_SUCCESS";
const RESTORE_LOGIN_MUTATION = "RESTORE_LOGIN_MUTATION";

const state = {
    isLoading: false,
    error: null,
    isAuthenticated: false,
    user: {},
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
      console.log('store error => on login',error.response)
      commit(AUTHENTICATING_ERROR, error.response.data.error);
    }
  },
  async logout({commit}) {
    try {
      console.log('restore state login store ')
      await apiLogin.logout();
      commit(RESTORE_LOGIN_MUTATION);
    } catch (e) {
      console.log(e)
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
  user(state) {
      return state.user;
  },
  isAdmin(state) {
      return !!(state.user && state.user.roles.filter(role => role === "ROLE_ADMIN"));
  }
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
    state.user = {
      username: user.username,
      email: user.email,
      roles: user.roles
    };
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
  },
  [RESTORE_LOGIN_MUTATION](state) {
    state.isLoading = false;
    state.error = null;
    state.isAuthenticated = false;
    state.user = null;
  }
};

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters
}