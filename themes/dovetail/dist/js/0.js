(window.webpackJsonp=window.webpackJsonp||[]).push([[0],{37:function(t,e,s){"use strict";var a=s(11),o={props:["customer","user","type","month"],data:function(){return{isSending:!1,sendAll:!1,checklist:[{message:"",name:trans("Sending Financial File By No"),icon:"mdi-file-send",status:"pending"},{message:"",name:trans("Sending Update Visit Score"),icon:"mdi-file-send",status:"pending"},{message:"",name:trans("Sending Overall Document"),icon:"mdi-file-send",status:"pending"}],error_trigger:!1,dialog:!1,dialogInfo:!1,sendBothScoresAndFile:!1,resource:{data:{}}}},computed:{isOverall:function(){return"overall"==this.type},isOverallDashboard:function(){return"overall-report-dashboard"==this.type}},methods:{sendAllScoresAndDocuments:function(){this.dialog=!0,this.sendAll=!0,this.checklist=this.checklist.map((function(t){return Object.assign(t,{status:"pending",message:""})})),this.sendToCrm()},getReportData:function(){var t=this;return new Promise((function(e,s){var a=t.customer,o=t.user,n=t.month;axios.get("/api/v1/reports/overall/customer/".concat(a,"/user/").concat(o,"?month=").concat(n)).then((function(t){e(t)})).catch((function(t){s(t)}))}))},getElements:function(){console.log(this.resource.data);var t=this.resource.data.report.value||{},e={};if(this.isOverall||this.isOverallDashboard)for(var s=_.map(t.indices,(function(t,e){return t.elements})),a=s.length-1;a>=0;a--){var o=s[a];e=Object.assign(e,o,{OverallScore:100*t["overall:score"],SustainabilityOverallScore:t.indices.BSPI["overall:total"]/100,FinancialOverallScore:t.indices.FMPI["overall:total"]/100,ProductivityOverallScore:t.indices.PMPI["overall:total"]/100,HROverallScore:t.indices.HRPI["overall:total"]/100})}else e=t["current:index"].elements;e=_.mapKeys(e,(function(t,e){return e.replace(/[^a-zA-Z]/g,"")})),e=_.mapKeys(e,(function(t,e){return e.replace(/\s+/g,"")})),(e=_.mapValues(e,(function(t,e){return 100*t}))).EmployeeEngagement=e.EmployeeEngagementCommunication||0,e.CareerManagement=e.CareerTalentManagement||0;var n=t["overall:enablers"].chart.data,i=t["overall:enablers"].chart.label;for(a=n.length-1;a>=0;a--){var r=n[a];e[i[a]]=r||0}return e.WorkflowProcesses=e["Workflow Processess"]||"",e},getOverallScore:function(){var t=this.resource.data.report.value["current:index"]["overall:total"],e="OverallScore";switch(this.resource.data.report.value["current:index"]["pindex:code"]){case"FMPI":e="Financial"+e;break;case"PMPI":e="Productivity"+e;break;case"HRPI":e="HR"+e;break;case"BSPI":e="Sustainability"+e}var s={};return s[e]=t,s},sendToCrm:function(){var t=this;this.isSending=!0,this.checklist[0].status="sending",this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(e){if(t.resource.data=e.data,!t.resource.data.customer)return t.$store.dispatch("snackbar/show",{text:"No report data found."}),!1;var s=t.resource.data.latestFinancial,o={FileNo:t.resource.data.customer.filenumber,YearOfFinancial:s.period,SubmissionDate:Date.now(),Revenue:0,Rent:0,LicensingFees:0,VisaEmploymentFees:0,CostofGoodsSold:s.metadataResults.overAllResults.profitStatements.cost_goods,OtherExpenses:s.metadataStatements["Other Expense (less Other Income)"],OperatingLossProfit:s.metadataResults.overAllResults.profitStatements.operating_loss_or_profit,Depreciation:s.metadataStatements.Depreciation,NonOperatingExpenses:s.metadataResults.overAllResults.profitStatements.non_operating_expenses,Taxes:s.metadataResults.overAllResults.profitStatements.taxes,NetLossProfits:s.metadataResults.overAllResults.profitStatements.net_loss_profit_after_taxes,Fixedassets:s.metadataResults.overAllResults.balanceSheets.fixedassets,TotalLiabilities:s.metadataResults.overAllResults.balanceSheets.total_liabilities,StockholdersEquity:s.metadataSheets["Stockholder's Equity"],Marketing:s.metadataStatements["Marketing Costs"],Salaries:s.metadataStatements["Staff Salaries & Benefits"]};t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),console.log("Sending overall scores...",o),axios.post(a.a.crm.sendAddFinancialsByFileNo(),o).then((function(e){t.$store.dispatch("snackbar/hide"),t.checklist[0].status="done",1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):(t.checklist[0].status="error",t.checklist[0].message=e.data.Message,t.error_trigger=!0)})).catch((function(e){t.checklist[0].status="error",t.checklist[0].message=e.message,t.error_trigger=!0,t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){t.isSending=!1,t.sendUpdateVisitToCrm()}))})).catch((function(t){console.log("err",t)}))},sendUpdateVisitToCrm:function(){var t=this;this.isSending=!0,this.checklist[1].status="sending",this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending Update Visit Score to CRM. Please wait..."});var e=this.resource.data.scores,s=this.resource.data.latestFinancial,o={Id:_.toUpper(this.resource.data.customer.token),BSPI:e.smeRatings[0].score,FMPI:e.smeRatings[1].score,PMPI:e.smeRatings[2].score,HRPI:e.smeRatings[3].score,FifthModule:e.smeRatings[4].score,FinancialPerformance:s.metadataResults.ratioAnalysis.dashboard.financial_score,WorkingCapital:s.metadataResults.ratioAnalysis.liquidity.working_capital,NetProfitMargin:s.metadataResults.ratioAnalysis.profitability.net_profit_margin,GrossProfitMargin:s.metadataResults.ratioAnalysis.profitability.gross_profit_margin,COGSMargin:s.metadataResults.overAllResults.profitStatements.cost_goods,CurrentRatio:s.metadataResults.ratioAnalysis.dashboard.current_ratio.score,LongTermDebtRatio:s.metadataResults.ratioAnalysis.dashboard.debt_ratio.score,ReturnonInvestment:s.metadataResults.ratioAnalysis.dashboard.roi.score,SMERating:e.overall_score,BreakevenPoint:0};axios.post(a.a.crm.sendUpdateVisit(),o).then((function(e){t.$store.dispatch("snackbar/hide"),t.checklist[1].status="done",1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):(t.checklist[1].status="error",t.checklist[1].message=e.data.Message,t.error_trigger=!0)})).catch((function(e){t.checklist[1].status="error",t.checklist[1].message=e.message,t.error_trigger=!0,t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){t.isSending=!1,t.sendDocumentToCrm()}))},sendDocumentToCrm:function(){var t=this;this.isSending=!0,this.checklist[2].status="sending",this.getReportData().then((function(e){t.resource.data=e.data;var s={Id:_.toUpper(t.resource.data.customer.token),FileName:"Overall Scores",FileContentBase64:t.resource.data["overall:report"]||"empty"};console.log("Sending overall document...",s),t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Overall Report Document to CRM. Establishing connection to CRM..."}),axios.post(a.a.crm.sendDocument(),s).then((function(e){t.$store.dispatch("snackbar/hide"),t.checklist[1].status="done",1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):(t.checklist[2].status="error",t.checklist[2].message=e.data.Message,t.error_trigger=!0)})).catch((function(e){t.checklist[2].status="error",t.checklist[2].message=e.message,t.error_trigger=!0,t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){t.isSending=!1}))}))},sendBothDataToCrm:function(){this.sendBothScoresAndFile=!0,this.sendToCrm()},sendFinancialScores:function(){var t=this;this.checklist[2].status="sending",this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(e){if(t.resource.data=e.data,console.log(t.resource.data),!t.resource.data.customer)return t.$store.dispatch("snackbar/show",{text:"No report data found."}),!1;var s={FileNo:t.resource.data.customer.filenumber,YearofFinancial:t.resource.data.customer.metadata?t.resource.data.customer.metadata.years.Years.Year3:"No year was set",SubmissionDate:t.resource.data.profit_and_loss["Submission Date"],Revenue:JSON.stringify(t.resource.data.profit_and_loss.Revenue),CostofGoodsSold:JSON.stringify(t.resource.data.profit_and_loss.CostOfGoodsSold),OtherExpenses:JSON.stringify(t.resource.data.profit_and_loss.OtherExpenses),NonOperatingExpenses:JSON.stringify(t.resource.data.profit_and_loss.OtherExpenses["Non-Operating expenses (NOE)"]||{}),OperatingLossProfit:JSON.stringify(t.resource.data.profit_and_loss.OtherExpenses["Operating (loss)/profit"]||{}),Depreciation:JSON.stringify(t.resource.data.profit_and_loss.OtherExpenses.Depreciation||{}),Taxes:JSON.stringify(t.resource.data.profit_and_loss.OtherExpenses.Taxes||{}),NetLossProfits:t.resource.data.profit_and_loss.NetProfit.Year3,FixedAssets:JSON.stringify(t.resource.data.profit_and_loss.FixedAssets["Fixed Assets"]),TotalLiabilities:JSON.stringify(t.resource.data.profit_and_loss.FixedAssets["Total Liabilities"]),StockholdersEquity:JSON.stringify(t.resource.data.profit_and_loss.FixedAssets["Stockholder's Equity"]),Marketing:JSON.stringify(t.resource.data.profit_and_loss.Marketing),Rent:JSON.stringify(t.resource.data.profit_and_loss.Rent),Salaries:JSON.stringify(t.resource.data.profit_and_loss.Salaries),LicensingFees:JSON.stringify(t.resource.data.profit_and_loss["Licensing Fees"]),VisaEmploymentFees:JSON.stringify(t.resource.data.profit_and_loss["Visa / Employment Fees"])};console.log("Sending financial scores...",s),t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),axios.post(a.a.crm.sendFinancial(),s).then((function(e){t.$store.dispatch("snackbar/hide"),t.checklist[2].status="done",1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):(t.checklist[2].status="error",t.checklist[2].message=e.data.Message)})).catch((function(e){t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")}),t.checklist[2].status="error"})).finally((function(){}))})).catch((function(t){console.log("err",t)}))},sendFinancialDocument:function(){var t=this;this.checklist[3].status="sending",this.getReportData().then((function(e){t.resource.data=e.data,console.log(t);var s={Id:_.toUpper(t.resource.data.customer.token),FileName:"Financial Ratios",FileContentBase64:t.resource.data["report:financial"]||"empty"};console.log("Sending financial document...",s),t.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Financial Report Document to CRM. Establishing connection..."}),axios.post(a.a.crm.sendDocument(),s).then((function(e){console.log("data",e.data),t.$store.dispatch("snackbar/hide"),t.checklist[3].status="done",1==e.data.Code?t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):(t.checklist[3].status="error",t.checklist[3].message=e.data.Message)})).catch((function(e){t.checklist[3].status="error",t.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){}))}))},dialogInfoClick:function(){this.dialogInfo=!0},dialogClose:function(){this.dialog=!1,this.error_trigger=!1}}},n=s(0),i=s(2),r=s.n(i),c=s(114),l=s(279),d=s(1),h=s(617),u=s(620),m=s(100),p=s(283),v=s(117),g=s(284),f=s(8),b=s(115),k=s(618),y=s(619),S=Object(n.a)(o,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return t.isOverall?s("div",[s("v-btn",{attrs:{loading:t.isSending,disabled:t.isSending,large:"",block:t.$vuetify.breakpoint.smAndDown,color:"primary"},on:{click:t.sendAllScoresAndDocuments}},[s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-send")]),t._v("\n    "+t._s(t.trans("Send to CRM"))+"\n  ")],1),t._v(" "),s("v-dialog",{attrs:{"max-width":"420",persistent:""},model:{value:t.dialog,callback:function(e){t.dialog=e},expression:"dialog"}},[s("v-card",[s("v-list",t._l(t.checklist,(function(e,a){return s("v-list-item",{key:a,attrs:{title:e.message}},[s("v-list-item-content",[s("v-list-item-title",{domProps:{textContent:t._s(e.name)}})],1),t._v(" "),s("v-list-item-action",["pending"==e.status?s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-checkbox-blank-circle-outline")]):"sending"==e.status?s("v-progress-circular",{attrs:{indeterminate:"",width:"2",size:"12"}}):"done"==e.status?s("v-icon",{attrs:{small:"",left:"",color:"success"}},[t._v("mdi-check")]):"error"==e.status?s("div",[s("v-icon",{attrs:{small:"",left:"",color:"error"}},[t._v("mdi-alert-circle")])],1):t._e()],1)],1)})),1),t._v(" "),s("v-card-actions",[s("v-spacer"),t._v(" "),s("v-btn",{attrs:{depressed:""},on:{click:t.dialogClose}},[t._v("Close")])],1),t._v(" "),s("v-spacer"),t._v(" "),t.error_trigger?s("v-container",{staticClass:"container py-6 px-auto"},[s("v-row",{attrs:{align:"center",justify:"center"}},[s("v-btn",{attrs:{large:"",color:"primary",dark:"",text:"",block:""},on:{click:t.dialogInfoClick}},[t._v("\n            What Happened?\n            "),s("v-icon",{attrs:{dark:"",right:""}},[t._v("\n              mdi-cancel\n            ")])],1)],1)],1):t._e()],1)],1),t._v(" "),s("v-dialog",{attrs:{width:"800",persistent:""},model:{value:t.dialogInfo,callback:function(e){t.dialogInfo=e},expression:"dialogInfo"}},[s("v-card",{staticClass:"pa-6"},[s("v-card-text",[s("h3",[t._v("What happened?")]),t._v(" "),s("p",[t._v("There is an error when sending data from BEST application (SME) to CRM.")]),t._v(" "),s("h3",[t._v("Why it happened?")]),t._v(" "),s("p",{staticClass:"mb-0"},[t._v("These are the possible reasons:")]),t._v(" "),s("ul",{staticClass:"mb-4"},[s("li",[t._v("The company may have no longer existed on the CRM. It could have been deleted, modified, or updated.")]),t._v(" "),s("li",[t._v("If the company is listed in CRM, the company ID recorded in BEST and CRM may have been different.")]),t._v(" "),s("li",[t._v("The company's status on the CRM is not on "),s("strong",[t._v("Approved Site Visit")]),t._v(" which makes it, perhaps, closed to receive data from BEST.")])]),t._v(" "),s("h3",{staticClass:"mb-2"},[t._v("What can be done?")]),t._v(" "),s("ul",{staticClass:"mb-4"},[s("li",[t._v("Check if the company you are trying to send the data to is "),s("strong",[t._v("listed")]),t._v(" on the CRM. You may want to contact the person responsible for the CRM about it. Once confirmed, try to send the data again. ")]),t._v(" "),s("li",[t._v("If the company is listed on the CRM but still failed to send the data, perhaps the company’s "),s("strong",[t._v("status")]),t._v(" on the CRM is not Approved Site Visit, which prevents the CRM from receiving the data. To change its status, you may want to contact the person who handles the CRM records.")]),t._v(" "),s("li",[t._v("If the company is listed on the CRM and has an Approved Site Visit status but still failed to send the data, perhaps the ID in BEST and CRM do not match. To update the company ID in BEST, go to "),s("strong",[t._v("Find Company")]),t._v(", search the company by entering the "),s("strong",[t._v("file number")]),t._v(", then click "),s("strong",[t._v("Start")]),t._v(". Once updated, try to send the data again.")]),t._v(" "),s("li",[t._v("You may want to contact "),s("strong",[t._v("analytics@ssagroup.com")]),t._v(" if the steps mentioned above fail to work.")])])]),t._v(" "),s("v-card-actions",[s("v-spacer"),t._v(" "),s("v-btn",{attrs:{depressed:""},on:{click:function(e){t.dialogInfo=!1}}},[t._v("Close")])],1)],1)],1)],1):t.isOverallDashboard?s("v-btn",{attrs:{icon:""},on:{click:t.sendAllScoresAndDocuments}},[s("v-icon",{attrs:{small:""}},[t._v("mdi-send")]),t._v(" "),s("v-dialog",{attrs:{"max-width":"420",persistent:""},model:{value:t.dialog,callback:function(e){t.dialog=e},expression:"dialog"}},[s("v-card",[s("v-list",{staticClass:"d-flex flex-md-wrap"},t._l(t.checklist,(function(e,a){return s("v-list-item",{key:a,attrs:{title:e.message,"two-line":""}},[s("v-list-item-content",[s("v-list-item-title",{domProps:{textContent:t._s(e.name)}}),t._v(" "),"error"==e.status?s("div",[s("v-list-item-subtitle",{staticClass:"align-self-start"},[s("span",{staticClass:"red--text",domProps:{textContent:t._s(e.message)}})])],1):t._e()],1),t._v(" "),s("v-list-item-action",["pending"==e.status?s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-checkbox-blank-circle-outline")]):"sending"==e.status?s("v-progress-circular",{attrs:{indeterminate:"",width:"2",size:"12"}}):"done"==e.status?s("v-icon",{attrs:{small:"",left:"",color:"success"}},[t._v("mdi-check")]):"error"==e.status?s("div",[s("v-icon",{attrs:{small:"",left:"",color:"error"}},[t._v("mdi-alert-circle")])],1):t._e()],1)],1)})),1),t._v(" "),s("v-card-actions",[s("v-spacer"),t._v(" "),s("v-btn",{attrs:{depressed:""},on:{click:t.dialogClose}},[t._v("Close")])],1),t._v(" "),s("v-spacer"),t._v(" "),t.error_trigger?s("v-container",{staticClass:"container py-6 px-auto"},[s("v-row",{attrs:{align:"center",justify:"center"}},[s("v-btn",{attrs:{large:"",color:"primary",dark:"",text:"",block:""},on:{click:t.dialogInfoClick}},[s("v-icon",{staticClass:"ma-2",attrs:{small:""}},[t._v("\n              mdi-help-circle-outline\n            ")]),t._v("\n            What Happened?\n          ")],1)],1)],1):t._e(),t._v(" "),s("v-spacer")],1)],1),t._v(" "),s("v-dialog",{attrs:{width:"800",persistent:""},model:{value:t.dialogInfo,callback:function(e){t.dialogInfo=e},expression:"dialogInfo"}},[s("v-card",{staticClass:"pa-6"},[s("v-card-text",[s("h3",[t._v("What happened?")]),t._v(" "),s("p",[t._v("There is an error when sending data from BEST application (SME) to CRM.")]),t._v(" "),s("h3",[t._v("Why it happened?")]),t._v(" "),s("p",{staticClass:"mb-0"},[t._v("These are the possible reasons:")]),t._v(" "),s("ul",{staticClass:"mb-4"},[s("li",[t._v("The company may have no longer existed on the CRM. It could have been deleted, modified, or updated.")]),t._v(" "),s("li",[t._v("If the company is listed in CRM, the company ID recorded in BEST and CRM may have been different.")]),t._v(" "),s("li",[t._v("The company's status on the CRM is not on "),s("strong",[t._v("Approved Site Visit")]),t._v(" which makes it, perhaps, closed to receive data from BEST.")])]),t._v(" "),s("h3",{staticClass:"mb-2"},[t._v("What can be done?")]),t._v(" "),s("ul",{staticClass:"mb-4"},[s("li",[t._v("Check if the company you are trying to send the data to is "),s("strong",[t._v("listed")]),t._v(" on the CRM. You may want to contact the person responsible for the CRM about it. Once confirmed, try to send the data again. ")]),t._v(" "),s("li",[t._v("If the company is listed on the CRM but still failed to send the data, perhaps the company’s "),s("strong",[t._v("status")]),t._v(" on the CRM is not Approved Site Visit, which prevents the CRM from receiving the data. To change its status, you may want to contact the person who handles the CRM records.")]),t._v(" "),s("li",[t._v("If the company is listed on the CRM and has an Approved Site Visit status but still failed to send the data, perhaps the ID in BEST and CRM do not match. To update the company ID in BEST, go to "),s("strong",[t._v("Find Company")]),t._v(", search the company by entering the "),s("strong",[t._v("file number")]),t._v(", then click "),s("strong",[t._v("Start")]),t._v(". Once updated, try to send the data again.")]),t._v(" "),s("li",[t._v("You may want to contact "),s("strong",[t._v("analytics@ssagroup.com")]),t._v(" if the steps mentioned above fail to work.")])])]),t._v(" "),s("v-card-actions",[s("v-spacer"),t._v(" "),s("v-btn",{attrs:{depressed:""},on:{click:function(e){t.dialogInfo=!1}}},[t._v("Close")])],1)],1)],1)],1):s("v-btn",{attrs:{icon:""},on:{click:t.sendToCrm}},[s("v-icon",{attrs:{small:""}},[t._v("mdi-send")])],1)}),[],!1,null,null,null);e.a=S.exports;r()(S,{VBtn:c.a,VCard:l.a,VCardActions:d.a,VCardText:d.c,VContainer:h.a,VDialog:u.a,VIcon:m.a,VList:p.a,VListItem:v.a,VListItemAction:g.a,VListItemContent:f.b,VListItemSubtitle:f.c,VListItemTitle:f.d,VProgressCircular:b.a,VRow:k.a,VSpacer:y.a})}}]);
//# sourceMappingURL=0.js.map