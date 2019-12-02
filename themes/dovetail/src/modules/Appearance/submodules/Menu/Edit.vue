<template>
  <v-container fluid grid-list-lg>
    <div class="mb-4">
      <h1 class="title font-weight-bold">{{ __('Edit Main Menu') }}</h1>
    </div>
    <v-layout row wrap>
      <v-flex sm4 xs12>
        <div class="mb-4">
          <h4 class="mb-2">
            {{ __('Menus Toolbox') }}
          </h4>
          <p class="caption">
            {{ __('To activate a widget, drag it to a sidebar and click on it.') }}
          </p>
        </div>

        <div>
          <v-card hover class="mb-3">
            <v-card-text>
              <v-flex>
                <v-layout row wrap justify-center align-center>
                  <h5>{{ __('Archive') }}</h5>
                  <v-spacer></v-spacer>
                  <v-icon>mdi-drag-vertical</v-icon>
                </v-layout>
              </v-flex>
            </v-card-text>
          </v-card>
          <div class="px-3">
            <p class="caption grey--text">
              {{ __('Monthly archive of your site\'s posts.') }}
            </p>
          </div>
        </div>

        <div>
          <v-card hover class="mb-3">
            <v-card-text>
              <v-flex>
                <v-layout row wrap justify-center align-center>
                  <h5>{{ __('Main Menu') }}</h5>
                  <v-spacer></v-spacer>
                  <v-icon>mdi-drag-vertical</v-icon>
                </v-layout>
              </v-flex>
            </v-card-text>
          </v-card>
          <div class="px-3">
            <p class="caption grey--text">
              {{ __('Monthly arvice') }}
            </p>
          </div>
        </div>

        <div>
          <v-card hover class="mb-3">
            <v-card-text>
              <v-flex>
                <v-layout row wrap justify-center align-center>
                  <h5>{{ __('Calendar') }}</h5>
                  <v-spacer></v-spacer>
                  <v-icon>mdi-drag-vertical</v-icon>
                </v-layout>
              </v-flex>
            </v-card-text>
          </v-card>
          <div class="px-3">
            <p class="caption grey--text">
              {{ __('Monthly calendar of your site\'s posts.') }}
            </p>
          </div>
        </div>
      </v-flex>

      <v-flex sm7 xs12 offset-sm1>
        <v-card flat>
          <v-card-text>
            {{ __('Menu Structure') }}
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import store from '@/store'

export default {
  store,
  name: 'Edit',

  data () {
    return {
      resource: {},
    }
  },
}
</script>
