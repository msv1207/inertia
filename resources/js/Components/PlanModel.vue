<template>
    <div >
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Create plan
        </button>


        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-green-700" id="exampleModalLabel">Create plan</h5>
                        <button  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="title">title</label>

                        <form @submit.prevent="submit()">
                            <div>
                                <input
                                    v-model="form.title"
                                    type="text"
                                    id="title"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                />
                            </div>
                            <div>
                                <label  for="description">description</label>
                                <textarea
                                    v-model="form.description"
                                    type="text"
                                    id="description"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                />
                            </div>
                            <div id="app">
                                <label  for="data-picker">calendar</label>

                                <date-picker
                                    language="fr"
                                    :initialDates="dates"
                                    :dateInput="dateInput"
                                    :show-helper-buttons="true"
                                    :switch-button-initial="true"
                                    :is-monday-first="true"
                                    @date-applied="selectDate"
                                />
                            </div>

                            <div class="flex items-center mt-4">
                                <button
                                    class="
                                        px-6
                                        py-2
                                        text-white
                                        bg-gray-900
                                        rounded
                                    "
                                >
                                    Send
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import { Head } from "@inertiajs/inertia-vue3";
    import { Inertia } from '@inertiajs/inertia'
    import { reactive } from 'vue'
    import DatePicker, { CalendarDialog } from 'vue-time-date-range-picker/dist/vdprDatePicker'
    import 'vue-time-date-range-picker/dist/vdprDatePicker.min.css'
    import { initializeApp } from "firebase/app";
    import { getMessaging , onMessage, getToken} from "firebase/messaging";



    const firebaseConfig = {
    // apiKey: process.env.VUE_APP_API_KEY,
    // authDomain: process.env.VUE_APP_AUTH_DOMAIN,
    // projectId: process.env.VUE_APP_PROJECT_ID,
    // storageBucket: process.env.VUE_APP_STORAGE_BUCKET,
    // messagingSenderId: process.env.VUE_APP_MESENGER_SENDING_ID,
    // appid: process.env.VUE_APP_APP_ID,
    // measurementId: process.env.VUE_APP_MEASUREMENT_ID,
    apiKey: "AIzaSyA2t8wf8-wUmlSF7acgDpoeupB71nuhJfU",
    authDomain: "laravel-6ac8c.firebaseapp.com",
    databaseURL: "https://laravel-6ac8c-default-rtdb.europe-west1.firebasedatabase.app",
    projectId: "laravel-6ac8c",
    storageBucket: "laravel-6ac8c.appspot.com",
    messagingSenderId: "814380693226",
    appId: "1:814380693226:web:f8130643ace114df98c993",
    measurementId: "G-VDQDMEEYJ2"
};
    let firebase = initializeApp(firebaseConfig);


    let messaging = getMessaging(firebase);
    onMessage(messaging, (payload) => {
    console.log('Message received. ', payload);
    navigator.serviceWorker.getRegistration('/firebase-cloud-messaging-push-scope').then(registration => {
    registration.showNotification(
    payload.notification.title,
    payload.notification
    )
});

});


    class Event {
    constructor(name, value) {
    this.name = name;
    this.value = value;
    this.time = new Date();
};
}

    export default {

    setup () {
    const form = reactive({
    title: null,
    calendar:null,
    description:null,
    token: null,

})

    return { form }
},
    name: "app",
    components: {
    BreezeAuthenticatedLayout,
    Head,
    DatePicker,
    CalendarDialog
},
    props: {
    dateInput: {
    placeholder: 'Select Date'
},
},

    data() {

    return {
        dates: [ Date.now(),  Date.now()],

        events: [],

}


},
    watch: {
    root: {

        deep: true,
    handler: (newRoot) => {
    console.log(newRoot);
},
},
},
    computed:{
},
    methods: {
    submit() {
    getToken(messaging, { vapidKey: 'BFlFYuVmWXfzrDWTZhY0_uRLUT4Hl8cK8DuRocE7ocIJn311UXJWZTI4zcLcQdamOD5DR8G1hEn8soVGqhby4_0' }).then((currentToken) => {
    if (currentToken) {

    this.form.token=currentToken;
    Inertia.post('/plans', this.form)

} else {
    console.log('No registration token available. Request permission to generate one.');
}
}).catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
});

},
    selectDate(date1, date2)
{
    let arr=[]

    arr.push(date1, date2);
    this.form.calendar=arr;
},




},
};
</script>
