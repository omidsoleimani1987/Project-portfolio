(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-37aac446"],{"212c":function(e,t,n){"use strict";n.r(t);var r=n("7a23"),i=Object(r["M"])("data-v-3e683422");Object(r["w"])("data-v-3e683422");var o={class:"form-control"},a=Object(r["i"])("label",{for:"email"},"Email",-1),c={class:"form-control"},s=Object(r["i"])("label",{for:"password"},"Password",-1),u={key:0};Object(r["u"])();var l=i((function(e,t,n,l,d,b){var p=Object(r["B"])("base-dialog"),f=Object(r["B"])("base-spinner"),m=Object(r["B"])("base-button"),j=Object(r["B"])("base-card");return Object(r["t"])(),Object(r["f"])("div",null,[Object(r["i"])(p,{show:!!d.error,title:"An error occurred!",onClose:b.handleError},{default:i((function(){return[Object(r["i"])("p",null,Object(r["E"])(d.error),1)]})),_:1},8,["show","onClose"]),Object(r["i"])(p,{fixed:"",show:d.isLoading,title:"Authenticating..."},{default:i((function(){return[Object(r["i"])(f)]})),_:1},8,["show"]),Object(r["i"])(j,null,{default:i((function(){return[Object(r["i"])("form",{onSubmit:t[3]||(t[3]=Object(r["L"])((function(){return b.submitForm.apply(b,arguments)}),["prevent"]))},[Object(r["i"])("div",o,[a,Object(r["K"])(Object(r["i"])("input",{type:"email",id:"email","onUpdate:modelValue":t[1]||(t[1]=function(e){return d.email=e})},null,512),[[r["H"],d.email,void 0,{trim:!0}]])]),Object(r["i"])("div",c,[s,Object(r["K"])(Object(r["i"])("input",{type:"password",id:"password","onUpdate:modelValue":t[2]||(t[2]=function(e){return d.password=e})},null,512),[[r["H"],d.password,void 0,{trim:!0}]])]),d.formIsValid?Object(r["g"])("",!0):(Object(r["t"])(),Object(r["f"])("p",u," please enter a valid an email and password (must be six characters long) ")),Object(r["i"])(m,null,{default:i((function(){return[Object(r["h"])(Object(r["E"])(b.submitButtonCaption),1)]})),_:1}),Object(r["i"])(m,{type:"button",mode:"flat",onClick:b.switchAuthMode},{default:i((function(){return[Object(r["h"])(Object(r["E"])(b.switchModeButtonCaption),1)]})),_:1},8,["onClick"])],32)]})),_:1})])})),d=(n("caad"),n("ac1f"),n("2532"),n("5319"),n("96cf"),n("1da1")),b={data:function(){return{email:"",password:"",formIsValid:!0,mode:"login",isLoading:!1,error:null}},computed:{submitButtonCaption:function(){return"login"===this.mode?"Login":"Signup"},switchModeButtonCaption:function(){return"login"===this.mode?"Signup instead":"Login instead"}},methods:{submitForm:function(){var e=this;return Object(d["a"])(regeneratorRuntime.mark((function t(){var n,r;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(""!==e.email&&e.email.includes("@")&&!(e.password.length<6)){t.next=3;break}return e.formIsValid=!1,t.abrupt("return");case 3:if(e.isLoading=!0,n={email:e.email,password:e.password},t.prev=5,"login"!==e.mode){t.next=11;break}return t.next=9,e.$store.dispatch("login",n);case 9:t.next=13;break;case 11:return t.next=13,e.$store.dispatch("signup",n);case 13:r="/"+(e.$route.query.redirect||"coaches"),e.$router.replace(r),t.next=20;break;case 17:t.prev=17,t.t0=t["catch"](5),e.error=t.t0.message||"failed to authenticate, try later!";case 20:e.isLoading=!1;case 21:case"end":return t.stop()}}),t,null,[[5,17]])})))()},switchAuthMode:function(){"login"===this.mode?this.mode="signup":this.mode="login"},handleError:function(){this.error=null}}};n("b3f3");b.render=l,b.__scopeId="data-v-3e683422";t["default"]=b},a0e8:function(e,t,n){},b3f3:function(e,t,n){"use strict";n("a0e8")}}]);
//# sourceMappingURL=chunk-37aac446.fcb6c7b9.js.map