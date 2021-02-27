<template>
  <div>
    <v-container>
      <v-row>
        <v-col xs="12">
          <v-card>
            <v-toolbar>
              <v-toolbar-title>Statuses</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn
                color="primary"
                class="mb-2"
                :to="createLink"
              >
                <v-icon left>mdi-plus</v-icon>
                New Status
              </v-btn>
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
              :items="statuses"
              :search="search"
            >
              <template v-slot:top>
                <v-dialog v-model="dialogDelete" max-width="500px">
                  <v-card>
                    <v-card-title class="headline">Are you sure you want to delete this item?</v-card-title>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                      <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                      <v-spacer></v-spacer>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </template>
              <template v-slot:item.actions="{ item }">
                <v-btn
                  icon
                  :to="'/admin/settings/statuses/' + item.id"
                >
                  <v-icon
                    small
                  >
                    mdi-eye
                  </v-icon>
                </v-btn>
                <v-btn
                  icon
                  :to="'/admin/settings/statuses/edit/' + item.id"
                >
                  <v-icon
                    small
                  >
                    mdi-pencil
                  </v-icon>
                </v-btn>
                <v-btn
                  icon
                  @click="deleteStatus(item.id)"
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
            text: "Weight",
            value: "weight",
          },
          {
            text: "Category",
            value: "category.name",
          },
          {
            text: "Type",
            value: "type.name",
          },
          {
            text: 'Actions',
            value: 'actions',
            sortable: false
          },
        ],
        dialogDelete: false,
        editedId: -1,
        createLink: '/admin/settings/statuses/new'
      }
    },
    computed: {
      ...mapGetters({
        statuses: "getStatuses",
      })
    },
    watch: {
      dialogDelete(val) {
        val || this.closeDelete()
      },
    },
    methods: {
      deleteStatus(id) {
        this.editedId = id
        this.dialogDelete = true

      },
      deleteItemConfirm() {
        this.$store.dispatch('deleteStatus', this.editedId).then(() => {
          this.$store.dispatch("loadAllStatuses").then(() => {
            this.closeDelete()
          })

        })
          .catch(() => {

          })
      },
      closeDelete() {
        this.dialogDelete = false
      },
    },
    mounted() {
      this.$store.dispatch("loadAllStatuses")
    },
  }
</script>

<style scoped>

</style>
