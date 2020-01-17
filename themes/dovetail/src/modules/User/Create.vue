<template>
  <section>
    <validation-observer ref="adduser-form" v-slot="{ passes }">
      <v-form autocomplete="false">
        <page-header>
          <template v-slot:title>
            {{ trans('Add User') }}
          </template>
          <template v-slot:action>
            <v-btn large color="primary" exact :to="{ name: 'users.index' }">
              <v-icon left>mdi-content-save-outline</v-icon>
              {{ trans('Save') }}
            </v-btn>
          </template>
        </page-header>

        <v-row>
          <v-col cols="12" md="9">
            <v-card class="mb-3">
              <v-card-title>{{ trans('Personal Information') }}</v-card-title>
              <v-card-text>
                <v-row>
                  <v-col cols="12" md="4">
                    <validation-provider vid="firstname" :name="trans('First name')" rules="required" v-slot="{ errors }">
                      <v-text-field
                        :dense="isDense"
                        :error-messages="errors"
                        :label="trans('First name')"
                        autofocus
                        class="dt-text-field"
                        outlined
                        prepend-inner-icon="mdi-account-outline"
                        v-model="resource.data.firstname"
                        >
                      </v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col cols="12" md="4">
                    <validation-provider vid="middlename" :name="trans('Middle name')" v-slot="{ errors }">
                      <v-text-field
                        :error-messages="errors"
                        :label="trans('Middle name')"
                        class="dt-text-field"
                        outlined
                        :dense="isDense"
                        v-model="resource.data.middlename"
                      ></v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col cols="12" md="4">
                    <validation-provider vid="lastname" :name="trans('Last name')" rules="required" v-slot="{ errors }">
                      <v-text-field
                        :error-messages="errors"
                        :label="trans('Last name')"
                        class="dt-text-field"
                        outlined
                        :dense="isDense"
                        v-model="resource.data.lastname"
                      ></v-text-field>
                    </validation-provider>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6">
                    <birthday-picker v-model="resource.data.details.birthday.value"></birthday-picker>
                  </v-col>
                  <v-col cols="6">
                    <validation-provider vid="details['gender']" :name="trans('Gender')" v-slot="{ errors }">
                      <v-select
                        :dense="isDense"
                        :error-messages="errors"
                        :items="resource.gender.items"
                        :label="trans('Gender')"
                        :prepend-inner-icon="resource.changeGenderIcon(resource.data.details['gender'])"
                        class="dt-text-field"
                        item-text="key"
                        menu-props="offsetY"
                        outlined
                        return-object
                        background-color="selects"
                        v-model="resource.data.details['gender']"
                        append-icon="mdi-chevron-down"
                        >
                        <template v-slot:item="{ item }">
                          <v-list-item-icon>
                            <v-icon :color="item.color" small v-text="item.icon"></v-icon>
                          </v-list-item-icon>
                          <v-list-item-content>
                            <v-list-item-title v-html="item.key"></v-list-item-title>
                          </v-list-item-content>
                        </template>
                      </v-select>
                    </validation-provider>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12">
                    <validation-provider vid="details['marital-status']" :name="trans('Marital Status')" v-slot="{ errors }">
                      <v-select
                        :dense="isDense"
                        :error-messages="errors"
                        :items="resource.maritalStatus.items"
                        :label="trans('Marital Status')"
                        :prepend-inner-icon="resource.changeMaritalStatusIcon(resource.data.details['marital-status'])"
                        background-color="selects"
                        class="dt-text-field"
                        menu-props="offsetY"
                        outlined
                        return-object
                        v-model="resource.data.details['marital-status']"
                        append-icon="mdi-chevron-down"
                        >
                        <template v-slot:item="{ item }">
                          <v-icon left>{{ item.icon }}</v-icon>
                          <span>{{ item.text }}</span>
                        </template>
                      </v-select>
                    </validation-provider>
                  </v-col>
                </v-row>
              </v-card-text>

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
            </v-card>

            <v-card>
              <v-card-title class="pb-0">{{ trans('Additional Background Details') }}</v-card-title>
              <v-card-text>
                <v-row>
                  <v-col cols="12" md="4">
                    <v-text-field
                      :dense="isDense"
                      class="dt-text-field"
                      dense
                      disabled
                      hide-details
                      label="Mobile Phone"
                      outlined
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" md="8">
                    <v-text-field
                    class="dt-text-field"
                      outlined
                      :dense="isDense"
                      dense
                    ></v-text-field>
                  </v-col>
                </v-row>

                <v-row>
                  <v-col cols="12" md="4">
                    <v-text-field
                      disabled
                      label="Home Address"
                      class="dt-text-field"
                      outlined
                      :dense="isDense"
                      dense
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" md="8">
                    <v-text-field
                    class="dt-text-field"
                      outlined
                      :dense="isDense"
                      dense
                    ></v-text-field>
                  </v-col>
                </v-row>
                <repeater :dense="isDense"></repeater>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col cols="12" md="3">
            <v-card class="mb-3">
              <v-card-title class="pb-0">{{ __('Photo') }}</v-card-title>
              <v-card-text class="text-center">
                <upload-avatar></upload-avatar>
              </v-card-text>
            </v-card>

            <role-card dense class="mb-3" v-model="resource.data.roles"></role-card>

            <v-card class="mb-3">
              <v-card-title>{{ __('Metainfo') }}</v-card-title>
              <div style="overflow-x:scroll;width:100%;">
                <code class="d-block pa-2" v-html="resource.data" style="width:100%;white-space:pre"></code>
              </div>
            </v-card>
          </v-col>
        </v-row>
      </v-form>
    </validation-observer>
  </section>
</template>

<script>
import User from './Models/User'

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
