<template>
  <section>
    <page-header :back="{ to: { name: 'companies.index' }, text: trans('Companies') }">
      <template v-slot:title>
        <v-skeleton-loader type="text"></v-skeleton-loader>
      </template>

      <template v-slot:action>
        <v-skeleton-loader type="button" height="50"></v-skeleton-loader>
      </template>
    </page-header>

    <v-row>
      <v-col cols="12" md="6">
        <v-skeleton-loader type="image" class="mb-4"></v-skeleton-loader>
      </v-col>
      <v-col cols="12" md="6">
        <v-skeleton-loader type="image" class="mb-4"></v-skeleton-loader>
      </v-col>
      <v-col cols="12" md="6">
        <v-skeleton-loader type="image" class="mb-4"></v-skeleton-loader>
      </v-col>
      <v-col cols="12" md="6">
        <v-skeleton-loader type="image" class="mb-4"></v-skeleton-loader>
      </v-col>
    </v-row>
    </div>
  </section>
</template>
