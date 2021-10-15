/*! Parser: Extract out date - updated 10/26/2014 (v2.18.0) */
!function(a){"use strict";var b={usLong:/[A-Z]{3,10}\.?\s+\d{1,2},?\s+(?:\d{4})(?:\s+\d{1,2}:\d{2}(?::\d{2})?(?:\s+[AP]M)?)?/i,mdy:/(\d{1,2}[\/\s]\d{1,2}[\/\s]\d{4}(\s+\d{1,2}:\d{2}(:\d{2})?(\s+[AP]M)?)?)/i,dmy:/(\d{1,2}[\/\s]\d{1,2}[\/\s]\d{4}(\s+\d{1,2}:\d{2}(:\d{2})?(\s+[AP]M)?)?)/i,dmyreplace:/(\d{1,2})[\/\s](\d{1,2})[\/\s](\d{4})/,ymd:/(\d{4}[\/\s]\d{1,2}[\/\s]\d{1,2}(\s+\d{1,2}:\d{2}(:\d{2})?(\s+[AP]M)?)?)/i,ymdreplace:/(\d{4})[\/\s](\d{1,2})[\/\s](\d{1,2})/};/*! extract US Long Date */
a.tablesorter.addParser({id:"extractUSLongDate",is:function(){return!1},format:function(a){var c,d=a?a.match(b.usLong):a;return d?(c=new Date(d[0]),c instanceof Date&&isFinite(c)?c.getTime():a):a},type:"numeric"}),/*! extract MMDDYYYY */
a.tablesorter.addParser({id:"extractMMDDYYYY",is:function(){return!1},format:function(a){var c,d=a?a.replace(/\s+/g," ").replace(/[\-.,]/g,"/").match(b.mdy):a;return d?(c=new Date(d[0]),c instanceof Date&&isFinite(c)?c.getTime():a):a},type:"numeric"}),/*! extract DDMMYYYY */
a.tablesorter.addParser({id:"extractDDMMYYYY",is:function(){return!1},format:function(a){var c,d=a?a.replace(/\s+/g," ").replace(/[\-.,]/g,"/").match(b.dmy):a;return d?(c=new Date(d[0].replace(b.dmyreplace,"$2/$1/$3")),c instanceof Date&&isFinite(c)?c.getTime():a):a},type:"numeric"}),/*! extract YYYYMMDD */
a.tablesorter.addParser({id:"extractYYYYMMDD",is:function(){return!1},format:function(a){var c,d=a?a.replace(/\s+/g," ").replace(/[\-.,]/g,"/").match(b.ymd):a;return d?(c=new Date(d[0].replace(b.ymdreplace,"$2/$3/$1")),c instanceof Date&&isFinite(c)?c.getTime():a):a},type:"numeric"})}(jQuery);