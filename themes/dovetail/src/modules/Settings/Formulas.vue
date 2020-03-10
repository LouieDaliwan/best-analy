<template>
  <admin>
    <page-header>
      <template v-slot:title v-text="trans('General Settings')"></template>
    </page-header>

    <v-card class="mb-3">
      <v-card-title v-text="trans('Performance Index Report')"></v-card-title>
      <v-card-text>
        <p v-text="trans('Overall Findings Value Formula')"></p>
        <div style="overflow-x: scroll">
          <pre><code class="javascript" style="width: 100%; overflow-x: scroll;white-space: pre;">
// IndexOverallValue = sum of user's input's subscore divided by sum of survey's total possible score
// E.g.
IndexOverallValue = 38/105 = 0.36 (or 36%)
          </code></pre>
        </div>
      </v-card-text>

      <v-card-text>
        <p v-text="trans('Overall Findings Comment Formula')"></p>
        <div style="overflow-x: scroll">
          <pre><code class="javascript" style="width: 100%; overflow-x: scroll;white-space: pre;">
  OverallFindingsComment = ''

  IndexOverallValue = round((SubscoreScore/SubscoreTotal)*100, 2)
  IndexMeterTotalValue = IndexOverallValue/100
  Univrules_C5_red = 0.49
  Univrules_C6_amber = 0.89

  if (IndexMeterTotalValue > Univrules_C5_red) {
    if (IndexMeterTotalValue > Univrules_C6_amber) {
      OverallFindingsComment = '(Above 90%) Overall, the :PerformanceIndexCode seemed to suggest that a well-controlled...'
    } else {
      OverallFindingsComment = '(50-89%) Overall, the :PerformanceIndexCode seemed to suggest a generall...'
    }
  } else {
    OverallFindingsComment = '(Below 50) Overall, the :PerformanceIndexCode seemed to suggest a serious efficiency...'
  }
          </code></pre>
        </div>
        <v-row>
          <v-col cols="12" md="4">
            <v-text-field label="IndexOverallValue" placeholder="E.g. 71.43" dense outlined v-model="formulas.IndexOverallValue.variable['total']"></v-text-field>
            <v-text-field label="Performance Index" hint="Allowed values: FMPI, BSPI, PMPI, and HRPI" dense outlined v-model="formulas.IndexOverallValue.variable['index']"></v-text-field>
          </v-col>
          <v-col cols="12" md="auto">
            <v-btn @click="checkFormula('getOverallFindingsComment', formulas.IndexOverallValue.variable, formulas.IndexOverallValue)">Check</v-btn>
          </v-col>
          <v-col cols="12" md="5">
            <p>Results: <span v-html="formulas.IndexOverallValue.results"></span></p>
          </v-col>
        </v-row>
      </v-card-text>

      <v-card-text>
        <p v-text="trans('Performance Index Element\'s Comments')"></p>
        <pre><code class="javascript" style="width: 100%; overflow-x: scroll;white-space: pre;">
Comments = []
GroupAvg = average score of elements in survey (e.g. AVG(LeadershipScore, RiskManagementScore, ...))

