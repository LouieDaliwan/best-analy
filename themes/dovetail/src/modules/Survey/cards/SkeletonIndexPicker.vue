<template>
  <v-card class="mb-3">
    <v-card-title>{{ trans('Performance Index') }}</v-card-title>
      <div class="primary--text text-center">
        <checklist-icon width="100" height="100"></checklist-icon>
      </div>
    <v-card-text>
      <v-skeleton-loader class="mb-6" height="56" type="image"></v-skeleton-loader>
    </v-card-text>
  </v-card>
</template>
