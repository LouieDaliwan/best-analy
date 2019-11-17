<template>
  <section>
    <toolbar-menu :items="toolbar" class="mb-3"></toolbar-menu>
    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex sm6 xs12>
          <!-- iconmenu -->
          <v-card class="mb-3">
            <v-card-title class="emphasis--medium">
              {{ trans('Icon Menu') }}
            </v-card-title>
            <v-card-text>
              <!-- <icon-menu :items="iconmenu"></icon-menu> -->
              <cta :items="cta"></cta>
            </v-card-text>
          </v-card>
          <!-- iconmenu -->
        </v-flex>

        <v-flex sm6 xs12>
          <!-- dialogbox -->
          <v-card flat class="mb-3 text-xs-center">
            <v-card-title
              class="emphasis--medium"
              >
              {{ trans('Dialogbox') }}
            </v-card-title>
            <v-card-text>
              <dialogbox></dialogbox>
              <v-btn
                @click="openDialogbox"
                >
                {{ trans('Open Dialog Test') }}
              </v-btn>
            </v-card-text>
          </v-card>
          <!-- dialogbox -->
        </v-flex>

        <v-flex xs12>
          <!-- grid / list view -->
          <template v-if="toggletoolbar.toggleview">
            <data-table :items="courses"></data-table>
          </template>

          <template v-else>
            <data-iterator :items="courses"></data-iterator>
          </template>
          <!-- grid / list view -->
        </v-flex>
      </v-layout>
    </v-container>
  </section>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,

  name: 'Index',

  data () {
    return {
      toolbar: {
        title: 'All Courses',
      },

      iconmenu: {
        model: '',
        label: 'Choose Icon Menu'
      },

      cta: {
        label: 'Test Submit'
      },

      courses: {
        timestamp: false,
        slug: false,
        author: false,
        created: false,
        modified: false,
        selected: [],
        bulkDestroy: false,
        selectAll: true,
        search: '',
        cardLink: '/admin/courses/show',
        chip: true,
        hover: true,
        lg3: false,
        showMimetype: false,
        showToolbar: false,
        headers: [
          { text: 'ID', value: 'id' },
          { text: 'Featured', value: 'thumbnail' },
          { text: 'Title', value: 'title' },
          { text: 'Category', value: 'category' },
          { text: 'Part', value: 'part' },
          { text: 'Status', value: 'status' },
          {
            text: 'Actions',
            value: 'actions',
            sortable: false,
            align: 'center'
          },
        ],
        items: [
          {
            id: '1',
            title: 'Vue',
            thumbnail: '//preview.ibb.co/cMCYYz/card_Media.png',
            category: 'javascript',
            timestamp: '2 hours ago',
            description: 'Popular Javascript Framework',
            part: '6',
            status: 'enrolled'
          },
          {
            id: '2',
            title: 'React',
            thumbnail: '//cdn.dribbble.com/users/904433/screenshots/2994633/animation_fin.gif',
            category: 'javascript',
            timestamp: '2 hours ago',
            description: 'Popular Javascript Framework',
            part: '6',
          },
          {
            id: '3',
            title: 'Angular',
            thumbnail: '//i.pinimg.com/564x/74/2b/8e/742b8e6e87ef56e698b9c8bc4e930dae.jpg',
            category: 'javascript',
            timestamp: '2 hours ago',
            description: 'Popular Javascript Framework',
            part: '6',
          },
          {
            id: '4',
            title: 'Meteor',
            thumbnail: '//cdn.dribbble.com/users/2559/screenshots/3145041/illushome_1x.png',
            category: 'javascript',
            timestamp: '2 hours ago',
            description: 'Popular Javascript Framework',
            part: '6',
          },
        ]
      },
    }
  },

  computed: {
    ...mapGetters({
      dialogbox: 'dialogbox/dialogbox',
      modal: 'modal/modal',
      toggletoolbar: 'toolbar/toolbar',
    }),

    empty: function () {
      return true // this.dataset.items.length === 0
    },

    page: function () {
      return this.$route.meta
    },
  },

  methods: {
    openDialogbox () {
      this.$store.dispatch(
        'dialogbox/PROMPT_DIALOG',
        Object.assign(
          this.dialogbox,
          {
            model: true,
            // icon: 'add',
            // iconColor: 'success--text',
            image: '//img.stackshare.io/stack/26394/laravel_logo-circle-tp-xs.png',
            title: 'Delete Resources',
            text: 'You are about to permanently delete those resources.This action is irreversible. Do you want to proceed?',
            persistent: true,
            width: '100%',
            alignedCenter: true,

            actionText: 'Delete',
            actionColor: 'error',
            actionCallback () {
              this.model = false
              // store.dispatch.saveUserOrSomeShitLikeThat
              // then...
            },

            discard: false,
          }
        )
      )
    },
  }
}
</script>
