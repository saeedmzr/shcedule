<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <Datepicker format="dd MMM yyyy" v-model="date"></Datepicker>
            </div>
            <div class="col-md-1">
                <button @click.prevent="changeDate">Change</button>
            </div>
            <div class="col-md-1">
                <button @click.prevent="logout">Logout</button>
            </div>
            <div class="col-md-5">
                <simple-modal hasFooter v-model="isShow" title="Modal Header">
                    <template slot="body">
                        <h2>Enter title and description</h2>
                        <input v-model="title" placeholder="Enter title"/>
                        <input v-model="description" placeholder="Enter description"/>
                    </template>
                    <template slot="footer">
                        <button @click.prevent="submitTask">Submit</button>
                    </template>
                </simple-modal>
            </div>
            <br/>
        </div>
        <br/>
        <div class="timetable">
            <div class="week-names">
                <div v-for="day in weekdays" :key="day.index">
                    <span>{{ day.date }}</span> ( <span>{{ day.name }}</span> )
                </div>
            </div>
            <div class="time-interval">
                <div v-for="employee in employees" :key="employee.index">
                    {{ employee.name }}
                </div>
            </div>
            <div class="content">
                <div v-for="task in tasks">
                    <div
                        v-if="task.empty"
                        class="accent-orange-gradient"
                        @click="[(isShow = !isShow), selectDate(task.date)]"
                    ></div>
                    <div v-else class="accent-green-gradient">
                        <b>{{ task.title }} </b> :
                        <span style="font-size: 14px"> {{ task.description }} </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Http from "../Services/Http/HttpService.js";
import notify from "../Services/Notification/Notify.js";
import Datepicker from "vuejs-datepicker";
import SimpleModal from "simple-modal-vue";

export default {
    name: "Schedule",

    data() {
        return {
            user: {},
            date : new Date(),
            weekdays: {},
            tasks: {},
            employees: {},
            isShow: false,
            title: "",
            description: "",
            chosenDate: {},
        };
    },
    components: {
        Datepicker,
        SimpleModal,
    },

    methods: {
        beforeDestroy() {
            localStorage.removeItem("access_token");
        },
        logout() {
            window.localStorage.removeItem("access_token");
            notify.success("You have loged out successfully.");
            this.$router.push("Login");
        },
        selectDate(arg) {
            this.chosenDate = arg;
        },
        submitTask() {
            Http.user_post("/api/submitTask", {
                title: this.title,
                reserved_at: this.chosenDate,
                description: this.description,
                password: this.password,
            })
                .then((response) => {
                    if (response.data.result == false)
                        notify.error(response.data.message);
                    else {
                        notify.success(response.data.message);
                        this.isShow = !this.isShow;
                        this.changeDate() ;
                    }
                })
                .catch((error) => {
                    for (var i in error.response.data.errors)
                        notify.error(error.response.data.errors[i] + "\n");
                });
        },
        getEmployees() {
            Http.user_post("/api/getEmployees").then((response) => {
                this.employees = response.data.data;
            });
        },
        getUser() {
            Http.user_post("/api/user")
                .then((response) => {
                    this.User = response.data;
                })
                .catch((e) => {
                    notify.error("You should login again");
                    this.$router.push("Login");
                });
        },
        changeDate() {
            Http.user_post("/api/changeDate", {
                date: this.date,
            }).then((response) => {
                this.weekdays = response.data.weekdays;
                this.tasks = response.data.tasks;
            });
        },
    },
    created() {
        this.getUser();
        this.getEmployees();
        this.changeDate();
    },
};
</script>
<style></style>
