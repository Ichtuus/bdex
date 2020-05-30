import axios from "axios";
const routes = require('../../../public/js/fos_js_routes.json');
import Routing from '../../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';
Routing.setRoutingData(routes);

export default {
  login(username, email, password) {
    return axios.post("login", {
      username: username,
      email: email,
      password: password
    });
  },
  logout() {
    return axios.get("logout");
  },
  patchUserData({id}, input) {
    console.log(input)
    console.log(id)
    return axios.patch(Routing.generate("user_patch", {id}),  input)
    .then(resp => resp.data);
  }
}
