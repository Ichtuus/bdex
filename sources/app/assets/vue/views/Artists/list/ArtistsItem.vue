<template>
    <div class="col-lg-4">
        <div class="user-block block text-center">
            <div class="avatar"><img :src="artist.thumb" alt="artist" class="img-fluid">
                <div class="order dashbg-2">{{artist.id}}</div>
            </div>
            <ul class="list-unstyled">
                <li>
                    <router-link
                            class="nav-item"
                            tag="li"
                            :to="{name: 'artist_show', params: {id: artist.id}}"
                            active-class="active"
                    >
<!--                        <a class="user-title">-->
                            <h3 class="h5">{{artist.artistsName}}</h3>
                            <span>@richardnevo</span>
<!--                        </a>-->
                    </router-link>
                </li>
            </ul>

            <div class="contributions">{{artist.country}}</div>
            <div class="details d-flex">
                <div class="item"><i class="icon-info"></i><strong>150</strong></div>
                <div class="item"><i class="fa fa-gg"></i><strong>340</strong></div>
                <div class="item"><i class="icon-flow-branch"></i><strong>460</strong></div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: "ArtistsItem",
    props: ['artist']
  }
</script>

<style scoped>

</style>