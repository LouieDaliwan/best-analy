<template>
  <div>
    <h3 class="mb-2">Toast/Snackbar</h3>
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

    <br><p></p><p></p>
    <h3 class="mb-2 mt-9">Repeater</h3>
    <v-card class="mt-3">
      <v-card-title>Metadata</v-card-title>
      <v-card-text>
        <repeater v-model="repeaters"></repeater>
      </v-card-text>
    </v-card>

    <h3 class="mb-2 mt-9">Translation</h3>
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

    <h3 class="mb-2 mt-9">Language Switcher</h3>
    TODO
    <language-switcher></language-switcher>

    <h3 class="mb-2 mt-9">Widgets</h3>
    <template class="mt-3" v-for="(widget, i) in widgets">
      <div :key="i" v-html="widget.render"></div>
    </template>
  </div>
</template>

<script>
export default {
  name: 'TestIndex',

  data () {
    return {
      text: 'Move to Trash',
      repeaters: [],
      widgets: [],
      //   {key: 'app:title', value: 'BEST Analytics'},
      //   {key: 'app:year', value: '2020'},
      //   {key: 'app:theme', value: 'dovetail'},
      // ],
    }
  },

  methods: {
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
    }
  },

  mounted () {
    // this.$store.dispatch('app/locale', 'fil');
  },
}
</script>
