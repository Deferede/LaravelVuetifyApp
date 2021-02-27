<template>
  <v-container fill-height>
    <v-row align="center" justify="center">
      <v-col xs="12" sm="6" md="4">
        <v-card class="elevation-12">
          <v-toolbar>
            <v-toolbar-title>Registration</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form
              lazy-validation
              ref="form"
              v-model="valid">
              <v-text-field
                prepend-icon="mdi-account"
                name="name"
                label="Name"
                type="text"
                v-model="name"
                :rules="nameRules"
                required
              ></v-text-field>
              <v-text-field
                prepend-icon="mdi-account"
                name="email"
                label="E-mail"
                type="email"
                v-model="email"
                required
                :rules="emailRules"
              ></v-text-field>
              <v-text-field
                prepend-icon="mdi-lock"
                name="password"
                label="Password"
                type="password"
                v-model="password"
                :rules="passwordRules"
                required
              ></v-text-field>
              <v-text-field
                prepend-icon="mdi-lock"
                name="confirm-password"
                label="Confirm password"
                type="password"
                v-model="password_confirmation"
                :rules="password_confirmationRules"
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
              :disabled="!valid || loading == true"
            >Create account
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
        name: '',
        nameRules: [
          v => !!v || 'Name is required',
        ],
        email: '',
        emailRules: [
          v => !!v || 'E-mail is required',
          v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
        ],
        password: '',
        passwordRules: [
          v => !!v || 'Password is required',
          v => (v && v.length >= 5) || 'Password must be qual or more than 5 characters',
        ],
        password_confirmation: '',
        password_confirmationRules: [
          v => !!v || 'Password is required',
          v => (v && v.length >= 5) || 'Password must be equal or more than 5 characters',
          v => (v && v === this.password) || 'Password must be match',
        ],
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
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation
          }

          this.$store.dispatch('registerUser', user).then(() => {
            this.$store.dispatch('loginUser', user).then(() => {
              this.$router.push({name: 'Home'})
            })
          })
        }
      }
    }
  }
</script>

<style scoped>

</style>
