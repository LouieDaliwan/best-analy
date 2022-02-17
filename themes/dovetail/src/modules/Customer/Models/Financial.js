import Resource from "@/core/Models/Resource";

export default class extends Resource {
  constructor() {
    super();

    this.data = {
      description: "",

      metadataSheets: {
        Balance: 0,
        Cash: 0,
        "Common Shares Outstanding": 0,
        "Fixed Assets": 0,
        Inventories: 0,
        "Other CA": 0,
        "Other CL": 0,
        "Other NCL": 0,
        "Stockholders' Equity": 0,
        "Trade Payables": 0,
        "Trade Receivables": 0
      },

      metadataStatements: {
        "Net Operating Profit/(Loss)": 0,
        Sales: 0,
        "Raw Materials": 0,
        "Direct Production Costs": 0,
        "Cost of Good Sold": 0,
        "Marketing Costs": 0,
        "General Management Costs": 0,
        "Value Added": 0,
        "Number of Staff": 0,
        "Staff Salaries & Benefits": 0,
        Depreciation: 0,
        "Other Expense (less Other Income)": 0,
        "Interest On Loan/Hires": 0,
        "Company Tax": 0,
        "Operating Profit/(Loss)[EBT]": 0
      }
    };
  }
}
