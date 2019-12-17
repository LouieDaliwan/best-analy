<template>
  <section>
    <v-app-bar
      app
      elevate-on-scroll
      :clipped-left="sidebar.clipped"
      v-if="appbar.model"
      >
      <v-btn class="muted--text" icon @click="toggle({model: !sidebar.model})">
        <v-icon small>mdi-menu</v-icon>
      </v-btn>

      <v-spacer></v-spacer>

      <v-menu
        class="justify-end d-flex"
        min-width="200px"
        nudge-bottom="12px"
        nudge-width="200px"
        offset-y
        transition="slide-y-transition"
        >
        <template v-slot:activator="{ on }">
          <div v-on="on" role="button" @click="show = !show">
            <div class="d-flex justify-space-between align-center">
              <v-avatar size="32" class="mr-3"><img :src="user.avatar" width="40px"></v-avatar>
                <v-tooltip bottom v-model="show">
                  <template v-slot:activator="{ on }">
                    <div v-on="on">
                      <p class="body-1 mb-0 text-truncate" v-text="user.displayname"></p>
                      <div v-text="user.role" class="muted--text overline"></div>
                    </div>
                </template>
                <span>{{ trans(user.displayname) }}</span>
              </v-tooltip>
            </div>
          </div>
        </template>

        <v-list>
          <v-list-item>
            <v-list-item-action>
              <v-icon small class="text--muted">mdi-account-outline</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>{{ trans('My Profile') }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item>
            <v-list-item-action>
              <v-icon small class="text--muted">mdi-tune</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>{{ trans('Settings') }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-divider></v-divider>
          <v-list-item exact :to="{name: 'logout'}">
            <v-list-item-action>
              <v-icon small class="text--muted">mdi-power</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>{{ trans('Logout') }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
  </section>
</template>

<script>
// import { user } from '@/utils/user'
import { mapGetters, mapActions } from 'vuex'
import store from '@/store'

export default {
  store,
  name: 'Appbar',

  data () {
    return {
      show: false,
    }
  },

  computed: {
    ...mapGetters({
      appbar: 'appbar/appbar',
      sidebar: 'sidebar/sidebar',
      user: 'auth/user',
    }),
  },

  methods: {
    ...mapActions({
      toggle: 'sidebar/toggle',
      logout: 'auth/logout',
    }),
  },
}
</script>
