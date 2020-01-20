import Vue from 'vue';
import Vuex from 'vuex';
import artistsModules from './modules/artists';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
  modules: {
    artists: artistsModules
  },
  strict: debug
})