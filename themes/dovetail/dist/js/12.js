(window.webpackJsonp=window.webpackJsonp||[]).push([[12],{141:function(t,e,i){"use strict";var n=i(70);i.n(n).a},142:function(t,e,i){(e=i(137)(!1)).push([t.i,"\n.text-right input {\n  text-align: right;\n}\n",""]),t.exports=e},382:function(t,e,i){"use strict";i.r(e);var n={props:["value"],components:{PeriodForm:function(){return i.e(8).then(i.bind(null,376))}},computed:{dataset:{get:function(){return this.value},set:function(t){this.$emit("input",t)}}},data:function(){return{period:null,newPeriod:null}},methods:{setPeriod:function(t){0===t?(this.period={},this.newPeriod={setMethod:"add"}):this.period=this.dataset.statements[t-1]},update:function(){this.$emit("update")}}},s=(i(141),i(0)),a=i(2),o=i.n(a),r=i(112),l=i(277),d=i(1),c=i(609),u=i(98),v=i(281),m=i(115),p=i(282),h=i(284),f=i(8),V=i(285),_=i(611),w=i(612),b=i(287),x=Object(s.a)(n,(function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-card",[i("v-card-text",[i("v-row",[i("v-col",{attrs:{cols:"12",md:"3"}},[i("v-card",[i("v-list",[i("v-subheader",{staticClass:"d-flex"},[i("h3",[t._v("Periods")]),t._v(" "),i("v-spacer")],1),t._v(" "),i("v-list-item-group",{attrs:{color:"primary",mandatory:""},on:{change:t.setPeriod}},[i("v-list-item",[i("v-list-item-avatar",[i("v-icon",{attrs:{small:""}},[t._v("mdi-plus")])],1),t._v(" "),i("v-list-item-content",[i("v-list-item-title",[t._v("\n                    Add\n                  ")])],1)],1),t._v(" "),t._l(t.dataset.statements,(function(e,n){return i("v-list-item",{key:n},[i("v-list-item-content",[i("v-list-item-subtitle",[t._v("\n                    "+t._s(n+1)+" -\n                    "+t._s(e.period)+"\n                  ")])],1),t._v(" "),i("v-list-item-action",[i("v-btn",{attrs:{icon:"",small:"",color:"error"}},[i("v-icon",{attrs:{small:""}},[t._v("mdi-delete")])],1)],1)],1)}))],2)],1)],1)],1),t._v(" "),i("v-col",{attrs:{cols:"12",md:"9"}},[i("period-form",{attrs:{newPeriod:t.newPeriod},on:{update:t.update},model:{value:t.period,callback:function(e){t.period=e},expression:"period"}})],1)],1)],1)],1)}),[],!1,null,null,null);e.default=x.exports;o()(x,{VBtn:r.a,VCard:l.a,VCardText:d.c,VCol:c.a,VIcon:u.a,VList:v.a,VListItem:m.a,VListItemAction:p.a,VListItemAvatar:h.a,VListItemContent:f.a,VListItemGroup:V.a,VListItemSubtitle:f.b,VListItemTitle:f.c,VRow:_.a,VSpacer:w.a,VSubheader:b.a})},70:function(t,e,i){var n=i(142);"string"==typeof n&&(n=[[t.i,n,""]]);var s={hmr:!0,transform:void 0,insertInto:void 0};i(138)(n,s);n.locals&&(t.exports=n.locals)}}]);
//# sourceMappingURL=12.js.map