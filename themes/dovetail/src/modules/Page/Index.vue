<template>
  <section>
    <template v-if="dataset.loaded">
      <v-container grid-list-lg>
        <v-layout row wrap>
          <v-flex xs12>
            <toolbar-menu :items="toolbar"></toolbar-menu>
            <v-card class="sticky">
              <v-data-table
                :headers="resources.headers"
                :items="resources.items"
                :pagination.sync="resources.pagination"
                class="elevation-1"
                item-key="title"
                select-all
                v-model="resources.selected"
                >
                <template slot="headers" slot-scope="props">
                  <tr>
                    <th v-show="resources.showBulk">
                      <v-checkbox
                        :indeterminate="props.indeterminate"
                        :input-value="props.all"
                        @click.stop="toggleAll"
                        hide-details
                        primary
                        >
                      </v-checkbox>
                    </th>
                    <th
                      v-for="header in props.headers"
                      :key="header.text"
                      :class=" [
                        'column sortable',
                        resources.pagination.descending ? 'desc' : 'asc',
                        header.value === resources.pagination.sortBy ? 'active' : ''
                      ]"
                      @click="changeSort(header.value)"
                      >
                      {{ header.text }}
                      <v-icon small>arrow_upward</v-icon>
                    </th>
                  </tr>
                </template>
                <template slot="items" slot-scope="props">
                  <tr
                    :active="props.selected"
                    @click="props.selected = !props.selected"
                    >
                    <td v-show="resources.showBulk">
                      <v-checkbox
                        :input-value="props.selected"
                        primary
                        hide-details
                      ></v-checkbox>
                    </td>
                    <td v-html="props.item.id"></td>
                    <td class="table--ellipsis">
                      <v-tooltip
                        max-width="300"
                        bottom
                        >
                        <span slot="activator" v-html="trans(props.item.title)"></span>
                        <span v-html="trans(props.item.title)"></span>
                      </v-tooltip>
                    </td>
                    <td v-html="props.item.author"></td>
                    <td v-html="props.item.created"></td>
                    <td v-html="props.item.modified"></td>
                    <td class="layout mx-0 justify-center">
                      <v-tooltip bottom>
                        <v-btn
                          slot="activator"
                          icon
                          :to="{
                            name: 'pages.show',
                            params: {
                              code: props.item.code,
                              meta: { item: props.item }
                            },
                          }"
                          >
                          <v-icon
                            small
                            class="mx-3"
                            >
                            mdi-open-in-new
                          </v-icon>
                        </v-btn>
                      </v-tooltip>
                      <v-tooltip bottom>
                        <v-btn
                          slot="activator"
                          icon
                          :to="{
                            name: 'pages.edit',
                            params: {
                              id: props.item.id,
                              meta: { item: props.item }
                            },
                          }"
                          >
                          <v-icon
                            small
                            class="mx-3"
                            >
                            mdi-circle-edit-outline
                          </v-icon>
                        </v-btn>
                        <span>{{ trans('Edit') }}</span>
                      </v-tooltip>
                      <v-tooltip bottom>
                        <v-btn
                          @click.prevent="destroyData(props.item.id)"
                          slot="activator"
                          icon
                          >
                          <v-icon
                            small
                            class="mx-3"
                            >
                            mdi-delete-outline
                          </v-icon>
                        </v-btn>
                        <span>
                          {{ trans('Move to Trash') }}
                        </span>
                      </v-tooltip>
                    </td>
                  </tr>
                </template>
              </v-data-table>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </template>

    <template v-else>
      <v-card flat class="transparent">
        <v-card-text>
          <empty-state></empty-state>
        </v-card-text>
      </v-card>
    </template>
  </section>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'
import EmptyState from './partials/EmptyState'

export default {
  store,
  name: 'Index',

  components: {
    EmptyState
  },

  data () {
    return {
      dataset: {
        loaded: true,
      },
      bulk: {
        destroy: {
          model: false,
        },
      },
      toolbar: {
        title: 'All Pages',
        color: '',
        listGridView: false,
        createBtn: {
          name: 'pages.create',
        },
        trashedBtn: {
          name: 'pages.trashed',
        },
        showBulk: false,
      },
      resources: {
        items: [],
        selected: [],
        data: null,
        pagination: {
          sortBy: 'title'
        },
        headers: [
          { text: 'ID', align: 'left', value: 'id' },
          { text: 'Title', align: 'left', value: 'title' },
          { text: 'Author', align: 'left', value: 'user_id' },
          { text: 'Created', align: 'left', value: 'created_at' },
          { text: 'Modified', align: 'left', value: 'updated_at' },
          { text: 'Actions', align: 'center', sortable: false },
        ],
      },
    }
  },

  mounted () {
    axios
      .get('/api/v1/pages/all')
      .then(response => {
        this.resources.items = response.data.data
      })
  },

  methods: {
    toggleAll () {
      if (this.resources.selected.length) this.resources.selected = []
      else this.resources.selected = this.items.slice()
    },

    changeSort (column) {
      if (this.resources.pagination.sortBy === column) {
        this.resources.pagination.descending = !this.resources.pagination.descending
      } else {
        this.resources.pagination.sortBy = column
        this.resources.pagination.descending = false
      }
    },

    destroyData(id) {
      axios
        .delete(`/api/v1/pages/destroy/${id}`)
        .then((response) => {
          this.resources.items.splice(this.resources.items.indexOf(id), 1);
        })
    },

    clickbulk () {
      this.dataset.showBulk = !this.dataset.showBulk
    }
  }
}
</script>
