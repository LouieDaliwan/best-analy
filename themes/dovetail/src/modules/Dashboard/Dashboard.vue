<template>
  <admin>
    <metatag :title="trans('All Company')"></metatag>

    <page-header>
      <template v-slot:action>
        <v-btn
          :block="$vuetify.breakpoint.smAndDown"
          large
          color="primary"
          exact
          :to="{ name: 'companies.find' }"
        >
          <v-icon small left>mdi-file-document-box-search-outline</v-icon>
          {{ trans("Find Company") }}
        </v-btn>
      </template>
    </page-header>

    <!-- Data table -->
    <h3 class="mb-3">{{ __("Companies") }}</h3>
    <div v-show="resourcesIsNotEmpty">
      <v-card>
        <toolbar-menu
          :items.sync="tabletoolbar"
          bulk
          downloadable
          trashable
          @update:search="search"
          @update:trash="bulkTrashResource"
        >
        </toolbar-menu>
        <v-slide-y-reverse-transition mode="out-in">
          <v-data-table
            :headers="resources.headers"
            :items="resources.data"
            :loading="resources.loading"
            :mobile-breakpoint="NaN"
            :options.sync="resources.options"
            :server-items-length="resources.meta.total"
            :show-select="tabletoolbar.toggleBulkEdit"
            @update:options="optionsChanged"
            color="primary"
            item-key="id"
            v-model="resources.selected"
          >
            <template v-slot:progress><span></span></template>

            <template v-slot:loading>
              <v-slide-y-transition mode="out-in">
                <div>
                  <div
                    v-for="(j, i) in resources.options.itemsPerPage"
                    :key="i"
                  >
                    <skeleton-table></skeleton-table>
                  </div>
                </div>
              </v-slide-y-transition>
            </template>

            <!-- Name -->
            <template v-slot:item.name="{ item }">
              <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                  <span class="mt-1" v-on="on"
                    ><router-link
                      tag="a"
                      exact
                      :to="{
                        name: 'companies.dashboard',
                        params: { id: item.id }
                      }"
                      v-text="item.name"
                      class="text-no-wrap text--decoration-none"
                    ></router-link
                  ></span>
                </template>
                <span>{{ trans("Company Dashboard") }}</span>
              </v-tooltip>
            </template>
            <!-- Name -->

            <!-- File No. -->
            <template v-slot:item.filenumber="{ item }">
              <span class="text-no-wrap" v-text="item.filenumber"></span>
            </template>
            <!-- File No. -->

            <!-- Counselor. -->
            <template v-slot:item.counselor="{ item }">
              <span class="text-no-wrap" v-text="item.counselor"></span>
            </template>
            <!-- Counselor. -->

            <!-- Modified -->
            <template v-slot:item.updated_at="{ item }">
              <span class="text-no-wrap" :title="item.updated_at">{{
                trans(item.modified)
              }}</span>
            </template>
            <!-- Modified -->

            <!-- Action buttons -->
            <template v-slot:item.action="{ item }">
              <div class="text-no-wrap">
                <!-- Answer Survey -->
                <can code="customers.survey">
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                      <v-btn :to="goToShowIndexPage(item)" icon v-on="on">
                        <v-icon small>mdi-view-grid-outline</v-icon>
                      </v-btn>
                    </template>
                    <span>{{ trans("Answer Survey") }}</span>
                  </v-tooltip>
                </can>
                <!-- Answer Survey -->
                <!-- Edit Financial Statements -->
                <can code="customers.edit">
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                      <v-btn
                        :to="{
                          name: 'companies.edit',
                          params: { id: item.id },
                          query: { tab: 1 }
                        }"
                        icon
                        v-on="on"
                      >
                        <v-icon small>mdi-pencil-outline</v-icon>
                      </v-btn>
                    </template>
                    <span>{{ trans("Edit Financial Statements") }}</span>
                  </v-tooltip>
                </can>
                <!-- Edit Financial Statements -->
                <!-- Show Reports -->
                <can code="customers.survey">
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                      <v-btn
                        :to="{
                          name: 'companies.reports',
                          params: { id: item.id }
                        }"
                        icon
                        v-on="on"
                      >
                        <v-icon small>mdi-file-chart-outline</v-icon>
                      </v-btn>
                    </template>
                    <span>{{ trans("View Reports") }}</span>
                  </v-tooltip>
                </can>
                <!-- Show Reports -->
                <!-- Send Report -->
                <can code="customers.survey">
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                      <span v-on="on"
                        ><send-report-to-crm-button
                          type="overall-report-dashboard"
                          :customer="item.id"
                          :user="item.user_id"
                          :month="null"
                        ></send-report-to-crm-button
                      ></span>
                    </template>
                    <span>{{
                      trans("Send All Score Reports for this month to CRM")
                    }}</span>
                  </v-tooltip>
                </can>
                <!-- Send Report -->
                <!-- Move to Trash -->
                <can code="customers.destroy">
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                      <v-btn
                        @click="askUserToDestroyCompany(item)"
                        icon
                        v-on="on"
                      >
                        <v-icon small>mdi-delete-outline</v-icon>
                      </v-btn>
                    </template>
                    <span>{{ trans("Move to trash") }}</span>
                  </v-tooltip>
                </can>
                <!-- Move to Trash -->
              </div>
            </template>
            <!-- Action buttons -->
          </v-data-table>
        </v-slide-y-reverse-transition>
      </v-card>
    </div>
    <!-- Data table -->

    <!-- Empty state -->
    <div v-if="resourcesIsEmpty">
      <toolbar-menu :items.sync="tabletoolbar" @update:search="search">
      </toolbar-menu>
      <empty-state>
        <template v-slot:actions>
          <v-btn large color="primary" exact :to="{ name: 'companies.find' }">
            <v-icon small left>mdi-file-document-box-search-outline</v-icon>
            {{ trans("Find Company") }}
          </v-btn>
        </template>
      </empty-state>
    </div>
    <!-- Empty state -->

    <can code="teams.dashboard">
      <div>
        <v-card height="50px" flat class="transparent"></v-card>
        <!-- Teams -->
        <h3 class="mb-3">{{ __("All Teams") }}</h3>
        <team-index></team-index>
        <!-- Teams -->
      </div>
    </can>
  </admin>
