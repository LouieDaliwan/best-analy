(window.webpackJsonp=window.webpackJsonp||[]).push([[42],{105:function(t,e){t.exports="/theme/images/exce.jpg?d518457e0661a9cdd4e4b770d6e637da"},299:function(t,e,s){"use strict";s.r(e);s(66);var a=s(10),n={name:"Login",data:function(){return{auth:{username:"",password:""},loading:!1,showPassword:!1}},computed:{isMobile:function(){return this.$vuetify.breakpoint.smAndDown}},methods:{load:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.loading=t},submit:function(t){var e=this,s=this.auth,n=s.username,r=s.password;this.load(),this.$store.dispatch("auth/login",{username:n,password:r}).then((function(){e.$router.push({name:"dashboard"}),e.$store.dispatch("snackbar/show",{text:$t("Welcome back, ")+a.default.getUser().firstname})})).catch((function(t){t.response&&e.$refs["signin-form"].setErrors(t.response.data.errors)})).finally((function(){e.load(!1)})),t.preventDefault()}}},r=s(0),o=s(2),i=s.n(o),l=s(112),d=s(280),c=s(623),u=s(98),m=s(5),v=s(51),p=Object(r.a)(n,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("validation-observer",{ref:"signin-form",scopedSlots:t._u([{key:"default",fn:function(e){e.passes;return[s("v-form",{attrs:{disabled:t.loading},on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[s("validation-provider",{attrs:{name:"username",rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var a=e.errors;return[s("v-text-field",{staticClass:"mb-3",attrs:{"error-messages":a,label:t.$t("Username or email"),autofocus:"",outlined:"","clear-icon":"mdi mdi-close-circle-outline",clearable:""},model:{value:t.auth.username,callback:function(e){t.$set(t.auth,"username",e)},expression:"auth.username"}})]}}],null,!0)}),t._v(" "),s("validation-provider",{attrs:{name:"password",rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var a=e.errors;return[s("v-text-field",{staticClass:"mb-3",attrs:{"append-icon":t.showPassword?"mdi-eye":"mdi-eye-off","error-messages":a,label:t.$t("Password"),type:t.showPassword?"text":"password","clear-icon":"mdi mdi-close-circle-outline",clearable:"",outlined:"",password:""},on:{"click:append":function(e){t.showPassword=!t.showPassword}},model:{value:t.auth.password,callback:function(e){t.$set(t.auth,"password",e)},expression:"auth.password"}})]}}],null,!0)}),t._v(" "),s("sso-active-directory-login-button",{model:{value:t.auth,callback:function(e){t.auth=e},expression:"auth"}}),t._v(" "),s("v-divider",{staticClass:"my-4"}),t._v(" "),s("v-btn",{attrs:{type:"submit",disabled:t.loading,loading:t.loading,"x-large":"",block:""},scopedSlots:t._u([{key:"loader",fn:function(){return[s("v-slide-x-transition",[s("v-icon",{staticClass:"mdi-spin mr-3",attrs:{dark:""}},[t._v("mdi-loading")])],1),t._v(" "),s("span",[t._v(t._s(t.$t("Signing in...")))])]},proxy:!0}],null,!0)},[t._v("\n      "+t._s(t.$t("Sign in"))+"\n      ")])],1)]}}])})}),[],!1,null,null,null),f=p.exports;i()(p,{VBtn:l.a,VDivider:d.a,VForm:c.a,VIcon:u.a,VSlideXTransition:m.i,VTextField:v.a});var h={components:{LoginForm:f}},b=s(1),g=s(609),w=s(134),_=s(611),x=Object(r.a)(h,(function(){var t=this.$createElement,e=this._self._c||t;return e("section",[e("v-row",{attrs:{justify:"center",align:"center"}},[e("v-col",{staticClass:"d-none d-md-flex pa-0",attrs:{cols:"12",md:"6"}},[e("v-img",{attrs:{src:s(105),"lazy-src":s(105),gradient:"to top right, rgba(4, 75, 127, 0.3), rgba(16, 125, 125, 0.3)",height:"100vh"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12",md:"6","pa-5":this.$vuetify.breakpoint.smAndDown}},[e("v-row",{attrs:{align:"center",justify:"center"}},[e("v-col",{attrs:{cols:"12",md:"7"}},[e("v-card-text",[e("div",{staticClass:"text-center"},[e("brand")],1),this._v(" "),e("v-fade-transition",{attrs:{mode:"out-in"}},[e("login-form")],1)],1)],1)],1),this._v(" "),e("div",{staticClass:"d-none d-md-block"},[e("img",{staticStyle:{position:"absolute",right:"0",bottom:"0",width:"300px"},attrs:{src:s(145)}})])],1)],1)],1)}),[],!1,null,null,null);e.default=x.exports;i()(x,{VCardText:b.c,VCol:g.a,VFadeTransition:m.d,VImg:w.a,VRow:_.a})}}]);
//# sourceMappingURL=42.js.map