(window.webpackJsonp=window.webpackJsonp||[]).push([[47],{381:function(t,e,a){"use strict";a.r(e);function l(t){return function(t){if(Array.isArray(t)){for(var e=0,a=new Array(t.length);e<t.length;e++)a[e]=t[e];return a}}(t)||function(t){if(Symbol.iterator in Object(t)||"[object Arguments]"===Object.prototype.toString.call(t))return Array.from(t)}(t)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance")}()}var n={props:["value"],computed:{dataset:{get:function(){return[{title:"Company Information",to:{name:"companies.edit",params:{id:this.value.id}},details:[{label:"Name",value:this.value.name},{label:"Address",value:this.value.metadata.address},{label:"Staff Strength",value:this.value.metadata.staffstrength},{label:"Email",value:this.value.metadata.email},{label:"Website",value:this.value.metadata.website},{label:"Industry",value:this.value.metadata.industry}]},{title:"Business Details",details:[{label:"Project Name",value:"Chocolate"},{label:"Business Status",value:"Soft Opening"},{label:"Industry Sector",value:"Tourism"},{label:"Business Size",value:"SME"},{label:"Project Location",value:"Dubai"},{label:"Funding Program",value:"Bedaya"},{label:"Project Type",value:"Industrial"}]},{title:"Applicant Details",details:[{label:"Applicant Name",value:"Chocolate"},{label:"Email Address",value:"Chocolate"},{label:"Designation",value:"Chocolate"},{label:"Mobile Number",value:"Chocolate"},{label:"Contact Person",value:"Chocolate"},{label:"Mobile Number",value:"Chocolate"}]}]}}},methods:{gen2Col:function(t){var e=(t=l(t)).length,a=e/2,n=e%2?a+1:a;return[t.splice(0,n),t]}}},o=a(0),s=a(2),r=a.n(s),i=a(111),u=a(276),c=a(1),v=a(608),d=a(279),m=a(98),b=a(610),p=a(616),f=Object(o.a)(n,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-card",[a("v-card-text",{staticClass:"pa-7"},[a("h3",{staticClass:"mb-5",domProps:{textContent:t._s(t.trans("General Information"))}}),t._v(" "),a("v-divider"),t._v(" "),t._l(t.dataset,(function(e,l){return[a("div",{key:l},[a("h4",{staticClass:"my-5 d-flex align-center"},[a("span",{domProps:{textContent:t._s(t.trans(e.title))}}),t._v(" "),a("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(l){var n=l.on,o=l.attrs;return[a("v-btn",t._g(t._b({attrs:{icon:"",to:e.to,exact:"",small:""}},"v-btn",o,!1),n),[a("v-icon",{staticClass:"ml-2 incomplete--text",attrs:{small:""}},[t._v("mdi-pencil")])],1)]}}],null,!0)},[t._v(" "),a("span",{domProps:{textContent:t._s(t.trans("Edit "+e.title))}})])],1),t._v(" "),a("v-row",{attrs:{"no-gutters":""}},[t._l(t.gen2Col(e.details),(function(e,n){return[a("v-col",{key:l+"-"+n,attrs:{cols:"12",sm:"6"}},t._l(e,(function(e,o){return a("div",{key:l+"-"+n+"-"+o,staticClass:"mb-5"},[a("label",{staticClass:"incomplete--text",attrs:{for:""},domProps:{textContent:t._s(t.trans(e.label))}}),t._v(" "),a("div",{domProps:{textContent:t._s(e.value||"-")}})])})),0)]}))],2)],1)]}))],2)],1)}),[],!1,null,null,null);e.default=f.exports;r()(f,{VBtn:i.a,VCard:u.a,VCardText:c.c,VCol:v.a,VDivider:d.a,VIcon:m.a,VRow:b.a,VTooltip:p.a})}}]);
//# sourceMappingURL=47.js.map