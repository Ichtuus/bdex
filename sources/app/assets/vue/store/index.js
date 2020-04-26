import Vue from 'vue';
import Vuex from 'vuex';
import artistsModules from './modules/artists';
import loginModule from './modules/login';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
  modules: {
    artists: artistsModules,
    login: loginModule
  },
  strict: debug
})