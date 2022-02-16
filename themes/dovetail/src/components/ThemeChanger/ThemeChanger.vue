<template>
  <v-menu top :close-on-content-click="false" v-model="menu">
    <template v-slot:activator="{ on, attrs }">
      <v-btn color="white" v-bind="attrs" v-on="on" icon>
        <v-icon>mdi-palette</v-icon>
      </v-btn>
    </template>
    <v-list>
      <v-list-item>
        <v-list-item-content
          ><v-list-item-title class="font-weight-bold">
            Dark Mode</v-list-item-title
          >
        </v-list-item-content>
        <v-list-item-action
          ><v-switch v-model="$vuetify.theme.dark" />
        </v-list-item-action>
      </v-list-item>
      <v-divider />
      <v-card-text>
        <v-card
          class="my-2"
          :disabled="$vuetify.theme.themes.name === theme.name"
          @click="setTheme(theme)"
          hover
          outlined
          v-for="(theme, index) in themes"
          :key="index"
        >
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title class="font-weight-bold">
                {{ theme.name }}</v-list-item-title
              >
            </v-list-item-content>
            <v-list-item-action>
              <v-avatar
                color="success"
                size="30"
                v-if="$vuetify.theme.themes.name === theme.name"
              >
                <v-icon>mdi-check</v-icon>
              </v-avatar>
            </v-list-item-action>
          </v-list-item>
          <div class="my-2">
            <v-chip
              class="mx-1"
              label
              :color="theme.light[key]"
              v-for="(key, index) in Object.keys(theme.light)"
              :key="index"
            >
              {{ key }}</v-chip
            >
          </div>
          <div class="my-2">
            <v-chip
              class="mx-1"
              label
              :color="theme.dark[key]"
              v-for="(key, index) in Object.keys(theme.dark)"
              :key="index"
            >
              {{ key }}</v-chip
            >
          </div>
        </v-card>
      </v-card-text>
    </v-list>
  </v-menu>
</template>

<script>
export default {
  data: () => ({
    menu: false,
    themes: [
      {
        name: "Theme 1",
        light: {
          primary: "#107e7d",
          secondary: "#044b7f",
          accent: "#f48b3c"
          // light: "#f8f9fa",
          // dark: "#1e262b",
          // text: "#12263f",
          // sidebar: "#f7f7f7",
          // workspace: "#f9fbfd"
        },
        dark: {
          primary: "#107e7d",
          secondary: "#044b7f",
          accent: "#610345"
          // light: "#f8f9fa",
          // dark: "#1e262b",
          // text: "#ffffff",
          // sidebar: "#2b343a",
          // workspace: "#212c32"
        }
      },
      {
        name: "Theme 2",
        dark: {
          primary: "#21CFF3",
          accent: "#FF4081",
          secondary: "#21dc79"
        },
        light: {
          primary: "#22daff",
          accent: "#ff6b99",
          secondary: "#26ff8c"
        }
      },
      {
        name: "Theme 3",
        dark: {
          primary: "#E65100",
          accent: "#7CB342",
          secondary: "#689F38"
        },
        light: {
          primary: "#ffa450",
          accent: "#a1e754",
          secondary: "#92de4e"
        }
      }
    ]
  }),

  methods: {
    setTheme(theme) {
      // close menu
      this.menu = false;
      const name = theme.name;
      const dark = theme.dark;
      const light = theme.light;
      // set themes
      Object.keys(dark).forEach(i => {
        this.$vuetify.theme.themes.dark[i] = dark[i];
      });
      Object.keys(light).forEach(i => {
        this.$vuetify.theme.themes.light[i] = light[i];
      });
      // also save theme name to disable selection
      this.$vuetify.theme.themes.name = name;
    }
  },

  created() {
    this.$vuetify.theme.themes.name = "Theme 1";
  }
};
</script>
