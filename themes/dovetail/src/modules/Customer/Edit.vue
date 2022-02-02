<template>
  <admin>
    <metatag :title="resource.data.name"></metatag>

    <back-to-top></back-to-top>

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
                  {{ trans("Update") }}
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
        @change="formIsChanged"
        v-on:submit.prevent="handleSubmit(submit($event))"
      >
        <button
          :disabled="isFormDisabled"
          ref="submit-button"
          type="submit"
          class="d-none"
        ></button>
        <page-header
          :back="{ to: { name: 'companies.owned' }, text: trans('Companies') }"
        >
          <template v-slot:title>
            {{
              trans("Edit :name", {
                name: `${resource.data.name}'s Input Data`,
              })
            }}
          </template>
          <template v-slot:action>
            <validation-provider
              :name="trans('Type')"
              rules="email"
              v-slot="{ errors }"
              vid="metadata[type]"
            >
              <div>
                <label>Audited Financials</label>
                <input
                  :checked="resource.data.metadata.type == 'Audited'"
                  name="metadata[type]"
                  type="radio"
                  value="Audited"
                />
                <span class="d-inline-block mx-3"></span>
                <label>In-House Financials</label>
                <input
                  :checked="resource.data.metadata.type == 'In-House'"
                  name="metadata[type]"
                  type="radio"
                  value="In-House"
                />
              </div>
            </validation-provider>
          </template>
        </page-header>

        <!-- Alertbox -->
        <alertbox></alertbox>
        <!-- Alertbox -->

        <input type="hidden" name="name" :value="resource.data.name" />
        <input type="hidden" name="code" :value="resource.data.code" />
        <input type="hidden" name="refnum" :value="resource.data.refnum" />
        <input type="hidden" name="user_id" :value="resource.data.user_id" />

        <v-row>
          <v-col cols="12" md="12">
            <v-card flat color="transparent">
              <tabs v-model="tabsModel">
                <template v-slot:item>
                  <v-tab-item key="tab-0">
                    <template v-if="isFetchingResource">
                      <skeleton-edit-company></skeleton-edit-company>
                    </template>

                    <company-information
                      v-show="isFinishedFetchingResource"
                      v-model="resource.data"
                      :isDense="isDense"
                      :isLoading="isLoading"
                    ></company-information>
                  </v-tab-item>

                  <v-tab-item key="tab-1">
                    <template v-if="isFetchingResource">
                      <skeleton-edit-company></skeleton-edit-company>
                    </template>

                    <applicant-information
                      v-show="isFinishedFetchingResource"
                      v-model="resource.data"
                      :isDense="isDense"
                      :isLoading="isLoading"
                    ></applicant-information>
                  </v-tab-item>

                  <v-tab-item key="tab-2">
                    <template v-if="isFetchingResource">
                      <skeleton-edit-financial></skeleton-edit-financial>
                    </template>

                    <financial-statement
                      v-show="isFinishedFetchingResource"
                      v-model="resource.data"
                      :isDense="isDense"
                      :isLoading="isLoading"
                    ></financial-statement>
                  </v-tab-item>
                </template>
              </tabs>
            </v-card>
          </v-col>
        </v-row>
      </v-form>
    </validation-observer>
  </admin>
</template>

<script>
import $api from "./routes/api";
import Company from "./Models/Company";
import SendFinancialDataToCrmButton from "./cards/SendFinancialDataToCrmButton";
import SkeletonEditCompany from "./cards/SkeletonEditCompany";
import SkeletonEditFinancial from "./cards/SkeletonEditFinancial";
import $auth from "@/core/Auth/auth";
import { mapGetters, mapActions } from "vuex";

