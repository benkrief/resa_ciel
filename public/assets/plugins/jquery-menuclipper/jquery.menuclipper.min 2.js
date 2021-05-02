/*
 *  jQuery Menu Clipper - v0.0.1
 *  Clips overflowing items from a navigation bar and adds them into a dropdown
 *  https://github.com/praveenaj/jquery-menuclipper
 *
 *  Made by Praveena Sarathchandra
 *  Under MIT License
 */
!function(e,n,t,i){var r,o="menuclipper",p={menu:".menuclipper-menu",item:".menuclipper-menu > li",bufferWidth:100};function d(n,t){this.element=n,this.options=e.extend({},p,t),this._defaults=p,this._name=o,this.init()}d.prototype={init:function(){this.refresh()},refresh:function(){var n=e(this.element),t=e(this.options.item),i=n.outerWidth(!0),r=0,o=-1,p=this;t.each(function(n){var t=e(this).actual("outerWidth",{includeMargin:!0});if(o>-1)return e(this).addClass("hidden"),!0;t+r+p.options.bufferWidth<i?(r+=t,e(this).removeClass("hidden")):(o<0&&(o=n),e(this).addClass("hidden"))});var d=t.splice(o,t.length),u=e(".menuclipper-dropdown").length?e(".menuclipper-dropdown"):e('<div class="dropdown menuclipper-dropdown"/>');!e(".menuclipper-dropdown").length&&u.append('<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>');var l=e(".menuclipper-dropdown-menu").length?e(".menuclipper-dropdown-menu"):e('<ul class="dropdown-menu menuclipper-dropdown-menu pull-right" role="menu"/>');if(o>-1){u.show(),u.insertAfter(t.eq(o-1)),l.empty();for(var s in d){var a='<li role="presentation">'+e(d[s]).html()+"</li>";l.append(a)}!e(".menuclipper-dropdown-menu").length&&u.append(l)}else u.hide()}},e.fn[o]=function(n){return this.each(function(){e.data(this,"plugin_"+o)||e.data(this,"plugin_"+o,new d(this,n))})},e(n).on("resize",function(){clearTimeout(r),r=setTimeout(function(){e(".menuclipper").each(function(){var n=e(this).data("plugin_"+o);n&&n.refresh()})},100)})}(jQuery,window,document);