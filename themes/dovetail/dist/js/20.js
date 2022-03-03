(window.webpackJsonp=window.webpackJsonp||[]).push([[20],{28:function(t,e,a){"use strict";e.a={list:function(){return"/api/v1/surveys"},store:function(){return"/api/v1/surveys"},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/surveys/delete/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/surveys/restore/".concat(t)},trashed:function(){return"/api/v1/surveys/trashed"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/surveys/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/surveys/".concat(t)},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/surveys/".concat(t)},submit:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/surveys/".concat(t,"/submit")}}},304:function(t,e,a){"use strict";a.r(e);var s=a(28),r=a(36),n=a(0),o=a(2),i=a.n(o),l=a(615),c=a(277),u=a(1),d=a(609),v=a(611),_=a(624),p=Object(n.a)({},(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("section",[a("page-header",{attrs:{back:{to:{name:"surveys.index"},text:t.trans("Surveys")}},scopedSlots:t._u([{key:"title",fn:function(){return[a("v-skeleton-loader",{attrs:{type:"text"}})]},proxy:!0}])}),t._v(" "),a("v-alert",{staticClass:"my-5",attrs:{border:"top",color:"info",elevation:"1",prominent:"",text:"",type:"info"}},[a("h2",{staticClass:"mb-3 info--text"},[t._v(t._s(t.__("Preview Only")))]),t._v(" "),a("div",{staticClass:"dark--text"},[t._v(t._s(t.__("This survey detail is for preview purposes only.")))])]),t._v(" "),a("v-card",[a("v-card-text",[a("v-row",{attrs:{justify:"center"}},[a("v-col",{attrs:{cols:"12",md:"10"}},[a("v-skeleton-loader",{staticClass:"pb-4",attrs:{height:"32",type:"image"}})],1),t._v(" "),a("v-col",{attrs:{cols:"12",md:"10"}},[a("v-row",{attrs:{align:"center"}},[a("v-col",{attrs:{cols:"12",md:"auto"}},[a("span",{staticClass:"text--text muted--text display-1 font-weight-bold"},[t._v("1")])]),t._v(" "),a("v-col",[a("v-skeleton-loader",{attrs:{type:"text"}})],1)],1)],1)],1)],1)],1)],1)}),[],!1,null,null,null),m=p.exports;i()(p,{VAlert:l.a,VCard:c.a,VCardText:u.c,VCol:d.a,VRow:v.a,VSkeletonLoader:_.a});var y=a(6);function f(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(t);e&&(s=s.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,s)}return a}function h(t,e,a){return e in t?Object.defineProperty(t,e,{value:a,enumerable:!0,configurable:!0,writable:!0}):t[e]=a,t}var g={components:{SkeletonShow:m},data:function(){return{api:s.a,rates:["0","1","2","3","4","5"],resource:new r.a}},methods:function(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?f(Object(a),!0).forEach((function(e){h(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):f(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}({},Object(y.b)({showDialog:"dialog/show",hideDialog:"dialog/hide",errorDialog:"dialog/error",showSnackbar:"snackbar/show",loadDialog:"dialog/loading"}),{getResource:function(){var t=this;this.resource.loading=!0,axios.get(s.a.show(this.$route.params.id)).then((function(e){t.resource.data=e.data.data,console.log(e.data.data)})).finally((function(){t.resource.loading=!1}))},askUserToDestroyResource:function(t){var e=this;this.showDialog({color:"warning",illustration:function(){return Promise.resolve().then(a.bind(null,17))},illustrationWidth:200,illustrationHeight:160,width:"420",title:trans("You are about to move to trash the selected survey."),text:[trans("Some data related to survey will still remain."),trans("Are you sure you want to deactivate and move :name to Trash?",{name:t.data.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:trans("Move to Trash"),color:"warning",callback:function(a){e.loadDialog(!0),e.destroyResource(t)}}}})},destroyResource:function(t){var e=this;t.loading=!0,axios.delete(s.a.destroy(t.data.id)).then((function(t){e.hideDialog(),e.showSnackbar({show:!0,text:trans_choice("Survey successfully moved to trash",1)}),e.$router.push({name:"surveys.index"})})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){t.loading=!1}))}}),mounted:function(){this.getResource()}},b=a(98),w=Object(n.a)(g,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("admin",[a("metatag",{attrs:{title:t.resource.data.title}}),t._v(" "),t.resource.loading?[a("skeleton-show")]:[a("page-header",{attrs:{back:{to:{name:"surveys.index"},text:t.trans("Surveys")}},scopedSlots:t._u([{key:"title",fn:function(){return[t._v(t._s(t.resource.data.title))]},proxy:!0},{key:"utilities",fn:function(){return[a("can",{attrs:{code:"surveys.show"}},[a("router-link",{staticClass:"dt-link text--decoration-none mr-6",attrs:{tag:"a",exact:"",to:{name:"surveys.edit"}}},[a("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi-pencil-outline")]),t._v("\n            "+t._s(t.trans("Edit"))+"\n          ")],1)],1),t._v(" "),a("can",{attrs:{code:"surveys.destroy"}},[a("a",{staticClass:"dt-link text--decoration-none mr-6",attrs:{href:"#"},on:{click:function(e){return e.preventDefault(),t.askUserToDestroyResource(t.resource)}}},[a("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi-delete-outline")]),t._v("\n            "+t._s(t.trans("Move to Trash"))+"\n          ")],1)])]},proxy:!0}])}),t._v(" "),a("v-alert",{staticClass:"my-5",attrs:{border:"top",color:"info",elevation:"1",prominent:"",text:"",type:"info"}},[a("h2",{staticClass:"mb-3 info--text"},[t._v(t._s(t.__("Preview Only")))]),t._v(" "),a("div",{staticClass:"dark--text"},[t._v(t._s(t.__("This survey detail is for preview purposes only.")))])]),t._v(" "),a("v-card",[t._l(t.resource.data["fields:grouped"],(function(e,s){return[a("v-card-text",[a("v-row",{attrs:{justify:"center"}},[a("v-col",{attrs:{cols:"12",md:"10"}},[a("p",{staticClass:"headline py-4 mb-0 font-weight-bold"},[t._v("\n                "+t._s(t.trans(s))+"\n              ")]),t._v(" "),a("p",{domProps:{innerHTML:t._s(e[0].metadata.group_arabic)}})]),t._v(" "),t._l(e,(function(e,s){return a("v-col",{key:s,attrs:{cols:"12",md:"10"}},[a("v-row",[a("v-col",{attrs:{cols:"12",md:"auto"}},[a("span",{staticClass:"text--text muted--text display-1 font-weight-bold"},[t._v("\n                    "+t._s(e.sort||0)+"\n                  ")])]),t._v(" "),a("v-col",[a("p",{staticClass:"title"},[t._v(t._s(t.trans(e.title)))]),t._v(" "),a("p",{staticClass:"title rtl-text"},[t._v(t._s(t.trans(e.metadata.title_arabic)))]),t._v(" "),a("p",[a("span",{staticClass:"link--text mr-6"},[t._v(t._s(t.__("Total Number"))+":   "+t._s(t.trans(e.metadata.total)))]),t._v(" "),a("span",{staticClass:"link--text mr-6"},[t._v(t._s(t.__("WTS"))+":   "+t._s(t.trans(e.metadata.wts)))])]),t._v(" "),a("p",[a("span",{staticClass:"link--text mr-6"},[t._v(t._s(t.__("Comment"))+":   "+t._s(t.trans(e.metadata.comment)))])]),t._v(" "),a("p",{staticClass:"rtl-text"},[a("span",{staticClass:"link--text mr-6"},[t._v(t._s(t.__("تعليق"))+":   "+t._s(t.trans(e.metadata.comment_arabic)))])]),t._v(" "),a("p",[a("span",{staticClass:"muted--text mr-6"},[t._v(t._s(t.trans("Category"))+":")]),t._v(" "),a("span",{staticClass:"link--text mr-6"},[t._v("\n                      "+t._s(t.__("Documentation"))+":   "+t._s(t.trans(e.metadata.category.Documentation?e.metadata.category.Documentation:"-"))+"\n                    ")]),t._v(" "),a("span",{staticClass:"link--text mr-6"},[t._v("\n                      "+t._s(t.__("Talent"))+":   "+t._s(t.trans(e.metadata.category.Talent?e.metadata.category.Talent:"-"))+"\n                    ")]),t._v(" "),a("span",{staticClass:"link--text mr-6"},[t._v("\n                      "+t._s(t.__("Technology"))+":   "+t._s(t.trans(e.metadata.category.Technology?e.metadata.category.Technology:"-"))+"\n                    ")]),t._v(" "),a("span",{staticClass:"link--text"},[t._v("\n                      "+t._s(t.__("Workflow Processes"))+":   "+t._s(t.trans(e.metadata.category["Workflow Processes"]?e.metadata.category["Workflow Processes"]:"-"))+"\n                    ")])])])],1)],1)}))],2)],1)]}))],2)]],2)}),[],!1,null,null,null);e.default=w.exports;i()(w,{VAlert:l.a,VCard:c.a,VCardText:u.c,VCol:d.a,VIcon:b.a,VRow:v.a})},36:function(t,e,a){"use strict";e.a=function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.data={title:"",title_arabic:"",code:"",body:"",body_arabic:"",metadata:{title_arabic:"",body_arabic:""},type:"",user_id:"",created:"",indices:[],answer:"",fields:[{group:"",group_arabic:"",type:"",children:[]}]}}}}]);
//# sourceMappingURL=20.js.map