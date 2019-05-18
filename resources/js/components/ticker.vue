<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <b-card>
                    <div class="mb-4">
                        <h3 class="text-center">Spielfilter</h3>
                    </div>
                    <div id="matchesFilterContainer">
                        <div class="mb-2">
                            <a href="#" class="btn btn-primary btn-block" @click="filterMatches('all')"> Alle</a>
                        </div>
                        <div class="mb-2">
                            <a  href="#" class="btn btn-primary btn-block" @click="filterMatches('upcoming')"> Bevorstehende</a>
                        </div>
                        <div class="mb-2">
                            <a href="#" class="btn btn-primary btn-block" @click="filterMatches('current')">Laufende</a>
                        </div>
                        <div class="mb-2">
                            <a  href="#" class="btn btn-primary btn-block" @click="filterMatches('previous')">Vergangene</a>
                        </div>
                    </div>
                </b-card>
            </div>
            <div class="col-sm-8">
                <b-card>
                    <div class="mb-4">
                        <h3 class="text-center">Live Ticker</h3>
                    </div>
                    <div  v-if="all" class="overflow-auto">
                        <div class="tickerMatch" :key="index"  v-for="(match, index)  in matches.data">
                            <a :href="'./live-ticker/' + match.id ">
                                <div class="d-flex align-items-center justify-content-between tickerMatchTopContainer">
                                    <div class="tickerMatchType">
                                        {{match.match_type}}
                                    </div>
                                    <div class="tickerMatchDateTime">
                                        {{match.start_date_time}}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center tickerMatchBottomContainer">
                                    <div class="tickerMatchTeamAName">
                                        <h4>
                                            {{match.teamA_name}}
                                        </h4>
                                    </div>
                                    <div class="tickerMatchTeamAScore">
                                        <h4>
                                            {{match.teamA_score}}
                                        </h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="tickerMatchTeamBName">
                                        <h4>
                                            {{match.teamB_name}}
                                        </h4>
                                    </div>
                                    <div class="tickerMatchTeamBScore">
                                        <h4>
                                            {{match.teamB_score}}
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <pagination :data="matches" @pagination-change-page="getMatches"></pagination>
                    </div>
                    <div  v-if="previous" class="overflow-auto">
                        <div class="tickerMatch" :key="index"  v-for="(match, index)  in matchesPrevious.data">
                            <a :href="'./live-ticker/' + match.id ">
                                <div class="d-flex align-items-center justify-content-between tickerMatchTopContainer">
                                    <div class="tickerMatchType">
                                        {{match.match_type}}
                                    </div>
                                    <div class="tickerMatchDateTime">
                                        {{match.start_date_time}}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center tickerMatchBottomContainer">
                                    <div class="tickerMatchTeamAName">
                                        <h4>
                                            {{match.teamA_name}}
                                        </h4>
                                    </div>
                                    <div class="tickerMatchTeamAScore">
                                        <h4>
                                            {{match.teamA_score}}
                                        </h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="tickerMatchTeamBName">
                                        <h4>
                                            {{match.teamB_name}}
                                        </h4>
                                    </div>
                                    <div class="tickerMatchTeamBScore">
                                        <h4>
                                            {{match.teamB_score}}
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <pagination :data="matchesPrevious" @pagination-change-page="getMatchesPrevious"></pagination>
                    </div>
                    <div  v-if="current" class="overflow-auto">
                        <div class="tickerMatch" :key="index"  v-for="(match, index)  in matchesCurrent.data">
                            <a :href="'./live-ticker/' + match.id ">
                                <div class="d-flex align-items-center justify-content-between tickerMatchTopContainer">
                                    <div class="tickerMatchType">
                                        {{match.match_type}}
                                    </div>
                                    <div class="tickerMatchDateTime">
                                        {{match.start_date_time}}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center tickerMatchBottomContainer">
                                    <div class="tickerMatchTeamAName">
                                        <h4>
                                            {{match.teamA_name}}
                                        </h4>
                                    </div>
                                    <div class="tickerMatchTeamAScore">
                                        <h4>
                                            {{match.teamA_score}}
                                        </h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="tickerMatchTeamBName">
                                        <h4>
                                            {{match.teamB_name}}
                                        </h4>
                                    </div>
                                    <div class="tickerMatchTeamBScore">
                                        <h4>
                                            {{match.teamB_score}}
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <pagination :data="matchesCurrent" @pagination-change-page="getMatchesCurrent"></pagination>
                    </div>
                    <div  v-if="upComing" class="overflow-auto">
                        <div  class="tickerMatch"  :key="index" v-for="(match, index)  in matchesUpcoming.data">
                            <a :href="'./live-ticker/' + match.id ">
                                <div class="d-flex align-items-center justify-content-between tickerMatchTopContainer">
                                    <div class="tickerMatchType">
                                        {{match.match_type}}
                                    </div>
                                    <div class="tickerMatchDateTime">
                                        {{match.start_date_time}}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center tickerMatchBottomContainer">
                                    <div class="tickerMatchTeamAName">
                                        <h4>
                                            {{match.teamA_name}}
                                        </h4>
                                    </div>
                                    <div class="tickerMatchTeamAScore">
                                        <h4>
                                            {{match.teamA_score}}
                                        </h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="tickerMatchTeamBName">
                                        <h4>
                                            {{match.teamB_name}}
                                        </h4>
                                    </div>
                                    <div class="tickerMatchTeamBScore">
                                        <h4>
                                            {{match.teamB_score}}
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <pagination :data="matchesUpcoming" @pagination-change-page="getMatchesUpcoming"></pagination>
                    </div>
                </b-card>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: 'ticker',
        data(){
            return{
                matches:{},
                matchesUpcoming:{},
                matchesCurrent:{},
                matchesPrevious:{},
                all:true,
                previous:false,
                current:false,
                upComing:false,

            }
        },
        mounted(){
            this.getMatches();
            this.getMatchesPrevious();
            this.getMatchesCurrent();
            this.getMatchesUpcoming();
        },
        methods:{
            getMatches: function(page = 1){
                axios.get('/live-ticker/matches?page='+ page).then(response => {
                    this.matches = response.data.matches;
                })
                .catch(() => {
                    console.log('handle server error from here');
                });
            },
            getMatchesPrevious: function(page = 1){
                axios.get('/live-ticker/matches?page='+ page).then(response => {
                    this.matchesPrevious = response.data.previous;
                })
                    .catch(() => {
                        console.log('handle server error from here');
                    });
            },
            getMatchesCurrent: function(page = 1){
                axios.get('/live-ticker/matches?page='+ page).then(response => {
                    this.matchesCurrent = response.data.current;
                })
                    .catch(() => {
                        console.log('handle server error from here');
                    });
            },
            getMatchesUpcoming: function(page = 1){
                axios.get('/live-ticker/matches?page='+ page).then(response => {
                    this.matchesUpcoming = response.data.upcoming;
                })
                    .catch(() => {
                        console.log('handle server error from here');
                    });
            },
            filterMatches(filter){
                if (filter === 'all'){
                    this.all = true;
                    this.previous = false;
                    this.current = false;
                    this.upComing = false;
                } else if (filter === 'previous'){
                    this.all = false;
                    this.previous = true;
                    this.current = false;
                    this.upComing = false;
                }else if (filter === 'current'){
                    this.all = false;
                    this.previous = false;
                    this.current = true;
                    this.upComing = false;
                }else if (filter === 'upcoming'){
                    this.all = false;
                    this.previous = false;
                    this.current = false;
                    this.upComing = true;
                }
            }
        }
    }
</script>

<style scoped>

    #matchesFilterContainer .btn.btn-primary,
    #matchesFilterContainer .btn-primary:not(:disabled):not(.disabled):active:focus, .btn-primary:not(:disabled):not(.disabled).active:focus, .show > .btn-primary.dropdown-toggle:focus,
    #matchesFilterContainer .btn-primary:focus, .btn-primary.focus{
        box-shadow:none;
        background-color:#1F1B23;
        border:none;
    }
</style>