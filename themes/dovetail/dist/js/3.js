(window.webpackJsonp=window.webpackJsonp||[]).push([[3],{138:function(t,e,s){var n=s(139);"string"==typeof n&&(n=[[t.i,n,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};s(137)(n,i);n.locals&&(t.exports=n.locals)},139:function(t,e,s){(e=s(136)(!1)).push([t.i,".v-input--checkbox.v-input--indeterminate.v-input--is-disabled {\n  opacity: 0.6;\n}",""]),t.exports=e},27:function(t,e,s){"use strict";e.a={list:function(){return"/api/v1/indices"},store:function(){return"/api/v1/indices"},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/delete/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/restore/".concat(t)},trashed:function(){return"/api/v1/indices/trashed"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(t)},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(t)},translation:function(){return"/api/v1/best/settings/translations/keys"}}},306:function(t,e,s){"use strict";s.r(e);var n=s(27),i=s(78),r=s(76),a=s(6);function o(t,e){var s=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),s.push.apply(s,n)}return s}function c(t){for(var e=1;e<arguments.length;e++){var s=null!=arguments[e]?arguments[e]:{};e%2?o(Object(s),!0).forEach((function(e){l(t,e,s[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(s)):o(Object(s)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(s,e))}))}return t}function l(t,e,s){return e in t?Object.defineProperty(t,e,{value:s,enumerable:!0,configurable:!0,writable:!0}):t[e]=s,t}var d={beforeRouteLeave:function(t,e,s){this.resource.isPrestine?s():this.askUserBeforeNavigatingAway(s)},computed:c({},Object(a.c)({isDense:"settings/fieldIsDense",shortkeyCtrlIsPressed:"shortkey/ctrlIsPressed"}),{isDesktop:function(){return this.$vuetify.breakpoint.mdAndUp},isInvalid:function(){return this.resource.isPrestine||this.resource.loading},isLoading:function(){return this.resource.loading},isFetchingResource:function(){return this.loading},isFinishedFetchingResource:function(){return!this.loading},isFormDisabled:function(){return this.isInvalid||this.resource.isPrestine},isFormPrestine:function(){return this.resource.isPrestine},isNotFormPrestine:function(){return!this.isFormPrestine},metaInfoCardList:function(){return[{icon:"mdi-calendar",text:trans("Created :date",{date:this.resource.data.created})},{icon:"mdi-calendar-edit",text:trans("Modified :date",{date:this.resource.data.modified})}]}}),components:{SkeletonEdit:i.a,SkeletonIcon:r.a},data:function(){return{loading:!0,resource:{data:[]},isValid:!0,tab:null,search:""}},methods:c({},Object(a.b)({hideAlertbox:"alertbox/hide",hideDialog:"dialog/hide",hideErrorbox:"errorbox/hide",hideSnackbar:"snackbar/hide",hideSuccessbox:"successbox/hide",showAlertbox:"alertbox/show",showDialog:"dialog/show",showErrorbox:"errorbox/show",showSnackbar:"snackbar/show",showSuccessbox:"successbox/show"}),{askUserBeforeNavigatingAway:function(t){var e=this;this.showDialog({illustration:function(){return Promise.resolve().then(s.bind(null,552))},title:trans("Unsaved changes will be lost"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Go Back"),callback:function(){e.hideDialog()}},action:{text:trans("Discard"),callback:function(){t(),e.hideDialog()}}}})},load:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=t,this.loading=t},parseResourceData:function(t){_.clone(t);return new FormData(this.$refs["updateform-form"].$el)},parseErrors:function(t){return this.$refs.updateform.setErrors(t),t=Object.values(t).flat(),this.resource.hasErrors=t.length,this.resource.errors},getParseErrors:function(t){return t=Object.values(t).flat(),this.resource.hasErrors=t.length,t},submitForm:function(){this.$refs["submit-button"].click(),window.scrollTo({top:0,left:0,behavior:"smooth"})},submit:function(t){var e=this;this.load(),this.hideAlertbox(),t.preventDefault(),axios.post(n.a.translation(),this.parseResourceData(this.resource.data)).then((function(t){e.showSnackbar({text:trans("Index Settings updated successfully")}),e.$refs.updateform.reset(),e.resource.isPrestine=!0})).catch((function(t){if(t.response.status==Response.HTTP_UNPROCESSABLE_ENTITY){_.size(t.response.data.errors);e.$refs.updateform.setErrors(t.response.data.errors),e.showErrorbox({text:trans(t.response.data.message),errors:t.response.data.errors})}})).finally((function(){e.load(!1)}))},getResource:function(){var t=this;axios.get(n.a.translation()).then((function(e){t.resource.data=e.data,Object.keys(t.resource.data).forEach((function(e){for(var s=[],n=0,i=Object.keys(t.resource.data[e]);n<i.length;n++){var r=i[n];s.push(t.resource.data[e][r])}s=s.map((function(t){return c({},t,{slug:t.en})})).sort((function(t,e){return t.en<e.en?-1:t.en>e.en?1:0})),t.resource.data[e]=s}));var s=Object.keys(e.data)[0];t.tab=s})).finally((function(){t.load(!1),t.resource.isPrestine=!0}))},onSearch:function(t){return t.toLowerCase().includes(this.search.toLowerCase())}}),mounted:function(){this.getResource()},watch:{"resource.data":{handler:function(t){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.updateform.flags.invalid,this.resource.hasErrors||this.hideAlertbox()},deep:!0}}},u=s(0),h=s(2),v=s.n(h),p=s(615),f=s(111),m=s(276),b=s(1),g=(s(138),s(970),s(7)),w=s(47),x=s(96).a.extend({name:"v-checkbox",props:{indeterminate:Boolean,indeterminateIcon:{type:String,default:"$checkboxIndeterminate"},offIcon:{type:String,default:"$checkboxOff"},onIcon:{type:String,default:"$checkboxOn"}},data(){return{inputIndeterminate:this.indeterminate}},computed:{classes(){return{...w.a.options.computed.classes.call(this),"v-input--selection-controls":!0,"v-input--checkbox":!0,"v-input--indeterminate":this.inputIndeterminate}},computedIcon(){return this.inputIndeterminate?this.indeterminateIcon:this.isActive?this.onIcon:this.offIcon},validationState(){if(!this.disabled||this.inputIndeterminate)return this.hasError&&this.shouldValidate?"error":this.hasSuccess?"success":null!==this.hasColor?this.computedColor:void 0}},watch:{indeterminate(t){this.$nextTick(()=>this.inputIndeterminate=t)},inputIndeterminate(t){this.$emit("update:indeterminate",t)},isActive(){this.indeterminate&&(this.inputIndeterminate=!1)}},methods:{genCheckbox(){return this.$createElement("div",{staticClass:"v-input--selection-controls__input"},[this.genInput("checkbox",{...this.attrs$,"aria-checked":this.inputIndeterminate?"mixed":this.isActive.toString()}),this.genRipple(this.setTextColor(this.validationState)),this.$createElement(g.a,this.setTextColor(this.validationState,{props:{dense:this.dense,dark:this.dark,light:this.light}}),this.computedIcon)])},genDefaultSlot(){return[this.genCheckbox(),this.genLabel()]}}}),y=s(608),k=s(609),C=s(5),T=s(622),I=s(98),S=s(610),P=s(611),O=s(624),E=s(373),j=s(628),V=s(368),$=s(51),D=s(20),F=Object(u.a)(d,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("admin",{scopedSlots:t._u([{key:"appbar",fn:function(){return[s("v-container",{staticClass:"py-0 px-0"},[s("v-row",{attrs:{justify:"space-between",align:"center"}},[s("v-fade-transition",[t.isNotFormPrestine?s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("v-toolbar-title",{staticClass:"muted--text"},[t._v(t._s(t.trans("Unsaved changes")))])],1):t._e()],1),t._v(" "),s("v-spacer"),t._v(" "),s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("div",{staticClass:"d-flex justify-end"},[s("v-spacer"),t._v(" "),s("v-badge",{staticClass:"dt-badge",attrs:{bordered:"",bottom:"",color:"dark",content:"s","offset-x":"20","offset-y":"20",tile:"",transition:"fade-transition"},model:{value:t.shortkeyCtrlIsPressed,callback:function(e){t.shortkeyCtrlIsPressed=e},expression:"shortkeyCtrlIsPressed"}},[s("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","s"],expression:"['ctrl', 's']",modifiers:{once:!0}}],ref:"submit-button-main",staticClass:"ml-3 mr-0",attrs:{loading:t.isLoading,color:"primary",large:"",type:"submit"},on:{click:function(e){return e.preventDefault(),t.submitForm(e)},shortkey:t.submitForm}},[s("v-icon",{attrs:{left:""}},[t._v("mdi-content-save-outline")]),t._v("\n                "+t._s(t.trans("Save"))+"\n              ")],1)],1)],1)])],1)],1)]},proxy:!0}])},[s("metatag",{attrs:{title:t.__("Summary of Test")}}),t._v(" "),t._v(" "),s("validation-observer",{ref:"updateform",scopedSlots:t._u([{key:"default",fn:function(e){var n=e.handleSubmit;e.errors,e.invalid,e.passed;return[s("v-form",{ref:"updateform-form",attrs:{disabled:t.isLoading,autocomplete:"false",enctype:"multipart/form-data"},on:{submit:function(e){e.preventDefault(),n(t.submit(e))}}},[s("button",{ref:"submit-button",staticClass:"d-none",attrs:{type:"submit"}}),t._v(" "),s("page-header",{scopedSlots:t._u([{key:"title",fn:function(){return[t._v("\n          "+t._s(t.trans("Summary of Recommendation"))+"\n        ")]},proxy:!0}],null,!0)}),t._v(" "),s("alertbox"),t._v(" "),s("v-row",[s("v-col",{attrs:{cols:"12"}},[t.isFetchingResource?[s("skeleton-edit")]:t._e(),t._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:t.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],staticClass:"mb-3"},[s("v-tabs",{attrs:{"show-arrows":"","background-color":"transparent"},model:{value:t.tab,callback:function(e){t.tab=e},expression:"tab"}},t._l(t.resource.data,(function(e,n){return s("v-tab",{key:n},[s("span",{domProps:{textContent:t._s(t.trans(n))}})])})),1),t._v(" "),s("v-tabs-items",{model:{value:t.tab,callback:function(e){t.tab=e},expression:"tab"}},t._l(t.resource.data,(function(e,n){return s("v-tab-item",{key:n},[s("v-card",[s("v-card-text",[s("v-row",[s("v-col",{attrs:{cols:"12",md:"6"}},[s("v-text-field",{attrs:{label:"Search",outlined:"","prepend-inner-icon":"mdi-magnify"},model:{value:t.search,callback:function(e){t.search=e},expression:"search"}})],1)],1),t._v(" "),t._l(e,(function(e,n){return s("div",{key:n},[s("v-row",{class:{"d-none":!t.onSearch(e.slug)}},[s("v-col",{attrs:{cols:"12",md:"5"}},[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:t.isDense,disabled:t.isLoading,label:t.trans("English"),outlined:"","hide-details":""},model:{value:e.en,callback:function(s){t.$set(e,"en",s)},expression:"item.en"}})],1),t._v(" "),s("v-col",{attrs:{cols:"12",md:"5"}},[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:t.isDense,disabled:t.isLoading,label:t.trans("Arabic"),outlined:"",name:"translations["+e.en+"][ar]","hide-details":""},model:{value:e.ar,callback:function(s){t.$set(e,"ar",s)},expression:"item.ar"}})],1),t._v(" "),s("v-col",{attrs:{cols:"12",md:"2"}},[s("v-checkbox",{attrs:{label:"Priority",name:"translations["+e.en+"][priority]",value:e.priority},model:{value:e.priority,callback:function(s){t.$set(e,"priority",s)},expression:"item.priority"}}),t._v(" "),s("input",{attrs:{type:"text",name:"translations["+e.en+"][key]",hidden:""},domProps:{value:e.key}}),t._v(" "),s("input",{attrs:{type:"text",name:"translations["+e.en+"][name]",hidden:""},domProps:{value:e.name}}),t._v(" "),s("input",{attrs:{type:"text",name:"translations["+e.en+"][idkey]",hidden:""},domProps:{value:e.idKey}})],1)],1)],1)}))],2)],1)],1)})),1)],1)],2)],1)],1)]}}])})],1)}),[],!1,null,null,null);e.default=F.exports;v()(F,{VBadge:p.a,VBtn:f.a,VCard:m.a,VCardText:b.c,VCheckbox:x,VCol:y.a,VContainer:k.a,VFadeTransition:C.d,VForm:T.a,VIcon:I.a,VRow:S.a,VSpacer:P.a,VTab:O.a,VTabItem:E.a,VTabs:j.a,VTabsItems:V.a,VTextField:$.a,VToolbarTitle:D.a})},373:function(t,e,s){"use strict";var n=s(83),i=s(45),r=s(50),a=s(3),o=s(9);var c=Object(o.a)(n.a,Object(i.a)("windowGroup","v-window-item","v-window")).extend().extend().extend({name:"v-window-item",directives:{Touch:r.a},props:{disabled:Boolean,reverseTransition:{type:[Boolean,String],default:void 0},transition:{type:[Boolean,String],default:void 0},value:{required:!1}},data:()=>({isActive:!1,inTransition:!1}),computed:{classes(){return this.groupClasses},computedTransition(){return this.windowGroup.internalReverse?void 0!==this.reverseTransition?this.reverseTransition||"":this.windowGroup.computedTransition:void 0!==this.transition?this.transition||"":this.windowGroup.computedTransition}},methods:{genDefaultSlot(){return this.$slots.default},genWindowItem(){return this.$createElement("div",{staticClass:"v-window-item",class:this.classes,directives:[{name:"show",value:this.isActive}],on:this.$listeners},this.showLazyContent(this.genDefaultSlot()))},onAfterTransition(){this.inTransition&&(this.inTransition=!1,this.windowGroup.transitionCount>0&&(this.windowGroup.transitionCount--,0===this.windowGroup.transitionCount&&(this.windowGroup.transitionHeight=void 0)))},onBeforeTransition(){this.inTransition||(this.inTransition=!0,0===this.windowGroup.transitionCount&&(this.windowGroup.transitionHeight=Object(a.h)(this.windowGroup.$el.clientHeight)),this.windowGroup.transitionCount++)},onTransitionCancelled(){this.onAfterTransition()},onEnter(t){this.inTransition&&this.$nextTick(()=>{this.computedTransition&&this.inTransition&&(this.windowGroup.transitionHeight=Object(a.h)(t.clientHeight))})}},render(t){return t("transition",{props:{name:this.computedTransition},on:{beforeEnter:this.onBeforeTransition,afterEnter:this.onAfterTransition,enterCancelled:this.onTransitionCancelled,beforeLeave:this.onBeforeTransition,afterLeave:this.onAfterTransition,leaveCancelled:this.onTransitionCancelled,enter:this.onEnter}},[this.genWindowItem()])}});e.a=c.extend({name:"v-tab-item",props:{id:String},methods:{genWindowItem(){const t=c.options.methods.genWindowItem.call(this);return t.data.domProps=t.data.domProps||{},t.data.domProps.id=this.id||this.value,t}}})},76:function(t,e,s){"use strict";var n=s(0),i=s(2),r=s.n(i),a=s(276),o=s(1),c=s(623),l=Object(n.a)({},(function(){var t=this.$createElement,e=this._self._c||t;return e("v-card",{staticClass:"mb-3"},[e("v-card-title",{staticClass:"pb-0"},[this._v(this._s(this.__("Icon")))]),this._v(" "),e("v-card-text",{staticClass:"text-center"},[e("div",{staticClass:"d-flex justify-center"},[e("v-skeleton-loader",{staticClass:"dt-skeleton-avatar-upload",attrs:{type:"avatar"}})],1)])],1)}),[],!1,null,null,null);e.a=l.exports;r()(l,{VCard:a.a,VCardText:o.c,VCardTitle:o.d,VSkeletonLoader:c.a})},78:function(t,e,s){"use strict";var n=s(0),i=s(2),r=s.n(i),a=s(276),o=s(1),c=s(608),l=s(610),d=s(623),u=Object(n.a)({},(function(){var t=this.$createElement,e=this._self._c||t;return e("v-row",[e("v-col",{attrs:{cols:"12"}},[e("v-card",{staticClass:"mb-3"},[e("v-card-text",[e("v-row",[e("v-col",{attrs:{cols:"12"}},[e("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12"}},[e("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12"}},[e("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12"}},[e("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12"}},[e("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"120",type:"image"}})],1)],1)],1)],1)],1)],1)}),[],!1,null,null,null);e.a=u.exports;r()(u,{VCard:a.a,VCardText:o.c,VCol:c.a,VRow:l.a,VSkeletonLoader:d.a})}}]);
//# sourceMappingURL=3.js.map