(window.webpackJsonp=window.webpackJsonp||[]).push([[13],{257:function(t,e,a){"use strict";a.r(e);var s=a(47),o=(a(21),{data:function(){return{api:s.a,dataset:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10},meta:{},headers:[{text:trans("Name"),align:"left",value:"name"},{text:trans("Reference Number"),value:"refnum"},{text:trans("Status"),value:"status"},{text:trans("Last Modified"),align:"center",value:"updated_at"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1}}},computed:{options:function(){return{per_page:this.dataset.options.itemsPerPage,page:this.dataset.options.page,sort:this.dataset.options.sortBy[0]||void 0,order:this.dataset.options.sortDesc[0]?"desc":"asc"}}},mounted:function(){this.changeOptionsFromRouterQueries()},methods:{changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.dataset.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(t){this.getPaginatedData(this.options,"optionsChaned")},getPaginatedData:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;arguments.length>1&&void 0!==arguments[1]&&arguments[1];e=Object.assign(e||this.$route.query,{search:this.dataset.search}),this.dataset.loading=!0,axios.get(this.api.list(),{params:e}).then((function(a){t.dataset=Object.assign({},t.dataset,a.data),t.dataset.options=Object.assign(t.dataset.options,a.data.meta,e),t.dataset.loading=!1,t.$router.push({query:Object.assign({},t.$route.query,e)}).catch((function(t){}))})).catch((function(e){t.$store.dispatch("dialog/error",{show:!0,width:400,color:"error",buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){t.dataset.data.map((function(t){return Object.assign(t,{loading:!1})}))}))},goToShowCustomerPage:function(t){return{name:"customers.show",params:{id:t.id,slug:t.customername}}},search:_.debounce((function(t){this.dataset.search=t.srcElement.value||"",this.tabletoolbar.isSearching=!1,this.dataset.searching&&(this.getPaginatedData(this.options,"search"),this.dataset.searching=!1)}),200),focusSearchBar:function(){this.$refs.tablesearch.focus()}},watch:{"dataset.search":function(t){this.dataset.searching=!0}}}),n=a(1),i=a(3),r=a.n(i),c=a(81),u=a(247),d=a(494),l=a(67),h=a(493),p=a(7),g=a(486),m=Object(n.a)(o,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("admin",[a("metatag",{attrs:{title:t.trans("My Customers")}}),t._v(" "),a("page-header",{scopedSlots:t._u([{key:"title",fn:function(){return[a("div",{staticClass:"mt-1"},[t._v(t._s(t.__("My Customers")))])]},proxy:!0},{key:"action",fn:function(){return[a("v-btn",{attrs:{large:"",color:"primary",exact:"",to:{name:"customers.search"}}},[a("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-file-document-box-search-outline")]),t._v("\n        "+t._s(t.trans("Generate Report"))+"\n      ")],1)]},proxy:!0}])}),t._v(" "),a("v-card",[a("toolbar-menu",{attrs:{items:t.tabletoolbar,downloadable:"",trashable:""},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search}}),t._v(" "),a("v-slide-y-reverse-transition",{attrs:{mode:"out-in"}},[a("v-data-table",{attrs:{headers:t.dataset.headers,items:t.dataset.data,loading:t.dataset.loading,"mobile-breakpoint":NaN,options:t.dataset.options,"server-items-length":t.dataset.meta.total,"show-select":t.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id"},on:{"update:options":[function(e){return t.$set(t.dataset,"options",e)},t.optionsChanged]},scopedSlots:t._u([{key:"progress",fn:function(){return[a("span")]},proxy:!0},{key:"loading",fn:function(){return[a("v-slide-y-transition",{attrs:{mode:"out-in"}},[a("div",t._l(t.dataset.options.itemsPerPage,(function(t,e){return a("div",{key:e,staticClass:"d-flex"},[a("v-skeleton-loader",{staticClass:"px-4 py-3",attrs:{width:"100%",type:"table-row"}})],1)})),0)])]},proxy:!0},{key:"item.name",fn:function(e){var s=e.item;return[a("div",{staticClass:"d-flex align-items-center"},[a("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var o=e.on;return[a("span",t._g({staticClass:"mt-1"},o),[a("router-link",{staticClass:"text-no-wrap text--decoration-none",attrs:{tag:"a",exact:"",to:t.goToShowCustomerPage(s)},domProps:{textContent:t._s(s.name)}})],1)]}}],null,!0)},[t._v(" "),a("span",[t._v(t._s(t.$t("View Details")))])])],1)]}},{key:"item.updated_at",fn:function(e){var s=e.item;return[a("span",{staticClass:"text-no-wrap",attrs:{title:s.updated_at}},[t._v(t._s(t.trans(s.modified)))])]}}]),model:{value:t.dataset.selected,callback:function(e){t.$set(t.dataset,"selected",e)},expression:"dataset.selected"}})],1)],1)],1)}),[],!1,null,null,null);e.default=m.exports;r()(m,{VBtn:c.a,VCard:u.a,VDataTable:d.a,VIcon:l.a,VSkeletonLoader:h.a,VSlideYReverseTransition:p.g,VSlideYTransition:p.h,VTooltip:g.a})},47:function(t,e,a){"use strict";e.a={list:function(){return"/api/v1/customers"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)}}}}]);
//# sourceMappingURL=13.js.map