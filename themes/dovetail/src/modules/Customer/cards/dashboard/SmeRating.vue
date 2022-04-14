<template>
  <v-card>
    <v-card-text class="pa-7">
      <h3 class="mb-5" v-text="trans('SME Ratings Report')"></h3>
      <v-divider class="mb-5"></v-divider>
      <canvas ref="chart-el" width="400" height="200"></canvas>
      <v-row no-gutters class="my-5">
        <v-col cols="12" sm="6">
          <b><span v-text="trans('Score')"></span>:</b>
          <span class="link--text" v-text="trans('Scores Incomplete')"></span>
        </v-col>
        <v-col cols="12" sm="6" class="text-sm-right">
          <b><span v-text="trans('Results')"></span>:</b>
          <span
            class="muted--text light rounded-1 py-1 px-5"
            style="border-radius: 0.3125rem"
            v-text="trans('Incomplete')"
          ></span>
        </v-col>
      </v-row>
      <v-list>
        <template v-for="(item, i) in smeRatings">
          <v-list-item :class="{ 'table-row': i % 2 === 1 }" :key="i">
            <v-list-item-content>
              <v-list-item-subtitle
                :class="`${item.score ? 'primary' : 'incomplete'}--text`"
                v-text="trans(item.label)"
              ></v-list-item-subtitle>
            </v-list-item-content>
            <v-list-item-action>
              <span v-text="item.score" v-if="item.score"></span>
              <v-tooltip bottom v-else>
                <template v-slot:activator="{ on, attrs }">
                  <v-btn small icon
                    ><v-icon
                      small
                      class="ml-2 incomplete--text"
                      v-bind="attrs"
                      v-on="on"
                      >mdi-pencil</v-icon
                    ></v-btn
                  >
                </template>
                <span v-text="trans(`Answer ${item.label}`)"></span>
              </v-tooltip>
            </v-list-item-action>
          </v-list-item>
        </template>
      </v-list>
    </v-card-text>
  </v-card>
</template>

<script>
import Chart from "chart.js/auto";

export default {
  props: ["value"],

  data() {
    return {
      smeRatings: [],    
    }
  }, 
    
  methods: {
    initChart() {
      const chartEl = this.$refs["chart-Pcel"];
      const chart = new Chart(chartEl, {
        type: "line",
        data: {
          labels: this.smeRatings.map(item => item.label),
          datasets: [
            {
              label: "# of Votes",
              data: this.smeRatings.map(item => item.score),
              borderColor: "rgb(75, 192, 192)"
            }
          ]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          },
          plugins: { legend: { display: false } }
        }
      });
    },

    convertToArrSME() {
      var smeObject = [];
      _.map(this.value.ratings.smeRatings, function(item,) {
          const obj = {
            'label' : item.label,
            'score': parseFloat(JSON.stringify(item.score))
          }

          smeObject.push(obj);
      });  

      console.log('after');
      console.log(smeObject);
      this.smeRatings = smeObject;
    }
  },

  mounted() {
    this.convertToArrSME();
    this.initChart();
  }
};
</script>
