<template>
  <div class="add-overall-comment">
    <v-dialog
      v-model="open"
      width="500"
      >
      <template v-slot:activator="{ on }">
        <a v-on="on" class="dt-link text--decoration-none mr-4">
          <v-icon small left>mdi-comment-text-multiple-outline</v-icon>
          {{ trans('Edit Overall Comment') }}
        </a>
      </template>

      <v-card>
        <v-card-title
          class="headline"
          primary-title
          v-text="trans('Overall Comment')"
          />
        <v-card-text>
          <v-textarea
            :label="trans('Specify Comment for this Overall Report')"
            name="input-7-1"
            outlined
            auto-grow
            row="3"
            v-model="comment"
          ></v-textarea>
        </v-card-text>
        <v-card-actions>
          <v-btn
            @click="open = false"
            class="ml-3 mr-0"
            large
            text
            >
            {{ trans('Cancel') }}
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn
            @click.prevent="submit(comment)"
            class="ml-3 mr-0"
            color="primary"
            large
            text
            type="submit"
            >
            {{ trans('Update') }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import $auth from '@/core/Auth/auth'

export default {
  props: ['text', 'month'],

  data: () => ({
    open: false,
    comment: '',
  }),

  methods: {
    getOverallComment () {
      let customer = this.$route.params.id
      let user = this.$route.query.user_id || $auth.getId()

      axios.get(
        `/api/v1/reports/overall/customer/${customer}/user/${user}`
      ).then(response => {
        this.comment = response.data['overall:comment']
      })
    },

    submit (comment) {
      let data = {
        customer_id: this.$route.params.id,
        key: this.month,
        value: comment
      }
      axios.post(
        '/api/v1/settings/overall/comment', data
      ).then(response => {
        this.open = false
        window.location.reload()
      })
    },
  },

  mounted () {
    this.getOverallComment()
  },
}
</script>
