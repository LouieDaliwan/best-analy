(window.webpackJsonp=window.webpackJsonp||[]).push([[19],{253:function(t,e,s){"use strict";s.r(e);s(51);var a=s(22),n={name:"Login",data:function(){return{action:this.action,auth:{username:"",password:""},loading:!1,showPassword:!1}},computed:{isMobile:function(){return this.$vuetify.breakpoint.smAndDown}},methods:{load:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.loading=t},submit:function(t){var e=this,s=this.auth,n=s.username,r=s.password;this.load(),this.$store.dispatch("auth/login",{username:n,password:r}).then((function(){e.$router.push({name:"dashboard"}),e.$store.dispatch("snackbar/show",{text:$t("Welcome back, ")+a.default.getUser().firstname})})).catch((function(t){e.$refs["signin-form"].setErrors(t.response.data.errors)})).finally((function(){e.load(!1)})),t.preventDefault()}}},r=s(1),o=s(3),i=s.n(o),l=s(81),d=s(492),u=s(67),c=s(7),m=s(38),f=Object(r.a)(n,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("validation-observer",{ref:"signin-form",scopedSlots:t._u([{key:"default",fn:function(e){e.passes;return[s("v-form",{attrs:{disabled:t.loading},on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[s("validation-provider",{attrs:{name:"username",rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var a=e.errors;return[s("v-text-field",{staticClass:"mb-3",attrs:{"error-messages":a,label:t.$t("Username or email"),autofocus:"",outlined:"","clear-icon":"mdi mdi-close-circle-outline",clearable:""},model:{value:t.auth.username,callback:function(e){t.$set(t.auth,"username",e)},expression:"auth.username"}})]}}],null,!0)}),t._v(" "),s("validation-provider",{attrs:{name:"password",rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var a=e.errors;return[s("v-text-field",{staticClass:"mb-3",attrs:{"append-icon":t.showPassword?"mdi-eye":"mdi-eye-off","error-messages":a,label:t.$t("Password"),type:t.showPassword?"text":"password","clear-icon":"mdi mdi-close-circle-outline",clearable:"",outlined:"",password:""},on:{"click:append":function(e){t.showPassword=!t.showPassword}},model:{value:t.auth.password,callback:function(e){t.$set(t.auth,"password",e)},expression:"auth.password"}})]}}],null,!0)}),t._v(" "),s("v-btn",{attrs:{type:"submit",disabled:t.loading,loading:t.loading,color:"primary","x-large":"",block:""},scopedSlots:t._u([{key:"loader",fn:function(){return[s("v-slide-x-transition",[s("v-icon",{staticClass:"mdi-spin mr-3",attrs:{dark:""}},[t._v("mdi-loading")])],1),t._v(" "),s("span",[t._v(t._s(t.$t("Signing in...")))])]},proxy:!0}],null,!0)},[t._v("\n      "+t._s(t.$t("Sign in"))+"\n      ")])],1)]}}])})}),[],!1,null,null,null),p=f.exports;i()(f,{VBtn:l.a,VForm:d.a,VIcon:u.a,VSlideXTransition:c.f,VTextField:m.a});var h={components:{LoginForm:p}},v=s(480),w=s(481),b=s(482),g=Object(r.a)(h,(function(){var t=this.$createElement,e=this._self._c||t;return e("v-container",{attrs:{"fill-height":""}},[e("v-col",{attrs:{cols:"12"}},[e("v-row",{attrs:{justify:"center",align:"center"}},[e("v-col",{staticClass:"d-none d-md-flex order-md-2",attrs:{cols:"12",md:"6","offset-md":"1"}},[e("login-icon",{staticClass:"primary--text",attrs:{width:"100%",height:"100%"}})],1),this._v(" "),e("v-col",{staticClass:"order-md-1",attrs:{cols:"12",md:"5"}},[e("div",{staticClass:"text-center"},[e("brand")],1),this._v(" "),e("v-fade-transition",{attrs:{mode:"out-in"}},[e("login-form")],1)],1)],1)],1)],1)}),[],!1,null,null,null);e.default=g.exports;i()(g,{VCol:v.a,VContainer:w.a,VFadeTransition:c.c,VRow:b.a})}}]);
//# sourceMappingURL=19.js.map