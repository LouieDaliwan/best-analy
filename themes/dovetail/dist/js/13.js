(window.webpackJsonp=window.webpackJsonp||[]).push([[13],{12:function(t,e,s){"use strict";e.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(t)},overall:function(t,e){return"/api/v1/reports/overall/customer/".concat(t,"/user/").concat(e)},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(t){return"/api/v1/surveys/".concat(t,"/submit")},show:function(t){return"/api/v1/surveys/".concat(t)}},crm:{search:function(t){return"/api/v1/crm/customers/search/".concat(t)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"},sendDocument:function(){return"/api/v1/crm/report/send"},sendFinancial:function(){return"/api/v1/crm/financial/send"}},reports:{list:function(t){return"/api/v1/customers/".concat(t,"/reports")},generate:function(t){return"/api/v1/reports/".concat(t,"/generate")},download:function(t){return"/api/v1/reports/".concat(t,"/download")},delete:function(t){return"/api/v1/reports/".concat(t)}}}},307:function(t,e,s){"use strict";s.r(e);var o=s(12),n=s(17),a=s(38),r=s(6);function i(t,e){var s=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),s.push.apply(s,o)}return s}function c(t,e,s){return e in t?Object.defineProperty(t,e,{value:s,enumerable:!0,configurable:!0,writable:!0}):t[e]=s,t}var l={components:{SendReportToCrmButton:a.a},computed:{resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},options:function(){return{per_page:this.resources.options.itemsPerPage,page:this.resources.options.page,sort:this.resources.options.sortBy[0]||void 0,order:this.resources.options.sortDesc[0]?"desc":"asc"}},selected:function(){return this.resources.selected.map((function(t){return t.id}))}},data:function(){return{api:o.a,resources:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},meta:{},modes:{bulkedit:!1},selected:[],headers:[{text:trans("Company Name"),align:"left",value:"name",class:"text-no-wrap"},{text:trans("File No."),align:"left",value:"filenumber",class:"text-no-wrap"},{text:trans("Business Counselor"),align:"left",value:"counselor",class:"text-no-wrap"},{text:trans("Peer BC"),align:"left",value:"author",class:"text-no-wrap"},{text:trans("Last Modified"),value:"updated_at",class:"text-no-wrap"},{text:trans("Actions"),align:"center",value:"action",sortable:!1,class:"muted--text text-no-wrap"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1}}},methods:function(t){for(var e=1;e<arguments.length;e++){var s=null!=arguments[e]?arguments[e]:{};e%2?i(Object(s),!0).forEach((function(e){c(t,e,s[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(s)):i(Object(s)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(s,e))}))}return t}({},Object(r.b)({errorDialog:"dialog/error",loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show"}),{changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.resources.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(t){this.getPaginatedData(this.options)},getPaginatedData:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;arguments.length>1&&void 0!==arguments[1]&&arguments[1];e=Object.assign(e||this.$route.query,{search:this.resources.search}),this.resources.loading=!0,axios.get(this.api.list(),{params:e}).then((function(s){t.resources=Object.assign({},t.resources,s.data),t.resources.options=Object.assign(t.resources.options,s.data.meta,e),t.resources.loading=!1,t.$router.push({query:Object.assign({},t.$route.query,e)}).catch((function(t){}))})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){t.resources.data.map((function(t){return Object.assign(t,{loading:!1})}))}))},search:_.debounce((function(t){this.resources.search=t.srcElement.value||"",this.tabletoolbar.isSearching=!1,this.resources.searching&&(this.getPaginatedData(this.options,"search"),this.resources.searching=!1)}),200),goToShowIndexPage:function(t){return{name:"companies.show",params:{id:t.id},query:{from:this.$route.fullPath}}},focusSearchBar:function(){this.$refs.tablesearch.focus()},sendToCrm:function(t){var e={Id:this.resources.data.token,FileNo:this.resources.data.filenumber,OverallScore:t.value["overall:score"],FileContentBase64:t.fileContentBase64,"Lessons Learnt":t.value["overall:comment"]};axios.post(o.a.crm.save(),e).then((function(t){console.log(t)}))},bulkTrashResource:function(){var t=this,e=this.selected;axios.delete(o.a.destroy(null),{data:{id:e}}).then((function(e){t.getPaginatedData(null,"bulkTrashResource"),t.tabletoolbar.toggleTrash=!1,t.tabletoolbar.toggleBulkEdit=!1,t.hideDialog(),t.showSnackbar({text:trans_choice("Company successfully moved to trash",t.tabletoolbar.bulkCount)})})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})}))},askUserToDestroyCompany:function(t){var e=this;this.showDialog({color:"warning",illustration:n.default,illustrationWidth:200,illustrationHeight:160,width:"420",title:"You are about to move to trash the selected company.",text:["Some data related to company will still remain.",trans("Are you sure you want to move :name to Trash?",{name:t.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:"Move to Trash",color:"warning",callback:function(s){e.loadDialog(!0),e.destroyResource(t)}}}})},destroyResource:function(t){var e=this;t.loading=!0,axios.delete(o.a.destroy(t.id)).then((function(s){t.active=!1,e.getPaginatedData(null,"destroyResource"),e.showSnackbar({text:trans_choice("Company successfully moved to trash",1)}),e.hideDialog()})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){t.active=!1,t.loading=!1}))}}),mounted:function(){this.changeOptionsFromRouterQueries()},watch:{"resources.search":function(t){this.resources.searching=!0},"resources.selected":function(t){this.tabletoolbar.bulkCount=t.length},"tabletoolbar.toggleBulkEdit":function(t){t||(this.resources.selected=[])}}},u=s(0),d=s(2),p=s.n(d),m=s(104),h=s(262),v=s(597),f=s(91),g=s(5),b=s(588),k=Object(u.a)(l,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("admin",[s("metatag",{attrs:{title:t.trans("All Company")}}),t._v(" "),s("page-header",{scopedSlots:t._u([{key:"utilities",fn:function(){return[s("can",{attrs:{code:"customers.trashed"}},[s("router-link",{staticClass:"dt-link text--decoration-none mr-4",attrs:{tag:"a",exact:"",to:{name:"companies.trashed"}}},[s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-delete-outline")]),t._v("\n          "+t._s(t.trans("Trashed Company"))+"\n        ")],1)],1)]},proxy:!0},{key:"action",fn:function(){return[s("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,large:"",color:"primary",exact:"",to:{name:"companies.find"}}},[s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-file-document-box-search-outline")]),t._v("\n        "+t._s(t.trans("Find Company"))+"\n      ")],1)]},proxy:!0}])}),t._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:t.resourcesIsNotEmpty,expression:"resourcesIsNotEmpty"}]},[s("v-card",[s("toolbar-menu",{attrs:{items:t.tabletoolbar,bulk:"",downloadable:"",trashable:""},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search,"update:trash":t.bulkTrashResource}}),t._v(" "),s("v-slide-y-reverse-transition",{attrs:{mode:"out-in"}},[s("v-data-table",{attrs:{headers:t.resources.headers,items:t.resources.data,loading:t.resources.loading,"mobile-breakpoint":NaN,options:t.resources.options,"server-items-length":t.resources.meta.total,"show-select":t.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id"},on:{"update:options":[function(e){return t.$set(t.resources,"options",e)},t.optionsChanged]},scopedSlots:t._u([{key:"progress",fn:function(){return[s("span")]},proxy:!0},{key:"loading",fn:function(){return[s("v-slide-y-transition",{attrs:{mode:"out-in"}},[s("div",t._l(t.resources.options.itemsPerPage,(function(t,e){return s("div",{key:e},[s("skeleton-table")],1)})),0)])]},proxy:!0},{key:"item.name",fn:function(e){var o=e.item;return[s("can",{attrs:{code:"customers.edit"},scopedSlots:t._u([{key:"unpermitted",fn:function(){return[s("span",{domProps:{textContent:t._s(o.name)}})]},proxy:!0}],null,!0)},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var n=e.on;return[s("span",t._g({staticClass:"mt-1"},n),[s("router-link",{staticClass:"text-no-wrap text--decoration-none",attrs:{tag:"a",exact:"",to:{name:"companies.edit",params:{id:o.id}}},domProps:{textContent:t._s(o.name)}})],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("Edit Company Information")))])])],1)]}},{key:"item.filenumber",fn:function(e){var o=e.item;return[s("span",{staticClass:"text-no-wrap",domProps:{textContent:t._s(o.filenumber)}})]}},{key:"item.counselor",fn:function(e){var o=e.item;return[s("span",{staticClass:"text-no-wrap",domProps:{textContent:t._s(o.counselor)}})]}},{key:"item.updated_at",fn:function(e){var o=e.item;return[s("span",{staticClass:"text-no-wrap",attrs:{title:o.updated_at}},[t._v(t._s(t.trans(o.modified)))])]}},{key:"item.action",fn:function(e){var o=e.item;return[s("div",{staticClass:"text-no-wrap"},[s("can",{attrs:{code:"customers.survey"}},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var n=e.on;return[s("v-btn",t._g({attrs:{to:t.goToShowIndexPage(o),icon:""}},n),[s("v-icon",{attrs:{small:""}},[t._v("mdi-view-grid-outline")])],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("Answer Survey")))])])],1),t._v(" "),s("can",{attrs:{code:"customers.edit"}},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var n=e.on;return[s("v-btn",t._g({attrs:{to:{name:"companies.edit",params:{id:o.id},query:{tab:1}},icon:""}},n),[s("v-icon",{attrs:{small:""}},[t._v("mdi-pencil-outline")])],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("Edit Financial Statements")))])])],1),t._v(" "),s("can",{attrs:{code:"customers.survey"}},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var n=e.on;return[s("v-btn",t._g({attrs:{to:{name:"companies.reports",params:{id:o.id}},icon:""}},n),[s("v-icon",{attrs:{small:""}},[t._v("mdi-file-chart-outline")])],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("View Reports")))])])],1),t._v(" "),s("can",{attrs:{code:"customers.survey"}},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var n=e.on;return[s("span",t._g({},n),[s("send-report-to-crm-button",{attrs:{customer:o.id,user:o.user_id}})],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("Send All Reports for this month to CRM")))])])],1),t._v(" "),s("can",{attrs:{code:"customers.destroy"}},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var n=e.on;return[s("v-btn",t._g({attrs:{icon:""},on:{click:function(e){return t.askUserToDestroyCompany(o)}}},n),[s("v-icon",{attrs:{small:""}},[t._v("mdi-delete-outline")])],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("Move to trash")))])])],1)],1)]}}]),model:{value:t.resources.selected,callback:function(e){t.$set(t.resources,"selected",e)},expression:"resources.selected"}})],1)],1)],1),t._v(" "),t.resourcesIsEmpty?s("div",[s("toolbar-menu",{attrs:{items:t.tabletoolbar},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search}}),t._v(" "),s("empty-state")],1):t._e()],1)}),[],!1,null,null,null);e.default=k.exports;p()(k,{VBtn:m.a,VCard:h.a,VDataTable:v.a,VIcon:f.a,VSlideYReverseTransition:g.i,VSlideYTransition:g.j,VTooltip:b.a})},38:function(t,e,s){"use strict";var o=s(12),n={props:["customer","user","type"],data:function(){return{isSending:!1,sendAll:!1,checklist:[{message:"",name:trans("Sending Overall Scores"),icon:"mdi-cube-send",status:"pending"},{message:"",name:trans("Sending Overall Document"),icon:"mdi-file-send",status:"pending"},{message:"",name:trans("Sending Financial Scores"),icon:"mdi-cube-send",status:"pending"},{message:"",name:trans("Sending Financial Document"),icon:"mdi-file-send",status:"pending"}],dialog:!1,sendBothScoresAndFile:!1,resource:{data:{}}}},computed:{isOverall:function(){return"overall"==this.type}},methods:{sendAllScoresAndDocuments:function(){this.dialog=!0,this.sendAll=!0,this.checklist=this.checklist.map((function(t){return Object.assign(t,{status:"pending",message:""})})),this.sendToCrm()},getReportData:function(){var t=this;return new Promise((function(e,s){var o=t.customer,n=t.user;axios.get("/api/v1/reports/overall/customer/".concat(o,"/user/").concat(n),{params:month}).then((function(t){e(t)})).catch((function(t){s(t)}))}))},getElements:function(){console.log(this.resource.data);var t=this.resource.data.report.value||{},e={};if(this.isOverall)for(var s=_.map(t.indices,(function(t,e){return t.elements})),o=s.length-1;o>=0;o--){var n=s[o];e=Object.assign(e,n,{OverallScore:100*t["overall:score"],SustainabilityOverallScore:t.indices.BSPI["overall:total"]/100,FinancialOverallScore:t.indices.FMPI["overall:total"]/100,ProductivityOverallScore:t.indices.PMPI["overall:total"]/100,HROverallScore:t.indices.HRPI["overall:total"]/100})}else e=t["current:index"].elements;e=_.mapKeys(e,(function(t,e){return e.replace(/[^a-zA-Z]/g,"")})),e=_.mapKeys(e,(function(t,e){return e.replace(/\s+/g,"")})),(e=_.mapValues(e,(function(t,e){return 100*t}))).EmployeeEngagement=e.EmployeeEngagementCommunication||0,e.CareerManagement=e.CareerTalentManagement||0;var a=t["overall:enablers"].chart.data,r=t["overall:enablers"].chart.label;for(o=a.length-1;o>=0;o--){var i=a[o];e[r[o]]=i||0}return e.WorkflowProcesses=e["Workflow Processess"]||"",e},getOverallScore:function(){var t=this.resource.data.report.value["current:index"]["overall:total"],e="OverallScore";switch(this.resource.data.report.value["current:index"]["pindex:code"]){case"FMPI":e="Financial"+e;break;case"PMPI":e="Productivity"+e;break;case"HRPI":e="HR"+e;break;case"BSPI":e="Sustainability"+e}var s={};return s[e]=t,s},sendToCrm:function(){var t=this;this.isSending=!0,this.checklist[0].status="sending",this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(e){if(t.resource.data=e.data,!t.resource.data.customer)return t.$store.dispatch("snackbar/show",{text:"No report data found."}),!1;var s=Object.assign(t.getOverallScore(),t.getElements(),{Id:_.toUpper(t.resource.data.customer.token),FileNo:t.resource.data.customer.filenumber,Status:100000006,OverallScore:100*t.resource.data.report.value["overall:score"]||null,Comments:t.resource.data["overall:comment"]||"No comment",OverallComment:t.resource.data.report.value["overall:comment"]||null,"Lessons Learnt":t.resource.data.report.value["overall:comment"]||null});t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),console.log("Sending overall scores...",s),axios.post("/api/v1/crm/customers/save",s).then((function(e){t.$store.dispatch("snackbar/hide"),t.checklist[0].status="done",1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):(t.checklist[0].status="error",t.checklist[0].message=e.data.Message),t.sendBothScoresAndFile})).catch((function(e){t.checklist[0].status="error",t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){t.isSending=!1,t.sendAll&&t.sendDocumentToCrm()}))})).catch((function(t){console.log("err",t)}))},sendDocumentToCrm:function(){var t=this;this.isSending=!0,this.checklist[1].status="sending",this.getReportData().then((function(e){t.resource.data=e.data;var s={Id:_.toUpper(t.resource.data.customer.token),FileName:"Overall Scores",FileContentBase64:t.resource.data["overall:report"]||"empty"};console.log("Sending overall document...",s),t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Overall Report Document to CRM. Establishing connection to CRM..."}),axios.post(o.a.crm.sendDocument(),s).then((function(e){t.$store.dispatch("snackbar/hide"),t.checklist[1].status="done",1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):(t.checklist[1].status="error",t.checklist[1].message=e.data.Message)})).catch((function(e){t.checklist[1].status="error",t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){t.isSending=!1,t.sendAll&&t.sendFinancialScores()}))}))},sendBothDataToCrm:function(){this.sendBothScoresAndFile=!0,this.sendToCrm()},sendFinancialScores:function(){var t=this;this.checklist[2].status="sending",this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(e){if(t.resource.data=e.data,console.log(t.resource.data),!t.resource.data.customer)return t.$store.dispatch("snackbar/show",{text:"No report data found."}),!1;var s={FileNo:t.resource.data.customer.filenumber,YearofFinancial:t.resource.data.customer.metadata?t.resource.data.customer.metadata.years.Years.Year3:"No year was set",SubmissionDate:t.resource.data.profit_and_loss["Submission Date"]||t.resource.data.report.updated_at,Revenue:parseInt(t.resource.data.profit_and_loss.Revenue.Year3||0),CostofGoodsSold:parseInt(t.resource.data.profit_and_loss.CostOfGoodsSold.Year3||0),OtherExpenses:parseInt(t.resource.data.profit_and_loss.OtherExpenses.Year3||0),NonOperatingExpenses:parseInt(t.resource.data.profit_and_loss.OtherExpenses["Non-Operating expenses (NOE)"].Year3||0),OperatingLossProfit:parseInt(t.resource.data.profit_and_loss.OtherExpenses["Operating (loss)/profit"].Year3||0),Depreciation:parseInt(t.resource.data.profit_and_loss.OtherExpenses.Depreciation.Year3||0),Taxes:parseInt(t.resource.data.profit_and_loss.OtherExpenses.Taxes.Year3||0),NetLossProfits:parseInt(t.resource.data.profit_and_loss.NetProfit.Year3||0),FixedAssets:parseInt(t.resource.data.profit_and_loss.FixedAssets["Fixed Assets"].Year3||0),TotalLiabilities:parseInt(t.resource.data.profit_and_loss.FixedAssets["Total Liabilities"].Year3||0),StockholdersEquity:parseInt(t.resource.data.profit_and_loss.FixedAssets["Stockholders' Equity"].Year3||0),Marketing:parseInt(t.resource.data.profit_and_loss.Marketing.Year3||0),Rent:parseInt(t.resource.data.profit_and_loss.Rent.Year3||0),Salaries:parseInt(t.resource.data.profit_and_loss.Salaries.Year3||0),LicensingFees:parseInt(t.resource.data.profit_and_loss["Licensing Fees"].Year3||0),VisaEmploymentFees:parseInt(t.resource.data.profit_and_loss["Visa / Employment Fees"].Year3||0)};console.log("Sending financial scores...",s),t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),axios.post(o.a.crm.sendFinancial(),s).then((function(e){t.$store.dispatch("snackbar/hide"),t.checklist[2].status="done",1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):(t.checklist[2].status="error",t.checklist[2].message=e.data.Message)})).catch((function(e){t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")}),t.checklist[2].status="error"})).finally((function(){t.sendAll&&t.sendFinancialDocument()}))})).catch((function(t){console.log("err",t)}))},sendFinancialDocument:function(){var t=this;this.checklist[3].status="sending",this.getReportData().then((function(e){t.resource.data=e.data,console.log(t);var s={Id:_.toUpper(t.resource.data.customer.token),FileName:"Financial Ratios",FileContentBase64:t.resource.data["report:financial"]||"empty"};console.log("Sending financial document...",s),t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Financial Report Document to CRM. Establishing connection..."}),axios.post(o.a.crm.sendDocument(),s).then((function(e){console.log("data",e.data),t.$store.dispatch("snackbar/hide"),t.checklist[3].status="done",1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):(t.checklist[3].status="error",t.checklist[3].message=e.data.Message)})).catch((function(e){t.checklist[3].status="error",t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){}))}))}}},a=s(0),r=s(2),i=s.n(r),c=s(104),l=s(262),u=s(1),d=s(584),p=s(91),m=s(266),h=s(106),v=s(267),f=s(14),g=s(261),b=s(583),k=Object(a.a)(n,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return t.isOverall?s("div",[s("v-btn",{attrs:{loading:t.isSending,disabled:t.isSending,large:"",block:t.$vuetify.breakpoint.smAndDown,color:"primary"},on:{click:t.sendAllScoresAndDocuments}},[s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-send")]),t._v("\n    "+t._s(t.trans("Send to CRM"))+"\n  ")],1),t._v(" "),s("v-dialog",{attrs:{"max-width":"420",persistent:""},model:{value:t.dialog,callback:function(e){t.dialog=e},expression:"dialog"}},[s("v-card",[s("v-list",t._l(t.checklist,(function(e,o){return s("v-list-item",{key:o,attrs:{title:e.message}},[s("v-list-item-content",[s("v-list-item-title",{domProps:{textContent:t._s(e.name)}})],1),t._v(" "),s("v-list-item-action",["pending"==e.status?s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-checkbox-blank-circle-outline")]):"sending"==e.status?s("v-progress-circular",{attrs:{indeterminate:"",width:"2",size:"12"}}):"done"==e.status?s("v-icon",{attrs:{small:"",left:"",color:"success"}},[t._v("mdi-check")]):"error"==e.status?s("div",[s("v-icon",{attrs:{small:"",left:"",color:"error"}},[t._v("mdi-alert-circle")])],1):t._e()],1)],1)})),1),t._v(" "),s("v-card-actions",[s("v-spacer"),t._v(" "),s("v-btn",{attrs:{depressed:""},on:{click:function(e){t.dialog=!1}}},[t._v("Close")])],1)],1)],1)],1):s("v-btn",{attrs:{icon:""},on:{click:t.sendToCrm}},[s("v-icon",{attrs:{small:""}},[t._v("mdi-send")])],1)}),[],!1,null,null,null);e.a=k.exports;i()(k,{VBtn:c.a,VCard:l.a,VCardActions:u.a,VDialog:d.a,VIcon:p.a,VList:m.a,VListItem:h.a,VListItemAction:v.a,VListItemContent:f.a,VListItemTitle:f.b,VProgressCircular:g.a,VSpacer:b.a})}}]);
//# sourceMappingURL=13.js.map