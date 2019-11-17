<template>
  <v-container fluid grid-list-lg>
    <div class="mb-4">
      <h1 class="headline font-weight-bold">
        {{ __('Menus') }}
      </h1>
    </div>
    <v-layout row wrap>
      <template
        v-for="(item, i) in resources.items"
        >
        <v-flex :key= "i" md4 sm6 xs12>
          <v-card
            hover
            :to="{
              name: 'appearance.edit',
              params: {
                code: item.code,
                meta: { item: item }
              },
            }"
            >
            <v-list two-line>
              <v-list-tile>
                <v-list-tile-action>
                  <v-list-tile-avatar dark :color="item.iconBackground">
                    <v-icon
                      size="18"
                      :color="item.iconColor"
                      v-html="item.icon"
                      >
                    </v-icon>
                  </v-list-tile-avatar>
                </v-list-tile-action>
                <v-list-tile-content>
                  <v-list-tile-title
                    class="font-weight-bold"
                    v-html="item.name"
                    >
                  </v-list-tile-title>
                  <v-list-tile-sub-title v-html="item.description">
                  </v-list-tile-sub-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list>
            <v-card-actions class="px-3 pb-3 pt-3">
              <small color="grey--text">
                {{ __('Application link') }}
              </small>
              <v-spacer></v-spacer>
              <v-icon color="grey--text text--lighten-3">
                mdi-call-made
              </v-icon>
            </v-card-actions>
          </v-card>
        </v-flex>
      </template>
    </v-layout>
  </v-container>
</template>

<script>
import store from '@/store'

export default {
  store,
  name: 'Index',

  mounted () {
    axios.get('/api/v1/menus/all')
      .then(response => {
        this.resources.items = response.data
      })
  },

  data () {
    return {
      resources: {
        items: []
      },
    }
  }
}
</script>
