<template>
  <section>
    <!-- Header -->
    <page-header></page-header>
    <!-- Header -->

    <!-- Glance Widget -->
    <v-row>
      <v-col md="3" sm="6" cols="12" v-for="(glance, i) in staffs" :key="i">
        <glance :items="glance"></glance>
      </v-col>
    </v-row>
    <!-- Glance Widget -->

    <template v-if="toggletoolbar.toggleview">
      <v-card>

        <toolbar-menu></toolbar-menu>

        <v-divider></v-divider>
        <v-data-table
          :headers="headers"
          :items="desserts"
          sort-by="calories"
          >
          <template v-slot:item.action="{ item }">
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                <v-btn small icon v-on="on">
                  <v-icon
                    small
                    >
                    mdi-pencil-outline
                  </v-icon>
                </v-btn>
              </template>
              <span>{{ __('Edit') }}</span>
            </v-tooltip>

            <v-btn small icon>
              <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                  <v-btn small icon v-on="on">
                    <v-icon
                      small
                      >
                      mdi-delete-outline
                    </v-icon>
                  </v-btn>
                </template>
                <span>{{ __('Move to Trash') }}</span>
              </v-tooltip>
            </v-btn>
          </template>
        </v-data-table>
      </v-card>
    </template>

    <template v-else>
      <!-- Switched to another view <code>data-table</code> -->
      <v-card>
        <toolbar-menu></toolbar-menu>
      </v-card>
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
    headers: [
      { text: 'Account Name', align: 'left', value: 'name' },
      { text: 'Email', value: 'email' },
      { text: 'Role', value: 'role', sortable: false },
      { text: 'Date Created', value: 'created' },
      { text: 'Actions', value: 'action', sortable: false, class: "muted--text" },
    ],
    desserts: [
      {
        name: 'Princess Ellen Alto',
        email: 'ellen@ssagroup.com',
        role: 'Super Administrator',
        created: '2 months ago',
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
