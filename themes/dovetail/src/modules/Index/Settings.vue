<template>
  <admin>
    <metatag :title="__('Summary of Test')"></metatag>

    <template v-slot:appbar>
      <v-container class="py-0 px-0">
        <v-row justify="space-between" align="center">
          <v-fade-transition>
            <v-col v-if="isNotFormPrestine" class="py-0" cols="auto">
              <v-toolbar-title class="muted--text">{{
                trans("Unsaved changes")
              }}</v-toolbar-title>
            </v-col>
          </v-fade-transition>
          <v-spacer></v-spacer>
          <v-col class="py-0" cols="auto">
            <div class="d-flex justify-end">
              <v-spacer></v-spacer>
              <v-badge
                bordered
                bottom
                class="dt-badge"
                color="dark"
                content="s"
                offset-x="20"
                offset-y="20"
                tile
                transition="fade-transition"
                v-model="shortkeyCtrlIsPressed"
              >
                <v-btn
                  :loading="isLoading"
                  @click.prevent="submitForm"
                  @shortkey="submitForm"
                  class="ml-3 mr-0"
                  color="primary"
                  large
                  ref="submit-button-main"
                  type="submit"
                  v-shortkey.once="['ctrl', 's']"
                >
                  <v-icon left>mdi-content-save-outline</v-icon>
                  {{ trans("Save") }}
                </v-btn>
              </v-badge>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </template>

    <validation-observer
      ref="updateform"
      v-slot="{ handleSubmit, errors, invalid, passed }"
    >
      <v-form
        :disabled="isLoading"
        ref="updateform-form"
        autocomplete="false"
        v-on:submit.prevent="handleSubmit(submit($event))"
        enctype="multipart/form-data"
      >
        <button ref="submit-button" type="submit" class="d-none"></button>
        <page-header>
          <template v-slot:title>
            {{ trans("Summary of Recommendation") }}
          </template>
        </page-header>

        <!-- Alertbox -->
        <alertbox></alertbox>
        <!-- Alertbox -->

        <v-row>
          <v-col cols="12">
            <template v-if="isFetchingResource">
              <skeleton-edit></skeleton-edit>
            </template>

            <div v-show="isFinishedFetchingResource" class="mb-3">
              <v-tabs show-arrows v-model="tab" background-color="transparent">
                <v-tab v-for="(items, head) in resource.data" :key="head">
                  <span v-text="trans(head)"></span>
                </v-tab>
              </v-tabs>

              <v-tabs-items v-model="tab">
                <v-tab-item v-for="(items, head) in resource.data" :key="head">
                  <v-card>
                    <v-card-text>
                      <v-row>
                        <v-col cols="12" md="6">
                          <v-text-field
                            label="Search"
                            outlined
                            prepend-inner-icon="mdi-magnify"
                            v-model="search"
                          ></v-text-field>
                        </v-col>
                      </v-row>
                      <div
                        v-if="
                          items.filter(item =>
                            item.en.toLowerCase().includes(search.toLowerCase())
                          ).length === 0
                        "
                        class="text-center muted--text"
                      >
                        No items to show
                      </div>
                      <div
                        v-for="(item, i) in items.filter(item =>
                          item.en.toLowerCase().includes(search.toLowerCase())
                        )"
                        :key="i"
                      >
                        <v-row>
                          <v-col cols="12" md="5">
                            <v-text-field
                              :dense="isDense"
                              :disabled="isLoading"
                              :label="trans('English')"
                              class="dt-text-field"
                              outlined
                              hide-details
                              v-model="item.en"
                            >
                            </v-text-field>
                          </v-col>
                          <v-col cols="12" md="5">
                            <v-text-field
                              :dense="isDense"
                              :disabled="isLoading"
                              :label="trans('Arabic')"
                              class="dt-text-field"
                              outlined
                              :name="`translations[${item.en}][ar]`"
                              hide-details
                              v-model="item.ar"
                            >
                            </v-text-field>
                          </v-col>
                          <v-col cols="12" md="2">
                            <v-checkbox
                              v-model="item.priority"
                              label="Priority"
                              :name="`translations[${item.en}][priority]`"
                              :value="item.priority"
                            ></v-checkbox>
                            <input
                              type="text"
                              :name="`translations[${item.en}][key]`"
                              :value="item.key"
                              hidden
                            />
                            <input
                              type="text"
                              :name="`translations[${item.en}][name]`"
                              :value="item.name"
                              hidden
                            />
                            <input
                              type="text"
                              :name="`translations[${item.en}][idkey]`"
                              :value="item.idKey"
                              hidden
                            />
                          </v-col>
                        </v-row>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-tab-item>
              </v-tabs-items>
            </div>
          </v-col>
        </v-row>
      </v-form>
    </validation-observer>
  </admin>
</template>

<script>
import $api from "./routes/api";
import SkeletonEdit from "./cards/SkeletonEdit";
import SkeletonIcon from "./cards/SkeletonIcon";
import { mapActions, mapGetters } from "vuex";

