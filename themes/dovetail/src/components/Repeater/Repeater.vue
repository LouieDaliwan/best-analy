<template>
  <section>
    <template v-if="! repeaters.length">
      <slot name="empty-state">
        <div class="text-center">
          <v-card-text style="filter: grayscale(0.9);">
            <empty-icon width="300" height="auto"></empty-icon>
          </v-card-text>

          <v-card-text>
            <slot name="text">
              <p class="muted--text font-weight-bold mb-0" v-text="trans('No resource found')"></p>
              <p class="muted--text" v-text="trans('This page returned empty results.')"></p>
            </slot>
          </v-card-text>

          <v-btn color="secondary" @click.prevent="add" large>
            <v-icon left>mdi-plus-circle-outline</v-icon>
            {{ trans('Add Item') }}
          </v-btn>
        </div>
      </slot>
    </template>

    <v-row align="center" :key="i" v-for="(item, i) in repeaters">
      <v-col cols="auto">
        <v-text-field
          :label="trans('Key')"
          outlined
          hide-details
          autocomplete="off"
          v-model="item.key"
          ></v-text-field>
      </v-col>
      <v-col>
        <v-text-field
          :label="trans('Value')"
          outlined
          hide-details
          autocomplete="off"
          v-model="item.value"
        ></v-text-field>
      </v-col>

      <v-col cols="1" align-center>
        <context-prompt>
          <v-card max-width="280">
            <v-card-title>{{ trans('Remove Item') }}</v-card-title>
            <v-card-text>{{ trans('Doing so will permanently remove the key-value pair from the list. Are you sure you want to proceed?') }}</v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn text @click.prevent="remove(i)">{{ trans('Remove') }}</v-btn>
            </v-card-actions>
          </v-card>
        </context-prompt>
      </v-col>
    </v-row>
    <v-row v-if="repeaters.length" no-gutters>
      <v-col>
        <slot name="action" :on="{on: add}">
          <v-btn @click.prevent="add" large>
            <v-icon left>mdi-plus-circle-outline</v-icon>
            {{ trans('Add Item') }}
          </v-btn>
        </slot>
      </v-col>
    </v-row>
  </section>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Repeater',

  props: ['value'],

  computed: {
    ...mapGetters({
      defaults: 'repeater/defaults',
      template: 'repeater/template',
      items: 'repeater/items',
    }),

    repeaters: function () {
      return window._.merge([], this.items, this.value)
    },
  },

  methods: {
    add: function () {
      this.repeaters.push(this.template)
      this.$store.dispatch('repeater/set', this.repeaters)
      this.$emit('input', this.items)
    },
    remove: function (i) {
      this.repeaters.splice(i, 1)
      this.$store.dispatch('repeater/set', this.repeaters)
      this.$emit('input', this.items)
    },
  }
}
</script>
