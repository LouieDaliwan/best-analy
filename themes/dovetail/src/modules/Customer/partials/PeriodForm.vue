<template>
  <div>
    <!-- <v-form @submit.prevent="submit" ref="form"> -->
    <h3 class="d-flex align-center mb-3">
      Financial Period
      <v-spacer></v-spacer>
      <template v-if="resource.data.id">
        <input
          type="hidden"
          name="metadata[statement][id]"
          :value="resource.data.id"
        />
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
        name="metadata[statement][metadataStatements][period]"
        outlined
        v-model="resource.data.period"
        hide-details
      ></v-text-field>
      <input
        type="hidden"
        name="metadata[statement][metadataSheets][period]"
        :value="resource.data.period"
      />
    </validation-provider>

    <h4 class="mb-3 primary--text" v-else v-text="resource.data.period">
      Financial Period
    </h4>

    <v-divider class="my-10"></v-divider>

    <h3>Financial Statement</h3>

    <div
      v-for="(item, i) in Object.keys(resource.data.metadataStatements)"
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
                resource.data.metadataStatements[item] > 0
                  ? 'text-green'
                  : 'text-red'
              "
              :color="
                resource.data.metadataStatements[item] > 0 ? 'green' : 'red'
              "
              dense
              :name="`metadata[statement][metadataStatements][${item}]`"
              readonly
              v-if="edit"
              v-model="resource.data.metadataStatements[item]"
            ></v-text-field>
            <div
              v-else
              v-text="
                parseFloat(
                  resource.data.metadataStatements[item] || 0
                ).toLocaleString()
              "
              class="text-right"
            ></div
          ></v-col>
        </v-row>
      </template>
      <template
        v-else-if="['Depreciation', 'Cost of Good Sold'].includes(item)"
      >
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
              :name="`metadata[statement][metadataStatements][${item}]`"
              readonly
              v-if="edit"
              v-model="resource.data.metadataStatements[item]"
            ></v-text-field>
            <div
              v-else
              v-text="
                parseFloat(
                  resource.data.metadataStatements[item] || 0
                ).toLocaleString()
              "
              class="text-right"
            ></div
          ></v-col>
        </v-row>
      </template>
      <template v-else>
        <period-input
          :edit="edit"
          :label="item"
          :name="`metadata[statement][metadataStatements][${item}]`"
          v-model="resource.data.metadataStatements[item]"
        ></period-input>
      </template>
    </div>

    <v-card flat height="50"></v-card>

    <v-divider class="my-10"></v-divider>

    <h3>Balance Sheet</h3>

    <v-card flat height="50"></v-card>

    <div
      v-for="(item, i) in Object.keys(resource.data.metadataSheets)"
      :key="i"
    >
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
              :class="
                !resource.data.metadataSheets[item] ? 'text-green' : 'text-red'
              "
              :color="!resource.data.metadataSheets[item] ? 'green' : 'red'"
              :name="`metadata[statement][metadataSheets][${item}]`"
              :value="resource.data.metadataSheets[item] || 'Balance!'"
              class="text-right dt-text-field"
              dense
              readonly
              v-if="edit"
            ></v-text-field>
            <div
              v-else
              v-text="
                parseFloat(
                  resource.data.metadataSheets[item] || 0
                ).toLocaleString()
              "
              class="text-right"
            ></div
          ></v-col>
        </v-row>
      </template>
      <template v-else>
        <period-input
          :edit="edit"
          :label="item"
          :name="`metadata[statement][metadataSheets][${item}]`"
          v-model="resource.data.metadataSheets[item]"
        ></period-input>
      </template>
    </div>

    <!-- <div class="text-right mt-5" v-if="edit">
      <v-btn type="submit" large color="primary">Save</v-btn>
    </div> -->
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
      let data = this.resource.data.metadataStatements;

      data["Cost of Good Sold"] = this.sum([
        data["Raw Materials (direct & indirect)"],
        data["Change Inventory"]
      ]);
    },

    depreciation() {
      let data = this.resource.data.metadataStatements;

      data["Depreciation"] = this.sum([
        data["Buildings"],
        data["Plant, Machinery & Equipment"],
        data["Others (Depreciation)"]
      ]);
    },

    netProfit() {
      let data = this.resource.data.metadataStatements;

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
      const metadataSheets = this.resource.data.metadataSheets;

      const total_assets = this.sum([
        metadataSheets.Cash,
        metadataSheets["Trade Receivables"],
        metadataSheets.Inventories,
        metadataSheets["Other CA"],
        metadataSheets["Fixed Assets"]
      ]);

      const total_liabilities = this.sum([
        metadataSheets["Trade Payables"],
        metadataSheets["Other CL"],
        metadataSheets["Stockholders' Equity"],
        metadataSheets["Other NCL"],
        metadataSheets["Common Shares Outstanding"]
      ]);

      this.resource.data.metadataSheets.Balance =
        total_assets - total_liabilities;
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
      }
    },
    "resource.data": {
      handler() {
        this.costOfGoodSold();
        this.depreciation();
        this.netProfit();
        this.balance();
        this.$emit("update");
      },
      deep: true
    }
  }
};
</script>
