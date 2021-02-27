<template>
  <v-app>
    <nav-bars></nav-bars>

    <transition name="fade">
      <v-main>

        <router-view></router-view>

      </v-main>
    </transition>
    <v-overlay :value="loading">

    </v-overlay>
    <snackbar/>
  </v-app>
</template>

<script>
  import NavBars from "./NavBars"
  import Snackbar from "./Snackbar"
  import {mapGetters} from 'vuex'

  export default {

    components: {
      NavBars,
      Snackbar
    },
    computed: {
      ...mapGetters({
        loading: 'shared/getLoading'
      })
    }
  }
</script>
