<template>
  <keep-alive v-if="check(code)">
    <slot></slot>
  </keep-alive>
</template>

<script>
import $auth from '@/core/Auth/auth'

export default {
  name: 'Cannot',

  props: ['code'],

  data: () => {
    return {
      permissions: $auth.getUser().permissions,
    }
  },

  methods: {
    check (permission) {
      return permission === false || ! window._.includes(this.permissions || [], permission)
    }
  }
}
</script>
