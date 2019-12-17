<template>
  <section>
    <!-- :back="{name: 'users.index'}" -->
    <page-header>
      <template v-slot:utilities>
        <router-link tag="a" class="link--text text--decoration-none mr-4" exact :to="{name: 'dashboard'}">
          <v-icon small class="mb-1 mdi mdi-delete-empty link--text"></v-icon>
          {{ trans('Deactivated') }}
        </router-link>

        <router-link tag="a" class="link--text text--decoration-none mr-4" exact :to="{name: 'dashboard'}">
          <v-icon small class="mb-1 mdi mdi-export link--text"></v-icon>
          {{ trans('Export') }}
        </router-link>
      </template>

      <template v-slot:action>
        <v-btn large color="primary" exact :to="{ name: 'users.create' }">
          <v-icon left>mdi mdi-account-plus-outline</v-icon>
          {{ trans("Add User") }}
        </v-btn>
      </template>
    </page-header>

    <v-card class="mb-3">
      <v-card-text>
        {{ __('Data Table') }}
      </v-card-text>
    </v-card>
  </section>
</template>
