<template>
    <div>
        <h2>
            Minute of match: {{time}}
        </h2>
    </div>
</template>
<script>

    export default {
        name: "count",
        props:{
            matches:Array
        },
        data() {
            return {
                time: 0,
                isRunning: false,
                interval: null
            }
        },
        mounted(){
          this.toggleTimer();
        },
        methods: {
            toggleTimer() {
                if (this.isRunning) {
                    clearInterval(this.interval);
                    console.log('timer stops');
                } else {
                    this.interval = setInterval(this.incrementTime, 60000);
                }

            },
            incrementTime() {
                this.time = parseInt(this.time) + 1;
            },
        }
    }
</script>
<style lang='scss'>

</style>
