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
      <v-row v-if="!keyFinRation.project_type">
        <v-col>
          <v-card>
            <v-card-text>
              <p>Lorem ipsum</p>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" md="5">
          <general-information v-model="resource.data"></general-information>
        </v-col>
        <v-col cols="12" md="7">
          <!-- TODO seperated Object for overall -->
          <sme-rating v-model="resource.data" class="mb-5"></sme-rating>
          <key-financial-ratio v-model="keyFinRation" :customer="resource.data"></key-financial-ratio>
        </v-col>
      </v-row>
    </template>
  </admin>
</template>

<script>
import Resource from "@/core/Models/Resource";
import $api from "./routes/api";

export default {
  components: {
    GeneralInformation: () => import("./cards/dashboard/GeneralInformation"),
    SmeRating: () => import("./cards/dashboard/SmeRating"),
    KeyFinancialRatio: () => import("./cards/dashboard/KeyFinancialRatio")
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
