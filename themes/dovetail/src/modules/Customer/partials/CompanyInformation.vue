<template>
  <v-card>
    <v-card-text>
      <validation-provider
        vid="name"
        :name="trans('Name')"
        rules="required"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Project Name')"
          autofocus
          class="dt-text-field"
          name="name"
          outlined
          prepend-inner-icon="mdi-briefcase-outline"
          v-model="dataset.name"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[project][project_location]"
        :name="trans('Project Location')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Project Location')"
          class="dt-text-field"
          name="metadata[project][project_location]"
          outlined
          v-model="dataset.details.metadata['project_location']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[project][trade_name_en]"
        :name="trans('Trade Name (English)')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Trade Name (English)')"
          class="dt-text-field"
          name="metadata[project][trade_name_en]"
          outlined
          v-model="dataset.details.metadata['trade_name_en']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[project][trade_name_ar]"
        :name="trans('Trade Name (Arabic)')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Trade Name (Arabic)')"
          class="dt-text-field"
          name="metadata[project][trade_name_ar]"
          outlined
          v-model="dataset.details.metadata['trade_name_ar']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[project][license_no]"
        :name="trans('License No.')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('License No.')"
          class="dt-text-field"
          name="metadata[project][license_no]"
          outlined
          v-model="dataset.details.metadata['license_no']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[project][funding_program]"
        :name="trans('Funding Program')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Funding Program')"
          class="dt-text-field"
          name="metadata[project][funding_program]"
          outlined
          v-model="dataset.details.metadata['funding_program']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[project][industry_sector]"
        :name="trans('Industry Sector')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Industry Sector')"
          class="dt-text-field"
          name="metadata[project][industry_sector]"
          outlined
          v-model="dataset.details.metadata['industry_sector']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[project][project_type]"
        :name="trans('Project Type')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Project Type')"
          class="dt-text-field"
          name="metadata[project][project_type]"
          outlined
          v-model="dataset.details.metadata['project_type']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[project][business_size]"
        :name="trans('Business Size')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Business Size')"
          class="dt-text-field"
          name="metadata[project][business_size]"
          outlined
          v-model="dataset.details.metadata['business_size']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[project][description]"
        :name="trans('Description')"
        v-slot="{ errors }"
      >
        <v-textarea
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Description')"
          class="dt-text-field"
          name="metadata[project][description]"
          outlined
          v-model="dataset.details.metadata['description']"
        >
        </v-textarea>
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
      }
    }
  }
};
</script>
