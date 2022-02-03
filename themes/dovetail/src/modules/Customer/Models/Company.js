class Company {
  constructor() {
    this.loading = false;
    this.isPrestine = true;
    this.isValid = true;
    this.errors = [];

    this.data = {
      name: "",
      code: "",
      refnum: "",
      description: "",
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
