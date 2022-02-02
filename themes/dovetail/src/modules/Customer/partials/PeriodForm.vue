<template>
  <v-form @submit.prevent="submit">
    <h3 class="d-flex align-center mb-3">
      Income Statement
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
      vid="metadata[description]"
      :name="trans('Description')"
      v-slot="{ errors }"
      v-if="edit"
    >
      <v-text-field
        outlined
        label="Description"
        dense
        v-model="resource.data.description"
      ></v-text-field>
    </validation-provider>

    <h4 class="mb-3 primary--text" v-else v-text="resource.data.description">
      Period
    </h4>

    <period-input
      :edit="edit"
      label="Sales"
      v-model="resource.data.sales"
    ></period-input>

    <period-input
      :edit="edit"
      label="Raw Materials"
      v-model="resource.data.raw_materials"
    ></period-input>

    <period-input
      :edit="edit"
      label="Opening Stocks"
      v-model="resource.data.opening_stocks"
    ></period-input>

    <period-input
      :edit="edit"
      label="Closing Stocks"
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
          v-if="edit"
          dense
          hide-details
          v-model="resource.data.cost_of_good_sold"
          class="text-right"
          readonly
        ></v-text-field>
        <div
          v-else
          v-text="resource.data.cost_of_good_sold"
          class="text-right"
        ></div
      ></v-col>
    </v-row>

    <period-input
      :edit="edit"
      label="Production Cost"
      v-model="resource.data.production_cost"
    ></period-input>

    <period-input
      :edit="edit"
      label="Genereral Management Cost"
      v-model="resource.data.general_management_cost"
    ></period-input>

    <period-input
      :edit="edit"
      label="Labour Expense"
      v-model="resource.data.labour_expense"
    ></period-input>

    <v-divider></v-divider>

    <period-input
      :edit="edit"
      label="Buildings"
      v-model="resource.data.buildings"
    ></period-input>

    <period-input
      :edit="edit"
      label="Plant, Machinery & Equipment"
      v-model="resource.data.plant_machinery_and_equipment"
    ></period-input>

    <period-input
      :edit="edit"
      label="Others"
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
          v-if="edit"
          dense
          hide-details
          v-model="resource.data.depreciation"
          class="text-right"
          readonly
        ></v-text-field>
        <div v-else v-text="resource.data.depreciation" class="text-right"></div
      ></v-col>
    </v-row>

    <v-divider></v-divider>

    <period-input
      :edit="edit"
      label="Non Operating Expense"
      v-model="resource.data.non_operating_expense"
    ></period-input>

    <period-input
      :edit="edit"
      label="Taxation"
      v-model="resource.data.taxation"
    ></period-input>

    <period-input
      :edit="edit"
      label="Interest on Loans/Hires"
      v-model="resource.data.interest_on_loans_or_hires"
    ></period-input>

    <period-input
      :edit="edit"
      label="Company Tax"
      v-model="resource.data.company_tax"
    ></period-input>

    <v-divider></v-divider>

    <v-row>
      <v-col cols="6" v-text="'Net Profit'" class="text-right font-weight-bold">
      </v-col>
      <v-col cols="6">
        <v-text-field
          v-if="edit"
          dense
          hide-details
          v-model="resource.data.net_profit"
          class="text-right"
          readonly
        ></v-text-field>
        <div v-else v-text="resource.data.net_profit" class="text-right"></div
      ></v-col>
    </v-row>

    <div class="text-right mt-5">
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
      let {
        raw_materials,
        opening_stocks,
        closing_stocks
      } = this.resource.data;

      this.resource.data.cost_of_good_sold =
        parseFloat(raw_materials) +
        parseFloat(opening_stocks) -
        parseFloat(closing_stocks);
    },

    totalDepreciation() {
      let {
        buildings,
        plant_machinery_and_equipment,
        others
      } = this.resource.data;

      this.resource.data.depreciation =
        parseFloat(buildings) +
        parseFloat(plant_machinery_and_equipment) +
        parseFloat(others);
    },

    netProfit() {
      let {
        sales,
        cost_of_good_sold,
        non_operating_expense,
        production_cost,
        labour_expense,
        general_management_cost,
        depreciation,
        company_tax
      } = this.resource.data;

      const operating_expense =
        parseFloat(production_cost) +
        parseFloat(labour_expense) +
        parseFloat(general_management_cost);

      const operating_profit =
        parseFloat(sales) -
        parseFloat(cost_of_good_sold) -
        operating_expense -
        parseFloat(non_operating_expense);

      this.resource.data.net_profit =
        operating_profit - parseFloat(depreciation) - parseFloat(company_tax);
    },

    async submit() {
      try {
        axios.post("/api/v1/financial/save", this.resource.data);
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
      handler(value) {
        this.costOfGoodSold();
        this.totalDepreciation();
        this.netProfit();
      },
      deep: true
    }
  }
};
</script>
