<template>
    <div class="container-fluid p-0">
        <div class="d-flex flex-column-reverse">
            <div id="mapSection" style="height:85vh;">
                <GmapMap
                    :center="{lat:47.4425583, lng:8.789536}"
                    :zoom="17"
                    style="width: 100%; height: 100%"
                >
                </GmapMap>
            </div>
            <div id="formSection">
                <div class="d-flex flex-column">
                    <h2 class="text-center">Contact Us</h2>
                    <b-form @submit="onSubmit">
                        <b-form-group
                            id="input-fullName-group"
                            label="Vornamem, Name"
                            label-for="input-fullName"
                        >
                            <b-form-input
                                id="input-fullName"
                                v-model="form.name"
                                type="text"
                                name="fullName"
                                required
                                placeholder="Vorname, Name editiern"
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
                                placeholder="Email editieren"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-fax-group"
                            label="fax"
                            label-for="input-fax"
                            v-show="false"
                        >
                            <b-form-input
                                id="input-fax"
                                v-model="form.fax"
                                type="text"
                                name="fax"
                                placeholder="Enter your email"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-mobileNumber-group"
                            label="Mobile Nummer"
                            label-for="input-mobileNumber"
                        >
                            <b-form-input
                                id="input-mobileNumber"
                                v-model="form.mobileNumber"
                                type="number"
                                required
                                name="mobileNumber"
                                placeholder="Mobile Nummer editieren"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-purposeOfContact-group"
                            label="Grund für Kontaktaufnahme"
                            label-for="input-purposeOfContact"
                        >
                            <select name="purposeOfContact" v-model="form.purposeOfContact" class="form-control"
                                    id="input-purposeOfContact">
                                <option :value="purpose.value" v-for="purpose in purposeOfContact">{{purpose.text}}
                                </option>
                            </select>
                        </b-form-group>

                        <b-form-group v-if="form.purposeOfContact === 3"
                                      id="input-selectTeam-group"
                                      label="Wähle Team aus"
                                      label-for="input-selectTeam"
                        >
                            <select name="selectTeam" v-model="form.teamSelected" class="form-control"
                                    id="input-selectTeam">
                                <option :value="team.value" v-for="team in teamsOptions">{{team.text}}</option>
                            </select>
                        </b-form-group>

                        <b-form-group v-if="form.purposeOfContact === 4"
                                      id="input-joinEventName-group"
                                      label="Wähle Veranstaltung"
                                      label-for="input-joinEventName"
                        >
                            <select name="joinEvent" v-model="form.eventSelected" class="form-control"
                                    id="input-joinEventName">
                                <option :value="event.id" v-for="event in eventsOptions">{{event.title}}</option>
                            </select>
                        </b-form-group>

                        <b-form-group v-if="form.purposeOfContact === 4"
                                      id="input-joinEvent-group"
                                      label="Art der Teilnahme"
                                      label-for="input-joinEvent"
                        >
                            <select name="joinEvent" v-model="form.joinEventSelection" class="form-control"
                                    id="input-joinEvent">
                                <option :value="join.value" v-for="join in joinEventOptions">{{join.text}}</option>
                            </select>
                        </b-form-group>

                        <b-form-group
                            id="input-message-Group"
                            label="Nachricht"
                            label-for="input-message"
                        >
                            <b-form-textarea
                                id="input-message"
                                placeholder="Schreibe hier..."
                                rows="3"
                                name="message"
                                max-rows="6"
                                v-model="form.message"
                            ></b-form-textarea>
                        </b-form-group>

                        <!--<vue-recaptcha sitekey="6LcMFKAUAAAAACN1KArylMkZd-lIaZWuHlb5APVl">-->
                        <!--</vue-recaptcha>-->

                        <b-alert variant="success" v-show="success" show>Message sent Successfully</b-alert>
                        <b-button type="submit" variant="primary">Eingabe</b-button>
                    </b-form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'

    axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': window.csrf_token
    };
    export default {
        name: "contact",
        mounted() {
            this.getEvents();
        },
        data() {
            return {
                success: false,
                form: {
                    email: '',
                    name: '',
                    fax: '',
                    mobileNumber: '',
                    purposeOfContact: 1,
                    teamSelected: 1,
                    joinEventSelection: 1,
                    eventSelected: 1,
                    message: ''
                },
                purposeOfContact: [
                    {value: 1, text: 'Auswählen'},
                    {value: 2, text: 'Haben Sie eine Frage?'},
                    {value: 3, text: 'Beitritsanfrage'},
                    {value: 4, text: 'Teilnahme Veranstaltung'}
                ],
                teamsOptions: [
                    {value: 1, text: 'Aktive'},
                    {value: 2, text: 'C Junioren'},
                    {value: 3, text: 'D Junioren'},
                    {value: 4, text: 'E Junioren'},
                    {value: 5, text: 'F+G Junioren'}
                ],
                eventsOptions: [],
                joinEventOptions: [
                    {value: 1, text: 'Teilnehmer'},
                    {value: 2, text: 'Helfer'}

                ]
            }
        },
        methods: {
            onSubmit(evt) {
                evt.preventDefault();
                let data = JSON.stringify(this.form);
                axios.post('./message/submit', this.form).then(
                    this.success = true);
            },
            getEvents() {
                axios.get('contact-us/events').then((response) => {
                    this.eventsOptions = response.data;
                });
            }
        }
    }
</script>
<style>

</style>
