<template>
  <section>
    <v-row>
      <v-col md="3" sm="6" cols="12" v-for="(glance, i) in staffs" :key="i">
        <glance :items="glance"></glance>
      </v-col>
    </v-row>

      <template v-if="toggletoolbar.toggleview">
        <v-card>
          <toolbar-menu></toolbar-menu>
          <v-divider></v-divider>
          <v-data-table
            v-model="selected"
            :headers="headers"
            :items="desserts"
            :single-select="singleSelect"
            item-key="name"
            show-select
            >
          </v-data-table>
        </v-card>
      </template>

      <template v-else>
        <!-- Switched to another view <code>data-table</code> -->
        <data-iterator :items="courses"></data-iterator>
      </template>

    <!-- <v-col>
      <cannot code="unexisting.permission">
        <div>You are not permitted to 'unexisting.permission'</div>
      </cannot>
      <br>
      <can code="libraries.delete">
        <div>you can delete library entries</div>
      </can>
    </v-col> -->
  </section>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data: () => ({
    staffs: [
      {
        title: 'Staff',
        count: '0',
        icon: 'mdi-account-outline',
        badge: true,
        deactivated: '3',
      },
      {
        title: 'Department',
        count: '0',
        icon: 'mdi-door-closed'
      },
      {
        title: 'Designation',
        count: '0',
        icon: 'mdi-folder-account-outline'
      },
      {
        title: 'User',
        count: '10',
        icon: 'mdi-account-multiple-outline'
      },
    ],
    courses: {
      hover: true,
      url: 'www.google.com',
      items: [
        {
          thumbnail: '//cdn.dribbble.com/users/2559/screenshots/3145041/illushome_1x.png',
          title: 'Far far away, behind the word mountains',
          description: 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.',
          category: 'Taxonomy'
        },
      ]
    },
    singleSelect: false,
    selected: [],
    headers: [
      {
        text: 'Dessert (100g serving)',
        align: 'left',
        sortable: false,
        value: 'name',
      },
      { text: 'Calories', value: 'calories' },
      { text: 'Fat (g)', value: 'fat' },
      { text: 'Carbs (g)', value: 'carbs' },
      { text: 'Protein (g)', value: 'protein' },
      { text: 'Iron (%)', value: 'iron' },
    ],
    desserts: [
      {
        name: 'Frozen Yogurt',
        calories: 159,
        fat: 6.0,
        carbs: 24,
        protein: 4.0,
        iron: '1%',
      },
      {
        name: 'Ice cream sandwich',
        calories: 237,
        fat: 9.0,
        carbs: 37,
        protein: 4.3,
        iron: '1%',
      },
      {
        name: 'Eclair',
        calories: 262,
        fat: 16.0,
        carbs: 23,
        protein: 6.0,
        iron: '7%',
      },
      {
        name: 'Cupcake',
        calories: 305,
        fat: 3.7,
        carbs: 67,
        protein: 4.3,
        iron: '8%',
      },
      {
        name: 'Gingerbread',
        calories: 356,
        fat: 16.0,
        carbs: 49,
        protein: 3.9,
        iron: '16%',
      },
      {
        name: 'Jelly bean',
        calories: 375,
        fat: 0.0,
        carbs: 94,
        protein: 0.0,
        iron: '0%',
      },
      {
        name: 'Lollipop',
        calories: 392,
        fat: 0.2,
        carbs: 98,
        protein: 0,
        iron: '2%',
      },
      {
        name: 'Honeycomb',
        calories: 408,
        fat: 3.2,
        carbs: 87,
        protein: 6.5,
        iron: '45%',
      },
      {
        name: 'Donut',
        calories: 452,
        fat: 25.0,
        carbs: 51,
        protein: 4.9,
        iron: '22%',
      },
      {
        name: 'KitKat',
        calories: 518,
        fat: 26.0,
        carbs: 65,
        protein: 7,
        iron: '6%',
      },
    ],
  }),

  computed: {
    ...mapGetters({
      toggletoolbar: 'toolbar/toolbar',
    }),
  },
}
</script>
