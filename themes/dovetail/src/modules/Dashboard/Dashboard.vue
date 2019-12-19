<template>
  <section>
    <v-row>
      <v-col md="3" sm="6" cols="12" v-for="(glance, i) in staffs" :key="i">
        <glance :items="glance"></glance>
      </v-col>
    </v-row>

    <toolbar-menu class="mb-3"></toolbar-menu>
      <template v-if="toggletoolbar.toggleview">
        <data-iterator :items="courses"></data-iterator>
      </template>
      <template v-else>
        Switched to another view <code>data-table</code>
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
  }),

  computed: {
    ...mapGetters({
      toggletoolbar: 'toolbar/toolbar',
    }),
  },
}
</script>
