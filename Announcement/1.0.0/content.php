<?php

require($_SERVER['DOCUMENT_ROOT'] . '/lib/Common.php');
require(SERVER_PLUGIN_PATH . PLUGIN_NAME . DS . PLUGIN_VERSION . '/libs/helper.php');
require(SERVER_PLUGIN_PATH . PLUGIN_NAME . DS . PLUGIN_VERSION . '/model/base.php');
require(SERVER_PLUGIN_PATH . PLUGIN_NAME . DS . PLUGIN_VERSION . '/model/exec.php');
require(SERVER_PLUGIN_PATH . PLUGIN_NAME . DS . PLUGIN_VERSION . '/model/get.php');

class Content
{
	protected $oSmarty;
	protected $oBase;
	protected $oGet;
	protected $oExec;
	protected $oHelper;
	
	public function __construct()
	{
		$this->oSmarty = new Smarty();
		$this->oBase = new ModelBase();
		$this->oGet = new ModelGet();
		$this->oExec = new ModelExec();
		$this->oHelper = new Helper();
		$this->getAction();
	}
	
	private function initializeSmarty()
	{
		$this->oSmarty->assign('sScriptCrossDomain', CAFE24_CROSS_DOMAIN);
		$this->oSmarty->assign('sPgDir', PLUGIN_URL);
		$this->oSmarty->assign('sBaseUrl', SERVER_BASE_URL);
		$this->oSmarty->assign('sJQuery', SERVER_JQUERYJS_URL);
		$this->oSmarty->assign('sEmuRoot', SERVER_COMMONJS_URL);
		$this->oSmarty->assign('sTitle', "Announcement");
		$this->oSmarty->assign('sJsFile', "content.js");
		$this->oSmarty->assign('sTemplate', "common");
		$this->oSmarty->assign('sBackend', "content");
	}
	
	private function getAction()
	{
		$sAction = $this->oHelper->getParam('action');
		$sAction = $sAction != "" ? "exec" . ucwords($sAction) : "initializeData";
		$this->$sAction();
	}
	
	private function initializeData()
	{	
            $this->initializeSmarty();
            $sList = $this->getList();

            $sWeek = $this->oHelper->searchPreviousDate('-1 week');
            $sMonth = $this->oHelper->searchPreviousDate('-1 month');
            $sMonths = $this->oHelper->searchPreviousDate('-3 month');

            $sToday = date('Y-m-d');
            $sWeekDate = $sWeek['sStartDate'];
            $sMonthDate = $sMonth['sStartDate'];
            $s3MonthDate = $sMonths['sStartDate'];

            $this->oSmarty->assign('sToday', $sToday);
            $this->oSmarty->assign('sWeekDate', $sWeekDate);
            $this->oSmarty->assign('sMonthDate', $sMonthDate);
            $this->oSmarty->assign('s3MonthDate', $s3MonthDate);

            $this->oSmarty->assign("sList", $sList);

            $sHtmlTop = $this->oSmarty->fetch("header.tpl");
            $sHtmlBottom = $this->oSmarty->fetch("footer.tpl");
            $sHtmlContents = $this->oSmarty->fetch("content.tpl");

            $this->oSmarty->assign("template_top", $sHtmlTop, true);
            $this->oSmarty->assign("template_bottom", $sHtmlBottom, true);
            $this->oSmarty->assign("template_contents", $sHtmlContents, true);

            $this->oSmarty->display("index.tpl");
	}
	
	private function execGetlist()
	{
            $aParam = $this->oHelper->getParams();
            echo $this->getList($aParam['aData']);
	}
	
	private function getList($aParam = null)
	{
            $iPage = isset($aParam['page']) ? $aParam['page'] : 1;
            $iLimit = isset($aParam['limit']) ? $aParam['limit'] : 10;
            $iOffset = ($iPage - 1) * $iLimit;
            $sOrder = isset($aParam['orderby']) ? $aParam['orderby'] : "pad_idx";
            $sSort = isset($aParam['sortby']) ? strtoupper($aParam['sortby']) : "DESC"; 
            $sSearch = (isset($aParam['searchcontent']) && $aParam['searchcontent'] != "") ? " AND " . $aParam['search'] . " LIKE '%" . addslashes($aParam['searchcontent']) . "%'" : "";
            $sPeriod = (isset($aParam['startdate']) && $aParam['startdate'] != "") ? " AND DATE(pad_modified_date) BETWEEN '" . $aParam['startdate'] . "' AND '" . $aParam['enddate'] . "'" : "";
            $sWhere = $sPeriod . $sSearch . " ORDER BY ". $sOrder . " " . $sSort . " LIMIT " . $iOffset . ", " . $iLimit;
            $sCountWhere = $sPeriod . $sSearch . " ORDER BY ". $sOrder . " " . $sSort;

            $aData = $this->oGet->getData($sWhere);
            $iTotalRow = $this->oGet->getTotalRow($sCountWhere);
            $i = $iOffset + 1;

            foreach ($aData as $sKey => $sVal){
                    $aData[$sKey] = array(
                            'pad_idx' => $sVal['pad_idx'],
                            'pad_no' => $i++,
                            'pad_title' => $sVal['pad_title'],
                            'pad_datetime' => $sVal['pad_modified_date']
                    );
            }

            $sPagination = $this->createPager($iPage, $iLimit, $iTotalRow['count'], "PLUGIN_Announce_content.paginate");

            $this->oSmarty->assign('sSearchType', isset($aParam['search']) ? $aParam['search'] : "pad_title");
            $this->oSmarty->assign('sSearchText', isset($aParam['searchcontent']) ? $aParam['searchcontent'] : "");
            $this->oSmarty->assign("sStartDate", isset($aParam['startdate']) ? $aParam['startdate'] : "");
            $this->oSmarty->assign("sEndDate", isset($aParam['enddate']) ? $aParam['enddate'] : "");
            $this->oSmarty->assign("sOrderby", $sOrder);
            $this->oSmarty->assign("sSortby", $sSort);
            $this->oSmarty->assign("iTotalRow", $iTotalRow['count']);
            $this->oSmarty->assign("sPagination", $sPagination);
            $this->oSmarty->assign("iLimit", $iLimit);
            $this->oSmarty->assign("aData", $aData);

            return $sList = $this->oSmarty->fetch("list.tpl");
	}
	
