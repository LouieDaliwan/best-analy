(window.webpackJsonp=window.webpackJsonp||[]).push([[24],{12:function(t,e,o){"use strict";e.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(t)},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(t){return"/api/v1/surveys/".concat(t,"/submit")},show:function(t){return"/api/v1/surveys/".concat(t)}},crm:{search:function(t){return"/api/v1/crm/customers/search/".concat(t)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"}},reports:{list:function(t){return"/api/v1/customers/".concat(t,"/reports")},generate:function(t){return"/api/v1/reports/".concat(t,"/generate")},download:function(t){return"/api/v1/reports/".concat(t,"/download")}}}},294:function(t,e,o){"use strict";o.r(e);var r=o(12),s=o(19),n=o(6);function a(t,e){var o=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),o.push.apply(o,r)}return o}function i(t,e,o){return e in t?Object.defineProperty(t,e,{value:o,enumerable:!0,configurable:!0,writable:!0}):t[e]=o,t}var c={computed:{resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},options:function(){return{per_page:this.resources.options.itemsPerPage,page:this.resources.options.page,sort:this.resources.options.sortBy[0]||void 0,order:this.resources.options.sortDesc[0]?"desc":"asc"}},selected:function(){return this.resources.selected.map((function(t){return t.id}))}},data:function(){return{api:r.a,resources:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},meta:{},modes:{bulkedit:!1},selected:[],headers:[{text:trans("Company Name"),align:"left",value:"name",class:"text-no-wrap"},{text:trans("File No."),align:"left",value:"refnum",class:"text-no-wrap"},{text:trans("Business Counselor"),align:"left",value:"counselor",class:"text-no-wrap"},{text:trans("Report Generated By"),align:"left",value:"author",class:"text-no-wrap"},{text:trans("Last Modified"),value:"updated_at",class:"text-no-wrap"},{text:trans("Actions"),align:"center",value:"action",sortable:!1,class:"muted--text text-no-wrap"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1}}},methods:function(t){for(var e=1;e<arguments.length;e++){var o=null!=arguments[e]?arguments[e]:{};e%2?a(Object(o),!0).forEach((function(e){i(t,e,o[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(o)):a(Object(o)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(o,e))}))}return t}({},Object(n.b)({errorDialog:"dialog/error",loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show"}),{changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.resources.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(t){this.getPaginatedData(this.options)},getPaginatedData:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;arguments.length>1&&void 0!==arguments[1]&&arguments[1];e=Object.assign(e||this.$route.query,{search:this.resources.search}),this.resources.loading=!0,axios.get(this.api.list(),{params:e}).then((function(o){t.resources=Object.assign({},t.resources,o.data),t.resources.options=Object.assign(t.resources.options,o.data.meta,e),t.resources.loading=!1,t.$router.push({query:Object.assign({},t.$route.query,e)}).catch((function(t){}))})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){t.resources.data.map((function(t){return Object.assign(t,{loading:!1})}))}))},search:_.debounce((function(t){this.resources.search=t.srcElement.value||"",this.tabletoolbar.isSearching=!1,this.resources.searching&&(this.getPaginatedData(this.options,"search"),this.resources.searching=!1)}),200),goToShowIndexPage:function(t){return{name:"companies.show",params:{id:t.id}}},focusSearchBar:function(){this.$refs.tablesearch.focus()},bulkTrashResource:function(){var t=this,e=this.selected;axios.delete(r.a.destroy(null),{data:{id:e}}).then((function(e){t.getPaginatedData(null,"bulkTrashResource"),t.tabletoolbar.toggleTrash=!1,t.tabletoolbar.toggleBulkEdit=!1,t.hideDialog(),t.showSnackbar({text:trans_choice("Company successfully moved to trash",t.tabletoolbar.bulkCount)})})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})}))},askUserToDestroyCompany:function(t){var e=this;this.showDialog({color:"warning",illustration:s.default,illustrationWidth:200,illustrationHeight:160,width:"420",title:"You are about to move to trash the selected company.",text:["Some data related to company will still remain.",trans("Are you sure you want to move :name to Trash?",{name:t.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:"Move to Trash",color:"warning",callback:function(o){e.loadDialog(!0),e.destroyResource(t)}}}})},destroyResource:function(t){var e=this;t.loading=!0,axios.delete(r.a.destroy(t.id)).then((function(o){t.active=!1,e.getPaginatedData(null,"destroyResource"),e.showSnackbar({text:trans_choice("Company successfully moved to trash",1)}),e.hideDialog()})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){t.active=!1,t.loading=!1}))}}),mounted:function(){this.changeOptionsFromRouterQueries()},watch:{"resources.search":function(t){this.resources.searching=!0},"resources.selected":function(t){this.tabletoolbar.bulkCount=t.length},"tabletoolbar.toggleBulkEdit":function(t){t||(this.resources.selected=[])}}},u=o(1),l=o(2),d=o.n(l),p=o(105),h=o(273),m=o(576),v=o(86),f=o(5),g=o(568),b=Object(u.a)(c,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("admin",[o("metatag",{attrs:{title:t.trans("All Company")}}),t._v(" "),o("page-header",{scopedSlots:t._u([{key:"utilities",fn:function(){return[o("router-link",{staticClass:"dt-link text--decoration-none mr-4",attrs:{tag:"a",exact:"",to:{name:"companies.trashed"}}},[o("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-delete-outline")]),t._v("\n        "+t._s(t.trans("Trashed Company"))+"\n      ")],1)]},proxy:!0},{key:"action",fn:function(){return[o("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,large:"",color:"primary",exact:"",to:{name:"companies.find"}}},[o("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-file-document-box-search-outline")]),t._v("\n        "+t._s(t.trans("Find Company"))+"\n      ")],1)]},proxy:!0}])}),t._v(" "),o("div",{directives:[{name:"show",rawName:"v-show",value:t.resourcesIsNotEmpty,expression:"resourcesIsNotEmpty"}]},[o("v-card",[o("toolbar-menu",{attrs:{items:t.tabletoolbar,bulk:"",downloadable:"",trashable:""},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search,"update:trash":t.bulkTrashResource}}),t._v(" "),o("v-slide-y-reverse-transition",{attrs:{mode:"out-in"}},[o("v-data-table",{attrs:{headers:t.resources.headers,items:t.resources.data,loading:t.resources.loading,"mobile-breakpoint":NaN,options:t.resources.options,"server-items-length":t.resources.meta.total,"show-select":t.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id"},on:{"update:options":[function(e){return t.$set(t.resources,"options",e)},t.optionsChanged]},scopedSlots:t._u([{key:"progress",fn:function(){return[o("span")]},proxy:!0},{key:"loading",fn:function(){return[o("v-slide-y-transition",{attrs:{mode:"out-in"}},[o("div",t._l(t.resources.options.itemsPerPage,(function(t,e){return o("div",{key:e},[o("skeleton-table")],1)})),0)])]},proxy:!0},{key:"item.name",fn:function(e){var r=e.item;return[o("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var s=e.on;return[o("span",t._g({staticClass:"mt-1"},s),[o("router-link",{staticClass:"text-no-wrap text--decoration-none",attrs:{tag:"a",exact:"",to:t.goToShowIndexPage(r)},domProps:{textContent:t._s(r.name)}})],1)]}}],null,!0)},[t._v(" "),o("span",[t._v(t._s(t.trans("View Details")))])])]}},{key:"item.refnum",fn:function(e){var r=e.item;return[o("span",{staticClass:"text-no-wrap",domProps:{textContent:t._s(r.refnum)}})]}},{key:"item.updated_at",fn:function(e){var r=e.item;return[o("span",{staticClass:"text-no-wrap",attrs:{title:r.updated_at}},[t._v(t._s(t.trans(r.modified)))])]}},{key:"item.action",fn:function(e){var r=e.item;return[o("div",{staticClass:"text-no-wrap"},[o("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var s=e.on;return[o("v-btn",t._g({attrs:{to:{name:"companies.reports",params:{id:r.id}},icon:""}},s),[o("v-icon",{attrs:{small:""}},[t._v("mdi-paperclip")])],1)]}}],null,!0)},[t._v(" "),o("span",[t._v(t._s(t.trans("View Reports")))])]),t._v(" "),o("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var s=e.on;return[o("v-btn",t._g({attrs:{to:{name:"companies.edit",params:{id:r.id}},icon:""}},s),[o("v-icon",{attrs:{small:""}},[t._v("mdi-pencil-outline")])],1)]}}],null,!0)},[t._v(" "),o("span",[t._v(t._s(t.trans("Edit Financial Performance inputs")))])]),t._v(" "),o("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var s=e.on;return[o("v-btn",t._g({attrs:{icon:""},on:{click:function(e){return t.askUserToDestroyCompany(r)}}},s),[o("v-icon",{attrs:{small:""}},[t._v("mdi-delete-outline")])],1)]}}],null,!0)},[t._v(" "),o("span",[t._v(t._s(t.trans("Move to trash")))])])],1)]}}]),model:{value:t.resources.selected,callback:function(e){t.$set(t.resources,"selected",e)},expression:"resources.selected"}})],1)],1)],1),t._v(" "),t.resourcesIsEmpty?o("div",[o("empty-state",{scopedSlots:t._u([{key:"actions",fn:function(){return[o("v-btn",{attrs:{large:"",color:"primary",exact:"",to:{name:"companies.generate"}}},[o("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-file-document-box-search-outline")]),t._v("\n          "+t._s(t.trans("Find Company"))+"\n        ")],1)]},proxy:!0}],null,!1,755926710)})],1):t._e()],1)}),[],!1,null,null,null);e.default=b.exports;d()(b,{VBtn:p.a,VCard:h.a,VDataTable:m.a,VIcon:v.a,VSlideYReverseTransition:f.g,VSlideYTransition:f.h,VTooltip:g.a})}}]);
//# sourceMappingURL=24.js.map