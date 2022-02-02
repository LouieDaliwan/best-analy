import Resource from "@/core/Models/Resource";

export default class extends Resource {
  constructor() {
    super();

    this.data = {
      description: "",
      sales: 0,
      raw_materials: 0,
      opening_stocks: 0,
      closing_stocks: 0,
      cost_of_good_sold: 0,
      production_cost: 0,
      general_management_cost: 0,
      labour_expense: 0,
      buildings: 0,
      plant_machinery_and_equipment: 0,
      others: 0,
      depreciation: 0,
      non_operating_expense: 0,
      taxation: 0,
      interest_on_loans_or_hires: 0,
      company_tax: 0,
      net_profit: 0
    };
  }
}
