class Company {
  constructor () {
    this.loading = false
    this.isPrestine = true
    this.isValid = true
    this.errors = []

    this.metadataOrig = {
      'years': {
        'Years': {
          'Year1': 'Year 1',
          'Year2': 'Year 2',
          'Year3': 'Year 3',
        },
      },
      'fps-qa1': {
        'Sales': {
          'Year1': '100000',
          'Year2': '125000',
          'Year3': '200000',
        },
        '<h4><strong>Purchase of Goods and Services</strong></h4>': [],
        '<strong>Materials Consumed</strong>': [],
        'Raw Materials (direct & indirect)': {
          'Year1': '36000',
          'Year2': '45000',
          'Year3': '55000',
        },
        '<strong>Change in Inventory Levels</strong>': [],
        'Opening Stocks': {
          'Year1': '8000',
          'Year2': '9500',
          'Year3': '6500',
        },
        'Closing Stocks': {
          'Year1': '9500',
          'Year2': '6500',
          'Year3': '3200',
        },
        '': [],
        'Stock Expiring': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Other Materials Used': {
          'Year1': '1500',
          'Year2': '1000',
          'Year3': '1000',
        },
        '': [],
        '<strong>Production Costs</strong>': [],
        'Cargo and Handling': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Part-time/Temporary Labour': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Insurance (not including employee\'s insurance)': {
          'Year1': '1000',
          'Year2': '1000',
          'Year3': '1000',
        },
        'Transportation': {
          'Year1': '10000',
          'Year2': '11000',
          'Year3': '11000',
        },
        'Utilities': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Maintenance (Building, Plant, and Machinery)': {
          'Year1': '2400',
          'Year2': '2500',
          'Year3': '2300',
        },
        'Lease of Plant and Machinery': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Direct Employee Cost': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        '': [],
        '<strong>General Management Costs</strong>': [],
        'Stationery Supplies and Printing': {
          'Year1': '450',
          'Year2': '450',
          'Year3': '450',
        },
        'Rental': {
          'Year1': '10000',
          'Year2': '10000',
          'Year3': '11000',
        },
        "Insurance (not including employee's insurance) ": {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Transportation ': {
          'Year1': '1200',
          'Year2': '1200',
          'Year3': '1300',
        },
        'Company Car/Bus etc.': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Advertising': {
          'Year1': '12000',
          'Year2': '13000',
          'Year3': '13000',
        },
        'Entertainment': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Food and Drinks': {
          'Year1': '2000',
          'Year2': '1800',
          'Year3': '2100',
        },
        'Telephone and Fax': {
          'Year1': '600',
          'Year2': '700',
          'Year3': '800',
        },
        'Mail and Courier': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Maintenance (Office Equipment)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Travel': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Audit, Secretarial, and Professional Costs': {
          'Year1': '1800',
          'Year2': '2000',
          'Year3': '2000',
        },
        'Newspapers and Magazines': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Stamp Duty, Filing and Legal': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Bank charges': {
          'Year1': '720',
          'Year2': '720',
          'Year3': '720',
        },
        'Other Administrative Costs': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        '<strong>Labour Expenses</strong>': [],
        'Employee Compensation': {
          'Year1': '193257',
          'Year2': '193257',
          'Year3': '193257',
        },
        'Bonuses': {
          'Year1': '245165',
          'Year2': '245165',
          'Year3': '245165',
        },
        'Provident Fund': {
          'Year1': '13113',
          'Year2': '13113',
          'Year3': '13113',
        },
        'Employee Welfare': {
          'Year1': '75092',
          'Year2': '75092',
          'Year3': '75092',
        },
        'Medical Costs': {
          'Year1': '3395',
          'Year2': '3395',
          'Year3': '3395',
        },
        'Employee Training': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        "Director's Salary": {
          'Year1': '409846',
          'Year2': '409846',
          'Year3': '409846',
        },
        'Employee Insurance': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Other Labour Expenses': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },

        '<strong>Depreciation</string>': [],
        'Buildings': {
          'Year1': '179869',
          'Year2': '179869',
          'Year3': '179869',
        },
        'Plant, Machinery & Equipment': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Others (Depreciation)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },

        '<h4><strong>Non-operating Expenses</strong></h4>': [],
        '<strong>Non-Operating Income</strong>': [],
        'Profit from Fixed Assets Sale': {
          'Year1': '29744',
          'Year2': '10386',
          'Year3': '27577',
        },
        'Profit from Foreign Exchange': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Other Income': {
          'Year1': '26792',
          'Year2': '24113',
          'Year3': '16075',
        },

        '<strong>Non-Operating Costs</strong>': [],
        'Bad Debts': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Donations': {
          'Year1': '15135',
          'Year2': '15135',
          'Year3': '15135',
        },
        'Foreign Exchange Loss': {
          'Year1': '24302',
          'Year2': '24302',
          'Year3': '24302',
        },
        'Loss on Fixed Assets Sale': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Others (Non-Operating Costs)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },

        '<strong>Taxation</strong>': [],
        'Tax on Property': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Duties (Customs & Excise)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Levy on Foreign Workers': {
          'Year1': '6275',
          'Year2': '6275',
          'Year3': '6275',
        },
        'Others (excluding Income Tax)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },

        '<strong>Interest On Loans/Hires</strong>': [],
        'Interest & Charges by Bank': {
          'Year1': '493458',
          'Year2': '493458',
          'Year3': '493458',
        },
        'Interest on Loan': {
          'Year1': '300390',
          'Year2': '300390',
          'Year3': '300390',
        },
        'Interest on Hire Purchase': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Others (Interest on Loan/Hires)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },

        '<strong>Company Tax</strong>': [],
        'Tax on Company': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
      },
      'balance-sheet-years': {
        'Years': {
          'Year1': 'Year 1',
          'Year2': 'Year 2',
          'Year3': 'Year 3',
        },
      },
      'balance-sheet': {
        'Cash': {
          'Year1': '8700',
          'Year2': '8550',
          'Year3': '8900',
        },
        'Trade Receivables': {
          'Year1': '1200',
          'Year2': '1500',
          'Year3': '1000',
        },
        'Inventories': {
          'Year1': '800',
          'Year2': '650',
          'Year3': '700',
        },
        'Other CA': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Fixed Assets': {
          'Year1': '1000',
          'Year2': '1000',
          'Year3': '1000',
        },
        'Trade Payables': {
          'Year1': '1200',
          'Year2': '1100',
          'Year3': '1150',
        },
        'Other CL': {
          'Year1': '500',
          'Year2': '600',
          'Year3': '450',
        },
        "Stockholders' Equity": {
          'Year1': '10000',
          'Year2': '10000',
          'Year3': '10000',
        },
        'Other NCL': {
          'Year1': '500',
          'Year2': '600',
          'Year3': '450',
        },
        'Common Shares Outstanding': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
      },
      'balance-sheet-total': {
        'Total': {
          'Year1': 0,
          'Year2': 0,
          'Year3': 0,
        },
      },
      'fps-qa2': {
        '<h4><strong>Operating Profit/(Loss)</strong></h4>': [],
        'Profit or (Loss) Before Income Tax': {
          'Year1': '83184',
          'Year2': '308354',
          'Year3': '242318',
        },
        '<strong>Non-Operating Income</strong>': [],
        'Profit from Fixed Assets Sale': {
          'Year1': '132407',
          'Year2': '135755',
          'Year3': '492314',
        },
        'Profit from Foreign Exchange': {
          'Year1': '',
          'Year2': '2030',
          'Year3': '',
        },
        'Other Income': {
          'Year1': '32150',
          'Year2': '143569',
          'Year3': '1841875',
        },
        '<strong>Non-Operating Costs</strong>': [],
        'Bad Debts': {
          'Year1': '8,570',
          'Year2': '',
          'Year3': '',
        },
        'Donations': {
          'Year1': '19199',
          'Year2': '26062',
          'Year3': '15135',
        },
        'Foreign Exchange Loss': {
          'Year1': '',
          'Year2': '',
          'Year3': '24302',
        },
        'Loss on Fixed Assets Sale': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Others (Non-Operating Costs)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        '<h4><strong>Labour Expenses</strong></h4>': [],
        'Employee Compensation': {
          'Year1': '394097',
          'Year2': '283821',
          'Year3': '209362',
        },
        'Bonuses': {
          'Year1': '65725',
          'Year2': '6495',
          'Year3': '265595',
        },
        'Provident Fund': {
          'Year1': '15930',
          'Year2': '11221',
          'Year3': '14206',
        },
        'Employee Welfare': {
          'Year1': '20547',
          'Year2': '52460',
          'Year3': '81350',
        },
        'Medical Costs': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Employee Training': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Director\'s Salary': {
          'Year1': '534000',
          'Year2': '422000',
          'Year3': '444000',
        },
        'Employee Insurance': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Others (Labour Expenses)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },

        '<h4><strong>Interests on Loans/Hires</strong></h4>': [],
        'Interest & Charges by Bank': {
          'Year1': '534580',
          'Year2': '334666',
          'Year3': '578254',
        },
        'Interest on Loan': {
          'Year1': '300390',
          'Year2': '621676',
          'Year3': '587215',
        },
        'Interest on Hire Purchase': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Others (interest on loan/hires)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        '<h4><strong>Depreciation</strong></h4>': [],
        'Buildings': {
          'Year1': '167126',
          'Year2': '179869',
          'Year3': '253729',
        },
        'Plant, Machinery & Equipment': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Others': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        '<h4><strong>Taxation</strong></h4>': [],
        'Tax on Property': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Duties (Customs & Excise)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Levy on Foreign Workers': {
          'Year1': '6275',
          'Year2': '35595',
          'Year3': '33832',
        },
        'Others (excluding Income Tax & GST/VAT)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        }
      },
      'financial-total': {
        'Total': {
          'Year1': 0,
          'Year2': 0,
          'Year3': 0,
        },
      }
    }

    this.metadata = {
      'years': {
        'Years': {
          'Year1': 'Year 1',
          'Year2': 'Year 2',
          'Year3': 'Year 3',
        },
      },
      'fps-qa1': {
        'Sales': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        '<h4><strong>Purchase of Goods and Services</strong></h4>': [],
        '<strong>Materials Consumed</strong>': [],
        'Raw Materials (direct & indirect)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        '<strong>Change in Inventory Levels</strong>': [],
        'Opening Stocks': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Closing Stocks': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        '': [],
        'Stock Expiring': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Other Materials Used': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        '': [],
        '<strong>Production Costs</strong>': [],
        'Cargo and Handling': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Part-time/Temporary Labour': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Insurance (not including employee\'s insurance)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Transportation': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Utilities': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Maintenance (Building, Plant, and Machinery)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Lease of Plant and Machinery': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Direct Employee Cost': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        '': [],
        '<strong>General Management Costs</strong>': [],
        'Stationery Supplies and Printing': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Rental': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        "Insurance (not including employee's insurance) ": {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Transportation ': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Company Car/Bus etc.': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Advertising': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Entertainment': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Food and Drinks': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Telephone and Fax': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Mail and Courier': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Maintenance (Office Equipment)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Travel': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Audit, Secretarial, and Professional Costs': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Newspapers and Magazines': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Stamp Duty, Filing and Legal': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Bank charges': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Other Administrative Costs': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        '<strong>Labour Expenses</strong>': [],
        'Employee Compensation': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Bonuses': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Provident Fund': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Employee Welfare': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Medical Costs': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Employee Training': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        "Director's Salary": {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Employee Insurance': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Other Labour Expenses': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },

        '<strong>Depreciation</string>': [],
        'Buildings': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Plant, Machinery & Equipment': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Others (Depreciation)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },

        '<h4><strong>Non-operating Expenses</strong></h4>': [],
        '<strong>Non-Operating Income</strong>': [],
        'Profit from Fixed Assets Sale': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Profit from Foreign Exchange': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Other Income': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },

        '<strong>Non-Operating Costs</strong>': [],
        'Bad Debts': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Donations': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Foreign Exchange Loss': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Loss on Fixed Assets Sale': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Others (Non-Operating Costs)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },

        '<strong>Taxation</strong>': [],
        'Tax on Property': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Duties (Customs & Excise)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Levy on Foreign Workers': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Others (excluding Income Tax)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },

        '<strong>Interest On Loans/Hires</strong>': [],
        'Interest & Charges by Bank': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Interest on Loan': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Interest on Hire Purchase': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Others (Interest on Loan/Hires)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },

        '<strong>Company Tax</strong>': [],
        'Tax on Company': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
      },
      'balance-sheet-years': {
        'Years': {
          'Year1': 'Year 1',
          'Year2': 'Year 2',
          'Year3': 'Year 3',
        },
      },
      'balance-sheet': {
        'Cash': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Trade Receivables': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Inventories': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Other CA': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Fixed Assets': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Trade Payables': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Other CL': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        "Stockholders' Equity": {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Other NCL': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Common Shares Outstanding': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        }
      },
      'balance-sheet-total': {
        'Total': {
          'Year1': 0,
          'Year2': 0,
          'Year3': 0,
        },
      },
      'fps-qa2': {
        '<h4><strong>Operating Profit/(Loss)</strong></h4>': [],
        'Profit or (Loss) Before Income Tax': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        '<strong>Non-Operating Income</strong>': [],
        'Profit from Fixed Assets Sale': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Profit from Foreign Exchange': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Other Income': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        '<strong>Non-Operating Costs</strong>': [],
        'Bad Debts': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Donations': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Foreign Exchange Loss': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Loss on Fixed Assets Sale': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Others (Non-Operating Costs)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        '<h4><strong>Labour Expenses</strong></h4>': [],
        'Employee Compensation': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Bonuses': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Provident Fund': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Employee Welfare': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Medical Costs': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Employee Training': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Director\'s Salary': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Employee Insurance': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Others (Labour Expenses)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },

        '<h4><strong>Interests on Loans/Hires</strong></h4>': [],
        'Interest & Charges by Bank': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Interest on Loan': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Interest on Hire Purchase': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Others (interest on loan/hires)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        '<h4><strong>Depreciation</strong></h4>': [],
        'Buildings': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Plant, Machinery & Equipment': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Others': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        '<h4><strong>Taxation</strong></h4>': [],
        'Tax on Property': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Duties (Customs & Excise)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Levy on Foreign Workers': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
        'Others (excluding Income Tax & GST/VAT)': {
          'Year1': '',
          'Year2': '',
          'Year3': '',
        },
      },
      'financial-total': {
        'Total': {
          'Year1': 0,
          'Year2': 0,
          'Year3': 0,
        },
      },
    }

    this.data = {
      name: '',
      code: '',
      refnum: '',
      description: '',
      metadata: {
        type: '',
      },
      financials: this.metadataOrig,
      reports: [],
    }
  }

  calculateThreeYears ( data, exclude = '' ) {
    let totalPerYear = {
      Year1: 0,
      Year2: 0,
      Year3: 0
    }

    const itemsToAdd = this.itemsToAdd()

    for( const row in data ) {
      if( data[row] ) {
        for ( const column in data[row] ) {
          const value = data[row][column] !== '' ? parseInt( data[row][column] ) : 0
          if( data[row][column] ) {
            if( itemsToAdd.includes( row ) )
              totalPerYear[column] += value
            else {
              totalPerYear[column] -= value
              console.log( row, totalPerYear[column], '-' + value )
            }
          }
        }
      }
    }

    return totalPerYear
  }

  compulsoryItems () {
    return [
      'Sales',
      'Raw Materials (direct & indirect)',
      'Part-time/Temporary Labour',
      'Utilities',
      'Advertising',
      'Employee Compensation',
      'Cash',
      'Trade Receivables',
      'Fixed Assets',
      'Trade Payables',
      'Stockholders',
      "Stockholders' Equity"
    ]
  }

  itemsToAdd () {
    return [
      'Sales',
      'Closing Stocks',
      'Profit from Fixed Assets Sale',
			'Profit from Foreign Exchange',
			'Other Income',
      'Cash',
      'Trade Receivables',
      'Inventories',
      'Other CA',
      'Fixed Assets'
    ]
  }
  
  checkIfCompulsoryItems ( text ) {
    return this.compulsoryItems().includes( text )
  }
}

export default Company