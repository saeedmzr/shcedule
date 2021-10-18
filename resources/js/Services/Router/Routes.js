import User from "../../components/user/User.vue";
import Login from "../../components/user/Login.vue";
import Register from "../../components/user/Register.vue";

import Schedule from "../../components/Schedule.vue";

const allUrl = [
    { path: "*", redirect: "/" },
    {
        path: "/",
        component: User,
        redirect: "Login",
        children: [{
                path: "Login",
                name: "Login",
                component: Login
            },
            {
                path: "Register",
                name: "Register",
                component: Register
            },
            {
                path: "Schedule",
                component: Schedule,
                name: "Schedule"
            }
        ]
    }
];

export default allUrl;