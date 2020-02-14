<template>
  <keep-alive>
    <template v-if="check(code)">
      <slot></slot>
    </template>
    <template v-else>
      <slot name="unpermitted"></slot>
    </template>
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
      if (_.isObject(permission)) {
        return !_.isEmpty(permission.filter((p) => {
          return window._.includes(this.permissions || [], p)
        }))
      }

      return permission === false || window._.includes(this.permissions || [], permission)
    }
  }
}
</script>
