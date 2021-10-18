import Vue from "vue";
import router from "./Services/Router/Router";
import PusherVue from "pusher-vue";

import User from "./components/user/User.vue";
import Schedule from "./components/Schedule.vue";

Vue.component("user-component", User);
Vue.component("schedule-component", Schedule);

Vue.use(PusherVue, {
    appKey: "b6fd403f25745150148e",
    cluster: "ap2",
    debug: true,
    debugLevel: "all"
});

const app = new Vue({
    el: "#app",
    router
});

export default app;