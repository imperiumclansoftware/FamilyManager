/*! Parser: weekday - updated 10/26/2014 (v2.18.0) */
!function(a){"use strict";var b=a.tablesorter;b.dates=a.extend({},b.dates,{weekdayCased:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"]}),b.dates.weekdayLower=b.dates.weekdayCased.join(",").toLocaleLowerCase().split(","),b.addParser({id:"weekday",is:function(){return!1},format:function(c,d){if(c){var e=-1,f=d.config;return c=f.ignoreCase?c.toLocaleLowerCase():c,a.each(b.dates["weekday"+(f.ignoreCase?"Lower":"Cased")],function(a,b){return 0>e&&c.match(b)?(e=a,!1):void 0}),0>e?c:e}return c},type:"numeric"})}(jQuery);