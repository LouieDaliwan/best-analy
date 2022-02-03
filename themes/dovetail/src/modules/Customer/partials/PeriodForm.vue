<template>
  <v-form @submit.prevent="submit" ref="form">
    <input type="hidden" name="customer_id" :value="$route.params.id" />
    <h3 class="d-flex align-center mb-3">
      Period
      <v-spacer></v-spacer>
      <template v-if="resource.data.id">
        <v-switch
          :label="`${edit ? 'Edit' : 'View'}`"
          class="mt-0"
          color="primary"
          hide-details
          v-model="edit"
        ></v-switch>
      </template>
      <template v-else>
        <span class="grey--text text--darken-2">Add</span>
      </template>
    </h3>

    <validation-provider
      vid="description"
      :name="trans('Description')"
      v-slot="{ errors }"
      v-if="edit"
    >
      <v-text-field
        dense
        label="Description"
        name="description"
        outlined
        v-model="resource.data.description"
        hide-details
      ></v-text-field>
    </validation-provider>

    <h4 class="mb-3 primary--text" v-else v-text="resource.data.description">
      Period
    </h4>

    <v-divider class="my-10"></v-divider>

    <h3>Financial Statement</h3>

    <v-card flat height="50"></v-card>

    <v-row>
      <v-col cols="6" v-text="'Net Profit'" class="text-right font-weight-bold">
      </v-col>
      <v-col cols="6">
        <v-text-field
          class="text-right dt-text-field"
          :class="resource.data.net_profit > 0 ? 'text-green' : 'text-red'"
          :color="resource.data.net_profit > 0 ? 'green' : 'red'"
          dense
          name="net_profit"
          readonly
          v-if="edit"
          v-model="resource.data.net_profit"
        ></v-text-field>
        <div v-else v-text="resource.data.net_profit" class="text-right"></div
      ></v-col>
    </v-row>

    <period-input
      :edit="edit"
      label="Sales"
      name="sales"
      v-model="resource.data.sales"
    ></period-input>

    <v-card flat height="50"></v-card>

    <period-input
      :edit="edit"
      label="Raw Materials"
      name="raw_materials"
      v-model="resource.data.raw_materials"
    ></period-input>

    <period-input
      :edit="edit"
      label="Opening Stocks"
      name="opening_stocks"
      v-model="resource.data.opening_stocks"
    ></period-input>

    <period-input
      :edit="edit"
      label="Closing Stocks"
      name="closing_stocks"
      v-model="resource.data.closing_stocks"
    ></period-input>

    <v-row>
      <v-col
        cols="6"
        v-text="'Cost of Good Sold'"
        class="text-right font-weight-bold"
      >
      </v-col>
      <v-col cols="6">
        <v-text-field
          class="text-right"
          dense
          hide-details
          name="cost_of_good_sold"
          readonly
          v-if="edit"
          v-model="resource.data.cost_of_good_sold"
        ></v-text-field>
        <div
          class="text-right"
          v-else
          v-text="resource.data.cost_of_good_sold"
        ></div
      ></v-col>
    </v-row>

    <v-card flat height="50"></v-card>

    <period-input
      :edit="edit"
      label="Production Cost"
      name="production_cost"
      v-model="resource.data.production_cost"
    ></period-input>

    <period-input
      :edit="edit"
      label="Genereral Management Cost"
      name="general_management_cost"
      v-model="resource.data.general_management_cost"
    ></period-input>

    <period-input
      :edit="edit"
      label="Labour Expense"
      name="labour_expense"
      v-model="resource.data.labour_expense"
    ></period-input>

    <v-card flat height="50"></v-card>

    <period-input
      :edit="edit"
      label="Buildings"
      name="buildings"
      v-model="resource.data.buildings"
    ></period-input>

    <period-input
      :edit="edit"
      label="Plant, Machinery & Equipment"
      name="plant_machinery_and_equipment"
      v-model="resource.data.plant_machinery_and_equipment"
    ></period-input>

    <period-input
      :edit="edit"
      label="Others"
      name="others"
      v-model="resource.data.others"
    ></period-input>

    <v-row>
      <v-col
        cols="6"
        v-text="'Total Depreciation'"
        class="text-right font-weight-bold"
      >
      </v-col>
      <v-col cols="6">
        <v-text-field
          class="text-right"
          dense
          hide-details
          name="depreciation"
          readonly
          v-if="edit"
          v-model="resource.data.depreciation"
        ></v-text-field>
        <div v-else v-text="resource.data.depreciation" class="text-right"></div
      ></v-col>
    </v-row>

    <v-card flat height="50"></v-card>

    <period-input
      :edit="edit"
      label="Non Operating Expense"
      name="non_operating_expense"
      v-model="resource.data.non_operating_expense"
    ></period-input>

    <period-input
      :edit="edit"
      label="Taxation"
      name="taxation"
      v-model="resource.data.taxation"
    ></period-input>

    <period-input
      :edit="edit"
      label="Interest on Loans/Hires"
      name="interest_on_loans_or_hires"
      v-model="resource.data.interest_on_loans_or_hires"
    ></period-input>

    <period-input
      :edit="edit"
      label="Company Tax"
      name="company_tax"
      v-model="resource.data.company_tax"
    ></period-input>

    <v-divider class="my-10"></v-divider>

    <h3>Balance Sheet</h3>

    <v-card flat height="50"></v-card>

    <v-row>
      <v-col
        cols="6"
        v-text="'Balance checked!'"
        class="text-right font-weight-bold"
      >
      </v-col>
      <v-col cols="6">
        <v-text-field
          class="text-right dt-text-field"
          :class="!resource.data.balance ? 'text-green' : 'text-red'"
          :color="!resource.data.balance ? 'green' : 'red'"
          dense
          name="balance"
          readonly
          v-if="edit"
          :value="resource.data.balance || 'Balance!'"
        ></v-text-field>
        <div v-else v-text="resource.data.balance" class="text-right"></div
      ></v-col>
    </v-row>

    <period-input
      :edit="edit"
      label="Cash"
      name="cash"
      v-model="resource.data.cash"
    ></period-input>

    <period-input
      :edit="edit"
      label="Trade Receivables"
      name="trade_receivables"
      v-model="resource.data.trade_receivables"
    ></period-input>

    <period-input
      :edit="edit"
      label="Inventories"
      name="inventories"
      v-model="resource.data.inventories"
    ></period-input>

    <period-input
      :edit="edit"
      label="Other CA"
      name="other_CA"
      v-model="resource.data.other_CA"
    ></period-input>

    <period-input
      :edit="edit"
      label="Fixed Assets"
      name="fixed_assets"
      v-model="resource.data.fixed_assets"
    ></period-input>

    <v-card flat height="50"></v-card>

    <period-input
      :edit="edit"
      label="Trade Payables"
      name="trade_payables"
      v-model="resource.data.trade_payables"
    ></period-input>

    <period-input
      :edit="edit"
      label="Other CL"
      name="other_CL"
      v-model="resource.data.other_CL"
    ></period-input>

    <period-input
      :edit="edit"
      label="Stockholders Equity"
      name="stockholders_equity"
      v-model="resource.data.stockholders_equity"
    ></period-input>

    <period-input
      :edit="edit"
      label="Other NCL"
      name="other_NCL"
      v-model="resource.data.other_NCL"
    ></period-input>

    <period-input
      :edit="edit"
      label="Common Shares Outstanding"
      name="common_shares_outstanding"
      v-model="resource.data.common_shares_outstanding"
    ></period-input>

    <div class="text-right mt-5" v-if="edit">
      <v-btn type="submit" large color="primary">Save</v-btn>
    </div>
  </v-form>
