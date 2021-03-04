<template>
  <div>
    <v-container>
      <v-row>
        <v-col xs="12">
          <v-card>
            <v-toolbar>
              <v-btn-toggle
                color="primary"
                group>
                <v-btn :to="{name: 'Status settings'}" depressed exact>Statuses</v-btn>
                <v-btn :to="{name: 'Status-type settings'}" depressed exact>Types</v-btn>
                <v-btn :to="{name: 'Status-category settings'}" depressed exact>Categories</v-btn>
              </v-btn-toggle>
              <v-spacer></v-spacer>
              <v-btn-toggle
                color="primary"
                group
              >
                <!--                <v-btn v-if="hasRole('admin')" @click="handleActiveStatusUsers">Deleted users</v-btn>-->
                <v-btn depressed v-if="hasRole('admin')" @click="newItem">
                  <v-icon left>mdi-plus</v-icon>
                  {{ newItemTitle }}
                </v-btn>
              </v-btn-toggle>

            </v-toolbar>
            <v-card-title>
              <v-text-field
                v-model.lazy="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
            </v-card-title>
            <v-data-table
              :headers="headers"
              :items="items"
              :search="search"
              :items-per-page="perPage"
              :server-items-length="meta.total"
              @update:sort-by="handleEvent('orderBy', $event)"
              @update:sort-desc="handleEvent('orderDesc', $event)"
              hide-default-footer
            >
              <template v-slot:top>
                <!--CREATE DIALOG-->
                <v-dialog v-model="dialogNew" max-width="35%">
                  <card-create :title="item.name" @close="closeDialogs" @confirm="confirmCreate">
                    <v-text-field label="Name" type="text" v-model="item.name" required></v-text-field>
                  </card-create>
                </v-dialog>
                <!--END-->
                <!--VIEW DIALOG-->
                <v-dialog v-model="dialogView" max-width="35%">
                  <card-view :item="item" :title="item.name"></card-view>
                </v-dialog>
                <!--END-->
                <!--EDIT DIALOG-->
                <v-dialog v-model="dialogEdit" max-width="35%">
                  <card-edit :title="item.name" @close="closeDialogs" @confirm="confirmUpdate">
                    <v-text-field label="Name" type="text" v-model="item.name" required></v-text-field>
                  </card-edit>
                </v-dialog>
                <!--END-->
                <!--DELETE DIALOG-->
                <v-dialog v-model="dialogDelete" max-width="35%">
                  <card-confirm
                    :title="`Are you sure you want to delete this ${item.name}?`"
                    text=""
                    @no="closeDialogs"
                    @yes="confirmDelete"
                  ></card-confirm>
                </v-dialog>
                <!--END-->
                <!--RESTORE DIALOG-->
                <!--                <v-dialog v-model="dialogRestore" max-width="35%">-->
                <!--                  <card-confirm-->
                <!--                    title="Are you sure you want to restore this item?"-->
                <!--                    text=""-->
                <!--                    @no="closeDialogs"-->
                <!--                    @yes="confirmRestore"-->
                <!--                  ></card-confirm>-->

                <!--                </v-dialog>-->
                <!--END-->
              </template>
              <template v-slot:item.actions="{ item }">
                <div v-if="!item.is_deleted">
                  <v-btn icon @click="viewItem(item.id)">
                    <v-icon small>mdi-eye</v-icon>
                  </v-btn>
                  <v-btn icon @click="editItem(item.id)">
                    <v-icon small>mdi-pencil</v-icon>
                  </v-btn>
                  <v-btn icon @click="deleteItem(item.id)">
                    <v-icon small>mdi-delete</v-icon>
                  </v-btn>
                </div>
                <v-btn v-if="item.is_deleted" icon @click="restoreItem(item.id)">
                  <v-icon small>mdi-refresh</v-icon>
                </v-btn>
              </template>
            </v-data-table>
            <v-row>
              <v-spacer></v-spacer>
              <v-col cols="3" sm="3">
                <v-select v-model.lazy="perPage" :items="[5,10,20,25,50,100]" label="Row per Page"></v-select>
              </v-col>
            </v-row>
            <div class="text-center pt-2">
              <v-pagination v-model="meta.current_page" :length="meta.last_page" @input="pageChange"></v-pagination>
            </div>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>

</template>

<script>
  import {mapActions, mapGetters} from 'vuex';

  export default {
    data() {
      return {
        newItemTitle: "New status type",
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
            text: "Created at",
            value: "created_at",
          },
          {
            text: 'Actions',
            value: 'actions',
            sortable: false
          },
        ],
        dialogNew: false,
        dialogView: false,
        dialogEdit: false,
        dialogDelete: false,
        dialogRestore: false,
        editedId: -1,
        perPage: 10,
        page: 1,
        activeStatus: false,
        orderBy: 'id',
        orderDesc: false,
      }
    },
    computed: {
      ...mapGetters({
        hasRole: 'user/hasRole',
        item: 'statusTypes/item',
        items: 'statusTypes/items',
        meta: 'shared/meta',
      }),
    },
    watch: {
      search() {
        if (this.search.length > 3) {
          this.refreshTable()
        } else if (this.search.length === 0) {
          this.refreshTable()
        }
      },
      perPage() {
        this.page = 1
        this.refreshTable()
      }
    },
    methods: {
      ...mapActions({
        createItem: 'statusTypes/createItem',
        updateItem: 'statusTypes/updateItem',
        destroyItem: 'statusTypes/deleteItem',
        resetItem: 'statusTypes/loadBlankItem',
        loadItem: 'statusTypes/loadItem',
        loadItems: 'statusTypes/loadItems',
      }),
      newItem() {
        this.resetItem().then(() => {
          this.dialogNew = true
        })
      },
      confirmCreate() {
        this.createItem().then(() => {
          this.refreshTable()
          this.closeDialogs()
        })
      },
      viewItem(id) {
        this.loadItem(id).then(() => {
          this.dialogView = true
        })
      },
      editItem(id) {
        this.loadItem(id).then(() => {
          this.dialogEdit = true
        })
      },
      deleteItem(id) {
        this.loadItem(id)
        this.dialogDelete = true

      },
      confirmDelete() {
        this.destroyItem().then(() => {
          this.closeDialogs()
        })
      },
      confirmUpdate() {
        this.updateItem().then(() => {
          this.refreshTable()
          this.closeDialogs()
        })
      },
      pageChange(page) {
        this.page = page
        this.refreshTable()
      },
      handleActiveStatusUsers() {
        this.activeStatus = this.activeStatus !== false ? false : 'isNotActive'
        this.refreshTable()
      },
      refreshTable() {
        this.loadItems({
          page: this.page,
          limit: this.perPage,
          search: this.search,
          activeStatus: this.activeStatus,
          orderBy: this.orderBy + "|" + this.orderDesc
        })
      },
      closeDialogs() {
        this.dialogNew = false
        this.dialogView = false
        this.dialogEdit = false
        this.dialogDelete = false
        this.dialogRestore = false
        this.refreshTable()
      },
      handleEvent(source, $event) {
        switch (source) {
          case "orderBy":
            this.orderBy = $event[0]
            this.refreshTable()
            break;
          case "orderDesc":
            this.orderDesc = $event[0]
            this.refreshTable()
            break;
        }
      }
    },
    mounted() {
      this.refreshTable()
    },
  }
</script>

<style scoped>

</style>
