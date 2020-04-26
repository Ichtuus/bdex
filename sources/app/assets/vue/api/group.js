import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios);

export default {

  createGroups() {
    Vue.axios.get('groups/get')
    .then((response) => {
      console.log('get')
      return response;
    })
  }


}
