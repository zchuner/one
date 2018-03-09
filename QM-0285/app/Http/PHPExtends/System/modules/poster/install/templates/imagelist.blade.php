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
  this.URL = "";
  this.SiteID = 0;
  this.ShowAD  = showADContent;
  this.Stat = statAD;
}

function statAD(id) {
	var sp = document.createElement("SCRIPT");
	sp.type = "text/javascript";
	sp.src = "{APP_PATH}poster/index/show?siteid="+this.SiteID+"&id="+id+"&spaceid="+this.PosID;
	document.body.appendChild(sp);
}

function showADContent() {
  var content = this.ADContent;
  var isIE=!!window.ActiveXObject;
  var str = "<div id='PCMSAD_"+this.PosID+"'>";
  var AD = eval('('+content+')');
  var count = 0;
  if(AD.ADImage.length){
	  count = AD.ADImage.length;
  }
  for(var i=0;i<count;i++){
	if (isIE){

		if (document.readyState=="complete"){
			this.Stat(AD.ADImage[i].imgID);
		} else {
			document.onreadystatechange=function(){
				if(document.readyState=="complete") this.Stat(AD.ADImage[i].imgID);
			}
		}
	} else {
		this.Stat(AD.ADImage[i].imgID);
	}
	  str += "<li><a href='"+this.URL+"siteid="+this.SiteID+"&id="+AD.ADImage[i].imgID+"&url="+AD.ADImage[i].imgADLinkUrl+"' target='_blank'><img alt='"+AD.ADImage[i].imgADAlt+"' title='"+AD.ADImage[i].imgADAlt+"' src='"+this.UploadFilePath+AD.ADImage[i].ImgPath+"' ";
	  var sizeStr = "";
	  if(this.Width==0&&this.Height>0){
		  sizeStr = " height='"+this.Height+"' ";
	  }else if(this.Width>0&&this.Height==0){
		  sizeStr = " width='"+this.Width+"' ";
	  }else{
		  sizeStr = (this.Width < this.Height) ? " width='"+this.Width+"' " : " height='"+this.Height+"' ";
	  }
	  str += sizeStr;
	  str += " style='border:0px;'/></a></li>";
	}
  str += "</div>";
  document.write(str);
}
 
var cmsAD_{$pinfo[0]['id']} = new PCMSAD('cmsAD_{$pinfo[0]['id']}'); 
cmsAD_{$pinfo[0]['id']}.PosID = {$spaceid}; 
cmsAD_{$pinfo[0]['id']}.ADID = {$pinfo[0]['id']}; 
cmsAD_{$pinfo[0]['id']}.ADType = "{$pinfo[0]['type']}"; 
cmsAD_{$pinfo[0]['id']}.ADName = "{$pinfo[0]['name']}"; 
cmsAD_{$pinfo[0]['id']}.ADContent = "{'ADImage':[{loop $pinfo $p} {if $n!=1},{/if} {'imgID':'{$p['id']}','imgADLinkUrl':'{urlencode($p['setting'][1]['linkurl'])}','imgADAlt':'{$p['setting'][1]['alt']}','ImgPath':'{$p['setting'][1]['imageurl']}','imgADLinkTarget':'New','showAlt':'Y'} {/loop}]}"; 
cmsAD_{$pinfo[0]['id']}.URL = "{APP_PATH}poster/index/poster_click?";
cmsAD_{$pinfo[0]['id']}.SiteID = {$siteid}; 
cmsAD_{$pinfo[0]['id']}.Width = {$width}; 
cmsAD_{$pinfo[0]['id']}.Height = {$height}; 
cmsAD_{$pinfo[0]['id']}.UploadFilePath = ""; 
cmsAD_{$pinfo[0]['id']}.ShowAD();
