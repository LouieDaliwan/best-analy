<template>
  <v-dialog
    v-model="dialog.show"
    :persistent="dialog.persistent"
    :max-width="dialog.maxWidth"
    :width="width || dialog.width"
    >
    <v-card :dark="dialog.dark" :class="{ 'text-xs-center': dialog.alignment == 'center' }">
      <slot name="illustration">
        <div class="text-center pa-3" :class="`${dialog.color}--text`">
          <component :width="dialog.illustrationWidth" :height="dialog.illustrationHeight" :is="dialog.illustration"></component>
        </div>
      </slot>
      <v-card-title class="pb-0">
        <slot name="title">{{ trans(dialog.title) }}</slot>
      </v-card-title>
      <v-card-text>
        <slot name="text"><div v-html="text"></div></slot>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>

        <v-btn
          v-if="dialog.buttons.cancel.show"
          :color="dialog.buttons.cancel.color"
          @click.native="dialog.buttons.cancel.callback()"
          text
          >
          {{ trans(dialog.buttons.cancel.text) }}
        </v-btn>

        <v-btn
          :color="dialog.buttons.action.color"
          :disabled="dialog.loading"
          :loading="dialog.loading"
          @click.native="dialog.buttons.action.callback(dialog)"
          text
          v-if="dialog.buttons.action.show"
          >
          {{ trans(dialog.buttons.action.text) }}
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
    }),

    text: function () {
      if (this.dialog.text instanceof Array) {
        return this.dialog.text.map((text) => {
          return '<p>'+this.trans(text)+'</p>'
        }).join('')
      }

      return this.dialog.text
    }
  },
}
</script>
