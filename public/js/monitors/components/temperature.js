define(["jquery","moment","Chart","monitors/timeout","monitors/monitor"],function(t,o,n,e,a){function r(t,o,n){return t<o?o:t>n?n:t}function i(t){return t=Number(t),t<0?Math.ceil(t):Math.floor(t)}function s(){console.info("Promise loaded.")}function m(t){setTimeout(function(){a.measures(u,h,c).done(function(o){var n=o.items;t.render(n),t.plot(n),m(t)})},e)}var u=t("input#id").val(),d=t("div#monitor-view"),h=30,c="desc";n.defaults.global.animation=0;var l={moment:function(){return function(t,n){return o(n(t)).fromNow()}},getFgColor:function(){var t=i(this.data.min),o=i(this.data.max),n=o-t,e=n/3,a=i(this.item.data.value),r="#3498db";return a>=t&&a<t+e?r="#f39c12":a>o-e&&a<=o&&(r="#e74c3c"),function(t,o){return r}},getValue:function(){var t=r(this.item.data.value,this.data.min,this.data.max);return function(o,n){return t}}},f=function(o,n){this.template=o,this.monitor=t.extend(n,l),this.chartOptions={scales:{yAxes:[{ticks:{min:1*this.monitor.data.min,max:1*this.monitor.data.max}}]}}};f.prototype.render=function(o){if(o=o||[],o.length>0){this.monitor.item=o[0];var n=a.render(this.template,this.monitor);d.html(n),t(".input-knob").knob({readOnly:!0,width:250,fontWeight:"hack"})}},f.prototype.plot=function(o){o=o||[];var e=[],a=[],i=o.length;if(i>0){for(var s=i-1;s>=0;s--){var m=o[s];e.push(m.created_at);var u=r(m.data.value,this.monitor.data.min,this.monitor.data.max);a.push(u)}var d=t("#temperature-chart"),h=d.get(0).getContext("2d");this.chart=new n(h,{type:"line",data:{labels:e,datasets:[{label:this.monitor.data.description,data:a,borderColor:"rgba(52,152,219,1)",pointBackgroundColor:"rgba(52,152,219,1)",pointBorderColor:"rgba(52,152,219,1)",pointHoverBackgroundColor:"#fff",pointBorderWidth:4,backgroundColor:"rgba(151,187,205,0.2)"}]},options:this.chartOptions})}},t.when(t.get("/templates/temperature/show.mustache"),a.fetch(u,s),a.measures(u,h,c,s)).done(function(o,n,e){var a=o[0],r=n[0].monitor,i=e[0].items,s=new f(a,r);s.render(i),s.plot(i),i.length||(d.html(""),t(".nav-tabs a#tab-setup").tab("show")),m(s)})});