<template>
    <basic-portlet>
        <template #title>
            <h2 class="d-inline">
                {{user.username}}
                <span class="d-inline brand-text brand-big visible text-uppercase">
                    <strong class="text-primary d-inline">P</strong><strong class="d-inline">rofile</strong>
                    <strong class="text-primary d-inline">S</strong><strong class="d-inline">ettings</strong>
                </span>
            </h2>
        </template>
        <template #body>
            <b-container fluid>
                <b-row class="my-1" v-for="(type, i) in types" :key="i">
                    <b-col sm="3">
                        <label>{{type.name}}: </label>
                    </b-col>
                    <b-col sm="9" class="div-item-setting">
                        <span v-if="type.key === 'date'" class="span-item-profile">
                            <b-form-input @input="birthdayPickerData" :value="user[type.name]" :id="type.name" :type="type.key"></b-form-input>
                         </span>
                        <span v-else class="span-item-profile">
                            <b-form-input @keydown="debounceUserData" :value="user[type.name]" :id="type.name" :type="type.key"></b-form-input>
                         </span>
                    </b-col>
                </b-row>
            </b-container>
        </template>
    </basic-portlet>
</template>

<script>
  import {debounce} from 'lodash';
  import BasicPortlet from "../../../tools/BasicPortlet";
  import {mapGetters} from "vuex";

  export default {
    components: {BasicPortlet},
    data() {
      return {
        value: '',
        types: [
          { name: 'username', key: 'text' },
          { name: 'adress', key: 'text' },
          { name: 'image', key: 'text' },
          { name: 'birthday', key: 'date' }
        ]
      }
    },
    computed: {
      ...mapGetters('login', [
        'user',
        'userId'
      ]),
    },
    methods: {
      debounceUserData: debounce(function (e) {
        const key = e.target.id;
        const value = e.target.value;
        this.submit(key, value);
      }, 800),
      async submit(key, value) {
        if (!this.user.hasOwnProperty(key)) {
          console.log('This key doesn\'t exist')
          return;
        }
        await this.$store.dispatch('login/editUserKey', {key, value});
      },
      birthdayPickerData(value) {
        this.submit('birthday', value)
      }
    }
  }
</script>

<style scoped>

</style>