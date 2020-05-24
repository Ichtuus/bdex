<template>
    <div>
        <div>
            <b-form inline v-if="!isAuthenticated">
<!--                <loading :active.sync="isLoading" :is-full-page="fullPage"></loading>-->
                <div v-if="error" class="mb-2 mr-sm-2 mb-sm-0 alert alert-danger">
                    {{error}}
                </div>
                <label class="sr-only" for="inline-form-input-username">Username</label>
                <b-input-group class="mb-2 mr-sm-2 mb-sm-0">
                    <b-input
                            id="inline-form-input-username"
                            class="mb-2 mr-sm-2 mb-sm-0"
                            placeholder="Jane"
                            v-model="username"
                    ></b-input>
                </b-input-group>
                <label class="sr-only" for="inline-form-input-email">Email</label>
                <b-input-group prepend="@" class="mb-2 mr-sm-2 mb-sm-0">
                    <b-input
                            id="inline-form-input-email"
                            class="mb-2 mr-sm-2 mb-sm-0"
                            placeholder="Janedoe@gmail.com"
                            v-model="email"
                            required
                    ></b-input>
                </b-input-group>

                <label class="sr-only" for="inline-form-input-password">Password</label>
                <b-input
                        id="inline-form-input-password"
                        type="password"
                        v-model="password"
                        placeholder="password"
                        required
                ></b-input>
                <b-form-checkbox class="mb-2 mr-sm-2 mb-sm-0">Remember me</b-form-checkbox>

                <b-button type="button" @click="loginSubmit" variant="primary">Login</b-button>
            </b-form>
            <b-form v-if="isAuthenticated">
                <b-button v-b-modal.user-profile-modal
                          class="logout-button"
                          type="button"
                          variant="warning">
                    Profile
                </b-button>
                <router-link to="/logout">
                    <b-button class="logout-button"
                              type="button"
                              @click="logoutSubmit"
                              variant="danger">
                        Logout
                    </b-button>
                </router-link>
            </b-form>
            <user-profile-modal/>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';
    import UserProfileModal from "../Admin/Profile/Modal/UserProfileModal";

    export default {
      components: {UserProfileModal, Loading},
      data() {
        return {
          username: '',
          email: '',
          password: '',
          isLoading: false,
          fullPage: true
        }
      },
      computed: {
        ...mapGetters('login', [
            'error',
            'isAuthenticated'
        ]),
      },
      methods: {
        async loginSubmit() {
          let payload = {
            username: this.username,
            password: this.password,
            email: this.email
          };

          try {
            await this.$store.dispatch('login/login', payload);
          } catch (e) {
            console.log('vue_error', e)
          }
        },
        async logoutSubmit() {
          await this.$store.dispatch('login/logout');
        }
      }
    }
</script>
<style scoped>
    .logout-button {
        text-decoration: none;
        color: white;
    }
</style>