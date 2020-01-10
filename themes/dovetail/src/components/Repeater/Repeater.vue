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
              <p class="muted--text font-weight-bold mb-0" v-text="trans('No items yet')"></p>
              <p class="muted--text" v-text="trans('Start adding key-value pairs.')"></p>
            </slot>
          </v-card-text>

          <v-badge
            color="dark"
            transition="fade-transition"
            offset-y="20"
            offset-x="20"
            class="dt-badge"
            bottom
            tile
            v-model="$store.getters['shortkey/ctrlIsPressed']"
            >
            <template v-slot:badge>
              <div class="small" style="font-size: 11px">d</div>
            </template>
            <v-btn class="mt-3" v-shortkey="['ctrl', 'd']" @shortkey="add" @click="add">
              <v-icon left>{{ addButtonIcon }}</v-icon>
              {{ trans(addButtonText) }}
            </v-btn>
          </v-badge>
        </div>
      </slot>
    </template>

    <v-row align="center" :key="i" v-for="(item, i) in repeaters">
      <v-col md="4" sm="6">
        <v-text-field
          :label="trans('Key')"
          outlined
          hide-details
          autocomplete="off"
          autofocus
          v-shortkey.avoid
          class="dt-repeater--key"
          v-model="item.key"
          ></v-text-field>
      </v-col>
      <v-col>
        <v-text-field
          :label="trans('Value')"
          outlined
          hide-details
          autocomplete="off"
          class="dt-repeater--value"
          v-model="item.value"
        ></v-text-field>
      </v-col>
      <v-col cols="auto">
        <context-prompt>
          <v-card max-width="280">
            <v-card-title>{{ trans('Remove Item') }}</v-card-title>
            <v-card-text>{{ trans('Doing so will permanently remove the key-value pair from the list. Are you sure you want to proceed?') }}</v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="error" text @click.prevent="remove(i)">{{ trans('Remove') }}</v-btn>
            </v-card-actions>
          </v-card>
        </context-prompt>
      </v-col>
    </v-row>

    <v-row v-if="repeaters.length" no-gutters>
      <v-col>
        <slot name="action" :on="{on: add}">
          <v-badge
            color="dark"
            transition="fade-transition"
            offset-y="20"
            offset-x="20"
            class="dt-badge"
            bottom
            tile
            v-model="$store.getters['shortkey/ctrlIsPressed']"
            >
            <template v-slot:badge>
              <div class="small" style="font-size: 11px">d</div>
            </template>
            <v-btn class="mt-3" v-shortkey="['ctrl', 'd']" @shortkey="add" @click="add">
              <v-icon left>{{ addButtonIcon }}</v-icon>
              {{ trans(addButtonText) }}
            </v-btn>
          </v-badge>
        </slot>
      </v-col>
    </v-row>
  </section>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Repeater',

  props: {
    value: {
      type: Array,
    },
    addButtonText: {
      type: String,
      default: 'Add Item',
    },
    addButtonIcon: {
      type: String,
      default: 'mdi-plus-circle-outline',
    },
  },

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
