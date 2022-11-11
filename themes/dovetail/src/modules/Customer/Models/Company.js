class Company {
  constructor() {
    this.loading = false;
    this.isPrestine = true;
    this.isValid = true;
    this.errors = [];

    this.data = {
      applicant: {
        customer_id: null,
        metadata: {
          BusinessCounselorName: null,
          contact_person_mobile: null,
          FileNo: null,
          FundingRequestNo: null,
          PeeBusinessCounselorName: null,
          SiteVisitDate: null,
          address: null,
          contact_person: null,
          designation: null,
          email: null,
          industry: null,
          name: null,
          number: null,
          staffstrength: null,
          website: null,
          cooperation: {
            Reachable: null,
            Cooperating: null,
            Involvement: null,
            "Duration of Overdue (DPD)": null
          }
        }
      },
      name: "",
      code: "",
      refnum: "",
      description: "",
      details: {
        customer_id: null,
        metadata: {
          business_size: null,
          description: null,
          funding_program: null,
          industry_sector: null,
          license_no: null,
          project_location: null,
          project_name: null,
          project_type: null,
          trade_name_ar: null,
          trade_name_en: null,
          investment_value: null,
        }
      },
      metadata: {
        type: "",
        applicant: {
          name: ""
        }
      },
      financials: this.metadataOrig,
      reports: []
    };
  }
}

export default Company;
