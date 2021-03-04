<template>
  <v-container fill-height>
    <v-row align="center" justify="center">
      <v-col xs="12" sm="6" md="4">
        <v-card class="elevation-12">
          <v-toolbar>
            <v-toolbar-title>Login</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form
              lazy-validation
              ref="form"
              v-model="valid">
              <v-text-field
                prepend-icon="mdi-account"
                label="Username"
                type="text"
                v-model="username"
                required
                :rules="usernameRules"
              ></v-text-field>
              <v-text-field
                prepend-icon="mdi-lock"
                label="Password"
                type="password"
                v-model="password"
                :rules="passwordRules"
                required
              ></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="primary"
              @click="onSubmit"
              :loading="loading"
            >Login
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>

</template>

<script>
  import {mapGetters} from 'vuex'

  export default {
    data() {
      return {
        valid: false,
        username: '',
        usernameRules: [
          v => !!v || 'Username is required',
        ],
        password: '',
        passwordRules: [
          v => !!v || 'Password is required',
          v => (v && v.length >= 5) || 'Password must be qual or more than 5 characters',
        ]
      }
    },
    computed: {
      ...mapGetters({
        loading: 'shared/getLoading'
      })
    },
    methods: {
      onSubmit() {
        if (this.$refs.form.validate()) {
          const user = {
            username: this.username,
            password: this.password,
          }

          let redirectUrl = "/";

          this.$store.dispatch('user/loginUser', user)
          .then(() => {
            window.location.replace(redirectUrl)
          })
          .catch((err) => {})

        }
      }
    },
    created() {
      if (this.$route.query['loginError']) {
        this.$store.dispatch('setError', 'Please log in to access this page!')
      }
    }
  }
</script>

<style scoped>

</style>
