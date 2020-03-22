(window.webpackJsonp=window.webpackJsonp||[]).push([[6],{142:function(e,t,a){"use strict";var n=a(73);a.n(n).a},143:function(e,t,a){(t=a(45)(!1)).push([e.i,"\ncode.hljs {\n  color: #fff;\n  background-color: #474949;\n}\n.hljs-comment {\n  color: #959ba7;\n}\n",""]),e.exports=t},28:function(e,t,a){"use strict";t.a={list:function(){return"/api/v1/indices"},store:function(){return"/api/v1/indices"},delete:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/delete/".concat(e)},restore:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/restore/".concat(e)},trashed:function(){return"/api/v1/indices/trashed"},show:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(e)},update:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(e)},destroy:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(e)}}},327:function(e,t,a){"use strict";a.r(t);var n=a(12),r=a(53),l=(a(138),{components:{IndexPicker:r.a},data:function(){return{resources:{survey:{},indices:[]},formulas:{IndexOverallValue:{results:"no data",variable:{index:"FMPI",total:71.43}},ElementScoreFirstComment:{results:[],variable:{group:[],index:"fmpi",survey_id:1}},KeyEnablers:{results:"",variable:{user_id:n.default.getId()}},KeyStrategicRecommendations:{results:"",variable:{user_id:n.default.getId()}}}}},methods:{loadHighlightJs:function(){var e=a(140),t=a(141);e.registerLanguage("javascript",t),document.querySelectorAll("pre code").forEach((function(t){e.highlightBlock(t)}))},checkFormula:function(e,t,a){axios.get("/best/formula/check",{params:{type:e,attributes:t}}).then((function(e){a.results=e.data}))},getSurveyFromId:function(e){var t=this,a=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0;axios.get("/api/v1/surveys/".concat(e)).then((function(e){t.resources.survey=e.data.data;var n={};Object.keys(t.resources.survey["fields:grouped"]).forEach((function(e){n[e]=""})),0==a&&(t.formulas.ElementScoreFirstComment.variable.index=t.resources.survey.formable.alias,t.formulas.ElementScoreFirstComment.variable.group=n),1==a&&(t.formulas.KeyEnablers.variable.index=t.resources.survey.formable.alias)}))}},mounted:function(){this.loadHighlightJs()}}),s=(a(142),a(1)),o=a(2),i=a.n(o),d=a(108),c=a(288),u=a(0),m=a(587),v=a(589),f=a(50),p=Object(s.a)(l,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("admin",[a("page-header",{scopedSlots:e._u([{key:"title",fn:function(){},proxy:!0}])}),e._v(" "),a("v-card",{staticClass:"mb-3"},[a("v-card-title",{domProps:{textContent:e._s(e.trans("Performance Index Report"))}}),e._v(" "),a("v-card-text",[a("p",{domProps:{textContent:e._s(e.trans("Overall Findings Value Formula"))}}),e._v(" "),a("div",{staticStyle:{"overflow-x":"scroll"}},[a("pre",[a("code",{staticClass:"javascript",staticStyle:{width:"100%","overflow-x":"scroll","white-space":"pre"}},[e._v("\n// IndexOverallValue = sum of user's input's subscore divided by sum of survey's total possible score\n// E.g.\nIndexOverallValue = 38/105 = 0.36 (or 36%)\n          ")])])])]),e._v(" "),a("v-card-text",[a("p",{domProps:{textContent:e._s(e.trans("Overall Findings Comment Formula"))}}),e._v(" "),a("div",{staticStyle:{"overflow-x":"scroll"}},[a("pre",[a("code",{staticClass:"javascript",staticStyle:{width:"100%","overflow-x":"scroll","white-space":"pre"}},[e._v("\n  OverallFindingsComment = ''\n\n  IndexOverallValue = round((SubscoreScore/SubscoreTotal)*100, 2)\n  IndexMeterTotalValue = IndexOverallValue/100\n  Univrules_C5_red = 0.49\n  Univrules_C6_amber = 0.89\n\n  if (IndexMeterTotalValue > Univrules_C5_red) {\n    if (IndexMeterTotalValue > Univrules_C6_amber) {\n      OverallFindingsComment = '(Above 90%) Overall, the :PerformanceIndexCode seemed to suggest that a well-controlled...'\n    } else {\n      OverallFindingsComment = '(50-89%) Overall, the :PerformanceIndexCode seemed to suggest a generall...'\n    }\n  } else {\n    OverallFindingsComment = '(Below 50) Overall, the :PerformanceIndexCode seemed to suggest a serious efficiency...'\n  }\n          ")])])]),e._v(" "),a("v-row",[a("v-col",{attrs:{cols:"12",md:"4"}},[a("v-text-field",{attrs:{label:"IndexOverallValue",placeholder:"E.g. 71.43",dense:"",outlined:""},model:{value:e.formulas.IndexOverallValue.variable.total,callback:function(t){e.$set(e.formulas.IndexOverallValue.variable,"total",t)},expression:"formulas.IndexOverallValue.variable['total']"}}),e._v(" "),a("v-text-field",{attrs:{label:"Performance Index",hint:"Allowed values: FMPI, BSPI, PMPI, and HRPI",dense:"",outlined:""},model:{value:e.formulas.IndexOverallValue.variable.index,callback:function(t){e.$set(e.formulas.IndexOverallValue.variable,"index",t)},expression:"formulas.IndexOverallValue.variable['index']"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12",md:"auto"}},[a("v-btn",{on:{click:function(t){return e.checkFormula("getOverallFindingsComment",e.formulas.IndexOverallValue.variable,e.formulas.IndexOverallValue)}}},[e._v("Check")])],1),e._v(" "),a("v-col",{attrs:{cols:"12",md:"5"}},[a("p",[e._v("Results: "),a("span",{domProps:{innerHTML:e._s(e.formulas.IndexOverallValue.results)}})])])],1)],1),e._v(" "),a("v-card-text",[a("p",{domProps:{textContent:e._s(e.trans("Performance Index Element's Comments"))}}),e._v(" "),a("pre",[a("code",{staticClass:"javascript",staticStyle:{width:"100%","overflow-x":"scroll","white-space":"pre"}},[e._v("\nComments = []\nGroupAvg = average score of elements in survey (e.g. AVG(LeadershipScore, RiskManagementScore, ...))\n\nif (GroupAvg >= 1) {\n  Comments[0] = '(100) The organisation is perceived to have achieved optimal...'\n} else {\n  LastElement = GroupAvg sort from lowest score and get the last element\n  SecondToTheLast = GroupAvg sort from lowest score and get the second to last element\n\n  if (LastElement == SecondToTheLast) {\n    Comments[0] = 'Based on the responses to the individual statements in the financial management survey, :item1 and :item2 activities have been most well implemented.'\n  } else {\n    Comments[0] = 'Based on the responses to the individual statements in the financial management survey, :item1 has been the most well implemented'\n  }\n\n  if (LastElement == SecondToTheLast) {\n    Comments[0] += ''\n  } else {\n    Comments[0] += 'This is followed by :item1 with a score of :score'\n    Comments[0] += 'However, it is imperative that the organisation strive to uplift all other financial management elements.'\n  }\n}\n        ")])]),e._v(" "),a("v-row",[a("v-col",{attrs:{cols:"12",md:"4"}},[a("v-text-field",{attrs:{label:"Survey ID",placeholder:"",dense:"",outlined:""},model:{value:e.formulas.ElementScoreFirstComment.variable.survey_id,callback:function(t){e.$set(e.formulas.ElementScoreFirstComment.variable,"survey_id",t)},expression:"formulas.ElementScoreFirstComment.variable['survey_id']"}}),e._v(" "),a("v-text-field",{attrs:{readonly:"",label:"Performance Index",hint:"Allowed values: FMPI, BSPI, PMPI, and HRPI",dense:"",outlined:""},model:{value:e.formulas.ElementScoreFirstComment.variable.index,callback:function(t){e.$set(e.formulas.ElementScoreFirstComment.variable,"index",t)},expression:"formulas.ElementScoreFirstComment.variable['index']"}}),e._v(" "),e._l(e.resources.survey["fields:grouped"],(function(t,n){return a("div",{key:n},[a("v-text-field",{attrs:{label:n,placeholder:"E.g. 0.5",dense:"",outlined:""},model:{value:e.formulas.ElementScoreFirstComment.variable.group[n],callback:function(t){e.$set(e.formulas.ElementScoreFirstComment.variable.group,n,t)},expression:"formulas.ElementScoreFirstComment.variable['group'][i]"}})],1)})),e._v(" "),e.resources.survey["fields:grouped"]?a("div",[a("v-btn",{on:{click:function(t){return e.checkFormula("getFirstBoxComment",e.formulas.ElementScoreFirstComment.variable,e.formulas.ElementScoreFirstComment)}}},[e._v("Calculate")])],1):e._e()],2),e._v(" "),a("v-col",{attrs:{cols:"12",md:"auto"}},[a("v-btn",{on:{click:function(t){return e.getSurveyFromId(e.formulas.ElementScoreFirstComment.variable.survey_id)}}},[e._v("Get Survey Fields")])],1),e._v(" "),a("v-col",{attrs:{cols:"12",md:"5"}},[a("p",[e._v("Results:")]),e._v(" "),a("ul",e._l(e.formulas.ElementScoreFirstComment.results,(function(t,n){return a("li",{key:n},[a("span",{domProps:{innerHTML:e._s(t)}})])})),0)])],1)],1),e._v(" "),a("v-card-text",[a("p",{domProps:{textContent:e._s(e.trans("Key Enablers"))}}),e._v(" "),a("v-row",[a("v-col",{attrs:{cols:"12",md:"4"}},[a("v-text-field",{attrs:{label:"Survey ID",placeholder:"",dense:"",outlined:""},model:{value:e.formulas.KeyEnablers.variable.survey_id,callback:function(t){e.$set(e.formulas.KeyEnablers.variable,"survey_id",t)},expression:"formulas.KeyEnablers.variable['survey_id']"}}),e._v(" "),a("v-text-field",{attrs:{label:"Performance Index",hint:"Allowed values: FMPI, BSPI, PMPI, and HRPI",dense:"",outlined:""},model:{value:e.formulas.KeyEnablers.variable.index,callback:function(t){e.$set(e.formulas.KeyEnablers.variable,"index",t)},expression:"formulas.KeyEnablers.variable['index']"}}),e._v(" "),a("v-text-field",{attrs:{label:"Customer ID",placeholder:"",dense:"",outlined:""},model:{value:e.formulas.KeyEnablers.variable.customer_id,callback:function(t){e.$set(e.formulas.KeyEnablers.variable,"customer_id",t)},expression:"formulas.KeyEnablers.variable['customer_id']"}}),e._v(" "),a("v-text-field",{attrs:{readonly:"",label:"User ID (readonly)",placeholder:"",dense:"",outlined:""},model:{value:e.formulas.KeyEnablers.variable.user_id,callback:function(t){e.$set(e.formulas.KeyEnablers.variable,"user_id",t)},expression:"formulas.KeyEnablers.variable['user_id']"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12",md:"auto"}},[a("v-btn",{on:{click:function(t){return e.checkFormula("getKeyEnablers",e.formulas.KeyEnablers.variable,e.formulas.KeyEnablers)}}},[e._v("Check")])],1),e._v(" "),a("v-col",{attrs:{cols:"12",md:"5"}},[a("p",[e._v("Results:")]),e._v(" "),e._l(e.formulas.KeyEnablers.results,(function(t,n){return a("div",{key:n},[a("div",[a("strong",{staticClass:"mb-0",domProps:{innerHTML:e._s(n)}})]),e._v(" "),a("div",{staticClass:"ml-3"},[a("div",{domProps:{innerHTML:e._s(t.value)}}),e._v(" "),a("div",{domProps:{innerHTML:e._s(t.comment)}})])])}))],2)],1)],1),e._v(" "),a("v-card-text",[a("p",{domProps:{textContent:e._s(e.trans("Key Strategic Recommendations"))}}),e._v(" "),a("v-row",[a("v-col",{attrs:{cols:"12",md:"4"}},[a("v-text-field",{attrs:{label:"Survey ID",placeholder:"",dense:"",outlined:""},model:{value:e.formulas.KeyStrategicRecommendations.variable.survey_id,callback:function(t){e.$set(e.formulas.KeyStrategicRecommendations.variable,"survey_id",t)},expression:"formulas.KeyStrategicRecommendations.variable['survey_id']"}}),e._v(" "),a("v-text-field",{attrs:{label:"Performance Index",hint:"Allowed values: FMPI, BSPI, PMPI, and HRPI",dense:"",outlined:""},model:{value:e.formulas.KeyStrategicRecommendations.variable.index,callback:function(t){e.$set(e.formulas.KeyStrategicRecommendations.variable,"index",t)},expression:"formulas.KeyStrategicRecommendations.variable['index']"}}),e._v(" "),a("v-text-field",{attrs:{label:"Customer ID",placeholder:"",dense:"",outlined:""},model:{value:e.formulas.KeyStrategicRecommendations.variable.customer_id,callback:function(t){e.$set(e.formulas.KeyStrategicRecommendations.variable,"customer_id",t)},expression:"formulas.KeyStrategicRecommendations.variable['customer_id']"}}),e._v(" "),a("v-text-field",{attrs:{readonly:"",label:"User ID (readonly)",placeholder:"",dense:"",outlined:""},model:{value:e.formulas.KeyStrategicRecommendations.variable.user_id,callback:function(t){e.$set(e.formulas.KeyStrategicRecommendations.variable,"user_id",t)},expression:"formulas.KeyStrategicRecommendations.variable['user_id']"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12",md:"auto"}},[a("v-btn",{on:{click:function(t){return e.checkFormula("getKeyStrategicRecommendations",e.formulas.KeyStrategicRecommendations.variable,e.formulas.KeyStrategicRecommendations)}}},[e._v("Check")])],1),e._v(" "),a("v-col",{attrs:{cols:"12",md:"5"}},[a("p",[e._v("Results:")]),e._v(" "),e._l(e.formulas.KeyStrategicRecommendations.results,(function(t,n){return a("div",{key:n},[a("div",[a("strong",{staticClass:"mb-0",domProps:{innerHTML:e._s(n)}})]),e._v(" "),a("div",{staticClass:"ml-3"},[a("div",{domProps:{innerHTML:e._s(t.value)}}),e._v(" "),a("div",{domProps:{innerHTML:e._s(t.comment)}})])])}))],2)],1)],1)],1)],1)}),[],!1,null,null,null);t.default=p.exports;i()(p,{VBtn:d.a,VCard:c.a,VCardText:u.c,VCardTitle:u.d,VCol:m.a,VRow:v.a,VTextField:f.a})},53:function(e,t,a){"use strict";var n=a(28),r={name:"IndexPicker",props:{value:{type:[Array,Object,String,Number]},dense:{type:Boolean},errors:{type:[Array,Object]},lazyLoad:{type:Boolean},illustration:{type:Boolean,default:!0}},computed:{index:{get:function(){return this.value[0]},set:function(e){this.$emit("input",[e])}},indices:function(){return this.items.map((function(e){return{value:e.id,text:e.name,icon:e.icon}}))}},data:function(){return{items:[]}},methods:{getIndexsData:function(){var e=this;window._.isEmpty(this.items)&&axios.get(n.a.list(),{params:{per_page:"-1"}}).then((function(t){e.items=t.data.data}))}},mounted:function(){this.lazyLoad||this.getIndexsData()}},l=a(1),s=a(2),o=a.n(s),i=a(288),d=a(0),c=a(42),u=Object(l.a)(r,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-card",{staticClass:"mb-3"},[a("v-card-title",[e._v(e._s(e.trans("Performance Index")))]),e._v(" "),e.illustration?a("div",{staticClass:"primary--text text-center"},[a("checklist-icon",{attrs:{width:"100",height:"100"}})],1):e._e(),e._v(" "),a("v-card-text",[a("validation-provider",{attrs:{vid:"indices",name:e.trans("indices"),rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.errors;return[a("v-select",{ref:"indices",staticClass:"dt-text-field",attrs:{dense:e.dense,"error-messages":n,"hide-details":!n.length,items:e.indices,label:e.$tc("Select..."),"background-color":"selects","menu-props":"offsetY",name:"formable_id",outlined:""},on:{focus:e.getIndexsData},scopedSlots:e._u([{key:"item",fn:function(t){var n=t.item;return[a("img",{staticClass:"mr-3",attrs:{src:n.icon,width:"20"}}),e._v(" "),a("span",{domProps:{textContent:e._s(n.text)}})]}}],null,!0),model:{value:e.index,callback:function(t){e.index=t},expression:"index"}})]}}])}),e._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:e.index,expression:"index"}],attrs:{type:"hidden",name:"formable_id"},domProps:{value:e.index},on:{input:function(t){t.target.composing||(e.index=t.target.value)}}})],1)],1)}),[],!1,null,null,null);t.a=u.exports;o()(u,{VCard:i.a,VCardText:d.c,VCardTitle:d.d,VSelect:c.a})},73:function(e,t,a){var n=a(143);"string"==typeof n&&(n=[[e.i,n,""]]);var r={hmr:!0,transform:void 0,insertInto:void 0};a(46)(n,r);n.locals&&(e.exports=n.locals)}}]);
//# sourceMappingURL=6.js.map