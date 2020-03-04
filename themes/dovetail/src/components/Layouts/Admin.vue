<template>
  <div>
    <v-slide-y-transition mode="out-in">
      <appbar>
        <slot name="appbar"></slot>
      </appbar>
    </v-slide-y-transition>

    <!-- # Main Content -->
    <v-content style="min-height:100vh">
      <div class="mb-12">
        <v-container>
          <slot>
            <v-slide-y-reverse-transition mode="out-in">
              <router-view></router-view>
            </v-slide-y-reverse-transition>
          </slot>
        </v-container>
      </div>
      <v-footer absolute paddless color="workspace">
        <shortkey></shortkey>
        <v-container>
          <breadcrumbs></breadcrumbs>
        </v-container>
      </v-footer>
    </v-content>

    <!-- # Main Content -->
  </div>
</template>
