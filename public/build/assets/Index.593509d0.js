import{d as u,p as x,l as _,o,c as g,w as k,e as i,f as m,a as e,t as d,v as D,P as w,F as L,h as R,b}from"./app.e99f41e8.js";import{_ as S}from"./FrontLayout.29f257eb.js";import{R as B}from"./ReportList.ac791b56.js";import{_ as E}from"./_plugin-vue_export-helper.cdc0426e.js";import"./moment.bf600a82.js";/* empty css                                                             */import{u as I}from"./event.15b5396d.js";import{u as V}from"./tournament.f56d2f7f.js";import"./water-waves.9f120b96.js";import"./ReportList.vue_vue_type_style_index_0_scoped_38e598db_lang.3b333e44.js";const C={key:0},M={key:0},N={key:1,class:"block-content"},j={class:"title-section hide-underline"},F={class:"text-primary"},O={style:{display:"flex","justify-content":"space-between","align-items":"center"}},P=["value","checked"],T={class:"single-post-box"},U={__name:"Index",props:{id:{type:String}},setup(f){const r=f,t=I(),h=V(),a=u([]),n=u(null),c=u([]),v=()=>{let{available_days:p}=t.eventData.data,l=Object.values(p);return Math.max(...l)};x(async()=>{await t.getEventData(r.id),await h.getList(),await t.getLiveReport(r.id,v()),n.value=v()});const y=async()=>{await t.getLiveReport(r.id,n.value)};return _(()=>t.eventData.data,function(){a.value=t.eventData.data}),_(()=>t.liveReportList,function(){c.value=t.liveReportList.data}),(p,l)=>(o(),g(S,{title:"Event"},{default:k(()=>[a.value?(o(),i("div",C,[c.value?(o(),i("div",M)):m("",!0),(o(),i("div",N,[e("div",j,[e("h1",F,[e("span",null,d(a.value.tournament),1)]),e("div",O,[e("h1",null,[e("span",null,d(a.value.title),1)]),e("p",null,[D(e("select",{"onUpdate:modelValue":l[0]||(l[0]=s=>n.value=s),onChange:y,style:{padding:"4px 8px",outline:"none"}},[(o(!0),i(L,null,R(a.value.available_days,s=>(o(),i("option",{key:s.id,value:s,checked:s==n.value}," Day "+d(s),9,P))),128))],544),[[w,n.value]])])])]),e("div",T,[b(B,{event:a.value,reports:c.value},null,8,["event","reports"])])]))])):m("",!0)]),_:1}))}},X=E(U,[["__scopeId","data-v-81e6f41f"]]);export{X as default};
