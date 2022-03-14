(window.webpackJsonp=window.webpackJsonp||[]).push([[17],{13:function(t,e,n){"use strict";e.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(t)},overall:function(t,e,n){return"/api/v1/reports/overall/customer/".concat(t,"/user/").concat(e,"?month=").concat(n)},financialRatio:function(t){return"/api/v1/customer/".concat(t,"/financial-ratios")},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(t){return"/api/v1/surveys/".concat(t,"/submit")},show:function(t){return"/api/v1/surveys/".concat(t)}},crm:{search:function(t){return"/api/v1/crm/customers/search/".concat(t)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"},sendDocument:function(){return"/api/v1/crm/report/send"},sendFinancial:function(){return"/api/v1/crm/financial/send"}},reports:{list:function(t){return"/api/v1/customers/".concat(t,"/reports")},generate:function(t){return"/api/v1/reports/".concat(t,"/generate")},download:function(t){return"/api/v1/reports/".concat(t,"/download")},delete:function(t){return"/api/v1/reports/".concat(t)},financialRatio:function(t,e){return"/api/v1/reports/financial-ratio/customers/".concat(t,"/users/").concat(e,"/financial-ratio")}}}},317:function(t,e,n){"use strict";n.r(e);var o=n(9),r={components:{SendFinancialDataToCrmButton:n(56).a},computed:{isInEnglish:function(){return"en"==this.resource.lang},customerId:function(){return this.$route.params.id},userId:function(){var t;return null!==(t=this.$route.query.user_id)&&void 0!==t?t:o.default.getId()}},data:function(){return{resource:{lang:window.localStorage.getItem("report:lang")||"en",loading:!1,data:{}},url:null}},methods:{getReportData:function(){var t=this,e=this.$route.params.id,n=this.$route.query.user_id||o.default.getId();axios.get("/api/v1/reports/overall/customer/".concat(e,"/user/").concat(n)).then((function(e){t.resource.data=e.data,console.log(t.resource.data)}))},getReport:function(){var t=this.$route.query.user_id||o.default.getId(),e=this.$route.params.id,n=this.$route.query.lang||this.resource.lang,r=Object.assign({},this.$route.query,{lang:n});this.$router.replace({query:r}).catch((function(t){})),this.url="/best/preview/reports/ratios?user_id=".concat(t,"&customer_id=").concat(e,"&lang=").concat(n,"&filename=").concat("Financial Analysis Report")},previewPDFOverallReport:function(t){var e=this.$route.query.lang||this.resource.lang;window.open("/best/reports/pdf/preview?report_id=".concat(t.id,"&type=financialratio&lang=").concat(e,"&filename=").concat("Financial Analysis Report"),"_blank")},sendToCrm:function(t){console.log(this.resource.data);var e={Id:this.resource.data.token,FileNo:this.resource.data.refnum,OverallScore:t.value["overall:score"],FileContentBase64:t.fileContentBase64,"Lessons Learnt":t.value["overall:comment"]};axios.post($api.crm.save(),e).then((function(t){console.log(t)}))},downloadReport:function(){window.location.href="/reports/".concat(this.$route.params.report,"/download")},setIframeHeight:function(){this.resource.loading=!0,document.querySelector("iframe").addEventListener("load",(function(t){var e=this.contentWindow||this.contentDocument.parentWindow;e.document.body&&(this.height=e.document.documentElement.scrollHeight||e.document.body.scrollHeight)})),this.resource.loading=!1},goToShowPage:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"en";window.localStorage.setItem("report:lang",t),this.resource.lang=t,this.$router.push({name:"reports.ratios",params:{id:this.$route.params.id,report:this.$route.params.report},query:{lang:t,type:"ratios"}}).catch((function(t){})),this.$router.go()}},mounted:function(){this.setIframeHeight(),this.getReportData(),this.getReport()}},a=n(0),s=n(2),i=n.n(s),c=n(277),u=n(98),d=Object(a.a)(r,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("admin",[n("metatag",{attrs:{title:t.trans("Find Company")}}),t._v(" "),n("page-header",{attrs:{back:{to:{name:"companies.reports"},text:t.trans("Back to Reports")}},scopedSlots:t._u([{key:"utilities",fn:function(){return[t.resource.data.report?n("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(e){return e.preventDefault(),t.previewPDFOverallReport(t.resource.data.report)}}},[n("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-file-pdf")]),t._v("\n        "+t._s(t.trans("Preview PDF Report"))+"\n      ")],1):t._e()]},proxy:!0},{key:"action",fn:function(){return[n("div",{staticClass:"mb-3"},[t.resource.data.report&&t.isInEnglish?n("send-financial-data-to-crm-button",{attrs:{customer:t.customerId,user:t.userId}}):t._e()],1),t._v(" "),"en"==t.resource.lang?n("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(e){return t.goToShowPage("ar")}}},[n("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-earth")]),t._v("\n        "+t._s(t.trans("View Report in Arabic"))+"\n      ")],1):n("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(e){return t.goToShowPage("en")}}},[n("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-earth")]),t._v("\n        "+t._s(t.trans("View Report in English"))+"\n      ")],1)]},proxy:!0}])}),t._v(" "),[n("v-card",{attrs:{outlined:""}},[n("iframe",{attrs:{width:"100%",id:"iframe-preview",src:t.url,frameborder:"0"}})])]],2)}),[],!1,null,null,null);e.default=d.exports;i()(d,{VCard:c.a,VIcon:u.a})},56:function(t,e,n){"use strict";var o=n(13),r={props:["customer","user"],data:function(){return{isSending:!1,resource:{data:{}}}},computed:{isOverall:function(){return"overall"==this.type}},methods:{getReportData:function(){var t=this;return new Promise((function(e,n){t.customer;var o=t.user;axios.get("/api/v1/reports/financial-ratio//".concat(customecustomerr,"/user/").concat(o)).then((function(t){e(t)})).catch((function(t){n(t)}))}))},sendBothScoreAndDocument:function(){this.sendToCrm(),this.sendDocumentToCrm()},sendToCrm:function(){var t=this;this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(e){if(t.resource.data=e.data,!t.resource.data.customer)return t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:"Please complete all surveys for the Financial Report to be submitted."}),t.isSending=!1,!1;console.log(t.resource);var n={FileNo:t.resource.data.customer.filenumber,YearofFinancial:t.resource.data.customer.metadata.years.Years.Year3,SubmissionDate:t.resource.data.profit_and_loss["Submission Date"]||t.resource.data.date,Revenue:parseInt(t.resource.data.profit_and_loss.Revenue.Year3||0),CostofGoodsSold:parseInt(t.resource.data.profit_and_loss.CostOfGoodsSold.Year3||0),OtherExpenses:0,NonOperatingExpenses:parseInt(t.resource.data.profit_and_loss.OtherExpenses["Non-Operating expenses (NOE)"].Year3||0),OperatingLossProfit:parseInt(t.resource.data.profit_and_loss.OtherExpenses["Operating (loss)/profit"].Year3||0),Depreciation:parseInt(t.resource.data.profit_and_loss.OtherExpenses.Depreciation.Year3||0),Taxes:parseInt(t.resource.data.profit_and_loss.OtherExpenses.Taxes.Year3||0),NetLossProfits:parseInt(t.resource.data.profit_and_loss.NetProfit.Year3||0),FixedAssets:parseInt(t.resource.data.profit_and_loss.FixedAssets["Fixed Assets"].Year3||0),TotalLiabilities:parseInt(t.resource.data.profit_and_loss.FixedAssets["Total Liabilities"].Year3||0),StockholdersEquity:parseInt(t.resource.data.profit_and_loss.FixedAssets["Stockholders' Equity"].Year3||0),Marketing:parseInt(t.resource.data.profit_and_loss.Marketing.Year3||0),Rent:parseInt(t.resource.data.profit_and_loss.Rent.Year3||0),Salaries:parseInt(t.resource.data.profit_and_loss.Salaries.Year3||0),LicensingFees:parseInt(t.resource.data.profit_and_loss["Licensing Fees"].Year3||0),VisaEmploymentFees:parseInt(t.resource.data.profit_and_loss["Visa / Employment Fees"].Year3||0)};console.log(n),t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),axios.post(o.a.crm.sendFinancial(),n).then((function(e){t.$store.dispatch("snackbar/hide"),1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):t.$store.dispatch("dialog/error",{show:!0,width:400,buttons:{cancel:{show:!1}},title:"Returned a Code "+e.data.Code,text:e.data.Message})})).catch((function(e){t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})}))})).catch((function(t){console.log("err",t)}))},sendDocumentToCrm:function(){var t=this;this.isSending=!0,this.getReportData().then((function(e){t.resource.data=e.data;var n={Id:_.toUpper(t.resource.data.customer.token),FileContentBase64:t.resource.data["report:financial"]||"empty"};t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Financial Report Document to CRM. Establishing connection..."}),axios.post(o.a.crm.sendDocument(),n).then((function(e){console.log("data",e.data),t.$store.dispatch("snackbar/hide"),1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):t.$store.dispatch("dialog/error",{show:!0,width:400,buttons:{cancel:{show:!1}},title:"Returned a Code "+e.data.Code,text:e.data.Message})})).catch((function(e){t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){t.isSending=!1}))}))}}},a=n(0),s=n(2),i=n.n(s),c=n(112),u=n(98),d=Object(a.a)(r,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-btn",{attrs:{loading:t.isSending,disabled:t.isSending,large:"",block:t.$vuetify.breakpoint.smAndDown,color:"primary"},on:{click:t.sendBothScoreAndDocument}},[n("v-icon",{attrs:{left:"",small:""}},[t._v("mdi-send")]),t._v("\n  "+t._s(t.trans("Send Financial Report to CRM"))+"\n")],1)}),[],!1,null,null,null);e.a=d.exports;i()(d,{VBtn:c.a,VIcon:u.a})}}]);
//# sourceMappingURL=17.js.map