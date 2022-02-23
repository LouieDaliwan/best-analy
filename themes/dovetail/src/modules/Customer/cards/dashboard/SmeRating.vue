<template>
  <v-card>
    <v-card-text class="pa-7">
      <h3 class="mb-5" v-text="trans('SME Ratings Report')"></h3>
      <v-divider class="mb-5"></v-divider>
      <v-row no-gutters>
        <v-col cols="12" sm="6" class="mb-5">
          <b><span v-text="trans('Score')"></span>:</b>
          <span class="link--text" v-text="trans('Scores Incomplete')"></span>
        </v-col>
        <v-col cols="12" sm="6" class="text-sm-right">
          <b><span v-text="trans('Results')"></span>:</b>
          <span
            class="incomplete white--text rounded-1 py-1 px-5"
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
export default {
  data: () => ({
    smeRatings: [
      {
        label: "Qualitative Score (Most Recent)",
        score: null
      },
      {
        label: "Financial Score",
        score: null
      },
      {
        label: "Applicant Score Cooperation",
        score: null
      },
      {
        label: "Best Score",
        score: 5.05
      }
    ]
  })
};
</script>
