<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_icon{
	
	public $editSvg;
	public $deleteSvg;
	public $plusSvg;
	
	
	
	function __Construct(){
		$this->campLimit =10;
		
		$this->editSvg='<svg xmlns="http://www.w3.org/2000/svg" width="10" height="11"><image xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAALCAMAAABxsOwqAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAWlBMVEUAAAD+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v4AAABcJVArAAAAHHRSTlMADbV4iH0LmBu40wrBzhycH6/A4CC/Ib7h4iIP7GTb7gAAAAFiS0dEAIgFHUgAAAAJcEhZcwAACxIAAAsSAdLdfvwAAABGSURBVAjXNchHEoBADANBkTNLDov+/05sY+bUNYCVpBm8nCwMZVU3bFVdz2EM0ydytreI1k21qw6dp+gyQXRHOH8hxsf1AvBCBIRrXmsVAAAAAElFTkSuQmCC" width="10" height="11"/></svg>';
		$this->deleteSvg='<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"><image xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAMAAAC67D+PAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAVFBMVEUAAAD+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v7+/v4AAACcnZzrAAAAGnRSTlMAK2gGNWIBtK5D9TBCsANGwLGtw/Y/LWs4ZUze4dkAAAABYktHRACIBR1IAAAACXBIWXMAAAsSAAALEgHS3X78AAAATElEQVQI1y3M2xZAMAxE0SEUqRZ1z/9/qJHVPO2HM0HTCnhdHzDYSE9qEbPSVMrAoraqbZ7RVX9nRar2w31yIWxK5rMk3kdct2fPGz7QagQqTyaecwAAAABJRU5ErkJggg==" width="10" height="10"/></svg>';
		$this->plusSvg='<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"><image xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABDlBMVEUAAAD///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8AAAAvYQfQAAAAWHRSTlMABxExo+bysk8BBpf91XxRTXPAuxQDuV8CPN/ZFYn1OBkh+3JmjEBQe+y08MG9fe76/osMgUW662hUCK1/6Wzz06YTj2JeOjebkRBw92fvsH6ijQVttb8jUA/4hQAAAAFiS0dEAIgFHUgAAAAJcEhZcwAACxIAAAsSAdLdfvwAAADQSURBVBjTTU9nV8JAEBxaKBICHBAhECH0UGJUqgIqTend+/+/RO4g72U/zM7s7rw3C9zK4YS9XG4PpYLX57/rwENQDEnhSJSSGB/EE4L8yFkypaRZz6hPljubIldjTsszUSgyLNEyUKk6GNdr/KquAw03bJO8AChNQK4az6ZhvAASfYX4BrTapKMR0gV6tA/93e76GADDEc+vGwz9n1/AtzBmvDVhOKUzlsSUrYRz9Yf3sfm74P8tV4nAbbXeqNtdZd/RDkfr2nk6i8ql+cfFP7agFrO1kZohAAAAAElFTkSuQmCC" width="17" height="17"/></svg>';
		
		

	}
}	# end class 
 
?>