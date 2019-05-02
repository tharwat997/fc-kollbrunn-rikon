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
            matches:Array,
            match:Number
        },
        data() {
            return {
                time: 0,
                matchNumber: null,
                isRunning: false,
                interval: null,
                filteredMatches: null,
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
                this.matches.forEach( (item) => {
                    if(item.id === this.matchNumber){
                        this.time = item.start_date_time;
                    }
                })
            }
        }
    }
</script>
<style lang='scss'>

</style>