</template>

<script>
import Financial from "../Models/Financial";

export default {
  props: ["value"],

  components: {
    PeriodInput: () => import("./PeriodInput.vue")
  },

  data: () => ({
    resource: new Financial(),
    edit: true
  }),

  methods: {
    costOfGoodSold() {
      const {
        raw_materials,
        opening_stocks,
        closing_stocks
      } = this.resource.data;

      this.resource.data.cost_of_good_sold =
        this.sum([raw_materials, opening_stocks]) - parseFloat(closing_stocks);
    },

    totalDepreciation() {
      const {
        buildings,
        plant_machinery_and_equipment,
        others
      } = this.resource.data;

      this.resource.data.depreciation = this.sum([
        buildings,
        plant_machinery_and_equipment,
        others
      ]);
    },

    netProfit() {
      const {
        sales,
        cost_of_good_sold,
        non_operating_expense,
        production_cost,
        labour_expense,
        general_management_cost,
        depreciation,
        interest_on_loans_or_hires,
        taxation,
        company_tax
      } = this.resource.data;

      const operating_expense = this.sum([
        production_cost,
        labour_expense,
        general_management_cost
      ]);

      const operating_profit =
        parseFloat(sales) -
        this.sum([cost_of_good_sold, operating_expense, non_operating_expense]);

      this.resource.data.net_profit =
        operating_profit -
        this.sum([
          depreciation,
          interest_on_loans_or_hires,
          taxation,
          company_tax
        ]);
    },

    balance() {
      const {
        cash,
        trade_receivables,
        inventories,
        other_CA,
        fixed_assets,
        trade_payables,
        other_CL,
        stockholders_equity,
        other_NCL,
        common_shares_outstanding
      } = this.resource.data;

      const total_assets = this.sum([
        cash,
        trade_receivables,
        inventories,
        other_CA,
        fixed_assets
      ]);

      const total_liabilities = this.sum([
        trade_payables,
        other_CL,
        stockholders_equity,
        other_NCL,
        common_shares_outstanding
      ]);

      this.resource.data.balance = total_assets - total_liabilities;
    },

    sum(items) {
      return items.reduce((total, item) => total + parseFloat(item), 0);
    },

    async submit() {
      try {
        axios.post(
          "/api/v1/financial/save",
          this.resource.parseData(this.$refs.form.$el)
        );
      } catch (err) {
        console.log(err);
      }
    }
  },

  watch: {
    value: {
      handler(value) {
        this.resource = new Financial();

        if (!value.id) return (this.edit = true);

        this.resource.data = { ...this.resource.data, ...value };
        this.edit = false;
      },
      deep: true
    },
    "resource.data": {
      handler() {
        this.costOfGoodSold();
        this.totalDepreciation();
        this.netProfit();
        this.balance();
      },
      deep: true
    }
  }
};
</script>
