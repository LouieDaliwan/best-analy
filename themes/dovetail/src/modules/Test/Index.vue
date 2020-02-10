<template>
  <admin>
    <h3 clas="mb-3">Glance widget</h3>
    <!-- Glance Widget -->
    <v-row>
      <v-col md="3" sm="6" cols="12" v-for="(glance, i) in staffs" :key="i">
        <glance :items="glance"></glance>
      </v-col>
    </v-row>
    <!-- Glance widget -->

    <can code="surveys.submit">
      <v-btn @click="getSubmissions">test</v-btn>
    </can>

    <h3 class="mt-9 mb-3">Icon Picker</h3>
    <v-row>
      <v-col md="3" cols="12">
        <icon-picker></icon-picker>
      </v-col>
    </v-row>
    <v-row>
      <v-col md="3" cols="12">
        <find-or-new></find-or-new>
      </v-col>
    </v-row>

    <h3 class="mt-9 mb-3">Toast/Snackbar</h3>
    <p>Click the button to run a sample toast.</p>
    <v-badge
      color="dark"
      overlap
      transition="fade-transition"
      v-model="$store.getters['app/app'].dark"
      >
      <template v-slot:badge>
        <div class="small" attr="font-size: 10px">ctrl+b</div>
      </template>
      <v-btn v-shortkey.once="['ctrl', 'b']" @shortkey="runSnackbar" @click="runSnackbar">Run Toast</v-btn>
    </v-badge>
    <snackbar></snackbar>

    <!-- Export -->
    <h3 class="mt-9 mb-3">Export</h3>
    <export></export>
    <v-btn
      color="primary"
      @click="openExport"
      >
      {{ trans('Open Export') }}
    </v-btn>
    <!-- Export -->

    <!-- Can Permission -->
    <h3 class="mt-9 mb-3">Can and Cannot permission</h3>
    <v-card>
      <v-card-text>
        <cannot code="unexisting.permission">
          <div>You are not permitted to 'unexisting.permission'</div>
        </cannot>
        <can code="libraries.delete">
          <div>you can delete library entries</div>
        </can>
      </v-card-text>
    </v-card>
    <!-- Can Permission -->

    <!-- Grid/List view -->
    <h3 class="mt-9 mb-3">Grid/List view</h3>
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
      <v-card>
        <toolbar-menu></toolbar-menu>
      </v-card>
      <data-iterator :items="courses"></data-iterator>
    </template>
    <!-- Grid/List view -->

    <h3 class="mb-3 mt-9">Repeater</h3>
    <v-card class="mt-3">
      <v-card-title class="pb-0">Metadata</v-card-title>
      <v-card-text>
        <repeater autofocus :fields="2" v-model="repeaters"></repeater>
      </v-card-text>
    </v-card>

    <h3 class="mb-3 mt-9">Translation</h3>
    <v-card class="mt-3">
      <v-card-actions>
        <v-btn text @click="changeLocale('ja')">Change locale to <code>ja</code></v-btn>
        <v-btn text @click="changeLocale('ar')">Change locale to <code>ar</code></v-btn>
        <v-btn text @click="changeLocale('fil')">Change locale to <code>fil</code></v-btn>
        <v-btn text @click="changeLocale()">Change locale to <code>en</code></v-btn>
      </v-card-actions>
      <v-card-text>
        <div>Remember me: <span v-html="$t('Remember me')"></span></div>
        <div>{{ $t("Don't have account yet?") }}</div>
        <div>{{ $t("Remember me") }}</div>
        <div>{{ $t("Sign in with your %s account") }}</div>
        <div>{{ $t("Sign in") }}</div>
        <div>{{ $t("Sign up") }}</div>
        <div>{{ $t("Name") }}</div>
        <div>{{ $t("Role") }}</div>
        <div>{{ $t("Cancel") }}</div>
        <div v-t="'Edit'"></div>
        <div v-t="text"></div>
      </v-card-text>
    </v-card>

    <h3 class="mb-3 mt-9">Language Switcher</h3>
    TODO
    <language-switcher></language-switcher>

    <h3 class="mb-3 mt-9">Widgets</h3>
    <template class="mt-3" v-for="(widget, i) in widgets">
      <div :key="i" v-html="widget.render"></div>
    </template>

    <h3 class="mb-3 mt-9">Permissions</h3>
    <div v-for="(p, i) in permissions" :key="i">
      <div class="font-weight-bold" v-text="i"></div>
      <ul class="ml-6">
        <li v-for="(permission, j) in p" :key="j" v-html="`${permission.name}: <em>${permission.description}</em>`"></li>
      </ul>
    </div>
  </admin>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'TestIndex',

  computed: {
    ...mapGetters({
      toggletoolbar: 'toolbar/toolbar',
    }),
  },

  data () {
    return {
      permissions: [],
      text: 'Move to Trash',
      repeaters: [],
      widgets: [],
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
    }
  },

  methods: {
    openExport () {
      this.$store.dispatch('export/prompt', {
        show: true,
        items: [
          {
            icon: 'mdi-file-pdf',
            color: 'error',
            name: 'Portable Documment Format (.pdf)'
          },
          {
            icon: 'mdi-google-spreadsheet',
            color: 'green',
            name: 'Microsoft Excel (.xlsx)'
          },
          {
            icon: 'mdi-file-document',
            color: 'blue',
            name: 'Open Document Format (.ods)'
          }
        ]
      })
    },

    changeLocale (locale) {
      this.$store.dispatch('app/locale', locale)

      localStorage.setItem('app:rtl', locale == 'ar')
      this.$vuetify.rtl = locale == 'ar'

      if (this.$router.currentRoute.params.lang !== locale) {
        this.$router.push({ name: this.$router.currentRoute.name, params: { lang: locale } })
      }
    },

    runSnackbar () {
      this.$store.dispatch('snackbar/toggle', {
        show: true,
        text: 'This is a sample toast message'
      })
    },

    getPermissions () {
      axios.get('/api/v1/users/permissions')
        .then(response => {
          this.permissions = response.data
        })
    },

    getSubmissions() {
      let attributes = [
        {
          id: 1,
          submission: {
            "customer_id": 1,
            "results": 5,
            "remarks": "eos perspiciatis omnis",
            "submissible_id": 1,
            "submissible_type": "Survey\\Models\\Field",
            "user_id": 1,
          },
        },
        {
          id: 2,
          submission: {
            "customer_id": 1,
            "results": 4,
            "remarks": "eos perspiciatis omnis",
            "submissible_id": 2,
            "submissible_type": "Survey\\Models\\Field",
            "user_id": 1,
          }
        }
      ];
      axios.post('/api/v1/surveys/1/submit', {fields: attributes})
        .then(response => {
          console.log(response)
        })
    },
  },

  mounted () {
    this.getPermissions()
    // this.$store.dispatch('app/locale', 'fil');
  },
}
</script>
