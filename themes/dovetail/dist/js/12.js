(window.webpackJsonp=window.webpackJsonp||[]).push([[12],{12:function(t,e,s){"use strict";e.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(t)},overall:function(t,e){return"/api/v1/reports/overall/customer/".concat(t,"/user/").concat(e)},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(t){return"/api/v1/surveys/".concat(t,"/submit")},show:function(t){return"/api/v1/surveys/".concat(t)}},crm:{search:function(t){return"/api/v1/crm/customers/search/".concat(t)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"},sendDocument:function(){return"/api/v1/crm/report/send"},sendFinancial:function(){return"/api/v1/crm/financial/send"}},reports:{list:function(t){return"/api/v1/customers/".concat(t,"/reports")},generate:function(t){return"/api/v1/reports/".concat(t,"/generate")},download:function(t){return"/api/v1/reports/".concat(t,"/download")},delete:function(t){return"/api/v1/reports/".concat(t)}}}},310:function(t,e,s){"use strict";s.r(e);var r=s(9),n=s(12),a=s(36),o=s(6);function i(t,e){var s=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),s.push.apply(s,r)}return s}function c(t,e,s){return e in t?Object.defineProperty(t,e,{value:s,enumerable:!0,configurable:!0,writable:!0}):t[e]=s,t}var u={computed:{_:function(){return window._},companyId:function(){return this.$route.params.id},progress:function(){var t=Object.values(this.resource.data["fields:grouped"]||{}).map((function(t){return t})).flat().filter((function(t){return void 0!==t.selected})).map((function(t){return t.selected}));return parseFloat(100*t.length/this.resource.data.fields.length).toFixed(0)}},data:function(){return{api:n.a,rates:[{number:"1",text:"No existing processes & practices"},{number:"2",text:"Processes present but not practised"},{number:"3",text:"Processes are poorly practiced"},{number:"4",text:"Processes practised effectively by some"},{number:"5",text:"Processes practised effectively by most"},{number:"6",text:"N/A"}],answers:[],resource:new a.a,auth:r.default.getUser(),submitting:!1}},methods:function(t){for(var e=1;e<arguments.length;e++){var s=null!=arguments[e]?arguments[e]:{};e%2?i(Object(s),!0).forEach((function(e){c(t,e,s[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(s)):i(Object(s)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(s,e))}))}return t}({},Object(o.b)({showDialog:"dialog/show",hideDialog:"dialog/hide",errorDialog:"dialog/error",showSnackbar:"snackbar/show",loadDialog:"dialog/loading"}),{submit:_.debounce((function(t){var e=this,s=new FormData(this.$refs["survey-submission-form"]);axios.post(n.a.surveys.submit(this.$route.params.survey),s).then((function(t){e.showSnackbar({text:trans("Survey successfully submitted")}),e.$router.push({name:"companies.show",params:{id:e.$route.params.id}})})).finally((function(){e.submitting=!1}))}),100),choose:function(t,e){this.answers.filter((function(e){return e.id==t.id})).length?this.answers.forEach((function(s){s.id==t.id&&(s.answer=e)})):this.answers.push({id:t.id,item:t,answer:e})},getResource:function(){var t=this;this.resource.loading=!0,axios.get(n.a.surveys.show(this.$route.params.survey)).then((function(e){t.resource.data=e.data.data})).finally((function(){t.resource.loading=!1}))},askUserToDestroyResource:function(t){var e=this;this.showDialog({color:"warning",illustration:function(){return Promise.resolve().then(s.bind(null,17))},illustrationWidth:200,illustrationHeight:160,width:"420",title:trans("You are about to move to trash the selected survey."),text:[trans("Some data related to survey will still remain."),trans("Are you sure you want to deactivate and move :name to Trash?",{name:t.data.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:trans("Move to Trash"),color:"warning",callback:function(s){e.loadDialog(!0),e.destroyResource(t)}}}})},destroyResource:function(t){var e=this;t.loading=!0,axios.delete(n.a.destroy(t.data.id)).then((function(t){e.hideDialog(),e.showSnackbar({show:!0,text:trans_choice("Survey successfully moved to trash",1)}),e.$router.push({name:"surveys.index"})})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){t.loading=!1}))},saveDummyData:function(){for(var t=this,e={fields:[]},s=this.resource.data.fields,r=s.length-1;r>=0;r--)e.fields.push({id:s[r].id,submission:{results:Math.floor(5*Math.random())+1,submissible_id:s[r].id,submissible_type:"Survey\\Models\\Field",user_id:this.auth.id,customer_id:this.companyId}});axios.post(n.a.surveys.submit(this.$route.params.survey),e).then((function(e){t.showSnackbar({text:trans("Survey successfully submitted")}),t.$router.push({name:"companies.show",params:{id:t.$route.params.id}})})).finally((function(){t.submitting=!1}))}}),mounted:function(){this.getResource()},watch:{submitting:function(t){t||this.hideDialog()}}},l=s(0),d=s(2),p=s.n(d),m=s(104),v=s(262),f=s(1),h=s(579),b=s(580),y=s(91),g=s(347),w=s(46),k=s(581),x=s(587),P=s(47),$=s.n(P),D=s(35),O=Object(l.a)(u,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("admin",[s("metatag",{attrs:{title:t.resource.data.title}}),t._v(" "),s("back-to-top"),t._v(" "),s("div",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","alt","."],expression:"['ctrl', 'alt', '.']",modifiers:{once:!0}}],on:{shortkey:t.saveDummyData}}),t._v(" "),s("form",{ref:"survey-submission-form",on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[s("page-header",{scopedSlots:t._u([{key:"back",fn:function(){return[s("div",{staticClass:"mb-2"},[s("can",{attrs:{code:"customers.show"},scopedSlots:t._u([{key:"unpermitted",fn:function(){return[s("router-link",{staticClass:"text--decoration-none body-1 dt-link",attrs:{tag:"a",exact:"",to:{name:"companies.owned"}}},[s("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi mdi-chevron-left")]),t._v(" "),s("span",{domProps:{textContent:t._s(t.trans("Back"))}})],1)]},proxy:!0}])},[s("router-link",{staticClass:"text--decoration-none body-1 dt-link",attrs:{tag:"a",exact:"",to:{name:"companies.show",params:{id:t.$route.params.id}}}},[s("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi mdi-chevron-left")]),t._v(" "),s("span",{domProps:{textContent:t._s(t.trans("Back"))}})],1)],1)],1)]},proxy:!0},{key:"title",fn:function(){return[t._v(t._s(t.resource.data.title))]},proxy:!0},{key:"action",fn:function(){return[s("survey-monthly-picker")]},proxy:!0}])}),t._v(" "),t.resource.loading?[s("v-row",[s("v-col",{attrs:{cols:"12"}},[s("skeleton",{attrs:{type:"article"}})],1),t._v(" "),s("v-col",{attrs:{cols:"12"}},[s("skeleton",{attrs:{type:"article"}})],1),t._v(" "),s("v-col",{attrs:{cols:"12"}},[s("skeleton",{attrs:{type:"article"}})],1)],1)]:[s("v-card",[s("criteria"),t._v(" "),t._l(t.resource.data["fields:grouped"],(function(e,r){return[s("v-card-text",{key:r,staticClass:"text-center"},[s("v-row",{attrs:{justify:"center"}},[s("v-col",{attrs:{cols:"12",md:"10"}},[s("p",{staticClass:"mb-0 font-weight-bold",class:t.$vuetify.breakpoint.smAndUp?"headline py-4":"subtitle-2"},[t._v("\n                  "+t._s(t.trans(r))+"\n                ")]),t._v(" "),s("p",{domProps:{innerHTML:t._s(e[0].metadata.group_arabic)}})]),t._v(" "),t._l(e,(function(e,r){return s("v-col",{key:r,attrs:{cols:"12",md:"10"}},[s("v-row",[s("v-col",{class:t.$vuetify.breakpoint.smAndUp?"":"pa-0",attrs:{cols:"12",md:"auto"}},[s("span",{staticClass:"text--text muted--text font-weight-bold",class:t.$vuetify.breakpoint.smAndUp?"display-1":"title",domProps:{innerHTML:t._s(e.metadata.sort)}})]),t._v(" "),s("v-col",{class:t.$vuetify.breakpoint.smAndUp?"":"pa-0"},[s("p",{class:t.$vuetify.breakpoint.smAndUp?"title":null},[t._v(t._s(t.trans(e.title)))]),t._v(" "),s("p",{staticClass:"rtl-text",class:t.$vuetify.breakpoint.smAndUp?"title":null},[t._v(t._s(t.trans(e.metadata.title_arabic)))])])],1),t._v(" "),s("v-item-group",{staticClass:"mb-4",attrs:{"active-class":"primary"},model:{value:e.selected,callback:function(s){t.$set(e,"selected",s)},expression:"field.selected"}},[s("v-container",{class:t.$vuetify.breakpoint.smAndUp?"":"pa-0"},[s("v-row",{attrs:{justify:"space-around","no-gutters":""}},t._l(t.rates,(function(n,a){return s("v-col",{key:a,attrs:{id:"scrollto-"+e.id+"-"+(r+1)}},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(a){var o=a.on;return[s("v-item",{scopedSlots:t._u([{key:"default",fn:function(a){var i=a.active,c=a.toggle;return[s("div",t._g({directives:[{name:"ripple",rawName:"v-ripple"},{name:"scroll-to",rawName:"v-scroll-to",value:{el:"#scrollto-"+e.id+"-"+(parseInt(r)+1),duration:700},expression:"{ el: `#scrollto-${field.id+'-'+(parseInt(i)+1)}`, duration: 700 }"}],staticClass:"dt-chip",attrs:{color:i?"primary":null},on:{click:function(s){t.choose(e,n),c()}}},t.$vuetify.breakpoint.smAndUp?o:null),[s("span",{class:i?"white--text":"muted--text"},[t._v("\n                                  "+t._s(n.number)+"\n                                ")])])]}}],null,!0)})]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(n.text))])])],1)})),1)],1)],1)],1)}))],2)],1)]})),t._v(" "),t._l(t.answers,(function(e,r){return[s("input",{attrs:{type:"hidden",name:"fields["+r+"][id]"},domProps:{value:e.item.id}}),t._v(" "),s("input",{attrs:{type:"hidden",name:"fields["+r+"][submission][results]"},domProps:{value:e.answer.number}}),t._v(" "),s("input",{attrs:{type:"hidden",name:"fields["+r+"][submission][submissible_id]"},domProps:{value:e.item.id}}),t._v(" "),s("input",{attrs:{type:"hidden",name:"fields["+r+"][submission][submissible_type]",value:"Survey\\Models\\Field"}}),t._v(" "),s("input",{attrs:{type:"hidden",name:"fields["+r+"][submission][user_id]"},domProps:{value:t.auth.id}}),t._v(" "),s("input",{attrs:{type:"hidden",name:"fields["+r+"][submission][customer_id]"},domProps:{value:t.companyId}})]})),t._v(" "),s("v-card-text",{staticClass:"text-center"},[s("v-btn",{attrs:{disabled:t.progress<100||t.submitting,color:"primary","x-large":"",loading:t.submitting},on:{click:function(e){t.submit(),t.submitting=!0}}},[t._v("\n            "+t._s(t.trans("Submit"))+"\n            "),s("v-icon",{attrs:{right:""}},[t._v("mdi-arrow-right")])],1)],1)],2)]],2),t._v(" "),s("bottom-navigation",{model:{value:t.progress,callback:function(e){t.progress=e},expression:"progress"}})],1)}),[],!1,null,null,null);e.default=O.exports;p()(O,{VBtn:m.a,VCard:v.a,VCardText:f.c,VCol:h.a,VContainer:b.a,VIcon:y.a,VItem:g.b,VItemGroup:w.b,VRow:k.a,VTooltip:x.a}),$()(O,{Ripple:D.a})},36:function(t,e,s){"use strict";e.a=function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.data={title:"",title_arabic:"",code:"",body:"",body_arabic:"",metadata:{title_arabic:"",body_arabic:""},type:"",user_id:"",created:"",indices:[],answer:"",fields:[{group:"",group_arabic:"",type:"",children:[]}]}}}}]);
//# sourceMappingURL=12.js.map