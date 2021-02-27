<template>
  <v-card>
    <v-toolbar color="warning" dark>
      <v-spacer></v-spacer>
      <v-toolbar-title v-text="title"></v-toolbar-title>
      <v-spacer></v-spacer>
    </v-toolbar>
    <v-card-text>
      <v-container>
        <v-row>
          <v-col cols="12" sm="12" md="12">
            <p v-text="text" class="text-center"></p>
          </v-col>
        </v-row>
      </v-container>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="blue darken-1" text @click="$emit('no')">No</v-btn>
      <v-btn color="blue darken-1" text @click="$emit('yes')">Yes</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
  export default {
    name: "CardConfirm",
    props: {
      title: {
        type: String,
        default: "Are you sure you want to do this?"
      },
      text: {
        type: String,
        default: ""
      }
    }
  }
</script>

<style scoped>

</style>
