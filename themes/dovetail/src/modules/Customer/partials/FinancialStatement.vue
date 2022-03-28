<template>
  <v-card>
    <v-card-text>
      <v-row>
        <v-col cols="12" md="3">
          <v-card>
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
                <v-list-item v-for="(item, i) in dataset.statements" :key="i">
                  <v-list-item-content>
                    <v-list-item-subtitle>
                      {{ i + 1 }} -
                      {{ item.period }}
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
          </v-card>
        </v-col>
        <v-col cols="12" md="9">
          <period-form v-model="period" :newPeriod="newPeriod" @update="update"></period-form>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: ["value"],

  components: {
    PeriodForm: () => import("./PeriodForm.vue")
  },

  computed: {
    dataset: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit("input", value);
      }
    }
  },

  data: () => ({
    period: null,
    newPeriod: null,
  }),

  methods: {
    setPeriod(index) {
      if (index === 0) {
        this.period = {};
        this.newPeriod = { setMethod: 'add' };
      } else {
        this.period = this.dataset.statements[index - 1];
      }
    },

    update() {
      this.$emit("update");
    },
  }
};
</script>

<style>
.text-right input {
  text-align: right;
}
</style>
