(window.webpackJsonp=window.webpackJsonp||[]).push([[11],{12:function(e,r,a){"use strict";r.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},restore:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(e)},update:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},delete:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(e)},overall:function(e,r,a){return"/api/v1/reports/overall/customer/".concat(e,"/user/").concat(r,"?month=").concat(a)},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(e){return"/api/v1/surveys/".concat(e,"/submit")},show:function(e){return"/api/v1/surveys/".concat(e)}},crm:{search:function(e){return"/api/v1/crm/customers/search/".concat(e)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"},sendDocument:function(){return"/api/v1/crm/report/send"},sendFinancial:function(){return"/api/v1/crm/financial/send"}},reports:{list:function(e){return"/api/v1/customers/".concat(e,"/reports")},generate:function(e){return"/api/v1/reports/".concat(e,"/generate")},download:function(e){return"/api/v1/reports/".concat(e,"/download")},delete:function(e){return"/api/v1/reports/".concat(e)}}}},291:function(e,r,a){"use strict";a.r(r);var n=a(12),t=a(9),s=a(50),o=a(22);window.CRM_CODE_FILE_NUMBER_FOUND=1,window.CRM_CODE_FILE_NUMBER_DOES_NOT_EXIST=4;window.CRM_CODE_FILE_NUMBER_FOUND;var Y=window.CRM_CODE_FILE_NUMBER_DOES_NOT_EXIST,i=a(6);function c(e,r){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);r&&(n=n.filter((function(r){return Object.getOwnPropertyDescriptor(e,r).enumerable}))),a.push.apply(a,n)}return a}function u(e,r,a){return r in e?Object.defineProperty(e,r,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[r]=a,e}var l={store:o.a,data:function(){return{results:!1,searching:!1,companyFound:!1,query:"",errors:[],headers:[{text:"Company Name",align:"left",value:"CompanyName"},{text:"Funding Request No.",align:"left",value:"FundingRequestNo"},{text:"Business Counselor Name",align:"left",value:"BusinessCounselorName"},{text:"Status",align:"left",value:"Status"},{text:"",align:"left",value:"actions"}],companies:[],company:new s.a}},methods:function(e){for(var r=1;r<arguments.length;r++){var a=null!=arguments[r]?arguments[r]:{};r%2?c(Object(a),!0).forEach((function(r){u(e,r,a[r])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):c(Object(a)).forEach((function(r){Object.defineProperty(e,r,Object.getOwnPropertyDescriptor(a,r))}))}return e}({},Object(i.b)({loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show",hideSnackbar:"snackbar/hide",toggleBreadcrumbs:"breadcrumbs/toggle"}),{search:_.debounce((function(e){var r=this;this.query=e.srcElement.value||"",this.searching=!0,this.companyFound=!1,_.isEmpty(this.query)||this.searchForCompanyInCrm(this.query),setTimeout((function(){r.searching=!1}),3e3)}),920),searchForCompanyInCrm:function(e){var r=this;axios.get(n.a.crm.search(e)).then((function(e){var a=e.data,n=a.Code,t=a.Message,s=a.Content;if(n==Y)return r.errors.push(t),r.showSnackbar({icon:!1,button:{show:!0},text:r.trans(t)});n==CRM_CODE_FILE_NUMBER_FOUND&&(r.companyFound=!0,r.results=!0,r.companies.push(s))})).catch((function(e){r.showDialog({illustration:function(){return Promise.resolve().then(a.bind(null,259))},title:trans("Internal Error"),width:400,text:trans("Incorrect file number input. Please try again."),buttons:{cancel:!1}})})).finally((function(){r.searching=!1}))},goToNextStep:function(e){this.prepFoundCompany(e)},saveDummyCompany:function(){var e=this.query||Math.random(),r={name:"Dummy Company "+Math.random(),code:this.slugify("Dummy Company "+Math.random()),refnum:e,status:"Pending",token:"09-09090909-090909-0909-dummy",user_id:t.default.getId(),metadata:Object.assign({FileNo:e,FundingRequestNo:e,SiteVisitDate:new Date,BusinessCounselorName:Math.random(),PeeBusinessCounselorName:Math.random()},this.company.metadata)};this.saveFoundCompany(r)},prepFoundCompany:function(e){var r={name:e.CompanyName,code:this.slugify(e.CompanyName),refnum:this.query,status:e.Status,token:e.Id,user_id:t.default.getId(),metadata:Object.assign({FileNo:this.query,FundingRequestNo:e.FundingRequestNo,SiteVisitDate:e.SiteVisitDate||null,BusinessCounselorName:e.BusinessCounselorName,PeeBusinessCounselorName:e.PeeBusinessCounselorName},this.company.metadata)};this.saveFoundCompany(r)},saveFoundCompany:function(e){var r=this;axios.post(n.a.crm.update(),e).then((function(e){r.showSnackbar({icon:!1,button:{show:!0},text:trans("Company successfully saved")}),r.goToCompanyShowPage(e.data.id)}))},goToCompanyShowPage:function(e){this.$router.push({name:"companies.edit",params:{id:e}})}}),mounted:function(){this.toggleBreadcrumbs({show:!1})}},d=a(0),g=a(2),m=a.n(g),h=a(104),p=a(262),y=a(580),f=a(597),v=a(582),C=a(5),b=a(595),O=a(48),x=Object(d.a)(l,(function(){var e=this,r=e.$createElement,a=e._self._c||r;return a("admin",[a("metatag",{attrs:{title:e.trans("Find Company")}}),e._v(" "),a("div",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","alt","."],expression:"['ctrl', 'alt', '.']",modifiers:{once:!0}}],on:{shortkey:e.saveDummyCompany}}),e._v(" "),a("v-row",[a("v-col",{attrs:{cols:"12"}},[a("v-row",{attrs:{justify:"center"}},[a("v-col",{attrs:{cols:"10"}},[a("div",{staticClass:"text-center mb-4"},[a("v-scale-transition",[e.companyFound?a("h1",{staticClass:"primary--text mb-1"},[e._v(e._s(e.trans("Company Found!")))]):a("h1",{staticClass:"primary--text mb-1"},[e._v(e._s(e.trans("Find Company")))])]),e._v(" "),a("p",{staticClass:"muted--text"},[e._v(e._s(e.trans("Try finding a company by its file number. It is usually 5-digits long.")))])],1),e._v(" "),a("v-card",{staticClass:"my-10"},[a("v-text-field",{staticClass:"dt-text-field__search",attrs:{label:e.trans("Search file number"),loading:e.searching,autofocus:"","clear-icon":"mdi-close-circle-outline",clearable:"",flat:"","full-width":"",height:"68","hide-details":"","prepend-inner-icon":"mdi-magnify",solo:""},nativeOn:{keydown:function(r){return e.search(r)}}})],1)],1)],1),e._v(" "),e.searching||e.results?e._e():a("div",[a("div",{staticClass:"text-center mt-9"},[a("search-icon",{staticClass:"primary--text",staticStyle:{filter:"grayscale(0.7)"}})],1)]),e._v(" "),a("v-slide-y-transition",{attrs:{mode:"in-out"}},[e.searching?a("div",[a("v-skeleton-loader",{staticClass:"px-4 py-3 d-block",attrs:{width:"100%",type:"table-thead, table-row@5"}})],1):e._e()]),e._v(" "),e.results?a("v-data-table",{staticClass:"mt-9",attrs:{headers:e.headers,items:e.companies},scopedSlots:e._u([{key:"item.actions",fn:function(r){var n=r.item;return[a("v-btn",{attrs:{color:"primary"},on:{click:function(r){return r.preventDefault(),e.goToNextStep(n)}}},[e._v(e._s(e.trans("Start")))])]}}],null,!1,740400130)}):e._e()],1)],1)],1)}),[],!1,null,null,null);r.default=x.exports;m()(x,{VBtn:h.a,VCard:p.a,VCol:y.a,VDataTable:f.a,VRow:v.a,VScaleTransition:C.d,VSkeletonLoader:b.a,VSlideYTransition:C.j,VTextField:O.a})},50:function(e,r,a){"use strict";function n(e,r){for(var a=0;a<r.length;a++){var n=r[a];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}var t=function(){function e(){!function(e,r){if(!(e instanceof r))throw new TypeError("Cannot call a class as a function")}(this,e),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.metadataOrig={years:{Years:{Year1:"Year 1",Year2:"Year 2",Year3:"Year 3"}},"fps-qa1":{Sales:{Year1:"100000",Year2:"125000",Year3:"200000"},"<h4><strong>Purchase of Goods and Services</strong></h4>":[],"<strong>Materials Consumed</strong>":[],"Raw Materials (direct & indirect)":{Year1:"36000",Year2:"45000",Year3:"55000"},"<strong>Change in Inventory Levels</strong>":[],"Opening Stocks":{Year1:"8000",Year2:"9500",Year3:"6500"},"Closing Stocks":{Year1:"9500",Year2:"6500",Year3:"3200"},"<strong>Production Costs</strong>":[],"Cargo and Handling":{Year1:"",Year2:"",Year3:""},"Part-time/Temporary Labour":{Year1:"",Year2:"",Year3:""},"Insurance (not including employee's insurance)":{Year1:"1000",Year2:"1000",Year3:"1000"},Transportation:{Year1:"10000",Year2:"11000",Year3:"11000"},Utilities:{Year1:"",Year2:"",Year3:""},"Maintenance (Building, Plant, and Machinery)":{Year1:"2400",Year2:"2500",Year3:"2300"},"Lease of Plant and Machinery":{Year1:"",Year2:"",Year3:""},"Direct Employee Cost":{Year1:"",Year2:"",Year3:""},"":[],"<strong>General Management Costs</strong>":[],"Stationery Supplies and Printing":{Year1:"450",Year2:"450",Year3:"450"},Rental:{Year1:"10000",Year2:"10000",Year3:"11000"},"Insurance (not including employee's insurance) ":{Year1:"",Year2:"",Year3:""},"Transportation ":{Year1:"1200",Year2:"1200",Year3:"1300"},"Company Car/Bus etc.":{Year1:"",Year2:"",Year3:""},Advertising:{Year1:"12000",Year2:"13000",Year3:"13000"},Entertainment:{Year1:"",Year2:"",Year3:""},"Food and Drinks":{Year1:"2000",Year2:"1800",Year3:"2100"},"Telephone and Fax":{Year1:"600",Year2:"700",Year3:"800"},"Mail and Courier":{Year1:"",Year2:"",Year3:""},"Maintenance (Office Equipment)":{Year1:"",Year2:"",Year3:""},Travel:{Year1:"",Year2:"",Year3:""},"Audit, Secretarial, and Professional Costs":{Year1:"1800",Year2:"2000",Year3:"2000"},"Newspapers and Magazines":{Year1:"",Year2:"",Year3:""},"Stamp Duty, Filing and Legal":{Year1:"",Year2:"",Year3:""},"Bank charges":{Year1:"720",Year2:"720",Year3:"720"},"Other Administrative Costs":{Year1:"",Year2:"",Year3:""},"<strong>Labour Expenses</strong>":[],"Employee Compensation":{Year1:"193257",Year2:"193257",Year3:"193257"},Bonuses:{Year1:"245165",Year2:"245165",Year3:"245165"},"Provident Fund":{Year1:"13113",Year2:"13113",Year3:"13113"},"Employee Welfare":{Year1:"75092",Year2:"75092",Year3:"75092"},"Medical Costs":{Year1:"3395",Year2:"3395",Year3:"3395"},"Employee Training":{Year1:"",Year2:"",Year3:""},"Director's Salary":{Year1:"409846",Year2:"409846",Year3:"409846"},"Employee Insurance":{Year1:"",Year2:"",Year3:""},"Other Labour Expenses":{Year1:"",Year2:"",Year3:""},"<strong>Depreciation</string>":[],Buildings:{Year1:"179869",Year2:"179869",Year3:"179869"},"Plant, Machinery & Equipment":{Year1:"",Year2:"",Year3:""},"Others (Depreciation)":{Year1:"",Year2:"",Year3:""},"<h4><strong>Non-operating Expenses</strong></h4>":[],"<strong>Non-Operating Income</strong>":[],"Profit from Fixed Assets Sale":{Year1:"29744",Year2:"10386",Year3:"27577"},"Profit from Foreign Exchange":{Year1:"",Year2:"",Year3:""},"Other Income":{Year1:"26792",Year2:"24113",Year3:"16075"},"<strong>Non-Operating Costs</strong>":[],"Bad Debts":{Year1:"",Year2:"",Year3:""},Donations:{Year1:"15135",Year2:"15135",Year3:"15135"},"Foreign Exchange Loss":{Year1:"24302",Year2:"24302",Year3:"24302"},"Loss on Fixed Assets Sale":{Year1:"",Year2:"",Year3:""},"Others (Non-Operating Costs)":{Year1:"",Year2:"",Year3:""},"<strong>Taxation</strong>":[],"Tax on Property":{Year1:"",Year2:"",Year3:""},"Duties (Customs & Excise)":{Year1:"",Year2:"",Year3:""},"Levy on Foreign Workers":{Year1:"6275",Year2:"6275",Year3:"6275"},"Others (excluding Income Tax)":{Year1:"",Year2:"",Year3:""},"<strong>Interest On Loans/Hires</strong>":[],"Interest & Charges by Bank":{Year1:"493458",Year2:"493458",Year3:"493458"},"Interest on Loan":{Year1:"300390",Year2:"300390",Year3:"300390"},"Interest on Hire Purchase":{Year1:"",Year2:"",Year3:""},"Others (Interest on Loan/Hires)":{Year1:"",Year2:"",Year3:""},"<strong>Company Tax</strong>":[],"Tax on Company":{Year1:"",Year2:"",Year3:""}},"balance-sheet-years":{Years:{Year1:"Year 1",Year2:"Year 2",Year3:"Year 3"}},"balance-sheet":{Cash:{Year1:"8700",Year2:"8550",Year3:"8900"},"Trade Receivables":{Year1:"1200",Year2:"1500",Year3:"1000"},Inventories:{Year1:"800",Year2:"650",Year3:"700"},"Other CA":{Year1:"",Year2:"",Year3:""},"Fixed Assets":{Year1:"1000",Year2:"1000",Year3:"1000"},"":[],"Trade Payables":{Year1:"1200",Year2:"1100",Year3:"1150"},"Other CL":{Year1:"500",Year2:"600",Year3:"450"},"Stockholders' Equity":{Year1:"10000",Year2:"10000",Year3:"10000"},"Other NCL":{Year1:"500",Year2:"600",Year3:"450"},"Common Shares Outstanding":{Year1:"",Year2:"",Year3:""}},"balance-sheet-total":{Total:{Year1:0,Year2:0,Year3:0}},"fps-qa2":{"<h4><strong>Operating Profit/(Loss)</strong></h4>":[],"Profit or (Loss) Before Income Tax":{Year1:"83184",Year2:"308354",Year3:"242318"},"<strong>Non-Operating Income</strong>":[],"Profit from Fixed Assets Sale":{Year1:"132407",Year2:"135755",Year3:"492314"},"Profit from Foreign Exchange":{Year1:"",Year2:"2030",Year3:""},"Other Income":{Year1:"32150",Year2:"143569",Year3:"1841875"},"<strong>Non-Operating Costs</strong>":[],"Bad Debts":{Year1:"8,570",Year2:"",Year3:""},Donations:{Year1:"19199",Year2:"26062",Year3:"15135"},"Foreign Exchange Loss":{Year1:"",Year2:"",Year3:"24302"},"Loss on Fixed Assets Sale":{Year1:"",Year2:"",Year3:""},"Others (Non-Operating Costs)":{Year1:"",Year2:"",Year3:""},"<h4><strong>Labour Expenses</strong></h4>":[],"Employee Compensation":{Year1:"394097",Year2:"283821",Year3:"209362"},Bonuses:{Year1:"65725",Year2:"6495",Year3:"265595"},"Provident Fund":{Year1:"15930",Year2:"11221",Year3:"14206"},"Employee Welfare":{Year1:"20547",Year2:"52460",Year3:"81350"},"Medical Costs":{Year1:"",Year2:"",Year3:""},"Employee Training":{Year1:"",Year2:"",Year3:""},"Director's Salary":{Year1:"534000",Year2:"422000",Year3:"444000"},"Employee Insurance":{Year1:"",Year2:"",Year3:""},"Others (Labour Expenses)":{Year1:"",Year2:"",Year3:""},"<h4><strong>Interests on Loans/Hires</strong></h4>":[],"Interest & Charges by Bank":{Year1:"534580",Year2:"334666",Year3:"578254"},"Interest on Loan":{Year1:"300390",Year2:"621676",Year3:"587215"},"Interest on Hire Purchase":{Year1:"",Year2:"",Year3:""},"Others (interest on loan/hires)":{Year1:"",Year2:"",Year3:""},"<h4><strong>Depreciation</strong></h4>":[],Buildings:{Year1:"167126",Year2:"179869",Year3:"253729"},"Plant, Machinery & Equipment":{Year1:"",Year2:"",Year3:""},Others:{Year1:"",Year2:"",Year3:""},"<h4><strong>Taxation</strong></h4>":[],"Tax on Property":{Year1:"",Year2:"",Year3:""},"Duties (Customs & Excise)":{Year1:"",Year2:"",Year3:""},"Levy on Foreign Workers":{Year1:"6275",Year2:"35595",Year3:"33832"},"Others (excluding Income Tax & GST/VAT)":{Year1:"",Year2:"",Year3:""}},"financial-total":{Total:{Year1:0,Year2:0,Year3:0}}},this.metadata={years:{Years:{Year1:"Year 1",Year2:"Year 2",Year3:"Year 3"}},"fps-qa1":{Sales:{Year1:"",Year2:"",Year3:""},"<h4><strong>Purchase of Goods and Services</strong></h4>":[],"<strong>Materials Consumed</strong>":[],"Raw Materials (direct & indirect)":{Year1:"",Year2:"",Year3:""},"<strong>Change in Inventory Levels</strong>":[],"Opening Stocks":{Year1:"",Year2:"",Year3:""},"Closing Stocks":{Year1:"",Year2:"",Year3:""},"<strong>Production Costs</strong>":[],"Cargo and Handling":{Year1:"",Year2:"",Year3:""},"Part-time/Temporary Labour":{Year1:"",Year2:"",Year3:""},"Insurance (not including employee's insurance)":{Year1:"",Year2:"",Year3:""},Transportation:{Year1:"",Year2:"",Year3:""},Utilities:{Year1:"",Year2:"",Year3:""},"Maintenance (Building, Plant, and Machinery)":{Year1:"",Year2:"",Year3:""},"Lease of Plant and Machinery":{Year1:"",Year2:"",Year3:""},"Direct Employee Cost":{Year1:"",Year2:"",Year3:""},"":[],"<strong>General Management Costs</strong>":[],"Stationery Supplies and Printing":{Year1:"",Year2:"",Year3:""},Rental:{Year1:"",Year2:"",Year3:""},"Insurance (not including employee's insurance) ":{Year1:"",Year2:"",Year3:""},"Transportation ":{Year1:"",Year2:"",Year3:""},"Company Car/Bus etc.":{Year1:"",Year2:"",Year3:""},Advertising:{Year1:"",Year2:"",Year3:""},Entertainment:{Year1:"",Year2:"",Year3:""},"Food and Drinks":{Year1:"",Year2:"",Year3:""},"Telephone and Fax":{Year1:"",Year2:"",Year3:""},"Mail and Courier":{Year1:"",Year2:"",Year3:""},"Maintenance (Office Equipment)":{Year1:"",Year2:"",Year3:""},Travel:{Year1:"",Year2:"",Year3:""},"Audit, Secretarial, and Professional Costs":{Year1:"",Year2:"",Year3:""},"Newspapers and Magazines":{Year1:"",Year2:"",Year3:""},"Stamp Duty, Filing and Legal":{Year1:"",Year2:"",Year3:""},"Bank charges":{Year1:"",Year2:"",Year3:""},"Other Administrative Costs":{Year1:"",Year2:"",Year3:""},"<strong>Labour Expenses</strong>":[],"Employee Compensation":{Year1:"",Year2:"",Year3:""},Bonuses:{Year1:"",Year2:"",Year3:""},"Provident Fund":{Year1:"",Year2:"",Year3:""},"Employee Welfare":{Year1:"",Year2:"",Year3:""},"Medical Costs":{Year1:"",Year2:"",Year3:""},"Employee Training":{Year1:"",Year2:"",Year3:""},"Director's Salary":{Year1:"",Year2:"",Year3:""},"Employee Insurance":{Year1:"",Year2:"",Year3:""},"Other Labour Expenses":{Year1:"",Year2:"",Year3:""},"<strong>Depreciation</string>":[],Buildings:{Year1:"",Year2:"",Year3:""},"Plant, Machinery & Equipment":{Year1:"",Year2:"",Year3:""},"Others (Depreciation)":{Year1:"",Year2:"",Year3:""},"<h4><strong>Non-operating Expenses</strong></h4>":[],"<strong>Non-Operating Income</strong>":[],"Profit from Fixed Assets Sale":{Year1:"",Year2:"",Year3:""},"Profit from Foreign Exchange":{Year1:"",Year2:"",Year3:""},"Other Income":{Year1:"",Year2:"",Year3:""},"<strong>Non-Operating Costs</strong>":[],"Bad Debts":{Year1:"",Year2:"",Year3:""},Donations:{Year1:"",Year2:"",Year3:""},"Foreign Exchange Loss":{Year1:"",Year2:"",Year3:""},"Loss on Fixed Assets Sale":{Year1:"",Year2:"",Year3:""},"Others (Non-Operating Costs)":{Year1:"",Year2:"",Year3:""},"<strong>Taxation</strong>":[],"Tax on Property":{Year1:"",Year2:"",Year3:""},"Duties (Customs & Excise)":{Year1:"",Year2:"",Year3:""},"Levy on Foreign Workers":{Year1:"",Year2:"",Year3:""},"Others (excluding Income Tax)":{Year1:"",Year2:"",Year3:""},"<strong>Interest On Loans/Hires</strong>":[],"Interest & Charges by Bank":{Year1:"",Year2:"",Year3:""},"Interest on Loan":{Year1:"",Year2:"",Year3:""},"Interest on Hire Purchase":{Year1:"",Year2:"",Year3:""},"Others (Interest on Loan/Hires)":{Year1:"",Year2:"",Year3:""},"<strong>Company Tax</strong>":[],"Tax on Company":{Year1:"",Year2:"",Year3:""}},"balance-sheet-years":{Years:{Year1:"Year 1",Year2:"Year 2",Year3:"Year 3"}},"balance-sheet":{Cash:{Year1:"",Year2:"",Year3:""},"Trade Receivables":{Year1:"",Year2:"",Year3:""},Inventories:{Year1:"",Year2:"",Year3:""},"Other CA":{Year1:"",Year2:"",Year3:""},"Fixed Assets":{Year1:"",Year2:"",Year3:""},"":[],"Trade Payables":{Year1:"",Year2:"",Year3:""},"Other CL":{Year1:"",Year2:"",Year3:""},"Stockholders' Equity":{Year1:"",Year2:"",Year3:""},"Other NCL":{Year1:"",Year2:"",Year3:""},"Common Shares Outstanding":{Year1:"",Year2:"",Year3:""}},"balance-sheet-total":{Total:{Year1:0,Year2:0,Year3:0}},"fps-qa2":{"<h4><strong>Operating Profit/(Loss)</strong></h4>":[],"Profit or (Loss) Before Income Tax":{Year1:"",Year2:"",Year3:""},"<strong>Non-Operating Income</strong>":[],"Profit from Fixed Assets Sale":{Year1:"",Year2:"",Year3:""},"Profit from Foreign Exchange":{Year1:"",Year2:"",Year3:""},"Other Income":{Year1:"",Year2:"",Year3:""},"<strong>Non-Operating Costs</strong>":[],"Bad Debts":{Year1:"",Year2:"",Year3:""},Donations:{Year1:"",Year2:"",Year3:""},"Foreign Exchange Loss":{Year1:"",Year2:"",Year3:""},"Loss on Fixed Assets Sale":{Year1:"",Year2:"",Year3:""},"Others (Non-Operating Costs)":{Year1:"",Year2:"",Year3:""},"<h4><strong>Labour Expenses</strong></h4>":[],"Employee Compensation":{Year1:"",Year2:"",Year3:""},Bonuses:{Year1:"",Year2:"",Year3:""},"Provident Fund":{Year1:"",Year2:"",Year3:""},"Employee Welfare":{Year1:"",Year2:"",Year3:""},"Medical Costs":{Year1:"",Year2:"",Year3:""},"Employee Training":{Year1:"",Year2:"",Year3:""},"Director's Salary":{Year1:"",Year2:"",Year3:""},"Employee Insurance":{Year1:"",Year2:"",Year3:""},"Others (Labour Expenses)":{Year1:"",Year2:"",Year3:""},"<h4><strong>Interests on Loans/Hires</strong></h4>":[],"Interest & Charges by Bank":{Year1:"",Year2:"",Year3:""},"Interest on Loan":{Year1:"",Year2:"",Year3:""},"Interest on Hire Purchase":{Year1:"",Year2:"",Year3:""},"Others (interest on loan/hires)":{Year1:"",Year2:"",Year3:""},"<h4><strong>Depreciation</strong></h4>":[],Buildings:{Year1:"",Year2:"",Year3:""},"Plant, Machinery & Equipment":{Year1:"",Year2:"",Year3:""},Others:{Year1:"",Year2:"",Year3:""},"<h4><strong>Taxation</strong></h4>":[],"Tax on Property":{Year1:"",Year2:"",Year3:""},"Duties (Customs & Excise)":{Year1:"",Year2:"",Year3:""},"Levy on Foreign Workers":{Year1:"",Year2:"",Year3:""},"Others (excluding Income Tax & GST/VAT)":{Year1:"",Year2:"",Year3:""}},"financial-total":{Total:{Year1:0,Year2:0,Year3:0}}},this.data={name:"",code:"",refnum:"",description:"",metadata:{type:""},financials:this.metadataOrig,reports:[]}}var r,a,t;return r=e,(a=[{key:"calculateThreeYears",value:function(e){arguments.length>1&&void 0!==arguments[1]&&arguments[1];var r={Year1:0,Year2:0,Year3:0},a=this.itemsToAdd();for(var n in e)if(e[n])for(var t in e[n]){var s=""!==e[n][t]?parseInt(e[n][t]):0;e[n][t]&&(a.includes(n)?r[t]+=s:r[t]-=s)}return r}},{key:"compulsoryItems",value:function(){return["Sales","Raw Materials (direct & indirect)","Part-time/Temporary Labour","Utilities","Advertising","Employee Compensation","Cash","Trade Receivables","Fixed Assets","Trade Payables","Stockholders","Stockholders' Equity"]}},{key:"itemsToAdd",value:function(){return["Sales","Closing Stocks","Profit from Fixed Assets Sale","Profit from Foreign Exchange","Other Income","Cash","Trade Receivables","Inventories","Other CA","Fixed Assets"]}},{key:"checkIfCompulsoryItems",value:function(e){return this.compulsoryItems().includes(e)}}])&&n(r.prototype,a),t&&n(r,t),e}();r.a=t}}]);
//# sourceMappingURL=11.js.map