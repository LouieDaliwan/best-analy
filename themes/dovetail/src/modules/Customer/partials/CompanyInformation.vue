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
          :label="trans('Company Name')"
          autofocus
          class="dt-text-field"
          name="name"
          outlined
          prepend-inner-icon="mdi-briefcase-outline"
          v-model="dataset.name"
        >
        </v-text-field>
      </validation-provider>

      <!-- <validation-provider
                          vid="metadata[email]"
                          :name="trans('Email')"
                          rules="email"
                          v-slot="{ errors }"
                        >
                          <v-text-field
                            :dense="isDense"
                            :disabled="isLoading"
                            :error-messages="errors"
                            :label="trans('Company Email')"
                            autofocus
                            class="dt-text-field"
                            name="metadata[email]"
                            outlined
                            prepend-inner-icon="mdi-email-outline"
                            v-model="dataset.metadata['email']"
                          >
                          </v-text-field>
                        </validation-provider>

                        <validation-provider
                          vid="metadata[address]"
                          :name="trans('Company Address')"
                          v-slot="{ errors }"
                        >
                          <v-text-field
                            :dense="isDense"
                            :disabled="isLoading"
                            :error-messages="errors"
                            :label="trans('Company Address')"
                            autofocus
                            class="dt-text-field"
                            name="metadata[address]"
                            outlined
                            prepend-inner-icon="mdi-map-marker"
                            v-model="dataset.metadata['address']"
                          >
                          </v-text-field>
                        </validation-provider>

                        <validation-provider
                          vid="metadata[website]"
                          :name="trans('Website')"
                          v-slot="{ errors }"
                        >
                          <v-text-field
                            :dense="isDense"
                            :disabled="isLoading"
                            :error-messages="errors"
                            :label="trans('Website')"
                            autofocus
                            class="dt-text-field"
                            name="metadata[website]"
                            outlined
                            prepend-inner-icon="mdi-earth"
                            v-model="dataset.metadata['website']"
                          >
                          </v-text-field>
                        </validation-provider>

                        <validation-provider
                          vid="metadata[staffstrength]"
                          :name="trans('Staff Strength')"
                          v-slot="{ errors }"
                        >
                          <v-text-field
                            :dense="isDense"
                            :disabled="isLoading"
                            :error-messages="errors"
                            :label="trans('Staff Strength')"
                            autofocus
                            class="dt-text-field"
                            name="metadata[staffstrength]"
                            outlined
                            type="number"
                            v-model="dataset.metadata['staffstrength']"
                          >
                          </v-text-field>
                        </validation-provider>

                        <validation-provider
                          vid="metadata[industry]"
                          :name="trans('Industry')"
                          v-slot="{ errors }"
                        >
                          <v-text-field
                            :dense="isDense"
                            :disabled="isLoading"
                            :error-messages="errors"
                            :label="trans('Industry')"
                            class="dt-text-field"
                            name="metadata[industry]"
                            outlined
                            v-model="dataset.metadata['industry']"
                          >
                          </v-text-field>
                        </validation-provider> -->

      <validation-provider
        vid="metadata[location]"
        :name="trans('Company Location')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Company Location')"
          class="dt-text-field"
          name="metadata[location]"
          outlined
          v-model="dataset.metadata['location']"
        >
        </v-text-field>
      </validation-provider>

      <validation-provider
        vid="metadata[status]"
        :name="trans('Business Status')"
        v-slot="{ errors }"
      >
        <v-text-field
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :label="trans('Business Status')"
          class="dt-text-field"
          name="metadata[status]"
          outlined
          v-model="dataset.metadata['status']"
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
      },
    },
  },
};
</script>