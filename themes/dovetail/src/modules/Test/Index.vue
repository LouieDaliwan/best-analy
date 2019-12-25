<template>
  <div>
    <h3 class="mb-2">Toast/Snackbar</h3>
    <p>Click the button to run a sample toast.</p>
    <v-btn @click="runSnackbar">Run Toast</v-btn>
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
        <div>{{ $t("Move to Trash") }}</div>
        <div>{{ $t("Edit") }}</div>
      </v-card-text>
    </v-card>

    <h3 class="mb-2 mt-9">Language Switcher</h3>
    TODO
    <!-- <language-chooser></language-chooser> -->

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
