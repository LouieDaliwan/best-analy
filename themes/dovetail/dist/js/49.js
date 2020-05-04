(window.webpackJsonp=window.webpackJsonp||[]).push([[49],{310:function(t,e,o){"use strict";o.r(e);var s=o(15),r=o(10),a=o(18),n=o(6);function i(t,e){var o=Object.keys(t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(t);e&&(s=s.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),o.push.apply(o,s)}return o}function c(t,e,o){return e in t?Object.defineProperty(t,e,{value:o,enumerable:!0,configurable:!0,writable:!0}):t[e]=o,t}var l={computed:{resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},options:function(){return{per_page:this.resources.options.itemsPerPage,page:this.resources.options.page,sort:this.resources.options.sortBy[0]||void 0,order:this.resources.options.sortDesc[0]?"desc":"asc"}},selected:function(){return this.resources.selected.map((function(t){return t.id}))}},data:function(){return{api:s.a,auth:r.default.getUser(),resources:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},meta:{},modes:{bulkedit:!1},selected:[],headers:[{text:trans("Member Name"),align:"left",value:"displayname",class:"text-no-wrap"},{text:trans("Companies"),align:"center",value:"customers:count",class:"text-no-wrap"},{text:trans("No. of Reports"),align:"center",value:"reports:count",class:"text-no-wrap"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1}}},mounted:function(){this.changeOptionsFromRouterQueries(),this.getPaginatedData()},methods:function(t){for(var e=1;e<arguments.length;e++){var o=null!=arguments[e]?arguments[e]:{};e%2?i(Object(o),!0).forEach((function(e){c(t,e,o[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(o)):i(Object(o)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(o,e))}))}return t}({},Object(n.b)({errorDialog:"dialog/error",loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show"}),{changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.resources.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(t){this.getPaginatedData(this.options)},getPaginatedData:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;arguments.length>1&&void 0!==arguments[1]&&arguments[1];e=Object.assign(e||this.$route.query,{search:this.resources.search,user_id:r.default.getId()}),this.resources.loading=!0,axios.get(this.api.owned(),{params:e}).then((function(o){t.resources=Object.assign({},t.resources,o.data),t.resources.options=Object.assign(t.resources.options,o.data.meta,e),t.resources.loading=!1,t.$router.push({query:Object.assign({},t.$route.query,e)}).catch((function(t){}))})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){t.resources.data.map((function(t){return Object.assign(t,{loading:!1})}))}))},goToShowTeamPage:function(t){return{name:"teams.show",params:{id:t.id,slug:t.name}}},search:_.debounce((function(t){this.resources.search=t.srcElement.value||"",this.tabletoolbar.isSearching=!1,this.resources.searching&&(this.getPaginatedData(this.options,"search"),this.resources.searching=!1)}),200),focusSearchBar:function(){this.$refs.tablesearch.focus()},bulkTrashResource:function(){var t=this,e=this.selected;axios.delete(s.a.destroy(null),{data:{id:e}}).then((function(e){t.getPaginatedData(null,"bulkTrashResource"),t.tabletoolbar.toggleTrash=!1,t.tabletoolbar.toggleBulkEdit=!1,t.hideDialog(),t.showSnackbar({text:trans_choice("Team successfully moved to trash",t.tabletoolbar.bulkCount)})})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})}))},askUserToDestroyTeam:function(t){var e=this;this.showDialog({color:"warning",illustration:a.default,illustrationWidth:200,illustrationHeight:160,width:"420",title:"You are about to move to trash the selected team.",text:["Some data related to team will still remain.",trans("Are you sure you want to move :name to Trash?",{name:t.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:"Move to Trash",color:"warning",callback:function(o){e.loadDialog(!0),e.destroyResource(t)}}}})},destroyResource:function(t){var e=this;t.loading=!0,axios.delete(s.a.destroy(t.id)).then((function(o){t.active=!1,e.getPaginatedData(null,"destroyResource"),e.showSnackbar({text:trans_choice("Team successfully moved to trash",1)}),e.hideDialog()})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){t.active=!1,t.loading=!1}))},openExportDialog:function(){this.$store.dispatch("dialog/show",{illustration:function(){return Promise.resolve().then(o.bind(null,524))},title:trans("Export Report"),text:[trans("Download the table as PDF file.")],buttons:{action:{text:trans("Export"),callback:function(){var t=r.default.getId();window.location.href="/teams/export?user_id=".concat(t)}}}})}}),watch:{"resources.search":function(t){this.resources.searching=!0},"resources.selected":function(t){this.tabletoolbar.bulkCount=t.length},"tabletoolbar.toggleBulkEdit":function(t){t||(this.resources.selected=[])}}},u=o(0),d=o(2),p=o.n(d),h=o(102),m=o(265),g=o(587),f=o(88),b=o(5),y=o(576),v=Object(u.a)(l,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("admin",[o("metatag",{attrs:{title:t.trans("My Team")}}),t._v(" "),o("page-header",{scopedSlots:t._u([{key:"utilities",fn:function(){return[o("p",{staticClass:"mb-0 muted--text"},[t._v("\n        "+t._s(t.__("Click arrow down icon to view the list of companies per Counselor"))+".\n      ")])]},proxy:!0},{key:"action",fn:function(){return[o("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,color:"primary",large:""},on:{click:t.openExportDialog}},[o("v-icon",{attrs:{left:""}},[t._v("mdi-file-pdf-outline")]),t._v("\n        "+t._s(t.trans("Export"))+"\n      ")],1)]},proxy:!0}])}),t._v(" "),o("div",{directives:[{name:"show",rawName:"v-show",value:t.resourcesIsNotEmpty,expression:"resourcesIsNotEmpty"}]},t._l(t.resources.data,(function(e,s){return o("div",{key:s},[o("h4",{staticClass:"mb-3"},[t._v(t._s(e.name))]),t._v(" "),o("v-card",{staticClass:"mb-4"},[o("v-slide-y-reverse-transition",{attrs:{mode:"out-in"}},[o("v-data-table",{attrs:{"show-expand":"",headers:t.resources.headers,items:e.members,loading:t.resources.loading,"mobile-breakpoint":NaN,options:t.resources.options,"server-items-length":t.resources.meta.total,"show-select":t.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id","single-expand":""},on:{"update:options":[function(e){return t.$set(t.resources,"options",e)},t.optionsChanged]},scopedSlots:t._u([{key:"progress",fn:function(){return[o("span")]},proxy:!0},{key:"expanded-item",fn:function(e){var s=e.headers,r=e.item;return[r.customers.length?[o("td",{attrs:{colspan:s.length}},[t._l(r.customers,(function(e,s){return[o("p",{key:s,staticClass:"my-3"},[o("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(s){var a=s.on;return[o("span",t._g({staticClass:"mt-1"},a),[o("router-link",{staticClass:"text-no-wrap text--decoration-none secondary--text",attrs:{tag:"a",exact:"",to:{name:"teams.reports",params:{customer:e.id,user:r.id},query:{from:t.$route.fullPath}}},domProps:{textContent:t._s(e.name)}})],1)]}}],null,!0)},[t._v(" "),o("span",[t._v(t._s(t.trans("View Reports")))])])],1)]}))],2)]:[o("td",{attrs:{colspan:s.length}},[o("p",{staticClass:"muted--text my-3"},[o("em",{domProps:{textContent:t._s(t.__("No companies found."))}})])])]]}},{key:"loading",fn:function(){return[o("v-slide-y-transition",{attrs:{mode:"out-in"}},[o("div",t._l(t.resources.options.itemsPerPage,(function(t,e){return o("div",{key:e},[o("skeleton-table")],1)})),0)])]},proxy:!0},{key:"item.displayname",fn:function(e){var s=e.item;return[o("can",{attrs:{code:"users.show"},scopedSlots:t._u([{key:"unpermitted",fn:function(){return[o("span",{staticClass:"text-no-wrap text--decoration-none mt-1",domProps:{textContent:t._s(s.displayname)}})]},proxy:!0}],null,!0)},[o("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var r=e.on;return[o("span",t._g({staticClass:"mt-1"},r),[o("router-link",{staticClass:"text-no-wrap text--decoration-none",attrs:{tag:"a",exact:"",to:{name:"users.show",params:{id:s.id},query:{from:t.$route.fullPath}}},domProps:{textContent:t._s(s.displayname)}})],1)]}}],null,!0)},[t._v(" "),o("span",[t._v(t._s(t.trans("View member details")))])])],1)]}}],null,!0),model:{value:t.resources.selected,callback:function(e){t.$set(t.resources,"selected",e)},expression:"resources.selected"}})],1)],1)],1)})),0),t._v(" "),t.resourcesIsEmpty?o("div",[o("toolbar-menu",{attrs:{items:t.tabletoolbar},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search}}),t._v(" "),o("empty-state",{scopedSlots:t._u([{key:"actions",fn:function(){return[o("can",{attrs:{code:"teams.create"}},[o("v-btn",{attrs:{large:"",color:"primary",exact:"",to:{name:"teams.create"}}},[o("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-account-multiple-plus-outline")]),t._v("\n            "+t._s(t.trans("Add Team"))+"\n          ")],1)],1)]},proxy:!0}],null,!1,3909297151)})],1):t._e()],1)}),[],!1,null,null,null);e.default=v.exports;p()(v,{VBtn:h.a,VCard:m.a,VDataTable:g.a,VIcon:f.a,VSlideYReverseTransition:b.i,VSlideYTransition:b.j,VTooltip:y.a})}}]);
//# sourceMappingURL=49.js.map