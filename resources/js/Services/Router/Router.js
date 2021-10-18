import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import routes from "./Routes.js";

const router = new VueRouter({
    base: "/schedule/",
    mode: "history",
    routes
});

export default router;