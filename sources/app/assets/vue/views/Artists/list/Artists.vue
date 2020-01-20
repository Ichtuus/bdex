<template>
    <div>hello</div>
</template>

<script>
  import {mapGetters} from 'vuex';
  export default {
    name: "Artists",
    computed: {
      ...mapGetters('artists', [

      ])
    },
    async created() {
        const datas = await this.$store.dispatch('artists/updateArtistsList');
   

    },
    methods: {

    }
  }
</script>

<style scoped>
</style>