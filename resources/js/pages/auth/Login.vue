<script setup>
import axios from "axios";
import { reactive, ref } from "vue";
axios.defaults.baseURL = 'https://inventory_managment_app.test';
const form = reactive({
  email: "",
  password: "",
});
const errors = ref(null);
const loading = ref(false);
const handleLogin = () => {
  loading.value = true;
  errors.value = null;
  axios
    .post("/login", form)
    .then(() => {
      window.location.href = '/admin/dashboard';
    })
    .catch(err => {
        if(err.response.status == 422) {
            errors.value = err.response.data.errors;
            console.log(errors.value.email[0]);
        }
    })
    .finally(() => {
      loading.value = false;
    });
};

</script>
<template>
  <div class="account-content">
    <div class="login-wrapper">
      <div class="login-content">
        <div class="login-userset">
          <div class="login-logo">
            <img src="/img/logo.png" alt="img" />
          </div>
          <div class="login-userheading">
            <h3>Sign In</h3>
            <h4>Please login to your account</h4>
          </div>
          <div class="form-login">
            <label>Email</label>
            <div class="form-addons">
              <input
                type="email"
                v-model="form.email"
                placeholder="Enter your email address"
              />
              <img src="/img/icons/mail.svg" alt="img" />
            </div>
            <span class="text-danger">{{ errors && errors.email ? errors.email[0] : '' }}</span>
          </div>
          <div class="form-login">
            <label>Password</label>
            <div class="pass-group">
              <input
                v-model="form.password"
                type="password"
                class="pass-input"
                placeholder="Enter your password"
              />
              <span class="fas toggle-password fa-eye-slash"></span>
            </div>
            <span class="text-danger">{{ errors && errors.password ? errors.password[0] : ''}}</span>
          </div>
          <div class="form-login">
            <div class="alreadyuser">
              <h4>
                <a href="forgetpassword.html" class="hover-a"
                  >Forgot Password?</a
                >
              </h4>
            </div>
          </div>
          <div class="form-login">
            <button
              type="submit"
              @click.prevent="handleLogin()"
              class="btn btn-login"
            >
              <div v-if="loading" class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <span v-else>Sign In</span>
            </button>
          </div>
        </div>
      </div>
      <div class="login-img">
        <img src="/img/login.jpg" alt="img" />
      </div>
    </div>
  </div>
</template>