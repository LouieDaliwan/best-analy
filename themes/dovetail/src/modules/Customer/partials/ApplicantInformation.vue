<template>
  <v-card>
    <v-card-text>
      <validation-provider
        vid="metadata[applicant][name]"
        :name="trans('Applicant Name')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Applicant Name')"
          autofocus
          class="dt-text-field"
          name="metadata[applicant][name]"
          outlined
          prepend-inner-icon="mdi-account"
          v-model="dataset.metadata.applicant.name"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[applicant][number]"
        :name="trans('Number')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Mobile No.')"
          autofocus
          class="dt-text-field"
          name="metadata[applicant][number]"
          outlined
          prepend-inner-icon="mdi-phone"
          v-model="dataset.metadata.applicant.number"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[applicant][email]"
        :name="trans('Email')"
        rules="email"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Applicant Email')"
          autofocus
          class="dt-text-field"
          name="metadata[applicant][number]"
          outlined
          prepend-inner-icon="mdi-email-outline"
          v-model="dataset.metadata.applicant.email"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[applicant][contact]"
        :name="trans('Contact Person')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Contact Person (Nominated)')"
          autofocus
          class="dt-text-field"
          name="metadata[applicant][contact]"
          outlined
          prepend-inner-icon="mdi-account"
          v-model="dataset.metadata.applicant.contact"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[applicant][designation]"
        :name="trans('Designation')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Designation (Nominated Contact)')"
          autofocus
          class="dt-text-field"
          name="metadata[applicant][designation]"
          outlined
          prepend-inner-icon="mdi-account"
          v-model="dataset.metadata.applicant.designation"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[applicant][number]"
        :name="trans('Number')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Mobile No.')"
          autofocus
          class="dt-text-field"
          name="metadata[applicant][number]"
          outlined
          prepend-inner-icon="mdi-phone"
          v-model="dataset.metadata.applicant.number"
        >
        </v-text-field>
      </validation-provider>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: ["value", "isDense", "isLoading"],

  computed: {
    dataset: {
      get() {
        return this.value;
      },
      set(val) {
        this.$emit("input", val);
      },
    },
  },
};
</script>