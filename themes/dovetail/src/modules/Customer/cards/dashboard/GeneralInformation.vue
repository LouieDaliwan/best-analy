<template>
  <v-card>
    <v-card-text class="pa-7">
      <h3 class="d-flex align-center">
        <span v-text="trans('General Information')"></span>
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              icon
              :to="{
                name: 'companies.edit',
                params: { id: value.id }
              }"
              exact
              small
              v-bind="attrs"
              v-on="on"
              ><v-icon small class="ml-2 incomplete--text"
                >mdi-pencil</v-icon
              ></v-btn
            >
          </template>
          <span v-text="trans(`Edit General Information`)"></span>
        </v-tooltip>
      </h3>
      <v-divider></v-divider>
      <template v-for="(item, i) in dataset">
        <div :key="i">
          <h4 class="my-5" v-text="trans(item.title)"></h4>
          <v-row no-gutters>
            <template v-for="(col, j) in gen2Col(item.details)">
              <v-col cols="12" sm="6" :key="i + '-' + j">
                <div
                  class="mb-5"
                  v-for="(detail, k) in col"
                  :key="i + '-' + j + '-' + k"
                >
                  <label
                    for=""
                    class="incomplete--text"
                    v-text="trans(detail.label)"
                  ></label>
                  <div v-text="detail.value || '-'"></div>
                </div>
              </v-col>
            </template>
          </v-row>
        </div>
      </template>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: ["value"],

  computed: {
    dataset: {
      get() {
        return [
          {
            title: "Company Information",
            details: [
              {
                label: "Name",
                value: this.value.name
              },
              {
                label: "Address",
                value: this.value.metadata.address
              },
              {
                label: "Staff Strength",
                value: this.value.metadata.staffstrength
              },
              {
                label: "Email",
                value: this.value.metadata.email
              },
              {
                label: "Website",
                value: this.value.metadata.website
              },
              {
                label: "Industry",
                value: this.value.metadata.industry
              }
            ]
          },
          {
            title: "Business Details",
            details: [
              {
                label: "Project Name",
                value: "Chocolate"
              },
              {
                label: "Business Status",
                value: "Soft Opening"
              },
              {
                label: "Industry Sector",
                value: "Tourism"
              },
              {
                label: "Business Size",
                value: "SME"
              },
              {
                label: "Project Location",
                value: "Dubai"
              },
              {
                label: "Funding Program",
                value: "Bedaya"
              },
              {
                label: "Project Type",
                value: "Industrial"
              }
            ]
          },
          {
            title: "Applicant Details",
            details: [
              {
                label: "Applicant Name",
                value: this.value.applicant.metadata.name
              },
              {
                label: "Email Address",
                value: this.value.applicant.metadata.email
              },
              {
                label: "Designation",
                value: this.value.applicant.metadata.destination
              },
              {
                label: "Mobile Number",
                value: this.value.applicant.metadata.number
              },
              {
                label: "Contact Person",
                value: this.value.applicant.metadata.contact
              },
              {
                label: "Mobile Number",
                value: this.value.applicant.metadata.number
              }
            ]
          }
        ];
      }
    }
  },

  methods: {
    gen2Col(array) {
      array = [...array];

      const len = array.length;
      const colLen = len / 2;
      const rem = len % 2;
      const newColIndex = rem ? colLen + 1 : colLen;

      return [array.splice(0, newColIndex), array];
    }
  },

  mounted() {
    console.log(this.value);
  }
};
</script>
