(window.webpackJsonp=window.webpackJsonp||[]).push([[51],{324:function(e,t,s){"use strict";s.r(t);var o=s(17),r=s(12),a=s(20),n=s(6);function i(e,t){var s=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),s.push.apply(s,o)}return s}function c(e,t,s){return t in e?Object.defineProperty(e,t,{value:s,enumerable:!0,configurable:!0,writable:!0}):e[t]=s,e}var u={computed:{resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},options:function(){return{per_page:this.resources.options.itemsPerPage,page:this.resources.options.page,sort:this.resources.options.sortBy[0]||void 0,order:this.resources.options.sortDesc[0]?"desc":"asc"}},selected:function(){return this.resources.selected.map((function(e){return e.id}))}},data:function(){return{api:o.a,auth:r.default.getUser(),resources:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},meta:{},modes:{bulkedit:!1},selected:[],headers:[{text:trans("Member Name"),align:"left",value:"displayname",class:"text-no-wrap"},{text:trans("Companies"),align:"center",value:"customers:count",class:"text-no-wrap"},{text:trans("No. of Reports"),align:"center",value:"reports:count",class:"text-no-wrap"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1}}},mounted:function(){this.changeOptionsFromRouterQueries(),this.getPaginatedData()},methods:function(e){for(var t=1;t<arguments.length;t++){var s=null!=arguments[t]?arguments[t]:{};t%2?i(Object(s),!0).forEach((function(t){c(e,t,s[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(s)):i(Object(s)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(s,t))}))}return e}({},Object(n.b)({errorDialog:"dialog/error",loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show"}),{changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.resources.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(e){this.getPaginatedData(this.options)},getPaginatedData:function(){var e=this,t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;arguments.length>1&&void 0!==arguments[1]&&arguments[1];t=Object.assign(t||this.$route.query,{search:this.resources.search,user_id:r.default.getId()}),this.resources.loading=!0,axios.get(this.api.owned(),{params:t}).then((function(s){e.resources=Object.assign({},e.resources,s.data),e.resources.options=Object.assign(e.resources.options,s.data.meta,t),e.resources.loading=!1,e.$router.push({query:Object.assign({},e.$route.query,t)}).catch((function(e){}))})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){e.resources.data.map((function(e){return Object.assign(e,{loading:!1})}))}))},goToShowTeamPage:function(e){return{name:"teams.show",params:{id:e.id,slug:e.name}}},search:_.debounce((function(e){this.resources.search=e.srcElement.value||"",this.tabletoolbar.isSearching=!1,this.resources.searching&&(this.getPaginatedData(this.options,"search"),this.resources.searching=!1)}),200),focusSearchBar:function(){this.$refs.tablesearch.focus()},bulkTrashResource:function(){var e=this,t=this.selected;axios.delete(o.a.destroy(null),{data:{id:t}}).then((function(t){e.getPaginatedData(null,"bulkTrashResource"),e.tabletoolbar.toggleTrash=!1,e.tabletoolbar.toggleBulkEdit=!1,e.hideDialog(),e.showSnackbar({text:trans_choice("Team successfully moved to trash",e.tabletoolbar.bulkCount)})})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})}))},askUserToDestroyTeam:function(e){var t=this;this.showDialog({color:"warning",illustration:a.default,illustrationWidth:200,illustrationHeight:160,width:"420",title:"You are about to move to trash the selected team.",text:["Some data related to team will still remain.",trans("Are you sure you want to move :name to Trash?",{name:e.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:"Move to Trash",color:"warning",callback:function(s){t.loadDialog(!0),t.destroyResource(e)}}}})},destroyResource:function(e){var t=this;e.loading=!0,axios.delete(o.a.destroy(e.id)).then((function(s){e.active=!1,t.getPaginatedData(null,"destroyResource"),t.showSnackbar({text:trans_choice("Team successfully moved to trash",1)}),t.hideDialog()})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){e.active=!1,e.loading=!1}))}}),watch:{"resources.search":function(e){this.resources.searching=!0},"resources.selected":function(e){this.tabletoolbar.bulkCount=e.length},"tabletoolbar.toggleBulkEdit":function(e){e||(this.resources.selected=[])}}},l=s(1),d=s(2),p=s.n(d),h=s(105),m=s(278),g=s(595),f=s(90),b=s(5),y=s(585),v=Object(l.a)(u,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("admin",[s("metatag",{attrs:{title:e.trans("All Team")}}),e._v(" "),s("page-header",{scopedSlots:e._u([{key:"utilities",fn:function(){return[s("p",{staticClass:"mb-0 muted--text"},[e._v("\n        "+e._s(e.__("Click arrow down icon to view the list of companies per Counselor"))+".\n      ")])]},proxy:!0}])}),e._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:e.resourcesIsNotEmpty,expression:"resourcesIsNotEmpty"}]},e._l(e.resources.data,(function(t,o){return s("v-card",{key:o},[s("v-slide-y-reverse-transition",{attrs:{mode:"out-in"}},[s("v-data-table",{attrs:{"show-expand":"",headers:e.resources.headers,items:t.members,loading:e.resources.loading,"mobile-breakpoint":NaN,options:e.resources.options,"server-items-length":e.resources.meta.total,"show-select":e.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id","single-expand":""},on:{"update:options":[function(t){return e.$set(e.resources,"options",t)},e.optionsChanged]},scopedSlots:e._u([{key:"progress",fn:function(){return[s("span")]},proxy:!0},{key:"expanded-item",fn:function(t){var o=t.headers,r=t.item;return[r.customers.length?[s("td",{attrs:{colspan:o.length}},[e._l(r.customers,(function(t,o){return[s("p",{key:o,staticClass:"my-3"},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(o){var a=o.on;return[s("span",e._g({staticClass:"mt-1"},a),[s("router-link",{staticClass:"text-no-wrap text--decoration-none secondary--text",attrs:{tag:"a",exact:"",to:{name:"teams.reports",params:{customer:t.id,user:r.id},query:{from:e.$route.fullPath}}},domProps:{textContent:e._s(t.name)}})],1)]}}],null,!0)},[e._v(" "),s("span",[e._v(e._s(e.trans("View Reports")))])])],1)]}))],2)]:[s("td",{attrs:{colspan:o.length}},[s("p",{staticClass:"muted--text my-3"},[s("em",{domProps:{textContent:e._s(e.__("No companies found."))}})])])]]}},{key:"loading",fn:function(){return[s("v-slide-y-transition",{attrs:{mode:"out-in"}},[s("div",e._l(e.resources.options.itemsPerPage,(function(e,t){return s("div",{key:t},[s("skeleton-table")],1)})),0)])]},proxy:!0},{key:"item.displayname",fn:function(t){var o=t.item;return[s("can",{attrs:{code:"users.show"},scopedSlots:e._u([{key:"unpermitted",fn:function(){return[s("span",{staticClass:"text-no-wrap text--decoration-none mt-1",domProps:{textContent:e._s(o.displayname)}})]},proxy:!0}],null,!0)},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(t){var r=t.on;return[s("span",e._g({staticClass:"mt-1"},r),[s("router-link",{staticClass:"text-no-wrap text--decoration-none",attrs:{tag:"a",exact:"",to:{name:"users.show",params:{id:o.id},query:{from:e.$route.fullPath}}},domProps:{textContent:e._s(o.displayname)}})],1)]}}],null,!0)},[e._v(" "),s("span",[e._v(e._s(e.trans("View member details")))])])],1)]}}],null,!0),model:{value:e.resources.selected,callback:function(t){e.$set(e.resources,"selected",t)},expression:"resources.selected"}})],1)],1)})),1),e._v(" "),e.resourcesIsEmpty?s("div",[s("empty-state",{scopedSlots:e._u([{key:"actions",fn:function(){return[s("can",{attrs:{code:"teams.create"}},[s("v-btn",{attrs:{large:"",color:"primary",exact:"",to:{name:"teams.create"}}},[s("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-account-multiple-plus-outline")]),e._v("\n            "+e._s(e.trans("Add Team"))+"\n          ")],1)],1)]},proxy:!0}],null,!1,3909297151)})],1):e._e()],1)}),[],!1,null,null,null);t.default=v.exports;p()(v,{VBtn:h.a,VCard:m.a,VDataTable:g.a,VIcon:f.a,VSlideYReverseTransition:b.i,VSlideYTransition:b.j,VTooltip:y.a})}}]);
//# sourceMappingURL=51.js.map