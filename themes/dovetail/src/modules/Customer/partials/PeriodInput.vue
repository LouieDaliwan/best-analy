<template>
  <v-row>
    <v-col cols="6">
      <span v-text="label"
      v-if="
            [
              'General Management Costs',
              'Raw Materials',
              'Depreciation',
              'Interest On Loan/Hires',
              'Company Tax',
              'Cash',
              'Trade Receivables',
              'Inventories',
              'Other Current Assets',
              'Fixed Assets',
              'Trade Payables',
              'Other Current Liablities',
              'Other Non-Current Liablities',
              `Stockholders' Equity`,
              'Common Shares Outstanding'
            ].includes(label)"
      ></span>

      <!-- <p class="mb-0" v-else>{{ trans(label) }}<span class=" red--text">*</span></p> -->
      <span v-else>{{trans(label)}} <i class=" red--text" style="decoration: none;">*</i></span>

      <v-menu v-if="tooltip[label]">
        <template v-slot:activator="{ on, attrs }">
          <v-btn v-bind="attrs" v-on="on" icon small>
            <v-icon small>mdi-information-outline</v-icon>
          </v-btn>
        </template>
        <v-list dense>
          <v-list-item>
            <v-list-content>
              <p class="font-weight-black mb-0">{{ trans(label) }} may include the following items:</p>
              <ul class="mb-0" v-for="(item, i) in tooltip[label]" :key="i">
                <li><p v-text="item" class="mb-0"></p></li>
              </ul>
            </v-list-content>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-col>
    <v-col cols="6">
      <v-text-field
        :name="name"
        class="text-right"
        dense
        hide-details
        outlined
        step="0.01"
        type="number"
        v-if="edit"
        v-model="dataset"
      ></v-text-field>
      <div
        v-else
        v-text="parseFloat(dataset || 0).toLocaleString()"
        class="text-right"
      ></div
    ></v-col>
  </v-row>
</template>

<script>
export default {
  props: ["label", "value", "edit", "name"],

  computed: {
    dataset: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit("input", value);
      }
    }
  },

  data: () => ({
    tooltip: {
      "Direct Production Costs": [
        "Cargo & Handling",
        "Part-time labour",
        "Insurance",
        "Transportation",
        "Utilities",
        "Maintenance",
        "Other Production Costs"
      ],
      "General Management Costs": [
        "Stationery Supplies and Printing",
        "Rental",
        "Insurance (not including employees' insurance)",
        "Transportation",
        "Company Car/Bus etc.",
        "Advertising",
        "Entertainment",
        "Food and Drinks",
        "Telephone and Fax",
        "Mail and Courier",
        "Maintenance (Office Equipment)",
        "Travel",
        "Audit, Secretarial and Professional Costs",
        "Newspaper and Magazines",
        "Stamp Duty, Filing and Legal",
        "Bank charges",
        "Other Administrative Costs"
      ],
      "Staff Salaries & Benefits": [
        "Employee Compensation",
        "Bonuses",
        "Provident Fund",
        "Employee Welfare",
        "Medical Costs",
        "Employee Training",
        "Director's Salary",
        "Employee Insurance",
        "Others"
      ],
      "Other Expense (less Other Income)": [
        "Non-Operating Income",
        "- Profit from Fixed Assets Sale",
        "- Profit from Foreign Exchange",
        "- Other Income",
        "Non-Operating Costs",
        "- Bad Debts",
        "- Foreign Exchange Loss",
        "- Loss on Fixed Assets Sale",
        "- Others"
      ],
      Taxation: [
        "Tax on Property",
        "Duties (Customs & Excise)",
        "Levy on Foreign Workers",
        "Others (excluding Income Tax)"
      ],
      "Interest On Loan/Hires": [
        "Interest & Charges by Bank",
        "Interest on Loan",
        "Interest on Hire Purchase",
        "Others"
      ],
      Depreciation: ["Buildings", "Plant, Machinery, & Equipment", "Others"],
      "Marketing Costs": [
        "Newspaper Advertisement",
        "Social Media",
        "Marketing Agent Fees",
        "Discount Coupons"
      ]
    }
  })
};
</script>
