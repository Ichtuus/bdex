import Vue from 'vue'
import Vuex from 'vuex'
import apiLogin from '../../api/login';

Vue.use(Vuex);

const AUTHENTICATING = "AUTHENTICATING";
const AUTHENTICATING_SUCCESS = "AUTHENTICATING_SUCCESS";
const AUTHENTICATING_ERROR = "AUTHENTICATING_ERROR";
const PROVIDING_DATA_ON_REFRESH_SUCCESS = "PROVIDING_DATA_ON_REFRESH_SUCCESS";
const RESTORE_LOGIN_MUTATION = "RESTORE_LOGIN_MUTATION";
const UPDATE_USER_KEY_INFO = "UPDATE_USER_KEY_INFO";

const state = {
    isLoading: false,
    error: null,
    isAuthenticated: false,
    user: {
      username: '',
      adress: '',
      birthday: '',
      image: ''
    },
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
  },
  async editUserKey({commit, getters}, {key, value}) {

    let data = {};
    if(key === "username") {
      data = {"username": value};
    }
    if(key === "adress") {
      data = {"adress": value};
    }
    if(key === "birthday") {
      data = {"birthday": value};
    }
    if(key === "image") {
      data = {"image": value};
    }

    try {
      await apiLogin.patchUserData({id: getters.userId}, data);
      commit(UPDATE_USER_KEY_INFO, {key, value})
    } catch (e) {
      console.log(e)
    }

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
  userId(state) {
    return state.user.id;
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
      id: user.id,
      username: user.username,
      adress: user.adress,
      birthday: user.birthday,
      image: user.image,
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
  },
   [UPDATE_USER_KEY_INFO](state, {key, value}) {
     state.user[key] = value;
   },
};

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters
}