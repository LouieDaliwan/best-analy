(window.webpackJsonp=window.webpackJsonp||[]).push([[36],{318:function(t,e,r){"use strict";r.r(e);var o=r(15),s=r(42),a=r(6);function n(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,o)}return r}function i(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var c={computed:{resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},allReportPresent:function(){return 4==this.resources.data.length}},data:function(){return{resource:new s.a,customer:{},resources:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},meta:{},modes:{bulkedit:!1},selected:[],headers:[{text:trans("Report Type"),align:"left",value:"key",class:"text-no-wrap"},{text:trans("Generated By"),align:"left",value:"user_id",class:"text-no-wrap"},{text:trans("Site Visit Date"),align:"center",value:"remarked",class:"text-no-wrap"},{text:trans("Actions"),align:"center",value:"action",sortable:!1,class:"muted--text text-no-wrap"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1}}},methods:function(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?n(Object(r),!0).forEach((function(e){i(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):n(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}({},Object(a.b)({errorDialog:"dialog/error",loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show"}),{previewPDFReport:function(t){window.open("/best/reports/pdf/preview?report_id=".concat(t.id,"&type=index"),"_blank")},sendToCrm:function(t){var e={Id:this.resource.data.token,FileNo:this.resource.data.refnum,OverallScore:t.value["overall:score"],FileContentBase64:t.fileContentBase64,"Lessons Learnt":t.value["overall:comment"]};axios.post(o.a.crm.save(),e).then((function(t){}))},previewRatiosReport:function(){this.$router.push({name:"teams.ratios",query:{type:"ratios",from:this.$route.fullPath,user_id:this.$route.params.user},params:{id:this.$route.params.customer}})},previewOverallReport:function(){this.$router.push({name:"teams.overall",query:{type:"overall",from:this.$route.fullPath,user_id:this.$route.params.user},params:{id:this.$route.params.customer}})},changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.resources.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(t){this.getPaginatedData(this.options)},getResource:function(){var t=this;this.resource.loading=!0,this.resource.isPrestine=!1,axios.get(o.a.reports.users.list(this.$route.params.customer,this.$route.params.user)).then((function(e){t.resource.data=e.data.data})).finally((function(){t.load(!1),t.resource.isPrestine=!0}))},getCustomerData:function(){var t=this;this.resource.loading=!0,this.resource.isPrestine=!1,axios.get(o.a.customers.show(this.$route.params.customer)).then((function(e){t.customer=e.data.data})).finally((function(){t.load(!1),t.resource.isPrestine=!0}))},getPaginatedData:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;arguments.length>1&&void 0!==arguments[1]&&arguments[1];e=Object.assign(e||this.$route.query,{search:this.resources.search}),this.resources.loading=!0,axios.get(o.a.reports.users.list(this.$route.params.customer,this.$route.params.user),{params:e}).then((function(r){t.resources=Object.assign({},t.resources,r.data),t.resources.options=Object.assign(t.resources.options,r.data.meta,e),t.resources.loading=!1,t.$router.push({query:Object.assign({},t.$route.query,e)}).catch((function(t){}))})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){t.resources.data.map((function(t){return Object.assign(t,{loading:!1})}))}))},askUserToDestroyReport:function(t){var e=this;this.showDialog({color:"error",illustration:function(){return Promise.resolve().then(r.bind(null,17))},illustrationWidth:200,illustrationHeight:160,width:"420",title:"You are about to permanently delete the selected report.",text:["Some data related to report will still remain.",trans("Are you sure you want to permanently delete :name?",{name:t.key})],buttons:{cancel:{show:!0,color:"link"},action:{text:"Delete",color:"error",callback:function(r){e.loadDialog(!0),e.deleteResource(t)}}}})},deleteResource:function(t){var e=this;t.loading=!0,axios.delete(o.a.reports.delete(t.id)).then((function(r){t.active=!1,e.getPaginatedData(null),e.hideDialog(),e.showSnackbar({text:trans_choice("Report successfully deleted",1)})})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){t.active=!1,t.loading=!1}))},goToShowPage:function(t){return{name:"teams.report",query:{from:this.$route.fullPath},params:{id:t.customer_id,report:t.id}}},goToSurveyPage:function(t){return{name:"companies.response",query:{month:t.remarks,from:this.$route.fullPath},params:{id:t.customer_id,taxonomy:t.value["current:index"].taxonomy.id||null,survey:t.value["survey:id"]}}},load:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=t},search:_.debounce((function(t){this.resources.search=t.srcElement.value||"",this.tabletoolbar.isSearching=!1,this.resources.searching&&(this.getPaginatedData(this.options,"search"),this.resources.searching=!1)}),200),bulkTrashResource:function(){var t=this,e=this.selected;axios.delete(o.a.reports.destroy(null),{data:{id:e}}).then((function(e){t.getPaginatedData(null,"bulkTrashResource"),t.tabletoolbar.toggleTrash=!1,t.tabletoolbar.toggleBulkEdit=!1,t.hideDialog(),t.showSnackbar({text:trans_choice("Company successfully moved to trash",t.tabletoolbar.bulkCount)})})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})}))}}),mounted:function(){this.getResource(),this.getPaginatedData(),this.getCustomerData()},watch:{"resources.search":function(t){this.resources.searching=!0},"resources.selected":function(t){this.tabletoolbar.bulkCount=t.length},"tabletoolbar.toggleBulkEdit":function(t){t||(this.resources.selected=[])}}},l=r(0),u=r(2),d=r.n(u),p=r(104),h=r(259),m=r(593),f=r(90),v=r(4),g=r(584),y=Object(l.a)(c,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("admin",[r("metatag",{attrs:{title:t.customer.name}}),t._v(" "),r("page-header",{scopedSlots:t._u([{key:"back",fn:function(){return[r("div",{staticClass:"mb-2"},[r("can",{attrs:{code:"teams.owned"},scopedSlots:t._u([{key:"unpermitted",fn:function(){return[r("router-link",{staticClass:"text--decoration-none body-1 dt-link",attrs:{tag:"a",exact:"",to:{name:"teams.owned"}}},[r("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi mdi-chevron-left")]),t._v(" "),r("span",{domProps:{textContent:t._s(t.trans("My Team"))}})],1)]},proxy:!0}])},[r("router-link",{staticClass:"text--decoration-none body-1 dt-link",attrs:{tag:"a",exact:"",to:{name:"teams.owned"}}},[r("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi mdi-chevron-left")]),t._v(" "),r("span",{domProps:{textContent:t._s(t.trans("My Team"))}})],1)],1)],1)]},proxy:!0},{key:"title",fn:function(){return[t._v(t._s(t.customer.name))]},proxy:!0},{key:"utilities",fn:function(){return[r("h4",{staticClass:"muted--text",domProps:{textContent:t._s(t.trans("Reports List"))}})]},proxy:!0},{key:"action",fn:function(){return[t.allReportPresent?r("v-btn",{staticClass:"mr-3",attrs:{block:t.$vuetify.breakpoint.smAndDown,color:"primary",exact:"",large:"",text:""},on:{click:t.previewRatiosReport}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-table-eye")]),t._v("\n        "+t._s(t.__("Financial Analysis Report"))+"\n      ")],1):t._e(),t._v(" "),t.allReportPresent?r("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,color:"primary",exact:"",large:""},on:{click:t.previewOverallReport}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-file-chart-outline")]),t._v("\n        "+t._s(t.__("Overall Report"))+"\n      ")],1):t._e()]},proxy:!0}])}),t._v(" "),r("div",{directives:[{name:"show",rawName:"v-show",value:t.resourcesIsNotEmpty,expression:"resourcesIsNotEmpty"}]},[r("v-card",[r("toolbar-menu",{attrs:{items:t.tabletoolbar},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search},scopedSlots:t._u([{key:"filter",fn:function(){return[r("monthly-picker")]},proxy:!0}])}),t._v(" "),r("v-slide-y-reverse-transition",{attrs:{mode:"out-in"}},[r("v-data-table",{attrs:{headers:t.resources.headers,items:t.resources.data,loading:t.resources.loading,"mobile-breakpoint":NaN,options:t.resources.options,"server-items-length":t.resources.meta.total,"show-select":t.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id"},on:{"update:options":[function(e){return t.$set(t.resources,"options",e)},t.optionsChanged]},scopedSlots:t._u([{key:"progress",fn:function(){return[r("span")]},proxy:!0},{key:"loading",fn:function(){return[r("v-slide-y-transition",{attrs:{mode:"out-in"}},[r("div",t._l(t.resources.options.itemsPerPage,(function(t,e){return r("div",{key:e},[r("skeleton-table")],1)})),0)])]},proxy:!0},{key:"item.key",fn:function(e){var o=e.item;return[r("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var s=e.on;return[r("span",t._g({staticClass:"mt-1"},s),[r("router-link",{staticClass:"text-no-wrap text--decoration-none",attrs:{tag:"a",exact:"",to:t.goToShowPage(o)},domProps:{textContent:t._s(o.key)}})],1)]}}],null,!0)},[t._v(" "),r("span",[t._v(t._s(t.trans("View Preview Report")))])])]}},{key:"item.created_at",fn:function(e){var o=e.item;return[r("span",{staticClass:"text-no-wrap",attrs:{title:o.created_at}},[t._v(t._s(t.trans(o.created)))])]}},{key:"item.user_id",fn:function(e){var o=e.item;return[r("span",{staticClass:"text-no-wrap",domProps:{textContent:t._s(o.author)}})]}},{key:"item.action",fn:function(e){var o=e.item;return[r("div",{staticClass:"text-no-wrap"},[r("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var s=e.on;return[r("v-btn",t._g({attrs:{icon:""},on:{click:function(e){return t.sendToCrm(o)}}},s),[r("v-icon",{attrs:{small:""}},[t._v("mdi-send")])],1)]}}],null,!0)},[t._v(" "),r("span",[t._v(t._s(t.trans("Send"))+" "+t._s(o.key)+" "+t._s(t.__("to CRM")))])]),t._v(" "),r("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var s=e.on;return[r("v-btn",t._g({attrs:{to:t.goToSurveyPage(o),icon:""}},s),[r("v-icon",{attrs:{small:""}},[t._v("mdi-file-table")])],1)]}}],null,!0)},[t._v(" "),r("span",[t._v(t._s(t.trans("View Survey")))])]),t._v(" "),r("can",{attrs:{code:"teams.destroy"}},[r("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var s=e.on;return[r("v-btn",t._g({attrs:{icon:""},on:{click:function(e){return t.askUserToDestroyReport(o)}}},s),[r("v-icon",{attrs:{small:""}},[t._v("mdi-delete-outline")])],1)]}}],null,!0)},[t._v(" "),r("span",[t._v(t._s(t.trans("Move to trash")))])])],1)],1)]}}]),model:{value:t.resources.selected,callback:function(e){t.$set(t.resources,"selected",e)},expression:"resources.selected"}})],1)],1)],1),t._v(" "),t.resourcesIsEmpty?r("div",[r("toolbar-menu",{attrs:{items:t.tabletoolbar},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search},scopedSlots:t._u([{key:"filter",fn:function(){return[r("monthly-picker")]},proxy:!0}],null,!1,59150502)}),t._v(" "),r("empty-state",{scopedSlots:t._u([{key:"actions",fn:function(){return[r("v-btn",{attrs:{large:"",color:"primary",exact:"",to:{name:"companies.owned"}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-file-document-box-search-outline")]),t._v("\n          "+t._s(t.trans("Back to My Companies"))+"\n        ")],1)]},proxy:!0}],null,!1,372801965)})],1):t._e()],1)}),[],!1,null,null,null);e.default=y.exports;d()(y,{VBtn:p.a,VCard:h.a,VDataTable:m.a,VIcon:f.a,VSlideYReverseTransition:v.i,VSlideYTransition:v.j,VTooltip:g.a})},42:function(t,e,r){"use strict";e.a=function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.users=[],this.managers=[],this.selected=[],this.preview=null,this.data={code:"",created:"",description:"",icon:"",name:"",selected:[],users:[],manager_id:"",lead:{},members:[]}}}}]);
//# sourceMappingURL=36.js.map