(window.webpackJsonp=window.webpackJsonp||[]).push([[48],{318:function(t,e,a){"use strict";a.r(e);var s={data:function(){return{settings:{"formal:date":{key:"formal:date",value:""},"display:perpage":{key:"display:perpage",value:15}}}},methods:{loadSettings:function(){},saveSettings:function(){var t=this.settings;axios.post("/api/v1/settings",t).then((function(t){console.log(t)}))}}},l=a(1),n=a(2),o=a.n(n),i=a(278),r=a(0),d=a(579),u=a(581),c=a(48),p=Object(l.a)(s,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("admin",[a("page-header",{scopedSlots:t._u([{key:"title",fn:function(){},proxy:!0}])}),t._v(" "),a("v-row",[a("v-col",{attrs:{cols:"12",md:"8"}},[a("v-card",[a("v-card-title",{domProps:{textContent:t._s(t.trans("Displaying Data"))}}),t._v(" "),a("v-card-text",[a("p",{staticClass:"muted--text",domProps:{textContent:t._s(t.trans("Formats"))}}),t._v(" "),a("v-text-field",{staticClass:"mb-3",attrs:{label:t.trans("Global Date Format"),autofocus:"",outlined:""},model:{value:t.settings["formal:date"].value,callback:function(e){t.$set(t.settings["formal:date"],"value",e)},expression:"settings['formal:date']['value']"}}),t._v(" "),a("v-text-field",{staticClass:"mb-3",attrs:{label:t.trans("Items per Page"),outlined:""},model:{value:t.settings["display:perpage"].value,callback:function(e){t.$set(t.settings["display:perpage"],"value",e)},expression:"settings['display:perpage']['value']"}}),t._v(" "),a("language-switcher",{staticClass:"mb-6"})],1)],1)],1)],1)],1)}),[],!1,null,null,null);e.default=p.exports;o()(p,{VCard:i.a,VCardText:r.c,VCardTitle:r.d,VCol:d.a,VRow:u.a,VTextField:c.a})}}]);
//# sourceMappingURL=48.js.map