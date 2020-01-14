<template>
  <keep-alive v-if="check(code)">
    <slot></slot>
  </keep-alive>
</template>

<script>
import $auth from '@/core/Auth/auth'

export default {
  name: 'Can',

  props: ['code'],

  data: () => {
    return {
      permissions: $auth.getUser().permissions,
    }
  },

  methods: {
    check (permission) {
      return permission === false || window._.includes(this.permissions || [], permission)
    }
  }
}
</script>
