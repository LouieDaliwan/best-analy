(window.webpackJsonp=window.webpackJsonp||[]).push([[42],{285:function(e,t,s){"use strict";s.r(t);var o=s(9),a=s(12),n=s(52),r=s(38),i={props:["item","user","type"],data:function(){return{isSending:!1,resource:{data:{}}}},computed:{isOverall:function(){return"overall"==this.type}},methods:{getElements:function(){var e={};return e=(this.item.value||{})["current:index"].elements,e=_.mapKeys(e,(function(e,t){return t.replace(/[^a-zA-Z]/g,"")})),e=_.mapKeys(e,(function(e,t){return t.replace(/\s+/g,"")})),e=_.mapValues(e,(function(e,t){return 100*e}))},getOverallScore:function(){var e=this.item.value["current:index"]["overall:total"],t="OverallScore";switch(this.item.value["current:index"]["pindex:code"]){case"FMPI":t="Financial"+t;break;case"PMPI":t="Productivity"+t;break;case"HRPI":t="HR"+t;break;case"BSPI":t="Sustainability"+t}var s={};return s[t]=e,s},sendToCrm:function(){var e=this;if(this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),!this.item.customer)return this.$store.dispatch("snackbar/show",{text:"No report data found."}),!1;var t=Object.assign(this.getOverallScore(),this.getElements(),{Id:_.toUpper(this.item.customer.token),FileNo:this.item.customer.filenumber,Status:100000006,OverallScore:100*(this.item.value["overall:score"]||0),Comments:this.item["overall:comment"]||"No comment",OverallComment:this.item.value["overall:comment"]||null,"Lessons Learnt":this.item.value["overall:comment"]||null});console.log("data:scores",t),this.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),axios.post("/api/v1/crm/customers/save",t).then((function(t){e.$store.dispatch("snackbar/hide"),1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):e.$store.dispatch("dialog/error",{show:!0,width:400,buttons:{cancel:{show:!1}},title:"Returned a Code "+t.data.Code,text:t.data.Message})})).catch((function(t){e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})}))},sendDocumentToCrm:function(){var e=this;this.isSending=!0;var t={Id:_.toUpper(this.item.customer.token),FileContentBase64:this.item.fileContentBase64};this.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Overall Report Document to CRM. Establishing connection to CRM..."}),axios.post(a.a.crm.sendDocument(),t).then((function(t){e.$store.dispatch("snackbar/hide"),1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):e.$store.dispatch("dialog/error",{show:!0,width:400,buttons:{cancel:{show:!1}},title:"Returned a Code "+t.data.Code,text:t.data.Message})})).catch((function(t){e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){e.isSending=!1}))},sendBothDataToCrm:function(){this.sendToCrm(),this.sendDocumentToCrm()}}},c=s(0),l=s(2),u=s.n(l),d=s(104),h=s(91),p=Object(c.a)(i,(function(){var e=this.$createElement,t=this._self._c||e;return t("v-btn",{attrs:{loading:this.isSending,disabled:this.isSending,icon:""},on:{click:this.sendDocumentToCrm}},[t("v-icon",{attrs:{small:""}},[this._v("mdi-send")])],1)}),[],!1,null,null,null),m=p.exports;u()(p,{VBtn:d.a,VIcon:h.a});var g=s(6);function v(e,t){var s=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),s.push.apply(s,o)}return s}function f(e,t,s){return t in e?Object.defineProperty(e,t,{value:s,enumerable:!0,configurable:!0,writable:!0}):e[t]=s,e}var b={components:{SendReportToCrmButton:r.a,SendIndividualReportToCrmButton:m},computed:{resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},allReportPresent:function(){return 4==this.resources.data.length}},data:function(){return{resource:new n.a,resources:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},meta:{},modes:{bulkedit:!1},selected:[],headers:[{text:trans("Report Type"),align:"left",value:"key",class:"text-no-wrap"},{text:trans("Generated By"),align:"left",value:"user_id",class:"text-no-wrap"},{text:trans("Site Visit Date"),align:"center",value:"remarked",class:"text-no-wrap"},{text:trans("Actions"),align:"center",value:"action",sortable:!1,class:"muted--text text-no-wrap"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1}}},methods:function(e){for(var t=1;t<arguments.length;t++){var s=null!=arguments[t]?arguments[t]:{};t%2?v(Object(s),!0).forEach((function(t){f(e,t,s[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(s)):v(Object(s)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(s,t))}))}return e}({},Object(g.b)({errorDialog:"dialog/error",loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show"}),{previewPDFReport:function(e){window.open("/best/reports/pdf/preview?report_id=".concat(e.id,"&type=index"),"_blank")},previewRatiosReport:function(){this.$router.push({name:"reports.ratios",query:{type:"ratios",user_id:o.default.getId()},params:{id:this.$route.params.id}})},previewOverallReport:function(){this.$router.push({name:"reports.overall",query:{type:"overall",user_id:o.default.getId()},params:{id:this.$route.params.id}})},changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.resources.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(e){this.getPaginatedData(this.options)},getResource:function(){var e=this;this.resource.loading=!0,this.resource.isPrestine=!1,axios.get(a.a.show(this.$route.params.id)).then((function(t){e.resource.data=t.data.data})).finally((function(){e.load(!1),e.resource.isPrestine=!0}))},getPaginatedData:function(){var e=this,t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;arguments.length>1&&void 0!==arguments[1]&&arguments[1];t=Object.assign(t||this.$route.query,{search:this.resources.search}),this.resources.loading=!0,axios.get(a.a.reports.list(this.$route.params.id),{params:t}).then((function(s){e.resources=Object.assign({},e.resources,s.data),e.resources.options=Object.assign(e.resources.options,s.data.meta,t),e.resources.loading=!1,e.$router.push({query:Object.assign({},e.$route.query,t)}).catch((function(e){}))})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){e.resources.data.map((function(e){return Object.assign(e,{loading:!1})}))}))},askUserToDestroyReport:function(e){var t=this;this.showDialog({color:"error",illustration:function(){return Promise.resolve().then(s.bind(null,17))},illustrationWidth:200,illustrationHeight:160,width:"420",title:"You are about to permanently delete the selected report.",text:["Some data related to report will still remain.",trans("Are you sure you want to permanently delete :name?",{name:e.key})],buttons:{cancel:{show:!0,color:"link"},action:{text:"Delete",color:"error",callback:function(s){t.loadDialog(!0),t.deleteResource(e)}}}})},deleteResource:function(e){var t=this;e.loading=!0,axios.delete(a.a.reports.delete(e.id)).then((function(s){e.active=!1,t.getPaginatedData(null),t.hideDialog(),t.showSnackbar({text:trans_choice("Report successfully deleted",1)})})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){e.active=!1,e.loading=!1}))},goToShowPage:function(e){return{name:"reports.show",params:{id:this.$route.params.id,report:e.id}}},goToSurveyPage:function(e){return{name:"companies.response",query:{month:e.remarks},params:{id:this.$route.params.id,taxonomy:e.value["current:index"].taxonomy.id||null,survey:e.value["survey:id"]}}},load:function(){var e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=e},search:_.debounce((function(e){this.resources.search=e.srcElement.value||"",this.tabletoolbar.isSearching=!1,this.resources.searching&&(this.getPaginatedData(this.options,"search"),this.resources.searching=!1)}),200),bulkTrashResource:function(){var e=this,t=this.selected;axios.delete(a.a.reports.destroy(null),{data:{id:t}}).then((function(t){e.getPaginatedData(null,"bulkTrashResource"),e.tabletoolbar.toggleTrash=!1,e.tabletoolbar.toggleBulkEdit=!1,e.hideDialog(),e.showSnackbar({text:trans_choice("Company successfully moved to trash",e.tabletoolbar.bulkCount)})})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})}))}}),mounted:function(){this.getResource(),this.getPaginatedData()},watch:{"resources.search":function(e){this.resources.searching=!0},"resources.selected":function(e){this.tabletoolbar.bulkCount=e.length},"tabletoolbar.toggleBulkEdit":function(e){e||(this.resources.selected=[])}}},k=s(262),y=s(597),w=s(5),x=s(588),S=Object(c.a)(b,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("admin",[s("metatag",{attrs:{title:e.resource.data.name}}),e._v(" "),s("page-header",{attrs:{back:{to:{name:"companies.show"},text:e.trans("Back")}},scopedSlots:e._u([{key:"title",fn:function(){return[e._v(e._s(e.resource.data.name))]},proxy:!0},{key:"utilities",fn:function(){return[s("h4",{staticClass:"muted--text",domProps:{textContent:e._s(e.trans("Reports List"))}})]},proxy:!0},{key:"action",fn:function(){return[e.allReportPresent?s("v-btn",{staticClass:"mr-3",attrs:{block:e.$vuetify.breakpoint.smAndDown,color:"primary",exact:"",large:"",text:""},on:{click:e.previewRatiosReport}},[s("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-table-eye")]),e._v("\n        "+e._s(e.__("Financial Analysis Report"))+"\n      ")],1):e._e(),e._v(" "),e.allReportPresent?s("v-btn",{attrs:{block:e.$vuetify.breakpoint.smAndDown,color:"primary",exact:"",large:""},on:{click:e.previewOverallReport}},[s("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-file-chart-outline")]),e._v("\n        "+e._s(e.__("Overall Report"))+"\n      ")],1):e._e()]},proxy:!0}])}),e._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:e.resourcesIsNotEmpty,expression:"resourcesIsNotEmpty"}]},[s("v-card",[s("toolbar-menu",{attrs:{items:e.tabletoolbar},on:{"update:items":function(t){e.tabletoolbar=t},"update:search":e.search},scopedSlots:e._u([{key:"filter",fn:function(){return[s("monthly-picker")]},proxy:!0}])}),e._v(" "),s("v-slide-y-reverse-transition",{attrs:{mode:"out-in"}},[s("v-data-table",{attrs:{headers:e.resources.headers,items:e.resources.data,loading:e.resources.loading,"mobile-breakpoint":NaN,options:e.resources.options,"server-items-length":e.resources.meta.total,"show-select":e.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id"},on:{"update:options":[function(t){return e.$set(e.resources,"options",t)},e.optionsChanged]},scopedSlots:e._u([{key:"progress",fn:function(){return[s("span")]},proxy:!0},{key:"loading",fn:function(){return[s("v-slide-y-transition",{attrs:{mode:"out-in"}},[s("div",e._l(e.resources.options.itemsPerPage,(function(e,t){return s("div",{key:t},[s("skeleton-table")],1)})),0)])]},proxy:!0},{key:"item.key",fn:function(t){var o=t.item;return[s("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(t){var a=t.on;return[s("span",e._g({staticClass:"mt-1"},a),[s("router-link",{staticClass:"text-no-wrap text--decoration-none",attrs:{tag:"a",exact:"",to:e.goToShowPage(o)},domProps:{textContent:e._s(o.key)}})],1)]}}],null,!0)},[e._v(" "),s("span",[e._v(e._s(e.trans("View Preview Report")))])])]}},{key:"item.created_at",fn:function(t){var o=t.item;return[s("span",{staticClass:"text-no-wrap",attrs:{title:o.created_at}},[e._v(e._s(e.trans(o.created)))])]}},{key:"item.user_id",fn:function(t){var o=t.item;return[s("span",{staticClass:"text-no-wrap",domProps:{textContent:e._s(o.author)}})]}},{key:"item.action",fn:function(t){var o=t.item;return[s("div",{staticClass:"text-no-wrap"},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(t){var a=t.on;return[s("span",e._g({},a),[s("send-individual-report-to-crm-button",{attrs:{item:o,user:o.user_id}})],1)]}}],null,!0)},[e._v(" "),s("span",[e._v(e._s(e.trans("Send"))+" "+e._s(o.key)+" "+e._s(e.__("to CRM")))])]),e._v(" "),s("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(t){var a=t.on;return[s("v-btn",e._g({attrs:{to:e.goToSurveyPage(o),icon:""}},a),[s("v-icon",{attrs:{small:""}},[e._v("mdi-file-table")])],1)]}}],null,!0)},[e._v(" "),s("span",[e._v(e._s(e.trans("View Survey")))])]),e._v(" "),s("can",{attrs:{code:"reports.delete"}},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(t){var a=t.on;return[s("v-btn",e._g({attrs:{icon:""},on:{click:function(t){return e.askUserToDestroyReport(o)}}},a),[s("v-icon",{attrs:{small:""}},[e._v("mdi-delete-outline")])],1)]}}],null,!0)},[e._v(" "),s("span",[e._v(e._s(e.trans("Delete report permanently")))])])],1)],1)]}}]),model:{value:e.resources.selected,callback:function(t){e.$set(e.resources,"selected",t)},expression:"resources.selected"}})],1)],1)],1),e._v(" "),e.resourcesIsEmpty?s("div",[s("toolbar-menu",{attrs:{items:e.tabletoolbar},on:{"update:items":function(t){e.tabletoolbar=t},"update:search":e.search},scopedSlots:e._u([{key:"filter",fn:function(){return[s("monthly-picker")]},proxy:!0}],null,!1,59150502)}),e._v(" "),s("empty-state",{scopedSlots:e._u([{key:"actions",fn:function(){return[s("v-btn",{attrs:{large:"",color:"primary",exact:"",to:{name:"companies.show"}}},[s("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-credit-card-outline")]),e._v("\n          "+e._s(e.trans("Back to Indices"))+"\n        ")],1)]},proxy:!0}],null,!1,2662262712)})],1):e._e()],1)}),[],!1,null,null,null);t.default=S.exports;u()(S,{VBtn:d.a,VCard:k.a,VDataTable:y.a,VIcon:h.a,VSlideYReverseTransition:w.i,VSlideYTransition:w.j,VTooltip:x.a})},38:function(e,t,s){"use strict";var o=s(12),a={props:["customer","user","type"],data:function(){return{isSending:!1,sendAll:!1,checklist:[{message:"",name:trans("Sending Overall Scores"),icon:"mdi-cube-send",status:"pending"},{message:"",name:trans("Sending Overall Document"),icon:"mdi-file-send",status:"pending"},{message:"",name:trans("Sending Financial Scores"),icon:"mdi-cube-send",status:"pending"},{message:"",name:trans("Sending Financial Document"),icon:"mdi-file-send",status:"pending"}],dialog:!1,sendBothScoresAndFile:!1,resource:{data:{}}}},computed:{isOverall:function(){return"overall"==this.type}},methods:{sendAllScoresAndDocuments:function(){this.dialog=!0,this.sendAll=!0,this.checklist=this.checklist.map((function(e){return Object.assign(e,{status:"pending",message:""})})),this.sendToCrm()},getReportData:function(){var e=this;return new Promise((function(t,s){var o=e.customer,a=e.user;axios.get("/api/v1/reports/overall/customer/".concat(o,"/user/").concat(a)).then((function(e){t(e)})).catch((function(e){s(e)}))}))},getElements:function(){console.log(this.resource.data);var e=this.resource.data.report.value||{},t={};if(this.isOverall)for(var s=_.map(e.indices,(function(e,t){return e.elements})),o=s.length-1;o>=0;o--){var a=s[o];t=Object.assign(t,a,{OverallScore:100*e["overall:score"],SustainabilityOverallScore:e.indices.BSPI["overall:total"]/100,FinancialOverallScore:e.indices.FMPI["overall:total"]/100,ProductivityOverallScore:e.indices.PMPI["overall:total"]/100,HROverallScore:e.indices.HRPI["overall:total"]/100})}else t=e["current:index"].elements;t=_.mapKeys(t,(function(e,t){return t.replace(/[^a-zA-Z]/g,"")})),t=_.mapKeys(t,(function(e,t){return t.replace(/\s+/g,"")})),(t=_.mapValues(t,(function(e,t){return 100*e}))).EmployeeEngagement=t.EmployeeEngagementCommunication||0,t.CareerManagement=t.CareerTalentManagement||0;var n=e["overall:enablers"].chart.data,r=e["overall:enablers"].chart.label;for(o=n.length-1;o>=0;o--){var i=n[o];t[r[o]]=i||0}return t.WorkflowProcesses=t["Workflow Processess"]||"",t},getOverallScore:function(){var e=this.resource.data.report.value["current:index"]["overall:total"],t="OverallScore";switch(this.resource.data.report.value["current:index"]["pindex:code"]){case"FMPI":t="Financial"+t;break;case"PMPI":t="Productivity"+t;break;case"HRPI":t="HR"+t;break;case"BSPI":t="Sustainability"+t}var s={};return s[t]=e,s},sendToCrm:function(){var e=this;this.isSending=!0,this.checklist[0].status="sending",this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(t){if(e.resource.data=t.data,!e.resource.data.customer)return e.$store.dispatch("snackbar/show",{text:"No report data found."}),!1;var s=Object.assign(e.getOverallScore(),e.getElements(),{Id:_.toUpper(e.resource.data.customer.token),FileNo:e.resource.data.customer.filenumber,Status:100000006,OverallScore:100*e.resource.data.report.value["overall:score"]||null,Comments:e.resource.data["overall:comment"]||"No comment",OverallComment:e.resource.data.report.value["overall:comment"]||null,"Lessons Learnt":e.resource.data.report.value["overall:comment"]||null});e.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),console.log("Sending overall scores...",s),axios.post("/api/v1/crm/customers/save",s).then((function(t){e.$store.dispatch("snackbar/hide"),e.checklist[0].status="done",1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):(e.checklist[0].status="error",e.checklist[0].message=t.data.Message),e.sendBothScoresAndFile})).catch((function(t){e.checklist[0].status="error",e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){e.isSending=!1,e.sendAll&&e.sendDocumentToCrm()}))})).catch((function(e){console.log("err",e)}))},sendDocumentToCrm:function(){var e=this;this.isSending=!0,this.checklist[1].status="sending",this.getReportData().then((function(t){e.resource.data=t.data;var s={Id:_.toUpper(e.resource.data.customer.token),FileName:"Overall Scores",FileContentBase64:e.resource.data["overall:report"]||"empty"};console.log("Sending overall document...",s),e.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Overall Report Document to CRM. Establishing connection to CRM..."}),axios.post(o.a.crm.sendDocument(),s).then((function(t){e.$store.dispatch("snackbar/hide"),e.checklist[1].status="done",1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):(e.checklist[1].status="error",e.checklist[1].message=t.data.Message)})).catch((function(t){e.checklist[1].status="error",e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){e.isSending=!1,e.sendAll&&e.sendFinancialScores()}))}))},sendBothDataToCrm:function(){this.sendBothScoresAndFile=!0,this.sendToCrm()},sendFinancialScores:function(){var e=this;this.checklist[2].status="sending",this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(t){if(e.resource.data=t.data,console.log(e.resource.data),!e.resource.data.customer)return e.$store.dispatch("snackbar/show",{text:"No report data found."}),!1;var s={FileNo:e.resource.data.customer.filenumber,YearofFinancial:e.resource.data.customer.metadata?e.resource.data.customer.metadata.years.Years.Year3:"No year was set",SubmissionDate:e.resource.data.profit_and_loss["Submission Date"]||e.resource.data.report.updated_at,Revenue:parseInt(e.resource.data.profit_and_loss.Revenue.Year3||0),CostofGoodsSold:parseInt(e.resource.data.profit_and_loss.CostOfGoodsSold.Year3||0),OtherExpenses:parseInt(e.resource.data.profit_and_loss.OtherExpenses.Year3||0),NonOperatingExpenses:parseInt(e.resource.data.profit_and_loss.OtherExpenses["Non-Operating expenses (NOE)"].Year3||0),OperatingLossProfit:parseInt(e.resource.data.profit_and_loss.OtherExpenses["Operating (loss)/profit"].Year3||0),Depreciation:parseInt(e.resource.data.profit_and_loss.OtherExpenses.Depreciation.Year3||0),Taxes:parseInt(e.resource.data.profit_and_loss.OtherExpenses.Taxes.Year3||0),NetLossProfits:parseInt(e.resource.data.profit_and_loss.NetProfit.Year3||0),FixedAssets:parseInt(e.resource.data.profit_and_loss.FixedAssets["Fixed Assets"].Year3||0),TotalLiabilities:parseInt(e.resource.data.profit_and_loss.FixedAssets["Total Liabilities"].Year3||0),StockholdersEquity:parseInt(e.resource.data.profit_and_loss.FixedAssets["Stockholders' Equity"].Year3||0),Marketing:parseInt(e.resource.data.profit_and_loss.Marketing.Year3||0),Rent:parseInt(e.resource.data.profit_and_loss.Rent.Year3||0),Salaries:parseInt(e.resource.data.profit_and_loss.Salaries.Year3||0),LicensingFees:parseInt(e.resource.data.profit_and_loss["Licensing Fees"].Year3||0),VisaEmploymentFees:parseInt(e.resource.data.profit_and_loss["Visa / Employment Fees"].Year3||0)};console.log("Sending financial scores...",s),e.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),axios.post(o.a.crm.sendFinancial(),s).then((function(t){e.$store.dispatch("snackbar/hide"),e.checklist[2].status="done",1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):(e.checklist[2].status="error",e.checklist[2].message=t.data.Message)})).catch((function(t){e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")}),e.checklist[2].status="error"})).finally((function(){e.sendAll&&e.sendFinancialDocument()}))})).catch((function(e){console.log("err",e)}))},sendFinancialDocument:function(){var e=this;this.checklist[3].status="sending",this.getReportData().then((function(t){e.resource.data=t.data,console.log(e);var s={Id:_.toUpper(e.resource.data.customer.token),FileName:"Financial Ratios",FileContentBase64:e.resource.data["report:financial"]||"empty"};console.log("Sending financial document...",s),e.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Financial Report Document to CRM. Establishing connection..."}),axios.post(o.a.crm.sendDocument(),s).then((function(t){console.log("data",t.data),e.$store.dispatch("snackbar/hide"),e.checklist[3].status="done",1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):(e.checklist[3].status="error",e.checklist[3].message=t.data.Message)})).catch((function(t){e.checklist[3].status="error",e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){}))}))}}},n=s(0),r=s(2),i=s.n(r),c=s(104),l=s(262),u=s(1),d=s(584),h=s(91),p=s(266),m=s(106),g=s(267),v=s(14),f=s(261),b=s(583),k=Object(n.a)(a,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return e.isOverall?s("div",[s("v-btn",{attrs:{loading:e.isSending,disabled:e.isSending,large:"",block:e.$vuetify.breakpoint.smAndDown,color:"primary"},on:{click:e.sendAllScoresAndDocuments}},[s("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-send")]),e._v("\n    "+e._s(e.trans("Send to CRM"))+"\n  ")],1),e._v(" "),s("v-dialog",{attrs:{"max-width":"420",persistent:""},model:{value:e.dialog,callback:function(t){e.dialog=t},expression:"dialog"}},[s("v-card",[s("v-list",e._l(e.checklist,(function(t,o){return s("v-list-item",{key:o,attrs:{title:t.message}},[s("v-list-item-content",[s("v-list-item-title",{domProps:{textContent:e._s(t.name)}})],1),e._v(" "),s("v-list-item-action",["pending"==t.status?s("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-checkbox-blank-circle-outline")]):"sending"==t.status?s("v-progress-circular",{attrs:{indeterminate:"",width:"2",size:"12"}}):"done"==t.status?s("v-icon",{attrs:{small:"",left:"",color:"success"}},[e._v("mdi-check")]):"error"==t.status?s("div",[s("v-icon",{attrs:{small:"",left:"",color:"error"}},[e._v("mdi-alert-circle")])],1):e._e()],1)],1)})),1),e._v(" "),s("v-card-actions",[s("v-spacer"),e._v(" "),s("v-btn",{attrs:{depressed:""},on:{click:function(t){e.dialog=!1}}},[e._v("Close")])],1)],1)],1)],1):s("v-btn",{attrs:{icon:""},on:{click:e.sendToCrm}},[s("v-icon",{attrs:{small:""}},[e._v("mdi-send")])],1)}),[],!1,null,null,null);t.a=k.exports;i()(k,{VBtn:c.a,VCard:l.a,VCardActions:u.a,VDialog:d.a,VIcon:h.a,VList:p.a,VListItem:m.a,VListItemAction:g.a,VListItemContent:v.a,VListItemTitle:v.b,VProgressCircular:f.a,VSpacer:b.a})}}]);
//# sourceMappingURL=42.js.map