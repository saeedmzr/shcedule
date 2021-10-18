<template>
  <div>
    <section class="signup">
      <div class="container">
        <div class="signup-content">
          <div class="signup-form">
            <h2 class="form-title">Sign up</h2>
            <form
              @submit.prevent="register"
              class="register-form"
              id="register-form"
            >
              <div class="form-group">
                <label for="name"
                  ><i class="zmdi zmdi-account material-icons-name"></i
                ></label>
                <input
                  type="text"
                  v-model="name"
                  name="name"
                  id="name"
                  placeholder="Your Name"
                />
              </div>
              <div class="form-group">
                <label for="email"><i class="zmdi zmdi-email"></i></label>
                <input
                  v-model="email"
                  type="text"
                  name="email"
                  id="email"
                  placeholder="Your Email"
                />
              </div>
              <div class="form-group">
                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                <input
                  v-model="password"
                  type="password"
                  name="pass"
                  id="pass"
                  placeholder="Password"
                />
              </div>
              <div class="form-group">
                <label for="re-pass"
                  ><i class="zmdi zmdi-lock-outline"></i
                ></label>
                <input
                  v-model="password_confirmation"
                  type="password"
                  name="re_pass"
                  id="re_pass"
                  placeholder="Repeat your password"
                />
              </div>
              <div class="form-group form-button">
                <input
                  type="submit"
                  name="signup"
                  id="signup"
                  class="form-submit"
                  value="Register"
                />
              </div>
            </form>
          </div>
          <div class="signup-image">
            <figure>
              <img src="/images/schedule1.png" alt="sing up image" />
            </figure>
            <router-link to="Login">I am already member</router-link>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import Http from "../../Services/Http/HttpService.js";
import notify from "../../Services/Notification/Notify.js";
import errors from "../../Services/ValidationErrors/Errors.js";

export default {
  name: "Dashboard",

  data() {
    return {
      email: "",
      name: "",
      password: "",
      password_confirmation: "",
    };
  },
  methods: {
    register() {
      Http.post("/api/register", {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation,
      })
        .then((response) => {
          if (response.data.result == false)
            notify.error(response.data.message);
          else {
            notify.success(response.data.message);
            window.localStorage.setItem(
              "access_token",
              response.data.access_token
            );
            // this.$router.push("Schedule");
            window.location.href = "/schedule/Schedule";
          }
        })
        .catch((error) => {
          for (var i in error.response.data.errors)
            notify.error(error.response.data.errors[i] + "\n");
        });
    },
  },
  created() {},
};
</script>
<style></style>
