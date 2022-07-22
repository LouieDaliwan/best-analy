<template>
  <div>

    <!-- <v-form @submit.prevent="submit" ref="form"> -->
    <div class="d-flex align-center mb-3">
      <h3>Financial Period</h3>
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
          inset
        ></v-switch>
      </template>
      <template v-else>
        <!-- <span class="grey--text text--darken-2">Add</span> -->
      </template>
    </div>
    <input type="hidden" name="metadata[setMethod]" :value="resource.data.setMethod" />
    <validation-provider
      vid="description"
      :name="trans('Enter Financial Period')"
      v-slot="{ errors }"
      v-if="edit"
    >
      <v-menu
        ref="menu"
        v-model="menu"
        :close-on-content-click="false"
        transition="scale-transition"
        offset-y
        min-width="auto"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            dense
            label="Enter Financial Period"
            name="metadata[statement][metadataStatements][period]"
            outlined
            v-model="resource.data.period"
            hide-details
          ></v-text-field>
        </template>
      </v-menu>
    </validation-provider>

    <h4 class="mb-3 primary--text" v-else v-text="resource.data.period">
      Financial Period
    </h4>

    <v-card flat height="40"></v-card>

    <h2 class="primary--text">Financial Statement</h2>
    <small><span class="red--text">*</span> Denotes compulsory items</small>
    <v-card flat height="20"></v-card>
    <div
      v-for="(item, i) in Object.keys(resource.data.metadataStatements)"
      :key="i + 'a'"
      >
      <template v-if="item === 'Net Operating Profit/(Loss)'">
        <v-row>
          <v-col
            cols="6"
            v-text="trans(item)"
            class="font-weight-bold text-right"
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
              class="text-right font-weight-bold "
            ></div
          ></v-col>
        </v-row>
        <v-divider v-if="edit" class="my-0 d-none"></v-divider>
        <v-divider v-else class="my-0"></v-divider>
      </template>
      <template
        v-else-if="
          [
            'Value Added',
            'Operating Profit/(Loss)[EBT]',
            'Cost of Good Sold',
          ].includes(item)
        "
        >
        <v-row>
          <v-col
            cols="6"
            v-text="trans(item)"
            class="font-weight-bold text-right"
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
              class="text-right font-weight-bold "
            ></div
          ></v-col>
        </v-row>
        <v-divider v-if="edit" class="my-0 d-none"></v-divider>
        <v-divider v-else class="my-0"></v-divider>
      </template>
      <template v-else>
        <period-input
          :edit="edit"
          :label="item"
          :name="`metadata[statement][metadataStatements][${item}]`"
          v-model="resource.data.metadataStatements[item]"
        ></period-input>
        <v-divider v-if="edit" class="my-0 d-none"></v-divider>
        <v-divider v-else class="my-0"></v-divider>
      </template>
    </div>

    <v-card flat height="50"></v-card>

    <!-- <v-divider class="my-10"></v-divider> -->

    <h2 class="primary--text">Balance Sheet</h2>
    <v-card flat height="20"></v-card>
    <div
      v-for="(item, i) in Object.keys(resource.data.metadataSheets)"
      :key="i"
      >
      <template v-if="item === 'Balance'">
        <v-row align="center" justify="center">
          <v-col
            cols="6"
            v-text="'Balance checked'"
            class="font-weight-bold"
          >
          </v-col>
          <v-col cols="6" no-gutters>
            <div v-if="edit" class="text-right">
              <v-chip
                class="px-10 text-right white--text"
                :color="!resource.data.metadataSheets[item] ? 'green' : 'red'"
                v-text="resource.data.metadataSheets[item] || 'Balanced'"
                >
              </v-chip>
            </div>
            <div v-else class="text-right m-0 p-0">
              <v-chip
                class="px-10 text-right white--text"
                :color="!resource.data.metadataSheets[item] ? 'green' : 'red'"
                v-text="resource.data.metadataSheets[item] || 'Balanced'"
                >
              </v-chip>
            </div>
          </v-col>

        </v-row>
      </template>
      <template v-else>
        <template
          v-if="
            [
              'Current Asset',
              'Fixed Assets',
              'Current Liabilities',
              'Non-Current Liabilities'
            ].includes(item)
          "
          >
          <v-row>
            <v-col
              cols="6"
              v-text="trans(item)"
              class="font-weight-bold text-right"
            >
            </v-col>
            <v-col cols="6">
              <v-text-field
                class="text-right dt-text-field"
                dense
                :name="`metadata[statement][metadataSheets][${item}]`"
                readonly
                v-if="edit"
                v-model="resource.data.metadataSheets[item]"
              ></v-text-field>
              <div
                v-else
                v-text="
                  parseFloat(
                    resource.data.metadataSheets[item] || 0
                  ).toLocaleString()
                "
                class="text-right font-weight-bold "
              ></div
            ></v-col>
          </v-row>
          <v-divider v-if="edit" class="my-0 d-none"></v-divider>
          <v-divider v-else class="my-0"></v-divider>
        </template>
        <period-input
          v-if="!
            [
              'Current Asset',
              'Current Liabilities',
              'Non-Current Liabilities'
            ].includes(item)
          "
          :edit="edit"
          :label="item"
          :name="`metadata[statement][metadataSheets][${item}]`"
          v-model="resource.data.metadataSheets[item]"
        ></period-input>
        <v-divider v-if="edit" class="my-0 d-none"></v-divider>
        <v-divider v-else class="my-0" color="primary"></v-divider>
      </template>
    </div>
  </div>
