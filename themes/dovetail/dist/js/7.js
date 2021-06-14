(window.webpackJsonp=window.webpackJsonp||[]).push([[7],{12:function(t,e,o){"use strict";e.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(t)},overall:function(t,e,o){return"/api/v1/reports/overall/customer/".concat(t,"/user/").concat(e,"?month=").concat(o)},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(t){return"/api/v1/surveys/".concat(t,"/submit")},show:function(t){return"/api/v1/surveys/".concat(t)}},crm:{search:function(t){return"/api/v1/crm/customers/search/".concat(t)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"},sendDocument:function(){return"/api/v1/crm/report/send"},sendFinancial:function(){return"/api/v1/crm/financial/send"}},reports:{list:function(t){return"/api/v1/customers/".concat(t,"/reports")},generate:function(t){return"/api/v1/reports/".concat(t,"/generate")},download:function(t){return"/api/v1/reports/".concat(t,"/download")},delete:function(t){return"/api/v1/reports/".concat(t)}}}},315:function(t,e,o){"use strict";o.r(e);var s=o(9),n=o(12),a=o(38),r=o(51),i={components:{SendReportToCrmButton:a.a,SendFinancialDataToCrmButton:r.a},computed:{isInEnglish:function(){return"en"==this.resource.lang}},data:function(){return{api:n.a,resource:{lang:window.localStorage.getItem("report:lang")||"en",loading:!1,data:{report:{month:""}}},url:null}},methods:{getReportData:function(){var t=this,e=this.$route.params.id,o=this.$route.query.user_id||s.default.getId();if(void 0===this.$route.query.month)var a=null;else a=this.$route.query.month;axios.get(n.a.overall(e,o,a)).then((function(e){t.resource.data=e.data}))},getReport:function(){var t=this.$route.query.user_id||s.default.getId(),e=this.$route.params.id,o=this.$route.query.lang||this.resource.lang,n=Object.assign({},this.$route.query,{lang:o});if(void 0===this.$route.query.month)var a=null;else a=this.$route.query.month;this.$router.replace({query:n}).catch((function(t){})),this.url="/best/preview/reports/overall?user_id=".concat(t,"&customer_id=").concat(e,"&month=").concat(a,"&lang=").concat(o)},previewPDFOverallReport:function(t){var e=this.$route.query.lang||this.resource.lang;if(void 0===this.$route.query.month)var o=null;else o=this.$route.query.month;window.open("/best/reports/pdf/preview/overall?user=".concat(t.user_id,"&customer=").concat(t.customer_id,"&month=").concat(o,"&lang=").concat(e),"_blank")},sendToCrm:function(t){var e={Id:this.resource.data.token,FileNo:this.resource.data.refnum,OverallScore:t.value["overall:score"],FileContentBase64:t.fileContentBase64,"Lessons Learnt":t.value["overall:comment"]};axios.post(n.a.crm.save(),e).then((function(t){console.log(t)}))},downloadReport:function(){window.location.href="/reports/".concat(this.$route.params.report,"/download")},setIframeHeight:function(){this.resource.loading=!0,document.querySelector("iframe").addEventListener("load",(function(t){var e=this.contentWindow||this.contentDocument.parentWindow;e.document.body&&(this.height=e.document.documentElement.scrollHeight||e.document.body.scrollHeight)})),this.resource.loading=!1},goToShowPage:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"en";window.localStorage.setItem("report:lang",t),this.resource.lang=t,this.$router.push({name:"reports.overall",params:{id:this.$route.params.id,report:this.$route.params.report},query:{lang:t,type:"overall"}}).catch((function(t){})),this.$router.go()}},mounted:function(){this.setIframeHeight(),this.getReportData(),this.getReport()}},c=o(0),l=o(2),u=o.n(l),d=o(262),p=o(91),h=Object(c.a)(i,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("admin",[o("metatag",{attrs:{title:t.trans("Overall Report")}}),t._v(" "),o("page-header",{attrs:{back:{to:{name:"companies.reports"},text:t.trans("Back to Reports")}},scopedSlots:t._u([{key:"utilities",fn:function(){return[o("div",{staticClass:"mb-2"},[t.resource.data.report?o("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(e){return e.preventDefault(),t.previewPDFOverallReport(t.resource.data.report)}}},[o("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-file-pdf")]),t._v("\n          "+t._s(t.trans("Preview PDF Report"))+"\n        ")],1):t._e()]),t._v(" "),o("can",{attrs:{code:"reports.comment"}},[o("add-overall-comment",{attrs:{month:t.resource.data.report.month},on:{"update:month":function(e){return t.$set(t.resource.data.report,"month",e)}}})],1)]},proxy:!0},{key:"action",fn:function(){return["en"==t.resource.lang?o("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(e){return t.goToShowPage("ar")}}},[o("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-earth")]),t._v("\n        "+t._s(t.trans("View Report in Arabic"))+"\n      ")],1):o("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(e){return t.goToShowPage("en")}}},[o("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-earth")]),t._v("\n        "+t._s(t.trans("View Report in English"))+"\n      ")],1),t._v(" "),o("div",{staticClass:"mb-3"},[t.resource.data.customer&&t.isInEnglish?o("div",[o("send-report-to-crm-button",{staticClass:"mt-4",attrs:{type:"overall","with-file":"","with-financials":"",customer:t.resource.data.customer.id,user:t.resource.data.report.user_id,month:t.resource.data.report.month}}),t._v(" "),t.resource.data.customer.is_fs_has_no_zero_value&&t.isInEnglish?o("send-financial-data-to-crm-button",{staticClass:"mt-4",attrs:{customer:t.resource.data.customer.id,user:t.resource.data.report.user_id}}):t._e()],1):t._e()])]},proxy:!0}])}),t._v(" "),[o("v-card",{attrs:{outlined:""}},[o("iframe",{attrs:{width:"100%",id:"iframe-preview",src:t.url,frameborder:"0"}})])]],2)}),[],!1,null,null,null);e.default=h.exports;u()(h,{VCard:d.a,VIcon:p.a})},38:function(t,e,o){"use strict";var s=o(12),n={props:["customer","user","type","month"],data:function(){return{isSending:!1,sendAll:!1,checklist:[{message:"",name:trans("Sending Overall Scores"),icon:"mdi-cube-send",status:"pending"},{message:"",name:trans("Sending Overall Document"),icon:"mdi-file-send",status:"pending"}],dialog:!1,sendBothScoresAndFile:!1,resource:{data:{}}}},computed:{isOverall:function(){return"overall"==this.type},isOverallDashboard:function(){return"overall-report-dashboard"==this.type}},methods:{sendAllScoresAndDocuments:function(){this.dialog=!0,this.sendAll=!0,this.checklist=this.checklist.map((function(t){return Object.assign(t,{status:"pending",message:""})})),this.sendToCrm()},getReportData:function(){var t=this;return new Promise((function(e,o){var s=t.customer,n=t.user,a=t.month;axios.get("/api/v1/reports/overall/customer/".concat(s,"/user/").concat(n,"?month=").concat(a)).then((function(t){e(t)})).catch((function(t){o(t)}))}))},getElements:function(){console.log(this.resource.data);var t=this.resource.data.report.value||{},e={};if(this.isOverall||this.isOverallDashboard)for(var o=_.map(t.indices,(function(t,e){return t.elements})),s=o.length-1;s>=0;s--){var n=o[s];e=Object.assign(e,n,{OverallScore:100*t["overall:score"],SustainabilityOverallScore:t.indices.BSPI["overall:total"]/100,FinancialOverallScore:t.indices.FMPI["overall:total"]/100,ProductivityOverallScore:t.indices.PMPI["overall:total"]/100,HROverallScore:t.indices.HRPI["overall:total"]/100})}else e=t["current:index"].elements;e=_.mapKeys(e,(function(t,e){return e.replace(/[^a-zA-Z]/g,"")})),e=_.mapKeys(e,(function(t,e){return e.replace(/\s+/g,"")})),(e=_.mapValues(e,(function(t,e){return 100*t}))).EmployeeEngagement=e.EmployeeEngagementCommunication||0,e.CareerManagement=e.CareerTalentManagement||0;var a=t["overall:enablers"].chart.data,r=t["overall:enablers"].chart.label;for(s=a.length-1;s>=0;s--){var i=a[s];e[r[s]]=i||0}return e.WorkflowProcesses=e["Workflow Processess"]||"",e},getOverallScore:function(){var t=this.resource.data.report.value["current:index"]["overall:total"],e="OverallScore";switch(this.resource.data.report.value["current:index"]["pindex:code"]){case"FMPI":e="Financial"+e;break;case"PMPI":e="Productivity"+e;break;case"HRPI":e="HR"+e;break;case"BSPI":e="Sustainability"+e}var o={};return o[e]=t,o},sendToCrm:function(){var t=this;this.isSending=!0,this.checklist[0].status="sending",this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(e){if(t.resource.data=e.data,console.log(e.data),!t.resource.data.customer)return t.$store.dispatch("snackbar/show",{text:"No report data found."}),!1;var o=Object.assign(t.getOverallScore(),t.getElements(),{Id:_.toUpper(t.resource.data.customer.token),FileNo:t.resource.data.customer.filenumber,Status:100000006,OverallScore:100*t.resource.data.report.value["overall:score"]||null,Comments:t.resource.data["overall:comment"]||"No comment",OverallComment:t.resource.data.report.value["overall:comment"]||null,"Lessons Learnt":t.resource.data.report.value["overall:comment"]||null});t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),console.log("Sending overall scores...",o),axios.post("/api/v1/crm/customers/save",o).then((function(e){t.$store.dispatch("snackbar/hide"),t.checklist[0].status="done",1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):(t.checklist[0].status="error",t.checklist[0].message=e.data.Message),t.sendBothScoresAndFile})).catch((function(e){t.checklist[0].status="error",t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){t.isSending=!1,t.sendAll&&t.sendDocumentToCrm()}))})).catch((function(t){console.log("err",t)}))},sendDocumentToCrm:function(){var t=this;this.isSending=!0,this.checklist[1].status="sending",this.getReportData().then((function(e){t.resource.data=e.data;var o={Id:_.toUpper(t.resource.data.customer.token),FileName:"Overall Scores",FileContentBase64:t.resource.data["overall:report"]||"empty"};console.log("Sending overall document...",o),t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Overall Report Document to CRM. Establishing connection to CRM..."}),axios.post(s.a.crm.sendDocument(),o).then((function(e){t.$store.dispatch("snackbar/hide"),t.checklist[1].status="done",1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):(t.checklist[1].status="error",t.checklist[1].message=e.data.Message)})).catch((function(e){t.checklist[1].status="error",t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){t.isSending=!1}))}))},sendBothDataToCrm:function(){this.sendBothScoresAndFile=!0,this.sendToCrm()},sendFinancialScores:function(){var t=this;this.checklist[2].status="sending",this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(e){if(t.resource.data=e.data,console.log(t.resource.data),!t.resource.data.customer)return t.$store.dispatch("snackbar/show",{text:"No report data found."}),!1;var o={FileNo:t.resource.data.customer.filenumber,YearofFinancial:t.resource.data.customer.metadata?t.resource.data.customer.metadata.years.Years.Year3:"No year was set",SubmissionDate:t.resource.data.profit_and_loss["Submission Date"]||t.resource.data.report.updated_at,Revenue:parseInt(t.resource.data.profit_and_loss.Revenue.Year3||0),CostofGoodsSold:parseInt(t.resource.data.profit_and_loss.CostOfGoodsSold.Year3||0),OtherExpenses:parseInt(t.resource.data.profit_and_loss.OtherExpenses.Year3||0),NonOperatingExpenses:parseInt(t.resource.data.profit_and_loss.OtherExpenses["Non-Operating expenses (NOE)"].Year3||0),OperatingLossProfit:parseInt(t.resource.data.profit_and_loss.OtherExpenses["Operating (loss)/profit"].Year3||0),Depreciation:parseInt(t.resource.data.profit_and_loss.OtherExpenses.Depreciation.Year3||0),Taxes:parseInt(t.resource.data.profit_and_loss.OtherExpenses.Taxes.Year3||0),NetLossProfits:parseInt(t.resource.data.profit_and_loss.NetProfit.Year3||0),FixedAssets:parseInt(t.resource.data.profit_and_loss.FixedAssets["Fixed Assets"].Year3||0),TotalLiabilities:parseInt(t.resource.data.profit_and_loss.FixedAssets["Total Liabilities"].Year3||0),StockholdersEquity:parseInt(t.resource.data.profit_and_loss.FixedAssets["Stockholders' Equity"].Year3||0),Marketing:parseInt(t.resource.data.profit_and_loss.Marketing.Year3||0),Rent:parseInt(t.resource.data.profit_and_loss.Rent.Year3||0),Salaries:parseInt(t.resource.data.profit_and_loss.Salaries.Year3||0),LicensingFees:parseInt(t.resource.data.profit_and_loss["Licensing Fees"].Year3||0),VisaEmploymentFees:parseInt(t.resource.data.profit_and_loss["Visa / Employment Fees"].Year3||0)};console.log("Sending financial scores...",o),t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),axios.post(s.a.crm.sendFinancial(),o).then((function(e){t.$store.dispatch("snackbar/hide"),t.checklist[2].status="done",1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):(t.checklist[2].status="error",t.checklist[2].message=e.data.Message)})).catch((function(e){t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")}),t.checklist[2].status="error"})).finally((function(){}))})).catch((function(t){console.log("err",t)}))},sendFinancialDocument:function(){var t=this;this.checklist[3].status="sending",this.getReportData().then((function(e){t.resource.data=e.data,console.log(t);var o={Id:_.toUpper(t.resource.data.customer.token),FileName:"Financial Ratios",FileContentBase64:t.resource.data["report:financial"]||"empty"};console.log("Sending financial document...",o),t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Financial Report Document to CRM. Establishing connection..."}),axios.post(s.a.crm.sendDocument(),o).then((function(e){console.log("data",e.data),t.$store.dispatch("snackbar/hide"),t.checklist[3].status="done",1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):(t.checklist[3].status="error",t.checklist[3].message=e.data.Message)})).catch((function(e){t.checklist[3].status="error",t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){}))}))}}},a=o(0),r=o(2),i=o.n(r),c=o(104),l=o(262),u=o(1),d=o(584),p=o(91),h=o(266),m=o(106),v=o(267),f=o(14),g=o(261),b=o(583),k=Object(a.a)(n,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return t.isOverall?o("div",[o("v-btn",{attrs:{loading:t.isSending,disabled:t.isSending,large:"",block:t.$vuetify.breakpoint.smAndDown,color:"primary"},on:{click:t.sendAllScoresAndDocuments}},[o("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-send")]),t._v("\n    "+t._s(t.trans("Send to CRM"))+"\n  ")],1),t._v(" "),o("v-dialog",{attrs:{"max-width":"420",persistent:""},model:{value:t.dialog,callback:function(e){t.dialog=e},expression:"dialog"}},[o("v-card",[o("v-list",t._l(t.checklist,(function(e,s){return o("v-list-item",{key:s,attrs:{title:e.message}},[o("v-list-item-content",[o("v-list-item-title",{domProps:{textContent:t._s(e.name)}})],1),t._v(" "),o("v-list-item-action",["pending"==e.status?o("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-checkbox-blank-circle-outline")]):"sending"==e.status?o("v-progress-circular",{attrs:{indeterminate:"",width:"2",size:"12"}}):"done"==e.status?o("v-icon",{attrs:{small:"",left:"",color:"success"}},[t._v("mdi-check")]):"error"==e.status?o("div",[o("v-icon",{attrs:{small:"",left:"",color:"error"}},[t._v("mdi-alert-circle")])],1):t._e()],1)],1)})),1),t._v(" "),o("v-card-actions",[o("v-spacer"),t._v(" "),o("v-btn",{attrs:{depressed:""},on:{click:function(e){t.dialog=!1}}},[t._v("Close")])],1)],1)],1)],1):t.isOverallDashboard?o("v-btn",{attrs:{icon:""},on:{click:t.sendAllScoresAndDocuments}},[o("v-icon",{attrs:{small:""}},[t._v("mdi-send")]),t._v(" "),o("v-dialog",{attrs:{"max-width":"420",persistent:""},model:{value:t.dialog,callback:function(e){t.dialog=e},expression:"dialog"}},[o("v-card",[o("v-list",t._l(t.checklist,(function(e,s){return o("v-list-item",{key:s,attrs:{title:e.message}},[o("v-list-item-content",[o("v-list-item-title",{domProps:{textContent:t._s(e.name)}})],1),t._v(" "),o("v-list-item-action",["pending"==e.status?o("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-checkbox-blank-circle-outline")]):"sending"==e.status?o("v-progress-circular",{attrs:{indeterminate:"",width:"2",size:"12"}}):"done"==e.status?o("v-icon",{attrs:{small:"",left:"",color:"success"}},[t._v("mdi-check")]):"error"==e.status?o("div",[o("v-icon",{attrs:{small:"",left:"",color:"error"}},[t._v("mdi-alert-circle")])],1):t._e()],1)],1)})),1),t._v(" "),o("v-card-actions",[o("v-spacer"),t._v(" "),o("v-btn",{attrs:{depressed:""},on:{click:function(e){t.dialog=!1}}},[t._v("Close")])],1)],1)],1)],1):o("v-btn",{attrs:{icon:""},on:{click:t.sendToCrm}},[o("v-icon",{attrs:{small:""}},[t._v("mdi-send")])],1)}),[],!1,null,null,null);e.a=k.exports;i()(k,{VBtn:c.a,VCard:l.a,VCardActions:u.a,VDialog:d.a,VIcon:p.a,VList:h.a,VListItem:m.a,VListItemAction:v.a,VListItemContent:f.a,VListItemTitle:f.b,VProgressCircular:g.a,VSpacer:b.a})},51:function(t,e,o){"use strict";var s=o(12),n={props:["customer","user"],data:function(){return{isSending:!1,resource:{data:{}}}},computed:{isOverall:function(){return"overall"==this.type}},methods:{getReportData:function(){var t=this;return new Promise((function(e,o){var s=t.customer,n=t.user;axios.get("/api/v1/reports/financial-ratio/customer/".concat(s,"/user/").concat(n)).then((function(t){e(t)})).catch((function(t){o(t)}))}))},sendBothScoreAndDocument:function(){this.sendToCrm(),this.sendDocumentToCrm()},sendToCrm:function(){var t=this;this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(e){if(t.resource.data=e.data,!t.resource.data.customer)return t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:"Please complete all surveys for the Financial Report to be submitted."}),t.isSending=!1,!1;console.log(t.resource);var o={FileNo:t.resource.data.customer.filenumber,YearofFinancial:t.resource.data.customer.metadata.years.Years.Year3,SubmissionDate:t.resource.data.profit_and_loss["Submission Date"]||t.resource.data.date,Revenue:parseInt(t.resource.data.profit_and_loss.Revenue.Year3||0),CostofGoodsSold:parseInt(t.resource.data.profit_and_loss.CostOfGoodsSold.Year3||0),OtherExpenses:0,NonOperatingExpenses:parseInt(t.resource.data.profit_and_loss.OtherExpenses["Non-Operating expenses (NOE)"].Year3||0),OperatingLossProfit:parseInt(t.resource.data.profit_and_loss.OtherExpenses["Operating (loss)/profit"].Year3||0),Depreciation:parseInt(t.resource.data.profit_and_loss.OtherExpenses.Depreciation.Year3||0),Taxes:parseInt(t.resource.data.profit_and_loss.OtherExpenses.Taxes.Year3||0),NetLossProfits:parseInt(t.resource.data.profit_and_loss.NetProfit.Year3||0),FixedAssets:parseInt(t.resource.data.profit_and_loss.FixedAssets["Fixed Assets"].Year3||0),TotalLiabilities:parseInt(t.resource.data.profit_and_loss.FixedAssets["Total Liabilities"].Year3||0),StockholdersEquity:parseInt(t.resource.data.profit_and_loss.FixedAssets["Stockholders' Equity"].Year3||0),Marketing:parseInt(t.resource.data.profit_and_loss.Marketing.Year3||0),Rent:parseInt(t.resource.data.profit_and_loss.Rent.Year3||0),Salaries:parseInt(t.resource.data.profit_and_loss.Salaries.Year3||0),LicensingFees:parseInt(t.resource.data.profit_and_loss["Licensing Fees"].Year3||0),VisaEmploymentFees:parseInt(t.resource.data.profit_and_loss["Visa / Employment Fees"].Year3||0)};console.log(o),t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),axios.post(s.a.crm.sendFinancial(),o).then((function(e){t.$store.dispatch("snackbar/hide"),1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):t.$store.dispatch("dialog/error",{show:!0,width:400,buttons:{cancel:{show:!1}},title:"Returned a Code "+e.data.Code,text:e.data.Message})})).catch((function(e){t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})}))})).catch((function(t){console.log("err",t)}))},sendDocumentToCrm:function(){var t=this;this.isSending=!0,this.getReportData().then((function(e){t.resource.data=e.data;var o={Id:_.toUpper(t.resource.data.customer.token),FileContentBase64:t.resource.data["report:financial"]||"empty"};t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Financial Report Document to CRM. Establishing connection..."}),axios.post(s.a.crm.sendDocument(),o).then((function(e){console.log("data",e.data),t.$store.dispatch("snackbar/hide"),1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):t.$store.dispatch("dialog/error",{show:!0,width:400,buttons:{cancel:{show:!1}},title:"Returned a Code "+e.data.Code,text:e.data.Message})})).catch((function(e){t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){t.isSending=!1}))}))}}},a=o(0),r=o(2),i=o.n(r),c=o(104),l=o(91),u=Object(a.a)(n,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("v-btn",{attrs:{loading:t.isSending,disabled:t.isSending,large:"",block:t.$vuetify.breakpoint.smAndDown,color:"primary"},on:{click:t.sendBothScoreAndDocument}},[o("v-icon",{attrs:{left:"",small:""}},[t._v("mdi-send")]),t._v("\n  "+t._s(t.trans("Send Financial Report to CRM"))+"\n")],1)}),[],!1,null,null,null);e.a=u.exports;i()(u,{VBtn:c.a,VIcon:l.a})}}]);
//# sourceMappingURL=7.js.map