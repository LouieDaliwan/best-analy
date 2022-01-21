<template>
  <v-navigation-drawer
    :clipped="sidebar.clipped"
    :mini-variant.sync="sidebar.mini"
    app
    fixed
    v-model="sidebarmodel"
    class="dt-sidebar secondary workspace-x"
  >
    <!-- Brand -->
    <v-list class="px-3 py-0 workspace" style="border-radius: 0;">
      <v-list-item>
        <v-list-item-avatar tile size="60" class="my-0">
          <img :src="app.logo" :lazy-src="app.logo" />
        </v-list-item-avatar>
        <v-list-item-content>
          <v-list-item-title class="text--text font-weight-bold title">
            <template v-for="(item, i) in appTitle">
              <div :key="i">{{ __(item) }}</div>
            </template>
            <!-- <span class="mb-2">{{ __("SME") }}</span> <br />
            {{ __("Analytics") }} -->
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
    <!-- Brand -->

    <!-- Menu Items -->
    <v-list nav dark class="secondary workspace-x py-6">
      <template v-for="(parent, i) in menus">
        <!-- Menu with children -->
        <template v-if="parent.meta.divider">
          <v-divider :key="i" class="my-2"></v-divider>
        </template>
        <template v-else-if="parent.meta.subheader">
          <v-subheader
            class="text--muted text-capitalize"
            :key="i"
            v-text="$t(parent.meta.title)"
          ></v-subheader>
        </template>
        <template v-else-if="parent.children">
          <can
            :code="parent.meta.permission"
            :viewable="parent.meta['viewable:superadmins']"
          >
            <v-list-group
              :key="i"
              no-action
              :prepend-icon="parent.meta.icon"
              :value="active(parent)"
              color="white"
            >
              <template v-slot:activator>
                <v-list-item-content>
                  <v-list-item-title
                    v-text="$t(parent.meta.title)"
                    class="font-weight-bold"
                  ></v-list-item-title>
                </v-list-item-content>
              </template>
              <!-- Submenu children -->
              <template v-for="(submenu, j) in parent.children">
                <v-divider v-if="submenu.meta.divider" :key="i"></v-divider>
                <template v-else>
                  <template v-if="submenu.children"></template>
                  <template v-else-if="submenu.meta.divider">
                    <v-divider :key="i"></v-divider>
                  </template>
                  <template v-else>
                    <can
                      :code="submenu.meta.permission"
                      :viewable="submenu.meta['viewable:superadmins']"
                    >
                      <v-list-item
                        :key="j"
                        :target="submenu.meta.external ? '_blank' : null"
                        :to="{ name: submenu.name }"
                        :exact="inactive(submenu)"
                        color="white"
                      >
                        <v-list-item-icon v-if="submenu.meta.icon">
                          <v-icon small v-text="submenu.meta.icon"></v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                          <v-list-item-title
                            v-text="$t(submenu.meta.title)"
                            class="font-weight-bold white--text"
                          ></v-list-item-title>
                        </v-list-item-content>
                      </v-list-item>
                    </can>
                  </template>
                </template>
              </template>
            </v-list-group>
          </can>
        </template>
        <!-- Menu with Children -->
        <!-- Menu without Children -->
        <template v-else>
          <can
            :code="parent.meta.permission"
            :viewable="parent.meta['viewable:superadmins']"
          >
            <v-list-item
              color="white"
              :key="i"
              link
              exact
              :to="{ name: parent.name }"
            >
              <v-list-item-icon>
                <v-icon small v-text="parent.meta.icon"></v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title
                  v-text="$t(parent.meta.title)"
                  class="font-weight-bold"
                ></v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </can>
        </template>
        <!-- Menu without Children -->
      </template>

      <!-- FAQ -->
      <template>
        <!-- <can code=""> -->
        <v-list-item color="white" link exact :to="{ name: 'faq.index' }">
          <v-list-item-icon>
            <v-icon
              small
              v-text="__('mdi-frequently-asked-questions')"
            ></v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title
              v-text="__('FAQs')"
              class="font-weight-bold"
            ></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <!-- </can> -->
      </template>
      <!-- FAQ -->
    </v-list>
    <!-- Menu Items -->

    <!-- Sidebar Footer -->
    <template v-slot:append>
      <div class="ma-4">
        <language-button></language-button>
      </div>
      <div class="px-4 py-2 d-flex justify-space-between align-center">
        <div class="white--text">
          <small>
            <div>{{ __("Powered by") }}:</div>
            <div>{{ app.author }} &copy; {{ app.year }}</div>
          </small>
        </div>
        <!-- <v-btn icon @click="$store.dispatch('theme/toggle', {vm: vuetify, dark: !dark})"> -->
        <v-btn
          icon
          @click="$store.dispatch('theme/toggle', { vm: vuetify, dark: !dark })"
        >
          <v-icon color="white">mdi-invert-colors</v-icon>
        </v-btn>
      </div>
    </template>
    <!-- Sidebar Footer -->
  </v-navigation-drawer>
</template>

<script>
import app from "@/config/app";
import menus from "@/config/sidebar";
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Sidebar",

  computed: {
    ...mapGetters({
      sidebar: "sidebar/sidebar",
      dark: "theme/dark",
      lang: "app/locale"
    }),

    app: function() {
      return app;
    },

    vuetify: function() {
      return this.$vuetify;
    },

    menus: function() {
      return menus;
    },

    sidebarmodel: {
      set(value) {
        this.toggle({ model: value });
      },
      get() {
        return this.sidebar.model;
      }
    },
    appTitle() {
      return app.title.split(" ");
    }
  },

  methods: {
    ...mapActions({
      toggle: "sidebar/toggle",
      clip: "sidebar/clip",
      toggleTheme: "theme/toggle"
    }),

    inactive(path) {
      return !this.active(path);
    },

    active(path) {
      return window._.includes(path.meta.children, this.$route.name);
    }
  }
};
</script>
