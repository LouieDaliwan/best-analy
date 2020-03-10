<template>
  <v-card class="mb-3">
    <v-card-text>
      <v-row>
        <v-col cols="12">
          <v-skeleton-loader class="mb-6" height="56" type="image"></v-skeleton-loader>
        </v-col>
        <v-col cols="12">
          <v-skeleton-loader class="mb-6" height="56" type="image"></v-skeleton-loader>
        </v-col>
        <v-col cols="12">
          <v-skeleton-loader height="120" type="image"></v-skeleton-loader>
        </v-col>
      </v-row>
    </v-card-text>
    <div class="d-flex">
      <v-divider></v-divider>
      <v-icon small color="muted" class="mx-3 mt-n2">mdi-account-settings</v-icon>
      <v-divider></v-divider>
    </div>
    <v-card-text>
      <h4 class="mb-5">{{ trans('Select Members') }}</h4>
      <v-skeleton-loader class="mb-6" height="56" type="image"></v-skeleton-loader>

      <div class="mt-4">
        <v-skeleton-loader width="20%" type="text@5"></v-skeleton-loader>
      </div>
    </v-card-text>
  </v-card>
</template>
