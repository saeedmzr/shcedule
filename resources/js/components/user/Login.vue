<template>
  <div>
    <section class="sign-in">
      <div class="container">
        <div class="signin-content">
          <div class="signin-image">
            <figure>
              <img src="/images/schedule2.png" alt="sing in image" />
            </figure>
            <router-link to="Register">Create an account</router-link>
          </div>

          <div class="signin-form">
            <h2 class="form-title">Sign in</h2>
            <form @submit.prevent="login" class="register-form" id="login-form">
              <div class="form-group">
                <label for="your_name"
                  ><i class="zmdi zmdi-account material-icons-name"></i
                ></label>
                <input
                  type="text"
                  v-model="email"
                  name="your_name"
                  id="your_name"
                  placeholder="Your Email"
                />
              </div>
              <div class="form-group">
                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                <input
                  type="password"
                  v-model="password"
                  name="your_pass"
                  id="your_pass"
                  placeholder="Your Password"
                />
              </div>

              <div class="form-group form-button">
                <input
                  type="submit"
                  name="signin"
                  id="signin"
                  class="form-submit"
                  value="Log in"
                />
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import Http from "../../Services/Http/HttpService.js";
import notify from "../../Services/Notification/Notify.js";

export default {
  name: "Dashboard",

  data() {
    return {
      email: "",
      password: "",
    };
  },

  methods: {
    login() {
      Http.post("/api/login", {
        email: this.email,
        password: this.password,
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
            // this.token = response.data.access_token;

            console.log(response.data.access_token);
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
