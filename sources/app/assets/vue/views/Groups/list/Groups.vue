<template>
    <div>
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Group</h2>
            </div>
        </div>
        <div>
            <button type="button" @click="create()">Create</button>
        </div>


    </div>
</template>

<script>
  import apiGroups from "../../../api/group";

  export default {
    name: "Groups",
    methods: {
      async create() {
        console.log('vue_create')
        const groups = await apiGroups.createGroups();
        console.log('okok',groups)
      },
    }
  }
</script>

<style scoped>

</style>