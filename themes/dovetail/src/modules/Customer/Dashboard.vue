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
    <template v-if="resource.isFetching"> </template>
    <template v-else>
      <v-row>
        <v-col cols="12" md="5">
          <general-information v-model="resource.data"></general-information>
        </v-col>
        <v-col cols="12" md="7">
          <sme-rating v-model="resource.data" class="mb-5"></sme-rating>
          <key-financial-ratio v-model="resource.data"></key-financial-ratio>
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
    KeyFinancialRatio: () => import("./cards/dashboard/KeyFinancialRatio"),
  },

  data: () => ({
    resource: new Resource(),
  }),

  methods: {
    getResource() {
      axios
        .get($api.show(this.$route.params.id))
        .then((response) => {
          this.resource.setData(response.data.data);
        })
        .finally(() => {
          this.resource.fetch(false);
        });

      axios.get($api.financialRatio(this.$route.params.id))
      .then(({data}) => {
          console.log(data);
      });
    },
  },

  mounted() {
    this.getResource();
  },
};
</script>
