(window.webpackJsonp=window.webpackJsonp||[]).push([[15],{283:function(t,a,e){"use strict";e.r(a);var s={store:e(21).a,name:"Index",mounted:function(){var t=this;axios.get("/api/v1/menus/all").then((function(a){t.resources.items=a.data}))},data:function(){return{resources:{items:[]}}}},n=e(0),i=e(2),r=e.n(i),o=e(263),l=e(1),c=e(564),v=e(345),u=e(86),d=e(346),p=e(256),m=e(566),_=Object(n.a)(s,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("v-container",{attrs:{fluid:"","grid-list-lg":""}},[e("div",{staticClass:"mb-4"},[e("h1",{staticClass:"headline font-weight-bold"},[t._v("\n      "+t._s(t.__("Menus"))+"\n    ")])]),t._v(" "),e("v-layout",{attrs:{row:"",wrap:""}},[t._l(t.resources.items,(function(a,s){return[e("v-flex",{key:s,attrs:{md4:"",sm6:"",xs12:""}},[e("v-card",{attrs:{hover:"",to:{name:"appearance.edit",params:{code:a.code,meta:{item:a}}}}},[e("v-list",{attrs:{"two-line":""}},[e("v-list-tile",[e("v-list-tile-action",[e("v-list-tile-avatar",{attrs:{dark:"",color:a.iconBackground}},[e("v-icon",{attrs:{size:"18",color:a.iconColor},domProps:{innerHTML:t._s(a.icon)}})],1)],1),t._v(" "),e("v-list-tile-content",[e("v-list-tile-title",{staticClass:"font-weight-bold",domProps:{innerHTML:t._s(a.name)}}),t._v(" "),e("v-list-tile-sub-title",{domProps:{innerHTML:t._s(a.description)}})],1)],1)],1),t._v(" "),e("v-card-actions",{staticClass:"px-3 pb-3 pt-3"},[e("small",{attrs:{color:"grey--text"}},[t._v("\n              "+t._s(t.__("Application link"))+"\n            ")]),t._v(" "),e("v-spacer"),t._v(" "),e("v-icon",{attrs:{color:"grey--text text--lighten-3"}},[t._v("\n              mdi-call-made\n            ")])],1)],1)],1)]}))],2)],1)}),[],!1,null,null,null);a.default=_.exports;r()(_,{VCard:o.a,VCardActions:l.a,VContainer:c.a,VFlex:v.a,VIcon:u.a,VLayout:d.a,VList:p.a,VSpacer:m.a})},345:function(t,a,e){"use strict";e(786);var s=e(59);a.a=Object(s.a)("flex")},346:function(t,a,e){"use strict";e(786);var s=e(59);a.a=Object(s.a)("layout")}}]);
//# sourceMappingURL=15.js.map