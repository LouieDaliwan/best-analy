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
          :disabled="true"
          :error-messages="errors"
          :label="trans('Applicant Name')"
          autofocus
          class="dt-text-field"
          name="metadata[applicant][name]"
          outlined
          prepend-inner-icon="mdi-account"
          v-model="dataset.applicant.metadata.name"
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
          :disabled="true"
          :error-messages="errors"
          :label="trans('Mobile No.')"
          autofocus
          class="dt-text-field"
          name="metadata[applicant][number]"
          outlined
          prepend-inner-icon="mdi-phone"
          v-model="dataset.applicant.metadata.number"
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
          :disabled="true"
          :error-messages="errors"
          :label="trans('Applicant Email')"
          autofocus
          class="dt-text-field"
          name="metadata[applicant][email]"
          outlined
          prepend-inner-icon="mdi-email-outline"
          v-model="dataset.applicant.metadata.email"
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
          :disabled="true"
          :error-messages="errors"
          :label="trans('Contact Person (Nominated)')"
          autofocus
          class="dt-text-field"
          name="metadata[applicant][contact]"
          outlined
          prepend-inner-icon="mdi-account"
          v-model="dataset.applicant.metadata.contact"
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
          :disabled="true"
          :error-messages="errors"
          :label="trans('Designation (Nominated Contact)')"
          autofocus
          class="dt-text-field"
          name="metadata[applicant][designation]"
          outlined
          prepend-inner-icon="mdi-account"
          v-model="dataset.applicant.metadata.designation"
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
          :disabled="true"
          :error-messages="errors"
          :label="trans('Contact Mobile No.')"
          autofocus
          class="dt-text-field"
          name="metadata[applicant][contact_person_mobile]"
          outlined
          prepend-inner-icon="mdi-phone"
          v-model="dataset.applicant.metadata.contact_person_mobile"
        >
        </v-text-field>
      </validation-provider>
      <v-divider></v-divider>

      <h3 class="my-5">Applicant Cooperation</h3>

      <validation-provider
        vid="metadata[applicant][cooperation][Reachable]"
        :name="trans('Reachable')"
        v-slot="{ errors }"
      >
        <v-select
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :items="[
            'Not contactable for more than 2 months',
            'Easy to contact, visit and meet within 5 attempts in 2 months',
            'Easy to contact, visit and meet within 4 attempts in a month',
            'Easy to contact, visit and meet within 3 attempts in a month',
            'Easy to contact, visit and meet within 2 attempts',
            'Not Applicable'
          ]"
          :label="trans('Reachable')"
          append-icon="mdi-chevron-down"
          background-color="selects"
          class="dt-text-field"
          name="metadata[applicant][cooperation][Reachable]"
          outlined
          v-model="dataset.applicant.metadata.cooperation.Reachable"
        ></v-select>
        <input
          type="hidden"
          name="metadata[applicant][cooperation][Reachable]"
          :value="dataset.applicant.metadata.cooperation.Reachable"
        />
      </validation-provider>

      <validation-provider
        vid="metadata[applicant][cooperation][Cooperating]"
        :name="trans('Cooperating')"
        v-slot="{ errors }"
      >
        <v-select
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :items="[
            'Unable to respond or provide documents to KF',
            'Easy to contact, visit and meet within 5 attempts within 2 months',
            'Unable to provide requested documents but usually responds the questions and debates well',
            'Providing KF with the requested documents, answering all KF’s questions and debates promptly most of the time',
            'Providing KF with the requested documents, answering all KF’s questions and debates promptly at all times',
            'Not Applicable'
          ]"
          :label="trans('Cooperating')"
          append-icon="mdi-chevron-down"
          background-color="selects"
          class="dt-text-field"
          outlined
          v-model="dataset.applicant.metadata.cooperation.Cooperating"
        ></v-select>
        <input
          type="hidden"
          name="metadata[applicant][cooperation][Cooperating]"
          :value="dataset.applicant.metadata.cooperation.Cooperating"
        />
      </validation-provider>

      <validation-provider
        vid="metadata[applicant][cooperation][Involvement]"
        :name="trans('Involvement')"
        v-slot="{ errors }"
      >
        <v-select
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :items="[
            'Not contactable for more than 2 months',
            'Easy to contact, visit and meet within 5 attempts in 2 months',
            'Easy to contact, visit and meet within 4 attempts in a month',
            'Easy to contact, visit and meet within 3 attempts in a month',
            'Easy to contact, visit and meet within 2 attempts',
            'Not Applicable'
          ]"
          :label="trans('Involvement')"
          append-icon="mdi-chevron-down"
          background-color="selects"
          class="dt-text-field"
          name="metadata[applicant][cooperation][Involvement]"
          outlined
          v-model="dataset.applicant.metadata.cooperation.Involvement"
        ></v-select>
        <input
          type="hidden"
          name="metadata[applicant][cooperation][Involvement]"
          :value="dataset.applicant.metadata.cooperation.Involvement"
        />
      </validation-provider>

      <validation-provider
        vid="metadata[applicant][cooperation][Duration of Overdue (DPD)]"
        :name="trans('Duration of Overdue (DPD)')"
        v-slot="{ errors }"
      >
        <v-select
          :dense="isDense"
          :disabled="isLoading"
          :error-messages="errors"
          :items="[
            'More than 180 days',
            'Overdue between 90 days to 180 days',
            'Overdue between 30 days to 90 days',
            'Less than 30 Days',
            'Pay loan instalments on time'
          ]"
          :label="trans('Duration of Overdue (DPD)')"
          append-icon="mdi-chevron-down"
          background-color="selects"
          class="dt-text-field"
          name="metadata[applicant][cooperation][Duration of Overdue (DPD)]"
          outlined
          v-model="
            dataset.applicant.metadata.cooperation['Duration of Overdue (DPD)']
          "
        ></v-select>
        <input
          type="hidden"
          name="metadata[applicant][cooperation][Duration of Overdue (DPD)]"
          :value="
            dataset.applicant.metadata.cooperation['Duration of Overdue (DPD)']
          "
        />
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
