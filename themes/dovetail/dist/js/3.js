(window.webpackJsonp=window.webpackJsonp||[]).push([[3],{133:function(t,e,n){var i=n(134);"string"==typeof i&&(i=[[t.i,i,""]]);var s={hmr:!0,transform:void 0,insertInto:void 0};n(132)(i,s);i.locals&&(t.exports=i.locals)},134:function(t,e,n){(e=n(131)(!1)).push([t.i,".v-input--checkbox.v-input--indeterminate.v-input--is-disabled {\n  opacity: 0.6;\n}",""]),t.exports=e},135:function(t,e,n){var i=n(136);"string"==typeof i&&(i=[[t.i,i,""]]);var s={hmr:!0,transform:void 0,insertInto:void 0};n(132)(i,s);i.locals&&(t.exports=i.locals)},136:function(t,e,n){(e=n(131)(!1)).push([t.i,'.theme--light.v-input--selection-controls.v-input--is-disabled:not(.v-input--indeterminate) .v-icon {\n  color: rgba(0, 0, 0, 0.26) !important;\n}\n\n.theme--dark.v-input--selection-controls.v-input--is-disabled:not(.v-input--indeterminate) .v-icon {\n  color: rgba(255, 255, 255, 0.3) !important;\n}\n\n.v-input--selection-controls {\n  margin-top: 16px;\n  padding-top: 4px;\n}\n.v-input--selection-controls > .v-input__append-outer,\n.v-input--selection-controls > .v-input__prepend-outer {\n  margin-top: 0;\n  margin-bottom: 0;\n}\n.v-input--selection-controls:not(.v-input--hide-details) > .v-input__slot {\n  margin-bottom: 12px;\n}\n.v-input--selection-controls__input {\n  color: inherit;\n  display: -webkit-inline-box;\n  display: inline-flex;\n  -webkit-box-flex: 0;\n          flex: 0 0 auto;\n  height: 24px;\n  position: relative;\n  -webkit-transition: 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);\n  transition: 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);\n  -webkit-transition-property: color, -webkit-transform;\n  transition-property: color, -webkit-transform;\n  transition-property: color, transform;\n  transition-property: color, transform, -webkit-transform;\n  width: 24px;\n  -webkit-user-select: none;\n     -moz-user-select: none;\n      -ms-user-select: none;\n          user-select: none;\n}\n.v-application--is-ltr .v-input--selection-controls__input {\n  margin-right: 8px;\n}\n.v-application--is-rtl .v-input--selection-controls__input {\n  margin-left: 8px;\n}\n.v-input--selection-controls__input input[role=checkbox],\n.v-input--selection-controls__input input[role=radio],\n.v-input--selection-controls__input input[role=switch] {\n  position: absolute;\n  opacity: 0;\n  width: 100%;\n  height: 100%;\n  cursor: pointer;\n  -webkit-user-select: none;\n     -moz-user-select: none;\n      -ms-user-select: none;\n          user-select: none;\n}\n.v-input--selection-controls__input + .v-label {\n  cursor: pointer;\n  -webkit-user-select: none;\n     -moz-user-select: none;\n      -ms-user-select: none;\n          user-select: none;\n}\n.v-input--selection-controls__ripple {\n  border-radius: 50%;\n  cursor: pointer;\n  height: 34px;\n  position: absolute;\n  -webkit-transition: inherit;\n  transition: inherit;\n  width: 34px;\n  left: -12px;\n  top: calc(50% - 24px);\n  margin: 7px;\n}\n.v-input--selection-controls__ripple:before {\n  border-radius: inherit;\n  bottom: 0;\n  content: "";\n  position: absolute;\n  opacity: 0.2;\n  left: 0;\n  right: 0;\n  top: 0;\n  -webkit-transform-origin: center center;\n          transform-origin: center center;\n  -webkit-transform: scale(0.2);\n          transform: scale(0.2);\n  -webkit-transition: inherit;\n  transition: inherit;\n}\n.v-input--selection-controls__ripple > .v-ripple__container {\n  -webkit-transform: scale(1.2);\n          transform: scale(1.2);\n}\n.v-input--selection-controls.v-input--dense .v-input--selection-controls__ripple {\n  width: 28px;\n  height: 28px;\n  left: -11px;\n}\n.v-input--selection-controls.v-input--dense:not(.v-input--switch) .v-input--selection-controls__ripple {\n  top: calc(50% - 21px);\n}\n.v-input--selection-controls.v-input {\n  -webkit-box-flex: 0;\n          flex: 0 1 auto;\n}\n.v-input--selection-controls.v-input--is-focused .v-input--selection-controls__ripple:before,\n.v-input--selection-controls .v-radio--is-focused .v-input--selection-controls__ripple:before {\n  background: currentColor;\n  opacity: 0.4;\n  -webkit-transform: scale(1.2);\n          transform: scale(1.2);\n}\n.v-input--selection-controls .v-input--selection-controls__input:hover .v-input--selection-controls__ripple:before {\n  background: currentColor;\n  -webkit-transform: scale(1.2);\n          transform: scale(1.2);\n  -webkit-transition: none;\n  transition: none;\n}',""]),t.exports=e},26:function(t,e,n){"use strict";e.a={list:function(){return"/api/v1/indices"},store:function(){return"/api/v1/indices"},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/delete/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/restore/".concat(t)},trashed:function(){return"/api/v1/indices/trashed"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(t)},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(t)},translation:function(){return"/api/v1/best/settings/translations/keys"}}},297:function(t,e,n){"use strict";n.r(e);var i=n(26),s=n(75),r=n(74),o=n(6);function a(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,i)}return n}function l(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?a(Object(n),!0).forEach((function(e){c(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):a(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function c(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var u={beforeRouteLeave:function(t,e,n){this.resource.isPrestine?n():this.askUserBeforeNavigatingAway(n)},computed:l({},Object(o.c)({isDense:"settings/fieldIsDense",shortkeyCtrlIsPressed:"shortkey/ctrlIsPressed"}),{isDesktop:function(){return this.$vuetify.breakpoint.mdAndUp},isInvalid:function(){return this.resource.isPrestine||this.resource.loading},isLoading:function(){return this.resource.loading},isFetchingResource:function(){return this.loading},isFinishedFetchingResource:function(){return!this.loading},isFormDisabled:function(){return this.isInvalid||this.resource.isPrestine},isFormPrestine:function(){return this.resource.isPrestine},isNotFormPrestine:function(){return!this.isFormPrestine},metaInfoCardList:function(){return[{icon:"mdi-calendar",text:trans("Created :date",{date:this.resource.data.created})},{icon:"mdi-calendar-edit",text:trans("Modified :date",{date:this.resource.data.modified})}]}}),components:{SkeletonEdit:s.a,SkeletonIcon:r.a},data:function(){return{loading:!0,resource:{data:[]},isValid:!0,tab:null,search:""}},methods:l({},Object(o.b)({hideAlertbox:"alertbox/hide",hideDialog:"dialog/hide",hideErrorbox:"errorbox/hide",hideSnackbar:"snackbar/hide",hideSuccessbox:"successbox/hide",showAlertbox:"alertbox/show",showDialog:"dialog/show",showErrorbox:"errorbox/show",showSnackbar:"snackbar/show",showSuccessbox:"successbox/show"}),{askUserBeforeNavigatingAway:function(t){var e=this;this.showDialog({illustration:function(){return Promise.resolve().then(n.bind(null,514))},title:trans("Unsaved changes will be lost"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Go Back"),callback:function(){e.hideDialog()}},action:{text:trans("Discard"),callback:function(){t(),e.hideDialog()}}}})},load:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=t,this.loading=t},parseResourceData:function(t){_.clone(t);return new FormData(this.$refs["updateform-form"].$el)},parseErrors:function(t){return this.$refs.updateform.setErrors(t),t=Object.values(t).flat(),this.resource.hasErrors=t.length,this.resource.errors},getParseErrors:function(t){return t=Object.values(t).flat(),this.resource.hasErrors=t.length,t},submitForm:function(){this.$refs["submit-button"].click(),window.scrollTo({top:0,left:0,behavior:"smooth"})},submit:function(t){var e=this;this.load(),this.hideAlertbox(),t.preventDefault(),axios.post(i.a.translation(),this.parseResourceData(this.resource.data)).then((function(t){e.showSnackbar({text:trans("Index Settings updated successfully")}),e.$refs.updateform.reset(),e.resource.isPrestine=!0})).catch((function(t){if(t.response.status==Response.HTTP_UNPROCESSABLE_ENTITY){_.size(t.response.data.errors);e.$refs.updateform.setErrors(t.response.data.errors),e.showErrorbox({text:trans(t.response.data.message),errors:t.response.data.errors})}})).finally((function(){e.load(!1)}))},getResource:function(){var t=this;axios.get(i.a.translation()).then((function(e){t.resource.data=e.data,Object.keys(t.resource.data).forEach((function(e){for(var n=[],i=0,s=Object.keys(t.resource.data[e]);i<s.length;i++){var r=s[i];n.push(t.resource.data[e][r])}n=n.map((function(t){return l({},t,{slug:t.en})})).sort((function(t,e){return t.en<e.en?-1:t.en>e.en?1:0})),t.resource.data[e]=n}));var n=Object.keys(e.data)[0];t.tab=n})).finally((function(){t.load(!1),t.resource.isPrestine=!0}))},onSearch:function(t){return t.toLowerCase().includes(this.search.toLowerCase())}}),mounted:function(){this.getResource()},watch:{"resource.data":{handler:function(t){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.updateform.flags.invalid,this.resource.hasErrors||this.hideAlertbox()},deep:!0}}},d=n(0),h=n(2),p=n.n(h),v=n(599),m=n(107),f=n(271),b=n(1),g=(n(133),n(135),n(7)),w=n(44),x=n(32),y=n(13).a.extend({name:"rippleable",directives:{ripple:x.a},props:{ripple:{type:[Boolean,Object],default:!0}},methods:{genRipple(t={}){return this.ripple?(t.staticClass="v-input--selection-controls__ripple",t.directives=t.directives||[],t.directives.push({name:"ripple",value:{center:!0}}),t.on=Object.assign({click:this.onChange},this.$listeners),this.$createElement("div",t)):null},onChange(){}}}),k=n(91),C=n(8),V=Object(C.a)(w.a,y,k.a).extend({name:"selectable",model:{prop:"inputValue",event:"change"},props:{id:String,inputValue:null,falseValue:null,trueValue:null,multiple:{type:Boolean,default:null},label:String},data(){return{hasColor:this.inputValue,lazyValue:this.inputValue}},computed:{computedColor(){if(this.isActive)return this.color?this.color:this.isDark&&!this.appIsDark?"white":"accent"},isMultiple(){return!0===this.multiple||null===this.multiple&&Array.isArray(this.internalValue)},isActive(){const t=this.value,e=this.internalValue;return this.isMultiple?!!Array.isArray(e)&&e.some(e=>this.valueComparator(e,t)):void 0===this.trueValue||void 0===this.falseValue?t?this.valueComparator(t,e):Boolean(e):this.valueComparator(e,this.trueValue)},isDirty(){return this.isActive}},watch:{inputValue(t){this.lazyValue=t,this.hasColor=t}},methods:{genLabel(){const t=w.a.options.methods.genLabel.call(this);return t?(t.data.on={click:t=>{t.preventDefault(),this.onChange()}},t):t},genInput(t,e){return this.$createElement("input",{attrs:Object.assign({"aria-checked":this.isActive.toString(),disabled:this.isDisabled,id:this.computedId,role:t,type:t},e),domProps:{value:this.value,checked:this.isActive},on:{blur:this.onBlur,change:this.onChange,focus:this.onFocus,keydown:this.onKeydown},ref:"input"})},onBlur(){this.isFocused=!1},onChange(){if(this.isDisabled)return;const t=this.value;let e=this.internalValue;if(this.isMultiple){Array.isArray(e)||(e=[]);const n=e.length;e=e.filter(e=>!this.valueComparator(e,t)),e.length===n&&e.push(t)}else e=void 0!==this.trueValue&&void 0!==this.falseValue?this.valueComparator(e,this.trueValue)?this.falseValue:this.trueValue:t?this.valueComparator(e,t)?null:t:!e;this.validate(!0,e),this.internalValue=e,this.hasColor=e},onFocus(){this.isFocused=!0},onKeydown(t){}}}).extend({name:"v-checkbox",props:{indeterminate:Boolean,indeterminateIcon:{type:String,default:"$checkboxIndeterminate"},offIcon:{type:String,default:"$checkboxOff"},onIcon:{type:String,default:"$checkboxOn"}},data(){return{inputIndeterminate:this.indeterminate}},computed:{classes(){return{...w.a.options.computed.classes.call(this),"v-input--selection-controls":!0,"v-input--checkbox":!0,"v-input--indeterminate":this.inputIndeterminate}},computedIcon(){return this.inputIndeterminate?this.indeterminateIcon:this.isActive?this.onIcon:this.offIcon},validationState(){if(!this.disabled||this.inputIndeterminate)return this.hasError&&this.shouldValidate?"error":this.hasSuccess?"success":null!==this.hasColor?this.computedColor:void 0}},watch:{indeterminate(t){this.$nextTick(()=>this.inputIndeterminate=t)},inputIndeterminate(t){this.$emit("update:indeterminate",t)},isActive(){this.indeterminate&&(this.inputIndeterminate=!1)}},methods:{genCheckbox(){return this.$createElement("div",{staticClass:"v-input--selection-controls__input"},[this.genInput("checkbox",{...this.attrs$,"aria-checked":this.inputIndeterminate?"mixed":this.isActive.toString()}),this.genRipple(this.setTextColor(this.validationState)),this.$createElement(g.a,this.setTextColor(this.validationState,{props:{dense:this.dense,dark:this.dark,light:this.light}}),this.computedIcon)])},genDefaultSlot(){return[this.genCheckbox(),this.genLabel()]}}}),T=n(592),I=n(593),S=n(5),O=n(606),P=n(94),j=n(594),E=n(595),D=n(608),$=n(366),A=n(612),F=n(361),B=n(49),L=n(20),R=Object(d.a)(u,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("admin",{scopedSlots:t._u([{key:"appbar",fn:function(){return[n("v-container",{staticClass:"py-0 px-0"},[n("v-row",{attrs:{justify:"space-between",align:"center"}},[n("v-fade-transition",[t.isNotFormPrestine?n("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[n("v-toolbar-title",{staticClass:"muted--text"},[t._v(t._s(t.trans("Unsaved changes")))])],1):t._e()],1),t._v(" "),n("v-spacer"),t._v(" "),n("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[n("div",{staticClass:"d-flex justify-end"},[n("v-spacer"),t._v(" "),n("v-badge",{staticClass:"dt-badge",attrs:{bordered:"",bottom:"",color:"dark",content:"s","offset-x":"20","offset-y":"20",tile:"",transition:"fade-transition"},model:{value:t.shortkeyCtrlIsPressed,callback:function(e){t.shortkeyCtrlIsPressed=e},expression:"shortkeyCtrlIsPressed"}},[n("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","s"],expression:"['ctrl', 's']",modifiers:{once:!0}}],ref:"submit-button-main",staticClass:"ml-3 mr-0",attrs:{loading:t.isLoading,color:"primary",large:"",type:"submit"},on:{click:function(e){return e.preventDefault(),t.submitForm(e)},shortkey:t.submitForm}},[n("v-icon",{attrs:{left:""}},[t._v("mdi-content-save-outline")]),t._v("\n                "+t._s(t.trans("Save"))+"\n              ")],1)],1)],1)])],1)],1)]},proxy:!0}])},[n("metatag",{attrs:{title:t.__("Summary of Test")}}),t._v(" "),t._v(" "),n("validation-observer",{ref:"updateform",scopedSlots:t._u([{key:"default",fn:function(e){var i=e.handleSubmit;e.errors,e.invalid,e.passed;return[n("v-form",{ref:"updateform-form",attrs:{disabled:t.isLoading,autocomplete:"false",enctype:"multipart/form-data"},on:{submit:function(e){e.preventDefault(),i(t.submit(e))}}},[n("button",{ref:"submit-button",staticClass:"d-none",attrs:{type:"submit"}}),t._v(" "),n("page-header",{scopedSlots:t._u([{key:"title",fn:function(){return[t._v("\n          "+t._s(t.trans("Summary of Recommendation"))+"\n        ")]},proxy:!0}],null,!0)}),t._v(" "),n("alertbox"),t._v(" "),n("v-row",[n("v-col",{attrs:{cols:"12"}},[t.isFetchingResource?[n("skeleton-edit")]:t._e(),t._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:t.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],staticClass:"mb-3"},[n("v-tabs",{attrs:{"show-arrows":"","background-color":"transparent"},model:{value:t.tab,callback:function(e){t.tab=e},expression:"tab"}},t._l(t.resource.data,(function(e,i){return n("v-tab",{key:i},[n("span",{domProps:{textContent:t._s(t.trans(i))}})])})),1),t._v(" "),n("v-tabs-items",{model:{value:t.tab,callback:function(e){t.tab=e},expression:"tab"}},t._l(t.resource.data,(function(e,i){return n("v-tab-item",{key:i},[n("v-card",[n("v-card-text",[n("v-row",[n("v-col",{attrs:{cols:"12",md:"6"}},[n("v-text-field",{attrs:{label:"Search",outlined:"","prepend-inner-icon":"mdi-magnify"},model:{value:t.search,callback:function(e){t.search=e},expression:"search"}})],1)],1),t._v(" "),t._l(e,(function(e,i){return n("div",{key:i},[n("v-row",{class:{"d-none":!t.onSearch(e.slug)}},[n("v-col",{attrs:{cols:"12",md:"5"}},[n("v-text-field",{staticClass:"dt-text-field",attrs:{dense:t.isDense,disabled:t.isLoading,label:t.trans("English"),outlined:"","hide-details":""},model:{value:e.en,callback:function(n){t.$set(e,"en",n)},expression:"item.en"}})],1),t._v(" "),n("v-col",{attrs:{cols:"12",md:"5"}},[n("v-text-field",{staticClass:"dt-text-field",attrs:{dense:t.isDense,disabled:t.isLoading,label:t.trans("Arabic"),outlined:"",name:"translations["+e.en+"][ar]","hide-details":""},model:{value:e.ar,callback:function(n){t.$set(e,"ar",n)},expression:"item.ar"}})],1),t._v(" "),n("v-col",{attrs:{cols:"12",md:"2"}},[n("v-checkbox",{attrs:{label:"Priority",name:"translations["+e.en+"][priority]",value:e.priority},model:{value:e.priority,callback:function(n){t.$set(e,"priority",n)},expression:"item.priority"}}),t._v(" "),n("input",{attrs:{type:"text",name:"translations["+e.en+"][key]",hidden:""},domProps:{value:e.key}}),t._v(" "),n("input",{attrs:{type:"text",name:"translations["+e.en+"][name]",hidden:""},domProps:{value:e.name}}),t._v(" "),n("input",{attrs:{type:"text",name:"translations["+e.en+"][idkey]",hidden:""},domProps:{value:e.idKey}})],1)],1)],1)}))],2)],1)],1)})),1)],1)],2)],1)],1)]}}])})],1)}),[],!1,null,null,null);e.default=R.exports;p()(R,{VBadge:v.a,VBtn:m.a,VCard:f.a,VCardText:b.c,VCheckbox:V,VCol:T.a,VContainer:I.a,VFadeTransition:S.c,VForm:O.a,VIcon:P.a,VRow:j.a,VSpacer:E.a,VTab:D.a,VTabItem:$.a,VTabs:A.a,VTabsItems:F.a,VTextField:B.a,VToolbarTitle:L.a})},366:function(t,e,n){"use strict";var i=n(80),s=n(45),r=n(59),o=n(3),a=n(8);var l=Object(a.a)(i.a,Object(s.a)("windowGroup","v-window-item","v-window")).extend().extend().extend({name:"v-window-item",directives:{Touch:r.a},props:{disabled:Boolean,reverseTransition:{type:[Boolean,String],default:void 0},transition:{type:[Boolean,String],default:void 0},value:{required:!1}},data:()=>({isActive:!1,inTransition:!1}),computed:{classes(){return this.groupClasses},computedTransition(){return this.windowGroup.internalReverse?void 0!==this.reverseTransition?this.reverseTransition||"":this.windowGroup.computedTransition:void 0!==this.transition?this.transition||"":this.windowGroup.computedTransition}},methods:{genDefaultSlot(){return this.$slots.default},genWindowItem(){return this.$createElement("div",{staticClass:"v-window-item",class:this.classes,directives:[{name:"show",value:this.isActive}],on:this.$listeners},this.showLazyContent(this.genDefaultSlot()))},onAfterTransition(){this.inTransition&&(this.inTransition=!1,this.windowGroup.transitionCount>0&&(this.windowGroup.transitionCount--,0===this.windowGroup.transitionCount&&(this.windowGroup.transitionHeight=void 0)))},onBeforeTransition(){this.inTransition||(this.inTransition=!0,0===this.windowGroup.transitionCount&&(this.windowGroup.transitionHeight=Object(o.h)(this.windowGroup.$el.clientHeight)),this.windowGroup.transitionCount++)},onTransitionCancelled(){this.onAfterTransition()},onEnter(t){this.inTransition&&this.$nextTick(()=>{this.computedTransition&&this.inTransition&&(this.windowGroup.transitionHeight=Object(o.h)(t.clientHeight))})}},render(t){return t("transition",{props:{name:this.computedTransition},on:{beforeEnter:this.onBeforeTransition,afterEnter:this.onAfterTransition,enterCancelled:this.onTransitionCancelled,beforeLeave:this.onBeforeTransition,afterLeave:this.onAfterTransition,leaveCancelled:this.onTransitionCancelled,enter:this.onEnter}},[this.genWindowItem()])}});e.a=l.extend({name:"v-tab-item",props:{id:String},methods:{genWindowItem(){const t=l.options.methods.genWindowItem.call(this);return t.data.domProps=t.data.domProps||{},t.data.domProps.id=this.id||this.value,t}}})},74:function(t,e,n){"use strict";var i=n(0),s=n(2),r=n.n(s),o=n(271),a=n(1),l=n(607),c=Object(i.a)({},(function(){var t=this.$createElement,e=this._self._c||t;return e("v-card",{staticClass:"mb-3"},[e("v-card-title",{staticClass:"pb-0"},[this._v(this._s(this.__("Icon")))]),this._v(" "),e("v-card-text",{staticClass:"text-center"},[e("div",{staticClass:"d-flex justify-center"},[e("v-skeleton-loader",{staticClass:"dt-skeleton-avatar-upload",attrs:{type:"avatar"}})],1)])],1)}),[],!1,null,null,null);e.a=c.exports;r()(c,{VCard:o.a,VCardText:a.c,VCardTitle:a.d,VSkeletonLoader:l.a})},75:function(t,e,n){"use strict";var i=n(0),s=n(2),r=n.n(s),o=n(271),a=n(1),l=n(592),c=n(594),u=n(607),d=Object(i.a)({},(function(){var t=this.$createElement,e=this._self._c||t;return e("v-row",[e("v-col",{attrs:{cols:"12"}},[e("v-card",{staticClass:"mb-3"},[e("v-card-text",[e("v-row",[e("v-col",{attrs:{cols:"12"}},[e("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12"}},[e("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12"}},[e("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12"}},[e("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12"}},[e("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"120",type:"image"}})],1)],1)],1)],1)],1)],1)}),[],!1,null,null,null);e.a=d.exports;r()(d,{VCard:o.a,VCardText:a.c,VCol:l.a,VRow:c.a,VSkeletonLoader:u.a})}}]);
//# sourceMappingURL=3.js.map