<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="teamImageContainer" class="d-flex justify-content-center align-items-center">
                        <slot></slot>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm-12">
                    <b-card>
                        <div class="card-title mb-3">
                            <h1 class="text-center">{{teamName}}</h1>
                        </div>
                        <div class="card-body">
                            <div v-show="boardOfDirectors">

                                <div  class="mt-4 d-flex flex-wrap justify-content-between align-items-center">
                                    <div class=" flex-column align-items-center justify-content-center playerCard">
                                        <div class="mb-2 d-flex justify-content-center">
                                            <img alt="ca" class="img-fluid w-100 h-100" src="../../../public/images/teams/first_team/silvio.jpg" />
                                        </div>
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="playerName">Silvio Fernandes</div>
                                            <div class="playerNumber mb-2">President</div>
                                            <div><a href="/contact-us" class="btn btn-primary btn-block">Contact Me</a></div>
                                        </div>
                                    </div>

                                    <div class=" flex-column align-items-center justify-content-center playerCard">
                                        <div class="mb-2 d-flex justify-content-center">
                                            <img alt="ca" class="img-fluid w-100 h-100" src="https://placeimg.com/150/200/any" />
                                        </div>
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="playerName">John</div>
                                            <div class="playerNumber">35</div>
                                        </div>
                                    </div>

                                    <div class=" flex-column align-items-center justify-content-center playerCard">
                                        <div class="mb-2 d-flex justify-content-center">
                                            <img alt="ca" class="img-fluid w-100 h-100" src="https://placeimg.com/150/200/any" />
                                        </div>
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="playerName">John</div>
                                            <div class="playerNumber">35</div>
                                        </div>
                                    </div>

                                    <div class=" flex-column align-items-center justify-content-center playerCard">
                                        <div class="mb-2 d-flex justify-content-center">
                                            <img alt="ca" class="img-fluid w-100 h-100" src="https://placeimg.com/150/200/any" />
                                        </div>
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="playerName">John</div>
                                            <div class="playerNumber">35</div>
                                        </div>
                                    </div>

                                    <div class=" flex-column align-items-center justify-content-center playerCard">
                                        <div class="mb-2 d-flex justify-content-center">
                                            <img alt="ca" class="img-fluid w-100 h-100" src="https://placeimg.com/150/200/any" />
                                        </div>
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="playerName">John</div>
                                            <div class="playerNumber">35</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-show="!boardOfDirectors">
                                <div id="team-tabs">
                                    <b-nav tabs>
                                        <b-nav-item v-for="(item, index) in playerPositionsTabsArray" :key="index" @click="playerPositionsTabs(index)" :active="item.selected">{{item.name}}</b-nav-item>
                                    </b-nav>
                                </div>
                                <div id="teamPlayersContainer">
                                    <div id="allPlayers">

                                        <div v-show="item.selected && item.name != 'All' || viewAllPositions && item.name != 'All'" v-for="(item, index)  in playerPositions" :key="index" :id="item.id">
                                            <b-nav tabs>
                                                <b-nav-item active>{{item.name}}</b-nav-item>
                                            </b-nav>
                                            <div :id="item.id+'Content'" class="mt-4 d-flex flex-wrap">

                                                <div v-show="player.playerPosition === item.id" v-for="(player, index)  in playersArray" :key="index" class="flex-column align-items-center justify-content-center playerCard mb-4">
                                                    <div class="mb-2 d-flex justify-content-center">
                                                        <img v-for="x in player.image" class="img-fluid w-75 h-100" :src="'../storage' + '/' + x.order_column + '/' + x.file_name" />
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center">
                                                        <div class="playerName">{{player.name}}</div>
                                                        <div class="playerNumber">{{player.playerNumber}}</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </b-card>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "team",
        props:{
            teamName:String,
            boardOfDirectors:Boolean,
            playersArray:Array
        },
        data(){
            return {
                playerPositionsTabsArray:[
                    {name:'All', selected:true},
                    {name:'Goal Keepers', selected:false, id:"goalkeeper"},
                    {name:'Defenders', selected:false, id:"defender"},
                    {name:'Midfielders' ,selected:false, id:"midfielder"},
                    {name:'Attackers', selected:false, id:"attacker"}

                ],
               playerPositions:[
                   {name:'All', selected:true, id:"all"},
                   {name:'Goal Keepers', selected:false, id:"goalkeeper"},
                   {name:'Defenders', selected:false, id:"defender"},
                   {name:'Midfielders' ,selected:false, id:"midfielder"},
                   {name:'Attackers', selected:false, id:"attacker"}
               ],
                viewAllPositions:true
            }
        },
        methods:{
            playerPositionsFilter(position2){
                if (position2 != 0){
                    this.viewAllPositions = false;
                }
                this.playerPositions.forEach(function(item){
                    if (position2 === 0){
                        item.selected = true;
                    } else {
                        item.selected = false;
                    }
                });
                this.playerPositions[position2].selected = true;
            },
            playerPositionsTabs(position){
                this.playerPositionsTabsArray.forEach(function(item){
                    item.selected = false;
                });
                this.playerPositionsTabsArray[position].selected = true;
                this.playerPositionsFilter(position);
            },
        }
    }
</script>

<style scoped>

</style>