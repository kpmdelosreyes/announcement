<?php

/**
 *	Plugin Helper
 *	
 * 	Autor: Venstin John Q. Cenas
 * 	Website: http://simplexi.com/eng/
 * 	Since: Aug 02, 2011
 * 	Last Update: Oct 15, 2011
 *
 *	Functions
 *
 * 	getParams()
 * 	getParam($sKey)
 * 	getStringBetween($sString, $sStart, $sEnd)
 * 	downloadContent($sPath, $iTimeout)
 *	getCurrentUrl()
 *	readDir($sDirName, $sFilter = "") 
 *	searchPreviousDate($sMode)
 *	resizeImage("/images/image.jpg", 200, 200, "4:3", 100, true)
 *	createWatermarkedImage($sImage, $sWatermark, $sPath = null, $bEncrypt = false, $iXaxis = "left", $iYaxis = "top", $iXpadding = 30, $iYpadding = 30)
 *	redirect($sString)
 *	getUrlSegment($iNum, $iDefault = 5)
**/

class Helper
{
	/** This function gets all the parameters passed via JS AJAX to a php file **/
	
	public function getParams()
    {
        $aParam = array_merge($_REQUEST, $_FILES);
        return $aParam;
    }
	
	/** This function gets the action passed via JS AJAX to a php file **/
    
    public function getParam($sKey)
    {
        if( is_string($sKey) && trim($sKey) != '') {
            $aParam = $this->getParams();
            return (array_key_exists($sKey, $aParam)) ? $aParam[$sKey] : '';
        }
    }
	
	/** This function gets the character(s) between two strings / words **/
	
	public function getStringBetween($sString, $sStart, $sEnd)
	{
		$sString = " " . $sString;
		$sTemp = strpos($sString, $sStart);
		
		if ($sTemp == 0){
			return "";
		} 
		else {
			$sTemp += strlen($sStart);
			$sLength = strpos($sString, $sEnd, $sTemp) - $sTemp;
			return substr($sString, $sTemp, $sLength);
		}
	}
	
	/** This function gets content of a specific URL **/
	
	public function downloadContent($sPath, $iTimeout = 30)
	{
        $cUrl = curl_init();
		
        curl_setopt($cUrl, CURLOPT_URL, $sPath);
        curl_setopt($cUrl, CURLOPT_FAILONERROR, 1);
        curl_setopt($cUrl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cUrl, CURLOPT_TIMEOUT, $iTimeout);
		
        $retValue = curl_exec($cUrl);                      
        curl_close($cUrl);

        return $retValue;
	}
	
	/** This function gets content of a specific Folder **/
	
	public function readDir($sDirName, $sFilter = "") 
    {
    	$sFilter = trim($sFilter);
        $aResult = array();

        $oOpendir = @opendir( @$sDirName );
        while( $sFilelist = @readdir( $oOpendir ) ){

            if( preg_match("@^\.@", $sFilelist) !== 0 ) continue;
            
            $sPath = $sDirName.'/'.$sFilelist;
            if(filetype($sPath) == 'dir'){
               
                $aResult = array_merge($aResult, $this->readDir($sPath, $sFilter));
                
            }else if(filetype($sPath) == 'file'){
                
                if($sFilter && (preg_match($sFilter, $sFilelist) === 0) ){
                    continue;
                }
            
                $aResult[] = $sPath;
            }
        }
        @closedir( @$oOpendir );
        return $aResult;	
    }

	public function searchPreviousDate($sMode)
	{
		$iTime = time();
        return array(
            'sStartDate' => date('Y-m-d', strtotime($sMode)),
            'sEndDate' => date('Y-m-d', $iTime)
        );
	}
	
	public function getCurrentUrl()
	{
		$siteUrl = 'http';
		$siteUrl .= isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? 's': '';
		$siteUrl .= "://";
		$siteUrl .= $_SERVER["SERVER_PORT"] != "80" ? $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"] : $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$idx = strrpos($siteUrl, '?') ? strrpos($siteUrl, '?') : strlen($siteUrl);
        $url = substr($siteUrl, 0, $idx);
		return array (
			'base' => $url, 
			'current' => $siteUrl
		);
	}

