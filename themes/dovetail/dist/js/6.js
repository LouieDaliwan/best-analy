(window.webpackJsonp=window.webpackJsonp||[]).push([[6],{13:function(e,t,r){"use strict";t.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},restore:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(e)},update:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},delete:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(e)},overall:function(e,t){return"/api/v1/reports/overall/customer/".concat(e,"/user/").concat(t)},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(e){return"/api/v1/surveys/".concat(e,"/submit")},show:function(e){return"/api/v1/surveys/".concat(e)}},crm:{search:function(e){return"/api/v1/crm/customers/search/".concat(e)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"},sendDocument:function(){return"/api/v1/crm/report/send"},sendFinancial:function(){return"/api/v1/crm/financial/send"}},reports:{list:function(e){return"/api/v1/customers/".concat(e,"/reports")},generate:function(e){return"/api/v1/reports/".concat(e,"/generate")},download:function(e){return"/api/v1/reports/".concat(e,"/download")},delete:function(e){return"/api/v1/reports/".concat(e)}}}},308:function(e,t,r){"use strict";r.r(t);var a=r(9),o=r(13),n=r(52),s=r(40),i=r(6);function c(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,a)}return r}function l(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}var u={components:{SendReportToCrmButton:s.a},computed:{resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},allReportPresent:function(){return 4==this.resources.data.length}},data:function(){return{resource:new n.a,resources:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},meta:{},modes:{bulkedit:!1},selected:[],headers:[{text:trans("Report Type"),align:"left",value:"key",class:"text-no-wrap"},{text:trans("Generated By"),align:"left",value:"user_id",class:"text-no-wrap"},{text:trans("Site Visit Date"),align:"center",value:"remarked",class:"text-no-wrap"},{text:trans("Actions"),align:"center",value:"action",sortable:!1,class:"muted--text text-no-wrap"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1}}},methods:function(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?c(Object(r),!0).forEach((function(t){l(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):c(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}({},Object(i.b)({errorDialog:"dialog/error",loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show"}),{previewPDFReport:function(e){window.open("/best/reports/pdf/preview?report_id=".concat(e.id,"&type=index"),"_blank")},previewRatiosReport:function(){this.$router.push({name:"reports.ratios",query:{type:"ratios",user_id:a.default.getId()},params:{id:this.$route.params.id}})},previewOverallReport:function(){this.$router.push({name:"reports.overall",query:{type:"overall",user_id:a.default.getId()},params:{id:this.$route.params.id}})},changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.resources.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(e){this.getPaginatedData(this.options)},getResource:function(){var e=this;this.resource.loading=!0,this.resource.isPrestine=!1,axios.get(o.a.show(this.$route.params.id)).then((function(t){e.resource.data=t.data.data})).finally((function(){e.load(!1),e.resource.isPrestine=!0}))},getPaginatedData:function(){var e=this,t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;arguments.length>1&&void 0!==arguments[1]&&arguments[1];t=Object.assign(t||this.$route.query,{search:this.resources.search}),this.resources.loading=!0,axios.get(o.a.reports.list(this.$route.params.id),{params:t}).then((function(r){e.resources=Object.assign({},e.resources,r.data),e.resources.options=Object.assign(e.resources.options,r.data.meta,t),e.resources.loading=!1,e.$router.push({query:Object.assign({},e.$route.query,t)}).catch((function(e){}))})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){e.resources.data.map((function(e){return Object.assign(e,{loading:!1})}))}))},askUserToDestroyReport:function(e){var t=this;this.showDialog({color:"error",illustration:function(){return Promise.resolve().then(r.bind(null,18))},illustrationWidth:200,illustrationHeight:160,width:"420",title:"You are about to permanently delete the selected report.",text:["Some data related to report will still remain.",trans("Are you sure you want to permanently delete :name?",{name:e.key})],buttons:{cancel:{show:!0,color:"link"},action:{text:"Delete",color:"error",callback:function(r){t.loadDialog(!0),t.deleteResource(e)}}}})},deleteResource:function(e){var t=this;e.loading=!0,axios.delete(o.a.reports.delete(e.id)).then((function(r){e.active=!1,t.getPaginatedData(null),t.hideDialog(),t.showSnackbar({text:trans_choice("Report successfully deleted",1)})})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){e.active=!1,e.loading=!1}))},goToShowPage:function(e){return{name:"reports.show",params:{id:this.$route.params.id,report:e.id}}},goToSurveyPage:function(e){return{name:"companies.response",query:{month:e.remarks},params:{id:this.$route.params.id,taxonomy:e.value["current:index"].taxonomy.id||null,survey:e.value["survey:id"]}}},load:function(){var e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=e},search:_.debounce((function(e){this.resources.search=e.srcElement.value||"",this.tabletoolbar.isSearching=!1,this.resources.searching&&(this.getPaginatedData(this.options,"search"),this.resources.searching=!1)}),200),bulkTrashResource:function(){var e=this,t=this.selected;axios.delete(o.a.reports.destroy(null),{data:{id:t}}).then((function(t){e.getPaginatedData(null,"bulkTrashResource"),e.tabletoolbar.toggleTrash=!1,e.tabletoolbar.toggleBulkEdit=!1,e.hideDialog(),e.showSnackbar({text:trans_choice("Company successfully moved to trash",e.tabletoolbar.bulkCount)})})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})}))}}),mounted:function(){this.getResource(),this.getPaginatedData()},watch:{"resources.search":function(e){this.resources.searching=!0},"resources.selected":function(e){this.tabletoolbar.bulkCount=e.length},"tabletoolbar.toggleBulkEdit":function(e){e||(this.resources.selected=[])}}},d=r(0),p=r(2),Y=r.n(p),h=r(109),m=r(271),v=r(604),g=r(93),f=r(4),b=r(595),y=Object(d.a)(u,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("admin",[r("metatag",{attrs:{title:e.resource.data.name}}),e._v(" "),r("page-header",{attrs:{back:{to:{name:"companies.show"},text:e.trans("Back")}},scopedSlots:e._u([{key:"title",fn:function(){return[e._v(e._s(e.resource.data.name))]},proxy:!0},{key:"utilities",fn:function(){return[r("h4",{staticClass:"muted--text",domProps:{textContent:e._s(e.trans("Reports List"))}})]},proxy:!0},{key:"action",fn:function(){return[e.allReportPresent?r("v-btn",{staticClass:"mr-3",attrs:{block:e.$vuetify.breakpoint.smAndDown,color:"primary",exact:"",large:"",text:""},on:{click:e.previewRatiosReport}},[r("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-table-eye")]),e._v("\n        "+e._s(e.__("Financial Analysis Report"))+"\n      ")],1):e._e(),e._v(" "),e.allReportPresent?r("v-btn",{attrs:{block:e.$vuetify.breakpoint.smAndDown,color:"primary",exact:"",large:""},on:{click:e.previewOverallReport}},[r("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-file-chart-outline")]),e._v("\n        "+e._s(e.__("Overall Report"))+"\n      ")],1):e._e()]},proxy:!0}])}),e._v(" "),r("div",{directives:[{name:"show",rawName:"v-show",value:e.resourcesIsNotEmpty,expression:"resourcesIsNotEmpty"}]},[r("v-card",[r("toolbar-menu",{attrs:{items:e.tabletoolbar},on:{"update:items":function(t){e.tabletoolbar=t},"update:search":e.search},scopedSlots:e._u([{key:"filter",fn:function(){return[r("monthly-picker")]},proxy:!0}])}),e._v(" "),r("v-slide-y-reverse-transition",{attrs:{mode:"out-in"}},[r("v-data-table",{attrs:{headers:e.resources.headers,items:e.resources.data,loading:e.resources.loading,"mobile-breakpoint":NaN,options:e.resources.options,"server-items-length":e.resources.meta.total,"show-select":e.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id"},on:{"update:options":[function(t){return e.$set(e.resources,"options",t)},e.optionsChanged]},scopedSlots:e._u([{key:"progress",fn:function(){return[r("span")]},proxy:!0},{key:"loading",fn:function(){return[r("v-slide-y-transition",{attrs:{mode:"out-in"}},[r("div",e._l(e.resources.options.itemsPerPage,(function(e,t){return r("div",{key:t},[r("skeleton-table")],1)})),0)])]},proxy:!0},{key:"item.key",fn:function(t){var a=t.item;return[r("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(t){var o=t.on;return[r("span",e._g({staticClass:"mt-1"},o),[r("router-link",{staticClass:"text-no-wrap text--decoration-none",attrs:{tag:"a",exact:"",to:e.goToShowPage(a)},domProps:{textContent:e._s(a.key)}})],1)]}}],null,!0)},[e._v(" "),r("span",[e._v(e._s(e.trans("View Preview Report")))])])]}},{key:"item.created_at",fn:function(t){var a=t.item;return[r("span",{staticClass:"text-no-wrap",attrs:{title:a.created_at}},[e._v(e._s(e.trans(a.created)))])]}},{key:"item.user_id",fn:function(t){var a=t.item;return[r("span",{staticClass:"text-no-wrap",domProps:{textContent:e._s(a.author)}})]}},{key:"item.action",fn:function(t){var a=t.item;return[r("div",{staticClass:"text-no-wrap"},[r("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(t){var o=t.on;return[r("span",e._g({},o),[r("send-report-to-crm-button",{attrs:{customer:a.customer.id,user:a.user_id}})],1)]}}],null,!0)},[e._v(" "),r("span",[e._v(e._s(e.trans("Send"))+" "+e._s(a.key)+" "+e._s(e.__("to CRM")))])]),e._v(" "),r("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(t){var o=t.on;return[r("v-btn",e._g({attrs:{to:e.goToSurveyPage(a),icon:""}},o),[r("v-icon",{attrs:{small:""}},[e._v("mdi-file-table")])],1)]}}],null,!0)},[e._v(" "),r("span",[e._v(e._s(e.trans("View Survey")))])]),e._v(" "),r("can",{attrs:{code:"reports.delete"}},[r("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(t){var o=t.on;return[r("v-btn",e._g({attrs:{icon:""},on:{click:function(t){return e.askUserToDestroyReport(a)}}},o),[r("v-icon",{attrs:{small:""}},[e._v("mdi-delete-outline")])],1)]}}],null,!0)},[e._v(" "),r("span",[e._v(e._s(e.trans("Delete report permanently")))])])],1)],1)]}}]),model:{value:e.resources.selected,callback:function(t){e.$set(e.resources,"selected",t)},expression:"resources.selected"}})],1)],1)],1),e._v(" "),e.resourcesIsEmpty?r("div",[r("toolbar-menu",{attrs:{items:e.tabletoolbar},on:{"update:items":function(t){e.tabletoolbar=t},"update:search":e.search},scopedSlots:e._u([{key:"filter",fn:function(){return[r("monthly-picker")]},proxy:!0}],null,!1,59150502)}),e._v(" "),r("empty-state",{scopedSlots:e._u([{key:"actions",fn:function(){return[r("v-btn",{attrs:{large:"",color:"primary",exact:"",to:{name:"companies.show"}}},[r("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-credit-card-outline")]),e._v("\n          "+e._s(e.trans("Back to Indices"))+"\n        ")],1)]},proxy:!0}],null,!1,2662262712)})],1):e._e()],1)}),[],!1,null,null,null);t.default=y.exports;Y()(y,{VBtn:h.a,VCard:m.a,VDataTable:v.a,VIcon:g.a,VSlideYReverseTransition:f.i,VSlideYTransition:f.j,VTooltip:b.a})},40:function(e,t,r){"use strict";var a=r(13),o={props:["customer","user","type"],data:function(){return{resource:{data:{}}}},computed:{isOverall:function(){return"overall"==this.type}},methods:{getReportData:function(){var e=this;return new Promise((function(t,r){var a=e.customer,o=e.user;axios.get("/api/v1/reports/overall/customer/".concat(a,"/user/").concat(o)).then((function(e){t(e)})).catch((function(e){r(e)}))}))},getElements:function(){var e=this.resource.data.report.value||{},t={};if(this.isOverall)for(var r=_.map(e.indices,(function(e,t){return e.elements})),a=r.length-1;a>=0;a--){var o=r[a];t=Object.assign(t,o,{OverallScore:e["overall:score"],SustainabilityOverallScore:e.indices.BSPI["overall:total"],FinancialOverallScore:e.indices.FMPI["overall:total"],ProductivityOverallScore:e.indices.PMPI["overall:total"],HROverallScore:e.indices.HRPI["overall:total"]})}else t=e["current:index"].elements;return t=_.mapKeys(t,(function(e,t){return t.replace(/\s+/g,"")}))},sendToCrm:function(){var e=this;this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(t){if(e.resource.data=t.data,!e.resource.data.customer)return e.$store.dispatch("snackbar/show",{text:"No report data found."}),!1;var r=Object.assign(e.getElements(),{Id:_.toUpper(e.resource.data.customer.token),FileNo:e.resource.data.customer.filenumber,Status:100000006,OverallScore:e.resource.data.report.value["overall:score"]||null,Comments:e.resource.data["overall:comment"]||null,OverallComment:e.resource.data.report.value["overall:comment"]||null,"Lessons Learnt":e.resource.data.report.value["overall:comment"]||null});e.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),axios.post("/api/v1/crm/customers/save",r).then((function(t){e.$store.dispatch("snackbar/hide"),1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):e.$store.dispatch("dialog/error",{show:!0,width:400,buttons:{cancel:{show:!1}},title:"Returned a Code "+t.data.Code,text:t.data.Message})})).catch((function(t){e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})}))})).catch((function(e){console.log("err",e)}))},sendDocumentToCrm:function(){var e=this;this.getReportData().then((function(t){e.resource.data=t.data;var r={Id:_.toUpper(e.resource.data.customer.token),FileContentBase64:e.resource.data.report.fileContentBase64};e.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Overall Report Document to CRM. Establishing connection to CRM..."}),axios.post(a.a.crm.sendDocument(),r).then((function(t){e.$store.dispatch("snackbar/hide"),1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):e.$store.dispatch("dialog/error",{show:!0,width:400,buttons:{cancel:{show:!1}},title:"Returned a Code "+t.data.Code,text:t.data.Message})})).catch((function(t){e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})}))}))},sendBothDataToCrm:function(){this.sendToCrm(),this.sendDocumentToCrm()}}},n=r(0),s=r(2),i=r.n(s),c=r(109),l=r(93),u=r(275),d=r(108),p=r(276),Y=r(14),h=r(280),m=Object(n.a)(o,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return e.isOverall?r("div",[r("v-btn",{attrs:{large:"",block:e.$vuetify.breakpoint.smAndDown,color:"primary"},on:{click:e.sendToCrm}},[r("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-send")]),e._v("\n    "+e._s(e.trans("Send Scores to CRM"))+"\n  ")],1),e._v(" "),r("v-menu",{scopedSlots:e._u([{key:"activator",fn:function(t){var a=t.on;return[r("v-btn",e._g({attrs:{large:"",block:e.$vuetify.breakpoint.smAndDown,color:"primary"}},a),[r("v-icon",{attrs:{small:""}},[e._v("mdi-dots-horizontal")])],1)]}}],null,!1,647217361)},[e._v(" "),r("v-list",[r("v-list-item",{on:{click:e.sendDocumentToCrm}},[r("v-list-item-action",[r("v-icon",{staticClass:"text--muted",attrs:{small:""}},[e._v("mdi-paperclip")])],1),e._v(" "),r("v-list-item-content",[r("v-list-item-title",{domProps:{textContent:e._s(e.trans("Send Overall Report Document to CRM"))}})],1)],1),e._v(" "),r("v-list-item",{on:{click:e.sendBothDataToCrm}},[r("v-list-item-action",[r("v-icon",{staticClass:"text--muted",attrs:{small:""}},[e._v("mdi-paperclip")])],1),e._v(" "),r("v-list-item-content",[r("v-list-item-title",{domProps:{textContent:e._s(e.trans("Send Both Scores and Report Document to CRM"))}})],1)],1)],1)],1)],1):r("v-btn",{attrs:{icon:""},on:{click:e.sendToCrm}},[r("v-icon",{attrs:{small:""}},[e._v("mdi-send")])],1)}),[],!1,null,null,null);t.a=m.exports;i()(m,{VBtn:c.a,VIcon:l.a,VList:u.a,VListItem:d.a,VListItemAction:p.a,VListItemContent:Y.a,VListItemTitle:Y.b,VMenu:h.a})},52:function(e,t,r){"use strict";function a(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}t.a=function e(){var t;!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.metadata={years:{Years:{Year1:"Year 1",Year2:"Year 2",Year3:"Year 3"}},"fps-qa1":(t={Sales:{Year1:"100000",Year2:"125000",Year3:"200000"},"<strong>Change in Inventory Levels</strong>":[],"Opening Stocks":{Year1:"8000",Year2:"9500",Year3:"6500"},"Closing Stocks":{Year1:"9500",Year2:"6500",Year3:"3200"},"":[],"<h4><strong>Purchase of Goods and Services</strong></h4>":[],"<strong>Materials Consumed</strong>":[],"Raw Materials (direct & indirect)":{Year1:"36000",Year2:"45000",Year3:"55000"},"Stock Expiring":{Year1:"",Year2:"",Year3:""},"Other Materials Used":{Year1:"1500",Year2:"1000",Year3:"1000"}},a(t,"",[]),a(t,"<strong>Production Costs</strong>",[]),a(t,"Cargo and Handling",{Year1:"",Year2:"",Year3:""}),a(t,"Part-time/Temporary Labour",{Year1:"",Year2:"",Year3:""}),a(t,"Insurance (not including employee's insurance)",{Year1:"1000",Year2:"1000",Year3:"1000"}),a(t,"Transportation",{Year1:"10000",Year2:"11000",Year3:"11000"}),a(t,"Utilities",{Year1:"",Year2:"",Year3:""}),a(t,"Maintenance (Building, Plant, and Machinery)",{Year1:"2400",Year2:"2500",Year3:"2300"}),a(t,"Lease of Plant and Machinery",{Year1:"",Year2:"",Year3:""}),a(t,"Direct Employee Cost",{Year1:"",Year2:"",Year3:""}),a(t,"",[]),a(t,"<strong>General Management Costs</strong>",[]),a(t,"Stationery Supplies and Printing",{Year1:"450",Year2:"450",Year3:"450"}),a(t,"Rental",{Year1:"10000",Year2:"10000",Year3:"11000"}),a(t,"Insurance (not including employee's insurance)",{Year1:"",Year2:"",Year3:""}),a(t,"Transportation",{Year1:"1200",Year2:"1200",Year3:"1300"}),a(t,"Company Car/Bus etc.",{Year1:"",Year2:"",Year3:""}),a(t,"Advertising",{Year1:"12000",Year2:"13000",Year3:"13000"}),a(t,"Entertainment",{Year1:"",Year2:"",Year3:""}),a(t,"Food and Drinks",{Year1:"2000",Year2:"1800",Year3:"2100"}),a(t,"Telephone and Fax",{Year1:"600",Year2:"700",Year3:"800"}),a(t,"Mail and Courier",{Year1:"",Year2:"",Year3:""}),a(t,"Maintenance (Office Equipment)",{Year1:"",Year2:"",Year3:""}),a(t,"Travel",{Year1:"",Year2:"",Year3:""}),a(t,"Audit, Secretarial, and Professional Costs",{Year1:"1800",Year2:"2000",Year3:"2000"}),a(t,"Newspapers and Magazines",{Year1:"",Year2:"",Year3:""}),a(t,"Stamp Duty, Filing and Legal",{Year1:"",Year2:"",Year3:""}),a(t,"Bank charges",{Year1:"720",Year2:"720",Year3:"720"}),a(t,"Other Administrative Costs",{Year1:"",Year2:"",Year3:""}),a(t,"<strong>Labour Expenses</strong>",[]),a(t,"Employee Compensation",{Year1:"193257",Year2:"193257",Year3:"193257"}),a(t,"Bonuses",{Year1:"245165",Year2:"245165",Year3:"245165"}),a(t,"Provident Fund",{Year1:"13113",Year2:"13113",Year3:"13113"}),a(t,"Employee Welfare",{Year1:"75092",Year2:"75092",Year3:"75092"}),a(t,"Medical Costs",{Year1:"3395",Year2:"3395",Year3:"3395"}),a(t,"Employee Training",{Year1:"",Year2:"",Year3:""}),a(t,"Director's Salary",{Year1:"409846",Year2:"409846",Year3:"409846"}),a(t,"Employee Insurance",{Year1:"",Year2:"",Year3:""}),a(t,"Other Labour Expenses",{Year1:"",Year2:"",Year3:""}),a(t,"<strong>Depreciation</string>",[]),a(t,"Buildings",{Year1:"179869",Year2:"179869",Year3:"179869"}),a(t,"Plant, Machinery & Equipment",{Year1:"",Year2:"",Year3:""}),a(t,"Others (Depreciation)",{Year1:"",Year2:"",Year3:""}),a(t,"<h4><strong>Non-operating Expenses</strong></h4>",[]),a(t,"<strong>Non-Operating Income</strong>",[]),a(t,"Profit from Fixed Assets Sale",{Year1:"29744",Year2:"10386",Year3:"27577"}),a(t,"Profit from Foreign Exchange",{Year1:"",Year2:"",Year3:""}),a(t,"Other Income",{Year1:"26792",Year2:"24113",Year3:"16075"}),a(t,"<strong>Non-Operating Costs</strong>",[]),a(t,"Bad Debts",{Year1:"",Year2:"",Year3:""}),a(t,"Donations",{Year1:"15135",Year2:"15135",Year3:"15135"}),a(t,"Foreign Exchange Loss",{Year1:"24302",Year2:"24302",Year3:"24302"}),a(t,"Loss on Fixed Assets Sale",{Year1:"",Year2:"",Year3:""}),a(t,"Others (Non-Operating Costs)",{Year1:"",Year2:"",Year3:""}),a(t,"<strong>Taxation</strong>",[]),a(t,"Tax on Property",{Year1:"",Year2:"",Year3:""}),a(t,"Duties (Customs & Excise)",{Year1:"",Year2:"",Year3:""}),a(t,"Levy on Foreign Workers",{Year1:"6275",Year2:"6275",Year3:"6275"}),a(t,"Others (excluding Income Tax)",{Year1:"",Year2:"",Year3:""}),a(t,"<strongInterest On Loans/Hires</strong>",[]),a(t,"Interest & Charges by Bank",{Year1:"493458",Year2:"493458",Year3:"493458"}),a(t,"Interest on Loan",{Year1:"300390",Year2:"300390",Year3:"300390"}),a(t,"Interest on Hire Purchase",{Year1:"",Year2:"",Year3:""}),a(t,"Others (Interest on Loan/Hires)",{Year1:"",Year2:"",Year3:""}),a(t,"<strong>Company Tax</strong>",[]),a(t,"Tax on Company",{Year1:"",Year2:"",Year3:""}),t),"balance-sheet-years":{Years:{Year1:"Year 1",Year2:"Year 2",Year3:"Year 3"}},"balance-sheet":{Cash:{Year1:"8700",Year2:"8550",Year3:"8900"},"Trade Receivables":{Year1:"1200",Year2:"1500",Year3:"1000"},Inventories:{Year1:"800",Year2:"650",Year3:"700"},"Other CA":{Year1:"",Year2:"",Year3:""},"Fixed Assets":{Year1:"1000",Year2:"1000",Year3:"1000"},"Trade Payables":{Year1:"1200",Year2:"1100",Year3:"1150"},"Other CL":{Year1:"500",Year2:"600",Year3:"450"},"Stockholders' Equity":{Year1:"10000",Year2:"10000",Year3:"10000"},"Other NCL":{Year1:"500",Year2:"600",Year3:"450"},"Common Shares Outstanding":{Year1:"",Year2:"",Year3:""}},"fps-qa2":{"<h4><strong>Operating Profit/(Loss)</strong></h4>":[],"Profit or (Loss) Before Income Tax":{Year1:"83184",Year2:"308354",Year3:"242318"},"<strong>Non-Operating Income</strong>":[],"Profit from Fixed Assets Sale":{Year1:"132407",Year2:"135755",Year3:"492314"},"Profit from Foreign Exchange":{Year1:"",Year2:"2030",Year3:""},"Other Income":{Year1:"32150",Year2:"143569",Year3:"1841875"},"<strong>Non-Operating Costs</strong>":[],"Bad Debts":{Year1:"8,570",Year2:"",Year3:""},Donations:{Year1:"19199",Year2:"26062",Year3:"15135"},"Foreign Exchange Loss":{Year1:"",Year2:"",Year3:"24302"},"Loss on Fixed Assets Sale":{Year1:"",Year2:"",Year3:""},"Others (Non-Operating Costs)":{Year1:"",Year2:"",Year3:""},"<h4><strong>Labour Expenses</strong></h4>":[],"Employee Compensation":{Year1:"394097",Year2:"283821",Year3:"209362"},Bonuses:{Year1:"65725",Year2:"6495",Year3:"265595"},"Provident Fund":{Year1:"15930",Year2:"11221",Year3:"14206"},"Employee Welfare":{Year1:"20547",Year2:"52460",Year3:"81350"},"Medical Costs":{Year1:"",Year2:"",Year3:""},"Employee Training":{Year1:"",Year2:"",Year3:""},"Director's Salary":{Year1:"534000",Year2:"422000",Year3:"444000"},"Employee Insurance":{Year1:"",Year2:"",Year3:""},"Others (Labour Expenses)":{Year1:"",Year2:"",Year3:""},"<h4><strong>Interests on Loans/Hires</strong></h4>":[],"Interest & Charges by Bank":{Year1:"534580",Year2:"334666",Year3:"578254"},"Interest on Loan":{Year1:"300390",Year2:"621676",Year3:"587215"},"Interest on Hire Purchase":{Year1:"",Year2:"",Year3:""},"Others (interest on loan/hires)":{Year1:"",Year2:"",Year3:""},"<h4><strong>Depreciation</strong></h4>":[],Buildings:{Year1:"167126",Year2:"179869",Year3:"253729"},"Plant, Machinery & Equipment":{Year1:"",Year2:"",Year3:""},Others:{Year1:"",Year2:"",Year3:""},"<h4><strong>Taxation</strong></h4>":[],"Tax on Property":{Year1:"",Year2:"",Year3:""},"Duties (Customs & Excise)":{Year1:"",Year2:"",Year3:""},"Levy on Foreign Workers":{Year1:"6275",Year2:"35595",Year3:"33832"},"Others (excluding Income Tax & GST/VAT)":{Year1:"",Year2:"",Year3:""}}},this.data={name:"",code:"",refnum:"",description:"",metadata:{},financials:this.metadata,reports:[]}}}}]);
//# sourceMappingURL=6.js.map