<template>
  <admin>
    <page-header>
      <template v-slot:title v-text="trans('General Settings')"></template>
    </page-header>

    <v-row>
      <!-- <v-col cols="12" md="9">
        <v-text-field
          :label="trans('Site Name')"
          autofocus
          class="mb-3"
          outlined
        ></v-text-field>

        <v-text-field
          :label="trans('Site Tagline/Description')"
          class="mb-3"
          outlined
        ></v-text-field>

        <v-text-field
          :label="trans('Site Author')"
          class="mb-3"
          outlined
        ></v-text-field>

        <v-text-field
          :label="trans('Site Email')"
          class="mb-3"
          outlined
        ></v-text-field>

        <v-text-field
          :label="trans('Year Published')"
          class="mb-3"
          outlined
        ></v-text-field>
      </v-col> -->

      <v-col cols="12" md="3">
        <v-card>
          <v-card-title class="pb-0">{{ __('Upload Logo') }}</v-card-title>
          <v-card-text class="text-center">
            <upload-avatar name="photo"></upload-avatar>
          </v-card-text>
        </v-card>

        <v-btn
          class="mt-5"
          block
          large
          color="primary"
          v-text="trans('Save Settings')"
        ></v-btn>
      </v-col>
    </v-row>
  </admin>
</template>

<script>
export default {
  name: 'Branding',

  mounted() {
    console.log(this.trans, this.trans('Site Branding'))
  }
}
</script>
