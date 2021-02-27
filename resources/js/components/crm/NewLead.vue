<template>
  <v-container>
    <v-row align="center" justify="center">
      <v-col xs="12" sm="6" md="6">
        <v-card class="elevation-12">
          <v-toolbar>
            <v-toolbar-title>New lead</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form
              lazy-validation
              ref="form"
              v-model="valid">
              <v-text-field
                name="name"
                label="Name"
                type="text"
                v-model="name"
                :rules="rules.nameRules"
                required
              ></v-text-field>
              <v-text-field
                name="phone"
                label="Phone"
                type="text"
                v-model="phone"
                :rules="rules.phoneRules"
                required
              ></v-text-field>
              <v-text-field
                name="address"
                label="Address"
                type="text"
                v-model="address"
                :rules="rules.addressRules"
                required
              ></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="primary"
              @click="onSubmit"
              :disabled="!valid"
            >Create
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    data() {
      return {
        valid: false,
        name: '',
        phone: '',
        address: '',
        rules: {
          nameRules: [v => !!v || 'Name is required',],
          phoneRules: [v => !!v || 'Phone is required',],
          addressRules: [v => !!v || 'Address is required',],
        }
      }
    },
    methods: {
      onSubmit() {
        if (this.$refs.form.validate()) {
          const lead = {
            name: this.name,
            phone: this.phone,
            address: this.address,
            status: 'new',
          }
          this.$store.dispatch('create_lead', lead)
        }
      }
    },
  }
</script>

<style scoped>

</style>