export default {
  beforeRouteLeave(to, from, next) {
    if (this.resource.isPrestine) {
      next();
    } else {
      this.askUserBeforeNavigatingAway(next);
    }
  },

  computed: {
    ...mapGetters({
      isDense: "settings/fieldIsDense",
      shortkeyCtrlIsPressed: "shortkey/ctrlIsPressed"
    }),
    isDesktop() {
      return this.$vuetify.breakpoint.mdAndUp;
    },
    isInvalid() {
      return this.resource.isPrestine || this.resource.loading;
    },
    isLoading() {
      return this.resource.loading;
    },
    isFetchingResource() {
      return this.loading;
    },
    isFinishedFetchingResource() {
      return !this.loading;
    },
    isFormDisabled() {
      return this.isInvalid || this.resource.isPrestine;
    },
    isFormPrestine() {
      return this.resource.isPrestine;
    },
    isNotFormPrestine() {
      return !this.isFormPrestine;
    },
    metaInfoCardList() {
      return [
        {
          icon: "mdi-calendar",
          text: trans("Created :date", { date: this.resource.data.created })
        },
        {
          icon: "mdi-calendar-edit",
          text: trans("Modified :date", { date: this.resource.data.modified })
        }
      ];
    }
  },

  components: {
    SkeletonEdit,
    SkeletonIcon
  },

  data: () => ({
    loading: true,
    resource: {
      data: []
    },
    isValid: true,
    tab: null,
    search: ""
  }),

  methods: {
    ...mapActions({
      hideAlertbox: "alertbox/hide",
      hideDialog: "dialog/hide",
      hideErrorbox: "errorbox/hide",
      hideSnackbar: "snackbar/hide",
      hideSuccessbox: "successbox/hide",
      showAlertbox: "alertbox/show",
      showDialog: "dialog/show",
      showErrorbox: "errorbox/show",
      showSnackbar: "snackbar/show",
      showSuccessbox: "successbox/show"
    }),

    askUserBeforeNavigatingAway(next) {
      this.showDialog({
        illustration: () =>
          import("@/components/Icons/WorkingDeveloperIcon.vue"),
        title: trans("Unsaved changes will be lost"),
        text: trans(
          "You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."
        ),
        buttons: {
          cancel: {
            text: trans("Go Back"),
            callback: () => {
              this.hideDialog();
            }
          },
          action: {
            text: trans("Discard"),
            callback: () => {
              next();
              this.hideDialog();
            }
          }
        }
      });
    },

    load(val = true) {
      this.resource.loading = val;
      this.loading = val;
    },

    parseResourceData(item) {
      let data = _.clone(item);

      let formData = new FormData(this.$refs["updateform-form"].$el);

      // formData.append('_method', 'put')

      data = formData;

      return data;
    },

    parseErrors(errors) {
      this.$refs["updateform"].setErrors(errors);
      errors = Object.values(errors).flat();
      this.resource.hasErrors = errors.length;
      return this.resource.errors;
    },

    getParseErrors(errors) {
      errors = Object.values(errors).flat();
      this.resource.hasErrors = errors.length;
      return errors;
    },

    submitForm() {
      this.$refs["submit-button"].click();
      window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth"
      });
    },

    submit(e) {
      this.load();
      this.hideAlertbox();
      e.preventDefault();

      axios
        .post($api.translation(), this.parseResourceData(this.resource.data))
        .then(response => {
          this.showSnackbar({
            text: trans("Index Settings updated successfully")
          });

          this.$refs["updateform"].reset();
          this.resource.isPrestine = true;
        })
        .catch(err => {
          if (err.response.status == Response.HTTP_UNPROCESSABLE_ENTITY) {
            let errorCount = _.size(err.response.data.errors);

            this.$refs["updateform"].setErrors(err.response.data.errors);
            this.showErrorbox({
              text: trans(err.response.data.message),
              errors: err.response.data.errors
            });
          }
        })
        .finally(() => {
          this.load(false);
        });
    },

    getResource() {
      axios
        .get($api.translation())
        .then(response => {
          this.resource.data = response.data;

          // # Sort phrases - Start
          const KEYS = Object.keys(this.resource.data);
          KEYS.forEach(key => {
            let newArray = [];
            for (const index of Object.keys(this.resource.data[key])) {
              newArray.push(this.resource.data[key][index]);
            }
            newArray = newArray.sort(function(a, b) {
              if (a.en < b.en) {
                return -1;
              }
              if (a.en > b.en) {
                return 1;
              }
              return 0;
            });

            this.resource.data[key] = newArray;
          });
          // # Sort phrases - End

          // # Set default tab - Start
          const initTabValue = Object.keys(response.data)[0];
          this.tab = initTabValue;
          // # Set default tab - End
        })
        .finally(() => {
          this.load(false);
          this.resource.isPrestine = true;
        });
    }
  },

  mounted() {
    this.getResource();
  },

  watch: {
    "resource.data": {
      handler(val) {
        this.resource.isPrestine = false;
        this.resource.hasErrors = this.$refs.updateform.flags.invalid;

        if (!this.resource.hasErrors) {
          this.hideAlertbox();
        }
      },
      deep: true
    }
  }
};
</script>
