<template>
  <div>
    <v-container>
      <v-row align='center' justify='center'>
        <v-col xs='12' md='6'>
          <v-card
            elevation='2'
          >
            <v-toolbar>
              <v-toolbar-title>Status {{ status.name }}</v-toolbar-title>
            </v-toolbar>
            <v-simple-table>
              <template v-slot:default>
                <tbody>
                <tr
                  v-for='(prop, key) in status'
                  :key='key'
                >
                  <td>{{ key | capitalize }}</td>
                  <td>{{ prop }}</td>
                </tr>
                </tbody>
              </template>
            </v-simple-table>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                text
                color='error'
                @click="deleteStatus"
              >
                Delete
              </v-btn>
              <v-btn
                text
                :to="'/admin/settings/statuses/edit/' + this.id"
              >
                Edit
              </v-btn>
            </v-card-actions>

          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>

</template>

<script>
  import {mapGetters} from 'vuex'

  export default {
    props: ['id'],
    data() {
      return {}
    },
    computed: {
      ...mapGetters(['getStatus']),
      status() {
        return this.getStatus
      }
    },
    methods: {
      deleteStatus() {
        this.$store.dispatch('deleteStatus', this.id).then(() => {
          this.$router.push("/admin/settings/statuses")
        })
        .catch(() => {

        })
      }
    },
    created() {
      this.$store.dispatch("loadStatusById", this.id)
    }
  }
</script>

