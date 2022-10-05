import{p as w,o as s,e as o,g as a,a as t,F as h,h as b,b as l,w as c,L as r,i as m,t as n,f as x,m as S,E as M,G as B,c as E}from"./app.ca685181.js";import{_ as I}from"./FrontLayout.ae304bbd.js";import{d as g}from"./default-img.f9de1402.js";import{u as k}from"./article.5cb1ea1a.js";import{u as L}from"./event.b39d26ca.js";import{_ as N}from"./_plugin-vue_export-helper.cdc0426e.js";const f=i=>(M("data-v-56a36b4e"),i=i(),B(),i),F={key:0,class:"article-box block-content"},V=f(()=>t("div",{class:"title-section"},[t("h1",null,[t("span",null,"Live reporting")])],-1)),A={class:"row",style:{"margin-right":"0"}},P={class:"news-post image-post",style:{"margin-bottom":"30px"}},z={key:0,style:{position:"absolute",top:"20px",right:"20px","z-index":"1",padding:"8px 16px","font-weight":"bolder","background-color":"#f44336",color:"#fff"}},C={key:1,style:{position:"absolute",top:"20px",right:"20px","z-index":"1",padding:"8px 16px","font-weight":"bolder","background-color":"#f44336",color:"#fff"}},$=["src","alt"],K=["src"],O={class:"hover-box",style:{inset:"0"}},T={class:"inner-hover"},D={class:"text-white"},G={key:1,class:"article-box block-content",style:{"margin-top":"30px"}},W=f(()=>t("div",{class:"title-section"},[t("h1",null,[t("span",null,"Latest News")])],-1)),j={class:"row"},H={class:"col-sm-6"},J={class:"post-gallery"},U=["src","alt"],Z=["src","alt"],q={class:"col-sm-6"},Q={class:"post-content"},R=f(()=>t("div",{class:"article-box block-content"},[t("div",{class:"title-section"},[t("h1",null,[t("span",{class:""},"Video")])]),t("div",{class:"row"},[t("div",{class:"col-md-4 news-post article-post",style:{"margin-bottom":"0"}},[t("div",{class:"news-post standard-post2 default-size"},[t("div",{class:"post-gallery",style:{background:"transparent"}},[t("iframe",{width:"100%",height:"auto",src:"https://www.youtube.com/embed/S2SSslc8wBs",title:"APT Philippines 2022 Main Event Highlights",frameborder:"0",allow:"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture",allowfullscreen:"",style:{"aspect-ratio":"16 / 9"}})])])]),t("div",{class:"col-md-4 news-post article-post",style:{"margin-bottom":"0"}},[t("div",{class:"news-post standard-post2 default-size"},[t("div",{class:"post-gallery",style:{background:"transparent"}},[t("iframe",{width:"100%",height:"auto",src:"https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2FPokerStarsAsia%2Fvideos%2F1775890926121412%2F&show_text=false&width=560&t=0",frameborder:"0",allow:"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture",allowfullscreen:"",style:{"aspect-ratio":"16 / 9"}})])])]),t("div",{class:"col-md-4 news-post article-post",style:{"margin-bottom":"0"}},[t("div",{class:"news-post standard-post2 default-size"},[t("div",{class:"post-gallery",style:{background:"transparent"}},[t("iframe",{width:"100%",height:"auto",src:"https://www.youtube.com/embed/bNZd_JIKNKE",title:"WPT Prime Vietnam - Day 1 highlights",frameborder:"0",allow:"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture",allowfullscreen:"",style:{"aspect-ratio":"16 / 9"}})])])])])],-1)),X={__name:"MainBar",props:{articleList:{type:Object,default:{}}},setup(i){const d=k(),p=L();w(async()=>{await p.getMainEvents()});const u=async v=>{d.getArticleBySlug(v)};return(v,tt)=>{var y;return s(),o(h,null,[(y=a(p).mainEvents.data)!=null&&y.length?(s(),o("div",F,[V,t("div",A,[(s(!0),o(h,null,b(a(p).mainEvents.data,(e,_)=>(s(),o("div",{class:"col-lg-6 unset-padding-right",key:_},[t("div",P,[e.status==="live"?(s(),o("span",z,"LIVE NOW")):(s(),o("span",C,"UPCOMING")),e.main_thumb?(s(),o("img",{key:2,src:e.main_thumb,alt:e.main_thumb},null,8,$)):(s(),o("img",{key:3,src:a(g),alt:""},null,8,K)),l(a(r),{href:"/event/"+e.slug},{default:c(()=>[t("div",O,[t("div",T,[t("h2",null,[l(a(r),{href:"/event/"+e.slug},{default:c(()=>[m(n(e.title),1)]),_:2},1032,["href"])]),t("p",D,n(e.tournament),1)])])]),_:2},1032,["href"])])]))),128))])])):x("",!0),(s(),o("div",G,[W,(s(!0),o(h,null,b(i.articleList.data,e=>(s(),o("div",{class:"news-post article-post",key:e.id},[l(a(r),{onClick:S(_=>u(e.slug),["prevent"]),onMouseover:_=>u(e.slug),href:"/article/show/"+e.slug},{default:c(()=>[t("div",j,[t("div",H,[t("div",J,[e.main_image.length?(s(),o("img",{key:0,src:e.main_image,alt:e.main_image},null,8,U)):(s(),o("img",{key:1,src:a(g),alt:a(g)},null,8,Z)),l(a(r),{class:"category-post food",href:"/"},{default:c(()=>[m(n(e.categories[0].title),1)]),_:2},1024)])]),t("div",q,[t("div",Q,[t("h2",null,[l(a(r),{href:"/article/show/"+e.slug},{default:c(()=>[m(n(e.title),1)]),_:2},1032,["href"])]),t("p",null,n(e.description),1)])])])]),_:2},1032,["onClick","onMouseover","href"])]))),128))])),R],64)}}},Y=N(X,[["__scopeId","data-v-56a36b4e"]]),ct={__name:"Index",setup(i){const d=k();return w(async()=>{d.getList()}),(p,u)=>(s(),E(I,{title:"Kartok"},{default:c(()=>[l(Y,{"article-list":a(d).list},null,8,["article-list"])]),_:1}))}};export{ct as default};
