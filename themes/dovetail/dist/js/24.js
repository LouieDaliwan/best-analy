(window.webpackJsonp=window.webpackJsonp||[]).push([[24],{292:function(t,e,a){"use strict";a.r(e);var s={store:a(22).a,name:"Index",data:function(){return{resources:{items:[]},resource:{}}},created:function(){var t=this;axios.get("/api/v1/themes/all").then((function(e){t.resources.items=e.data}))},methods:{saveTheme:function(t){var e=this;axios.post("/api/v1/settings/store",t).then((function(t){"success"==t.data&&e.$router.go({name:"appearance.themes"})}))}}},n=a(0),r=a(2),i=a.n(r),o=a(105),c=a(260),l=a(1),u=a(578),v=a(352),d=a(591),m=a(123),_=a(353),p=a(580),h=Object(n.a)(s,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-container",{attrs:{fluid:"","grid-list-lg":""}},[a("v-layout",{attrs:{row:"",wrap:""}},[a("v-flex",{attrs:{xs12:""}},[a("div",{staticClass:"mb-4"},[a("h1",{staticClass:"headline font-weight-bold"},[t._v("\n          "+t._s(t.__("Themes"))+"\n        ")])])]),t._v(" "),t._l(t.resources.items,(function(e,s){return[a("v-flex",{key:s,attrs:{md4:"",sm6:"",xs12:""}},[a("v-card",{attrs:{id:e.code}},[a("v-img",{attrs:{height:"300",src:e.thumbnail,gradient:"to top right, rgba(100,115,201,.45), rgba(25,32,72,.3)"}},[a("v-container",{attrs:{fluid:"","fill-height":""}},[a("v-layout",{attrs:{row:"",wrap:"","justify-center":"","align-start":""}},[a("v-card-text",{staticClass:"white--text"},[a("h3",{staticClass:"mb-2",domProps:{innerHTML:t._s(e.name)}}),t._v(" "),a("p",{staticClass:"caption font-weight-bold"},[a("span",[t._v(t._s(t.__("Theme by: "))+" "+t._s(e.author.name))])]),t._v(" "),a("p",{domProps:{innerHTML:t._s(e.description)}})])],1)],1)],1),t._v(" "),a("v-card-actions",{staticClass:"pa-3"},[e.active?[a("v-btn",{attrs:{flat:"",disabled:"",color:"secondary"}},[t._v("\n                "+t._s(t.__("Currently Active"))+"\n              ")])]:[a("v-form",{attrs:{method:"POST"},on:{submit:function(a){return a.preventDefault(),t.saveTheme({active_theme:e.code})}}},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.code,expression:"resource.code"}],attrs:{type:"hidden",name:"active_theme"},domProps:{value:e.code},on:{input:function(a){a.target.composing||t.$set(e,"code",a.target.value)}}}),t._v(" "),a("v-btn",{attrs:{color:"secondary",flat:"",type:"submit"}},[t._v("\n                  "+t._s(t.__("Activate"))+"\n                ")])],1)],t._v(" "),a("v-spacer"),t._v(" "),a("v-btn",{attrs:{flat:""}},[t._v("\n              "+t._s(t.__("Details"))+"\n            ")])],2)],1)],1)]}))],2)],1)}),[],!1,null,null,null);e.default=h.exports;i()(h,{VBtn:o.a,VCard:c.a,VCardActions:l.a,VCardText:l.c,VContainer:u.a,VFlex:v.a,VForm:d.a,VImg:m.a,VLayout:_.a,VSpacer:p.a})},352:function(t,e,a){"use strict";a(800);var s=a(61);e.a=Object(s.a)("flex")},353:function(t,e,a){"use strict";a(800);var s=a(61);e.a=Object(s.a)("layout")}}]);
//# sourceMappingURL=24.js.map