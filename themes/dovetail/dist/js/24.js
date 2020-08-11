(window.webpackJsonp=window.webpackJsonp||[]).push([[24],{12:function(e,t,r){"use strict";t.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},restore:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(e)},update:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},delete:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(e)},overall:function(e,t){return"/api/v1/reports/overall/customer/".concat(e,"/user/").concat(t)},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(e){return"/api/v1/surveys/".concat(e,"/submit")},show:function(e){return"/api/v1/surveys/".concat(e)}},crm:{search:function(e){return"/api/v1/crm/customers/search/".concat(e)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"},sendDocument:function(){return"/api/v1/crm/report/send"},sendFinancial:function(){return"/api/v1/crm/financial/send"}},reports:{list:function(e){return"/api/v1/customers/".concat(e,"/reports")},generate:function(e){return"/api/v1/reports/".concat(e,"/generate")},download:function(e){return"/api/v1/reports/".concat(e,"/download")},delete:function(e){return"/api/v1/reports/".concat(e)}}}},294:function(e,t,r){"use strict";r.r(t);var o=r(12),s=r(17),n=r(6);function a(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,o)}return r}function i(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}var c={data:function(){return{api:o.a,resources:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},meta:{},modes:{bulkedit:!1},selected:[],headers:[{text:trans("Company Name"),align:"left",value:"name",class:"text-no-wrap"},{text:trans("Refnum"),align:"left",value:"refnum",class:"text-no-wrap"},{text:trans("Date Deleted"),value:"deleted_at",class:"text-no-wrap"},{text:trans("Actions"),align:"center",value:"action",sortable:!1,class:"muted--text text-no-wrap"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1}}},computed:{resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},options:function(){return{per_page:this.resources.options.itemsPerPage,page:this.resources.options.page,sort:this.resources.options.sortBy[0]||void 0,order:this.resources.options.sortDesc[0]?"desc":"asc"}},selected:function(){return this.resources.selected.map((function(e){return e.id}))}},methods:function(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?a(Object(r),!0).forEach((function(t){i(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):a(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}({},Object(n.b)({errorDialog:"dialog/error",loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show"}),{changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.resources.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(e){this.getPaginatedData(this.options)},getPaginatedData:function(){var e=this,t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;t=Object.assign(t||this.$route.query,{search:this.resources.search}),this.resources.loading=!0,axios.get(this.api.trashed(),{params:t}).then((function(r){e.resources=Object.assign({},e.resources,r.data),e.resources.options=Object.assign(e.resources.options,r.data.meta,t),e.resources.loading=!1,e.$router.push({query:Object.assign({},e.$route.query,t)}).catch((function(e){}))})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){e.resources.data.map((function(e){return Object.assign(e,{loading:!1})}))}))},search:_.debounce((function(e){this.resources.search=e.srcElement.value||"",this.tabletoolbar.isSearching=!1,this.resources.searching&&(this.getPaginatedData(this.options),this.resources.searching=!1)}),200),focusSearchBar:function(){this.$refs.tablesearch.focus()},bulkRestoreResources:function(){var e=this,t=this.selected;axios.patch(o.a.restore(null),{id:t}).then((function(t){e.getPaginatedData(null),e.tabletoolbar.toggleTrash=!1,e.tabletoolbar.toggleBulkEdit=!1,e.hideDialog(),e.showSnackbar({text:trans_choice("Company successfully restored",e.tabletoolbar.bulkCount)})})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})}))},bulkDeleteResources:function(){var e=this,t=this.selected;axios.delete(o.a.delete(null),{data:{id:t}}).then((function(t){e.getPaginatedData(null),e.tabletoolbar.toggleTrash=!1,e.tabletoolbar.toggleBulkEdit=!1,e.hideDialog(),e.showSnackbar({text:trans_choice("Items permanently deleted",e.tabletoolbar.bulkCount)})})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})}))},restoreResource:function(e){var t=this;e.loading=!0,axios.patch(o.a.restore(e.id)).then((function(e){t.getPaginatedData(null),t.showSnackbar({text:trans_choice("Company successfully restored",1)})}))},askUserToPermanentlyDeleteResource:function(e){var t=this;this.showDialog({color:"error",illustration:s.default,illustrationWidth:200,illustrationHeight:160,width:"420",title:"You are about to permanently delete the selected company.",text:["Some data related to the account will still remain.",trans("Are you sure you want to permanently delete?",{name:e.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:"Permanently delete",color:"error",callback:function(r){t.loadDialog(!0),t.deleteResource(e)}}}})},deleteResource:function(e){var t=this;e.loading=!0,axios.delete(o.a.delete(e.id)).then((function(r){e.active=!1,t.getPaginatedData(null),t.hideDialog(),t.showSnackbar({text:trans_choice("Company successfully deleted",1)})})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){e.active=!1,e.loading=!1}))}}),mounted:function(){this.changeOptionsFromRouterQueries()},watch:{"resources.search":function(e){this.resources.searching=!0},"resources.selected":function(e){this.tabletoolbar.bulkCount=e.length},"tabletoolbar.toggleBulkEdit":function(e){e||(this.resources.selected=[])}}},u=r(0),l=r(2),d=r.n(l),p=r(104),h=r(259),m=r(592),v=r(90),f=r(4),g=r(583),b=Object(u.a)(c,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("admin",[r("metatag",{attrs:{title:e.trans("Trashed Companies")}}),e._v(" "),r("page-header",{scopedSlots:e._u([{key:"back",fn:function(){return[r("div",{staticClass:"mb-2"},[r("can",{attrs:{code:"customers.index"},scopedSlots:e._u([{key:"unpermitted",fn:function(){return[r("router-link",{staticClass:"text--decoration-none body-1 dt-link",attrs:{tag:"a",exact:"",to:{name:"companies.owned"}}},[r("v-icon",{staticClass:"mb-1",attrs:{small:""}},[e._v("mdi mdi-chevron-left")]),e._v(" "),r("span",{domProps:{textContent:e._s(e.trans("Companies"))}})],1)]},proxy:!0}])},[r("router-link",{staticClass:"text--decoration-none body-1 dt-link",attrs:{tag:"a",exact:"",to:{name:"companies.index"}}},[r("v-icon",{staticClass:"mb-1",attrs:{small:""}},[e._v("mdi mdi-chevron-left")]),e._v(" "),r("span",{domProps:{textContent:e._s(e.trans("Companies"))}})],1)],1)],1)]},proxy:!0}])}),e._v(" "),r("div",{directives:[{name:"show",rawName:"v-show",value:e.resourcesIsNotEmpty,expression:"resourcesIsNotEmpty"}]},[r("v-card",[r("toolbar-menu",{attrs:{items:e.tabletoolbar,bulk:"",restorable:"",deletable:""},on:{"update:items":function(t){e.tabletoolbar=t},"update:restore":e.bulkRestoreResources,"update:search":e.search,"update:delete":e.bulkDeleteResources}}),e._v(" "),r("v-slide-y-reverse-transition",{attrs:{mode:"out-in"}},[r("v-data-table",{attrs:{headers:e.resources.headers,items:e.resources.data,loading:e.resources.loading,"mobile-breakpoint":NaN,options:e.resources.options,"server-items-length":e.resources.meta.total,"show-select":e.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id"},on:{"update:options":[function(t){return e.$set(e.resources,"options",t)},e.optionsChanged]},scopedSlots:e._u([{key:"progress",fn:function(){return[r("span")]},proxy:!0},{key:"loading",fn:function(){return[r("v-slide-y-transition",{attrs:{mode:"out-in"}},[r("div",e._l(e.resources.options.itemsPerPage,(function(e,t){return r("div",{key:t},[r("skeleton-table")],1)})),0)])]},proxy:!0},{key:"item.name",fn:function(t){var o=t.item;return[r("span",{staticClass:"muted--text",attrs:{title:o.name}},[e._v(e._s(e.trans(o.name)))])]}},{key:"item.refnum",fn:function(t){var o=t.item;return[r("v-tooltip",{attrs:{bottom:"",transition:"scroll-y-transition","max-width":"300"},scopedSlots:e._u([{key:"activator",fn:function(t){var s=t.on;return[r("span",e._g({staticClass:"text--ellipsis-1 muted--text"},s),[e._v(e._s(e.trans(o.refnum)))])]}}],null,!0)},[e._v(" "),r("span",[e._v(e._s(e.trans(o.refnum)))])])]}},{key:"item.deleted_at",fn:function(t){var o=t.item;return[r("span",{staticClass:"muted--text",attrs:{title:o.deleted_at}},[e._v(e._s(e.trans(o.deleted)))])]}},{key:"item.action",fn:function(t){var o=t.item;return[r("div",{staticClass:"text-no-wrap"},[r("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(t){var s=t.on;return[r("v-btn",e._g({attrs:{icon:""},on:{click:function(t){return e.restoreResource(o)}}},s),[o.loading?r("v-icon",{staticClass:"mdi-spin",attrs:{small:""}},[e._v("mdi-loading")]):r("v-icon",{attrs:{small:""}},[e._v("mdi-restore")])],1)]}}],null,!0)},[e._v(" "),r("span",[e._v(e._s(e.trans_choice("Restore this company",1)))])]),e._v(" "),r("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(t){var s=t.on;return[r("v-btn",e._g({attrs:{icon:""},on:{click:function(t){return e.askUserToPermanentlyDeleteResource(o)}}},s),[r("v-icon",{attrs:{small:""}},[e._v("mdi-delete-forever-outline")])],1)]}}],null,!0)},[e._v(" "),r("span",[e._v(e._s(e.trans_choice("Permanently delete this company",1)))])])],1)]}}]),model:{value:e.resources.selected,callback:function(t){e.$set(e.resources,"selected",t)},expression:"resources.selected"}})],1)],1)],1),e._v(" "),e.resourcesIsEmpty?r("div",[r("empty-state",{scopedSlots:e._u([{key:"actions",fn:function(){return[r("v-btn",{attrs:{large:"",color:"primary",exact:"",to:{name:"companies.index"}}},[e._v("\n          "+e._s(e.trans("Go back to all Companies"))+"\n        ")])]},proxy:!0}],null,!1,1736478374)})],1):e._e()],1)}),[],!1,null,null,null);t.default=b.exports;d()(b,{VBtn:p.a,VCard:h.a,VDataTable:m.a,VIcon:v.a,VSlideYReverseTransition:f.i,VSlideYTransition:f.j,VTooltip:g.a})}}]);
//# sourceMappingURL=24.js.map