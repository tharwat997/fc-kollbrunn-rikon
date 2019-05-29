<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <b-card>
                    <div class="row">
                        <div class="col-sm-12">
                            <h1>Agenda</h1>
                        </div>

                    </div>
                    <div class="card-body">
                        <FullCalendar :defaultView="calendarView"
                                      :plugins="calendarPlugins"
                                      :events="events"
                                      defaultView="dayGridMonth"
                                      :header="{
                                      left: 'prev,next today',
                                      center: 'title',
                                      right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                                      }"
                        />
                    </div>
                </b-card>

            </div>
        </div>
    </div>

</template>
<script>
    import axios from 'axios'
    import FullCalendar from '@fullcalendar/vue'
    import timeGridPlugin from '@fullcalendar/timegrid'
    import dayGridPlugin from '@fullcalendar/daygrid'
    export default {
        name: "agenda",
        components: {
            FullCalendar // make the <FullCalendar> tag available
        },
        data() {
            return {
                calendarView:'dayGridMonth',
                calendarPlugins: [ timeGridPlugin, dayGridPlugin ],
                timeZone: 'Europe/Zurich',
                locale: 'de',
                unFormattedEvents:[],
                events:[

                ]
            }
        },
        methods:{
            fetchResources(){
                axios.get('agenda-events-ajax').then( (response) => {
                    this.unFormattedEvents = response.data;
                    this.unFormattedEvents.forEach((event) =>{
                        event.start_date = new Date(Date.parse(event.start_date.replace('-','/','g')));
                        event.end_date = new Date(Date.parse(event.end_date.replace('-','/','g')));
                        event.start_date = event.start_date.toISOString().slice(0,19);
                        event.end_date = event.end_date.toISOString().slice(0,19);
                        let eventObject = {
                          title: event.title,
                          start: event.start_date,
                          end: event.end_date
                        };
                        this.events.push(eventObject);
                    })
                })

            },
            switchViews(view){
                if (view === "week"){
                    this.calendarView = "timeGridWeek";

                } else if(view === "month"){
                    this.calendarView = "dayGridMonth";
                }
            }
        },
        created() {
            this.fetchResources();
        }
    }
</script>
<style lang='scss'>
    @import '~@fullcalendar/core/main.css';
    @import '~@fullcalendar/timegrid/main.css';
    .fc-content{
        .fc-title,
        .fc-time{
            color:#f8f8f8;
        }
    }
</style>
