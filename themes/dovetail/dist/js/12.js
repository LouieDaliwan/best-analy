(window.webpackJsonp=window.webpackJsonp||[]).push([[12],{140:function(t,e,i){"use strict";var n=i(70);i.n(n).a},141:function(t,e,i){(e=i(136)(!1)).push([t.i,"\n.text-right input {\r\n  text-align: right;\n}\r\n",""]),t.exports=e},379:function(t,e,i){"use strict";i.r(e);var n={props:["value"],components:{PeriodForm:function(){return i.e(8).then(i.bind(null,375))}},computed:{dataset:{get:function(){return this.value},set:function(t){this.$emit("input",t)}}},data:function(){return{period:null}},methods:{setPeriod:function(t){this.period=0===t?{}:this.dataset.statements[t-1]},update:function(){this.$emit("update")}}},a=(i(140),i(0)),s=i(2),r=i.n(s),o=i(111),l=i(276),c=i(1),u=i(608),d=i(98),v=i(280),m=i(114),p=i(281),f=i(283),h=i(8),V=i(284),_=i(610),b=i(611),x=i(286),I=Object(a.a)(n,(function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-card",[i("v-card-text",[i("v-row",[i("v-col",{attrs:{cols:"12",md:"3"}},[i("v-card",[i("v-list",[i("v-subheader",{staticClass:"d-flex"},[i("h3",[t._v("Periods")]),t._v(" "),i("v-spacer")],1),t._v(" "),i("v-list-item-group",{attrs:{color:"primary",mandatory:""},on:{change:t.setPeriod}},[i("v-list-item",[i("v-list-item-avatar",[i("v-icon",{attrs:{small:""}},[t._v("mdi-plus")])],1),t._v(" "),i("v-list-item-content",[i("v-list-item-title",[t._v("\n                    Add\n                  ")])],1)],1),t._v(" "),t._l(t.dataset.statements,(function(e,n){return i("v-list-item",{key:n},[i("v-list-item-content",[i("v-list-item-subtitle",[t._v("\n                    "+t._s(n+1)+" -\n                    "+t._s(e.period)+"\n                  ")])],1),t._v(" "),i("v-list-item-action",[i("v-btn",{attrs:{icon:"",small:"",color:"error"}},[i("v-icon",{attrs:{small:""}},[t._v("mdi-delete")])],1)],1)],1)}))],2)],1)],1)],1),t._v(" "),i("v-col",{attrs:{cols:"12",md:"9"}},[i("period-form",{on:{update:t.update},model:{value:t.period,callback:function(e){t.period=e},expression:"period"}})],1)],1)],1)],1)}),[],!1,null,null,null);e.default=I.exports;r()(I,{VBtn:o.a,VCard:l.a,VCardText:c.c,VCol:u.a,VIcon:d.a,VList:v.a,VListItem:m.a,VListItemAction:p.a,VListItemAvatar:f.a,VListItemContent:h.a,VListItemGroup:V.a,VListItemSubtitle:h.b,VListItemTitle:h.c,VRow:_.a,VSpacer:b.a,VSubheader:x.a})},70:function(t,e,i){var n=i(141);"string"==typeof n&&(n=[[t.i,n,""]]);var a={hmr:!0,transform:void 0,insertInto:void 0};i(137)(n,a);n.locals&&(t.exports=n.locals)}}]);
//# sourceMappingURL=12.js.map