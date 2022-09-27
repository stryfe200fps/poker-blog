import{u as w,o as n,e as d,b as t,g as s,w as m,F as b,H as h,t as k,f as c,a,c as x,L as y,n as V,m as v,i as _}from"./app.93b553b5.js";import{A as $}from"./AuthenticationCard.09875489.js";import{_ as B}from"./AuthenticationCardLogo.6e601bb9.js";import{_ as F}from"./Checkbox.2a865a22.js";import{_ as u,a as f}from"./TextInput.a884569e.js";import{_ as p}from"./InputLabel.8fbb133d.js";import{_ as L}from"./PrimaryButton.714864a1.js";import"./_plugin-vue_export-helper.cdc0426e.js";const C={key:0,class:"mb-4 font-medium text-sm text-green-600"},N=["onSubmit"],S={class:"mt-4"},q={class:"block mt-4"},P={class:"flex items-center"},R=a("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),U={class:"flex items-center justify-end mt-4"},A=_(" Forgot your password? "),E=_(" Log in "),J={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(l){const e=w({email:"",password:"",remember:!1}),g=()=>{e.transform(i=>({...i,remember:e.remember?"on":""})).post(route("login"),{onFinish:()=>e.reset("password")})};return(i,o)=>(n(),d(b,null,[t(s(h),{title:"Log in"}),t($,null,{logo:m(()=>[t(B)]),default:m(()=>[l.status?(n(),d("div",C,k(l.status),1)):c("",!0),a("form",{onSubmit:v(g,["prevent"])},[a("div",null,[t(p,{for:"email",value:"Email"}),t(u,{id:"email",modelValue:s(e).email,"onUpdate:modelValue":o[0]||(o[0]=r=>s(e).email=r),type:"email",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"]),t(f,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),a("div",S,[t(p,{for:"password",value:"Password"}),t(u,{id:"password",modelValue:s(e).password,"onUpdate:modelValue":o[1]||(o[1]=r=>s(e).password=r),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password"},null,8,["modelValue"]),t(f,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),a("div",q,[a("label",P,[t(F,{checked:s(e).remember,"onUpdate:checked":o[2]||(o[2]=r=>s(e).remember=r),name:"remember"},null,8,["checked"]),R])]),a("div",U,[l.canResetPassword?(n(),x(s(y),{key:0,href:i.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900"},{default:m(()=>[A]),_:1},8,["href"])):c("",!0),t(L,{class:V(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:m(()=>[E]),_:1},8,["class","disabled"])])],40,N)]),_:1})],64))}};export{J as default};
