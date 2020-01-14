<template>
  <section>
    <page-header>
      <template v-slot:title>
        {{ trans('Edit User') }}
      </template>
      <template v-slot:action>
        <v-btn large color="primary" exact>
          <v-icon left>mdi-content-save-outline</v-icon>
          {{ trans("Update") }}
        </v-btn>
      </template>
    </page-header>

    <v-row>
      <v-col cols="12" md="9">
        <v-card class="mb-3">
          <v-card-title class="pb-0">{{ trans('Personal Information') }}</v-card-title>
          <v-card-text>
            <v-row>
              <v-col cols="12" md="4">
                <v-text-field
                  autofocus
                  hide-details
                  label="First Name"
                  outlined
                  >
                  <template v-slot:prepend-inner>
                    <v-icon size="20" class="mr-2">mdi-account-outline</v-icon>
                  </template>
                </v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field
                  hide-details
                  label="Middle Name"
                  outlined
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field
                  hide-details
                  label="Last Name"
                  outlined
                ></v-text-field>
              </v-col>
            </v-row>
          </v-card-text>

          <v-card-title class="pb-0">
            {{ trans('Additional Background Details') }}
            &nbsp;
            <span class="font-weight-regular muted--text">({{ trans('optional') }})</span>
          </v-card-title>
          <v-card-text>
            <v-row>
              <v-col cols="12" md="4">
                <v-text-field
                  disabled
                  hide-details
                  label="Gender"
                  outlined
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="8">
                <v-select
                  :items="['Male', 'Female']"
                  hide-details
                  append-icon="mdi-chevron-down"
                  label="Select Gender"
                  outlined
                  >
                </v-select>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="12" md="4">
                <v-text-field
                  disabled
                  hide-details
                  label="Mobile Phone"
                  outlined
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="8">
                <v-text-field
                  hide-details
                  outlined
                ></v-text-field>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="12" md="4">
                <v-text-field
                  disabled
                  hide-details
                  label="Home Address"
                  outlined
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="8">
                <v-text-field
                  hide-details
                  outlined
                ></v-text-field>
              </v-col>
            </v-row>
            <repeater></repeater>
          </v-card-text>
        </v-card>

        <v-card>
          <v-card-title class="pb-0">{{ trans('Account') }}</v-card-title>
          <p class="muted--text px-4 mb-0">{{ trans('Fields will be used to sign in to the app') }}</p>
          <v-card-text>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  label="Email Address"
                  hide-details
                  outlined
                  >
                  <template v-slot:prepend-inner>
                    <v-icon size="20" class="mr-2">mdi-email-outline</v-icon>
                  </template>
                </v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="Username"
                  hide-details
                  outlined
                  >
                  <template v-slot:prepend-inner>
                    <v-icon size="20" class="mr-2">mdi-account-circle-outline</v-icon>
                  </template>
                </v-text-field>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                  label="Password"
                  hide-details
                  outlined
                  type="password"
                  >
                  <template v-slot:prepend-inner>
                    <v-icon size="20" class="mr-2">mdi-lock-outline</v-icon>
                  </template>
                </v-text-field>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                  label="Retype Password"
                  hide-details
                  outlined
                  type="password"
                  >
                  <template v-slot:prepend-inner>
                    <v-icon size="20" class="mr-2">mdi-lock-outline</v-icon>
                  </template>
                </v-text-field>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="12" md="3">
        <v-card class="mb-3">
          <v-card-title>{{ __('Photo') }}</v-card-title>
        </v-card>
        <v-card class="mb-3">
          <v-card-title>{{ __('Roles') }}</v-card-title>
        </v-card>
        <v-card class="mb-3">
          <v-card-title>{{ __('Metainfo') }}</v-card-title>
        </v-card>
      </v-col>
    </v-row>
  </section>
</template>

<script>
export default {
  data: () => ({
  }),
}
</script>
