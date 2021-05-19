(window.webpackJsonp=window.webpackJsonp||[]).push([[47],{299:function(t,e,s){"use strict";s.r(e);var o,r=s(25),a=s(17),n=s(6);function i(t,e){var s=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),s.push.apply(s,o)}return s}function c(t,e,s){return e in t?Object.defineProperty(t,e,{value:s,enumerable:!0,configurable:!0,writable:!0}):t[e]=s,t}var l=(c(o={computed:{resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},options:function(){return{per_page:this.resources.options.itemsPerPage,page:this.resources.options.page,sort:this.resources.options.sortBy[0]||void 0,order:this.resources.options.sortDesc[0]?"desc":"asc"}},selected:function(){return this.resources.selected.map((function(t){return t.id}))}},data:function(){return{api:r.a,resources:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},meta:{},modes:{bulkedit:!1},selected:[],headers:[{text:trans("Role Name"),align:"left",value:"name",class:"text-no-wrap"},{text:trans("Code"),align:"left",value:"code",class:"text-no-wrap"},{text:trans("Permissions"),align:"left",value:"status",class:"text-no-wrap"},{text:trans("Last Modified"),value:"updated_at",class:"text-no-wrap"},{text:trans("Actions"),align:"center",value:"action",sortable:!1,class:"muted--text text-no-wrap"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1}}}},"computed",{resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},options:function(){return{per_page:this.resources.options.itemsPerPage,page:this.resources.options.page,sort:this.resources.options.sortBy[0]||void 0,order:this.resources.options.sortDesc[0]?"desc":"asc"}},selected:function(){return this.resources.selected.map((function(t){return t.id}))}}),c(o,"mounted",(function(){this.changeOptionsFromRouterQueries()})),c(o,"methods",function(t){for(var e=1;e<arguments.length;e++){var s=null!=arguments[e]?arguments[e]:{};e%2?i(Object(s),!0).forEach((function(e){c(t,e,s[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(s)):i(Object(s)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(s,e))}))}return t}({},Object(n.b)({errorDialog:"dialog/error",loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show"}),{changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.resources.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(t){this.getPaginatedData(this.options)},getPaginatedData:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;arguments.length>1&&void 0!==arguments[1]&&arguments[1];e=Object.assign(e||this.$route.query,{search:this.resources.search}),this.resources.loading=!0,axios.get(this.api.list(),{params:e}).then((function(s){t.resources=Object.assign({},t.resources,s.data),t.resources.options=Object.assign(t.resources.options,s.data.meta,e),t.resources.loading=!1,t.$router.push({query:Object.assign({},t.$route.query,e)}).catch((function(t){}))})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){t.resources.data.map((function(t){return Object.assign(t,{loading:!1})}))}))},goToShowRolePage:function(t){return{name:"roles.show",params:{id:t.id,slug:t.rolename}}},search:_.debounce((function(t){this.resources.search=t.srcElement.value||"",this.tabletoolbar.isSearching=!1,this.resources.searching&&(this.getPaginatedData(this.options,"search"),this.resources.searching=!1)}),200),focusSearchBar:function(){this.$refs.tablesearch.focus()},bulkTrashResource:function(){var t=this,e=this.selected;axios.delete(r.a.destroy(null),{data:{id:e}}).then((function(e){t.getPaginatedData(null,"bulkTrashResource"),t.tabletoolbar.toggleTrash=!1,t.tabletoolbar.toggleBulkEdit=!1,t.hideDialog(),t.showSnackbar({text:trans_choice("Role successfully moved to trash",t.tabletoolbar.bulkCount)})})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})}))},askUserToDestroyRole:function(t){var e=this;this.showDialog({color:"warning",illustration:a.default,illustrationWidth:200,illustrationHeight:160,width:"420",title:"You are about to move to trash the selected role.",text:["The user will be signed out from the app. Some data related to the account like comments and files will still remain.",trans("Are you sure you want to move :name to Trash?",{name:t.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:"Move to Trash",color:"warning",callback:function(s){e.loadDialog(!0),e.destroyResource(t)}}}})},destroyResource:function(t){var e=this;t.loading=!0,axios.delete(r.a.destroy(t.id)).then((function(s){t.active=!1,e.getPaginatedData(null,"destroyResource"),e.showSnackbar({text:trans_choice("Role successfully moved to trash",1)}),e.hideDialog()})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){t.active=!1,t.loading=!1}))}})),c(o,"mounted",(function(){this.changeOptionsFromRouterQueries()})),c(o,"watch",{"resources.search":function(t){this.resources.searching=!0},"resources.selected":function(t){this.tabletoolbar.bulkCount=t.length},"tabletoolbar.toggleBulkEdit":function(t){t||(this.resources.selected=[])}}),o),u=s(0),d=s(2),h=s.n(d),p=s(104),g=s(262),m=s(597),f=s(91),b=s(5),v=s(588),y=Object(u.a)(l,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("admin",[s("metatag",{attrs:{title:t.trans("All Roles")}}),t._v(" "),s("page-header",{scopedSlots:t._u([{key:"utilities",fn:function(){return[s("router-link",{staticClass:"dt-link text--decoration-none mr-4",attrs:{tag:"a",exact:"",to:{name:"roles.trashed"}}},[s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-delete-outline")]),t._v("\n        "+t._s(t.trans("Trashed Roles"))+"\n      ")],1)]},proxy:!0},{key:"action",fn:function(){return[s("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,large:"",color:"primary",exact:"",to:{name:"roles.create"}}},[s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-shield-plus-outline")]),t._v("\n        "+t._s(t.trans("Add Role"))+"\n      ")],1)]},proxy:!0}])}),t._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:t.resourcesIsNotEmpty,expression:"resourcesIsNotEmpty"}]},[s("v-card",[s("toolbar-menu",{attrs:{items:t.tabletoolbar,bulk:"",downloadable:"",trashable:""},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search,"update:trash":t.bulkTrashResource}}),t._v(" "),s("v-slide-y-reverse-transition",{attrs:{mode:"out-in"}},[s("v-data-table",{attrs:{headers:t.resources.headers,items:t.resources.data,loading:t.resources.loading,"mobile-breakpoint":NaN,options:t.resources.options,"server-items-length":t.resources.meta.total,"show-select":t.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id"},on:{"update:options":[function(e){return t.$set(t.resources,"options",e)},t.optionsChanged]},scopedSlots:t._u([{key:"progress",fn:function(){return[s("span")]},proxy:!0},{key:"loading",fn:function(){return[s("v-slide-y-transition",{attrs:{mode:"out-in"}},[s("div",t._l(t.resources.options.itemsPerPage,(function(t,e){return s("div",{key:e},[s("skeleton-table")],1)})),0)])]},proxy:!0},{key:"item.name",fn:function(e){var o=e.item;return[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var r=e.on;return[s("span",t._g({staticClass:"mt-1"},r),[s("router-link",{staticClass:"text-no-wrap text--decoration-none",attrs:{tag:"a",exact:"",to:t.goToShowRolePage(o)},domProps:{textContent:t._s(o.name)}})],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("View Details")))])])]}},{key:"item.status",fn:function(e){var o=e.item;return[s("span",{staticClass:"text-no-wrap",attrs:{title:o.status}},[t._v(t._s(t.trans(o.status)))])]}},{key:"item.updated_at",fn:function(e){var o=e.item;return[s("span",{staticClass:"text-no-wrap",attrs:{title:o.updated_at}},[t._v(t._s(t.trans(o.modified)))])]}},{key:"item.action",fn:function(e){var o=e.item;return[s("div",{staticClass:"text-no-wrap"},[s("can",{attrs:{code:"roles.edit"}},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var r=e.on;return[s("v-btn",t._g({attrs:{to:{name:"roles.edit",params:{id:o.id}},icon:""}},r),[s("v-icon",{attrs:{small:""}},[t._v("mdi-pencil-outline")])],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("Edit this role")))])])],1),t._v(" "),s("can",{attrs:{code:"roles.destroy"}},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var r=e.on;return[s("v-btn",t._g({attrs:{icon:""},on:{click:function(e){return t.askUserToDestroyRole(o)}}},r),[s("v-icon",{attrs:{small:""}},[t._v("mdi-delete-outline")])],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("Move to trash")))])])],1)],1)]}}]),model:{value:t.resources.selected,callback:function(e){t.$set(t.resources,"selected",e)},expression:"resources.selected"}})],1)],1)],1),t._v(" "),t.resourcesIsEmpty?s("div",[s("toolbar-menu",{attrs:{items:t.tabletoolbar},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search}}),t._v(" "),s("empty-state",{scopedSlots:t._u([{key:"actions",fn:function(){return[s("v-btn",{attrs:{to:{name:"roles.create"},color:"primary",exact:"",large:""}},[s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-account-plus-outline")]),t._v("\n          "+t._s(t.trans("Add role"))+"\n        ")],1)]},proxy:!0}],null,!1,1161484225)})],1):t._e()],1)}),[],!1,null,null,null);e.default=y.exports;h()(y,{VBtn:p.a,VCard:g.a,VDataTable:m.a,VIcon:f.a,VSlideYReverseTransition:b.i,VSlideYTransition:b.j,VTooltip:v.a})}}]);
//# sourceMappingURL=47.js.map