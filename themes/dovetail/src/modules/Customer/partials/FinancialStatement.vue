<template>
  <v-card>
    <v-card-text>
      <v-row>
        <v-col cols="12" md="3">
          <v-sheet elevation="2">
            <v-list>
              <v-subheader class="d-flex"
                ><h3>Periods</h3>
                <v-spacer></v-spacer>
              </v-subheader>
              <v-list-item-group color="primary" mandatory @change="setPeriod">
                <v-list-item>
                  <v-list-item-avatar>
                    <v-icon small>mdi-plus</v-icon>
                  </v-list-item-avatar>
                  <v-list-item-content>
                    <v-list-item-title>
                      Add
                    </v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item v-for="(item, i) in resources.data" :key="i">
                  <v-list-item-content>
                    <v-list-item-subtitle>
                      {{ i + 1 }} -
                      {{ item.description }}
                    </v-list-item-subtitle>
                  </v-list-item-content>
                  <v-list-item-action>
                    <v-btn icon small color="error"
                      ><v-icon small>mdi-delete</v-icon></v-btn
                    >
                  </v-list-item-action>
                </v-list-item>
              </v-list-item-group>
            </v-list>
          </v-sheet>
        </v-col>
        <v-col cols="12" md="9">
          <period-form v-model="period"></period-form>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
import Resources from "@/core/Models/Resources";

export default {
  components: {
    PeriodForm: () => import("./PeriodForm.vue")
  },

  data: () => ({
    resources: new Resources(),
    period: {}
  }),

  methods: {
    getResources() {
      this.resources.data = [
        {
          id: 1,
          description: "Q1 2018",
          sales: "15000",
          raw: "7600"
        },
        {
          id: 2,
          description: "Q2 2018",
          sales: "2500",
          raw: "1500"
        },
        {
          id: 3,
          description: "Q3 2018",
          sales: "12000",
          raw: "5100"
        },
        {
          id: 4,
          description: "Q4 2018",
          sales: "50000",
          raw: "16099"
        }
      ];
    },

    setPeriod(index) {
      if (index === 0) this.period = {};
      else this.period = this.resources.data[index - 1];
    }
  },

  mounted() {
    this.getResources();
  }
};
</script>

<style>
.text-right input {
  text-align: right;
}
</style>
