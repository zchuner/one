function PCMSAD(PID) {
  this.ID        = PID;
  this.PosID  = 0; 
  this.ADID		  = 0;
  this.ADType	  = "";
  this.ADName	  = "";
  this.ADContent = "";
  this.PaddingLeft = 0;
  this.PaddingTop  = 0;
  this.Width = 0;
  this.Height = 0;
  this.IsHitCount = "Y";
  this.Scroll = "N";
  this.Align  = "N";
  this.UploadFilePath = "";
  this.URL = "";
  this.SiteID = 0;
  this.ShowAD  = showADContent;
  this.Stat = statAD;
}

function statAD() {
	var new_element = document.createElement("script"); 
	new_element.type = "text/javascript";
	new_element.src="{APP_PATH}poster/index/show?siteid="+this.SiteID+"&id="+this.ADID+"&spaceid="+this.PosID;
	document.body.appendChild(new_element);
}

var delta=0.08

function showADContent() {
  var content = this.ADContent;
  var str = "<div id='PCMSAD_"+this.PosID+"' style='left:"+this.PaddingLeft+"px;top:"+this.PaddingTop+"px;width:"+this.Width+"px; height:"+this.Height+"px; position: absolute;visibility: visible;z-index:999998;'>";
  var AD = eval('('+content+')');
  if (this.ADType == "images") {
	  if (AD.Images[0].imgADLinkUrl) str += "<a href='"+this.URL+"poster_click?siteid="+this.SiteID+"&id="+this.ADID+"&url="+AD.Images[0].imgADLinkUrl+"' target='_blank'>";
	  str += "<img title='"+AD.Images[0].imgADAlt+"' src='"+this.UploadFilePath+AD.Images[0].ImgPath+"' width='"+this.Width+"' height='"+this.Height+"' style='border:0px;'>";
	  if (AD.Images[0].imgADLinkUrl) str += "</a>";
  }else if(this.ADType == "flash"){
	  str += "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' width='"+this.Width+"' height='"+this.Height+"' id='FlashAD_"+this.PosID+"' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0'>";
	  str += "<param name='movie' value='"+this.UploadFilePath+AD.Images[0].ImgPath+"' />"; 
      str += "<param name='quality' value='autohigh' />";
      str += "<param name='wmode' value='opaque'/>";
	  str += "<embed wmode='opaque' src='"+this.UploadFilePath+AD.Images[0].ImgPath+"' quality='autohigh' name='flashad' swliveconnect='TRUE' pluginspage='http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash' type='application/x-shockwave-flash' width='"+this.Width+"' height='"+this.Height+"'></embed>";
      str += "</object>";	  
  }
  str += "<div style='text-align:right;'><a href='javascript:void(0);' onclick='javascript:document.getElementById(\"PCMSAD_"+this.PosID+"\").style.display=\"none\"'>关闭</a></div>";
  str += "</div>";
  document.write(str);
  setInterval("playFixureAD(\""+this.Align+"\",\"PCMSAD_"+this.PosID+"\")",10);
}

function playFixureAD(Align,ADID){
	var followObj		= document.getElementById(ADID);
	var followObj_x		= 0;
	var followObj_y		= 0;
	var Cwidth  = document.compatMode == "BackCompat" ? document.body.clientWidth : document.documentElement.clientWidth;
	var CHeight = document.compatMode == "BackCompat" ? document.body.clientHeight : document.documentElement.clientHeight;
	if(Align=="Y"){
		followObj_x = parseInt((Cwidth/2)-(followObj.clientWidth/2));
		followObj_y = parseInt((CHeight/2)-(followObj.clientHeight/2));
		if(followObj.offsetLeft!=(document.documentElement.scrollLeft+followObj_x)) {
			var dx=(document.documentElement.scrollLeft+followObj_x-followObj.offsetLeft)*delta;
			dx=(dx>0?1:-1)*Math.ceil(Math.abs(dx));
			followObj.style.left=(followObj.offsetLeft+dx)+"px";
		}
		if(followObj.offsetTop!=(document.documentElement.scrollTop+followObj_y)) {
			var dy=(document.documentElement.scrollTop+followObj_y-followObj.offsetTop)*delta;
			dy=(dy>0?1:-1)*Math.ceil(Math.abs(dy));
			followObj.style.top=(followObj.offsetTop+dy)+"px";
		}
	}
}
 
var cmsAD_{$spaceid} = new PCMSAD('cmsAD_{$spaceid}'); 
cmsAD_{$spaceid}.PosID = {$spaceid}; 
cmsAD_{$spaceid}.ADID = {$p_id}; 
cmsAD_{$spaceid}.ADType = "{$p_type}"; 
cmsAD_{$spaceid}.ADName = "{$p_name}"; 
cmsAD_{$spaceid}.ADContent = "{'Images':[{'imgADLinkUrl':'{urlencode($p_setting[1]['linkurl'])}','imgADAlt':'{$p_setting[1]['alt']}','ImgPath':'<?php echo $p_type=='images' ? $p_setting[1]['imageurl'] : $p_setting[1]['flashurl'];?>'}],'imgADLinkTarget':'New','Count':'1','showAlt':'Y'}"; 
cmsAD_{$spaceid}.URL = "{APP_PATH}poster/index/";
cmsAD_{$spaceid}.SiteID = {$siteid}; 
cmsAD_{$spaceid}.PaddingLeft = {if $space_setting['paddleft']} {$space_setting['paddleft']} {else}0{/if}; 
cmsAD_{$spaceid}.PaddingTop = {if $space_setting['paddtop']} {$space_setting['paddtop']} {else}0{/if}; 
cmsAD_{$spaceid}.Scroll = '{if $space_setting['align']}Y{else}N{/if}'; 
cmsAD_{$spaceid}.Align = '{if $space_setting['align']}Y{else}N{/if}'; 
cmsAD_{$spaceid}.Width = {$width}; 
cmsAD_{$spaceid}.Height = {$height}; 
cmsAD_{$spaceid}.UploadFilePath = ""; 
cmsAD_{$spaceid}.ShowAD();

var isIE=!!window.ActiveXObject; 
if (isIE){

	if (document.readyState=="complete"){
		cmsAD_{$spaceid}.Stat();
	} else {
		document.onreadystatechange=function(){
			if(document.readyState=="complete") cmsAD_{$spaceid}.Stat();
		}
	}
} else {
	cmsAD_{$spaceid}.Stat();
}