<template>
  <v-card>
    <v-card-text class="pa-7">
      <div class="d-flex align-center justify-space-between mb-3">
        <h3 v-text="trans('Key Financial Ratio')"></h3>
        <v-btn text color="primary" @click="previewRatiosReport"
          ><v-icon class="primary--text" small>mdi-eye</v-icon
          ><span v-text="trans('View Financial Analysis Report')"></span
        ></v-btn>
      </div>
      <v-divider class="mb-5"></v-divider>
      <v-row class="mb-5">
        <v-col cols="12" sm="6">
          <b><span v-text="trans('Sector')"></span>:</b>
          <span v-text="trans('Non-industrial')"></span
        ></v-col>
        <v-col cols="12" sm="6" class="text-sm-right">
          <b><span v-text="trans('Date')"></span>:</b>
          <span v-text="trans(value.date)"></span
        ></v-col>
      </v-row>
      <div class="mb-5">
        <ul class="pa-0" style="list-style: none">
          <template v-for="(item, i) in ratings">
            <li class="d-inline mr-3" :key="i">
              <v-icon
                :color="item.color"
                small
                :class="
                  `score-${item.text.replace(' ', '-').toLowerCase()}--text`
                "
                >mdi-circle</v-icon
              >
              <span v-text="trans(item.text)"></span>
            </li>
          </template>
        </ul>
      </div>
      <v-row>
        <template v-for="(item, i) in gen2Col(keyFinancialRatio)">
          <v-col :key="i">
            <v-list class="py-0">
              <template v-for="(subitem, i) in item">
                <v-list-item :class="{ 'table-row': i % 2 !== 1 }" :key="i">
                  <v-list-item-content>
                    <v-list-item-subtitle
                      v-text="trans(subitem.label)"
                    ></v-list-item-subtitle>
                  </v-list-item-content>
                  <v-list-item-action>
                    <v-icon
                      small
                      class="ml-2"
                      :class="`score-${subitem.score}--text`"
                      :color="subitem.color"
                      >mdi-circle</v-icon
                    >
                  </v-list-item-action>
                </v-list-item>
              </template>
            </v-list>
          </v-col>
        </template>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
import $auth from "@/core/Auth/auth";

export default {
  props: ["value"],

  data: vm => ({
    ratings: [
      { text: "Excellent", color: "#40AF49" },
      { text: "Good", color: "#9BCF44" },
      { text: "Moderate", color: "#8A2B91" },
      { text: "Poor", color: "#F9BE00" },
      { text: "Very Poor", color: "#F20000" }
    ],
    keyFinancialRatio: [
      {
        label: "Gross Profit Margin",
        ...vm.value.gross_margin
      },
      {
        label: "Net Profit Margin",
        ...vm.value.net_margin
      },
      {
        label: "Return of Investment",
        ...vm.value.roi
      },
      {
        label: "Raw Materials Margin",
        ...vm.value.raw_materials
      },
      {
        label: "Current Ratio",
        ...vm.value.current_ratio
      },
      {
        label: "Long-term Debt Ratio",
        ...vm.value.debt_ratio
      }
    ]
  }),

  methods: {
    gen2Col(array) {
      array = [...array];

      const len = array.length;
      const colLen = len / 2;
      const rem = len % 2;
      const newColIndex = rem ? colLen + 1 : colLen;

      return [array.splice(0, newColIndex), array];
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
  }
};
</script>
