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
              <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line
                            hide-details></v-text-field>
            </v-card-title>
            <v-data-table :loading="loading" :headers="headers" :items="roles" :search="search">
              <template v-slot:item.permissions="{ item }">
                <v-chip
                  color="green"
                  dark
                >
                  {{ item.permissions.length }}
                </v-chip>
              </template>
              <template v-slot:top>
                <v-dialog v-model="dialogView" max-width="35%">
                  <card-view :title="role.name" :item="role"></card-view>
                </v-dialog>
                <v-dialog v-model="dialogEdit" max-width="35%">
                  <card-edit :title="role.name" @close="dialogEdit = !dialogEdit" @confirm="confirmEdit">
                    <v-autocomplete
                      v-model="role.permissions"
                      :items="permissions"
                      item-value="id"
                      item-text="name"
                      chips
                      small-chips
                      deletable-chips
                      label="Permissions"
                      multiple
                    ></v-autocomplete>
                  </card-edit>
                </v-dialog>
              </template>
              <template v-slot:item.actions="{ item }">
                <v-btn icon @click="viewItem(item.id)">
                  <v-icon small>mdi-eye</v-icon>
                </v-btn>
                <v-btn icon @click="editItem(item.id)">
                  <v-icon small>mdi-pencil</v-icon>
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
  import {mapActions, mapGetters} from 'vuex';

  export default {
    name: "Roles",
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
            text: "Code",
            value: "name",
          },
          {
            text: "Permissions",
            value: "permissions"
          },
          {
            text: 'Actions',
            value: 'actions',
            sortable: false
          },
        ],
        dialogView: false,
        dialogEdit: false,
      }
    },
    computed: {
      ...mapGetters({
        hasPermission: 'user/hasPermission',
        roles: 'roles/allRoles',
        role: 'roles/role',
        loading: 'shared/getLoading',
        permissions: 'permissions/allPermissions'
      }),
    },
    methods: {
      ...mapActions('roles', ['loadRoleById', 'loadAllRoles', 'attachPermissions']),
      ...mapActions('permissions', ['loadPermissions']),
      viewItem(id) {
        this.loadRoleById({id: id}).then(() => {
          this.dialogView = true;
        })
      },
      editItem(id) {
        this.loadRoleById({id: id}).then(() => {
          this.dialogEdit = true
        })
      },
      confirmEdit() {
        this.attachPermissions().then(() => {
          this.loadAllRoles()
          this.dialogEdit = false
        })
      }
    },
    mounted() {
      this.loadPermissions().then(() => {
        this.loadAllRoles()
      })
    },
  }
</script>

<style scoped>

</style>
