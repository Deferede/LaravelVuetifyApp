<template>
  <v-container>
    <v-row align='center' justify='center'>
      <v-col xs='12' md='6'>
        <v-card
          elevation='2'
        >
          <v-toolbar>
            <v-toolbar-title>Lead {{ lead.id }}</v-toolbar-title>
          </v-toolbar>
          <v-simple-table >
            <template v-slot:default>
              <tbody>
              <tr
                v-for='(prop, key) in lead'
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
            >
              Delete
            </v-btn>
            <v-btn
              text
            >
              Edit
            </v-btn>
          </v-card-actions>

        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: ['id'],
    computed: {
      lead () {
        return this.$store.getters.getLeadById(this.id)
      }
    }
  }
</script>

<style scoped>

</style>
