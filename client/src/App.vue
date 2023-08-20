<template>
  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <span class="fs-4">Upload500</span>
      </a>

      <ul class="nav nav-pills" v-if="isLoggedIn">
        <li class="nav-item"><a href="#" class="nav-link" @click="handleLogout">Logout</a></li>
      </ul>
      <ul class="nav nav-pills" v-else>
        <li class="nav-item"><router-link to="/login" class="nav-link" :class="{active: $route.name === 'login'}">Login</router-link></li>
        <li class="nav-item"><router-link to="/signup" class="nav-link" :class="{active: $route.name === 'signup'}">Signup</router-link></li>
      </ul>

    </header>

    <router-view  style="margin-top: 200px;"/>

  </div>

</template>

<script>
  import {mapGetters, mapActions} from 'vuex';

  export default {
    computed:{
      ...mapGetters([
          'isLoggedIn'
      ])
    },

    methods: {
      ...mapActions([
        'logout'
      ]),

      handleLogout() {
        this.logout().then(() => this.$router.push('/login')).catch(() => {});
      },
    }
  }
</script>

<style>
#nav{
  background: whitesmoke;
}

#nav {
  padding: 30px;
  text-align: center;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: whitesmoke;
  background: crimson;
  border-radius: .5rem;
}
</style>
