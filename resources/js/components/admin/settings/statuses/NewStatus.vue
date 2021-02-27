<template>
  <v-container>
    <v-row align="center" justify="center">
      <v-col xs="12" sm="6" md="6">
        <v-card class="elevation-12">
          <v-toolbar>
            <v-toolbar-title>New status</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form
              lazy-validation
              ref="form"
              v-model="valid">
              <v-text-field
                name="name"
                label="Status name"
                type="text"
                v-model="status.name"
                :rules="rules.nameRules"
                required
              ></v-text-field>
              <v-text-field
                name="weight"
                label="Weight"
                type="text"
                v-model="status.weight"
                :rules="rules.weightRules"
                required
              ></v-text-field>
              <v-select
                :items="categories"
                item-text="name"
                item-value="id"
                label="Category"
                v-model="status.status_category_id"
                :rules="rules.categoryRules"
              ></v-select>
              <v-select
                :items="types"
                item-text="name"
                item-value="id"
                label="Type"
                v-model="status.status_type_id"
                :rules="rules.typeRules"
              ></v-select>
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
  import {mapGetters} from 'vuex'
  import validation_rules from '../../../../helpers/validation-rules'
  export default {
    data() {
      return {
        valid: false,
        rules: validation_rules
      }
    },
    computed: {
      ...mapGetters({
        status: 'getStatus',
        types: 'getStatusTypes',
        categories: 'getStatusCategories'
      })
    },
    methods: {
      onSubmit() {
        if (this.$refs.form.validate()) {
          const status = {
            name: this.status.name,
            weight: this.status.weight,
            status_category_id: this.status.status_category_id,
            status_type_id: this.status.status_type_id,
          }
          this.$store.dispatch('createStatus', status)
            .then(() => {
              this.$router.push('/admin/settings/statuses')
            }).catch(() => {

          })
        }
      }
    },
    created() {
      this.$store.dispatch('loadBlankStatus')
      this.$store.dispatch('loadStatusCategories')
      this.$store.dispatch('loadStatusTypes')
    }
  }
</script>

<style scoped>

</style>
