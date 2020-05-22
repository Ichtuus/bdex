<template>
    <basic-portlet>
        <template #title>
            <h2 class="d-inline">Manage you're {{user.username}} -
                <span class="d-inline brand-text brand-big visible text-uppercase">
                    <strong class="text-primary d-inline">B</strong><strong class="d-inline">dex</strong>
                </span>
            </h2>
        </template>
        <template #body>
            <div>
                <h3 class="margin-bottom-25"><strong class="text-primary d-inline">L</strong> ist of commands:</h3>
                <div class="row">

                    <div class="col-md-6 col-sm-6">
                        <b-list-group>
                            <b-list-group-item>
                                <span class="d-inline">Title: </span>
                                <span class="d-inline">Description: </span>
                            </b-list-group-item>
                            <b-list-group-item>
                                <span class="d-inline">Title: </span>
                                <span class="d-inline">Description: </span>
                            </b-list-group-item>
                            <b-list-group-item>
                                <span class="d-inline">Title: </span>
                                <span class="d-inline">Description: </span>
                            </b-list-group-item>
                            <b-list-group-item>
                                <span class="d-inline">Title: </span>
                                <span class="d-inline">Description: </span>
                            </b-list-group-item>
                            <b-list-group-item>
                                <span class="d-inline">Title: </span>
                                <span class="d-inline">Description: </span>
                            </b-list-group-item>
                        </b-list-group>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <b-list-group>
                            <b-list-group-item>
                                <span class="d-inline">Title: </span>
                                <span class="d-inline">Description: </span>
                            </b-list-group-item>
                            <b-list-group-item>
                                <span class="d-inline">Title: </span>
                                <span class="d-inline">Description: </span>
                            </b-list-group-item>
                            <b-list-group-item>
                                <span class="d-inline">Title: </span>
                                <span class="d-inline">Description: </span>
                            </b-list-group-item>
                            <b-list-group-item>
                                <span class="d-inline">Title: </span>
                                <span class="d-inline">Description: </span>
                            </b-list-group-item>
                            <b-list-group-item>
                                <span class="d-inline">Title: </span>
                                <span class="d-inline">Description: </span>
                            </b-list-group-item>
                        </b-list-group>
                    </div>

                </div>
            </div>
        </template>
    </basic-portlet>
</template>

<script>
  import BasicPortlet from "../../tools/BasicPortlet";
  import {mapGetters} from "vuex";

  export default {
    components: {BasicPortlet},
    computed: {
      ...mapGetters('login', [
        'user',
      ]),
    },
  }
</script>

<style scoped>
    .list-group-item {
        cursor: pointer;
        background-color: #6A4348;
    }

    .margin-bottom-25 {
        margin-bottom: 25px;
    }

    .inline-span {
        display: inline;
    }

    .statistic-block strong {
        font-size: 1.4rem;
    }
</style>