<template>
  <v-card>
    <v-card-text class="pa-7">
      <div class="d-flex align-center justify-space-between mb-5">
        <h3 v-text="trans('Reports List')"></h3>
      </div>
      <v-divider class="mb-5"></v-divider>
        <div v-show="resourcesIsNotEmpty">
          <v-card>
            <!-- <toolbar-menu :items.sync="tabletoolbar" @update:search="search">
            <template v-slot:filter>
                <monthly-picker></monthly-picker>
            </template>
            </toolbar-menu> -->
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
                  <template v-slot:item.key="{ item }">
                  <v-tooltip bottom>
                      <template v-slot:activator="{ on }">
                      <span class="mt-1" v-on="on"
                          ><router-link
                          tag="a"
                          exact
                          :to="goToShowPage(item)"
                          v-text="item.key"
                          class="text-no-wrap text--decoration-none"
                          ></router-link
                      ></span>
                      </template>
                      <span>{{ trans("View Preview Report") }}</span>
                  </v-tooltip>
                  </template>
                  <!-- Name -->

                  <!-- Created -->
                  <template v-slot:item.created_at="{ item }">
                  <span class="text-no-wrap" :title="item.created_at">{{
                      trans(item.created)
                  }}</span>
                  </template>
                  <!-- Created -->

                  <!-- Author -->
                  <template v-slot:item.user_id="{ item }">
                  <span class="text-no-wrap" v-text="item.author"></span>
                  </template>
                  <!-- Author -->
              </v-data-table>
            </v-slide-y-reverse-transition>
          </v-card>
        </div>

      <!-- Empty state -->
        <div v-if="resourcesIsEmpty">
          <v-card flat>
            <v-card-text class="text-center">
              <h3 class="muted--text" v-text="trans('No reports available')"></h3>
              <p class="muted--text mb-0" v-text="trans('Start by answering an SME rating survey.')"></p>
            </v-card-text>
          </v-card>
        </div>
        <!-- Empty state -->
      </div>
    </v-card-text>
  </v-card>

</template>

