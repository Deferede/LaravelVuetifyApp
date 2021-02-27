<template>
  <div>
    <v-container>
      <v-row>
        <v-col xs="12">
          <v-card>
            <v-toolbar>
              <v-toolbar-title>Leads</v-toolbar-title>
            </v-toolbar>
            <v-card-title>
              <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
              ></v-text-field>
            </v-card-title>
            <v-data-table
              :headers="headers"
              :items="leads"
              :search="search"
            >
              <template v-slot:item.actions="{ item }">
                <v-btn
                  icon
                  :to="'/leads/view/' + item.id"
                >
                  <v-icon
                    small
                  >
                    mdi-eye
                  </v-icon>
                </v-btn>
                <v-btn
                  icon
                >
                  <v-icon
                    small
                  >
                    mdi-pencil
                  </v-icon>
                </v-btn>
                <v-btn
                  icon
                >
                  <v-icon
                    small
                  >
                    mdi-delete
                  </v-icon>
                </v-btn>
              </template>
            </v-data-table>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>

</template>

<script>
  import {mapGetters} from 'vuex';

  export default {
    data() {
      return {
        search: '',
        headers: [
          {
            text: "Id",
            align: 'start',
            filterable: false,
            value: "id",
          },
          {
            text: "Name",
            value: "name",
          },
          {
            text: "Phone",
            value: "phone",
          },
          {
            text: "Address",
            value: "address",
          },
          {
            text: "Status",
            value: "status",
          },
          {
            text: 'Actions',
            value: 'actions',
            sortable: false
          },
        ],
      }
    },
    computed: {
      ...mapGetters(["leads", "rejectLeads"])
    },
  }
</script>

<style scoped>

</style>
