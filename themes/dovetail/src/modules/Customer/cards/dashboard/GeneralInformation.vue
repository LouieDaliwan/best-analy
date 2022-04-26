<template>
  <v-card class="sticky">
    <v-card-text class="pa-7">
      <!-- <h3 class="mb-5" v-text="trans('SME Ratings Report')"></h3> -->
      <div class="d-flex align-center justify-space-between mb-5">
        <h3 v-text="trans('General Information')"></h3>
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn
              :to="{
                name: 'companies.edit',
                params: { id: value.id }
                }"
              icon
              large
              v-on="on"
              color="primary"
            >
              <v-icon small>mdi-pencil</v-icon>
            </v-btn>
          </template>
          <span>{{ trans("Update Information") }}</span>
        </v-tooltip>
        <!-- <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn
              icon
              large
              :to="{
                name: 'companies.edit',
                params: { id: value.id }
                }"
              color="primary"
              ><v-icon small class="mx-2">mdi-pencil</v-icon>
                <span v-text="trans(`Update General Information`)"></span>
              </v-btn>
          </template>
          <span>{{ trans("Update Information") }}</span>
        </v-tooltip> -->

      </div>
      <v-divider></v-divider>
      <template v-for="(item, i) in dataset">
        <div :key="i">
          <p class="my-5 font-weight-bold" v-text="trans(item.title)"></p>
          <v-row no-gutters>
            <template v-for="(col, j) in gen2Col(item.details)">
              <v-col cols="12" lg="12" md="6" :key="i + '-' + j">
                <div
                  v-for="(detail, k) in col"
                  :key="i + '-' + j + '-' + k"
                  class="mb-3"
                  >
                  <v-alert
                    :icon="detail.icon"
                    class="px-0 py-0"
                    >
                    <span v-if="detail.value" v-text="detail.value"></span>
                    <span v-else class="muted--text font-italic" v-text="detail.label"></span>
                  </v-alert>
                </div>
              </v-col>
            </template>
          </v-row>
        </div>
      </template>
      <!-- <v-btn
        block
        large
        :to="{
          name: 'companies.edit',
          params: { id: value.id }
          }"
        color="primary"
        ><v-icon small class="mx-2">mdi-pencil</v-icon>
          <span v-text="trans(`Update General Information`)"></span>
        </v-btn> -->
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
          // {
          //   title: "Project Information",
          //   details: [
          //     {
          //       label: "Name",
          //       value: this.value.name
          //     },
          //     {
          //       label: "Address",
          //       value: this.value.metadata.address
          //     },
          //     {
          //       label: "Staff Strength",
          //       value: this.value.metadata.staffstrength
          //     },
          //     {
          //       label: "Email",
          //       value: this.value.metadata.email
          //     },
          //     {
          //       label: "Website",
          //       value: this.value.metadata.website
          //     },
          //     {
          //       label: "Industry",
          //       value: this.value.metadata.industry
          //     }
          //   ]
          // },
          {
            title: "Project Information",
            details: [
              // {
              //   label: "Project Name",
              //   value: this.value.name,
              //   icon: "mdi-office-building"
              // },
              {
                label: "Trade Name (English)",
                value: this.value.details.metadata.trade_name_en,
                icon: "mdi-briefcase-outline"
              },
              {
                label: "Trade Name (Arabic)",
                value: this.value.details.metadata.trade_name_ar,
                icon: "mdi-translate"
              },
              {
                label: "License No",
                value: this.value.details.metadata.license_no,
                icon: "mdi-folder-outline"
              },
              {
                label: "Business Description",
                value: this.value.details.metadata.description,
                icon: "mdi-information-outline"
              },
              {
                label: "Industry Sector",
                value: this.value.details.metadata.industry_sector,
                icon: "mdi-office-building"
              },
              {
                label: "Project Type",
                value: this.value.details.metadata.project_type,
                icon: "mdi-domain"
              },
              {
                label: "Business Size",
                value: this.value.details.metadata.business_size,
                icon: "mdi-account-multiple-outline"
              },
              {
                label: "Project Location",
                value: this.value.details.metadata.project_location,
                icon: "mdi-map-marker-outline"
              },
              {
                label: "Funding Program",
                value: this.value.details.metadata.funding_program,
                icon: "mdi-currency-usd"
              },
            ]
          },
          {
            title: "Applicant Details",
            details: [
              {
                label: "Applicant Name",
                value: this.value.applicant.metadata.name,
                icon: "mdi-account-outline"
              },
              {
                label: "Email Address",
                value: this.value.applicant.metadata.email,
                icon: "mdi-email-outline"
              },
              {
                label: "Designation",
                value: this.value.applicant.metadata.destination,
                icon: "mdi-account-tie-outline"
              },
              {
                label: "Mobile Number",
                value: this.value.applicant.metadata.number,
                icon: "mdi-phone-outline"
              },
              {
                label: "Contact Person",
                value: this.value.applicant.metadata.contact,
                icon: "mdi-account-star-outline"
              },
              {
                label: "Mobile Number",
                value: this.value.applicant.metadata.number,
                icon: "mdi-phone-incoming-outline"
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
};
</script>
