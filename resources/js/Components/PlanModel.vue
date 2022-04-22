<template>
  <div>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Create plan
    </button>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-green-700" id="exampleModalLabel">Create plan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                <label for="description">description</label>
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
                <label for="data-picker">calendar</label>

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
import {Head} from "@inertiajs/inertia-vue3";
import {Inertia} from '@inertiajs/inertia'
import {reactive} from 'vue'
import DatePicker, {CalendarDialog} from 'vue-time-date-range-picker/dist/vdprDatePicker'
import 'vue-time-date-range-picker/dist/vdprDatePicker.min.css'
import {initializeApp} from "firebase/app";
import {getMessaging, onMessage, getToken} from "firebase/messaging";


const firebaseConfig = {
  apiKey: "xxxxxxxxxxxxxxxx",
  authDomain: "xxxxxxxxxxxxxxxx",
  databaseURL: "xxxxxxxxxxxxxxxx",
  projectId: "xxxxxxxxxxxxxxxx",
  storageBucket: "xxxxxxxxxxxxxxxx",
  messagingSenderId: "xxxxxxxxxxxxxxxx",
  appId: "xxxxxxxxxxxxxxxx",
  measurementId: "xxxxxxxxxxxxxxxx"
};
const firebase = initializeApp(firebaseConfig);


const messaging = getMessaging(firebase);
onMessage(messaging, (payload) => {
  console.log('Message received. ', payload);
  navigator.serviceWorker.getRegistration('/xxxxxxxxxxxxxxxx').then(registration => {
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

  setup() {
    const form = reactive({
      title: null,
      calendar: null,
      description: null,
      token: null,

    })

    return {form}
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
      dates: [Date.now(), Date.now()],

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
  computed: {},
  methods: {
    submit() {
      getToken(messaging, { vapidKey: 'xxxxxxxxxxxxxxxx' }).then((currentToken) => {
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
    selectDate(date1, date2) {
      let arr = []

      arr.push(date1, date2);
      this.form.calendar = arr;
    },


  },
};
</script>