if (GroupAvg >= 1) {
  Comments[0] = '(100) The organisation is perceived to have achieved optimal...'
} else {
  LastElement = GroupAvg sort from lowest score and get the last element
  SecondToTheLast = GroupAvg sort from lowest score and get the second to last element

  if (LastElement == SecondToTheLast) {
    Comments[0] = 'Based on the responses to the individual statements in the financial management survey, :item1 and :item2 activities have been most well implemented.'
  } else {
    Comments[0] = 'Based on the responses to the individual statements in the financial management survey, :item1 has been the most well implemented'
  }

  if (LastElement == SecondToTheLast) {
    Comments[0] += ''
  } else {
    Comments[0] += 'This is followed by :item1 with a score of :score'
    Comments[0] += 'However, it is imperative that the organisation strive to uplift all other financial management elements.'
  }
}
        </code></pre>
        <v-row>
          <v-col cols="12" md="4">
            <v-text-field label="Survey ID" placeholder="" dense outlined v-model="formulas.ElementScoreFirstComment.variable['survey_id']"></v-text-field>
            <v-text-field readonly label="Performance Index" hint="Allowed values: FMPI, BSPI, PMPI, and HRPI" dense outlined v-model="formulas.ElementScoreFirstComment.variable['index']"></v-text-field>
            <div v-for="(field, i) in resources.survey['fields:grouped']" :key="i">
              <v-text-field :label="i" placeholder="E.g. 0.5" dense outlined v-model="formulas.ElementScoreFirstComment.variable['group'][i]"></v-text-field>
            </div>
            <div v-if="resources.survey['fields:grouped']">
              <v-btn @click="checkFormula('getFirstBoxComment', formulas.ElementScoreFirstComment.variable, formulas.ElementScoreFirstComment)">Calculate</v-btn>
            </div>
          </v-col>
          <v-col cols="12" md="auto">
            <v-btn @click="getSurveyFromId(formulas.ElementScoreFirstComment.variable['survey_id'])">Get Survey Fields</v-btn>
          </v-col>
          <v-col cols="12" md="5">
            <p>Results:</p>
            <ul>
              <li :key="i" v-for="(p, i) in formulas.ElementScoreFirstComment.results">
                <span v-html="p"></span>
              </li>
            </ul>
          </v-col>
        </v-row>
      </v-card-text>

      <v-card-text>
        <p v-text="trans('Key Enablers')"></p>
        <v-row>
          <v-col cols="12" md="4">
            <v-text-field label="Survey ID" placeholder="" dense outlined v-model="formulas.KeyEnablers.variable['survey_id']"></v-text-field>
            <v-text-field label="Performance Index" hint="Allowed values: FMPI, BSPI, PMPI, and HRPI" dense outlined v-model="formulas.KeyEnablers.variable['index']"></v-text-field>
            <v-text-field label="Customer ID" placeholder="" dense outlined v-model="formulas.KeyEnablers.variable['customer_id']"></v-text-field>
            <v-text-field readonly label="User ID (readonly)" placeholder="" dense outlined v-model="formulas.KeyEnablers.variable['user_id']"></v-text-field>
          </v-col>
          <v-col cols="12" md="auto">
            <v-btn @click="checkFormula('getKeyEnablers', formulas.KeyEnablers.variable, formulas.KeyEnablers)">Check</v-btn>
          </v-col>
          <v-col cols="12" md="5">
            <p>Results:</p>
            <div :key="i" v-for="(d, i) in formulas.KeyEnablers.results">
              <div><strong v-html="i" class="mb-0"></strong></div>
              <div class="ml-3">
                <div v-html="d.value"></div>
                <div v-html="d.comment"></div>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-card-text>

      <v-card-text>
        <p v-text="trans('Key Strategic Recommendations')"></p>
        <v-row>
          <v-col cols="12" md="4">
            <v-text-field label="Survey ID" placeholder="" dense outlined v-model="formulas.KeyStrategicRecommendations.variable['survey_id']"></v-text-field>
            <v-text-field label="Performance Index" hint="Allowed values: FMPI, BSPI, PMPI, and HRPI" dense outlined v-model="formulas.KeyStrategicRecommendations.variable['index']"></v-text-field>
            <v-text-field label="Customer ID" placeholder="" dense outlined v-model="formulas.KeyStrategicRecommendations.variable['customer_id']"></v-text-field>
            <v-text-field readonly label="User ID (readonly)" placeholder="" dense outlined v-model="formulas.KeyStrategicRecommendations.variable['user_id']"></v-text-field>
          </v-col>
          <v-col cols="12" md="auto">
            <v-btn @click="checkFormula('getKeyStrategicRecommendations', formulas.KeyStrategicRecommendations.variable, formulas.KeyStrategicRecommendations)">Check</v-btn>
          </v-col>
          <v-col cols="12" md="5">
            <p>Results:</p>
            <div :key="i" v-for="(d, i) in formulas.KeyStrategicRecommendations.results">
              <div><strong v-html="i" class="mb-0"></strong></div>
              <div class="ml-3">
                <div v-html="d.value"></div>
                <div v-html="d.comment"></div>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </admin>
</template>

<script>
import $auth from '@/core/Auth/auth'
import IndexPicker from '@/modules/Survey/cards/IndexPicker'
import 'highlight.js/styles/atom-one-dark.css'

export default {
  components: {
    IndexPicker,
  },

  data: () => ({
    resources: {
      survey: {},
      indices: [],
    },
    formulas: {
      IndexOverallValue: {
        results: 'no data',
        variable: {
          index: 'FMPI',
          total: 71.43,
        },
      },
      ElementScoreFirstComment: {
        results: [],
        variable: {
          group: [],
          index: 'fmpi',
          survey_id: 1,
        },
      },
      KeyEnablers: {
        results: '',
        variable: {
          user_id: $auth.getId(),
        },
      },
      KeyStrategicRecommendations: {
        results: '',
        variable: {
          user_id: $auth.getId(),
        },
      },
    },
  }),

  methods: {
    loadHighlightJs () {
      let hljs = require('highlight.js/lib/highlight')
      let javascript = require('highlight.js/lib/languages/javascript')
      hljs.registerLanguage('javascript', javascript)
      document.querySelectorAll('pre code').forEach((block) => {
        // console.log(block)
        // let t = hljs.highlight('javascript', 'var f = 9').value
        hljs.highlightBlock(block)
      })
    },

    checkFormula (type, value, item) {
      axios.get(
        `/best/formula/check`, { params: { type: type, attributes: value }}
      ).then(response => {
        item.results = response.data
      })
    },

    getSurveyFromId (id, field = 0) {
      axios.get(
        `/api/v1/surveys/${id}`
      ).then(response => {
        this.resources.survey = response.data.data
        let group = {}
        Object.keys(this.resources.survey['fields:grouped']).forEach(function (i) {
          group[i] = ''
        })
        if (field == 0) {
          this.formulas.ElementScoreFirstComment.variable.index = this.resources.survey.formable.alias
          this.formulas.ElementScoreFirstComment.variable.group = group
        }

        if (field == 1) {
          this.formulas.KeyEnablers.variable.index = this.resources.survey.formable.alias
        }
      })
    },
  },

  mounted () {
    this.loadHighlightJs()
  },
}
</script>

<style>
code.hljs {
  color: #fff;
  background-color: #474949;
}
.hljs-comment {
  color: #959ba7;
}
</style>
