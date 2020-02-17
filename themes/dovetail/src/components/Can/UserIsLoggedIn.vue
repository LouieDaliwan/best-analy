<template>
  <keep-alive>
    <template v-if="userIsLoggedIn">
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
  name: 'UserIsLoggedIn',

  computed: {
    userIsLoggedIn () {
      return !_.isEmpty($auth.getUser())
    }
  },
}
</script>
