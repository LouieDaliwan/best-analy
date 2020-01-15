<template>
  <section>
    <!-- Header -->
    <page-header>
      <template v-slot:action>
        <!-- Export button -->
        <div class="text-right mb-4">
          <v-menu open-on-hover offset-y bottom transition="slide-y-transition">
            <template v-slot:activator="{ on }">
              <v-btn v-on="on" large color="primary">
                <v-icon left>mdi-download</v-icon>
                {{ trans('Export Reports') }}
              </v-btn>
            </template>
            <v-list dense>
              <v-list-item @click="">
                <v-list-icon-content>
                  <v-list-item-title>Business Sustainability</v-list-item-title>
                </v-list-icon-content>
              </v-list-item>
              <v-list-item @click="">
                <v-list-icon-content>
                  <v-list-item-title>Human Resources</v-list-item-title>
                </v-list-icon-content>
              </v-list-item>
              <v-list-item @click="">
                <v-list-icon-content>
                  <v-list-item-title>Financial Management</v-list-item-title>
                </v-list-icon-content>
              </v-list-item>
              <v-list-item @click="">
                <v-list-icon-content>
                  <v-list-item-title>Full Report</v-list-item-title>
                </v-list-icon-content>
              </v-list-item>
            </v-list>
          </v-menu>
        </div>
        <!-- Export button -->
      </template>
    </page-header>
    <!-- Header -->

    <!-- Indexes -->
    <v-row>
      <v-col cols="12" md="6" v-for="(index, i) in indexes" :key="i">
        <v-card exact to="" v-ripple="{ class: 'primary--text' }" fill-height hover class="text-center">
          <v-card-text>
            <!-- <div class="d-flex justify-end">
              <v-menu open-on-hover left bottom transition="slide-y-transition">
                <template v-slot:activator="{ on }">
                  <v-btn v-on="on" absolute icon class="muted--text">
                    <v-icon>mdi-dots-vertical</v-icon>
                  </v-btn>
                </template>
                <v-list dense>
                  <v-list-item @click="">
                    <v-list-item-icon>
                      <v-icon small>mdi-export</v-icon>
                    </v-list-item-icon>
                    <v-list-icon-content>
                      <v-list-item-title>Export</v-list-item-title>
                    </v-list-icon-content>
                  </v-list-item>
                </v-list>
              </v-menu>
            </div> -->
            <div class="mb-4"><img width="100" :src="index.icon" alt=""></div>
            <h4 class="mb-1 text-uppercase" v-text="index.title"></h4>
            <p class="text-uppercase muted--text" v-text="('Performance Indexes')"></p>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <!-- Indexes -->

    <!-- Glance Widget -->
    <!-- <v-row>
      <v-col md="3" sm="6" cols="12" v-for="(glance, i) in staffs" :key="i">
        <glance :items="glance"></glance>
      </v-col>
    </v-row> -->
    <!-- Glance Widget -->

    <!-- data table -->
    <!-- <template v-if="toggletoolbar.toggleview">
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
    </template> -->

    <!-- <template v-else>
      <v-card>
        <toolbar-menu></toolbar-menu>
      </v-card>
      <data-iterator :items="courses"></data-iterator>
    </template> -->
    <!-- data table -->

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
import business from '@/components/Illustration/business.png'
import hr from '@/components/Illustration/hr.png'
import financial from '@/components/Illustration/financial.png'
import productivity from '@/components/Illustration/productivity.png'

export default {
  data: () => ({
    indexes: [
      {
        icon: business,
        title: 'Business Sustainability'
      },
      {
        icon: hr,
        title: 'Human Resources'
      },
      {
        icon: financial,
        title: 'Financial Management'
      },
      {
        icon: productivity,
        title: 'Productivity Management',
      },
    ],
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
