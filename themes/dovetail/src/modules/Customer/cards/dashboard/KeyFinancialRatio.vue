<template>
  <v-card>
    <v-card-text class="pa-7">
      <div class="d-flex align-center justify-space-between mb-3">
        <h3 v-text="trans('Key Financial Ratio')"></h3>
        <v-btn text color="primary"
          ><v-icon class="primary--text" small>mdi-eye</v-icon
          ><span v-text="trans('View Financial Analysis Report')"></span
        ></v-btn>
      </div>
      <v-divider class="mb-5"></v-divider>
      <div class="mb-5">
        <b><span v-text="trans('Sector')"></span>:</b>
        <span v-text="trans('Non-industrial')"></span>
      </div>
      <div class="mb-5">
        <ul class="pa-0" style="list-style: none">
          <template v-for="(item, i) in ratings">
            <li class="d-inline mr-3" :key="i">
              <v-icon
                small
                :class="`rate-${item.replace(' ', '-').toLowerCase()}--text`"
                >mdi-circle</v-icon
              >
              <span v-text="trans(item)"></span>
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
                      :class="`rate-${subitem.rate}--text`"
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
export default {
  data: () => ({
    ratings: ["Excellent", "Good", "Moderate", "Poor", "Very Poor"],
    keyFinancialRatio: [
      {
        label: "Breakeven Point",
        rate: "good",
        score: 3.2,
      },
      {
        label: "Working Capital",
        rate: "moderate",
        score: 4.0,
      },
      {
        label: "Net Profit Margin",
        rate: "good",
        score: 3.2,
      },
      {
        label: "Gross Profit Margin",
        rate: "excellent",
        score: 5.05,
      },
      {
        label: "COPGS Margin",
        rate: "good",
        score: 3.2,
      },
      {
        label: "Current Ratio",
        rate: "moderate",
        score: 4.0,
      },
      {
        label: "Long-Term Debt Ration",
        rate: "good",
        score: 3.2,
      },
      {
        label: "Return of Investment",
        rate: "excellent",
        score: 5.05,
      },
    ],
  }),

  methods: {
    gen2Col(array) {
      array = [...array];

      const len = array.length,
        colLen = len / 2,
        rem = len % 2,
        newColIndex = rem ? colLen + 1 : colLen;

      return [array.splice(0, newColIndex), array];
    },
  },
};
</script>