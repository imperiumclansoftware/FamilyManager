!function(a){"use strict";var b=a.tablesorter,c={init:function(b,d,e){var f,g=e.reflow_dataAttrib,h=e.reflow_headerAttrib,i=[];d.$table.addClass(e.reflow_className).off("refresh.tsreflow updateComplete.tsreflow2").on("refresh.tsreflow updateComplete.tsreflow2",function(){c.init(b,d,e)}),d.$headers.each(function(){f=a(this),i.push(a.trim(f.attr(h)||f.text()))}),d.$tbodies.children().each(function(){a(this).children().each(function(b){a(this).attr(g,i[b])})})},init2:function(d,e,f){var g,h,i,j,k,l,m=e.columns,n=f.reflow2_headerAttrib,o=[];for(e.$table.addClass(f.reflow2_className).off("refresh.tsreflow2 updateComplete.tsreflow2").on("refresh.tsreflow2 updateComplete.tsreflow2",function(){c.init2(d,e,f)}),i=0;m>i;i++)j=e.$headers.filter('[data-column="'+i+'"]'),j.length>1?(k=[],j.each(function(){g=a(this),g.hasClass(f.reflow2_classIgnore)||k.push(g.attr(n)||g.text())})):k=[j.attr(n)||j.text()],o.push(k);k='<b class="'+e.selectorRemove.slice(1)+" "+f.reflow2_labelClass,e.$tbodies.children().each(function(){h=b.processTbody(d,a(this),!0),h.children().each(function(b){for(g=a(this),l=o[b].length,i=l-1;i>=0;)g.prepend(k+(0===i&&l>1?" "+f.reflow2_labelTop:"")+'">'+o[b][i]+"</b>"),i--}),b.processTbody(d,h,!1)})},remove:function(a,b,c){b.$table.removeClass(c.reflow_className)},remove2:function(a,b,c){b.$table.removeClass(c.reflow2_className)}};b.addWidget({id:"reflow",options:{reflow_className:"ui-table-reflow",reflow_headerAttrib:"data-name",reflow_dataAttrib:"data-title"},init:function(a,b,d,e){c.init(a,d,e)},remove:function(a,b,d){c.remove(a,b,d)}}),b.addWidget({id:"reflow2",options:{reflow2_className:"ui-table-reflow",reflow2_classIgnore:"ui-table-reflow-ignore",reflow2_headerAttrib:"data-name",reflow2_labelClass:"ui-table-cell-label",reflow2_labelTop:"ui-table-cell-label-top"},init:function(a,b,d,e){c.init2(a,d,e)},remove:function(a,b,d){c.remove2(a,b,d)}})}(jQuery);