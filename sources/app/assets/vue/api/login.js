import axios from "axios";

export default {
  login(username, email, password) {
    return axios.post("login", {
      username: username,
      email: email,
      password: password
    });
  }
}
