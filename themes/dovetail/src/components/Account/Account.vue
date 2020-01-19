<template>
  <v-row justify="center" align="center">
    <v-col cols="12" md="4">
      <avatar-preview></avatar-preview>
    </v-col>

    <v-col cols="12" md="8">
      <h2 class="mb-3">{{ dataset.displayname }}</h2>
      <div class="mb-2">
        <v-icon small class="mr-2 muted--text">mdi-at</v-icon>
        <span class="muted--text">{{ dataset.username }}</span>
      </div>
      <div class="muted--text mb-2">
        <v-icon small class="mr-2 muted--text">mdi-email-outline</v-icon>
        <span class="muted--text">{{ dataset.email }}</span>
      </div>
      <div class="muted--text">
        <v-icon small class="mr-2 muted--text">mdi-account-outline</v-icon>
        {{ dataset.displayrole }}
      </div>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Account',

  props: {
    items: {
      type: Object,
    },
  },

  computed: {
    ...mapGetters({
      account: 'account/account'
    }),
  },

  data: () => ({
    dataset: {},
  }),

  mounted () {
    this.dataset = Object.assign({}, this.account, this.items)
  },
}
</script>
