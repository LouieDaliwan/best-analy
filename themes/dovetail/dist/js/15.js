(window.webpackJsonp=window.webpackJsonp||[]).push([[15],{259:function(t,e,a){"use strict";a.r(e);var s=a(17),n=a(19),r={data:function(){return{api:s.a,auth:n.default.getUser(),resource:{loading:!1,data:{displayname:"",username:""}}}},beforeRouteLeave:function(t,e,a){a()},methods:{getResource:function(){var t=this;axios.get(s.a.show(this.$route.params.id)).then((function(e){t.resource.data=e.data.data})).finally((function(){t.resource.loading=!1}))},submit:function(t){var e=this;t.preventDefault(),axios.put(s.a.update(this.$route.params.id),this.resource.data).then((function(t){console.log(t)})).catch((function(t){e.resource.loading=!1,e.$refs["user-editform"].setErrors(t.response.data.errors)}))}},mounted:function(){this.getResource()}},o=a(2),i=a(3),u=a.n(i),c=a(240),d=a(1),l=a(234),v=a(56),f=a(282),m=Object(o.a)(r,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("section",[a("metatag",{attrs:{title:t.resource.data.displayname}}),t._v(" "),a("page-header",{attrs:{back:{name:"users.index"}},scopedSlots:t._u([{key:"title",fn:function(){return[t._v("\n      "+t._s(t.resource.data.displayname)+"\n    ")]},proxy:!0},{key:"utilities",fn:function(){return[a("router-link",{staticClass:"dt-link text--decoration-none mr-4",attrs:{tag:"a",exact:"",to:{name:"users.edit"}}},[a("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi-pencil-outline")]),t._v("\n        "+t._s(t.trans("Edit"))+"\n      ")],1),t._v(" "),a("router-link",{staticClass:"dt-link text--decoration-none mr-4",attrs:{tag:"a",exact:"",to:{name:"users.trashed"}}},[a("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi-delete-outline")]),t._v("\n        "+t._s(t.trans("Deactivate"))+"\n      ")],1)]},proxy:!0}])}),t._v(" "),a("v-card",[a("v-card-text",[a("account",{attrs:{items:t.resource.data}})],1),t._v(" "),a("v-divider"),t._v(" "),a("v-simple-table",{scopedSlots:t._u([{key:"default",fn:function(){return[a("thead",[a("tr",[a("th",{staticClass:"text-left",attrs:{colspan:"100%"}},[t._v("Background Details")])])]),t._v(" "),a("tbody",[a("tr",[a("td",{staticClass:"font-weight-bold"},[t._v("Gender")]),t._v(" "),a("td",[t._v("Male")])])])]},proxy:!0}])})],1)],1)}),[],!1,null,null,null);e.default=m.exports;u()(m,{VCard:c.a,VCardText:d.c,VDivider:l.a,VIcon:v.a,VSimpleTable:f.a})}}]);
//# sourceMappingURL=15.js.map