<script>
import Company from "../../Models/Company";
import $api from "../../routes/api";
import $auth from "@/core/Auth/auth";
import { mapActions } from "vuex";
import SendReportToCrmButton from "@/modules/Customer/cards/SendReportToCrmButton.vue";
import SendIndividualReportToCrmButton from "@/modules/Customer/cards/SendIndividualReportToCrmButton.vue";

    export default {
        components: {
            SendReportToCrmButton,
            SendIndividualReportToCrmButton
        },
        computed: {
            resourcesIsNotEmpty() {
                return !this.resourcesIsEmpty;
            },

            resourcesIsEmpty() {
                return window._.isEmpty(this.resources.data) && !this.resources.loading;
            },

            allReportPresent() {
            return this.resources.data.length == 4;
            },

            financialReportHasValue() {
            return this.resource.data.is_fs_has_no_zero_value;
            }
        },
        data: () => ({
            tabletoolbar: {
                bulkCount: 0,
                isSearching: false,
                search: null,
                listGridView: false,
                toggleBulkEdit: false,
                toggleTrash: false,
                verticaldiv: false
            },

            resource: new Company(),
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
                    text: trans("Report Type"),
                    align: "left",
                    value: "key",
                    class: "text-no-wrap"
                    },
                    {
                    text: trans("Generated By"),
                    align: "left",
                    value: "user_id",
                    class: "text-no-wrap"
                    },
                    {
                    text: trans("Site Visit Date"),
                    align: "center",
                    value: "remarked",
                    class: "text-no-wrap"
                    },
                    // {
                    // text: trans("Actions"),
                    // align: "center",
                    // value: "action",
                    // sortable: false,
                    // class: "muted--text text-no-wrap"
                    // }
                ],
                data: []
            },
        }),

        methods: {
            ...mapActions({
                errorDialog: "dialog/error",
                loadDialog: "dialog/loading",
                showDialog: "dialog/show",
                hideDialog: "dialog/hide",
                showSnackbar: "snackbar/show"
            }),

            optionsChanged(options) {
                this.getPaginatedData(this.options);
            },

            changeOptionsFromRouterQueries() {
                this.options.per_page = this.$route.query.per_page;
                this.options.page = parseInt(this.$route.query.page);
                this.options.search = this.$route.query.search;
                this.resources.search = this.options.search;
                this.tabletoolbar.search = this.options.search;
            },

            search: _.debounce(function(event) {
                this.resources.search = event.srcElement.value || "";
                this.tabletoolbar.isSearching = false;
                if (this.resources.searching) {
                    this.getPaginatedData(this.options, "search");
                    this.resources.searching = false;
                }
            }, 200),

            load(val = true) {
                this.resource.loading = val;
            },

            goToShowPage(item) {
                return {
                    name: "reports.show",
                    params: { id: this.$route.params.id, report: item.id }
                };
            },

            goToSurveyPage(item) {
                return {
                    name: "companies.response",
                    query: { month: item.remarks },
                    params: {
                    id: this.$route.params.id,
                    taxonomy: item.value["current:index"]["taxonomy"]["id"] || null,
                    survey: item.value["survey:id"]
                    }
                };
            },

            previewPDFReport(item) {
                window.open(
                    `/best/reports/pdf/preview?report_id=${item.id}&type=index`,
                    "_blank"
                );
            },

            previewRatiosReport() {
                this.$router.push({
                    name: "reports.ratios",
                    query: {
                    type: "ratios",
                    user_id: $auth.getId()
                    },
                    params: { id: this.$route.params.id }
                });
            },

            previewOverallReport() {
                this.$router.push({
                    name: "reports.overall",
                    query: {
                    type: "overall",
                    user_id: $auth.getId(),
                    month: this.resources.options.month
                    },
                    params: {
                    id: this.$route.params.id,
                    month: this.resources.options.month
                    }
                });
            },

            deleteResource(item) {
                item.loading = true;
                axios.delete($api.reports.delete(item.id))
                .then(response => {
                item.active = false;
                this.getPaginatedData(null);
                this.hideDialog();
                this.showSnackbar({
                    text: trans_choice("Report successfully deleted", 1)
                });
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
            },

            getPaginatedData(params = null, caller = null) {
                params = Object.assign(params ? params : this.$route.query, {
                    search: this.resources.search
                });
                this.resources.loading = true;
                axios.get($api.reports.list(this.$route.params.id), { params })
                    .then(response => {
                    this.resources = Object.assign({}, this.resources, response.data);
                    this.resources.options = Object.assign(
                        this.resources.options,
                        response.data.meta,
                        params
                    );
                    this.resources.loading = false;
                    this.$router
                        .push({ query: Object.assign({}, this.$route.query, params) })
                        .catch(err => {});
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

            getResource() {
                this.resource.loading = true;
                this.resource.isPrestine = false;
                axios.get($api.show(this.$route.params.id))
                .then(response => {
                this.resource.data = response.data.data;
                })
                .finally(() => {
                this.load(false);
                this.resource.isPrestine = true;
                });
            },
            
            askUserToDestroyReport(item) {
                this.showDialog({
                    color: "error",
                    illustration: () =>
                    import("@/components/Icons/ManThrowingAwayPaperIcon.vue"),
                    illustrationWidth: 200,
                    illustrationHeight: 160,
                    width: "420",
                    title: "You are about to permanently delete the selected report.",
                    text: [
                    "Some data related to report will still remain.",
                    trans("Are you sure you want to permanently delete :name?", {
                        name: item.key
                    })
                    ],
                    buttons: {
                    cancel: { show: true, color: "link" },
                    action: {
                        text: "Delete",
                        color: "error",
                        callback: dialog => {
                        this.loadDialog(true);
                        this.deleteResource(item);
                        }
                    }
                    }
                });
            },
        },

        mounted() {
            this.getResource();
            this.getPaginatedData();
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
    }
</script>
