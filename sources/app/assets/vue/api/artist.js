import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios);

export default {
  getArtists({url, param}) {
    return axios.get(url, {
      params: {
        page: param
      }
    })
    .then((response) => {
      return response.data;
    });
  },
  createArtists() {
    Vue.axios.get('artists/get')
    .then((response) => {
      console.log('get')
      return response;
    })
  }


}
