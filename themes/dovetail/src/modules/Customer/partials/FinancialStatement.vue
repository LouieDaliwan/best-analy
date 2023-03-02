<template>
  <v-card>
    <v-card-text v-if="checkInvesmentValueAndProjectType">
      <div class="mt-5 ml-5">
        <small><span class="red--text">*</span> Denotes compulsory items</small>
      </div>
      <v-card-text>
        <v-card>
          <v-card-text>
            <h3 class="mb-2">Type of Statement <span class="red--text">*</span></h3>
            <label>Audited Financials</label>
            <input
              :checked="value.metadata.type == 'Audited'"
              name="metadata[type]"
              type="radio"
              value="Audited"
              @click="changeAudit('Audited')"
            />
            <span class="d-inline-block mx-3"></span>
            <label>In-House Financials</label>
            <input
              :checked="value.metadata.type == 'In-House'"
              name="metadata[type]"
              type="radio"
              value="In-House"
              @click="changeAudit('In-House')"
            />
          </v-card-text>
        </v-card>
      </v-card-text>

    <!-- <v-card-text > -->
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
                    <v-btn icon small color="error" @click.prevent="deleteStatement(item)"
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
    <v-card-text v-else class="text-center">
          <h3 class="muted--text" v-text="trans('Financial Statement Form will appear here')"></h3>
          <p class="muted--text mb-0" v-text="trans('Update the Project Type in the Project Information.')"></p>
    </v-card-text>
  </v-card>
</template>

<script>
import { mapActions } from 'vuex'
import $api from '../routes/api'
import man from '@/components/Icons/ManThrowingAwayPaperIcon.vue'
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
    },

    checkInvesmentValueAndProjectType() {
       return this.value.details.metadata.project_type != null;
    }
  },

  data: () => ({
    period: null,
    newPeriod: null,
  }),

  methods: {

    changeAudit(value)
    {
      axios.post(`/api/v1/customers/${this.value.id}/update-audit`, {
        type: value,
        name: this.value.name,
        refnum: this.value.refnum,
        code: this.value.code
      }).then(({data}) => {
        console.log(data);
      });
    },

    ...mapActions({
      errorDialog: 'dialog/error',
      loadDialog: 'dialog/loading',
      showDialog: 'dialog/show',
      hideDialog: 'dialog/hide',
      showSnackbar: 'snackbar/show',
    }),

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

    deleteStatement(item) {
      this.showDialog({
        color: 'warning',
        illustration: man,
        illustrationWidth: 200,
        illustrationHeight: 160,
        width: '420',
        title: 'You are about to move the statement into trash',
        text: ['The statement will removed and will not be recovered', trans('Are you sure you want to move :name to Trash?', {name: item.period})],
        buttons: {
          cancel: { show: true, color: 'link' },
          action: {
            text: 'Move to Trash',
            color: 'warning',
            callback: (dialog) => {
              this.loadDialog(true)
              this.destroyResource(item)
            }
          }
        }
      })

      this.$emit("updateStatementLists");
    },

    destroyResource (item) {
      item.loading = true
      axios.delete($api.financialRatioDelete(item))
        .then(response => {
          this.showSnackbar({
            text: trans_choice('Statement successfully removed', 1)
          })
          this.hideDialog();
          this.$emit("updateStatementLists");
        })
        .catch(err => {
          this.errorDialog({
            width: 400,
            buttons: { cancel: { show: false } },
            title: trans('Whoops! An error occured'),
            text: err.response.data.message,
          })
        })
        .finally(() => {
           console.log('finally');
        })
    },
  }
};
</script>

<style>
.text-right input {
  text-align: right;
}
</style>
