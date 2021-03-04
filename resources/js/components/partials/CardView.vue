<template>
  <v-card>
    <v-toolbar
      color="primary"
      dark
    >
      <v-toolbar-title>{{ title }}</v-toolbar-title>
    </v-toolbar>
    <v-card-text>
      <v-container>
        <v-row>
          <v-col cols="12" sm="12" md="12">
            <v-simple-table>
              <template v-slot:default>
                <tbody>
                <tr v-for='(prop, key) in item' :key='key'>
                  <td>{{ key | capitalize }}</td>
                  <td v-if="Array.isArray(prop)">
                    <v-chip
                      class="ma-2"
                      color="green"
                      text-color="white"
                      small
                      v-for="(item, k) in prop" :key="k"
                    >
                      {{ item.name }}
                    </v-chip>
                  </td>
                  <td v-else-if="typeof prop === 'object' && prop !== null">
                    <span v-if="prop.name">{{ prop.name }} <br></span>
                    <span v-else v-for="(value, i) in prop" :key="i">{{ value }} <br></span>
                  </td>
                  <td v-else>{{ prop }}</td>
                </tr>
                </tbody>
              </template>
            </v-simple-table>
          </v-col>
        </v-row>
      </v-container>
    </v-card-text>
  </v-card>
</template>

<script>
  export default {
    name: "CardView",
    props: {
      title: {
        type: String,
        default: '',
      },
      item: {
        type: Object,
        default: {},
      }
    }
  }
</script>

<style scoped>

</style>
