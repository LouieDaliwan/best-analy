(window.webpackJsonp=window.webpackJsonp||[]).push([[28],{27:function(t,e,o){"use strict";e.a={list:function(){return"/api/v1/indices"},store:function(){return"/api/v1/indices"},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/delete/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/restore/".concat(t)},trashed:function(){return"/api/v1/indices/trashed"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(t)},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(t)},translation:function(){return"/api/v1/best/settings/translations/keys"}}},323:function(t,e,o){"use strict";o.r(e);var s=o(27),r=o(17),n=o(6);function a(t,e){var o=Object.keys(t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(t);e&&(s=s.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),o.push.apply(o,s)}return o}function i(t,e,o){return e in t?Object.defineProperty(t,e,{value:o,enumerable:!0,configurable:!0,writable:!0}):t[e]=o,t}var c={computed:{resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},options:function(){return{per_page:this.resources.options.itemsPerPage,page:this.resources.options.page,sort:this.resources.options.sortBy[0]||void 0,order:this.resources.options.sortDesc[0]?"desc":"asc"}},selected:function(){return this.resources.selected.map((function(t){return t.id}))}},data:function(){return{api:s.a,resources:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},meta:{},modes:{bulkedit:!1},selected:[],headers:[{text:trans("Name"),align:"left",value:"name",class:"text-no-wrap"},{text:trans("Weightage"),align:"center",value:"metadata[weightage]",class:"text-no-wrap"},{text:trans("Description"),align:"left",value:"description",class:"text-no-wrap"},{text:trans("Last Modified"),value:"updated_at",class:"text-no-wrap"},{text:trans("Actions"),align:"center",value:"action",sortable:!1,class:"muted--text text-no-wrap"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1}}},mounted:function(){this.changeOptionsFromRouterQueries()},methods:function(t){for(var e=1;e<arguments.length;e++){var o=null!=arguments[e]?arguments[e]:{};e%2?a(Object(o),!0).forEach((function(e){i(t,e,o[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(o)):a(Object(o)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(o,e))}))}return t}({},Object(n.b)({errorDialog:"dialog/error",loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show"}),{changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.resources.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(t){this.getPaginatedData(this.options)},getPaginatedData:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;arguments.length>1&&void 0!==arguments[1]&&arguments[1];e=Object.assign(e||this.$route.query,{search:this.resources.search}),this.resources.loading=!0,axios.get(this.api.list(),{params:e}).then((function(o){t.resources=Object.assign({},t.resources,o.data),t.resources.options=Object.assign(t.resources.options,o.data.meta,e),t.resources.loading=!1,t.$router.push({query:Object.assign({},t.$route.query,e)}).catch((function(t){}))})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){t.resources.data.map((function(t){return Object.assign(t,{loading:!1})}))}))},search:_.debounce((function(t){this.resources.search=t.srcElement.value||"",this.tabletoolbar.isSearching=!1,this.resources.searching&&(this.getPaginatedData(this.options,"search"),this.resources.searching=!1)}),200),focusSearchBar:function(){this.$refs.tablesearch.focus()},bulkTrashResource:function(){var t=this,e=this.selected;axios.delete(s.a.destroy(null),{data:{id:e}}).then((function(e){t.getPaginatedData(null,"bulkTrashResource"),t.tabletoolbar.toggleTrash=!1,t.tabletoolbar.toggleBulkEdit=!1,t.hideDialog(),t.showSnackbar({text:trans_choice("Component successfully moved to trash",t.tabletoolbar.bulkCount)})})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})}))},askUserToDestroyComponent:function(t){var e=this;this.showDialog({color:"warning",illustration:r.default,illustrationWidth:200,illustrationHeight:160,width:"420",title:"You are about to move to trash the selected index.",text:["Some data related to index will still remain.",trans("Are you sure you want to move :name to Trash?",{name:t.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:"Move to Trash",color:"warning",callback:function(o){e.loadDialog(!0),e.destroyResource(t)}}}})},destroyResource:function(t){var e=this;t.loading=!0,axios.delete(s.a.destroy(t.id)).then((function(o){t.active=!1,e.getPaginatedData(null,"destroyResource"),e.showSnackbar({text:trans_choice("Component successfully moved to trash",1)}),e.hideDialog()})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){t.active=!1,t.loading=!1}))}}),watch:{"resources.search":function(t){this.resources.searching=!0},"resources.selected":function(t){this.tabletoolbar.bulkCount=t.length},"tabletoolbar.toggleBulkEdit":function(t){t||(this.resources.selected=[])}}},l=o(0),u=o(2),d=o.n(u),p=o(280),h=o(112),g=o(278),v=o(628),m=o(98),f=o(134),b=o(5),y=o(617),w=Object(l.a)(c,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("admin",[o("metatag",{attrs:{title:t.trans("All Component")}}),t._v(" "),o("page-header",{scopedSlots:t._u([{key:"utilities",fn:function(){return[o("router-link",{staticClass:"dt-link text--decoration-none mr-4",attrs:{tag:"a",exact:"",to:{name:"indices.trashed"}}},[o("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-delete-outline")]),t._v("\n        "+t._s(t.trans("Trashed Component"))+"\n      ")],1)]},proxy:!0},{key:"action",fn:function(){return[o("can",{attrs:{code:"indices.create"}},[o("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,large:"",color:"primary",exact:"",to:{name:"indices.create"}}},[o("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-credit-card-plus-outline")]),t._v("\n          "+t._s(t.trans("Add Component"))+"\n        ")],1)],1)]},proxy:!0}])}),t._v(" "),o("div",{directives:[{name:"show",rawName:"v-show",value:t.resourcesIsNotEmpty,expression:"resourcesIsNotEmpty"}]},[o("v-card",[o("toolbar-menu",{attrs:{items:t.tabletoolbar,bulk:"",downloadable:"",trashable:""},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search,"update:trash":t.bulkTrashResource}}),t._v(" "),o("v-slide-y-reverse-transition",{attrs:{mode:"out-in"}},[o("v-data-table",{attrs:{headers:t.resources.headers,items:t.resources.data,loading:t.resources.loading,"mobile-breakpoint":NaN,options:t.resources.options,"server-items-length":t.resources.meta.total,"show-select":t.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id"},on:{"update:options":[function(e){return t.$set(t.resources,"options",e)},t.optionsChanged]},scopedSlots:t._u([{key:"progress",fn:function(){return[o("span")]},proxy:!0},{key:"loading",fn:function(){return[o("v-slide-y-transition",{attrs:{mode:"out-in"}},[o("div",t._l(t.resources.options.itemsPerPage,(function(t,e){return o("div",{key:e},[o("skeleton-table")],1)})),0)])]},proxy:!0},{key:"item.name",fn:function(e){var s=e.item;return[o("div",{staticClass:"d-flex align-center"},[o("v-avatar",{staticClass:"mr-6",attrs:{size:"32",tile:""}},[o("v-img",{attrs:{src:s.icon}})],1),t._v(" "),o("span",{staticClass:"text-no-wrap"},[t._v(t._s(t.trans(s.name)))])],1)]}},{key:"item.description",fn:function(e){var s=e.item;return[o("v-tooltip",{attrs:{bottom:"",transition:"scroll-y-transition","max-width":"300"},scopedSlots:t._u([{key:"activator",fn:function(e){var r=e.on;return[o("span",t._g({staticClass:"text--ellipsis-1"},r),[t._v(t._s(t.trans(s.description)))])]}}],null,!0)},[t._v(" "),o("span",[t._v(t._s(t.trans(s.description)))])])]}},{key:"item.updated_at",fn:function(e){var s=e.item;return[o("span",{staticClass:"text-no-wrap",attrs:{title:s.updated_at}},[t._v(t._s(t.trans(s.modified)))])]}},{key:"item.action",fn:function(e){var s=e.item;return[o("div",{staticClass:"text-no-wrap"},[o("can",{attrs:{code:"indices.edit"}},[o("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var r=e.on;return[o("v-btn",t._g({attrs:{to:{name:"indices.edit",params:{id:s.id}},icon:""}},r),[o("v-icon",{attrs:{small:""}},[t._v("mdi-pencil-outline")])],1)]}}],null,!0)},[t._v(" "),o("span",[t._v(t._s(t.trans("Edit this component")))])])],1),t._v(" "),o("can",{attrs:{code:"indices.destroy"}},[o("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var r=e.on;return[o("v-btn",t._g({attrs:{icon:""},on:{click:function(e){return t.askUserToDestroyComponent(s)}}},r),[o("v-icon",{attrs:{small:""}},[t._v("mdi-delete-outline")])],1)]}}],null,!0)},[t._v(" "),o("span",[t._v(t._s(t.trans("Move to trash")))])])],1)],1)]}}]),model:{value:t.resources.selected,callback:function(e){t.$set(t.resources,"selected",e)},expression:"resources.selected"}})],1)],1)],1),t._v(" "),t.resourcesIsEmpty?o("div",[o("toolbar-menu",{attrs:{items:t.tabletoolbar},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search}}),t._v(" "),o("empty-state",{scopedSlots:t._u([{key:"actions",fn:function(){return[o("v-btn",{attrs:{large:"",color:"primary",exact:"",to:{name:"indices.create"}}},[o("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-account-plus-outline")]),t._v("\n          "+t._s(t.trans("Add Component"))+"\n        ")],1)]},proxy:!0}],null,!1,1882461314)})],1):t._e()],1)}),[],!1,null,null,null);e.default=w.exports;d()(w,{VAvatar:p.a,VBtn:h.a,VCard:g.a,VDataTable:v.a,VIcon:m.a,VImg:f.a,VSlideYReverseTransition:b.j,VSlideYTransition:b.k,VTooltip:y.a})}}]);
//# sourceMappingURL=28.js.map