	public function formatName($filename, $iLength = null)
    {
        $aFile = explode('/', $filename);
        $iCount = count($aFile);
        $sFile = $aFile[$iCount-1];
        $sSeparator = '...';
        $iTotalLength = strlen($sSeparator) ;
        $iMaxlength = (isset($iLength) ? $iLength : 25) - $iTotalLength;
        $iStart = $iMaxlength / 2;
        $iTrunc =  strlen($sFile) - $iMaxlength;

        return substr_replace($sFile, $sSeparator, $iStart, $iTrunc);
    }

	public function resizeImage($sImagePath, $iWidth, $iHeight, $sRatio, $iQuality = null, $bSharpen = false) // resizeImage("/images/image.jpg", 200, 200, "4:3", 100, true)
	{
		$sFileName = pathinfo($sImagePath,PATHINFO_FILENAME);
		$sFileExtension = strtolower(pathinfo($sImagePath, PATHINFO_EXTENSION));
	
		$aExtention = array("jpeg", "jpg", "png", "gif", "bmp");

		if (!in_array($sFileExtension, $aExtention)){
			unset($sImagePath);
			exit;
		}
		
		$aSize = GetImageSize($sImagePath);
		$sMime = $aSize['mime'];
		$iImageWidth = $aSize[0];
		$iImageHeight = $aSize[1];
		$iQuality = isset($iQuality) ? $iQuality : 100;
		$iNewHeight = $iHeight;
		$iNewWidth = $iWidth;
		
		$aImageData = $this->proccessMime($aSize['mime']);

		$oImageFunction	= $aImageData['oImageFunction'];
		$oOutputFunction = $aImageData['oOutputFunction'];
		$sMime = $aImageData['sMime'];
		$iQuality = $aImageData['iQuality'];
		
		$oImage = $oImageFunction($sImagePath);
		
		$iOffsetX = 0;
		$iOffsetY = 0;
		
		if (isset($sRatio)){
			$aRatio = explode(':', $sRatio);
			if (count($aRatio) == 2){
				$iRatio = $iImageWidth / $iImageHeight;
				$iCropRatio = (float) $aRatio[0] / (float) $aRatio[1];
				
				if ($iRatio < $iCropRatio){
					$iTempHeight = $iImageHeight;
					$iImageHeight = $iImageWidth / $iCropRatio;
					$iOffsetY = ($iTempHeight - $iImageHeight) / 2;
				}
				else if ($iRatio > $iCropRatio){
					$iTempWidth = $iImageWidth;
					$iImageWidth = $iImageHeight * $iCropRatio;
					$iOffsetX = ($iTempWidth - $iImageWidth) / 2;
				}
			}
		}

		$xRatio = $iNewWidth / $iImageWidth;
		$yRatio = $iNewHeight / $iImageHeight;

		if (($xRatio * $iImageHeight) < $iNewHeight){
			$iTargetHeight = ceil($xRatio * $iImageHeight);
			$iTargetWidth = $iNewWidth;
		}
		else {
			$iTargetWidth = ceil($yRatio * $iImageWidth);
			$iTargetHeight = $iNewHeight;
		}
		
		ini_set('memory_limit', '100M');
		
		$oNewImage = imagecreatetruecolor($iTargetWidth, $iTargetHeight);
		
		if (in_array($sMime, array('image/gif', 'image/png'))){
			imagealphablending($oNewImage, false);
			imagesavealpha($oNewImage, true);
		}
		
		imagecopyresized($oNewImage, $oImage, 0, 0, $iOffsetX, $iOffsetY, $iTargetWidth, $iTargetHeight, $iImageWidth, $iImageHeight);

		if ($bSharpen === true){
			$aSharpenMatrix = array (
				array(-1.2, -1, -1.2),
				array(-1, 20, -1),
				array(-1.2, -1, -1.2)
			);

			$iDivisor = array_sum(array_map('array_sum', $aSharpenMatrix));
			imageconvolution($oNewImage, $aSharpenMatrix, $iDivisor, 0); 
		}

		$oOutputFunction($oNewImage, $sImagePath, $iQuality);
		ImageDestroy($oImage);
		ImageDestroy($oNewImage);
	}
	
