<template>
  <section>
    <page-header>
      <template v-slot:title v-text="trans('General Settings')"></template>
    </page-header>

    <v-row>
      <v-col cols="12" md="8">
        <v-card>
          <v-card-title v-text="trans('Displaying Data')"></v-card-title>
          <v-subheader class="muted--text" v-text="trans('Formats')"></v-subheader>
          <v-card-text>
            <v-text-field
              :label="trans('Global Date Format')"
              autofocus
              class="mb-3"
              outlined
            ></v-text-field>

            <v-text-field
              :label="trans('Items per Page')"
              autofocus
              class="mb-3"
              outlined
            ></v-text-field>

            <div class="d-flex justify-end">
              <v-btn color="primary" v-text="trans('Save Settings')"></v-btn>
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </section>
</template>

<script>
import store from '@/store'

export default {
  store,
}
</script>
