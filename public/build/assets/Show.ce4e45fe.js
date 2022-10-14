import{d as v,o as a,c as w,w as d,b as h,a as t,t as n,g as i,H as x,L as S,i as c,n as _,e as l,X as f,f as r,F as g,h as m,D as F,E as C}from"./app.7bb3fc94.js";import{_ as L}from"./FrontLayout.4ca508b4.js";import{C as B,d as A}from"./default-avatar.a301eb7a.js";import{h as M,C as H}from"./moment.61e475d7.js";import{u as T}from"./event.8bd7a62d.js";import{_ as D}from"./_plugin-vue_export-helper.cdc0426e.js";const Y="/build/assets/brokenmirror.62daf81c.png",E="/build/assets/bullethole.950cbfeb.png",I="/build/assets/flames.ffff3283.png",N="/build/assets/happybirthday.37ab3cad.png",V="/build/assets/icecubes.4847c814.png",j="/build/assets/pocketaces.d3dd592f.png",z="/build/assets/sunrays.53587eea.png",O="/build/assets/water-leaves.45e550fb.png",R="/build/assets/water-waves.54f8acb0.png";const s=e=>(F("data-v-ee603e55"),e=e(),C(),e),W=s(()=>t("meta",{name:"description",content:"Your page description"},null,-1)),P=["content"],U=["content"],X={class:"block-content"},$={class:"title-section"},q=s(()=>t("h1",{class:"text-primary"},[t("span",null,[t("i",{class:"fa fa-chevron-left","aria-hidden":"true"}),c(" Back")])],-1)),G={class:"single-post-box"},J={class:"day-divider",style:{"border-bottom":"1px solid #d3d3d3","margin-top":"20px"}},K=s(()=>t("br",null,null,-1)),Q=s(()=>t("br",null,null,-1)),Z={class:"title-post"},tt={style:{display:"flex","justify-content":"space-between","align-items":"center"}},et={style:{"flex-grow":"1"}},st={class:"post-tags"},at=s(()=>t("i",{class:"fa fa-clock-o"},null,-1)),ot=s(()=>t("i",{class:"fa fa-user"},null,-1)),lt=c("by "),nt={href:"#"},rt=s(()=>t("i",{class:"fa fa-bookmark"},null,-1)),ct={class:"post-tags share-post-links"},it={class:"share-post-mobile",style:{position:"relative"}},dt={class:"btn",style:{"margin-right":"0","background-color":"#1854dd"}},ht=["href"],ut=s(()=>t("i",{class:"fa-brands fa-facebook-f",style:{"margin-right":"0",color:"#fff"}},null,-1)),pt=[ut],_t={class:"btn",style:{"margin-right":"0","background-color":"#18a3dd"}},ft=["href"],gt=s(()=>t("i",{class:"fa fa-twitter",style:{"margin-right":"0",color:"#fff"}},null,-1)),mt=[gt],yt={class:"btn",style:{"background-color":"#25d366"}},bt=["href"],kt=s(()=>t("i",{class:"fa fa-whatsapp",style:{"margin-right":"0",color:"#fff"}},null,-1)),vt=[kt],wt=s(()=>t("i",{class:"fa fa-share-alt"},null,-1)),xt=s(()=>t("span",{class:"text-uppercase"},"Share",-1)),St=[wt,xt],Ft={class:"share-post-desktop"},Ct=s(()=>t("li",{class:"text-secondary"},[t("i",{class:"fa fa-share-alt text-secondary"}),t("span",{class:"text-secondary"},"Share Post")],-1)),Lt=["href"],Bt=s(()=>t("i",{class:"fa fa-facebook text-secondary"},null,-1)),At=[Bt],Mt=["href"],Ht=s(()=>t("i",{class:"fa fa-twitter text-secondary"},null,-1)),Tt=[Ht],Dt=["href"],Yt=s(()=>t("i",{class:"fa fa-whatsapp text-secondary"},null,-1)),Et=[Yt],It={key:0,class:"post-gallery float-img",style:{float:"left",margin:"0px 15px 5px 0px"}},Nt={style:{position:"relative"}},Vt=["src"],jt={key:0,class:"image-caption"},zt=["innerHTML"],Ot={key:0,style:{"margin-bottom":"20px"}},Rt=["src"],Wt=["src"],Pt=s(()=>t("span",{style:{"white-space":"nowrap"}},null,-1)),Ut={key:0,class:"text-center hide-on-tablet"},Xt={key:1,class:"text-center hide-on-tablet"},$t={class:"text-right"},qt={class:"text-right hide-on-mobile"},Gt={key:0,style:{"margin-left":"10px"}},Jt={key:0,class:"fa-sharp fa-solid fa-caret-up text-green"},Kt={key:1,style:{"margin-left":"10px"}},Qt={key:0,class:"fa-sharp fa-solid fa-caret-down text-red"},Zt={key:1},te={class:"post-tags-box"},ee={class:"tags-box"},se=s(()=>t("i",{class:"fa fa-tags"},null,-1)),ae=s(()=>t("span",null,"Tags:",-1)),oe={__name:"Show",props:{slug:{type:String,default:""},report:{type:Object}},setup(e){T();const u=v(!1),y=()=>{u.value=!u.value};function b(p){switch(p){case"brokenMirror":return Y;case"bulletHole":return E;case"flames":return I;case"happyBirthday":return N;case"iceCubes":return V;case"pocketAces":return j;case"sunRays":return z;case"waterLeaves":return O;case"waterWaves":return R}}return(p,le)=>(a(),w(L,{title:""},{default:d(()=>[h(i(x),null,{default:d(()=>[t("title",null,n(e.report.data.title),1),W,t("meta",{property:"og:title=",content:e.report.data.title},null,8,P),t("meta",{property:"og:description",content:e.report.data.content},null,8,U)]),_:1}),t("div",X,[t("div",$,[h(i(S),{onclick:"history.back();return false;"},{default:d(()=>[q]),_:1})]),t("div",G,[t("div",J,[t("span",null,"Day: "+n(e.report.data.day),1),K,t("span",null,n(e.report.data.level.level),1),Q]),t("div",Z,[t("h1",null,n(e.report.data.title),1),t("div",tt,[t("div",et,[t("ul",st,[t("li",null,[at,c(n(i(M)(e.report.data.date_added).format("MMM D YYYY")),1)]),t("li",null,[ot,lt,t("a",nt,n(e.report.data.article_author.first_name)+" "+n(e.report.data.article_author.last_name),1)]),t("li",null,[rt,c(" "+n(e.report.data.level.level),1)])])]),t("div",null,[t("ul",ct,[t("div",it,[t("div",{class:_(["btn-group-vertical social-links-group",{show:u.value}])},[t("li",dt,[t("a",{target:"_blank",href:"https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flifeofpoker.com%2Freport%2F"+e.report.data.slug+"&src=sdkpreparse"},pt,8,ht)]),t("li",_t,[t("a",{target:"_blank",href:"https://twitter.com/intent/tweet?text=https%3A//lifeofpoker.com/report/"+e.report.data.slug},mt,8,ft)]),t("li",yt,[t("a",{target:"_blank",href:"https://api.whatsapp.com/send?text=%0ahttps://lifeofpoker.com/report/"+e.report.data.slug},vt,8,bt)])],2),t("li",{onClick:y,class:"btn btn-default share-btn-mobile"},St)]),t("div",Ft,[Ct,t("li",null,[t("a",{target:"_blank",href:"https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flifeofpoker.com%2Freport%2F"+e.report.data.slug+"&src=sdkpreparse",class:"facebook"},At,8,Lt)]),t("li",null,[t("a",{target:"_blank",href:"https://twitter.com/intent/tweet?text=https%3A//lifeofpoker.com/report/"+e.report.data.slug,class:"twitter"},Tt,8,Mt)]),t("li",null,[t("a",{target:"_blank",href:"https://api.whatsapp.com/send?text=%0ahttps://lifeofpoker.com/report/"+e.report.data.slug,class:"whatsapp"},Et,8,Dt)])])])])])]),t("div",{class:_([e.report.data.main_image?"post-content-min-height":"","post-content"])},[e.report.data.main_image?(a(),l("div",It,[t("div",Nt,[t("img",{src:e.report.data.main_image,alt:"",style:f([{"margin-bottom":"unset"},[e.report.data.theme?{filter:"brightness(0.8)"}:{}]])},null,12,Vt),t("div",{class:"imageFrame",style:f({"background-image":"url("+b(e.report.data.theme)+")"})},null,4)]),e.report.data.caption?(a(),l("span",jt,n(e.report.data.caption),1)):r("",!0)])):r("",!0),t("div",{class:"remove-padding",innerHTML:e.report.data.content},null,8,zt)],2),e.report.data.event_chips?(a(),l("div",Ot,[h(B,null,{"table-body":d(()=>[(a(!0),l(g,null,m(e.report.data.event_chips,(o,k)=>(a(),l("tr",{key:k},[t("td",null,[o.player.avatar?(a(),l("img",{key:0,class:"hide-on-mobile",src:o.player.avatar},null,8,Rt)):(a(),l("img",{key:1,class:"hide-on-mobile",src:i(A)},null,8,Wt)),c(" "+n(o.player.name)+" ",1),Pt]),o.player.country?(a(),l("td",Ut,[h(i(H),{title:o.player.country.name,iso:o.player.country.iso_3166_2},null,8,["title","iso"])])):(a(),l("td",Xt," ? ")),t("td",$t,n(o.current_chips===0?"BUSTED":o.current_chips.toLocaleString()),1),t("td",qt,[c(n(o.current_chips===0?"":o.changes.toLocaleString())+" ",1),o.symbol==="up"?(a(),l("span",Gt,[o.current_chips!=0?(a(),l("i",Jt)):r("",!0)])):(a(),l("span",Kt,[o.current_chips!=0?(a(),l("i",Qt)):r("",!0)]))])]))),128))]),_:1})])):r("",!0),e.report.data.event_chips.length?(a(),l("div",Zt,[t("div",te,[t("ul",ee,[t("li",null,[se,ae,(a(!0),l(g,null,m(e.report.data.event_chips,o=>(a(),l("a",{href:"#",key:o.id},n(o.player.name),1))),128))])])])])):r("",!0)])])]),_:1}))}},ue=D(oe,[["__scopeId","data-v-ee603e55"]]);export{ue as default};
