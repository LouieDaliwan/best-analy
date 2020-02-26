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

    <div>
      <v-skeleton-loader type="text" width="60%" class="mb-4"></v-skeleton-loader>
      <v-row>
        <v-col cols="12" sm="6">
          <v-skeleton-loader type="image" height="200"></v-skeleton-loader>
        </v-col>
        <v-col cols="12" sm="6">
          <v-skeleton-loader type="image" height="200"></v-skeleton-loader>
        </v-col>
        <v-col cols="12" sm="6">
          <v-skeleton-loader type="image" height="200"></v-skeleton-loader>
        </v-col>
        <v-col cols="12" sm="6">
          <v-skeleton-loader type="image" height="200"></v-skeleton-loader>
        </v-col>
      </v-row>
    </div>
  </section>
</template>
