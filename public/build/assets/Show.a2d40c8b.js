import{d as v,o as a,c as x,w as d,b as h,a as t,t as r,g as i,H as w,L as S,i as c,n as p,e as l,X as f,f as n,F as m,h as g,E as F,G as C}from"./app.e180e75f.js";import{_ as L}from"./FrontLayout.e7a2053f.js";import{C as B,w as A,a as M,s as H,p as T,i as Y,h as D,f as E,b as I,c as N,d as V}from"./water-waves.ef79fb3a.js";import{h as j,C as z}from"./moment.719f1dc2.js";import{u as O}from"./event.b6d9585d.js";import{_ as R}from"./_plugin-vue_export-helper.cdc0426e.js";const s=e=>(F("data-v-ee603e55"),e=e(),C(),e),W=s(()=>t("meta",{name:"description",content:"Your page description"},null,-1)),G=["content"],P=["content"],U={class:"block-content"},X={class:"title-section"},$=s(()=>t("h1",{class:"text-primary"},[t("span",null,[t("i",{class:"fa fa-chevron-left","aria-hidden":"true"}),c(" Back")])],-1)),q={class:"single-post-box"},J={class:"day-divider",style:{"border-bottom":"1px solid #d3d3d3","margin-top":"20px"}},K=s(()=>t("br",null,null,-1)),Q=s(()=>t("br",null,null,-1)),Z={class:"title-post"},tt={style:{display:"flex","justify-content":"space-between","align-items":"center"}},et={style:{"flex-grow":"1"}},st={class:"post-tags"},at=s(()=>t("i",{class:"fa fa-clock-o"},null,-1)),ot=s(()=>t("i",{class:"fa fa-user"},null,-1)),lt=c("by "),rt={href:"#"},nt=s(()=>t("i",{class:"fa fa-bookmark"},null,-1)),ct={class:"post-tags share-post-links"},it={class:"share-post-mobile",style:{position:"relative"}},dt={class:"btn",style:{"margin-right":"0","background-color":"#1854dd"}},ht=["href"],_t=s(()=>t("i",{class:"fa-brands fa-facebook-f",style:{"margin-right":"0",color:"#fff"}},null,-1)),ut=[_t],pt={class:"btn",style:{"margin-right":"0","background-color":"#18a3dd"}},ft=["href"],mt=s(()=>t("i",{class:"fa fa-twitter",style:{"margin-right":"0",color:"#fff"}},null,-1)),gt=[mt],yt={class:"btn",style:{"background-color":"#25d366"}},bt=["href"],kt=s(()=>t("i",{class:"fa fa-whatsapp",style:{"margin-right":"0",color:"#fff"}},null,-1)),vt=[kt],xt=s(()=>t("i",{class:"fa fa-share-alt"},null,-1)),wt=s(()=>t("span",{class:"text-uppercase"},"Share",-1)),St=[xt,wt],Ft={class:"share-post-desktop"},Ct=s(()=>t("li",{class:"text-secondary"},[t("i",{class:"fa fa-share-alt text-secondary"}),t("span",{class:"text-secondary"},"Share Post")],-1)),Lt=["href"],Bt=s(()=>t("i",{class:"fa fa-facebook text-secondary"},null,-1)),At=[Bt],Mt=["href"],Ht=s(()=>t("i",{class:"fa fa-twitter text-secondary"},null,-1)),Tt=[Ht],Yt=["href"],Dt=s(()=>t("i",{class:"fa fa-whatsapp text-secondary"},null,-1)),Et=[Dt],It={key:0,class:"post-gallery float-img",style:{float:"left",margin:"0px 15px 5px 0px"}},Nt={style:{position:"relative"}},Vt=["src"],jt={key:0,class:"image-caption"},zt=["innerHTML"],Ot={key:0,style:{"margin-bottom":"20px"}},Rt=["src"],Wt=["src"],Gt=s(()=>t("span",{style:{"white-space":"nowrap"}},null,-1)),Pt={key:0,class:"text-center hide-on-tablet"},Ut={key:1,class:"text-center hide-on-tablet"},Xt={class:"text-right"},$t={class:"text-right hide-on-mobile"},qt={key:0,style:{"margin-left":"10px"}},Jt={key:0,class:"fa-sharp fa-solid fa-caret-up text-green"},Kt={key:1,style:{"margin-left":"10px"}},Qt={key:0,class:"fa-sharp fa-solid fa-caret-down text-red"},Zt={key:1},te={class:"post-tags-box"},ee={class:"tags-box"},se=s(()=>t("i",{class:"fa fa-tags"},null,-1)),ae=s(()=>t("span",null,"Tags:",-1)),oe={__name:"Show",props:{slug:{type:String,default:""},report:{type:Object}},setup(e){O();const _=v(!1),y=()=>{_.value=!_.value};function b(u){switch(u){case"brokenMirror":return N;case"bulletHole":return I;case"flames":return E;case"happyBirthday":return D;case"iceCubes":return Y;case"pocketAces":return T;case"sunRays":return H;case"waterLeaves":return M;case"waterWaves":return A}}return(u,le)=>(a(),x(L,{title:""},{default:d(()=>[h(i(w),null,{default:d(()=>[t("title",null,r(e.report.data.title),1),W,t("meta",{property:"og:title=",content:e.report.data.title},null,8,G),t("meta",{property:"og:description",content:e.report.data.content},null,8,P)]),_:1}),t("div",U,[t("div",X,[h(i(S),{onclick:"history.back();return false;"},{default:d(()=>[$]),_:1})]),t("div",q,[t("div",J,[t("span",null,"Day: "+r(e.report.data.day),1),K,t("span",null,r(e.report.data.level.level),1),Q]),t("div",Z,[t("h1",null,r(e.report.data.title),1),t("div",tt,[t("div",et,[t("ul",st,[t("li",null,[at,c(r(i(j)(e.report.data.date_added).format("MMM D YYYY")),1)]),t("li",null,[ot,lt,t("a",rt,r(e.report.data.article_author.first_name)+" "+r(e.report.data.article_author.last_name),1)]),t("li",null,[nt,c(" "+r(e.report.data.level.level),1)])])]),t("div",null,[t("ul",ct,[t("div",it,[t("div",{class:p(["btn-group-vertical social-links-group",{show:_.value}])},[t("li",dt,[t("a",{target:"_blank",href:"https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flifeofpoker.com%2Freport%2F"+e.report.data.slug+"&src=sdkpreparse"},ut,8,ht)]),t("li",pt,[t("a",{target:"_blank",href:"https://twitter.com/intent/tweet?text=https%3A//lifeofpoker.com/report/"+e.report.data.slug},gt,8,ft)]),t("li",yt,[t("a",{target:"_blank",href:"https://api.whatsapp.com/send?text=%0ahttps://lifeofpoker.com/report/"+e.report.data.slug},vt,8,bt)])],2),t("li",{onClick:y,class:"btn btn-default share-btn-mobile"},St)]),t("div",Ft,[Ct,t("li",null,[t("a",{target:"_blank",href:"https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flifeofpoker.com%2Freport%2F"+e.report.data.slug+"&src=sdkpreparse",class:"facebook"},At,8,Lt)]),t("li",null,[t("a",{target:"_blank",href:"https://twitter.com/intent/tweet?text=https%3A//lifeofpoker.com/report/"+e.report.data.slug,class:"twitter"},Tt,8,Mt)]),t("li",null,[t("a",{target:"_blank",href:"https://api.whatsapp.com/send?text=%0ahttps://lifeofpoker.com/report/"+e.report.data.slug,class:"whatsapp"},Et,8,Yt)])])])])])]),t("div",{class:p([e.report.data.main_image?"post-content-min-height":"","post-content"])},[e.report.data.main_image?(a(),l("div",It,[t("div",Nt,[t("img",{src:e.report.data.main_image,alt:"",style:f([{"margin-bottom":"unset"},[e.report.data.theme?{filter:"brightness(0.8)"}:{}]])},null,12,Vt),t("div",{class:"imageFrame",style:f({"background-image":"url("+b(e.report.data.theme)+")"})},null,4)]),e.report.data.caption?(a(),l("span",jt,r(e.report.data.caption),1)):n("",!0)])):n("",!0),t("div",{class:"remove-padding",innerHTML:e.report.data.content},null,8,zt)],2),e.report.data.event_chips?(a(),l("div",Ot,[h(B,null,{"table-body":d(()=>[(a(!0),l(m,null,g(e.report.data.event_chips,(o,k)=>(a(),l("tr",{key:k},[t("td",null,[o.player.avatar?(a(),l("img",{key:0,class:"hide-on-mobile",src:o.player.avatar},null,8,Rt)):(a(),l("img",{key:1,class:"hide-on-mobile",src:i(V)},null,8,Wt)),c(" "+r(o.player.name)+" ",1),Gt]),o.player.country?(a(),l("td",Pt,[h(i(z),{title:o.player.country.name,iso:o.player.country.iso_3166_2},null,8,["title","iso"])])):(a(),l("td",Ut," ? ")),t("td",Xt,r(o.current_chips===0?"BUSTED":o.current_chips.toLocaleString()),1),t("td",$t,[c(r(o.current_chips===0?"":o.changes.toLocaleString())+" ",1),o.symbol==="up"?(a(),l("span",qt,[o.current_chips!=0?(a(),l("i",Jt)):n("",!0)])):(a(),l("span",Kt,[o.current_chips!=0?(a(),l("i",Qt)):n("",!0)]))])]))),128))]),_:1})])):n("",!0),e.report.data.event_chips.length?(a(),l("div",Zt,[t("div",te,[t("ul",ee,[t("li",null,[se,ae,(a(!0),l(m,null,g(e.report.data.event_chips,o=>(a(),l("a",{href:"#",key:o.id},r(o.player.name),1))),128))])])])])):n("",!0)])])]),_:1}))}},_e=R(oe,[["__scopeId","data-v-ee603e55"]]);export{_e as default};
