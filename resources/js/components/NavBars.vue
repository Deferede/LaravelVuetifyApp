<template xmlns:slot="http://www.w3.org/1999/html">
  <div>
    <v-navigation-drawer
      app
      v-model="drawer"
    >
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="title">
            <router-link to="/" tag="span" class="pointer">{{ $env.appName }}</router-link>
          </v-list-item-title>
          <v-list-item-subtitle>
            subtext
          </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>

      <v-list
      >
        <div v-for="(menu, i) in sideMenus">
          <v-list-item
            v-if="
            !menu.sub_menu &&
            (
              (menu.roles && hasRole(menu.roles)) ||
              (menu.permissions && hasPermission(menu.permissions))
            )"
            :key="menu.i"
            :to="menu.url"
            menu
          >
            <v-list-item-icon>
              <v-icon v-text="menu.icon"></v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title v-text="menu.title"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-group
            v-else-if="
            (
              (menu.roles && hasRole(menu.roles)) ||
              (menu.permissions && hasPermission(menu.permissions))
            )"
            :key="menu.title"
            no-action
          >
            <template v-slot:activator>
              <v-list-item-icon>
                <v-icon v-text="menu.icon"></v-icon>
              </v-list-item-icon>
              <v-list-item-title v-text="menu.title"></v-list-item-title>
            </template>

            <v-list-item
              v-for="sub_menu in menu.sub_menu"
              v-if="!sub_menu.sub_sub_menu &&
            (
              (sub_menu.roles && hasRole(sub_menu.roles)) ||
              (sub_menu.permissions && hasPermission(sub_menu.permissions))
            )"
              :key="sub_menu.title"
              :to="sub_menu.url"
            >
              <v-list-item-icon>
                <v-icon v-text="sub_menu.icon"></v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title v-text="sub_menu.title"></v-list-item-title>
              </v-list-item-content>
            </v-list-item>

            <v-list-group
              v-for="sub_menu in menu.sub_menu"
              v-if="sub_menu.sub_sub_menu &&
              (
                (sub_menu.roles && hasRole(sub_menu.roles)) ||
                (sub_menu.permissions && hasPermission(sub_menu.permissions))
              )"
              :key="sub_menu.title"
              :to="sub_menu.url"
              no-action
              sub-group
            >
              <template v-slot:activator>
                <v-list-item-icon>
                  <v-icon v-text="sub_menu.icon"></v-icon>
                </v-list-item-icon>
                <v-list-item-title v-text="sub_menu.title"></v-list-item-title>
              </template>

              <v-list-item
                v-for="sub_sub_menu in sub_menu.sub_sub_menu"
                v-if="
                (
                  (sub_sub_menu.roles && hasRole(sub_sub_menu.roles)) ||
                  (sub_sub_menu.permissions && hasPermission(sub_sub_menu.permissions))
                )"
                :key="sub_sub_menu.title"
                :to="sub_sub_menu.url"
              >
                <v-list-item-icon>
                  <v-icon v-text="sub_sub_menu.icon"></v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                  <v-list-item-title v-text="sub_sub_menu.title"></v-list-item-title>
                </v-list-item-content>
              </v-list-item>

            </v-list-group>


          </v-list-group>
        </div>

      </v-list>

      <template v-slot:append>
        <v-toolbar
          flat
        >
          <v-switch
            v-model="$vuetify.theme.dark"
            @change="saveTheme"
            label="Dark theme"
            persistent-hint
          ></v-switch>
        </v-toolbar>
      </template>

    </v-navigation-drawer>
    <v-app-bar
      app
      color="primary"
      dark
    >
      <v-progress-linear
        :active="loading"
        :indeterminate="loading"
        absolute
        bottom
        color="green accent-4"
      ></v-progress-linear>
      <v-app-bar-nav-icon
        @click="toggleDrawer"
      ></v-app-bar-nav-icon>

      <v-toolbar-title>
        {{ this.$route.name }}
      </v-toolbar-title>

      <v-spacer></v-spacer>
      <v-toolbar-items>
        <v-menu offset-y>
          <template v-slot:activator="{ on, attrs }">

            <v-btn
              v-bind="attrs"
              v-on="on"
              text
            >
              <v-icon left>mdi-account</v-icon>
              {{ currentUser.username }}
            </v-btn>
          </template>
          <v-list>

              <v-list-item
                v-for="menu in topMenus"
                :key="menu.title"
                :to="menu.url"
                v-if="hasRole(menu.roles)"
                link
              >
                <v-list-item-icon>
                  <v-icon>{{ menu.icon }}</v-icon>
                </v-list-item-icon>
                <v-list-item-title>{{ menu.title }}</v-list-item-title>
              </v-list-item>

            <v-list-item
              v-if="!hasRole(['guest'])"
              @click="logout"
              link
            >
              <v-list-item-icon>
                <v-icon>mdi-account-arrow-right</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Logout</v-list-item-title>
            </v-list-item>

          </v-list>
        </v-menu>

      </v-toolbar-items>

    </v-app-bar>
  </div>
</template>

<script>
  import {mapGetters} from 'vuex'

  export default {
    data: () => {
      return {
        expand_locations: false,
        drawer: true,
        right: null
      }
    },
    computed: {
      ...mapGetters('user', ['currentUser', 'hasRole', 'hasPermission', 'sideMenus', 'topMenus']),
      ...mapGetters({
        loading: 'shared/getLoading'
      }),
    },
    methods: {
      toggleDrawer() {
        this.drawer = !this.drawer
      },
      logout() {
        this.$store.dispatch('user/logoutUser').then(() => {
          this.$router.push({
            name: 'Login'
          })
        })
      },
      saveTheme() {
        if (this.$vuetify.theme.dark) {
          localStorage.setItem('app-theme', this.$vuetify.theme.dark)
        } else {
          localStorage.removeItem('app-theme')
        }
      }
    },
    mounted() {
      // TODO костыльное раскрытие
      // this.expand_locations = location.pathname.includes('/leads/')
    },
  }
</script>

<style scoped>
  .pointer {
    cursor: pointer;
  }
</style>
