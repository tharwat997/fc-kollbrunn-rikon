<template>
    <vue-horizontal-timeline title-img-src="" :items="items"/>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "home-timeline",
        data: () => ({
            items: []
        }),
        methods:{
          getEvents(){
              axios.get('events-ajax').then( (response) => {
                  this.items = response.data;
              });
          }
        },
        created() {
            this.getEvents();
        }
    }
</script>

<style scoped>

</style>