export default {
  beforeRouteLeave(to, from, next) {
    if (this.resource.isPrestine) {
      next();
    } else {
      this.askUserBeforeNavigatingAway(next);
    }
  },

  components: {
    CompanyInformation: () => import("./partials/CompanyInformation"),
    ApplicantInformation: () => import("./partials/ApplicantInformation"),
    FinancialStatement: () => import("./partials/FinancialStatement"),
    SkeletonEditCompany,
    SkeletonEditFinancial,
    SendFinancialDataToCrmButton,
    TotalRow: () => import("./partials/TotalRow"),
  },

  computed: {
    ...mapGetters({
      isDense: "settings/fieldIsDense",
      shortkeyCtrlIsPressed: "shortkey/ctrlIsPressed",
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
    isFormDisabled() {
      return this.isInvalid || this.resource.isPrestine;
    },
    isFormPrestine() {
      return this.resource.isPrestine;
    },
    isNotFormPrestine() {
      return !this.isFormPrestine;
    },
    isFetchingResource() {
      return this.loading;
    },
    isFinishedFetchingResource() {
      return !this.loading;
    },
  },

  data: (vm) => ({
    isFinancialStatementHasValue: false,
    resource: new Company(),
    loading: true,
    tabsModel: 1,
    costOfGoodSold: {
      Year1: 0,
      Year2: 0,
      Year3: 0,
    },
    totalProductionCost: {
      Year1: 0,
      Year2: 0,
      Year3: 0,
    },
    totalGeneralMgmtCost: {
      Year1: 0,
      Year2: 0,
      Year3: 0,
    },
    totalPurchases: {
      Year1: 0,
      Year2: 0,
      Year3: 0,
    },
    valueAdded: {
      Year1: 0,
      Year2: 0,
      Year3: 0,
    },
    totalLabourExpenses: {
      Year1: 0,
      Year2: 0,
      Year3: 0,
    },
    totalDepreciation: {
      Year1: 0,
      Year2: 0,
      Year3: 0,
    },
    totalNonOperatingExpenses: {
      Year1: 0,
      Year2: 0,
      Year3: 0,
    },
    totalTaxes: {
      Year1: 0,
      Year2: 0,
      Year3: 0,
    },
    totalInterest: {
      Year1: 0,
      Year2: 0,
      Year3: 0,
    },
    financialTotal: {
      Year1: 0,
      Year2: 0,
      Year3: 0,
    },
    balanceTotal: {
      Year1: 0,
      Year2: 0,
      Year3: 0,
    },
  }),

  methods: {
    ...mapActions({
      hideSidebar: "sidebar/hide",
      hideAlertbox: "alertbox/hide",
      hideDialog: "dialog/hide",
      hideErrorbox: "errorbox/hide",
      hideSnackbar: "snackbar/hide",
      hideSuccessbox: "successbox/hide",
      showAlertbox: "alertbox/show",
      showDialog: "dialog/show",
      showErrorbox: "errorbox/show",
      showSnackbar: "snackbar/show",
      showSuccessbox: "successbox/show",
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
            },
          },
          action: {
            text: trans("Discard"),
            callback: () => {
              next();
              this.hideDialog();
            },
          },
        },
      });
    },

    ct(i) {
      // checkIfTotalIsNext
      switch (i) {
        case "Closing Stocks":
          return {
            title: "Cost of Good Sold",
            total: this.costOfGoodSold,
          };
        case "Direct Employee Cost":
          return {
            title: "Total Production Cost",
            total: this.totalProductionCost,
          };
        case "Other Administrative Costs":
          return {
            title: "Total General Management Cost",
            total: this.totalGeneralMgmtCost,
          };
        case "Total General Management Cost":
          return {
            title: "Total Purchase of Goods and Services",
            total: this.totalPurchases,
          };
        case "Total Purchase of Goods and Services":
          return {
            title: "Value Added",
            total: this.valueAdded,
          };
        case "Other Labour Expenses":
          return {
            title: "Total Labour Expenses",
            total: this.totalLabourExpenses,
          };
        case "Others (Depreciation)":
          return {
            title: "Total Depreciation",
            total: this.totalDepreciation,
          };
        case "Others (Non-Operating Costs)":
          return {
            title: "Net Non-Operating Expenses",
            total: this.totalNonOperatingExpenses,
          };
        case "Others (excluding Income Tax)":
          return {
            title: "Total Taxes",
            total: this.totalTaxes,
          };
        case "Others (Interest on Loan/Hires)":
          return {
            title: "Total Interest on Loans/Hires",
            total: this.totalInterest,
          };
      }
      return false;
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
            },
          },
          action: {
            text: trans("Discard"),
            callback: () => {
              this.hideDialog();
              this.$router.replace({ name: "companies.owned" });
            },
          },
        },
      });
    },

    load(val = true) {
      this.resource.loading = val;
      this.loading = val;
    },

    formIsChanged() {
      this.resource.isPrestine = false;
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
          behavior: "smooth",
        });
      }
    },

    submit(e) {
      this.load();
      e.preventDefault();

      axios
        .post(
          $api.update(this.resource.data.id),
          this.parseResourceData(this.resource.data)
        )
        .then((response) => {
          this.resource.isPrestine = true;
          this.isFinancialStatementHasValue =
            response.data.is_fs_has_no_zero_value;
          this.showSuccessbox({
            text: trans("Company updated successfully"),
            buttons: {
              show: {
                code: "customers.show",
                to: {
                  name: "companies.show",
                  params: { id: this.resource.data.id },
                },
                icon: "mdi-briefcase-search-outline",
                text: trans("Go to Survey Page"),
              },
              create: {
                code: "crm.search",
                to: { name: "companies.find" },
                icon: "mdi-file-document-box-search-outline",
                text: trans("Find Another Company"),
              },
            },
          });
        })
        .catch((err) => {
          if (
            err.response &&
            err.response.status == Response.HTTP_UNPROCESSABLE_ENTITY
          ) {
            let errorCount = _.size(err.response.data.errors);

            this.$refs["updateform"].setErrors(err.response.data.errors);
            this.showErrorbox({
              text: trans(err.response.data.message),
              errors: err.response.data.errors,
            });
          }
        })
        .finally(() => {
          this.load(false);
        });
    },

    previewRatiosReport() {
      this.$router.push({
        name: "reports.ratios",
        query: {
          type: "ratios",
          user_id: $auth.getId(),
        },
        params: { id: this.$route.params.id },
      });
    },

    getResource() {
      this.resource.loading = true;
      this.resource.isPrestine = false;
      axios
        .get($api.show(this.$route.params.id))
        .then((response) => {
          const metadata = this.resource.data.metadata;
          this.resource.data = response.data.data;
          this.resource.data.metadata.applicant =
            this.resource.data.metadata.applicant || metadata;
          this.resource.metadata = _.merge(
            metadata,
            this.resource.metadata,
            this.resource.data.metadata
          );
          this.resource.data.financials = this.resource.metadata;
          this.isFinancialStatementHasValue =
            response.data.data.is_fs_has_no_zero_value;
        })
        .finally(() => {
          this.load(false);
          this.resource.isPrestine = true;
          console.log(this.resource);
        });
    },

    activateTab() {
      this.tabsModel = parseInt(this.$route.query.tab || 0);
    },

    calculateTotals() {
      const financialsFPS = this.resource.data.financials["fps-qa1"];

      this.costOfGoodSold = this.multiplyToNegative(
        this.resource.calculateThreeYears({
          "Opening Stocks": financialsFPS["Opening Stocks"],
          "Raw Materials (direct & indirect)":
            financialsFPS["Raw Materials (direct & indirect)"],
          "Closing Stocks": financialsFPS["Closing Stocks"],
        })
      );

      this.totalProductionCost = this.multiplyToNegative(
        this.resource.calculateThreeYears({
          "Cargo and Handling": financialsFPS["Cargo and Handling"],
          "Part-time/Temporary Labour":
            financialsFPS["Part-time/Temporary Labour"],
          "Insurance (not including employee's insurance)":
            financialsFPS["Insurance (not including employee's insurance)"],
          Transportation: financialsFPS["Transportation"],
          Utilities: financialsFPS["Utilities"],
          "Maintenance (Building, Plant, and Machinery)":
            financialsFPS["Maintenance (Building, Plant, and Machinery)"],
          "Lease of Plant and Machinery":
            financialsFPS["Lease of Plant and Machinery"],
          "Direct Employee Cost": financialsFPS["Direct Employee Cost"],
        })
      );

      this.totalGeneralMgmtCost = this.multiplyToNegative(
        this.resource.calculateThreeYears({
          "Stationery Supplies and Printing":
            financialsFPS["Stationery Supplies and Printing"],
          Rental: financialsFPS["Rental"],
          "Insurance (not including employee's insurance) ":
            financialsFPS["Insurance (not including employee's insurance) "],
          "Transportation ": financialsFPS["Transportation "],
          "Company Car/Bus etc.": financialsFPS["Company Car/Bus etc."],
          Advertising: financialsFPS["Advertising"],
          Entertainment: financialsFPS["Entertainment"],
          "Food and Drinks": financialsFPS["Food and Drinks"],
          "Telephone and Fax": financialsFPS["Telephone and Fax"],
          "Mail and Courier": financialsFPS["Mail and Courier"],
          "Maintenance (Office Equipment)":
            financialsFPS["Maintenance (Office Equipment)"],
          Travel: financialsFPS["Travel"],
          "Audit, Secretarial, and Professional Costs":
            financialsFPS["Audit, Secretarial, and Professional Costs"],
          "Newspapers and Magazines": financialsFPS["Newspapers and Magazines"],
          "Stamp Duty, Filing and Legal":
            financialsFPS["Stamp Duty, Filing and Legal"],
          "Bank charges": financialsFPS["Bank charges"],
          "Other Administrative Costs":
            financialsFPS["Other Administrative Costs"],
        })
      );

      this.totalPurchases = this.multiplyToNegative(
        this.resource.calculateThreeYears({
          "Cost of Good Sold": this.costOfGoodSold,
          "Total Production Cost": this.totalProductionCost,
          "Total General Management Cost": this.totalGeneralMgmtCost,
        })
      );

      this.valueAdded = this.resource.calculateThreeYears({
        Sales: financialsFPS["Sales"],
        "Total Purchases": this.totalPurchases,
      });

      this.totalLabourExpenses = this.multiplyToNegative(
        this.resource.calculateThreeYears({
          "Employee Compensation": financialsFPS["Employee Compensation"],
          Bonuses: financialsFPS["Bonuses"],
          "Provident Fund": financialsFPS["Provident Fund"],
          "Employee Welfare": financialsFPS["Employee Welfare"],
          "Medical Costs": financialsFPS["Medical Costs"],
          "Employee Training": financialsFPS["Employee Training"],
          "Director's Salary": financialsFPS["Director's Salary"],
          "Employee Insurance": financialsFPS["Employee Insurance"],
          "Other Labour Expenses": financialsFPS["Other Labour Expenses"],
        })
      );

      this.totalDepreciation = this.multiplyToNegative(
        this.resource.calculateThreeYears({
          Buildings: financialsFPS["Buildings"],
          "Plant, Machinery & Equipment":
            financialsFPS["Plant, Machinery & Equipment"],
          "Others (Depreciation)": financialsFPS["Others (Depreciation)"],
        })
      );

      this.totalNonOperatingExpenses = this.multiplyToNegative(
        this.resource.calculateThreeYears({
          "Profit from Fixed Assets Sale":
            financialsFPS["Profit from Fixed Assets Sale"],
          "Profit from Foreign Exchange":
            financialsFPS["Profit from Foreign Exchange"],
          "Other Income": financialsFPS["Other Income"],
          "Bad Debts": financialsFPS["Bad Debts"],
          Donations: financialsFPS["Donations"],
          "Foreign Exchange Loss": financialsFPS["Foreign Exchange Loss"],
          "Loss on Fixed Assets Sale":
            financialsFPS["Loss on Fixed Assets Sale"],
          "Others (Non-Operating Costs)":
            financialsFPS["Others (Non-Operating Costs)"],
        })
      );

      this.totalTaxes = this.multiplyToNegative(
        this.resource.calculateThreeYears({
          "Tax on Property": financialsFPS["Tax on Property"],
          "Duties (Customs & Excise)":
            financialsFPS["Duties (Customs & Excise)"],
          "Levy on Foreign Workers": financialsFPS["Levy on Foreign Workers"],
          "Others (excluding Income Tax)":
            financialsFPS["Others (excluding Income Tax)"],
        })
      );

      this.totalInterest = this.multiplyToNegative(
        this.resource.calculateThreeYears({
          "Interest & Charges by Bank":
            financialsFPS["Interest & Charges by Bank"],
          "Interest on Loan": financialsFPS["Interest on Loan"],
          "Interest on Hire Purchase":
            financialsFPS["Interest on Hire Purchase"],
          "Others (Interest on Loan/Hires)":
            financialsFPS["Others (Interest on Loan/Hires)"],
        })
      );

      this.financialTotal = this.resource.calculateThreeYears(financialsFPS);
      this.balanceTotal = this.formatBalanceTotal(
        this.resource.calculateThreeYears(
          this.resource.data.financials["balance-sheet"]
        )
      );
    },

    multiplyToNegative(data) {
      Object.keys(data).forEach((key) => (data[key] *= -1));
      return data;
    },

    formatBalanceTotal(data) {
      Object.keys(data).forEach((key) => {
        if (data[key] === 0) data[key] = "Balanced!";
      });
      return data;
    },
  },

  mounted() {
    this.hideSidebar();
    this.getResource();
    this.activateTab();
  },

  watch: {
    "resource.data": {
      handler(val) {
        this.resource.isPrestine = false;
        this.resource.hasErrors = this.$refs.updateform.flags.invalid;

        this.calculateTotals();

        if (!this.resource.hasErrors) {
          this.hideAlertbox();
        }
      },
      deep: true,
    },
  },
};
</script>