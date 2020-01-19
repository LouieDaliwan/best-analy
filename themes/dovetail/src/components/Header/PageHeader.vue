<template>
  <v-col cols="12" class="mb-4">
    <v-row justify="space-between" align="center">
      <div>
        <slot name="back" :back="back">
          <div class="mb-2" v-if="back">
            <router-link tag="a" exact :to="back.to" class="text--decoration-none body-1 dt-link">
              <v-icon small class="mb-1">mdi mdi-chevron-left</v-icon>
              <span v-text="back.text"></span>
            </router-link>
          </div>
        </slot>
        <h2 class="mb-1" :title="heading.description">
          <slot name="title">
            {{ heading.title }}
          </slot>
        </h2>
        <slot name="utilities"></slot>
      </div>

      <div><slot name="action"></slot></div>
    </v-row>
  </v-col>
</template>

<script>
export default {
  props: {
    back: Object,
  },
}
</script>
