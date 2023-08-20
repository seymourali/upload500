<template>
  <form class="needs-validation">

    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input v-model="form.email"
             :class="[errors.email ? 'is-invalid' : '']"
             type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      <div class="invalid-feedback" v-if="errors.email">
        <p v-for="(e, i) in errors.email" :key="i">
          {{ e }}
        </p>
      </div>
    </div>

    <div class="form-group mt-3">
      <label for="exampleInputPassword1">Password</label>
      <div class="input-group has-validation">
        <input v-model="form.password"
               :class="[errors.password ? 'is-invalid' : '']"
               type="password"
               class="form-control"
               id="exampleInputPassword1"
               placeholder="Password">
        <div class="invalid-feedback" v-if="errors.password">
          <p v-for="(e, i) in errors.password" :key="i">
            {{ e }}
          </p>
        </div>
      </div>
    </div>

    <div class="form-group mt-3 mb-3">
      <label for="exampleInputPassword2">Password confirmation</label>
      <input v-model="form.password_confirmation" type="password" class="form-control" id="exampleInputPassword2" placeholder="Password confirmation">
    </div>

    <button class="btn btn-primary" type="button" disabled="" v-if="loading">
      <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status"> Loading...</span>
    </button>
    <button type="submit"
            class="btn btn-primary"
            v-else
            @click="submitLocal">Submit
    </button>
  </form>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  name: "SignupView",
  data() {
    return {
      form: {
        email: '',
        password: '',
        password_confirmation: ''
      },
      loading: false,
      errors: {}
    }
  },
  methods: {
    ...mapActions([
      'register'
    ]),

    submitLocal() {
      if (!this.form.email || !this.form.password) return;
      this.loading = true;

      this.register(this.form)
      .then((resp) => {
        this.$toast.success(resp.data.message, {
          position: 'top'
        });
        setTimeout(() => {
          this.$router.push('/login')
        }, 1000);
      })
      .catch((e) => {
        console.log(e)
        this.errors = e.response.data.errors
        console.log(this.errors);
      })
      .finally(() => this.loading = false);
    }
  }
}
</script>

<style scoped>

</style>
