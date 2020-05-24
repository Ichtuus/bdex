<template>
    <b-modal ref="user-profile-modal"
             id="user-profile-modal">
        <template #modal-header>
            {{user.username}}
            <span>
                <strong class="text-primary d-inline">S</strong>
                <strong class="d-inline">ettings</strong>
            </span>
        </template>
        <template #default>tuuui</template>
        <template #modal-footer>
            <b-button class="mt-3" variant="outline-danger" block @click="hideModal">
                Close
            </b-button>
        </template>
    </b-modal>
</template>

<script>
  import {mapGetters} from "vuex";

  export default {
    computed: {
      ...mapGetters('login', [
        'user',
      ]),
    },
    methods: {
      hideModal() {
        this.$refs['user-profile-modal'].hide()
      },
    }
  }
</script>

<style scoped>

</style>