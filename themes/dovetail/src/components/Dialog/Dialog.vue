<template>
  <v-dialog
    v-model="dialog.show"
    :persistent="dialog.persistent"
    :max-width="dialog.maxWidth"
    :width="width || dialog.width"
    >
    <v-card :class="{ 'text-xs-center': dialog.alignment == 'center' }">
      <slot name="illustration"></slot>
      <v-card-title class="headline">
        <slot name="title">{{ trans(dialog.title) }}</slot>
      </v-card-title>
      <v-card-text>
        <slot name="text">{{ trans(dialog.text) }}</slot>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>

        <v-btn
          v-if="dialog.buttons.cancel.show"
          :color="dialog.buttons.cancel.color"
          @click.native="dialog.buttons.cancel.callback()"
          text
          v-text="trans(dialog.buttons.cancel.text)"
          >
        </v-btn>

        <v-btn
          v-if="dialog.buttons.action.show"
          :color="dialog.buttons.action.color"
          @click.native="dialog.buttons.action.callback()"
          text
          v-text="trans(dialog.buttons.action.text)"
          >
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Dialogbox',

  props: ['width'],

  computed: {
    ...mapGetters({
      dialog: 'dialog/dialog'
    })
  },
}
</script>
