<template>
  <div>
    <v-container>
      <v-row>
        <v-col xs="12">
          <v-card>
            <v-toolbar>
              <v-btn-toggle
                color="primary"
                group
              >
                <v-btn :to="{name: 'Users'}" depressed exact>Users</v-btn>
                <v-btn :to="{name: 'Roles settings'}" v-if="hasPermission('crm.roles-list')" depressed exact>Roles</v-btn>
                <v-btn :to="{name: 'Permissions settings'}" v-if="hasPermission('crm.permissions-list')" depressed exact>Permissions</v-btn>
              </v-btn-toggle>
              <v-spacer></v-spacer>
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
              :loading = "loading"
              :headers="headers"
              :items="permissions"
              :search="search"
              item-key="id"
              sort-by="id"
              group-by="group"
              class="elevation-1"
              show-group-by
            ></v-data-table>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>

</template>

<script>
  import {mapGetters} from 'vuex';

  export default {
    name: "Permissions",
    data() {
      return {
        search: '',
        headers: [
          {
            text: "Id",
            align: 'start',
            value: "id",
          },
          {
            text: "Group",
            value: "group"
          },
          {
            text: "Name",
            value: "name",
          },
        ],
        dialogDelete: false,
        editedId: -1,
        model: {
          name: 'Permission',
          viewLink: '/admin/settings/permissions/',
        }
      }
    },
    computed: {
      ...mapGetters({
        hasPermission: 'user/hasPermission',
        permissions: 'permissions/allPermissions',
        loading: 'shared/getLoading'
      }),
    },
    mounted() {
      this.$store.dispatch('permissions/loadPermissions')
    },
  }
</script>

<style scoped>

</style>
