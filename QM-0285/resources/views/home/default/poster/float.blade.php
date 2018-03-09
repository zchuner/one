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
  this.IsHitCount = "N";
  this.UploadFilePath = "";
  
  this.Step = 1;
  this.Delay= 20;
  this.WindowHeight = 0;
  this.WindowWidth = 0;
  this.Yon = 0;
  this.Xon = 0;
  this.Pause = true;
  this.Interval = null;
  this.URL = "";
  this.SiteID = 0;
  
  this.ShowAD  = showADContent;
  this.Start   = doStart;
  this.Stat = statAD;
}

function statAD() {
	var new_element = document.createElement("script"); 
	new_element.type = "text/javascript";
	new_element.src="{APP_PATH}poster/index/show?siteid="+this.SiteID+"&id="+this.ADID+"&spaceid="+this.PosID;
	document.body.appendChild(new_element);
}

function showADContent() {
  var content = this.ADContent;
  var str = "<div id='PCMSAD_"+this.PosID+"' style='left:"+this.PaddingLeft+"px;top:"+this.PaddingTop+"px;width:"+this.Width+"px; height:"+this.Height+"px; position: absolute;visibility: visible;z-index:999999;' onMouseOver='"+this.ID+"_pause_resume();' onMouseOut='"+this.ID+"_pause_resume();'>";
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
	  str += "<embed wmode='opaque' src='"+this.UploadFilePath+AD.Images[0].ImgPath+"' quality='autohigh' name='flashad' swliveconnect='TRUE' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='"+this.Width+"' height='"+this.Height+"'></embed>";
      str += "</object>";	  
  }
  str += "<div style='text-align:right;'><a href='javascript:void(0);' onclick='javascript:document.getElementById(\"PCMSAD_"+this.PosID+"\").style.display=\"none\"'>关闭</a></div>";
  str += "</div>";
  document.write(str);
}

function changePos(float) {	
	float.WindowWidth  = document.compatMode == "BackCompat" ? document.body.clientWidth : document.documentElement.clientWidth;
	float.WindowHeight = document.compatMode == "BackCompat" ? document.body.clientHeight : document.documentElement.clientHeight;
	document.getElementById("PCMSAD_"+float.PosID).style.left = (float.PaddingLeft + (Math.max(document.documentElement.scrollLeft, document.body.scrollLeft)))+"px";
	document.getElementById("PCMSAD_"+float.PosID).style.top = (float.PaddingTop + (Math.max(document.documentElement.scrollTop, document.body.scrollTop)))+"px";
	if (float.Yon){
		float.PaddingTop = float.PaddingTop + float.Step;
	}else{
		float.PaddingTop = float.PaddingTop - float.Step;
	}
	if (float.PaddingTop < 0){
		float.Yon = 1;
		float.PaddingTop = 0;
	}
	if (float.PaddingTop >= (float.WindowHeight - float.Height)){
		float.Yon = 0;float.PaddingTop = (float.WindowHeight - float.Height);
	}
	if (float.Xon){
		float.PaddingLeft = float.PaddingLeft + float.Step;
	}else{
		float.PaddingLeft = float.PaddingLeft - float.Step;
	}
	if (float.PaddingLeft < 0){
		float.Xon = 1;
		float.PaddingLeft = 0;
	}
	if (float.PaddingLeft >= (float.WindowWidth - float.Width)){
		float.Xon = 0;
		float.PaddingLeft = (float.WindowWidth - float.Width);   
	}
}
	
function doStart(float){
	return function(){
        changePos(float);
    }
}
 
function cmsAD_{$spaceid}_pause_resume(){if(cmsAD_{$spaceid}.Pause){clearInterval(cmsAD_{$spaceid}.Interval);cmsAD_{$spaceid}.Pause = false;}else {cmsAD_{$spaceid}.Interval = setInterval(cmsAD_{$spaceid}.Start(cmsAD_{$spaceid}),cmsAD_{$spaceid}.Delay);cmsAD_{$spaceid}.Pause = true;}} 
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
document.getElementById('PCMSAD_{$spaceid}').visibility = 'visible';
cmsAD_{$spaceid}.Interval = setInterval(cmsAD_{$spaceid}.Start(cmsAD_{$spaceid}),cmsAD_{$spaceid}.Delay);