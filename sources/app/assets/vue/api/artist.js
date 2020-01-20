export default {
  getArtists() {
    return fetch("https://bboyrankingz.com/ranking/artists/2020/elo.json")
    .then(resp => resp.json())
    .then(resp => resp);
  },

}