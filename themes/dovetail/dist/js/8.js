(window.webpackJsonp=window.webpackJsonp||[]).push([[8],{143:function(t,e,r){var n=function(t){"use strict";var e=Object.prototype,r=e.hasOwnProperty,n="function"==typeof Symbol?Symbol:{},a=n.iterator||"@@iterator",o=n.asyncIterator||"@@asyncIterator",i=n.toStringTag||"@@toStringTag";function s(t,e,r,n){var a=e&&e.prototype instanceof l?e:l,o=Object.create(a.prototype),i=new x(n||[]);return o._invoke=function(t,e,r){var n="suspendedStart";return function(a,o){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===a)throw o;return P()}for(r.method=a,r.arg=o;;){var i=r.delegate;if(i){var s=b(i,r);if(s){if(s===u)continue;return s}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var l=c(t,e,r);if("normal"===l.type){if(n=r.done?"completed":"suspendedYield",l.arg===u)continue;return{value:l.arg,done:r.done}}"throw"===l.type&&(n="completed",r.method="throw",r.arg=l.arg)}}}(t,r,i),o}function c(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=s;var u={};function l(){}function d(){}function f(){}var h={};h[a]=function(){return this};var p=Object.getPrototypeOf,v=p&&p(p(S([])));v&&v!==e&&r.call(v,a)&&(h=v);var m=f.prototype=l.prototype=Object.create(h);function y(t){["next","throw","return"].forEach((function(e){t[e]=function(t){return this._invoke(e,t)}}))}function g(t){var e;this._invoke=function(n,a){function o(){return new Promise((function(e,o){!function e(n,a,o,i){var s=c(t[n],t,a);if("throw"!==s.type){var u=s.arg,l=u.value;return l&&"object"==typeof l&&r.call(l,"__await")?Promise.resolve(l.__await).then((function(t){e("next",t,o,i)}),(function(t){e("throw",t,o,i)})):Promise.resolve(l).then((function(t){u.value=t,o(u)}),(function(t){return e("throw",t,o,i)}))}i(s.arg)}(n,a,e,o)}))}return e=e?e.then(o,o):o()}}function b(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,b(t,e),"throw"===e.method))return u;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return u}var n=c(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,u;var a=n.arg;return a?a.done?(e[t.resultName]=a.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,u):a:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,u)}function w(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function O(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function x(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(w,this),this.reset(!0)}function S(t){if(t){var e=t[a];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,o=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return o.next=o}}return{next:P}}function P(){return{value:void 0,done:!0}}return d.prototype=m.constructor=f,f.constructor=d,f[i]=d.displayName="GeneratorFunction",t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===d||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,f):(t.__proto__=f,i in t||(t[i]="GeneratorFunction")),t.prototype=Object.create(m),t},t.awrap=function(t){return{__await:t}},y(g.prototype),g.prototype[o]=function(){return this},t.AsyncIterator=g,t.async=function(e,r,n,a){var o=new g(s(e,r,n,a));return t.isGeneratorFunction(r)?o:o.next().then((function(t){return t.done?t.value:o.next()}))},y(m),m[i]="Generator",m[a]=function(){return this},m.toString=function(){return"[object Generator]"},t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=S,x.prototype={constructor:x,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(O),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return i.type="throw",i.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var a=this.tryEntries.length-1;a>=0;--a){var o=this.tryEntries[a],i=o.completion;if("root"===o.tryLoc)return n("end");if(o.tryLoc<=this.prev){var s=r.call(o,"catchLoc"),c=r.call(o,"finallyLoc");if(s&&c){if(this.prev<o.catchLoc)return n(o.catchLoc,!0);if(this.prev<o.finallyLoc)return n(o.finallyLoc)}else if(s){if(this.prev<o.catchLoc)return n(o.catchLoc,!0)}else{if(!c)throw new Error("try statement without catch or finally");if(this.prev<o.finallyLoc)return n(o.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var a=this.tryEntries[n];if(a.tryLoc<=this.prev&&r.call(a,"finallyLoc")&&this.prev<a.finallyLoc){var o=a;break}}o&&("break"===t||"continue"===t)&&o.tryLoc<=e&&e<=o.finallyLoc&&(o=null);var i=o?o.completion:{};return i.type=t,i.arg=e,o?(this.method="next",this.next=o.finallyLoc,u):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),u},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),O(r),u}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var a=n.arg;O(r)}return a}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:S(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),u}},t}(t.exports);try{regeneratorRuntime=n}catch(t){Function("r","regeneratorRuntime = r")(n)}},377:function(t,e,r){"use strict";r.r(e);var n=r(92),a=r.n(n),o=r(12),i=r.n(o);function s(t){return(s="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function c(t,e){return!e||"object"!==s(e)&&"function"!=typeof e?function(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}(t):e}function u(t){return(u=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}function l(t,e){return(l=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}var d=function(t){function e(){var t;return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,e),(t=c(this,u(e).call(this))).data={description:"",metadataSheets:{Balance:0,Cash:0,"Common Shares Outstanding":0,"Fixed Assets":0,Inventories:0,"Other CA":0,"Other CL":0,"Other NCL":0,"Stockholders' Equity":0,"Trade Payables":0,"Trade Receivables":0},metadataStatements:{"Net Operating Profit/(Loss)":0,"Number of Staff":0,Sales:0,"Raw Materials":0,"Direct Production Costs":0,"Cost of Good Sold":0,"Marketing Costs":0,"General Management Costs":0,"Value Added":0,"Staff Salaries & Benefits":0,Depreciation:0,"Other Expense (less Other Income)":0,"Interest On Loan/Hires":0,"Company Tax":0,"Operating Profit/(Loss)[EBT]":0}},t}return function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&l(t,e)}(e,t),e}(r(71).a);function f(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function h(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}function p(t,e,r,n,a,o,i){try{var s=t[o](i),c=s.value}catch(t){return void r(t)}s.done?e(c):Promise.resolve(c).then(n,a)}var v,m,y={props:["value"],components:{PeriodInput:function(){return r.e(53).then(r.bind(null,385))}},computed:{formattedDate:{get:function(){var t,e,r=i()(null===(t=this.resource)||void 0===t?void 0:null===(e=t.data)||void 0===e?void 0:e.period),n=void 0;return r.isValid()&&(n=r.format("MMM YYYY")),n},set:function(t){this.resource.data.period=t}},unFormattedDate:{get:function(){var t,e,r=null===(t=this.resource)||void 0===t?void 0:null===(e=t.data)||void 0===e?void 0:e.period;return i()(r).isValid()?r:void 0},set:function(t){this.resource.data.period=t}}},data:function(){return{resource:new d,edit:!0,menu:!1}},methods:{costOfGoodSold:function(){var t=this.resource.data.metadataStatements;t["Cost of Good Sold"]=this.sum([t["Raw Materials"],t["Direct Production Costs"]])},netProfit:function(){var t=this.resource.data.metadataStatements;t["Value Added"]=t.Sales-this.sum([t["Cost of Good Sold"],t["Marketing Costs"],t["General Management Costs"]]),t["Net Operating Profit/(Loss)"]=t["Value Added"]-this.sum([t["Staff Salaries & Benefits"],t.Depreciation,t["Other Expense (less Other Income)"],t["Interest On Loan/Hires"],t["Company Tax"]]),t["Operating Profit/(Loss)[EBT]"]=t["Net Operating Profit/(Loss)"]},balance:function(){var t=this.resource.data.metadataSheets,e=this.sum([t.Cash,t["Trade Receivables"],t.Inventories,t["Other CA"],t["Fixed Assets"]]),r=this.sum([t["Trade Payables"],t["Other CL"],t["Stockholders' Equity"],t["Other NCL"],t["Common Shares Outstanding"]]);this.resource.data.metadataSheets.Balance=e-r},sum:function(t){return t.reduce((function(t,e){return t+parseFloat(e||0)}),0)},submit:(v=a.a.mark((function t(){return a.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:try{axios.post("/api/v1/financial/save",this.resource.parseData(this.$refs.form.$el))}catch(t){console.log(t)}case 1:case"end":return t.stop()}}),t,this)})),m=function(){var t=this,e=arguments;return new Promise((function(r,n){var a=v.apply(t,e);function o(t){p(a,r,n,o,i,"next",t)}function i(t){p(a,r,n,o,i,"throw",t)}o(void 0)}))},function(){return m.apply(this,arguments)})},watch:{value:{handler:function(t){if(this.resource=new d,!t.id)return this.edit=!0;this.resource.data=function(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?f(Object(r),!0).forEach((function(e){h(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):f(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}({},this.resource.data,{},t),this.edit=!1}},"resource.data":{handler:function(){this.costOfGoodSold(),this.netProfit(),this.balance(),this.$emit("update")},deep:!0}}},g=r(0),b=r(2),w=r.n(b),O=r(278),x=r(609),S=r(627),P=r(281),_=r(287),k=r(611),C=r(612),L=r(626),j=r(52),E=Object(g.a)(y,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("h3",{staticClass:"d-flex align-center mb-3"},[t._v("\n    Financial Period\n    "),r("v-spacer"),t._v(" "),t.resource.data.id?[r("input",{attrs:{type:"hidden",name:"metadata[statement][id]"},domProps:{value:t.resource.data.id}}),t._v(" "),r("v-switch",{staticClass:"mt-0",attrs:{label:t.edit?"Edit":"View",color:"primary","hide-details":""},model:{value:t.edit,callback:function(e){t.edit=e},expression:"edit"}})]:[r("span",{staticClass:"grey--text text--darken-2"},[t._v("Add")])]],2),t._v(" "),t.edit?r("validation-provider",{attrs:{vid:"description",name:t.trans("Description")},scopedSlots:t._u([{key:"default",fn:function(e){e.errors;return[r("v-menu",{ref:"menu",attrs:{"close-on-content-click":!1,transition:"scale-transition","offset-y":"","min-width":"auto"},scopedSlots:t._u([{key:"activator",fn:function(e){var n=e.on,a=e.attrs;return[r("v-text-field",t._g(t._b({attrs:{label:"Period Date","prepend-icon":"mdi-calendar",readonly:"",name:"metadata[statement][metadataStatements][period]"},model:{value:t.formattedDate,callback:function(e){t.formattedDate=e},expression:"formattedDate"}},"v-text-field",a,!1),n))]}}],null,!0),model:{value:t.menu,callback:function(e){t.menu=e},expression:"menu"}},[t._v(" "),r("v-date-picker",{attrs:{"no-title":"",scrollable:""},model:{value:t.unFormattedDate,callback:function(e){t.unFormattedDate=e},expression:"unFormattedDate"}})],1)]}}],null,!1,3423383929)}):r("h4",{staticClass:"mb-3 primary--text",domProps:{textContent:t._s(t.resource.data.period)}},[t._v("\n    Financial Period\n  ")]),t._v(" "),r("v-divider",{staticClass:"my-10"}),t._v(" "),r("h3",[t._v("Financial Statement")]),t._v(" "),t._l(Object.keys(t.resource.data.metadataStatements),(function(e,n){return r("div",{key:n+"a"},["Net Operating Profit/(Loss)"===e?[r("v-row",[r("v-col",{staticClass:"text-right font-weight-bold",attrs:{cols:"6"},domProps:{textContent:t._s(t.trans(e))}}),t._v(" "),r("v-col",{attrs:{cols:"6"}},[t.edit?r("v-text-field",{staticClass:"text-right dt-text-field",class:t.resource.data.metadataStatements[e]>0?"text-green":"text-red",attrs:{color:t.resource.data.metadataStatements[e]>0?"green":"red",dense:"",name:"metadata[statement][metadataStatements]["+e+"]",readonly:""},model:{value:t.resource.data.metadataStatements[e],callback:function(r){t.$set(t.resource.data.metadataStatements,e,r)},expression:"resource.data.metadataStatements[item]"}}):r("div",{staticClass:"text-right",domProps:{textContent:t._s(parseFloat(t.resource.data.metadataStatements[e]||0).toLocaleString())}})],1)],1)]:["Value Added","Operating Profit/(Loss)[EBT]","Cost of Good Sold"].includes(e)?[r("v-row",[r("v-col",{staticClass:"text-right font-weight-bold",attrs:{cols:"6"},domProps:{textContent:t._s(t.trans(e))}}),t._v(" "),r("v-col",{attrs:{cols:"6"}},[t.edit?r("v-text-field",{staticClass:"text-right dt-text-field",attrs:{dense:"",name:"metadata[statement][metadataStatements]["+e+"]",readonly:""},model:{value:t.resource.data.metadataStatements[e],callback:function(r){t.$set(t.resource.data.metadataStatements,e,r)},expression:"resource.data.metadataStatements[item]"}}):r("div",{staticClass:"text-right",domProps:{textContent:t._s(parseFloat(t.resource.data.metadataStatements[e]||0).toLocaleString())}})],1)],1)]:[r("period-input",{attrs:{edit:t.edit,label:e,name:"metadata[statement][metadataStatements]["+e+"]"},model:{value:t.resource.data.metadataStatements[e],callback:function(r){t.$set(t.resource.data.metadataStatements,e,r)},expression:"resource.data.metadataStatements[item]"}})]],2)})),t._v(" "),r("v-card",{attrs:{flat:"",height:"50"}}),t._v(" "),r("v-divider",{staticClass:"my-10"}),t._v(" "),r("h3",[t._v("Balance Sheet")]),t._v(" "),r("v-card",{attrs:{flat:"",height:"50"}}),t._v(" "),t._l(Object.keys(t.resource.data.metadataSheets),(function(e,n){return r("div",{key:n},["Balance"===e?[r("v-row",[r("v-col",{staticClass:"text-right font-weight-bold",attrs:{cols:"6"},domProps:{textContent:t._s("Balance checked!")}}),t._v(" "),r("v-col",{attrs:{cols:"6"}},[t.edit?r("v-text-field",{staticClass:"text-right dt-text-field",class:t.resource.data.metadataSheets[e]?"text-red":"text-green",attrs:{color:t.resource.data.metadataSheets[e]?"red":"green",name:"metadata[statement][metadataSheets]["+e+"]",value:t.resource.data.metadataSheets[e]||"Balance!",dense:"",readonly:""}}):r("div",{staticClass:"text-right",domProps:{textContent:t._s(parseFloat(t.resource.data.metadataSheets[e]||0).toLocaleString())}})],1)],1)]:[r("period-input",{attrs:{edit:t.edit,label:e,name:"metadata[statement][metadataSheets]["+e+"]"},model:{value:t.resource.data.metadataSheets[e],callback:function(r){t.$set(t.resource.data.metadataSheets,e,r)},expression:"resource.data.metadataSheets[item]"}})]],2)}))],2)}),[],!1,null,null,null);e.default=E.exports;w()(E,{VCard:O.a,VCol:x.a,VDatePicker:S.a,VDivider:P.a,VMenu:_.a,VRow:k.a,VSpacer:C.a,VSwitch:L.a,VTextField:j.a})},71:function(t,e,r){"use strict";function n(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function a(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?n(Object(r),!0).forEach((function(e){o(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):n(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function o(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}function i(t,e){for(var r=0;r<e.length;r++){var n=e[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,n.key,n)}}r.d(e,"a",(function(){return s}));var s=function(){function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.isFetching=!0,this.isLoading=!1,this.isFetching=!0,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.data={},this.hasData=!1}var e,r,n;return e=t,(r=[{key:"fetch",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isFetching=t}},{key:"load",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isLoading=t}},{key:"load",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isLoading=t}},{key:"fetch",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isFetching=t}},{key:"prestine",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isPrestine=t}},{key:"valid",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isValid=t}},{key:"setHasData",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.hasData=t}},{key:"setErrors",value:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];this.errors=t}},{key:"setData",value:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];this.data=t}},{key:"isDisabled",value:function(){return this.isLoading||this.isPrestine}},{key:"parseData",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]&&arguments[1],r=(a({},this.data),new FormData(t));return e&&r.append("_method","put"),r}}])&&i(e.prototype,r),n&&i(e,n),t}()},92:function(t,e,r){t.exports=r(143)}}]);
//# sourceMappingURL=8.js.map