</template>

<script>
import moment from 'moment'
import Financial from "../Models/Financial";

export default {
  props: ["value", "newPeriod"],

  components: {
    PeriodInput: () => import("./PeriodInput.vue")
  },

  computed: {
    formattedDate:  {
      get () {
        const period = moment(this.resource?.data?.period)

        let result = undefined

        if(period.isValid())
          result =  period.format('MMM YYYY')

        return result

      },
      set (val) {
        this.resource.data.period = val
      }
    },
    unFormattedDate:  {
      get () {
        const period = this.resource?.data?.period

        if(moment(period).isValid())
          return period
        else
          return undefined
      },
      set (val) {
        this.resource.data.period = val
      }
    },
  },

  data: () => ({
    resource: new Financial(),
    edit: true,
    menu: false
  }),

  methods: {
    costOfGoodSold() {
      let data = this.resource.data.metadataStatements;

      data["Cost of Good Sold"] = this.sum([
        data["Raw Materials"],
        data["Direct Production Costs"]
      ]);
    },

    // depreciation() {
    //   let data = this.resource.data.metadataStatements;

    //   data["Depreciation"] = this.sum([
    //     data["Buildings"],
    //     data["Plant, Machinery & Equipment"],
    //     data["Others (Depreciation)"]
    //   ]);
    // },

    netProfit() {
      let data = this.resource.data.metadataStatements;

      data["Value Added"] =
        data["Sales"] -
        this.sum([
          data["Cost of Good Sold"],
          data["Marketing Costs"],
          data["General Management Costs"]
        ]);

      data["Net Operating Profit/(Loss)"] =
        data["Value Added"] -
        this.sum([
          data["Staff Salaries & Benefits"],
          data["Depreciation"],
          data["Other Expense (less Other Income)"],
          data["Interest On Loan/Hires"],
          data["Company Tax"]
        ]);

      data["Operating Profit/(Loss)[EBT]"] =
        data["Net Operating Profit/(Loss)"];
    },

    balance() {
      const metadataSheets = this.resource.data.metadataSheets;
      
      const total_assets = this.sum([
        metadataSheets.Cash,
        metadataSheets["Trade Receivables"],
        metadataSheets.Inventories,
        metadataSheets["Other Current Assets"],
        metadataSheets["Fixed Assets"]
      ]);

      metadataSheets["Current Asset"] = this.sum([
        metadataSheets.Cash,
        metadataSheets["Trade Receivables"],
        metadataSheets.Inventories,
        metadataSheets["Other Current Assets"],
      ]);

      metadataSheets["Current Liabilities"] = this.sum([
        metadataSheets["Trade Payables"],
        metadataSheets["Other Current Liabilities"]
      ]);

      metadataSheets["Non-Current Liabilities"] = this.sum([
        metadataSheets["Other Non-Current Liabilities"],
        metadataSheets["Stockholders' Equity"],
        metadataSheets["Common Shares Outstanding"]
      ]);

      const total_liabilities = this.sum([
        metadataSheets["Trade Payables"],
        metadataSheets["Other Current Liablities"],
        metadataSheets["Stockholders' Equity"],
        metadataSheets["Other Non-Current Liabilities"],
        metadataSheets["Common Shares Outstanding"]
      ]);

      this.resource.data.metadataSheets.Balance =
        total_assets - total_liabilities;

        console.log(total_assets, total_liabilities);
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
    edit(value){
      this.resource.data.setMethod = null;
    },
    value: {
      handler(value) {

        this.resource = new Financial();

        if (!value.id) return (this.edit = true);

        this.resource.data = { ...this.resource.data, ...value };
        this.edit = false;
      }
    },
    newPeriod(val) {
      if(val.setMethod === 'add') {
        this.resource.data.setMethod = 'add';
      }
    },
    "resource.data": {
      handler() {
        this.costOfGoodSold();
        // this.depreciation();
        this.netProfit();
        this.balance();
        this.$emit("update");
      },
      deep: true
    }
  }
};
</script>
