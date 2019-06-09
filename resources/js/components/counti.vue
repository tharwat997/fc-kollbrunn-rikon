<template>
    <div>
        <h2>
            {{time}}
        </h2>
    </div>
</template>
<script>

    export default {
        name: "counti",
        props:{
            match:Array
        },
        data() {
            return {
                time: 0,
                matchNumber: null,
                isRunning: false,
                interval: null
            }
        },
        mounted(){
            this.matchNumber = this.match;
            this.toggleTimer();
            this.filterMatches();
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
            filterMatches(){
                this.time = this.match.start_date_time2;
            }
        }
    }
</script>
<style lang='scss'>

</style>
