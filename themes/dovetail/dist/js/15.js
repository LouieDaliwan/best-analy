(window.webpackJsonp=window.webpackJsonp||[]).push([[15],{12:function(t,e,r){"use strict";e.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(t)},overall:function(t,e){return"/api/v1/reports/overall/customer/".concat(t,"/user/").concat(e)},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(t){return"/api/v1/surveys/".concat(t,"/submit")},show:function(t){return"/api/v1/surveys/".concat(t)}},crm:{search:function(t){return"/api/v1/crm/customers/search/".concat(t)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"},sendDocument:function(){return"/api/v1/crm/report/send"},sendFinancial:function(){return"/api/v1/crm/financial/send"}},reports:{list:function(t){return"/api/v1/customers/".concat(t,"/reports")},generate:function(t){return"/api/v1/reports/".concat(t,"/generate")},download:function(t){return"/api/v1/reports/".concat(t,"/download")},delete:function(t){return"/api/v1/reports/".concat(t)}}}},295:function(t,e,r){"use strict";r.r(e);var o=r(9),n=r(12),a={components:{SendReportToCrmButton:r(38).a},data:function(){return{api:n.a,resource:{lang:window.localStorage.getItem("report:lang")||"en",loading:!1,data:{report:{month:""}}},url:null}},methods:{getReportData:function(){var t=this,e=this.$route.params.id,r=this.$route.query.user_id||o.default.getId();axios.get(n.a.overall(e,r)).then((function(e){t.resource.data=e.data}))},getReport:function(){var t=this.$route.query.user_id||o.default.getId(),e=this.$route.params.id,r=this.$route.query.lang||this.resource.lang,n=Object.assign({},this.$route.query,{lang:r});this.$router.replace({query:n}).catch((function(t){})),this.url="/best/preview/reports/overall?user_id=".concat(t,"&customer_id=").concat(e,"&lang=").concat(r)},previewPDFOverallReport:function(t){var e=this.$route.query.lang||this.resource.lang;window.open("/best/reports/pdf/preview/overall?user=".concat(t.user_id,"&customer=").concat(t.customer_id,"&month=").concat(t.month,"&lang=").concat(e),"_blank")},sendToCrm:function(t){var e={Id:this.resource.data.token,FileNo:this.resource.data.refnum,OverallScore:t.value["overall:score"],FileContentBase64:t.fileContentBase64,"Lessons Learnt":t.value["overall:comment"]};axios.post(n.a.crm.save(),e).then((function(t){console.log(t)}))},downloadReport:function(){window.location.href="/reports/".concat(this.$route.params.report,"/download")},setIframeHeight:function(){this.resource.loading=!0,document.querySelector("iframe").addEventListener("load",(function(t){var e=this.contentWindow||this.contentDocument.parentWindow;e.document.body&&(this.height=e.document.documentElement.scrollHeight||e.document.body.scrollHeight)})),this.resource.loading=!1},goToShowPage:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"en";window.localStorage.setItem("report:lang",t),this.resource.lang=t,this.$router.push({name:"reports.overall",params:{id:this.$route.params.id,report:this.$route.params.report},query:{lang:t,type:"overall"}}).catch((function(t){})),this.$router.go()}},mounted:function(){this.setIframeHeight(),this.getReportData(),this.getReport()}},s=r(0),c=r(2),i=r.n(c),l=r(259),u=r(90),d=Object(s.a)(a,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("admin",[r("metatag",{attrs:{title:t.trans("Overall Report")}}),t._v(" "),r("page-header",{attrs:{back:{to:{name:"companies.reports"},text:t.trans("Back to Reports")}},scopedSlots:t._u([{key:"utilities",fn:function(){return[r("div",{staticClass:"mb-2"},[t.resource.data.report?r("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(e){return e.preventDefault(),t.previewPDFOverallReport(t.resource.data.report)}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-file-pdf")]),t._v("\n          "+t._s(t.trans("Preview PDF Report"))+"\n        ")],1):t._e()]),t._v(" "),r("can",{attrs:{code:"reports.comment"}},[r("add-overall-comment",{attrs:{month:t.resource.data.report.month},on:{"update:month":function(e){return t.$set(t.resource.data.report,"month",e)}}})],1)]},proxy:!0},{key:"action",fn:function(){return[r("div",{staticClass:"mb-3"},[t.resource.data.customer?r("div",[r("send-report-to-crm-button",{attrs:{type:"overall","with-file":"",customer:t.resource.data.customer.id,user:t.resource.data.report.user_id}})],1):t._e()]),t._v(" "),"en"==t.resource.lang?r("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(e){return t.goToShowPage("ar")}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-earth")]),t._v("\n        "+t._s(t.trans("View Report in Arabic"))+"\n      ")],1):r("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(e){return t.goToShowPage("en")}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-earth")]),t._v("\n        "+t._s(t.trans("View Report in English"))+"\n      ")],1)]},proxy:!0}])}),t._v(" "),[r("v-card",{attrs:{outlined:""}},[r("iframe",{attrs:{width:"100%",id:"iframe-preview",src:t.url,frameborder:"0"}})])]],2)}),[],!1,null,null,null);e.default=d.exports;i()(d,{VCard:l.a,VIcon:u.a})},38:function(t,e,r){"use strict";var o=r(12),n={props:["customer","user","type"],data:function(){return{resource:{data:{}}}},computed:{isOverall:function(){return"overall"==this.type}},methods:{getReportData:function(){var t=this;return new Promise((function(e,r){var o=t.customer,n=t.user;axios.get("/api/v1/reports/overall/customer/".concat(o,"/user/").concat(n)).then((function(t){e(t)})).catch((function(t){r(t)}))}))},getElements:function(){console.log(this.resource.data);var t=this.resource.data.report.value||{},e={};if(this.isOverall)for(var r=_.map(t.indices,(function(t,e){return t.elements})),o=r.length-1;o>=0;o--){var n=r[o];e=Object.assign(e,n,{OverallScore:100*t["overall:score"],SustainabilityOverallScore:t.indices.BSPI["overall:total"]/100,FinancialOverallScore:t.indices.FMPI["overall:total"]/100,ProductivityOverallScore:t.indices.PMPI["overall:total"]/100,HROverallScore:t.indices.HRPI["overall:total"]/100})}else e=t["current:index"].elements;e=_.mapKeys(e,(function(t,e){return e.replace(/[^a-zA-Z]/g,"")})),e=_.mapKeys(e,(function(t,e){return e.replace(/\s+/g,"")})),(e=_.mapValues(e,(function(t,e){return 100*t}))).EmployeeEngagement=e.EmployeeEngagementCommunication||0,e.CareerManagement=e.CareerTalentManagement||0;var a=t["overall:enablers"].chart.data,s=t["overall:enablers"].chart.label;for(o=a.length-1;o>=0;o--){var c=a[o];e[s[o]]=c||0}return e.WorkflowProcesses=e["Workflow Processess"]||"",e},getOverallScore:function(){var t=this.resource.data.report.value["current:index"]["overall:total"],e="OverallScore";switch(this.resource.data.report.value["current:index"]["pindex:code"]){case"FMPI":e="Financial"+e;break;case"PMPI":e="Productivity"+e;break;case"HRPI":e="HR"+e;break;case"BSPI":e="Sustainability"+e}var r={};return r[e]=t,r},sendToCrm:function(){var t=this;this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(e){if(t.resource.data=e.data,!t.resource.data.customer)return t.$store.dispatch("snackbar/show",{text:"No report data found."}),!1;var r=Object.assign(t.getOverallScore(),t.getElements(),{Id:_.toUpper(t.resource.data.customer.token),FileNo:t.resource.data.customer.filenumber,Status:100000006,OverallScore:100*t.resource.data.report.value["overall:score"]||null,Comments:t.resource.data["overall:comment"]||"No comment",OverallComment:t.resource.data.report.value["overall:comment"]||null,"Lessons Learnt":t.resource.data.report.value["overall:comment"]||null});t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),console.log("DATA",r),axios.post("/api/v1/crm/customers/save",r).then((function(e){t.$store.dispatch("snackbar/hide"),1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):t.$store.dispatch("dialog/error",{show:!0,width:400,buttons:{cancel:{show:!1}},title:"Returned a Code "+e.data.Code,text:e.data.Message})})).catch((function(e){t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})}))})).catch((function(t){console.log("err",t)}))},sendDocumentToCrm:function(){var t=this;this.getReportData().then((function(e){t.resource.data=e.data;var r={Id:_.toUpper(t.resource.data.customer.token),FileContentBase64:t.resource.data.report.fileContentBase64};t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Overall Report Document to CRM. Establishing connection to CRM..."}),axios.post(o.a.crm.sendDocument(),r).then((function(e){t.$store.dispatch("snackbar/hide"),1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):t.$store.dispatch("dialog/error",{show:!0,width:400,buttons:{cancel:{show:!1}},title:"Returned a Code "+e.data.Code,text:e.data.Message})})).catch((function(e){t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})}))}))},sendBothDataToCrm:function(){this.sendToCrm(),this.sendDocumentToCrm()}}},a=r(0),s=r(2),c=r.n(s),i=r(104),l=r(90),u=r(263),d=r(103),m=r(264),v=r(14),p=r(268),h=Object(a.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return t.isOverall?r("div",[r("v-btn",{attrs:{large:"",block:t.$vuetify.breakpoint.smAndDown,color:"primary"},on:{click:t.sendToCrm}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-send")]),t._v("\n    "+t._s(t.trans("Send Scores to CRM"))+"\n  ")],1),t._v(" "),r("v-menu",{scopedSlots:t._u([{key:"activator",fn:function(e){var o=e.on;return[r("v-btn",t._g({attrs:{large:"",block:t.$vuetify.breakpoint.smAndDown,color:"primary"}},o),[r("v-icon",{attrs:{small:""}},[t._v("mdi-dots-horizontal")])],1)]}}],null,!1,647217361)},[t._v(" "),r("v-list",[r("v-list-item",{on:{click:t.sendDocumentToCrm}},[r("v-list-item-action",[r("v-icon",{staticClass:"text--muted",attrs:{small:""}},[t._v("mdi-paperclip")])],1),t._v(" "),r("v-list-item-content",[r("v-list-item-title",{domProps:{textContent:t._s(t.trans("Send Overall Report Document to CRM"))}})],1)],1),t._v(" "),r("v-list-item",{on:{click:t.sendBothDataToCrm}},[r("v-list-item-action",[r("v-icon",{staticClass:"text--muted",attrs:{small:""}},[t._v("mdi-paperclip")])],1),t._v(" "),r("v-list-item-content",[r("v-list-item-title",{domProps:{textContent:t._s(t.trans("Send Both Scores and Report Document to CRM"))}})],1)],1)],1)],1)],1):r("v-btn",{attrs:{icon:""},on:{click:t.sendToCrm}},[r("v-icon",{attrs:{small:""}},[t._v("mdi-send")])],1)}),[],!1,null,null,null);e.a=h.exports;c()(h,{VBtn:i.a,VIcon:l.a,VList:u.a,VListItem:d.a,VListItemAction:m.a,VListItemContent:v.a,VListItemTitle:v.b,VMenu:p.a})}}]);
//# sourceMappingURL=15.js.map