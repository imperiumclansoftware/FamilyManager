/*! Widget: stickyHeaders - updated 3/26/2015 (v2.21.3) */
!function(a,b){"use strict";var c=a.tablesorter||{};a.extend(c.css,{sticky:"tablesorter-stickyHeader",stickyVis:"tablesorter-sticky-visible",stickyHide:"tablesorter-sticky-hidden",stickyWrap:"tablesorter-sticky-wrapper"}),c.addHeaderResizeEvent=function(b,c,d){if(b=a(b)[0],b.config){var e={timer:250},f=a.extend({},e,d),g=b.config,h=g.widgetOptions,i=function(a){var b,c,d,e,f,i,j=g.$headers.length;for(h.resize_flag=!0,c=[],b=0;j>b;b++)d=g.$headers.eq(b),e=d.data("savedSizes")||[0,0],f=d[0].offsetWidth,i=d[0].offsetHeight,(f!==e[0]||i!==e[1])&&(d.data("savedSizes",[f,i]),c.push(d[0]));c.length&&a!==!1&&g.$table.trigger("resize",[c]),h.resize_flag=!1};return i(!1),clearInterval(h.resize_timer),c?(h.resize_flag=!1,!1):void(h.resize_timer=setInterval(function(){h.resize_flag||i()},f.timer))}},c.addWidget({id:"stickyHeaders",priority:60,options:{stickyHeaders:"",stickyHeaders_attachTo:null,stickyHeaders_xScroll:null,stickyHeaders_yScroll:null,stickyHeaders_offset:0,stickyHeaders_filteredToTop:!0,stickyHeaders_cloneId:"-sticky",stickyHeaders_addResizeEvent:!0,stickyHeaders_includeCaption:!0,stickyHeaders_zIndex:2},format:function(d,e,f){if(!(e.$table.hasClass("hasStickyHeaders")||a.inArray("filter",e.widgets)>=0&&!e.$table.hasClass("hasFilters"))){var g,h,i,j,k=e.$table,l=a(f.stickyHeaders_attachTo),m=e.namespace+"stickyheaders ",n=a(f.stickyHeaders_yScroll||f.stickyHeaders_attachTo||b),o=a(f.stickyHeaders_xScroll||f.stickyHeaders_attachTo||b),p=k.children("thead:first"),q=p.children("tr").not(".sticky-false").children(),r=k.children("tfoot"),s=isNaN(f.stickyHeaders_offset)?a(f.stickyHeaders_offset):"",t=s.length?s.height()||0:parseInt(f.stickyHeaders_offset,10)||0,u=k.parent().closest("."+c.css.table).hasClass("hasStickyHeaders")?k.parent().closest("table.tablesorter")[0].config.widgetOptions.$sticky.parent():[],v=u.length?u.height():0,w=f.$sticky=k.clone().addClass("containsStickyHeaders "+c.css.sticky+" "+f.stickyHeaders+" "+e.namespace.slice(1)+"_extra_table").wrap('<div class="'+c.css.stickyWrap+'">'),x=w.parent().addClass(c.css.stickyHide).css({position:l.length?"absolute":"fixed",padding:parseInt(w.parent().parent().css("padding-left"),10),top:t+v,left:0,visibility:"hidden",zIndex:f.stickyHeaders_zIndex||2}),y=w.children("thead:first"),z="",A=0,B=function(a,c){var d,e,f,g,h,i=a.filter(":visible"),j=i.length;for(d=0;j>d;d++)g=c.filter(":visible").eq(d),h=i.eq(d),"border-box"===h.css("box-sizing")?e=h.outerWidth():"collapse"===g.css("border-collapse")?b.getComputedStyle?e=parseFloat(b.getComputedStyle(h[0],null).width):(f=parseFloat(h.css("border-width")),e=h.outerWidth()-parseFloat(h.css("padding-left"))-parseFloat(h.css("padding-right"))-f):e=h.width(),g.css({width:e,"min-width":e,"max-width":e})},C=function(){t=s.length?s.height()||0:parseInt(f.stickyHeaders_offset,10)||0,A=0,x.css({left:l.length?parseInt(l.css("padding-left"),10)||0:k.offset().left-parseInt(k.css("margin-left"),10)-o.scrollLeft()-A,width:k.outerWidth()}),B(k,w),B(q,j)},D=function(b){if(k.is(":visible")){v=u.length?u.offset().top-n.scrollTop()+u.height():0;var d=k.offset(),e=a.isWindow(n[0]),f=a.isWindow(o[0]),g=(l.length?e?n.scrollTop():n.offset().top:n.scrollTop())+t+v,h=k.height()-(x.height()+(r.height()||0)),i=g>d.top&&g<d.top+h?"visible":"hidden",j={visibility:i};l.length&&(j.top=e?g-l.offset().top:l.scrollTop()),f&&(j.left=k.offset().left-parseInt(k.css("margin-left"),10)-o.scrollLeft()-A),u.length&&(j.top=(j.top||0)+t+v),x.removeClass(c.css.stickyVis+" "+c.css.stickyHide).addClass("visible"===i?c.css.stickyVis:c.css.stickyHide).css(j),(i!==z||b)&&(C(),z=i)}};if(l.length&&!l.css("position")&&l.css("position","relative"),w.attr("id")&&(w[0].id+=f.stickyHeaders_cloneId),w.find("thead:gt(0), tr.sticky-false").hide(),w.find("tbody, tfoot").remove(),w.find("caption").toggle(f.stickyHeaders_includeCaption),j=y.children().children(),w.css({height:0,width:0,margin:0}),j.find("."+c.css.resizer).remove(),k.addClass("hasStickyHeaders").bind("pagerComplete"+m,function(){C()}),c.bindEvents(d,y.children().children("."+c.css.header)),k.after(x),e.onRenderHeader)for(i=y.children("tr").children(),h=i.length,g=0;h>g;g++)e.onRenderHeader.apply(i.eq(g),[g,e,w]);o.add(n).unbind("scroll resize ".split(" ").join(m).replace(/\s+/g," ")).bind("scroll resize ".split(" ").join(m),function(a){D("resize"===a.type)}),e.$table.unbind("stickyHeadersUpdate"+m).bind("stickyHeadersUpdate"+m,function(){D(!0)}),f.stickyHeaders_addResizeEvent&&c.addHeaderResizeEvent(d),k.hasClass("hasFilters")&&f.filter_columnFilters&&(k.bind("filterEnd"+m,function(){var d=a(document.activeElement).closest("td"),g=d.parent().children().index(d);x.hasClass(c.css.stickyVis)&&f.stickyHeaders_filteredToTop&&(b.scrollTo(0,k.position().top),g>=0&&e.$filters&&e.$filters.eq(g).find("a, select, input").filter(":visible").focus())}),c.filter.bindSearch(k,j.find("."+c.css.filter)),f.filter_hideFilters&&c.filter.hideFilters(w,e)),k.trigger("stickyHeadersInit")}},remove:function(d,e,f){var g=e.namespace+"stickyheaders ";e.$table.removeClass("hasStickyHeaders").unbind("pagerComplete filterEnd stickyHeadersUpdate ".split(" ").join(g).replace(/\s+/g," ")).next("."+c.css.stickyWrap).remove(),f.$sticky&&f.$sticky.length&&f.$sticky.remove(),a(b).add(f.stickyHeaders_xScroll).add(f.stickyHeaders_yScroll).add(f.stickyHeaders_attachTo).unbind("scroll resize ".split(" ").join(g).replace(/\s+/g," ")),c.addHeaderResizeEvent(d,!1)}})}(jQuery,window);