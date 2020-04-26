<template>
    <div v-if="isInitialized">
        <section class="no-padding-bottom">
            <div class="container-fluid">
                <div class="row"> <!-- v-if="getArtists.length" -->
                    <ArtistsItem v-for="(artist, $key) in artists" :artist="artist" :key="$key"/>
                    <!-- artists item loop -->
                </div>
                <infinite-loading @infinite="infiniteHandler" :distance="900" ref="infiniteLoading">
                    <span slot="no-more">No more data</span>
                    <span slot="no-results"></span>
                </infinite-loading>
            </div>
        </section>
    </div>
</template>

<script>
  import {mapGetters} from 'vuex';
  import InfiniteLoading from "vue-infinite-loading";
  import ArtistsItem from "./ArtistsItem";
  import Autocomplete from 'vue2-autocomplete-js';

  const artistsApi = 'api/artists';
  // const artistApi = 'api/artist';

  export default {
    name: "ArtistsList",
    components: {ArtistsItem, InfiniteLoading, Autocomplete},
    data() {
      return {
        isInitialized: true,
        artists: [],
        names: [],
        name: null,
        artistApi: 'api/artist'
      }
    },
    computed: {
      ...mapGetters('artists', [
        'getArtists'
      ])
    },
    methods: {
      async infiniteHandler($state) {
        const artists = await this.$store.dispatch('artists/updateArtistsList', {url: artistsApi});
        if (artists) {
          this.name = artists['hydra:member'].map(artist => artist.artistsName)
          this.artists.push(...artists['hydra:member']);
          $state.loaded();
        } else {
          $state.complete();
        }
      },
    }
  }
</script>
