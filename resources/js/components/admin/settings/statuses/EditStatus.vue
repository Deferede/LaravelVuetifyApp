<template>
  <v-container>
    <v-row align="center" justify="center">
      <v-col xs="12" sm="6" md="6">
        <v-card class="elevation-12">
          <v-toolbar>
            <v-toolbar-title>Edit status</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form
              ref="form"
              v-model="valid">
              <v-text-field
                name="name"
                label="Status name"
                type="text"
                v-model="status.name"

                required
              ></v-text-field>
              <v-text-field
                name="weight"
                label="Weight"
                type="text"
                v-model="status.weight"

                required
              ></v-text-field>
              <v-select
                :items="categories"
                item-text="name"
                item-value="id"
                label="Category"
                v-model="status.status_category_id"

              ></v-select>
              <v-select
                :items="types"
                item-text="name"
                item-value="id"
                label="Type"
                v-model="status.status_type_id"

              ></v-select>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="primary"
              @click="onSubmit"
              :disabled="false"
            >Update
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
    props: ['id'],
    data() {
      return {
        valid: false,
        rules: {
          nameRules: [v => !!v || 'Name is required',],
          weightRules: [
            v => !!v || 'Weight is required',
            v => !isNaN(v) || 'Must be number'
          ],
          categoryRules: [v => !!v || 'Category is required',],
          typeRules: [v => !!v || 'Type is required',],
        }
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
          this.$store.dispatch('updateStatus', {id: this.id, payload: status})
            .then(() => {
              this.$router.back()
            }).catch(() => {

          })
        }
      }
    },
    created() {
      this.$store.dispatch("loadEditingStatus", this.id)
      this.$store.dispatch('loadStatusCategories')
      this.$store.dispatch('loadStatusTypes')
    }
  }
</script>

<style scoped>

</style>
