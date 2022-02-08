<template>
  <div>
    <!-- <v-form @submit.prevent="submit" ref="form"> -->
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
        name="metadata[statements][description]"
        outlined
        v-model="resource.data.description"
        hide-details
      ></v-text-field>
      <input
        type="hidden"
        name="metadata[sheets][description]"
        :value="resource.data.description"
      />
    </validation-provider>

    <h4 class="mb-3 primary--text" v-else v-text="resource.data.description">
      Period
    </h4>

    <v-divider class="my-10"></v-divider>

    <h3>Financial Statement</h3>

    <input
      type="hidden"
      name="metadata[statements][id]"
      :value="resource.data.sheet_id"
    />

    <div
      v-for="(item, i) in Object.keys(resource.data.statements)"
      :key="i + 'a'"
    >
      <template v-if="item === 'Net Operating Profit/(Loss)'">
        <v-row>
          <v-col
            cols="6"
            v-text="trans(item)"
            class="text-right font-weight-bold"
          >
          </v-col>
          <v-col cols="6">
            <v-text-field
              class="text-right dt-text-field"
              :class="
                resource.data.statements[item] > 0 ? 'text-green' : 'text-red'
              "
              :color="resource.data.statements[item] > 0 ? 'green' : 'red'"
              dense
              :name="`metadata[statements][${item}]`"
              readonly
              v-if="edit"
              v-model="resource.data.statements[item]"
            ></v-text-field>
            <div
              v-else
              v-text="resource.data.statements[item]"
              class="text-right"
            ></div
          ></v-col>
        </v-row>
      </template>
      <template v-else-if="['Cost of Good Sold'].includes(item)">
        <v-row>
          <v-col
            cols="6"
            v-text="trans(item)"
            class="text-right font-weight-bold"
          >
          </v-col>
          <v-col cols="6">
            <v-text-field
              class="text-right dt-text-field"
              dense
              :name="`metadata[statements][${item}]`"
              readonly
              v-if="edit"
              v-model="resource.data.statements[item]"
            ></v-text-field>
            <div
              v-else
              v-text="resource.data.statements[item]"
              class="text-right"
            ></div
          ></v-col>
        </v-row>
      </template>
      <template v-else>
        <period-input
          :edit="edit"
          :label="item"
          :name="`metadata[statements][${item}]`"
          v-model="resource.data.statements[item]"
        ></period-input>
      </template>
    </div>

    <v-card flat height="50"></v-card>

    <v-divider class="my-10"></v-divider>

    <h3>Balance Sheet</h3>

    <v-card flat height="50"></v-card>

    <input
      type="hidden"
      name="metadata[sheets][id]"
      :value="resource.data.sheet_id"
    />

    <div v-for="(item, i) in Object.keys(resource.data.sheets)" :key="i">
      <template v-if="item === 'Balance'">
        <v-row>
          <v-col
            cols="6"
            v-text="'Balance checked!'"
            class="text-right font-weight-bold"
          >
          </v-col>
          <v-col cols="6">
            <v-text-field
              :class="!resource.data.sheets[item] ? 'text-green' : 'text-red'"
              :color="!resource.data.sheets[item] ? 'green' : 'red'"
              :name="`metadata[sheets][${item}]`"
              :value="resource.data.sheets[item] || 'Balance!'"
              class="text-right dt-text-field"
              dense
              readonly
              v-if="edit"
            ></v-text-field>
            <div
              v-else
              v-text="resource.data.sheets[item]"
              class="text-right"
            ></div
          ></v-col>
        </v-row>
      </template>
      <template v-else>
        <period-input
          :edit="edit"
          :label="item"
          :name="`metadata[sheets][${item}]`"
          v-model="resource.data.sheets[item]"
        ></period-input>
      </template>
    </div>

    <div class="text-right mt-5" v-if="edit">
      <v-btn type="submit" large color="primary">Save</v-btn>
    </div>
  </div>
  <!-- </v-form> -->
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
      let data = this.resource.data.statements;

      data["Cost of Good Sold"] =
        this.sum([data["Raw Materials"], data["Opening Stocks"]]) -
        parseFloat(data["Closing Stocks"]);
    },

    netProfit() {
      let data = this.resource.data.statements;

      const operating_expense = this.sum([
        data["Production Cost"],
        data["Labour Expenses"],
        data["General Management Cost"]
      ]);

      const operating_profit =
        parseFloat(data["Sales"]) -
        this.sum([
          data["Cost of Good Sold"],
          operating_expense,
          data["Non-Operating Expenses(Non-Operating Expense Less Income)"]
        ]);

      data["Net Operating Profit/(Loss)"] =
        operating_profit -
        this.sum([
          data["Depreciation"],
          data["Interest On Loan/Hires"],
          data["Taxation"],
          data["Company Tax"]
        ]);
    },

    balance() {
      const sheets = this.resource.data.sheets;

      const total_assets = this.sum([
        sheets.Cash,
        sheets["Trade Receivables"],
        sheets.Inventories,
        sheets["Other CA"],
        sheets["Fixed Assets"]
      ]);

      const total_liabilities = this.sum([
        sheets["Trade Payables"],
        sheets["Other CL"],
        sheets["Stockholders' Equity"],
        sheets["Other NCL"],
        sheets["Common Shares Outstanding"]
      ]);

      this.resource.data.sheets.Balance = total_assets - total_liabilities;
    },

    sum(items) {
      return items.reduce((total, item) => total + parseFloat(item || 0), 0);
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
        this.netProfit();
        this.balance();
        this.$emit("update");
      },
      deep: true
    }
  }
};
</script>
