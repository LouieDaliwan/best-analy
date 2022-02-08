import Resource from "@/core/Models/Resource";

export default class extends Resource {
  constructor() {
    super();

    this.data = {
      description: "",

      sheets: {
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

      statements: {
        "Net Operating Profit/(Loss)": 0,
        Sales: 0,
        "Raw Materials": 0,
        "Opening Stocks": 0,
        "Closing Stocks": 0,
        "Cost of Good Sold": 0,
        "Production Costs": 0,
        "General Management Costs": 0,
        "Labour Expenses": 0,
        Depreciation: 0,
        "Non-Operating Expenses(Non-Operating Expense Less Income)": 0,
        Taxation: 0,
        "Interest On Loan/Hires": 0,
        "Company Tax": 0
      }
    };
  }
}
