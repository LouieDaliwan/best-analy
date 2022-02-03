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
        vid="metadata[location]"
        :name="trans('Project Location')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Project Location')"
          class="dt-text-field"
          name="metadata[location]"
          outlined
          v-model="dataset.metadata['location']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[trade_name_english]"
        :name="trans('Trade Name (English)')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Trade Name (English)')"
          class="dt-text-field"
          name="metadata[trade_name_english]"
          outlined
          v-model="dataset.metadata['trade_name_english']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[trade_name_arabic]"
        :name="trans('Trade Name (Arabic)')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Trade Name (Arabic)')"
          class="dt-text-field"
          name="metadata[trade_name_arabic]"
          outlined
          v-model="dataset.metadata['trade_name_arabic']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[license_no]"
        :name="trans('License No.')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('License No.')"
          class="dt-text-field"
          name="metadata[license_no]"
          outlined
          v-model="dataset.metadata['license_no']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[program]"
        :name="trans('Funding Program')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Funding Program')"
          class="dt-text-field"
          name="metadata[program]"
          outlined
          v-model="dataset.metadata['program']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[sector]"
        :name="trans('Industry Sector')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Industry Sector')"
          class="dt-text-field"
          name="metadata[sector]"
          outlined
          v-model="dataset.metadata['sector']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[type]"
        :name="trans('Company Type')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Company Type')"
          class="dt-text-field"
          name="metadata[type]"
          outlined
          v-model="dataset.metadata['type']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[size]"
        :name="trans('Business Size')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Business Size')"
          class="dt-text-field"
          name="metadata[size]"
          outlined
          v-model="dataset.metadata['size']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[description]"
        :name="trans('Description')"
        v-slot="{ errors }"
      >
        <v-textarea
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Description')"
          class="dt-text-field"
          name="metadata[description]"
          outlined
          v-model="dataset.metadata['description']"
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
