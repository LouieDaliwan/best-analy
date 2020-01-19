<template>
  <div>
    <v-slide-y-transition mode="out-in">
      <appbar>
        <slot name="appbar"></slot>
      </appbar>
    </v-slide-y-transition>

    <!-- # Main Content -->
    <v-content>
      <!-- <v-container>
        <breadcrumbs></breadcrumbs>
      </v-container> -->

      <v-container>
        <slot>
          <v-slide-y-reverse-transition mode="out-in">
            <router-view></router-view>
          </v-slide-y-reverse-transition>
        </slot>
      </v-container>

      <shortkey></shortkey>
      <v-card class="transparent" flat height="100"></v-card>
    </v-content>
    <!-- # Main Content -->
  </div>
</template>
