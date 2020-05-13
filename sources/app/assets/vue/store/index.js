import Vue from 'vue';
import Vuex from 'vuex';
import artistsModule from './modules/artists';
import loginModule from './modules/login';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
  modules: {
    artists: artistsModule,
    login: loginModule
  },
  strict: debug
})