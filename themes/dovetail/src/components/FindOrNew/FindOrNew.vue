<template>
  <v-card>
    <v-card-title>{{ trans('Card Title') }}</v-card-title>
    <v-card-text>
      <v-select
        :items="items"
        item-text="name"
        :label="trans('Customer')"
        class="dt-text-field"
        menu-props="offsetY"
        hide-details
        outlined
        return-object
        background-color="selects"
        append-icon="mdi-chevron-down"
        >
        <template v-slot:item="{ item }">
          <v-list-item-icon>
            <v-icon :color="item.color" small v-text="item.icon"></v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title v-html="item.name"></v-list-item-title>
          </v-list-item-content>
        </template>
      </v-select>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-dialog v-model="addNew" persistent max-width="420">
        <template v-slot:activator="{ on }">
          <v-btn text large v-on="on">
            <v-icon small left>mdi-plus</v-icon>
            {{ trans('Add new') }}
          </v-btn>
        </template>
        <v-card>
          <v-card-title>{{ trans('Add New Resource') }}</v-card-title>
          <v-card-text>
            <v-text-field
              :label="trans('Name')"
              class="dt-text-field"
              outlined
            ></v-text-field>
            <v-text-field
              :label="trans('Code')"
              class="dt-text-field"
              outlined
            ></v-text-field>
            <v-select
              :items="['mdi-home', 'mdi-pencil-outline']"
              :label="trans('Icon')"
              class="dt-text-field"
              menu-props="offsetY"
              outlined
              background-color="selects"
              append-icon="mdi-chevron-down"
              >
            </v-select>
            <v-textarea
              label="Description"
              auto-grow
              outlined
              rows="3"
              row-height="34"
            ></v-textarea>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="link" text @click="addNew = false">Cancel</v-btn>
            <v-btn color="primary" text @click="addNew = false">Add</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-card-actions>
  </v-card>
</template>


<script>
  export default {
    data: () => ({
      items: [
        { name: 'test', icon: 'mdi-home' }
      ],
      addNew: false,
    }),
  }
</script>
