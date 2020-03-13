<template>
  <section>
    <validation-provider vid="manager_id" :name="trans('manager_id')" rules="required" v-slot="{ errors }">
      <v-autocomplete
        :dense="dense"
        :disabled="isUpdating"
        :error-messages="errors"
        :hide-details="!errors.length"
        :items="managers"
        :label="trans('Team Manager')"
        :placeholder="trans('Search manager')"
        @focus="getTeamsData"
        background-color="selects"
        chips
        class="dt-text-field"
        menu-props="offsetY"
        outlined
        ref="manager_id"
        v-model="manager"
        >
        <template v-slot:selection="{ item, manager }">
          <v-chip
            v-bind="item.attrs"
            :input-value="item.selected"
            close
            @click:close="remove(manager)"
          >
            <v-avatar left>
              <v-img :src="item.avatar"></v-img>
            </v-avatar>
            {{ item.text }}
          </v-chip>
        </template>
        <template v-slot:item="{ item }">
          <v-list-item-avatar>
            <img :src="item.avatar">
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title v-html="item.text"></v-list-item-title>
          </v-list-item-content>
        </template>
      </v-autocomplete>
    </validation-provider>
    <!-- <input type="hidden" name="manager_id" v-model="manager"> -->
  </section>
</template>

<script>
import $api from '@/modules/Team/routes/api'

export default {
  name: 'ManagerPicker',

  props: {
    value: {
      type: [Array, Object, String, Number],
    },
    dense: {
      type: Boolean,
    },
    errors: {
      type: [Array, Object],
    },
    lazyLoad: {
      type: Boolean,
    },
  },

  computed: {
    manager: {
      get () {
        return this.value[0]
      },
      set (value) {
        this.$emit('input', [value])
      },
    },

    managers () {
      return this.items.map(function (manager) {
        return {
          value: manager.id,
          text: manager.displayname,
          avatar: manager.avatar,
        }
      })
    }
  },

  data: () => ({
    items: [],
    isUpdating: false
  }),

  methods: {
    getTeamsData () {
      if (window._.isEmpty(this.items)) {
        axios.get($api.users.list(), { params: { per_page: 'all' } })
          .then(response => {
            this.items = response.data.data
          })
      }
    },

    remove (manager) {
      this.manager = null
    },
  },

  mounted () {
    if (!this.lazyLoad) {
      this.getTeamsData()
    }
  }
}
</script>
