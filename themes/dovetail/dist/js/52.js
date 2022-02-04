(window.webpackJsonp=window.webpackJsonp||[]).push([[52],{381:function(e,t,a){"use strict";a.r(t);var r=a(94),o=a.n(r);function s(e){return(s="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function n(e,t){return!t||"object"!==s(t)&&"function"!=typeof t?function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}(e):t}function i(e){return(i=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function c(e,t){return(c=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}var d=function(e){function t(){var e;return function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t),(e=n(this,i(t).call(this))).data={description:"",sales:0,raw_materials:0,opening_stocks:0,closing_stocks:0,cost_of_good_sold:0,production_cost:0,general_management_cost:0,labour_expense:0,buildings:0,plant_machinery_and_equipment:0,others:0,depreciation:0,non_operating_expense:0,taxation:0,interest_on_loans_or_hires:0,company_tax:0,net_profit:0,cash:0,trade_receivables:0,inventories:0,other_CA:0,fixed_assets:0,trade_payables:0,other_CL:0,stockholders_equity:0,other_NCL:0,common_shares_outstanding:0,balance:0},e}return function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&c(e,t)}(t,e),t}(a(55).a);function l(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,r)}return a}function u(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}function _(e,t,a,r,o,s,n){try{var i=e[s](n),c=i.value}catch(e){return void a(e)}i.done?t(c):Promise.resolve(c).then(r,o)}var p,v,m={props:["value"],components:{PeriodInput:function(){return a.e(53).then(a.bind(null,388))}},data:function(){return{resource:new d,edit:!0}},methods:{costOfGoodSold:function(){var e=this.resource.data,t=e.raw_materials,a=e.opening_stocks,r=e.closing_stocks;this.resource.data.cost_of_good_sold=this.sum([t,a])-parseFloat(r)},totalDepreciation:function(){var e=this.resource.data,t=e.buildings,a=e.plant_machinery_and_equipment,r=e.others;this.resource.data.depreciation=this.sum([t,a,r])},netProfit:function(){var e=this.resource.data,t=e.sales,a=e.cost_of_good_sold,r=e.non_operating_expense,o=e.production_cost,s=e.labour_expense,n=e.general_management_cost,i=e.depreciation,c=e.interest_on_loans_or_hires,d=e.taxation,l=e.company_tax,u=this.sum([o,s,n]),_=parseFloat(t)-this.sum([a,u,r]);this.resource.data.net_profit=_-this.sum([i,c,d,l])},balance:function(){var e=this.resource.data,t=e.cash,a=e.trade_receivables,r=e.inventories,o=e.other_CA,s=e.fixed_assets,n=e.trade_payables,i=e.other_CL,c=e.stockholders_equity,d=e.other_NCL,l=e.common_shares_outstanding,u=this.sum([t,a,r,o,s]),_=this.sum([n,i,c,d,l]);this.resource.data.balance=u-_},sum:function(e){return e.reduce((function(e,t){return e+parseFloat(t)}),0)},submit:(p=o.a.mark((function e(){return o.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:try{axios.post("/api/v1/financial/save",this.resource.parseData(this.$refs.form.$el))}catch(e){console.log(e)}case 1:case"end":return e.stop()}}),e,this)})),v=function(){var e=this,t=arguments;return new Promise((function(a,r){var o=p.apply(e,t);function s(e){_(o,a,r,s,n,"next",e)}function n(e){_(o,a,r,s,n,"throw",e)}s(void 0)}))},function(){return v.apply(this,arguments)})},watch:{value:{handler:function(e){if(this.resource=new d,!e.id)return this.edit=!0;this.resource.data=function(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?l(Object(a),!0).forEach((function(t){u(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):l(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}({},this.resource.data,{},e),this.edit=!1},deep:!0},"resource.data":{handler:function(){this.costOfGoodSold(),this.totalDepreciation(),this.netProfit(),this.balance()},deep:!0}}},f=a(0),h=a(2),b=a.n(h),x=a(116),g=a(280),y=a(612),C=a(283),k=a(626),w=a(614),O=a(615),P=a(379),$=a(50),S=Object(f.a)(m,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-form",{ref:"form",on:{submit:function(t){return t.preventDefault(),e.submit(t)}}},[a("input",{attrs:{type:"hidden",name:"customer_id"},domProps:{value:e.$route.params.id}}),e._v(" "),a("h3",{staticClass:"d-flex align-center mb-3"},[e._v("\n    Period\n    "),a("v-spacer"),e._v(" "),e.resource.data.id?[a("v-switch",{staticClass:"mt-0",attrs:{label:e.edit?"Edit":"View",color:"primary","hide-details":""},model:{value:e.edit,callback:function(t){e.edit=t},expression:"edit"}})]:[a("span",{staticClass:"grey--text text--darken-2"},[e._v("Add")])]],2),e._v(" "),e.edit?a("validation-provider",{attrs:{vid:"description",name:e.trans("Description")},scopedSlots:e._u([{key:"default",fn:function(t){t.errors;return[a("v-text-field",{attrs:{dense:"",label:"Description",name:"description",outlined:"","hide-details":""},model:{value:e.resource.data.description,callback:function(t){e.$set(e.resource.data,"description",t)},expression:"resource.data.description"}})]}}],null,!1,4100171600)}):a("h4",{staticClass:"mb-3 primary--text",domProps:{textContent:e._s(e.resource.data.description)}},[e._v("\n    Period\n  ")]),e._v(" "),a("v-divider",{staticClass:"my-10"}),e._v(" "),a("h3",[e._v("Financial Statement")]),e._v(" "),a("v-card",{attrs:{flat:"",height:"50"}}),e._v(" "),a("v-row",[a("v-col",{staticClass:"text-right font-weight-bold",attrs:{cols:"6"},domProps:{textContent:e._s("Net Profit")}}),e._v(" "),a("v-col",{attrs:{cols:"6"}},[e.edit?a("v-text-field",{staticClass:"text-right dt-text-field",class:e.resource.data.net_profit>0?"text-green":"text-red",attrs:{color:e.resource.data.net_profit>0?"green":"red",dense:"",name:"net_profit",readonly:""},model:{value:e.resource.data.net_profit,callback:function(t){e.$set(e.resource.data,"net_profit",t)},expression:"resource.data.net_profit"}}):a("div",{staticClass:"text-right",domProps:{textContent:e._s(e.resource.data.net_profit)}})],1)],1),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Sales",name:"sales"},model:{value:e.resource.data.sales,callback:function(t){e.$set(e.resource.data,"sales",t)},expression:"resource.data.sales"}}),e._v(" "),a("v-card",{attrs:{flat:"",height:"50"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Raw Materials",name:"raw_materials"},model:{value:e.resource.data.raw_materials,callback:function(t){e.$set(e.resource.data,"raw_materials",t)},expression:"resource.data.raw_materials"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Opening Stocks",name:"opening_stocks"},model:{value:e.resource.data.opening_stocks,callback:function(t){e.$set(e.resource.data,"opening_stocks",t)},expression:"resource.data.opening_stocks"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Closing Stocks",name:"closing_stocks"},model:{value:e.resource.data.closing_stocks,callback:function(t){e.$set(e.resource.data,"closing_stocks",t)},expression:"resource.data.closing_stocks"}}),e._v(" "),a("v-row",[a("v-col",{staticClass:"text-right font-weight-bold",attrs:{cols:"6"},domProps:{textContent:e._s("Cost of Good Sold")}}),e._v(" "),a("v-col",{attrs:{cols:"6"}},[e.edit?a("v-text-field",{staticClass:"text-right",attrs:{dense:"","hide-details":"",name:"cost_of_good_sold",readonly:""},model:{value:e.resource.data.cost_of_good_sold,callback:function(t){e.$set(e.resource.data,"cost_of_good_sold",t)},expression:"resource.data.cost_of_good_sold"}}):a("div",{staticClass:"text-right",domProps:{textContent:e._s(e.resource.data.cost_of_good_sold)}})],1)],1),e._v(" "),a("v-card",{attrs:{flat:"",height:"50"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Production Cost",name:"production_cost"},model:{value:e.resource.data.production_cost,callback:function(t){e.$set(e.resource.data,"production_cost",t)},expression:"resource.data.production_cost"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Genereral Management Cost",name:"general_management_cost"},model:{value:e.resource.data.general_management_cost,callback:function(t){e.$set(e.resource.data,"general_management_cost",t)},expression:"resource.data.general_management_cost"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Labour Expense",name:"labour_expense"},model:{value:e.resource.data.labour_expense,callback:function(t){e.$set(e.resource.data,"labour_expense",t)},expression:"resource.data.labour_expense"}}),e._v(" "),a("v-card",{attrs:{flat:"",height:"50"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Buildings",name:"buildings"},model:{value:e.resource.data.buildings,callback:function(t){e.$set(e.resource.data,"buildings",t)},expression:"resource.data.buildings"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Plant, Machinery & Equipment",name:"plant_machinery_and_equipment"},model:{value:e.resource.data.plant_machinery_and_equipment,callback:function(t){e.$set(e.resource.data,"plant_machinery_and_equipment",t)},expression:"resource.data.plant_machinery_and_equipment"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Others",name:"others"},model:{value:e.resource.data.others,callback:function(t){e.$set(e.resource.data,"others",t)},expression:"resource.data.others"}}),e._v(" "),a("v-row",[a("v-col",{staticClass:"text-right font-weight-bold",attrs:{cols:"6"},domProps:{textContent:e._s("Total Depreciation")}}),e._v(" "),a("v-col",{attrs:{cols:"6"}},[e.edit?a("v-text-field",{staticClass:"text-right",attrs:{dense:"","hide-details":"",name:"depreciation",readonly:""},model:{value:e.resource.data.depreciation,callback:function(t){e.$set(e.resource.data,"depreciation",t)},expression:"resource.data.depreciation"}}):a("div",{staticClass:"text-right",domProps:{textContent:e._s(e.resource.data.depreciation)}})],1)],1),e._v(" "),a("v-card",{attrs:{flat:"",height:"50"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Non Operating Expense",name:"non_operating_expense"},model:{value:e.resource.data.non_operating_expense,callback:function(t){e.$set(e.resource.data,"non_operating_expense",t)},expression:"resource.data.non_operating_expense"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Taxation",name:"taxation"},model:{value:e.resource.data.taxation,callback:function(t){e.$set(e.resource.data,"taxation",t)},expression:"resource.data.taxation"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Interest on Loans/Hires",name:"interest_on_loans_or_hires"},model:{value:e.resource.data.interest_on_loans_or_hires,callback:function(t){e.$set(e.resource.data,"interest_on_loans_or_hires",t)},expression:"resource.data.interest_on_loans_or_hires"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Company Tax",name:"company_tax"},model:{value:e.resource.data.company_tax,callback:function(t){e.$set(e.resource.data,"company_tax",t)},expression:"resource.data.company_tax"}}),e._v(" "),a("v-divider",{staticClass:"my-10"}),e._v(" "),a("h3",[e._v("Balance Sheet")]),e._v(" "),a("v-card",{attrs:{flat:"",height:"50"}}),e._v(" "),a("v-row",[a("v-col",{staticClass:"text-right font-weight-bold",attrs:{cols:"6"},domProps:{textContent:e._s("Balance checked!")}}),e._v(" "),a("v-col",{attrs:{cols:"6"}},[a("input",{attrs:{type:"hidden",name:"balance"},domProps:{value:e.resource.data.balance}}),e._v(" "),e.edit?a("v-text-field",{staticClass:"text-right dt-text-field",class:e.resource.data.balance?"text-red":"text-green",attrs:{color:e.resource.data.balance?"red":"green",dense:"",readonly:"",value:e.resource.data.balance||"Balance!"}}):a("div",{staticClass:"text-right",domProps:{textContent:e._s(e.resource.data.balance)}})],1)],1),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Cash",name:"cash"},model:{value:e.resource.data.cash,callback:function(t){e.$set(e.resource.data,"cash",t)},expression:"resource.data.cash"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Trade Receivables",name:"trade_receivables"},model:{value:e.resource.data.trade_receivables,callback:function(t){e.$set(e.resource.data,"trade_receivables",t)},expression:"resource.data.trade_receivables"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Inventories",name:"inventories"},model:{value:e.resource.data.inventories,callback:function(t){e.$set(e.resource.data,"inventories",t)},expression:"resource.data.inventories"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Other CA",name:"other_CA"},model:{value:e.resource.data.other_CA,callback:function(t){e.$set(e.resource.data,"other_CA",t)},expression:"resource.data.other_CA"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Fixed Assets",name:"fixed_assets"},model:{value:e.resource.data.fixed_assets,callback:function(t){e.$set(e.resource.data,"fixed_assets",t)},expression:"resource.data.fixed_assets"}}),e._v(" "),a("v-card",{attrs:{flat:"",height:"50"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Trade Payables",name:"trade_payables"},model:{value:e.resource.data.trade_payables,callback:function(t){e.$set(e.resource.data,"trade_payables",t)},expression:"resource.data.trade_payables"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Other CL",name:"other_CL"},model:{value:e.resource.data.other_CL,callback:function(t){e.$set(e.resource.data,"other_CL",t)},expression:"resource.data.other_CL"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Stockholders Equity",name:"stockholders_equity"},model:{value:e.resource.data.stockholders_equity,callback:function(t){e.$set(e.resource.data,"stockholders_equity",t)},expression:"resource.data.stockholders_equity"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Other NCL",name:"other_NCL"},model:{value:e.resource.data.other_NCL,callback:function(t){e.$set(e.resource.data,"other_NCL",t)},expression:"resource.data.other_NCL"}}),e._v(" "),a("period-input",{attrs:{edit:e.edit,label:"Common Shares Outstanding",name:"common_shares_outstanding"},model:{value:e.resource.data.common_shares_outstanding,callback:function(t){e.$set(e.resource.data,"common_shares_outstanding",t)},expression:"resource.data.common_shares_outstanding"}}),e._v(" "),e.edit?a("div",{staticClass:"text-right mt-5"},[a("v-btn",{attrs:{type:"submit",large:"",color:"primary"}},[e._v("Save")])],1):e._e()],1)}),[],!1,null,null,null);t.default=S.exports;b()(S,{VBtn:x.a,VCard:g.a,VCol:y.a,VDivider:C.a,VForm:k.a,VRow:w.a,VSpacer:O.a,VSwitch:P.a,VTextField:$.a})}}]);
//# sourceMappingURL=52.js.map