	public function createPager($iPage, $iItemsPerPage, $iTotalItem, $sJavascript, $aParam = null, $iInterval = 2)
	{
            $sParam = "";

            if (is_array($aParam) && $aParam != null) {
                    foreach ($aParam as $i => $value) {
                            $aParam[$i] = "'" . addslashes($value) . "'";
                    }
                    $sParam = "," . implode(",", $aParam);
            }
            else if ($aParam != ""){
                    $sParam = "," . $aParam;
            }

            $sPrev = ($iPage - 1) > 0 ? '<a href="javascript:void(0);" class="activity" onclick="' . $sJavascript . '(' . ($iPage - 1) . $sParam . ');">prev</a>' : "<span>prev</span>";
            $sNavigation = '<ul><li>' . $sPrev . '</li>';
            $iOptionlength = ceil($iTotalItem / $iItemsPerPage);  

            if ($iOptionlength == 0) $iOptionlength = 1;

            if ($iPage > $iOptionlength){
                    $iPage = $iOptionlength;
            }

            for ($iLink = 1; $iLink <= $iOptionlength; $iLink++){
                    if ($iLink == 2 && $iPage >= ($iInterval + 3)){
                            $sNavigation .= '<li><a href="javascript:void(0);" class="num" onclick="' . $sJavascript . '(1' . $sParam . ');">1</a></li><li>&hellip;</li>';
                    }
                    else if($iLink == 1 && $iPage == ($iInterval + 2)){
                            $sNavigation .= '<li><a href="javascript:void(0);" class="num" onclick="' . $sJavascript . '(1' . $sParam . ');">1</a></li>';
                    }
                    if ($iLink == $iPage){
                            $sNavigation .= '<li><strong class="current">' .$iPage. '</strong></li>';
                    }
                    else if ($iLink >= ($iPage - $iInterval)){
                            if ($iLink == 1){
                                    $sNavigation .= '<li><a href="javascript:void(0);" class="num" onclick="' . $sJavascript . '(' . $iLink . $sParam . ');">' . $iLink . '</a></li>';
                            }
                            else {
                                    $sNavigation .= '<li><a href="javascript:void(0);" class="num" onclick="' . $sJavascript . '(' . $iLink . $sParam . ');">' . $iLink . '</a></li>';
                            }	
                    }
                    if ($iLink >= ($iPage + $iInterval) && ($iOptionlength - ($iInterval + 2)) >= $iPage){
                            $sNavigation .= '<li>&hellip;</li><li><a href="javascript:void(0);" class="num" onclick="' . $sJavascript . '(' . $iOptionlength . $sParam . ');">' . $iOptionlength . '</a></li>';
                            break;
                    }	
            }

            $sNext = $iPage != $iOptionlength ? '<a href="javascript:void(0);" class="activity" onclick="' . $sJavascript . '(' . ($iPage + 1) . $sParam . ');">next</a>' : "<span>next</span>";
            $sNavigation .= '<li>' . $sNext . '</li></ul>';

            return $sNavigation;
	}
	
	private function execGetnote()
	{
            $aParam = $this->oHelper->getParams();
            $aResult = $this->oGet->getNoteInfo($aParam['aData']['idx']);
            echo json_encode($aResult);
	}
	
	private function execModifydata()
	{
            $aParam = $this->oHelper->getParams();

            $aData = array(
                    "pad_title" => $aParam['aData']['pad_title'],
                    "pad_content" => $aParam['aData']['pad_content']
                   // "pad_modified_date" => $aParam['aData']['pad_modified_date']            
            );

            echo $this->oExec->updateNote($aData, "pad_idx = " . $aParam['aData']['pad_idx']);
	}
	
	private function execSavedata()
	{
            $aParam = $this->oHelper->getParams();
            $aParam['aData']['pad_pm_idx'] = $this->oBase->getUserId();
            echo $this->oExec->createNote($aParam['aData']);
	}
	
	private function execDeletenote()
	{
            $aParam = $this->oHelper->getParams();

            foreach ($aParam['aData']['idxArray'] as $sVal){
                    $this->oExec->deleteNote("pad_idx = " . $sVal);
            }
	}
}

$content = new Content();

/* End of file content.php */