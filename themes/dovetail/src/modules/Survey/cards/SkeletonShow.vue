<template>
  <section>
    <page-header :back="{ to: { name: 'surveys.index' }, text: trans('Surveys') }">
      <template v-slot:title>
        <v-skeleton-loader type="text"></v-skeleton-loader>
      </template>
    </page-header>

    <!-- Preview Info -->
    <v-alert
      border="top"
      class="my-5"
      color="info"
      elevation="1"
      prominent
      text
      type="info"
      >
      <h2 class="mb-3 info--text">{{ __('Preview Only') }}</h2>
      <div class="dark--text">{{ __('This survey detail is for preview purposes only.') }}</div>
    </v-alert>
    <!-- Preview Info -->

    <v-card>
      <v-card-text>
        <v-row justify="center">
          <v-col cols="12" md="10">
            <v-skeleton-loader class="pb-4" height="32" type="image"></v-skeleton-loader>
          </v-col>
          <v-col cols="12" md="10">
            <v-row align="center">
              <v-col cols="12" md="auto">
                <span class="text--text muted--text display-1 font-weight-bold">1</span>
              </v-col>
              <v-col>
                <v-skeleton-loader type="text"></v-skeleton-loader>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </section>
</template>
