class Company {
  constructor () {
    this.loading = false
    this.isPrestine = true
    this.isValid = true
    this.errors = []

    this.data = {
      name: '',
      code: '',
      refnum: '',
      description: '',
      metadata: {},
    }

    this.metadata = {
      'fps-qa1': {
        'Sales': {
          'salesYear1': '100,000',
          'salesYear2': '125,000',
          'salesYear3': '200,000',
        },
        '<strong>Change in Inventory Levels</strong>': [],
        'Opening Stocks': {
          'openingStocksYear1': '8,000',
          'openingStocksYear2': '9,500',
          'openingStocksYear3': '6,500',
        },
        'Closing Stocks': {
          'closingStocksYear1': '9,500',
          'closingStocksYear2': '6,500',
          'closingStocksYear3': '3,200',
        },
        '': [],
        '<h4><strong>Purchase of Goods and Services</strong></h4>': [],
        '<strong>Materials Consumed</strong>': [],
        'Raw Materials (direct & indirect)': {
          'rawMaterialsYear1': '36,000',
          'rawMaterialsYear2': '45,000',
          'rawMaterialsYear3': '55,000',
        },
        'Stock Expiring': {
          'stockExpiringYear1': '',
          'stockExpiringYear2': '',
          'stockExpiringYear3': '',
        },
        'Other Materials Used': {
          'otherMaterialsUsedYear1': '1,500',
          'otherMaterialsUsedYear2': '1,000',
          'otherMaterialsUsedYear3': '1,000',
        },
        '': [],
        '<strong>Production Costs</strong>': [],
        'Cargo and Handling': {
          'cargoAndHandlingYear1': '',
          'cargoAndHandlingYear2': '',
          'cargoAndHandlingYear3': '',
        },
        'Part-time/Temporary Labour': {
          'partTimeAndTemporaryLabourYear1': '',
          'partTimeAndTemporaryLabourYear2': '',
          'partTimeAndTemporaryLabourYear3': '',
        },
        'Insurance (not including employee\'s insurance)': {
          'insuranceYear1': '1,000',
          'insuranceYear2': '1,000',
          'insuranceYear3': '1,000',
        },
        'Transportation': {
          'transportationYear1': '10,000',
          'transportationYear2': '11,000',
          'transportationYear3': '11,000',
        },
        'Utilities': {
          'utilitiesYear1': '',
          'utilitiesYear2': '',
          'utilitiesYear3': '',
        },
        'Maintenance (Building, Plant, and Machinery)': {
          'maintenanceYear1': '2,400',
          'maintenanceYear2': '2,500',
          'maintenanceYear3': '2,300',
        },
        'Lease of Plant and Machinery': {
          'leaseYear1': '',
          'leaseYear2': '',
          'leaseYear3': '',
        },
        'Other Production Costs': {
          'otherProductionCostsYear1': '',
          'otherProductionCostsYear2': '',
          'otherProductionCostsYear3': '',
        },
        '': [],
        '<strong>General Management Costs</strong>': [],
        'Stationery Supplies and Printing': {
          'stationeryYear1': '450',
          'stationeryYear2': '450',
          'stationeryYear3': '450',
        },
        'Rental': {
          'rentalYear1': '10,000',
          'rentalYear2': '10,000',
          'rentalYear3': '11,000',
        },
        "Insurance (not including employee's insurance)": {
          'insuranceYear1': '',
          'insuranceYear2': '',
          'insuranceYear3': '',
        },
        'Transportation': {
          'transportationYear1': '1,200',
          'transportationYear2': '1,200',
          'transportationYear3': '1,300',
        },
        'Company Car/Bus etc.': {
          'companyCardYear1': '',
          'companyCardYear2': '',
          'companyCardYear3': '',
        },
        'Advertising': {
          'advertisingYear1': '12,000',
          'advertisingYear2': '13,000',
          'advertisingYear3': '13,000',
        },
        'Entertainment': {
          'entertainmentYear1': '',
          'entertainmentYear2': '',
          'entertainmentYear3': '',
        },
        'Food and Drinks': {
          'foodAndDrinksYear1': '2,000',
          'foodAndDrinksYear2': '1,800',
          'foodAndDrinksYear3': '2,100',
        },
        'Telephone and Fax': {
          'telephoneAndFaxYear1': '600',
          'telephoneAndFaxYear2': '700',
          'telephoneAndFaxYear3': '800',
        },
        'Mail and Courier': {
          'mailAndCourierYear1': '',
          'mailAndCourierYear2': '',
          'mailAndCourierYear3': '',
        },
        'Maintenance (Office Equipment)': {
          'maintenanceOfficeEquipmentYear1': '',
          'maintenanceOfficeEquipmentYear2': '',
          'maintenanceOfficeEquipmentYear3': '',
        },
        'Travel': {
          'travelYear1': '',
          'travelYear2': '',
          'travelYear3': '',
        },
        'Audit, Secretarial, and Professional Costs': {
          'auditYear1': '1,800',
          'auditYear2': '2,000',
          'auditYear3': '2,000',
        },
        'Newspapers and Magazines': {
          'newspapersAndMagazinesYear1': '',
          'newspapersAndMagazinesYear2': '',
          'newspapersAndMagazinesYear3': '',
        },
        'Stamp Duty, Filing and Legal': {
          'stampYear1': '',
          'stampYear2': '',
          'stampYear3': '',
        },
        'Bank charges': {
          'bankChargesYear1': '720',
          'bankChargesYear2': '720',
          'bankChargesYear3': '720',
        },
        'Other Administrative Costs': {
          'otherAdministrativeCostsYear1': '',
          'otherAdministrativeCostsYear2': '',
          'otherAdministrativeCostsYear3': '',
        },
        '<strong>Labour Expenses</strong>': [],
        'Employee Compensation': {
          'employeeCompensationYear1': '193,257',
          'employeeCompensationYear2': '193,257',
          'employeeCompensationYear3': '193,257',
        },
        'Bonuses': {
          'bonusesYear1': '245,165',
          'bonusesYear2': '245,165',
          'bonusesYear3': '245,165',
        },
        'Provident Fund': {
          'providentFundYear1': '13,113',
          'providentFundYear2': '13,113',
          'providentFundYear3': '13,113',
        },
        'Employee Welfare': {
          'employeeWelfareYear1': '75,092',
          'employeeWelfareYear2': '75,092',
          'employeeWelfareYear3': '75,092',
        },
        'Medical Costs': {
          'medicalCostsYear1': '3,395',
          'medicalCostsYear2': '3,395',
          'medicalCostsYear3': '3,395',
        },
        'Employee Training': {
          'employeeTrainingYear1': '',
          'employeeTrainingYear2': '',
          'employeeTrainingYear3': '',
        },
        "Director's Salary": {
          'directorsSalaryYear1': '409,846',
          'directorsSalaryYear2': '409,846',
          'directorsSalaryYear3': '409,846',
        },
        'Employee Insurance': {
          'employeeInsuranceYear1': '',
          'employeeInsuranceYear2': '',
          'employeeInsuranceYear3': '',
        },
        'Other Labour Expenses': {
          'otherLabourExpensesYear1': '',
          'otherLabourExpensesYear2': '',
          'otherLabourExpensesYear3': '',
        },

        '<strong>Depreciation</string>': [],
        'Buildings': {
          'buildingsYear1': '179,869',
          'buildingsYear2': '179,869',
          'buildingsYear3': '179,869',
        },
        'Plant, Machinery & Equipment': {
          'plantYear1': '',
          'plantYear2': '',
          'plantYear3': '',
        },
        'Others (Depreciation)': {
          'otherDepreciationsYear1': '',
          'otherDepreciationsYear2': '',
          'otherDepreciationsYear3': '',
        },

        '<h4><strong>Non-operating Expenses</strong></h4>': [],
        '<strong>Non-Operating Income</strong>': [],
        'Profit from Fixed Assets Sale': {
          'profitFixedYear1': '29,744',
          'profitFixedYear2': '10,386',
          'profitFixedYear3': '27,577',
        },
        'Profit from Foreign Exchange': {
          'profitForeignYear1': '',
          'profitForeignYear2': '',
          'profitForeignYear3': '',
        },
        'Other Income': {
          'otherIncomeYear1': '26,792',
          'otherIncomeYear2': '24,113',
          'otherIncomeYear3': '16,075',
        },

        '<strong>Non-Operating Costs</strong>': [],
        'Bad Debts': {
          'badDebtsYear1': '',
          'badDebtsYear2': '',
          'badDebtsYear3': '',
        },
        'Donations': {
          'donationsYear1': '15,135',
          'donationsYear2': '15,135',
          'donationsYear3': '15,135',
        },
        'Foreign Exchange Loss': {
          'foreignExhangeLossYear1': '24,302',
          'foreignExhangeLossYear2': '24,302',
          'foreignExhangeLossYear3': '24,302',
        },
        'Loss on Fixed Assets Sale': {
          'lossOnFixedAssetsSaleYear1': '',
          'lossOnFixedAssetsSaleYear2': '',
          'lossOnFixedAssetsSaleYear3': '',
        },
        'Others (Non-Operating Costs)': {
          'otherYear1': '',
          'otherYear2': '',
          'otherYear3': '',
        },

        '<strong>Taxation</strong>': [],
        'Tax on Property': {
          'taxYear1': '',
          'taxYear2': '',
          'taxYear3': '',
        },
        'Duties (Customs & Excise)': {
          'dutiesYear1': '',
          'dutiesYear2': '',
          'dutiesYear3': '',
        },
        'Levy on Foreign Workers': {
          'levyYear1': '6,275',
          'levyYear2': '6,275',
          'levyYear3': '6,275',
        },
        'Others (excluding Income Tax)': {
          'othersYear1': '',
          'othersYear2': '',
          'othersYear3': '',
        },

        '<strongInterest On Loans/Hires</strong>': [],
        'Interest & Charges by Bank': {
          'interestChargesYear1': '493,458',
          'interestChargesYear2': '493,458',
          'interestChargesYear3': '493,458',
        },
        'Interest on Loan': {
          'interestLoanYear1': '300,390',
          'interestLoanYear2': '300,390',
          'interestLoanYear3': '300,390',
        },
        'Interest on Hire Purchase': {
          'interestHireYear1': '',
          'interestHireYear2': '',
          'interestHireYear3': '',
        },
        'Others (Interest on Loan/Hires)': {
          'othersYear1': '',
          'othersYear2': '',
          'othersYear3': '',
        },

        '<strong>Company Tax</strong>': [],
        'Tax on Company': {
          'taxOnCompanyYear1': '',
          'taxOnCompanyYear2': '',
          'taxOnCompanyYear3': '',
        },
      },
    }
  }
}

export default Company
