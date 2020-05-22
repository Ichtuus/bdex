import Vue from 'vue';
import Vuex from 'vuex';
import VuexPersist from "vuex-persist";
import artistsModule from './modules/artists';
import loginModule from './modules/login';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

const vuexLocalPersist = new VuexPersist({
  key: "localStore",
  storage: localStorage,
  modules: ['login']
});

export default new Vuex.Store({
  modules: {
    artists: artistsModule,
    login: loginModule
  },
  strict: debug,
  mutations: {
    RESTORE_MUTATION: vuexLocalPersist.RESTORE_MUTATION
  },
  plugins: [vuexLocalPersist.plugin]
});

