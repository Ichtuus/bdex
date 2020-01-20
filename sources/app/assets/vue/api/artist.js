import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)

export default {

  getArtists() {
    Vue.axios.get("https://bboyrankingz.com/ranking/artists/2020/elo.json")
    .then((response) => {
      console.log('fiagao', response.data.results)
      sendD(response.data)
      return response.data;
    })
  },


}

function sendD (datas) {
  console.log('ici')
  if(datas){
    console.log('ici,',datas);
    Vue.axios.post("artists/all", { artists: datas })
    .then((response) => {
      console.log('func', response)
    })
  }
}
