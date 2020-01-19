<template>
  <admin>
    <page-header>
      <template v-slot:action>
        <!-- Export button -->
        <div class="text-right mb-4">
          <v-menu open-on-hover offset-y bottom transition="slide-y-transition">
            <template v-slot:activator="{ on }">
              <v-btn v-on="on" large color="primary">
                <v-icon small left>mdi-download</v-icon>
                {{ trans('Export Reports') }}
              </v-btn>
            </template>
            <v-list dense>
              <v-list-item>
                <v-list-icon-content>
                  <v-list-item-title>Business Sustainability</v-list-item-title>
                </v-list-icon-content>
              </v-list-item>
              <v-list-item>
                <v-list-icon-content>
                  <v-list-item-title>Human Resources</v-list-item-title>
                </v-list-icon-content>
              </v-list-item>
              <v-list-item>
                <v-list-icon-content>
                  <v-list-item-title>Financial Management</v-list-item-title>
                </v-list-icon-content>
              </v-list-item>
              <v-list-item>
                <v-list-icon-content>
                  <v-list-item-title>Full Report</v-list-item-title>
                </v-list-icon-content>
              </v-list-item>
            </v-list>
          </v-menu>
        </div>
        <!-- Export button -->
      </template>
    </page-header>

    <v-row>
      <v-col cols="12" md="6" v-for="(index, i) in indexes" :key="i">
        <v-card exact to="" v-ripple="{ class: 'primary--text' }" hover class="text-center">
          <v-card-text>
            <div class="mb-4"><img height="100" :src="index.icon" alt=""></div>
            <h4 class="mb-1 text-uppercase" v-text="index.title"></h4>
            <p class="text-uppercase muted--text" v-text="('Performance Indexes')"></p>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </admin>
</template>

<script>
import business from '@/components/Illustration/building.svg'
import hr from '@/components/Illustration/accountant.svg'
import financial from '@/components/Illustration/saving.svg'
import productivity from '@/components/Illustration/analyze_on_screen.svg'

export default {
  data: () => ({
    indexes: [
      {
        icon: business,
        title: 'Business Sustainability'
      },
      {
        icon: hr,
        title: 'Human Resources'
      },
      {
        icon: financial,
        title: 'Financial Management'
      },
      {
        icon: productivity,
        title: 'Productivity Management',
      },
    ],
  }),
}
</script>
