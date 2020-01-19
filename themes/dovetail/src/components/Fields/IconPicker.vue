<template>
  <section>

    <v-menu
      transition="slide-y-transition"
      bottom
      >
      <template v-slot:activator="{ on }">
        <v-icon
          large
          v-on="on"
          >
          mdi-chevron-right
        </v-icon>
      </template>
      <v-card>
        <v-text-field
          outlined
          dense
          >
        </v-text-field>
        <v-list dense>
          <v-list-item
            v-for="(item, i) in items"
            :key="i"
            @click=""
            >
            <v-list-item-icon><v-icon small color="text">{{ item }}</v-icon></v-list-item-icon>
            <v-list-item-title class="muted--text">{{ item }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-card>
    </v-menu>
  </section>
</template>

<script>
  export default {
    data: () => ({
      items: ['mdi-home', 'mdi-account-outline', 'mdi-pencil-outline', 'mdi-delete-outline', 'mdi-download'],
    }),
  }
</script>
