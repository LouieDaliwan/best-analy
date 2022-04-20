<template>
  <v-card>
    <v-card-text class="pa-7">
      <!-- <h3 class="mb-5" v-text="trans('SME Ratings Report')"></h3>
      <v-divider class="mb-5"></v-divider> -->
      <div class="d-flex align-center justify-space-between mb-5">
        <h3 v-text="trans('SME Rating')"></h3>
      </div>
      <v-divider class="mb-5"></v-divider>
      <canvas ref="chart-el" width="400" height="200" v-if="value.ratings.answered_index != 0"></canvas>
      <v-card v-else flat>
        <v-card-text class="text-center">
          <v-row justify="center" align="center">
            <empty-icon class="muted--text"></empty-icon>
          </v-row>
          <h3 class="muted--text" v-text="trans('No scores to show')"></h3>
          <p class="muted--text mb-0" v-text="trans('Start by answering the SME rating surveys or filling out financial statement.')"></p>
        </v-card-text>
      </v-card>
      <v-row no-gutters class="mb-3">
        <v-col cols="12" sm="6">
          <b><span v-text="trans('Score')"></span>:</b>
          <span
            class="muted--text light rounded-1 py-1 px-3 rounded-xl"
            v-text="trans(`${value.ratings.overall_score}`)"
          ></span>
          <!-- <span class="link--text" v-text="trans(`${value.ratings.overall_score}`)"></span> -->
        </v-col>
        <v-col cols="12" sm="6" class="text-sm-right">
          <b><span v-text="trans('Results')"></span>:</b>
          <span
            class="muted--text light rounded-1 py-1 px-3 rounded-xl"
            v-text="trans(`${value.ratings.results}`)"
          ></span>
        </v-col>
      </v-row>
      <v-list>
        <template v-for="(item, i) in smeRatings">
          <v-list-item :class="{ 'table-row': i % 2 === 1 }" :key="i">
            <v-list-item-content class="mx-0 px-0 my-0 py-0">
                <v-list-item-subtitle>
                  <v-btn
                  text
                  :to="goToCompanySurveyPage(item)"
                  exact
                  small
                  >
                <span :class="`${item.score ? 'primary' : 'incomplete'}--text`" v-text="trans(item.label)"></span>
                </v-btn>
              </v-list-item-subtitle>
            </v-list-item-content>
            <v-list-item-action class="mx-0 px-0">
              <span v-text="`${item.score == 0 ? '-' : item.score }`" v-if="item.score"></span>
              <v-tooltip bottom v-else>
                <template v-slot:activator="{ on, attrs }">
                  <v-btn small text
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
  props:["value"],

  data: () => ({
    smeRatings: [],
  }),
  methods: {
    initChart() {
      const chartEl = this.$refs["chart-el"];
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
            'score': JSON.stringify(item.score),
            'code' : item.code,
            'id' : item.id
          }
          
          smeObject.push(obj);
      });  

      this.smeRatings = smeObject; 
    },

    goToCompanySurveyPage (index) {
      
      if(index.label == 'Financial Score' || index.label == '5th Module') {
        return '';
      }

      const company = this.$route.params.id
      return {
        name: 'companies.survey', params: {
          id: company,
          taxonomy: index.code,
          survey: index.id,
        }
      }
    },
  },
  mounted() {
    this.convertToArrSME();
    this.initChart();
  }
};
</script>