</template>

<script>
import $api from "./routes/api";
import man from "@/components/Icons/ManThrowingAwayPaperIcon.vue";
import SendReportToCrmButton from "@/modules/Customer/cards/SendReportToCrmButton.vue";
import { mapActions } from "vuex";
import TeamIndex from "./cards/Teams.vue";

export default {
  components: {
    SendReportToCrmButton,
    TeamIndex
  },

  computed: {
    resourcesIsNotEmpty() {
      return !this.resourcesIsEmpty;
    },

    resourcesIsEmpty() {
      return window._.isEmpty(this.resources.data) && !this.resources.loading;
    },

    options: function() {
      return {
        per_page: this.resources.options.itemsPerPage,
        page: this.resources.options.page,
        sort: this.resources.options.sortBy[0] || undefined,
        order: this.resources.options.sortDesc[0] || false ? "desc" : "asc"
      };
    },

    selected: function() {
      return this.resources.selected.map(item => item.id);
    }
  },

  data: () => ({
    api: $api,

    resources: {
      loading: true,
      search: null,
      options: {
        page: 1,
        pageCount: 0,
        itemsPerPage: 10,
        sortDesc: [],
        sortBy: []
      },
      meta: {},
      modes: {
        bulkedit: false
      },
      selected: [],
      headers: [
        {
          text: trans("Company Name"),
          align: "left",
          value: "name",
          class: "text-no-wrap"
        },
        {
          text: trans("File No."),
          align: "left",
          value: "filenumber",
          class: "text-no-wrap"
        },
        {
          text: trans("Business Counselor"),
          align: "left",
          value: "counselor",
          class: "text-no-wrap"
        },
        {
          text: trans("Peer BC"),
          align: "left",
          value: "author",
          class: "text-no-wrap"
        },
        {
          text: trans("Last Modified"),
          value: "updated_at",
          class: "text-no-wrap"
        },
        {
          text: trans("Actions"),
          align: "center",
          value: "action",
          sortable: false,
          class: "muted--text text-no-wrap"
        }
      ],
      data: []
    },

    tabletoolbar: {
      bulkCount: 0,
      isSearching: false,
      search: null,
      listGridView: false,
      toggleBulkEdit: false,
      toggleTrash: false,
      verticaldiv: false
    }
  }),

  methods: {
    ...mapActions({
      errorDialog: "dialog/error",
      loadDialog: "dialog/loading",
      showDialog: "dialog/show",
      hideDialog: "dialog/hide",
      showSnackbar: "snackbar/show"
    }),

    changeOptionsFromRouterQueries() {
      this.options.per_page = this.$route.query.per_page;
      this.options.page = parseInt(this.$route.query.page);
      this.options.search = this.$route.query.search;
      this.resources.search = this.options.search;
      this.tabletoolbar.search = this.options.search;
    },

    optionsChanged(options) {
      this.getPaginatedData(this.options);
    },

    getPaginatedData: function(params = null, caller = null) {
      params = Object.assign(params ? params : this.$route.query, {
        search: this.resources.search
      });
      this.resources.loading = true;
      axios
        .get(this.api.owned(), { params })
        .then(response => {
          this.resources = Object.assign({}, this.resources, response.data);
          console.log(this.resources);
          this.resources.options = Object.assign(
            this.resources.options,
            response.data.meta,
            params
          );
          this.resources.loading = false;
          this.$router
            .push({ query: Object.assign({}, this.$route.query, params) })
            .catch(err => {});
          console.log(this.resources);
        })
        .catch(err => {
          this.errorDialog({
            width: 400,
            buttons: { cancel: { show: false } },
            title: trans("Whoops! An error occured"),
            text: err.response.data.message
          });
        })
        .finally(() => {
          this.resources.data.map(function(data) {
            return Object.assign(data, { loading: false });
          });
        });
    },

    search: _.debounce(function(event) {
      this.resources.search = event.srcElement.value || "";
      this.tabletoolbar.isSearching = false;
      if (this.resources.searching) {
        this.getPaginatedData(this.options, "search");
        this.resources.searching = false;
      }
    }, 200),

    goToShowIndexPage(company) {
      return {
        name: "companies.show",
        params: { id: company.id },
        query: { from: this.$route.fullPath }
      };
    },

    focusSearchBar() {
      this.$refs["tablesearch"].focus();
    },

    sendToCrm(item) {
      let data = {
        Id: this.resources.data.token,
        FileNo: this.resources.data.filenumber,
        OverallScore: item.value["overall:score"],
        FileContentBase64: item.fileContentBase64,
        "Lessons Learnt": item.value["overall:comment"]
      };
      axios.post($api.crm.save(), data).then(response => {
        console.log(response);
      });
    },

    bulkTrashResource() {
      let selected = this.selected;
      axios
        .delete($api.destroy(null), { data: { id: selected } })
        .then(response => {
          this.getPaginatedData(null, "bulkTrashResource");
          this.tabletoolbar.toggleTrash = false;
          this.tabletoolbar.toggleBulkEdit = false;
          this.hideDialog();
          this.showSnackbar({
            text: trans_choice(
              "Company successfully moved to trash",
              this.tabletoolbar.bulkCount
            )
          });
        })
        .catch(err => {
          this.errorDialog({
            width: 400,
            buttons: { cancel: { show: false } },
            title: trans("Whoops! An error occured"),
            text: err.response.data.message
          });
        });
    },

    askUserToDestroyCompany(item) {
      this.showDialog({
        color: "warning",
        illustration: man,
        illustrationWidth: 200,
        illustrationHeight: 160,
        width: "420",
        title: "You are about to move to trash the selected company.",
        text: [
          "Some data related to company will still remain.",
          trans("Are you sure you want to move :name to Trash?", {
            name: item.name
          })
        ],
        buttons: {
          cancel: { show: true, color: "link" },
          action: {
            text: "Move to Trash",
            color: "warning",
            callback: dialog => {
              this.loadDialog(true);
              this.destroyResource(item);
            }
          }
        }
      });
    },

    destroyResource(item) {
      (item.loading = true),
        axios
          .delete($api.destroy(item.id))
          .then(response => {
            item.active = false;
            this.getPaginatedData(null, "destroyResource");
            this.showSnackbar({
              text: trans_choice("Company successfully moved to trash", 1)
            });
            this.hideDialog();
          })
          .catch(err => {
            this.errorDialog({
              width: 400,
              buttons: { cancel: { show: false } },
              title: trans("Whoops! An error occured"),
              text: err.response.data.message
            });
          })
          .finally(() => {
            item.active = false;
            item.loading = false;
          });
    }
  },

  mounted: function() {
    this.changeOptionsFromRouterQueries();
  },

  watch: {
    "resources.search": function(val) {
      this.resources.searching = true;
    },

    "resources.selected": function(val) {
      this.tabletoolbar.bulkCount = val.length;
    },

    "tabletoolbar.toggleBulkEdit": function(val) {
      if (!val) {
        this.resources.selected = [];
      }
    }
  }
};
</script>
