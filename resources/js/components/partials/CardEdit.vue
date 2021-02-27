<template>
  <v-card>
    <v-toolbar
      color="primary"
      dark
    >
      <v-toolbar-title>Edit {{ title }}</v-toolbar-title>
    </v-toolbar>
    <v-card-text>
      <v-container>
        <v-row>
          <v-col cols="12" sm="12" md="12">
            <slot></slot>
          </v-col>
        </v-row>
      </v-container>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="blue darken-1" text @click="$emit('close')">Close</v-btn>
      <v-btn color="blue darken-1" text @click="$emit('confirm')">Save</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
  export default {
    name: "CardEdit",
    props: {
      title: {
        type: String,
        default: '',
      },
    }
  }
</script>

<style scoped>

</style>
