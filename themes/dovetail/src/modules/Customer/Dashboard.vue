<template>
  <admin>
    <metatag :title="resource.data.name"></metatag>
    <back-to-top></back-to-top>
    <page-header
      :back="{ to: { name: 'companies.index' }, text: trans('Companies') }"
    >
      <template v-slot:title>
        <span
          v-text="
            trans(':name\'s Dashboard', { name: `${resource.data.name}` })
          "
        ></span>
      </template>
    </page-header>
    <template v-if="resource.isFetching"></template>
    <template v-else>
      <v-row v-if="!resource.data.details.metadata.project_type">
        <v-col>
          <v-alert
              type="warning"
              text
              icon="mdi-exclamation"
              prominent
              >
              <v-row align="center">
                <v-col class="grow">
                  Update the <strong>Project Type</strong> in the Project Information.
                </v-col>
                <v-col class="shrink">
                  <v-btn
                    color="accent"
                    large
                    :to="{
                      name: 'companies.edit',
                      params: { id: resource.data.id },
                      query: { tab: 0 }
                    }"
                    >Update</v-btn>
                </v-col>
              </v-row>
            </v-alert>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" lg="4">
          <general-information v-model="resource.data"></general-information>
        </v-col>
        <v-col cols="12" lg="8">
          <sme-rating v-model="resource.data" class="mb-5"></sme-rating>
          <key-financial-ratio v-model="keyFinRation" :customer="resource.data" class="mb-5"></key-financial-ratio>
          <latest-report></latest-report>
        </v-col>
      </v-row>
    </template>
  </admin>
</template>

<script>
import Resource from "@/core/Models/Resource";
import $api from "./routes/api";

export default {
  props: ["value"],

  components: {
    GeneralInformation: () => import("./cards/dashboard/GeneralInformation"),
    SmeRating: () => import("./cards/dashboard/SmeRating"),
    KeyFinancialRatio: () => import("./cards/dashboard/KeyFinancialRatio"),
    LatestReport: () => import("./cards/dashboard/LatestReport.vue")
  },

  data: () => ({
    resource: new Resource(),
    keyFinRation: {},
  }),

  methods: {
    getResource() {
      Promise.all([
        axios.get($api.show(this.$route.params.id)),
        axios.get($api.financialRatio(this.$route.params.id))
      ])
        .then(([res1, res2]) => {
          this.resource.setData(res1.data.data);
          this.keyFinRation = res2.data;

          console.log(this.resource);
        })
        .finally(() => {
          this.resource.fetch(false);
        });
    }
  },

  created() {
    this.getResource();
  }
};
</script>
