<template>
  <div>
    <v-card-title>{{ trans('Account Details') }}</v-card-title>
    <v-card-subtitle class="muted--text">{{ trans('Fields will be used to sign in to the app') }}</v-card-subtitle>
    <v-card-text>
      <v-row>
        <v-col cols="12">
          <validation-provider vid="email" :name="trans('Email address')" rules="required|email" v-slot="{ errors }">
            <v-text-field
              :error-messages="errors"
              :label="trans('Email address')"
              class="dt-text-field"
              outlined
              :dense="isDense"
              type="email"
              v-model="resource.data.email"
              >
            </v-text-field>
          </validation-provider>
        </v-col>
        <v-col cols="12">
          <validation-provider vid="username" :name="trans('Username')" rules="required|min:3" v-slot="{ errors }">
            <v-text-field
              :error-messages="errors"
              :label="trans('Username')"
              autocomplete="off"
              name="username"
              class="dt-text-field"
              outlined
              :dense="isDense"
              v-model="resource.data.username"
              >
            </v-text-field>
          </validation-provider>
        </v-col>
        <v-col cols="12" md="6">
          <validation-provider vid="password" :name="trans('Password')" rules="required|min:6" v-slot="{ errors }">
            <v-text-field
              :error-messages="errors"
              :label="trans('Password')"
              autocomplete="new-password"
              name="password"
              class="dt-text-field"
              outlined
              :dense="isDense"
              ref="password"
              type="password"
              v-model="resource.data.password"
              >
            </v-text-field>
          </validation-provider>
        </v-col>
        <v-col cols="12" md="6">
          <validation-provider vid="password_confirmation" :name="trans('Confirm Password')" rules="required|confirmed:password|min:6" v-slot="{ errors }">
            <v-text-field
              :error-messages="errors"
              :label="trans('Retype Password')"
              autocomplete="new-password"
              name="password_confirmation"
              class="dt-text-field"
              outlined
              :dense="isDense"
              type="password"
              v-model="resource.data.password_confirmation"
              >
            </v-text-field>
          </validation-provider>
        </v-col>
      </v-row>
    </v-card-text>
  </div>
</template>

<script>
import User from '../Models/User'

export default {
  computed: {
    resource: function () {
      return User
    },

    isDense: function () {
      return this.$vuetify.breakpoint.xlAndUp
      // return this.$vuetify.breakpoint.smAndUp
    },
  },
}
</script>
