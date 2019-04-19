<template>
    <div class="container-fluid p-0">
        <div class="d-flex">
            <div style="flex: 60%;" id="mapSection">
                <GmapMap
                        :center="{lat:47.4425583, lng:8.789536}"
                        :zoom="17"
                        style="width: 100%; height: 100%"
                >
                </GmapMap>
            </div>
            <div style="flex: 40%;" id="formSection">
                <div class="d-flex flex-column">
                    <h2 class="text-center">Contact Us</h2>
                    <b-form @submit="onSubmit">
                        <b-form-group
                                id="input-fullName-group"
                                label="Full Name"
                                label-for="input-fullName"
                        >
                            <b-form-input
                                    id="input-fullName"
                                    v-model="form.name"
                                    type="text"
                                    name="fullName"
                                    required
                                    placeholder="Enter your full name"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group
                                id="input-Email-group"
                                label="Email"
                                label-for="input-Email"
                        >
                            <b-form-input
                                    id="input-Email"
                                    v-model="form.email"
                                    type="email"
                                    name="email"
                                    required
                                    placeholder="Enter your email"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group
                                id="input-mobileNumber-group"
                                label="Mobile Number"
                                label-for="input-mobileNumber"
                        >
                            <b-form-input
                                    id="input-mobileNumber"
                                    v-model="form.mobileNumber"
                                    type="number"
                                    required
                                    name="mobileNumber"
                                    placeholder="Enter your mobile number"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group
                                id="input-purposeOfContact-group"
                                label="Purpose of contact"
                                label-for="input-purposeOfContact"
                        >
                            <select name="purposeOfContact"  v-model="form.purposeOfContact" class="form-control" id="input-purposeOfContact">
                                <option :value="purpose.value" v-for="purpose in purposeOfContact">{{purpose.text}}</option>
                            </select>
                        </b-form-group>

                        <b-form-group v-if="form.purposeOfContact === 2"
                                id="input-selectTeam-group"
                                label="Select team"
                                label-for="input-selectTeam"
                        >
                            <select name="selectTeam" v-model="form.teamSelected" class="form-control" id="input-selectTeam">
                                <option :value="team.value"  v-for="team in teamsOptions">{{team.text}}</option>
                            </select>
                        </b-form-group>

                        <b-form-group  v-if="form.purposeOfContact === 3"
                                       id="input-joinEventName-group"
                                       label="Event name"
                                       label-for="input-joinEventName"
                        >
                            <select name="joinEvent" v-model="form.eventSelected" class="form-control" id="input-joinEventName">
                                <option :value="event.value" v-for="event in eventOptions">{{event.text}}</option>
                            </select>
                        </b-form-group>

                        <b-form-group  v-if="form.purposeOfContact === 3"
                                id="input-joinEvent-group"
                                label="Reason of joining"
                                label-for="input-joinEvent"
                        >
                            <select name="joinEvent" v-model="form.joinEventSelection" class="form-control" id="input-joinEvent">
                                <option :value="join.value" v-for="join in joinEventOptions">{{join.text}}</option>
                            </select>
                        </b-form-group>

                        <b-form-group
                                id="input-message-Group"
                                label="Message"
                                label-for="input-message"
                        >
                            <b-form-textarea
                                    id="input-message"
                                    placeholder="Enter something..."
                                    rows="3"
                                    name="message"
                                    max-rows="6"
                                    v-model="form.message"
                            ></b-form-textarea>
                        </b-form-group>


                        <b-button type="submit" variant="primary">Submit</b-button>
                    </b-form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "contact",
        data() {
            return {
                form: {
                    email: '',
                    name: '',
                    mobileNumber: '',
                    purposeOfContact: 1,
                    teamSelected: 1,
                    joinEventSelection: 1,
                    eventSelected:1,
                    message: ''
                },
                purposeOfContact: [
                    {value:1, text: 'Got a question?'},
                    {value:2, text: 'Join our teams'},
                    {value:3, text: 'Join an event'}
                ],
                teamsOptions: [
                    {value:1, text: 'First team'},
                    {value:2, text: 'Junior C'},
                    {value:3, text:'Junior D'},
                    {value:4, text:'Junior E'},
                    {value:5, text:'Junior F'}
                ],
                eventOptions: [
                    {value:1, text: 'Event 1'},
                    {value:2, text: 'Event 2'},
                    {value:3, text: 'Event 3'},
                    {value:4, text: 'Event 4'},
                    {value:5, text: 'Event 5'},
                ],
                joinEventOptions: [
                    {value:1 , text:'Participant'},
                    {value:2 , text:'Volunteer'}

                ]
            }
        },
        methods: {
            onSubmit(evt) {
                evt.preventDefault();
                alert(JSON.stringify(this.form))
            }
        }
    }
</script>
<style>

</style>