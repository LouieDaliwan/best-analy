<template>
  <admin>
    <metatag :title="resource.data.name"></metatag>

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
              <v-btn
                @click="askUserToDiscardUnsavedChanges"
                text
                class="ml-3 mr-0"
                large
                >{{ trans("Discard") }}</v-btn
              >
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
                  :disabled="isFormDisabled"
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
        <page-header
          :back="{ to: { name: 'indices.index' }, text: trans('Indexes') }"
        >
          <template v-slot:title>
            {{ trans("Edit Component") }}
          </template>
        </page-header>

        <!-- Alertbox -->
        <alertbox></alertbox>
        <!-- Alertbox -->

        <v-row>
          <v-col cols="12" md="9">
            <template v-if="isFetchingResource">
              <skeleton-edit></skeleton-edit>
            </template>

            <v-card v-show="isFinishedFetchingResource" class="mb-3">
              <v-card-text>
                <v-row>
                  <v-col cols="12">
                    <validation-provider
                      vid="name"
                      :name="trans('name')"
                      rules="required"
                      v-slot="{ errors }"
                    >
                      <v-text-field
                        :dense="isDense"
                        :disabled="isLoading"
                        :error-messages="errors"
                        :label="trans('Name')"
                        autofocus
                        class="dt-text-field"
                        name="name"
                        outlined
                        v-model="resource.data.name"
                      >
                      </v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      :dense="isDense"
                      :disabled="isLoading"
                      :label="trans('Name (arabic)')"
                      autofocus
                      class="dt-text-field"
                      name="metadata[name_arabic]"
                      outlined
                      v-model="resource.data.metadata.name_arabic"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <validation-provider
                      vid="code"
                      rules="required"
                      :name="trans('code')"
                      v-slot="{ errors }"
                    >
                      <v-text-field
                        :dense="isDense"
                        :disabled="isLoading"
                        :error-messages="errors"
                        :label="trans('Code')"
                        :value="slugify(resource.data.name)"
                        class="dt-text-field"
                        name="code"
                        outlined
                      ></v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col cols="12">
                    <validation-provider
                      vid="alias"
                      :name="trans('alias')"
                      rules="required"
                      v-slot="{ errors }"
                    >
                      <v-text-field
                        :dense="isDense"
                        :disabled="isLoading"
                        :error-messages="errors"
                        :label="trans('Alias')"
                        class="dt-text-field"
                        name="alias"
                        outlined
                        v-model="resource.data.alias"
                      >
                      </v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col cols="12" md="6">
                    <validation-provider
                      vid="metadata.weightage"
                      name="weightage"
                      v-slot="{ errors }"
                    >
                      <v-text-field
                        :dense="isDense"
                        :disabled="isLoading"
                        :error-messages="errors"
                        :label="trans('Weightage')"
                        class="dt-text-field"
                        name="metadata[weightage]"
                        outlined
                        min="0.0"
                        type="number"
                        v-model="resource.data.metadata.weightage"
                      >
                      </v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col cols="12" md="6">
                    <v-text-field
                      :dense="isDense"
                      :disabled="isLoading"
                      :label="trans('Color')"
                      :placeholder="trans('E.g. #FFFFFF')"
                      class="dt-text-field"
                      name="metadata[color]"
                      outlined
                      v-model="resource.data.metadata['color']"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-textarea
                      :label="trans('Description')"
                      auto-grow
                      class="dt-text-field"
                      hide-details
                      name="description"
                      outlined
                      v-model="resource.data.description"
                    ></v-textarea>
                  </v-col>
                  <v-col cols="12">
                    <v-textarea
                      :label="trans('Description (arabic)')"
                      auto-grow
                      class="dt-text-field"
                      hide-details
                      name="metadata[description_arabic]"
                      outlined
                      v-model="resource.data.metadata['description_arabic']"
                    ></v-textarea>
                  </v-col>
                </v-row>
                <input type="hidden" name="type" :value="resource.data.type" />
                <input type="hidden" name="user_id" :value="auth.id" />
              </v-card-text>
            </v-card>
          </v-col>

          <v-col cols="12" md="3">
            <template v-if="isFetchingResource">
              <skeleton-icon></skeleton-icon>
            </template>
            <v-card v-show="isFinishedFetchingResource" class="mb-3">
              <v-card-title class="pb-0">{{ __("Icon") }}</v-card-title>
              <v-card-text class="text-center">
                <upload-avatar
                  name="photo"
                  avatar="icon"
                  v-model="resource.data.icon"
                ></upload-avatar>
              </v-card-text>
            </v-card>

            <template v-if="isFetchingResource">
              <skeleton-metainfo-card></skeleton-metainfo-card>
            </template>
            <metainfo-card
              v-show="isFinishedFetchingResource"
              :list="metaInfoCardList"
            ></metainfo-card>
          </v-col>
        </v-row>
      </v-form>
    </validation-observer>
  </admin>
</template>

<script>
import $auth from "@/core/Auth/auth";
import $api from "./routes/api";
import Index from "./Models/Index";
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
    auth: $auth.getUser(),
    loading: true,
    resource: new Index(),
    isValid: true
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

    askUserToDiscardUnsavedChanges() {
      this.showDialog({
        illustration: () =>
          import("@/components/Icons/WorkingDeveloperIcon.vue"),
        title: trans("Discard changes?"),
        text: trans(
          "You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."
        ),
        buttons: {
          cancel: {
            text: trans("Cancel"),
            callback: () => {
              this.hideDialog();
            }
          },
          action: {
            text: trans("Discard"),
            callback: () => {
              this.resource.isPrestine = true;
              this.hideDialog();
              this.$router.replace({ name: "indices.index" });
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

      formData.append("_method", "put");

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
      if (!this.isFormDisabled) {
        this.$refs["submit-button"].click();
        window.scrollTo({
          top: 0,
          left: 0,
          behavior: "smooth"
        });
      }
    },

    submit(e) {
      this.load();
      this.hideAlertbox();
      e.preventDefault();

      axios
        .post(
          $api.update(this.resource.data.id),
          this.parseResourceData(this.resource.data)
        )
        .then(response => {
          this.showSnackbar({
            text: trans("Component updated successfully")
          });

          this.showSuccessbox({
            text: trans("Updated Component {name}", {
              name: this.resource.data.name
            }),
            buttons: {
              show: {
                code: "indices.index",
                to: {
                  name: "indices.index",
                  params: { id: this.resource.data.id }
                },
                icon: "mdi-account-search-outline",
                text: trans("View All Indexes")
              },
              create: {
                code: "indices.create",
                to: { name: "indices.create" },
                icon: "mdi-account-plus-outline",
                text: trans("Add New Component")
              }
            }
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

    getResource: function() {
      axios
        .get($api.show(this.$route.params.id))
        .then(response => {
          this.resource.data = Object.assign(response.data.data);
          this.resource.data.metadata = Object.assign(
            [],
            this.resource.data.metadata
          );
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
