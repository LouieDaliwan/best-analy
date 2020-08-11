(window.webpackJsonp=window.webpackJsonp||[]).push([[12],{12:function(t,e,r){"use strict";e.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(t)},overall:function(t,e){return"/api/v1/reports/overall/customer/".concat(t,"/user/").concat(e)},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(t){return"/api/v1/surveys/".concat(t,"/submit")},show:function(t){return"/api/v1/surveys/".concat(t)}},crm:{search:function(t){return"/api/v1/crm/customers/search/".concat(t)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"},sendDocument:function(){return"/api/v1/crm/report/send"},sendFinancial:function(){return"/api/v1/crm/financial/send"}},reports:{list:function(t){return"/api/v1/customers/".concat(t,"/reports")},generate:function(t){return"/api/v1/reports/".concat(t,"/generate")},download:function(t){return"/api/v1/reports/".concat(t,"/download")},delete:function(t){return"/api/v1/reports/".concat(t)}}}},282:function(t,e,r){"use strict";r.r(e);var s=r(9),n=r(12),a=r(36),o={data:function(){return{rates:[{number:"1",text:"No existing <br/> processes & practices"},{number:"2",text:"Processes present <br/> but not practised"},{number:"3",text:"Processes are <br/> poorly practiced"},{number:"4",text:"Processes practised <br/> effectively by some"},{number:"5",text:"Processes practised <br/> effectively by most"},{number:"6",text:"N/A"}]}}},i=r(0),c=r(2),u=r.n(c),l=r(261),d=r(584),p=r(575),m=r(577),v=r(52),f=r(76),b=r(585),h=Object(i.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("v-sheet",{staticClass:"sticky dt-sheet criteria"},[r("v-slide-group",{attrs:{single:"","show-arrows":""}},[r("v-slide-item",[r("v-banner",{staticClass:"dt-banner",attrs:{elevation:"1"}},[r("v-row",{attrs:{justify:"center",align:"start"}},t._l(t.rates,(function(e,s){return r("v-col",{key:s,staticClass:"text-center"},[r("v-avatar",{staticClass:"mb-2",attrs:{color:"primary",size:"20"}},[r("small",{staticClass:"white--text"},[t._v(t._s(e.number))])]),t._v(" "),r("div",{staticClass:"overline",domProps:{innerHTML:t._s(e.text)}})],1)})),1)],1)],1)],1)],1)}),[],!1,null,null,null),y=h.exports;u()(h,{VAvatar:l.a,VBanner:d.a,VCol:p.a,VRow:m.a,VSheet:v.a,VSlideGroup:f.b,VSlideItem:b.a});var g=r(6);function w(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(t);e&&(s=s.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,s)}return r}function x(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var k={components:{Criteria:y},computed:{_:function(){return window._},companyId:function(){return this.$route.params.id},progress:function(){var t=Object.values(this.resource.data["fields:grouped"]||{}).map((function(t){return t})).flat().filter((function(t){return void 0!==t.selected})).map((function(t){return t.selected}));return parseFloat(100*t.length/this.resource.data.fields.length).toFixed(0)}},data:function(){return{api:n.a,rates:[{number:"1",text:"No existing processes & practices"},{number:"2",text:"Processes present but not practised"},{number:"3",text:"Processes are poorly practiced"},{number:"4",text:"Processes practised effectively by some"},{number:"5",text:"Processes practised effectively by most"},{number:"6",text:"N/A"}],answers:[],resource:new a.a,responses:[],auth:s.default.getUser(),submitting:!1}},methods:function(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?w(Object(r),!0).forEach((function(e){x(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):w(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}({},Object(g.b)({showDialog:"dialog/show",hideDialog:"dialog/hide",errorDialog:"dialog/error",showSnackbar:"snackbar/show",loadDialog:"dialog/loading"}),{submit:_.debounce((function(t){var e=this,r=new FormData(this.$refs["survey-submission-form"]);axios.post(n.a.surveys.submit(this.$route.params.survey),r).then((function(t){e.showSnackbar({text:trans("Survey successfully submitted")}),e.$router.push({name:"companies.show",params:{id:e.$route.params.id}})})).finally((function(){e.submitting=!1}))}),2e3),choose:function(t,e){this.answers.filter((function(e){return e.id==t.id})).length?this.answers.forEach((function(r){r.id==t.id&&(r.answer=e)})):this.answers.push({id:t.id,item:t,answer:e})},getResource:function(){var t=this;this.resource.loading=!0,axios.get("/api/v1/surveys/".concat(this.$route.params.survey,"/submissions/get?customer_id=").concat(this.$route.params.id,"&taxonomy_id=").concat(this.$route.params.taxonomy,"&month=").concat(this.$route.query.month)).then((function(e){t.responses=e.data,axios.get(n.a.surveys.show(t.$route.params.survey)).then((function(e){t.resource.data=e.data.data})).finally((function(){t.resource.loading=!1}))})).finally((function(){t.resource.loading=!1}))},getAnswer:function(t){return this.responses.filter((function(e){return e.submissible_id==t.id})).map((function(t){return t.results}))[0]},askUserToDestroyResource:function(t){var e=this;this.showDialog({color:"warning",illustration:function(){return Promise.resolve().then(r.bind(null,17))},illustrationWidth:200,illustrationHeight:160,width:"420",title:trans("You are about to move to trash the selected survey."),text:[trans("Some data related to survey will still remain."),trans("Are you sure you want to deactivate and move :name to Trash?",{name:t.data.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:trans("Move to Trash"),color:"warning",callback:function(r){e.loadDialog(!0),e.destroyResource(t)}}}})},destroyResource:function(t){var e=this;t.loading=!0,axios.delete(n.a.destroy(t.data.id)).then((function(t){e.hideDialog(),e.showSnackbar({show:!0,text:trans_choice("Survey successfully moved to trash",1)}),e.$router.push({name:"surveys.index"})})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){t.loading=!1}))}}),mounted:function(){this.getResource()}},P=r(259),O=r(1),$=r(576),j=r(344),C=r(45),A=r(583),D=r(46),V=r.n(D),S=r(35),U=Object(i.a)(k,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("admin",[r("metatag",{attrs:{title:t.resource.data.title}}),t._v(" "),r("back-to-top"),t._v(" "),r("page-header",{attrs:{back:{to:{name:"companies.show",params:{id:t.$route.params.id}},text:"Back"}},scopedSlots:t._u([{key:"title",fn:function(){return[t._v(t._s(t.resource.data.title))]},proxy:!0}])}),t._v(" "),t.resource.loading?[r("v-row",[r("v-col",{attrs:{cols:"12"}},[r("skeleton",{attrs:{type:"article"}})],1),t._v(" "),r("v-col",{attrs:{cols:"12"}},[r("skeleton",{attrs:{type:"article"}})],1),t._v(" "),r("v-col",{attrs:{cols:"12"}},[r("skeleton",{attrs:{type:"article"}})],1)],1)]:[r("form",{ref:"survey-submission-form",on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[r("v-card",[r("criteria"),t._v(" "),t._l(t.resource.data["fields:grouped"],(function(e,s){return[r("v-card-text",{key:s,staticClass:"text-center"},[r("v-row",{attrs:{justify:"center"}},[r("v-col",{attrs:{cols:"12",md:"10"}},[r("p",{staticClass:"mb-0 font-weight-bold",class:t.$vuetify.breakpoint.smAndUp?"headline py-4":"subtitle-2"},[t._v("\n                  "+t._s(t.trans(s))+"\n                ")])]),t._v(" "),t._l(e,(function(e,s){return r("v-col",{key:s,attrs:{cols:"12",md:"10"}},[r("v-row",[r("v-col",{class:t.$vuetify.breakpoint.smAndUp?"":"pa-0",attrs:{cols:"12",md:"auto"}},[r("span",{staticClass:"text--text muted--text font-weight-bold",class:t.$vuetify.breakpoint.smAndUp?"display-1":"title",domProps:{innerHTML:t._s(e.metadata.sort)}})]),t._v(" "),r("v-col",{class:t.$vuetify.breakpoint.smAndUp?"":"pa-0"},[r("p",{class:t.$vuetify.breakpoint.smAndUp?"title":null},[t._v(t._s(t.trans(e.title)))])])],1),t._v(" "),r("v-item-group",{staticClass:"mb-4",attrs:{value:t.getAnswer(e),"active-class":"primary"}},[r("v-container",{class:t.$vuetify.breakpoint.smAndUp?"":"pa-0"},[r("v-row",{attrs:{justify:"space-around","no-gutters":""}},t._l(t.rates,(function(n,a){return r("v-col",{key:a,attrs:{id:"scrollto-"+e.id+"-"+(s+1)}},[r("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(s){var a=s.on;return[r("v-item",{scopedSlots:t._u([{key:"default",fn:function(s){s.active,s.toggle;return[r("div",t._g({directives:[{name:"ripple",rawName:"v-ripple"}],staticClass:"dt-chip",class:{primary:n.number==t.getAnswer(e)}},t.$vuetify.breakpoint.smAndUp?a:null),[r("span",{class:n.number==t.getAnswer(e)?"white--text":"muted--text"},[t._v("\n                                  "+t._s(n.number)+"\n                                ")])])]}}],null,!0)})]}}],null,!0)},[t._v(" "),r("span",[t._v(t._s(n.text))])])],1)})),1)],1)],1)],1)}))],2)],1)]})),t._v(" "),t._l(t.answers,(function(e,s){return[r("input",{attrs:{type:"hidden",name:"fields["+s+"][id]"},domProps:{value:e.item.id}}),t._v(" "),r("input",{attrs:{type:"hidden",name:"fields["+s+"][submission][results]"},domProps:{value:e.answer.number}}),t._v(" "),r("input",{attrs:{type:"hidden",name:"fields["+s+"][submission][submissible_id]"},domProps:{value:e.item.id}}),t._v(" "),r("input",{attrs:{type:"hidden",name:"fields["+s+"][submission][submissible_type]",value:"Survey\\Models\\Field"}}),t._v(" "),r("input",{attrs:{type:"hidden",name:"fields["+s+"][submission][user_id]"},domProps:{value:t.auth.id}}),t._v(" "),r("input",{attrs:{type:"hidden",name:"fields["+s+"][submission][customer_id]"},domProps:{value:t.companyId}})]}))],2)],1)]],2)}),[],!1,null,null,null);e.default=U.exports;u()(U,{VCard:P.a,VCardText:O.c,VCol:p.a,VContainer:$.a,VItem:j.b,VItemGroup:C.b,VRow:m.a,VTooltip:A.a}),V()(U,{Ripple:S.a})},36:function(t,e,r){"use strict";e.a=function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.data={title:"",title_arabic:"",code:"",body:"",body_arabic:"",metadata:{title_arabic:"",body_arabic:""},type:"",user_id:"",created:"",indices:[],answer:"",fields:[{group:"",group_arabic:"",type:"",children:[]}]}}}}]);
//# sourceMappingURL=12.js.map