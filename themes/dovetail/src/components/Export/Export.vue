<template>
  <v-row justify="center">
    <v-dialog v-model="dataset.show" persistent max-width="460">
      <template v-slot:activator="{ on }">
        <v-btn color="primary" dark v-on="on">Open Dialog</v-btn>
      </template>
      <v-card>
        <div class="text-center pa-5">
          <download-icon width="120" height="120"></download-icon>
        </div>
        <v-card-title class="pb-0">{{ trans('Select format to download') }}</v-card-title>
        <v-card-text>{{ trans('Export data to a specific file type.') }}</v-card-text>
        <v-card-text>
          <v-text-field
            dense
            label="File Name"
            outlined
            value="filename-export-20-01-15-113820"
          ></v-text-field>
          <v-select
            :items="dataset.items"
            append-icon="mdi-chevron-down"
            background-color="selects"
            dense
            flat
            height="40px"
            item-text="name"
            label="Select file type"
            solo
            >
            <template v-slot:prepend-item>
              <div class="link--text body-2 py-3 px-5">Presentable</div>
            </template>
            <template v-slot:item ="{ item }">
              <v-list-item-icon>
                <v-icon :color="item.color" small v-text="item.icon"></v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title v-html="item.name"></v-list-item-title>
              </v-list-item-content>
            </template>
            <template v-slot:prepend-item>
              <div class="link--text body-2 py-3 px-5">Presentable</div>
            </template>
          </v-select>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="link" text @click="dataset.show = false">Cancel</v-btn>
          <v-btn color="primary" text @click="dataset.show = false">Export</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Export',

  computed: {
    ...mapGetters({
      export: 'export/export'
    }),
  },

  data: () => ({
    dataset: {},
  }),

  mounted () {
    this.dataset = Object.assign({}, this.export, this.items)
  },
}
</script>
