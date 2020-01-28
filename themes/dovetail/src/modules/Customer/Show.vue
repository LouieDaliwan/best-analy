<template>
  <v-container>
    <v-row justify="center">
      <v-col cols="10">
      <page-header :back="{name: 'customers.search'}">
        <template v-slot:title>
          <div class="mb-3">{{ trans("Let's Start!") }}</div>
          <p class="font-weight-regular">Please select the type of evaluation that you would like to do for the <strong>Barakah Services LLC</strong>.</p>
        </template v-slot:title>
      </page-header>
        <v-row>
            <v-col cols="12" md="6" v-for="(index, i) in indexes" :key="i">
              <v-card exact :to="{ name: 'surveys.index'}" v-ripple="{ class: 'primary--text' }" fill-height hover class="text-center">
                <v-card-text>
                   <div class="mb-4"><img width="100" :src="index.icon" alt=""></div>
                  <h4 class="mb-1 text-uppercase" v-text="index.title"></h4>
                  <p class="text-uppercase muted--text" v-text="('Performance Indexes')"></p>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
// import business from '@/modules/Dashboard/assets/business.png'
// import hr from '@/modules/Dashboard/assets/hr.png'
// import financial from '@/modules/Dashboard/assets/financial.png'
// import productivity from '@/modules/Dashboard/assets/productivity.png'

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
    ]
  }),

  mounted () {
    this.$store.dispatch('breadcrumbs/toggle', {show: false})
  }
}
</script>
