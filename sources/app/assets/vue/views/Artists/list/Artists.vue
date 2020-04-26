<template>
    <div>
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Artists</h2>
            </div>
        </div>
        <div>
            <button type="button" @click="create()">Create</button>
        </div>

        <ArtistsList/>

    </div>

</template>

<script>
  import apiArtists from '../../../api/artist';
  import ArtistsList from "./ArtistsList";

  export default {
    name: "Artists",
    components: {ArtistsList},
    methods: {
        async create() {
          console.log('vue_create')
         const artists = await apiArtists.createArtists();
          console.log('okok',artists)
        },
    }
  }
</script>

<style>
</style>