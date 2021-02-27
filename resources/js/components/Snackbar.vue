<template>
  <v-snackbar
    v-model="alert.showing"
    :timeout="5000"
    :color="alert.status"
    top
    right
  >
      <span
        v-if="alert.errors"
      >
        <h3>{{ alert.message }}</h3>
        <span
          v-for="(err, prop) in alert.errors"
        >
          <br>{{ prop | capitalize }}: {{ err.toString() }}
        </span>
      </span>

    <span v-else-if="alert.message">
        <h3>{{ alert.message }}</h3>
      </span>

    <span v-else>
        <h3>{{ alert.toString() }}</h3>
      </span>

    <template v-slot:action="{ attrs }">
      <v-btn
        icon
        v-bind="attrs"
        @click="alert.showing = false"
      >
        <v-icon>mdi-close</v-icon>
      </v-btn>
    </template>
  </v-snackbar>


</template>

<script>
  import {mapGetters} from 'vuex'

  export default {
    computed: {
      ...mapGetters('shared', ['alert']),
    },
  }
</script>
