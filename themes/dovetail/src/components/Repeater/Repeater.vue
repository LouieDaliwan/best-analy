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

          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn v-on="on" v-shortkey="['ctrl', 'd']" @shortkey="add" @click="add" color="secondary" large>
                <v-icon left>mdi-plus-circle-outline</v-icon>
                {{ trans('Add Item') }}
              </v-btn>
            </template>
            <span v-text="trans('ctrl+d')"></span>
          </v-tooltip>
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
          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn v-on="on" v-shortkey="['ctrl', 'd']" @shortkey="add" @click="add" large>
                <v-icon left>mdi-plus-circle-outline</v-icon>
                {{ trans('Add Item') }}
              </v-btn>
            </template>
            <span v-text="trans('ctrl+d')"></span>
          </v-tooltip>
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
