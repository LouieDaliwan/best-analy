(window.webpackJsonp=window.webpackJsonp||[]).push([[36],{325:function(t,e,s){"use strict";s.r(e);var a=s(15),r=s(9),o=s(17),n=s(43),i=s(6);function c(t,e){var s=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),s.push.apply(s,a)}return s}function l(t,e,s){return e in t?Object.defineProperty(t,e,{value:s,enumerable:!0,configurable:!0,writable:!0}):t[e]=s,t}var u={computed:{filter:function(){},options:function(){return{per_page:this.resources.options.itemsPerPage,page:this.resources.options.page,sort:this.resources.options.sortBy[0]||void 0,order:this.resources.options.sortDesc[0]?"desc":"asc"}},selected:function(){return this.resources.selected.map((function(t){return t.id}))}},data:function(){return{api:a.a,resource:new n.a,auth:r.default.getUser(),resources:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},meta:{},modes:{bulkedit:!1},selected:[],headers:[{text:trans("Member Name"),align:"left",value:"displayname",class:"text-no-wrap"},{text:trans("Companies"),align:"center",value:"customers:count",class:"text-no-wrap"},{text:trans("No. of Reports"),align:"center",value:"reports:count",class:"text-no-wrap"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1},search:null}},methods:function(t){for(var e=1;e<arguments.length;e++){var s=null!=arguments[e]?arguments[e]:{};e%2?c(Object(s),!0).forEach((function(e){l(t,e,s[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(s)):c(Object(s)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(s,e))}))}return t}({},Object(i.b)({showDialog:"dialog/show",hideDialog:"dialog/hide",errorDialog:"dialog/error",showSnackbar:"snackbar/show",loadDialog:"dialog/loading"}),{getResource:function(){var t=this;axios.get(a.a.show(this.$route.params.id)).then((function(e){t.resource.data=e.data.data,t.resource.data.users=t.resource.data.members})).finally((function(){t.resource.loading=!1}))},askUserToDestroyResource:function(t){var e=this;this.showDialog({color:"warning",illustration:function(){return Promise.resolve().then(s.bind(null,17))},illustrationWidth:200,illustrationHeight:160,width:"420",title:trans("You are about to move to trash the selected team."),text:[trans("The user will be signed out from the app. Some data related to the account like comments and files will still remain."),trans("Are you sure you want to deactivate and move :name to Trash?",{name:t.data.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:trans("Move to Trash"),color:"warning",callback:function(s){e.loadDialog(!0),e.destroyResource(t)}}}})},destroyResource:function(t){var e=this;t.loading=!0,axios.delete(a.a.destroy(t.data.id)).then((function(t){e.hideDialog(),e.showSnackbar({show:!0,text:trans_choice("Team successfully moved to trash",1)}),e.$router.push({name:"teams.index"})})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){t.loading=!1}))},previewMember:function(t){this.resource.preview=t[0]},changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.resources.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(t){this.getPaginatedData(this.options)},getPaginatedData:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;arguments.length>1&&void 0!==arguments[1]&&arguments[1];e=Object.assign(e||this.$route.query,{search:this.resources.search,user_id:r.default.getId()}),this.resources.loading=!0,axios.get(this.api.owned(),{params:e}).then((function(s){t.resources=Object.assign({},t.resources,s.data),t.resources.options=Object.assign(t.resources.options,s.data.meta,e),t.resources.loading=!1,t.$router.push({query:Object.assign({},t.$route.query,e)}).catch((function(t){}))})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){t.resources.data.map((function(t){return Object.assign(t,{loading:!1})}))}))},goToShowTeamPage:function(t){return{name:"teams.show",params:{id:t.id,slug:t.name}}},focusSearchBar:function(){this.$refs.tablesearch.focus()},askUserToDestroyTeam:function(t){var e=this;this.showDialog({color:"warning",illustration:o.default,illustrationWidth:200,illustrationHeight:160,width:"420",title:"You are about to move to trash the selected team.",text:["Some data related to team will still remain.",trans("Are you sure you want to move :name to Trash?",{name:t.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:"Move to Trash",color:"warning",callback:function(s){e.loadDialog(!0),e.destroyResource(t)}}}})},openExportDialog:function(){this.$store.dispatch("dialog/show",{illustration:function(){return Promise.resolve().then(s.bind(null,514))},title:trans("Export Report"),text:[trans("Download the table as PDF file.")],buttons:{action:{text:trans("Export"),callback:function(){var t=r.default.getId();window.location.href="/teams/export?user_id=".concat(t)}}}})}}),mounted:function(){this.getResource(),this.changeOptionsFromRouterQueries(),this.getPaginatedData()},watch:{"resources.search":function(t){this.resources.searching=!0},"resources.selected":function(t){this.tabletoolbar.bulkCount=t.length},"tabletoolbar.toggleBulkEdit":function(t){t||(this.resources.selected=[])}}},d=s(0),m=s(2),p=s.n(m),h=s(264),v=s(262),f=s(1),g=s(579),b=s(596),_=s(265),w=s(91),y=s(125),x=s(581),C=s(5),k=s(587),P=Object(d.a)(u,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("admin",[s("metatag",{attrs:{title:t.resource.data.name}}),t._v(" "),s("page-header",{scopedSlots:t._u([{key:"back",fn:function(){return[s("div",{staticClass:"mb-2"},[s("can",{attrs:{code:"teams.index"},scopedSlots:t._u([{key:"unpermitted",fn:function(){return[s("can",{attrs:{code:"teams.owned"}},[s("router-link",{staticClass:"text--decoration-none body-1 dt-link",attrs:{tag:"a",exact:"",to:{name:"teams.owned"}}},[s("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi mdi-chevron-left")]),t._v(" "),s("span",{domProps:{textContent:t._s(t.trans("My Team"))}})],1)],1)]},proxy:!0}])},[s("router-link",{staticClass:"text--decoration-none body-1 dt-link",attrs:{tag:"a",exact:"",to:{name:"teams.index"}}},[s("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi mdi-chevron-left")]),t._v(" "),s("span",{domProps:{textContent:t._s(t.trans("All Teams"))}})],1)],1)],1)]},proxy:!0},{key:"title",fn:function(){return[t._v(t._s(t.resource.data.name))]},proxy:!0},{key:"utilities",fn:function(){return[s("can",{attrs:{code:"teams.show"}},[s("router-link",{staticClass:"dt-link text--decoration-none mr-6",attrs:{tag:"a",exact:"",to:{name:"teams.edit"}}},[s("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi-pencil-outline")]),t._v("\n          "+t._s(t.trans("Edit"))+"\n        ")],1)],1),t._v(" "),s("can",{attrs:{code:"teams.destroy"}},[s("a",{staticClass:"dt-link text--decoration-none mr-6",attrs:{href:"#"},on:{click:function(e){return e.preventDefault(),t.askUserToDestroyResource(t.resource)}}},[s("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi-delete-outline")]),t._v("\n          "+t._s(t.trans("Move to Trash"))+"\n        ")],1)])]},proxy:!0}])}),t._v(" "),s("v-row",[s("v-col",{attrs:{cols:"12",md:"12"}},[s("v-card",{staticClass:"mb-5"},[s("v-card-text",[t.resource.data.description?[s("h4",{staticClass:"mb-3",domProps:{textContent:t._s(t.trans("Team Detail"))}}),t._v(" "),s("p",{staticClass:"mb-4"},[t._v(t._s(t.resource.data.description))])]:t._e(),t._v(" "),s("h4",{staticClass:"mb-3",domProps:{textContent:t._s(t.trans("Team Manager"))}}),t._v(" "),s("user-account-detail-card",{model:{value:t.resource.data.lead,callback:function(e){t.$set(t.resource.data,"lead",e)},expression:"resource.data.lead"}})],2),t._v(" "),s("div",{staticClass:"d-flex mb-4"},[s("v-divider"),t._v(" "),s("v-icon",{staticClass:"mx-3 mt-n2",attrs:{small:"",color:"muted"}},[t._v("mdi-account-settings")]),t._v(" "),s("v-divider")],1),t._v(" "),s("v-row",[s("v-col",{staticClass:"pt-0",attrs:{cols:"12",md:"6"}},[s("v-card-text",{staticClass:"pt-0"},[s("h4",{staticClass:"mb-5"},[t._v(t._s(t.trans("Team Members")))]),t._v(" "),s("treeview-pagination",{attrs:{items:t.resource.data.users,search:t.search,activatable:!0},on:{active:t.previewMember}})],1)],1),t._v(" "),s("v-divider",{attrs:{vertical:""}}),t._v(" "),s("v-col",{staticClass:"pt-0"},[s("v-scroll-y-transition",{attrs:{mode:"out-in"}},[t.resource.preview?s("div",{key:t.resource.preview.id},[s("v-row",{attrs:{justify:"center"}},[s("v-col",{staticClass:"pt-1",attrs:{cols:"auto"}},[s("div",{staticClass:" d-flex"},[s("v-avatar",{staticClass:"mr-3",attrs:{size:"32",color:"workspace"}},[s("v-img",{attrs:{src:t.resource.preview.avatar}})],1),t._v(" "),s("p",{staticClass:"font-weight-bold",domProps:{textContent:t._s(t.resource.preview.displayname)}})],1),t._v(" "),s("div",{staticClass:"mb-2"},[s("v-icon",{staticClass:"mr-2 muted--text",attrs:{small:""}},[t._v("mdi-at")]),t._v(" "),s("span",{staticClass:"muted--text"},[t._v(t._s(t.resource.preview.username))])],1),t._v(" "),s("div",{staticClass:"muted--text mb-2"},[s("v-icon",{staticClass:"mr-2 muted--text",attrs:{small:""}},[t._v("mdi-email-outline")]),t._v(" "),s("span",{staticClass:"muted--text"},[t._v(t._s(t.resource.preview.email))])],1),t._v(" "),s("div",{staticClass:"muted--text"},[s("v-icon",{staticClass:"mr-2 muted--text",attrs:{small:""}},[t._v("mdi-account-outline")]),t._v("\n                      "+t._s(t.resource.preview.role)+"\n                    ")],1)])],1)],1):s("div",[s("v-row",{attrs:{justify:"center"}},[s("v-col",{attrs:{cols:"auto"}},[s("checklist-icon",{staticClass:"primary--text",staticStyle:{filter:"grayscale(0.8) brightness(150%)"},attrs:{height:"100"}}),t._v(" "),s("p",{staticClass:"muted--text pa-3"},[t._v("\n                      "+t._s(t.trans("Select members from the list to view details"))+"\n                    ")])],1)],1)],1)])],1)],1)],1),t._v(" "),s("h3",{staticClass:"mb-3"},[t._v(t._s(t.__("Team Reports")))]),t._v(" "),s("v-card",{staticClass:"mb-3"},[s("v-data-table",{attrs:{activatable:!0,headers:t.resources.headers,"hide-default-footer":!0,items:t.resource.data.users,search:t.search,loading:t.resources.loading,"mobile-breakpoint":NaN,options:t.resources.options,"show-select":t.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id","show-expand":"","single-expand":""},on:{active:t.previewMember,"update:options":[function(e){return t.$set(t.resources,"options",e)},t.optionsChanged]},scopedSlots:t._u([{key:"progress",fn:function(){return[s("span")]},proxy:!0},{key:"expanded-item",fn:function(e){var a=e.headers,r=e.item;return[r.customers.length?[s("td",{attrs:{colspan:a.length}},[t._l(r.customers,(function(e,a){return[s("p",{key:a,staticClass:"my-3"},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(a){var o=a.on;return[s("span",t._g({staticClass:"mt-1"},o),[s("router-link",{staticClass:"text-no-wrap text--decoration-none secondary--text",attrs:{tag:"a",exact:"",to:{name:"teams.reports",params:{customer:e.id,user:r.id},query:{from:t.$route.fullPath}}},domProps:{textContent:t._s(e.name)}})],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("View Reports")))])])],1)]}))],2)]:[s("td",{attrs:{colspan:a.length}},[s("p",{staticClass:"muted--text my-3"},[s("em",{domProps:{textContent:t._s(t.__("No companies found."))}})])])]]}},{key:"loading",fn:function(){return[s("v-slide-y-transition",{attrs:{mode:"out-in"}},[s("div",t._l(t.resources.options.itemsPerPage,(function(t,e){return s("div",{key:e},[s("skeleton-table")],1)})),0)])]},proxy:!0},{key:"item.displayname",fn:function(e){var a=e.item;return[s("can",{attrs:{code:"users.show"},scopedSlots:t._u([{key:"unpermitted",fn:function(){return[s("span",{staticClass:"text-no-wrap text--decoration-none mt-1",domProps:{textContent:t._s(a.displayname)}})]},proxy:!0}],null,!0)},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var r=e.on;return[s("span",t._g({staticClass:"mt-1"},r),[s("router-link",{staticClass:"text-no-wrap text--decoration-none",attrs:{tag:"a",exact:"",to:{name:"users.show",params:{id:a.id},query:{from:t.$route.fullPath}}},domProps:{textContent:t._s(a.displayname)}})],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("View member details")))])])],1)]}}]),model:{value:t.resources.selected,callback:function(e){t.$set(t.resources,"selected",e)},expression:"resources.selected"}})],1),t._v(" "),s("div",{staticStyle:{height:"150px"}})],1)],1)],1)}),[],!1,null,null,null);e.default=P.exports;p()(P,{VAvatar:h.a,VCard:v.a,VCardText:f.c,VCol:g.a,VDataTable:b.a,VDivider:_.a,VIcon:w.a,VImg:y.a,VRow:x.a,VScrollYTransition:C.f,VSlideYTransition:C.j,VTooltip:k.a})},43:function(t,e,s){"use strict";e.a=function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.users=[],this.managers=[],this.selected=[],this.preview=null,this.data={code:"",created:"",description:"",icon:"",name:"",selected:[],users:[],manager_id:"",lead:{},members:[]}}}}]);
//# sourceMappingURL=36.js.map