	public function createWatermarkedImage($sImage, $sWatermark, $sPath = null, $bEncrypt = false, $iXaxis = "left", $iYaxis = "top", $iXpadding = 30, $iYpadding = 30)
	{
		$sFileName = pathinfo($sImage, PATHINFO_FILENAME);
		$sFileExtension = strtolower(pathinfo($sImage, PATHINFO_EXTENSION));
		$sPath = isset($sPath) ? $sPath : str_replace($sFileName . "." . $sFileExtension, "", $sImage);
		$sNewPath = $sPath . ($bEncrypt === true ? sha1(md5(time() . $sFileName)) : str_shuffle($sFileName)) . "." . $sFileExtension;
		
		$aImageContent = GetImageSize($sImage);
		$aContent = GetImageSize($sWatermark);
		
		$aImageData = $this->proccessMime($aImageContent['mime']);
		$aWatermarkData = $this->proccessMime($aContent['mime']);

		$oWatermarkFunction = $aWatermarkData['oImageFunction'];
		$oImageFunction = $aImageData['oImageFunction'];
		$oOutputFunction = $aImageData['oOutputFunction'];
		
		$oImage = $oImageFunction($sImage);

		$oWaterMarkImage = $oWatermarkFunction($sWatermark);
                $iWatermarkWidth = imagesx($oWaterMarkImage);
                $iWatermarkHeight = imagesy($oWaterMarkImage);

                $iImageWidth = imagesx($oImage);
                $iImageHeight = imagesy($oImage);

                $iDifferenceX = $iImageWidth - $iWatermarkWidth;
                $iDifferenceY = $iImageHeight - $iWatermarkHeight;
		
		switch($iXaxis){
			case 'left':
				$iPlacementX = $iXpadding;
				break;
			case 'center':
				$iPlacementX =  round($iDifferenceX / 2);
				break;
			case 'right':
				$iPlacementX = $iImageWidth - $iWatermarkWidth - $iXpadding;
				break;
		}

		switch($iYaxis){
			case 'top':
				$iPlacementY = $iYpadding;
				break;
			case 'center':
				$iPlacementY =  round($iDifferenceY / 2);
				break;
			case 'bottom':
				$iPlacementY = $iImageHeight - $iWatermarkHeight - $iYpadding;
				break;
		}
		
		if (in_array($aContent['mime'], array('image/gif', 'image/png'))){
			imagealphablending($oWaterMarkImage, false);
			imagesavealpha($oWaterMarkImage, true);
		}
		
		imagecopy($oImage, $oWaterMarkImage, $iPlacementX, $iPlacementY, 0, 0, $iWatermarkWidth, $iWatermarkHeight);
		
		$oOutputFunction($oImage, $sNewPath, 100);
		imagedestroy($oImage);
		imagedestroy($oWaterMarkImage);
		
		return $sNewPath;
	}
	
	public function proccessMime($sMime, $iQuality = 100)
	{
		$aData = array();
		
		switch ($sMime){
			case 'image/png':
				$aData['oImageFunction'] = "imagecreatefrompng";
				$aData['oOutputFunction'] = "imagepng";
				$aData['sMime'] = "image/png";
				$aData['sExtension'] = "png";
				$aData['iQuality'] = round(10 - ($iQuality / 10));
			break;
			
			case 'image/gif':
				$aData['oImageFunction']	= "imagecreatefromgif";
				$aData['oOutputFunction'] = "imagegif";
				$aData['sMime'] = "image/gif";
				$aData['sExtension'] = "gif";
				$aData['iQuality'] = round(10 - ($iQuality / 10));
			break;

			default:
				$aData['oImageFunction']	= "imagecreatefromjpeg";
				$aData['oOutputFunction'] = "imagejpeg";
				$aData['sMime'] = "image/jpeg";
				$aData['sExtension'] = "jpeg";
				$aData['iQuality'] = $iQuality;
			break;
		}
		
		return $aData;
	}
	
	public function redirect($sString)
	{
		echo sprintf("<script>window.location.href='%s%s/%s/%s'</script>", SERVER_PLUGIN_URL, PLUGIN_NAME, PLUGIN_VERSION, $sString);
	}
	
	public function getUrlSegment($iNum, $iDefault = 5)
	{
		$iStart = $iNum + $iDefault;
		$aUri = explode("/", $_SERVER["REQUEST_URI"]);
		
		array_splice($aUri, 0, $iStart);
		
		$aUri = array_chunk($aUri, 2);
		$aNewUri = array();
		
		foreach ($aUri as $aKey){
			if (isset($aKey[0]) && $aKey[0] != "" && !strrpos($aKey[0], "?")) $aNewUri[$aKey[0]] = $aKey[1];
		}
		
		$aNewUri["getUri"] = strstr($_SERVER["REQUEST_URI"], "?");
		
		if ($aNewUri["getUri"] === false) unset($aNewUri["getUri"]);
		
		return $aNewUri;
	}
}