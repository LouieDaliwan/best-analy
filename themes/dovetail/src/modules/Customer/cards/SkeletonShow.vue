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

    <div class="text-center">
      <v-skeleton-loader type="image" class="mb-4"></v-skeleton-loader>
    </div>
  </section>
</template>
