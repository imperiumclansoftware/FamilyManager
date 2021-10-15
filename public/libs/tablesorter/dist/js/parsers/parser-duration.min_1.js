/*! Parser: duration & countdown - updated 2/7/2015 (v2.19.0) */
!function(a){"use strict";a.tablesorter.addParser({id:"duration",is:function(){return!1},format:function(a,b){var c,d,e=b.config,f="",g="",h=e.durationLength||4,i=new Array(h+1).join("0"),j=(e.durationLabels||"(?:years|year|y),(?:days|day|d),(?:hours|hour|h),(?:minutes|minute|min|m),(?:seconds|second|sec|s)").split(/\s*,\s*/),k=j.length;if(!e.durationRegex){for(c=0;k>c;c++)f+="(?:(\\d+)\\s*"+j[c]+"\\s*)?";e.durationRegex=new RegExp(f,"i")}for(d=(e.usNumberFormat?a.replace(/,/g,""):a.replace(/(\d)(?:\.|\s*)(\d)/g,"$1$2")).match(e.durationRegex),c=1;k+1>c;c++)g+=(i+(d[c]||0)).slice(-h);return g},type:"text"}),/*! Countdown parser ( hh:mm:ss ) */
a.tablesorter.addParser({id:"countdown",is:function(){return!1},format:function(a,b){for(var c=b.config.durationLength||4,d=new Array(c+1).join("0"),e=a.split(/\s*:\s*/),f=e.length,g=[];f;)g.push((d+(e[--f]||0)).slice(-c));return g.length?g.reverse().join(""):a},type:"text"})}(jQuery);