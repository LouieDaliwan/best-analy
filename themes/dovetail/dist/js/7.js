(window.webpackJsonp=window.webpackJsonp||[]).push([[7],{12:function(e,t,o){"use strict";t.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},restore:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(e)},update:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},delete:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(e)},overall:function(e,t){return"/api/v1/reports/overall/customer/".concat(e,"/user/").concat(t)},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(e){return"/api/v1/surveys/".concat(e,"/submit")},show:function(e){return"/api/v1/surveys/".concat(e)}},crm:{search:function(e){return"/api/v1/crm/customers/search/".concat(e)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"},sendDocument:function(){return"/api/v1/crm/report/send"},sendFinancial:function(){return"/api/v1/crm/financial/send"}},reports:{list:function(e){return"/api/v1/customers/".concat(e,"/reports")},generate:function(e){return"/api/v1/reports/".concat(e,"/generate")},download:function(e){return"/api/v1/reports/".concat(e,"/download")},delete:function(e){return"/api/v1/reports/".concat(e)}}}},315:function(e,t,o){"use strict";o.r(t);var s=o(9),n=o(12),a=o(38),r=o(51),i={components:{SendReportToCrmButton:a.a,SendFinancialDataToCrmButton:r.a},computed:{isInEnglish:function(){return"en"==this.resource.lang}},data:function(){return{api:n.a,resource:{lang:window.localStorage.getItem("report:lang")||"en",loading:!1,data:{report:{month:""}}},url:null}},methods:{getReportData:function(){var e=this,t=this.$route.params.id,o=this.$route.query.user_id||s.default.getId();axios.get(n.a.overall(t,o)).then((function(t){e.resource.data=t.data}))},getReport:function(){var e=this.$route.query.user_id||s.default.getId(),t=this.$route.params.id,o=this.$route.query.lang||this.resource.lang,n=Object.assign({},this.$route.query,{lang:o});this.$router.replace({query:n}).catch((function(e){})),this.url="/best/preview/reports/overall?user_id=".concat(e,"&customer_id=").concat(t,"&lang=").concat(o)},previewPDFOverallReport:function(e){var t=this.$route.query.lang||this.resource.lang;window.open("/best/reports/pdf/preview/overall?user=".concat(e.user_id,"&customer=").concat(e.customer_id,"&month=").concat(e.month,"&lang=").concat(t),"_blank")},sendToCrm:function(e){var t={Id:this.resource.data.token,FileNo:this.resource.data.refnum,OverallScore:e.value["overall:score"],FileContentBase64:e.fileContentBase64,"Lessons Learnt":e.value["overall:comment"]};axios.post(n.a.crm.save(),t).then((function(e){console.log(e)}))},downloadReport:function(){window.location.href="/reports/".concat(this.$route.params.report,"/download")},setIframeHeight:function(){this.resource.loading=!0,document.querySelector("iframe").addEventListener("load",(function(e){var t=this.contentWindow||this.contentDocument.parentWindow;t.document.body&&(this.height=t.document.documentElement.scrollHeight||t.document.body.scrollHeight)})),this.resource.loading=!1},goToShowPage:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"en";window.localStorage.setItem("report:lang",e),this.resource.lang=e,this.$router.push({name:"reports.overall",params:{id:this.$route.params.id,report:this.$route.params.report},query:{lang:e,type:"overall"}}).catch((function(e){})),this.$router.go()}},mounted:function(){this.setIframeHeight(),this.getReportData(),this.getReport()}},c=o(0),l=o(2),u=o.n(l),d=o(262),h=o(91),p=Object(c.a)(i,(function(){var e=this,t=e.$createElement,o=e._self._c||t;return o("admin",[o("metatag",{attrs:{title:e.trans("Overall Report")}}),e._v(" "),o("page-header",{attrs:{back:{to:{name:"companies.reports"},text:e.trans("Back to Reports")}},scopedSlots:e._u([{key:"utilities",fn:function(){return[o("div",{staticClass:"mb-2"},[e.resource.data.report?o("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(t){return t.preventDefault(),e.previewPDFOverallReport(e.resource.data.report)}}},[o("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-file-pdf")]),e._v("\n          "+e._s(e.trans("Preview PDF Report"))+"\n        ")],1):e._e()]),e._v(" "),o("can",{attrs:{code:"reports.comment"}},[o("add-overall-comment",{attrs:{month:e.resource.data.report.month},on:{"update:month":function(t){return e.$set(e.resource.data.report,"month",t)}}})],1)]},proxy:!0},{key:"action",fn:function(){return["en"==e.resource.lang?o("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(t){return e.goToShowPage("ar")}}},[o("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-earth")]),e._v("\n        "+e._s(e.trans("View Report in Arabic"))+"\n      ")],1):o("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(t){return e.goToShowPage("en")}}},[o("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-earth")]),e._v("\n        "+e._s(e.trans("View Report in English"))+"\n      ")],1),e._v(" "),o("div",{staticClass:"mb-3"},[e.resource.data.customer&&e.isInEnglish?o("div",[o("send-report-to-crm-button",{staticClass:"mt-4",attrs:{type:"overall","with-file":"","with-financials":"",customer:e.resource.data.customer.id,user:e.resource.data.report.user_id}}),e._v(" "),e.resource.data.report&&e.isInEnglish?o("send-financial-data-to-crm-button",{staticClass:"mt-4",attrs:{customer:e.resource.data.customer.id,user:e.resource.data.report.user_id}}):e._e()],1):e._e()])]},proxy:!0}])}),e._v(" "),[o("v-card",{attrs:{outlined:""}},[o("iframe",{attrs:{width:"100%",id:"iframe-preview",src:e.url,frameborder:"0"}})])]],2)}),[],!1,null,null,null);t.default=p.exports;u()(p,{VCard:d.a,VIcon:h.a})},38:function(e,t,o){"use strict";var s=o(12),n={props:["customer","user","type"],data:function(){return{isSending:!1,sendAll:!1,checklist:[{message:"",name:trans("Sending Overall Scores"),icon:"mdi-cube-send",status:"pending"},{message:"",name:trans("Sending Overall Document"),icon:"mdi-file-send",status:"pending"},{message:"",name:trans("Sending Financial Scores"),icon:"mdi-cube-send",status:"pending"},{message:"",name:trans("Sending Financial Document"),icon:"mdi-file-send",status:"pending"}],dialog:!1,sendBothScoresAndFile:!1,resource:{data:{}}}},computed:{isOverall:function(){return"overall"==this.type}},methods:{sendAllScoresAndDocuments:function(){this.dialog=!0,this.sendAll=!0,this.checklist=this.checklist.map((function(e){return Object.assign(e,{status:"pending",message:""})})),this.sendToCrm()},getReportData:function(){var e=this;return new Promise((function(t,o){var s=e.customer,n=e.user;axios.get("/api/v1/reports/overall/customer/".concat(s,"/user/").concat(n)).then((function(e){t(e)})).catch((function(e){o(e)}))}))},getElements:function(){console.log(this.resource.data);var e=this.resource.data.report.value||{},t={};if(this.isOverall)for(var o=_.map(e.indices,(function(e,t){return e.elements})),s=o.length-1;s>=0;s--){var n=o[s];t=Object.assign(t,n,{OverallScore:100*e["overall:score"],SustainabilityOverallScore:e.indices.BSPI["overall:total"]/100,FinancialOverallScore:e.indices.FMPI["overall:total"]/100,ProductivityOverallScore:e.indices.PMPI["overall:total"]/100,HROverallScore:e.indices.HRPI["overall:total"]/100})}else t=e["current:index"].elements;t=_.mapKeys(t,(function(e,t){return t.replace(/[^a-zA-Z]/g,"")})),t=_.mapKeys(t,(function(e,t){return t.replace(/\s+/g,"")})),(t=_.mapValues(t,(function(e,t){return 100*e}))).EmployeeEngagement=t.EmployeeEngagementCommunication||0,t.CareerManagement=t.CareerTalentManagement||0;var a=e["overall:enablers"].chart.data,r=e["overall:enablers"].chart.label;for(s=a.length-1;s>=0;s--){var i=a[s];t[r[s]]=i||0}return t.WorkflowProcesses=t["Workflow Processess"]||"",t},getOverallScore:function(){var e=this.resource.data.report.value["current:index"]["overall:total"],t="OverallScore";switch(this.resource.data.report.value["current:index"]["pindex:code"]){case"FMPI":t="Financial"+t;break;case"PMPI":t="Productivity"+t;break;case"HRPI":t="HR"+t;break;case"BSPI":t="Sustainability"+t}var o={};return o[t]=e,o},sendToCrm:function(){var e=this;this.isSending=!0,this.checklist[0].status="sending",this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(t){if(e.resource.data=t.data,!e.resource.data.customer)return e.$store.dispatch("snackbar/show",{text:"No report data found."}),!1;var o=Object.assign(e.getOverallScore(),e.getElements(),{Id:_.toUpper(e.resource.data.customer.token),FileNo:e.resource.data.customer.filenumber,Status:100000006,OverallScore:100*e.resource.data.report.value["overall:score"]||null,Comments:e.resource.data["overall:comment"]||"No comment",OverallComment:e.resource.data.report.value["overall:comment"]||null,"Lessons Learnt":e.resource.data.report.value["overall:comment"]||null});e.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),console.log("Sending overall scores...",o),axios.post("/api/v1/crm/customers/save",o).then((function(t){e.$store.dispatch("snackbar/hide"),e.checklist[0].status="done",1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):(e.checklist[0].status="error",e.checklist[0].message=t.data.Message),e.sendBothScoresAndFile})).catch((function(t){e.checklist[0].status="error",e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){e.isSending=!1,e.sendAll&&e.sendDocumentToCrm()}))})).catch((function(e){console.log("err",e)}))},sendDocumentToCrm:function(){var e=this;this.isSending=!0,this.checklist[1].status="sending",this.getReportData().then((function(t){e.resource.data=t.data;var o={Id:_.toUpper(e.resource.data.customer.token),FileName:"Overall Scores",FileContentBase64:e.resource.data["overall:report"]||"empty"};console.log("Sending overall document...",o),e.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Overall Report Document to CRM. Establishing connection to CRM..."}),axios.post(s.a.crm.sendDocument(),o).then((function(t){e.$store.dispatch("snackbar/hide"),e.checklist[1].status="done",1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):(e.checklist[1].status="error",e.checklist[1].message=t.data.Message)})).catch((function(t){e.checklist[1].status="error",e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){e.isSending=!1,e.sendAll&&e.sendFinancialScores()}))}))},sendBothDataToCrm:function(){this.sendBothScoresAndFile=!0,this.sendToCrm()},sendFinancialScores:function(){var e=this;this.checklist[2].status="sending",this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(t){if(e.resource.data=t.data,console.log(e.resource.data),!e.resource.data.customer)return e.$store.dispatch("snackbar/show",{text:"No report data found."}),!1;var o={FileNo:e.resource.data.customer.filenumber,YearofFinancial:e.resource.data.customer.metadata?e.resource.data.customer.metadata.years.Years.Year3:"No year was set",SubmissionDate:e.resource.data.profit_and_loss["Submission Date"]||e.resource.data.report.updated_at,Revenue:e.resource.data.profit_and_loss.Revenue.Year3,CostofGoodsSold:e.resource.data.profit_and_loss.CostOfGoodsSold.Year3,OtherExpenses:e.resource.data.profit_and_loss.OtherExpenses.Year3||"0",NonOperatingExpenses:e.resource.data.profit_and_loss.OtherExpenses["Non-Operating expenses (NOE)"].Year3||"0",OperatingLossProfit:e.resource.data.profit_and_loss.OtherExpenses["Operating (loss)/profit"].Year3||"0",Depreciation:e.resource.data.profit_and_loss.OtherExpenses.Depreciation.Year3||"0",Taxes:e.resource.data.profit_and_loss.OtherExpenses.Taxes.Year3||"0",NetLossProfits:e.resource.data.profit_and_loss.NetProfit.Year3||"0",FixedAssets:e.resource.data.profit_and_loss.FixedAssets["Fixed Assets"].Year3||"0",TotalLiabilities:e.resource.data.profit_and_loss.FixedAssets["Total Liabilities"].Year3||"0",StockholdersEquity:e.resource.data.profit_and_loss.FixedAssets["Stockholders' Equity"].Year3||"0",Marketing:e.resource.data.profit_and_loss.Marketing.Year3||"0",Rent:e.resource.data.profit_and_loss.Rent.Year3||"0",Salaries:e.resource.data.profit_and_loss.Salaries.Year3||"0",LicensingFees:e.resource.data.profit_and_loss["Licensing Fees"].Year3||"0",VisaEmploymentFees:e.resource.data.profit_and_loss["Visa / Employment Fees"].Year3||"0"};console.log("Sending financial scores...",o),e.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),axios.post(s.a.crm.sendFinancial(),o).then((function(t){e.$store.dispatch("snackbar/hide"),e.checklist[2].status="done",1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):(e.checklist[2].status="error",e.checklist[2].message=t.data.Message)})).catch((function(t){e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")}),e.checklist[2].status="error"})).finally((function(){e.sendAll&&e.sendFinancialDocument()}))})).catch((function(e){console.log("err",e)}))},sendFinancialDocument:function(){var e=this;this.checklist[3].status="sending",this.getReportData().then((function(t){e.resource.data=t.data,console.log(e);var o={Id:_.toUpper(e.resource.data.customer.token),FileName:"Financial Ratios",FileContentBase64:e.resource.data["report:financial"]||"empty"};console.log("Sending financial document...",o),e.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Financial Report Document to CRM. Establishing connection..."}),axios.post(s.a.crm.sendDocument(),o).then((function(t){console.log("data",t.data),e.$store.dispatch("snackbar/hide"),e.checklist[3].status="done",1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):(e.checklist[3].status="error",e.checklist[3].message=t.data.Message)})).catch((function(t){e.checklist[3].status="error",e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){}))}))}}},a=o(0),r=o(2),i=o.n(r),c=o(104),l=o(262),u=o(1),d=o(584),h=o(91),p=o(266),m=o(106),f=o(267),v=o(14),g=o(261),b=o(583),k=Object(a.a)(n,(function(){var e=this,t=e.$createElement,o=e._self._c||t;return e.isOverall?o("div",[o("v-btn",{attrs:{loading:e.isSending,disabled:e.isSending,large:"",block:e.$vuetify.breakpoint.smAndDown,color:"primary"},on:{click:e.sendAllScoresAndDocuments}},[o("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-send")]),e._v("\n    "+e._s(e.trans("Send to CRM"))+"\n  ")],1),e._v(" "),o("v-dialog",{attrs:{"max-width":"420",persistent:""},model:{value:e.dialog,callback:function(t){e.dialog=t},expression:"dialog"}},[o("v-card",[o("v-list",e._l(e.checklist,(function(t,s){return o("v-list-item",{key:s,attrs:{title:t.message}},[o("v-list-item-content",[o("v-list-item-title",{domProps:{textContent:e._s(t.name)}})],1),e._v(" "),o("v-list-item-action",["pending"==t.status?o("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-checkbox-blank-circle-outline")]):"sending"==t.status?o("v-progress-circular",{attrs:{indeterminate:"",width:"2",size:"12"}}):"done"==t.status?o("v-icon",{attrs:{small:"",left:"",color:"success"}},[e._v("mdi-check")]):"error"==t.status?o("div",[o("v-icon",{attrs:{small:"",left:"",color:"error"}},[e._v("mdi-alert-circle")])],1):e._e()],1)],1)})),1),e._v(" "),o("v-card-actions",[o("v-spacer"),e._v(" "),o("v-btn",{attrs:{depressed:""},on:{click:function(t){e.dialog=!1}}},[e._v("Close")])],1)],1)],1)],1):o("v-btn",{attrs:{icon:""},on:{click:e.sendToCrm}},[o("v-icon",{attrs:{small:""}},[e._v("mdi-send")])],1)}),[],!1,null,null,null);t.a=k.exports;i()(k,{VBtn:c.a,VCard:l.a,VCardActions:u.a,VDialog:d.a,VIcon:h.a,VList:p.a,VListItem:m.a,VListItemAction:f.a,VListItemContent:v.a,VListItemTitle:v.b,VProgressCircular:g.a,VSpacer:b.a})},51:function(e,t,o){"use strict";var s=o(12),n={props:["customer","user"],data:function(){return{isSending:!1,resource:{data:{}}}},computed:{isOverall:function(){return"overall"==this.type}},methods:{getReportData:function(){var e=this;return new Promise((function(t,o){var s=e.customer,n=e.user;axios.get("/api/v1/reports/overall/customer/".concat(s,"/user/").concat(n)).then((function(e){t(e)})).catch((function(e){o(e)}))}))},sendBothScoreAndDocument:function(){this.sendToCrm(),this.sendDocumentToCrm()},sendToCrm:function(){var e=this;this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(t){if(e.resource.data=t.data,!e.resource.data.customer)return e.$store.dispatch("snackbar/show",{text:"No report data found."}),!1;var o={FileNo:e.resource.data.customer.filenumber,YearofFinancial:e.resource.data.customer.metadata.years.Years.Year3,SubmissionDate:e.resource.data.profit_and_loss["Submission Date"]||e.resource.data.report.updated_at,Revenue:e.resource.data.profit_and_loss.Revenue.Year3||"0",CostofGoodsSold:e.resource.data.profit_and_loss.CostOfGoodsSold.Year3||"0",OtherExpenses:0,NonOperatingExpenses:e.resource.data.profit_and_loss.OtherExpenses["Non-Operating expenses (NOE)"].Year3||"0",OperatingLossProfit:e.resource.data.profit_and_loss.OtherExpenses["Operating (loss)/profit"].Year3||"0",Depreciation:e.resource.data.profit_and_loss.OtherExpenses.Depreciation.Year3||"0",Taxes:e.resource.data.profit_and_loss.OtherExpenses.Taxes.Year3||"0",NetLossProfits:e.resource.data.profit_and_loss.NetProfit.Year3||"0",FixedAssets:e.resource.data.profit_and_loss.FixedAssets["Fixed Assets"].Year3||"0",TotalLiabilities:e.resource.data.profit_and_loss.FixedAssets["Total Liabilities"].Year3||"0",StockholdersEquity:e.resource.data.profit_and_loss.FixedAssets["Stockholders' Equity"].Year3||"0",Marketing:e.resource.data.profit_and_loss.Marketing.Year3||"0",Rent:e.resource.data.profit_and_loss.Rent.Year3||"0",Salaries:e.resource.data.profit_and_loss.Salaries.Year3||"0",LicensingFees:e.resource.data.profit_and_loss["Licensing Fees"].Year3||"0",VisaEmploymentFees:e.resource.data.profit_and_loss["Visa / Employment Fees"].Year3||"0"};console.log(o),e.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),axios.post(s.a.crm.sendFinancial(),o).then((function(t){e.$store.dispatch("snackbar/hide"),1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):e.$store.dispatch("dialog/error",{show:!0,width:400,buttons:{cancel:{show:!1}},title:"Returned a Code "+t.data.Code,text:t.data.Message})})).catch((function(t){e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})}))})).catch((function(e){console.log("err",e)}))},sendDocumentToCrm:function(){var e=this;this.isSending=!0,this.getReportData().then((function(t){e.resource.data=t.data;var o={Id:_.toUpper(e.resource.data.customer.token),FileContentBase64:e.resource.data["report:financial"]||"empty"};e.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Financial Report Document to CRM. Establishing connection..."}),axios.post(s.a.crm.sendDocument(),o).then((function(t){console.log("data",t.data),e.$store.dispatch("snackbar/hide"),1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):e.$store.dispatch("dialog/error",{show:!0,width:400,buttons:{cancel:{show:!1}},title:"Returned a Code "+t.data.Code,text:t.data.Message})})).catch((function(t){e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){e.isSending=!1}))}))}}},a=o(0),r=o(2),i=o.n(r),c=o(104),l=o(91),u=Object(a.a)(n,(function(){var e=this,t=e.$createElement,o=e._self._c||t;return o("v-btn",{attrs:{loading:e.isSending,disabled:e.isSending,large:"",block:e.$vuetify.breakpoint.smAndDown,color:"primary"},on:{click:e.sendBothScoreAndDocument}},[o("v-icon",{attrs:{left:"",small:""}},[e._v("mdi-send")]),e._v("\n  "+e._s(e.trans("Send Financial Report to CRM"))+"\n")],1)}),[],!1,null,null,null);t.a=u.exports;i()(u,{VBtn:c.a,VIcon:l.a})}}]);
//# sourceMappingURL=7.js.map