<template>
  <v-dialog
    v-model="modal.show"
    :persistent="modal.persistent"
    :max-width="modal.maxWidth"
    :width="width || modal.width"
    >
    <v-card :class="{ 'text-xs-center': modal.alignment == 'center' }">
      <slot name="illustration"></slot>
      <v-card-title class="headline">
        <slot name="title">{{ trans(modal.title) }}</slot>
      </v-card-title>
      <v-card-text>
        <slot name="text">{{ trans(modal.text) }}</slot>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>

        <v-btn
          v-if="modal.buttons.cancel.show"
          :color="modal.buttons.cancel.color"
          @click.native="modal.buttons.cancel.callback()"
          text
          v-text="trans(modal.buttons.cancel.text)"
          >
        </v-btn>

        <v-btn
          v-if="modal.buttons.action.show"
          :color="modal.buttons.action.color"
          @click.native="modal.buttons.action.callback()"
          text
          v-text="trans(modal.buttons.action.text)"
          >
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Modal',

  props: ['width'],

  computed: {
    ...mapGetters({
      modal: 'modal/modal'
    })
  },
}
</script>
