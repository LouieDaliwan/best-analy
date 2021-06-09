(window.webpackJsonp=window.webpackJsonp||[]).push([[37],{28:function(t,e,s){"use strict";e.a={list:function(){return"/api/v1/users"},store:function(){return"/api/v1/users"},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/delete/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/restore/".concat(t)},trashed:function(){return"/api/v1/users/trashed"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/".concat(t)},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/".concat(t)}}},320:function(t,e,s){"use strict";s.r(e);var r=s(28),o=s(9),a=s(17),n=s(6);function i(t,e){var s=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),s.push.apply(s,r)}return s}function c(t,e,s){return e in t?Object.defineProperty(t,e,{value:s,enumerable:!0,configurable:!0,writable:!0}):t[e]=s,t}var u={data:function(){return{api:r.a,auth:o.default.getUser(),resources:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},meta:{},modes:{bulkedit:!1},selected:[],headers:[{text:trans("Account Name"),align:"left",value:"displayname",class:"text-no-wrap"},{text:trans("Role"),value:"role",class:"text-no-wrap"},{text:trans("Last Modified"),value:"updated_at",class:"text-no-wrap"},{text:trans("Actions"),align:"center",value:"action",sortable:!1,class:"muted--text text-no-wrap"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1}}},computed:{resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},options:function(){return{per_page:this.resources.options.itemsPerPage,page:this.resources.options.page,sort:this.resources.options.sortBy[0]||void 0,order:this.resources.options.sortDesc[0]?"desc":"asc"}},selected:function(){return this.resources.selected.map((function(t){return t.id}))}},mounted:function(){this.changeOptionsFromRouterQueries()},methods:function(t){for(var e=1;e<arguments.length;e++){var s=null!=arguments[e]?arguments[e]:{};e%2?i(Object(s),!0).forEach((function(e){c(t,e,s[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(s)):i(Object(s)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(s,e))}))}return t}({},Object(n.b)({errorDialog:"dialog/error",loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show"}),{changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.resources.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(t){this.getPaginatedData(this.options)},getPaginatedData:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;arguments.length>1&&void 0!==arguments[1]&&arguments[1];e=Object.assign(e||this.$route.query,{search:this.resources.search}),this.resources.loading=!0,axios.get(this.api.list(),{params:e}).then((function(s){t.resources=Object.assign({},t.resources,s.data),t.resources.options=Object.assign(t.resources.options,s.data.meta,e),t.resources.loading=!1,t.$router.push({query:Object.assign({},t.$route.query,e)}).catch((function(t){}))})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){t.resources.data.map((function(t){return Object.assign(t,{loading:!1})}))}))},goToShowUserPage:function(t){return{name:"users.show",params:{id:t.id,slug:t.username}}},search:_.debounce((function(t){this.resources.search=t.srcElement.value||"",this.tabletoolbar.isSearching=!1,this.resources.searching&&(this.getPaginatedData(this.options,"search"),this.resources.searching=!1)}),200),focusSearchBar:function(){this.$refs.tablesearch.focus()},bulkTrashResource:function(){var t=this,e=this.selected;axios.delete(r.a.destroy(null),{data:{id:e}}).then((function(e){t.getPaginatedData(null,"bulkTrashResource"),t.tabletoolbar.toggleTrash=!1,t.tabletoolbar.toggleBulkEdit=!1,t.hideDialog(),t.showSnackbar({text:trans_choice("User successfully deactivated",t.tabletoolbar.bulkCount)})})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})}))},askUserToDestroyUser:function(t){var e=this;this.showDialog({color:"warning",illustration:a.default,illustrationWidth:200,illustrationHeight:160,width:"420",title:"You are about to move to trash the selected user.",text:["The user will be signed out from the app. Some data related to the account like comments and files will still remain.",trans("Are you sure you want to move :name to Trash?",{name:t.displayname})],buttons:{cancel:{show:!0,color:"link"},action:{text:"Move to Trash",color:"warning",callback:function(s){e.loadDialog(!0),e.destroyResource(t)}}}})},destroyResource:function(t){var e=this;t.loading=!0,axios.delete(r.a.destroy(t.id)).then((function(s){t.active=!1,e.getPaginatedData(null,"destroyResource"),e.showSnackbar({text:trans_choice("User successfully deactivated",1)}),e.hideDialog()})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){t.active=!1,t.loading=!1}))}}),watch:{"resources.search":function(t){this.resources.searching=!0},"resources.selected":function(t){this.tabletoolbar.bulkCount=t.length},"tabletoolbar.toggleBulkEdit":function(t){t||(this.resources.selected=[])}}},l=s(0),d=s(2),p=s.n(d),h=s(264),v=s(587),g=s(104),f=s(262),m=s(597),b=s(91),y=s(125),w=s(5),k=s(588),x=Object(l.a)(u,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("admin",[s("metatag",{attrs:{title:t.trans("All Users")}}),t._v(" "),s("page-header",{scopedSlots:t._u([{key:"action",fn:function(){return[s("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,large:"",color:"primary",exact:"",to:{name:"users.create"}}},[s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-account-plus-outline")]),t._v("\n        "+t._s(t.trans("Add User"))+"\n      ")],1)]},proxy:!0}])},[s("can",{attrs:{code:"users.trashed"},scopedSlots:t._u([{key:"utilities",fn:function(){return[s("router-link",{staticClass:"dt-link text--decoration-none mr-4",attrs:{tag:"a",exact:"",to:{name:"users.trashed"}}},[s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-account-off-outline")]),t._v("\n          "+t._s(t.trans("Deactivated Users"))+"\n        ")],1)]},proxy:!0}])})],1),t._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:t.resourcesIsNotEmpty,expression:"resourcesIsNotEmpty"}]},[s("v-card",[s("toolbar-menu",{attrs:{items:t.tabletoolbar,bulk:"",downloadable:"",trashable:""},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search,"update:trash":t.bulkTrashResource}}),t._v(" "),s("v-slide-y-reverse-transition",{attrs:{mode:"out-in"}},[s("v-data-table",{attrs:{headers:t.resources.headers,items:t.resources.data,loading:t.resources.loading,"mobile-breakpoint":NaN,options:t.resources.options,"server-items-length":t.resources.meta.total,"show-select":t.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id"},on:{"update:options":[function(e){return t.$set(t.resources,"options",e)},t.optionsChanged]},scopedSlots:t._u([{key:"progress",fn:function(){return[s("span")]},proxy:!0},{key:"loading",fn:function(){return[s("v-slide-y-transition",{attrs:{mode:"out-in"}},[s("div",t._l(t.resources.options.itemsPerPage,(function(t,e){return s("div",{key:e},[s("skeleton-avatar-table")],1)})),0)])]},proxy:!0},{key:"item.displayname",fn:function(e){var r=e.item;return[s("div",{staticClass:"d-flex align-items-center"},[t.auth.id==r.id?s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var o=e.on;return[s("v-badge",{attrs:{avatar:"",bordered:"",color:"muted","offset-x":"35","offset-y":"15",overlap:""},scopedSlots:t._u([{key:"badge",fn:function(){return[s("v-avatar",[s("i",{staticClass:"small mdi mdi-home-account",staticStyle:{"font-size":"12px"}})])]},proxy:!0}],null,!0)},[t._v(" "),s("v-avatar",t._g({staticClass:"mr-6",attrs:{size:"32",color:"workspace"}},o),[s("v-img",{attrs:{src:r.avatar}})],1)],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("This is your account")))])]):s("v-avatar",{staticClass:"mr-6",attrs:{size:"32",color:"workspace"}},[s("v-img",{attrs:{src:r.avatar}})],1),t._v(" "),s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var o=e.on;return[s("span",t._g({staticClass:"mt-1"},o),[s("router-link",{staticClass:"text-no-wrap text--decoration-none",attrs:{tag:"a",exact:"",to:t.goToShowUserPage(r)},domProps:{textContent:t._s(r.displayname)}})],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("View Details")))])])],1)]}},{key:"item.updated_at",fn:function(e){var r=e.item;return[s("span",{staticClass:"text-no-wrap",attrs:{title:r.updated_at}},[t._v(t._s(t.trans(r.modified)))])]}},{key:"item.action",fn:function(e){var r=e.item;return[s("div",{staticClass:"text-no-wrap"},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var o=e.on;return[s("v-btn",t._g({attrs:{to:{name:"users.edit",params:{id:r.id}},icon:""}},o),[s("v-icon",{attrs:{small:""}},[t._v("mdi-pencil-outline")])],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("Edit this user")))])]),t._v(" "),s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var o=e.on;return[s("v-btn",t._g({attrs:{icon:""},on:{click:function(e){return t.askUserToDestroyUser(r)}}},o),[s("v-icon",{attrs:{small:""}},[t._v("mdi-delete-outline")])],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("Deactivate user")))])])],1)]}}]),model:{value:t.resources.selected,callback:function(e){t.$set(t.resources,"selected",e)},expression:"resources.selected"}})],1)],1)],1),t._v(" "),t.resourcesIsEmpty?s("div",[s("toolbar-menu",{attrs:{items:t.tabletoolbar},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search}}),t._v(" "),s("empty-state",{scopedSlots:t._u([{key:"actions",fn:function(){return[s("v-btn",{attrs:{large:"",color:"primary",exact:"",to:{name:"users.create"}}},[s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-account-plus-outline")]),t._v("\n          "+t._s(t.trans("Add user"))+"\n        ")],1)]},proxy:!0}],null,!1,2367922881)})],1):t._e()],1)}),[],!1,null,null,null);e.default=x.exports;p()(x,{VAvatar:h.a,VBadge:v.a,VBtn:g.a,VCard:f.a,VDataTable:m.a,VIcon:b.a,VImg:y.a,VSlideYReverseTransition:w.i,VSlideYTransition:w.j,VTooltip:k.a})}}]);
//# sourceMappingURL=37.js.map