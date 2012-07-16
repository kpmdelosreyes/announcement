<?php
require($_SERVER['DOCUMENT_ROOT'] . '/lib/Common.php');

class Content
{
    protected $smarty;
    protected $con;
    protected $sPgDir;
    protected $PG_ANNOUNCEMENT_MAIN = null;
    protected $PG_ANNOUNCEMENT_DATA = null;
    protected $PG_ANNOUNCEMENT_SETTING = null;
    
   

    public function __construct() {
        
        $this->smarty = new Smarty;
        $this->con = new utilDb();
        $this->PG_ANNOUNCEMENT_MAIN = 'PG_Announcement_main';
        $this->PG_ANNOUNCEMENT_SETTING = 'PG_Announcement_setting';
        $this->PG_ANNOUNCEMENT_DATA = 'PG_Announcement_data'; 
        $this->smarty->assign('sScriptCrossDomain', CAFE24_CROSS_DOMAIN);
        $this->sPgDir = SERVER_PLUGIN_URL . PLUGIN_NAME . DS. PLUGIN_VERSION;
        $this->_init();
    }
    
    private function _init()
    {
        $this->_setPluginDefault();
        $this->requestHandler();
           
    }
    
     /*request handler from ajax*/
    public function requestHandler()
    {

        switch(@$_POST['requestType'])
        {
            case'saveData':  
                  $this->saveData();
            break;
            
            case'modifyData':  
                  $this->modifyData();
            break;
            
            case'modifiedData':  
                  $this->modifiedData();
            break;
            
            case'deletepost':  
                  $this->deletepost();
            break;
        
            case'viewData';
                $this->viewData();
            break;
            
            case'getlist';
                $this->getList();
            break;
        
            default:
                $this->_smartyconf();
            break;
        }

    }

    private function _setPluginDefault()
    {
        $this->smarty->assign("sPgDir",PLUGIN_URL,true);
        $this->smarty->assign("sPgLib", SERVER_BASE_URL."lib/");
        $this->smarty->assign("jquery", SERVER_JQUERYJS_URL, true);
        $this->smarty->assign("emulation", SERVER_COMMONJS_URL, true);
        $this->smarty->assign("jqueryuijs", SERVER_JQUERYUIJS_URL, true);
        $this->smarty->assign("jqueryuicss", SERVER_JQUERYUICSS_URL, true);
        $this->smarty->assign("sJsValidate", true); 
        $this->smarty->assign("sPopUp", SERVER_BASE_URL . 'lib/js/popup.js');
    }
    
    public function searchPreviousDate($sMode)
    {
        $iTime = time();
        return array(
            'sStartDate' => date('Y-m-d', strtotime($sMode)),
            'sEndDate' => date('Y-m-d', $iTime)
        );
    }
    
    
    public function _smartyconf()
    {
        $sList = $this->getList();
        
        $sWeek = $this->searchPreviousDate('-1 week');
        $sMonth = $this->searchPreviousDate('-1 month');
        $sMonths = $this->searchPreviousDate('-3 month');

        $sToday = date('Y-m-d');
        $sWeekDate = $sWeek['sStartDate'];
        $sMonthDate = $sMonth['sStartDate'];
        $s3MonthDate = $sMonths['sStartDate'];

        $this->smarty->assign('sToday', $sToday);
        $this->smarty->assign('sWeekDate', $sWeekDate);
        $this->smarty->assign('sMonthDate', $sMonthDate);
        $this->smarty->assign('s3MonthDate', $s3MonthDate);
       
        $this->smarty->assign("sList", $sList);
        
        $sHtmlTop = $this->smarty->fetch("header.tpl");
        $sHtmlBottom = $this->smarty->fetch("footer.tpl");
        $sHtmlContents = $this->smarty->fetch("content.tpl");

        $this->smarty->assign("template_top", $sHtmlTop,true);
        $this->smarty->assign("template_bottom", $sHtmlBottom,true);
        $this->smarty->assign("template_contents", $sHtmlContents,true);

        $this->smarty->display('main.tpl');
    }
    
    public function getUserIdx()
    {
        
        $sql = "SELECT pm_idx , pm_userid FROM ".$this->PG_ANNOUNCEMENT_MAIN." WHERE pm_userid = '".PLUGIN_USER_ID."'";
        $result =  $this->con->query($sql, 'row');

        return $result['pm_idx'];
    }
       
    public function getData($sWhere = "")
    {
        $sql = "SELECT * FROM ".$this->PG_ANNOUNCEMENT_DATA."  WHERE pad_pm_idx = '".$this->getUserIdx()."' " .$sWhere ;
        return $this->con->query($sql);
      
    }
    
    public function saveData()
    {
        $title = str_replace(':)', '<img src="images/fest20.gif" />', $_POST['title']);
        $content = str_replace(':)', '<img src="images/fest20.gif" />', $_POST['content']);
        $sql = "INSERT INTO ".$this->PG_ANNOUNCEMENT_DATA." ( pad_pm_idx, pad_title, pad_content, pad_modified_date) VALUES (" .$this->getUserIdx() . ",'".$title."','" .$content."', NOW())";
        return $this->con->query($sql);
        
         
    }
    
    public function viewData()
    {
       
        $sql = "SELECT pad_idx, pad_title, pad_content FROM ".$this->PG_ANNOUNCEMENT_DATA."  WHERE pad_idx = '".$_POST['hiddenid']."' ";
        $result = $this->con->query($sql, 'rows');
        
        $aData = array();
            foreach($result as $key => $value)
            {
                $aData[] = array(
                                "id" => $value['pad_idx'],
                                "title" => $value['pad_title'],
                                "content" => $value['pad_content']
                                 );

            }
          
        $this->smarty->assign('view', $aData);
        $this->smarty->display("view.tpl"); 
        
    }
    
    public function modifyData()
    {
      
        $sql = "SELECT pad_idx, pad_title, pad_content FROM ".$this->PG_ANNOUNCEMENT_DATA."  WHERE pad_idx = '".$_POST['hiddenid']."' ";
        $result = $this->con->query($sql, 'rows');
        
        $aData = array();
            foreach($result as $key => $value)
            {
                $aData[] = array(
                                "id" => $value['pad_idx'],
                                "title" => $value['pad_title'],
                                "content" => $value['pad_content']
                                 );

            }
            
        $this->smarty->assign('modify', $aData);
        $this->smarty->display("modify.tpl"); 
      
        
    }
    
    public function modifiedData()
    {
        $title = str_replace(':)', '<img src="images/fest20.gif" />', $_POST['title']);
        $content = str_replace(':)', '<img src="images/fest20.gif" />', $_POST['content']);
        $sql = "UPDATE ".$this->PG_ANNOUNCEMENT_DATA." SET pad_pm_idx = " .$this->getUserIdx() . ",pad_title = '" .$title."',pad_content = '" .$content. "', pad_modified_date = NOW() WHERE pad_idx = '".$_POST['hiddenid']."'";
        $resultUpdate = $this->con->query($sql);
        
        if($resultUpdate)
        {
            $sql = "SELECT * FROM ".$this->PG_ANNOUNCEMENT_DATA."  WHERE pad_pm_idx = '".$this->getUserIdx()."' ORDER BY pad_idx DESC ";
            $result = $this->con->query($sql, 'rows');

            $aData = array();
            foreach($result as $key => $value)
            {
                   $aData[] = array(
                                    "id" => $value['pad_idx'],
                                    "title" => $value['pad_title'],
                                    "content" => $value['pad_content'],
                                    "date" => $value['pad_modified_date']
                              );

            }

            $this->smarty->assign('data', $aData);
            $this->smarty->display("contents.tpl");    
            
        }
        else
        {
            
            echo "failed";
        }
        
    }
    
    public function getParams()
    {
        $aParam = array_merge($_REQUEST, $_FILES);
        return $aParam;
    }
    
    public function deleteThis($sWhere)
    {
        $sql = "DELETE FROM " . $this->PG_ANNOUNCEMENT_DATA . " WHERE " . $sWhere;	
        return $this->con->query($sql);
    }
    
    public function deletepost()
    {
        $aParam = $this->getParams();
     
        foreach($aParam['aData']['hiddenid'] as $sVal)
        {
            $this->deleteThis("pad_idx = " . $sVal);      
        }
      
    }
    
    public function getTotalRow($sWhere)
    {
        $sql = "SELECT COUNT(*) as count FROM " . $this->PG_ANNOUNCEMENT_DATA . " WHERE pad_pm_idx = " . $this->getUserIdx() . $sWhere;
        return $this->con->query($sql, "row");
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

        $data = $this->getData($sWhere);
        $iTotalRow = $this->getTotalRow($sCountWhere);
        $i = $iOffset + 1;
        
        $aData = array();
        foreach ($data as $sKey => $sVal){
                $aData[] = array(
                        'id' => $sVal['pad_idx'],
                        'pad_no' => $i++,
                        'title' => $sVal['pad_title'],
                        'content' => $sVal['pad_content'],
                        'date' => $sVal['pad_modified_date']
                );
        }

        $sPagination = $this->createPager($iPage, $iLimit, $iTotalRow['count'], "paginate");

        $this->smarty->assign('sSearchType', isset($aParam['search']) ? $aParam['search'] : "pad_title");
        $this->smarty->assign('sSearchText', isset($aParam['searchcontent']) ? $aParam['searchcontent'] : "");
        $this->smarty->assign("sStartDate", isset($aParam['startdate']) ? $aParam['startdate'] : "");
        $this->smarty->assign("sEndDate", isset($aParam['enddate']) ? $aParam['enddate'] : "");
        $this->smarty->assign("sOrderby", $sOrder);
        $this->smarty->assign("sSortby", $sSort);
        $this->smarty->assign("iTotalRow", $iTotalRow['count']);
        $this->smarty->assign("pagination", $sPagination);
        $this->smarty->assign("iLimit", $iLimit);
        $this->smarty->assign("aData", $aData);
        
        return $sList = $this->smarty->fetch("contents.tpl");
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

            $sPrev = ($iPage - 1) > 0 ? '<a href="#" class="activity" onclick="' . $sJavascript . '(' . ($iPage - 1) . $sParam . ');">prev</a>' : "<span>prev</span>";
            $sNavigation = '<ul><li>' . $sPrev . '</li>';
            $iOptionlength = ceil($iTotalItem / $iItemsPerPage);  

            if ($iOptionlength == 0) $iOptionlength = 1;

            if ($iPage > $iOptionlength){
                    $iPage = $iOptionlength;
            }

            for ($iLink = 1; $iLink <= $iOptionlength; $iLink++){
                    if ($iLink == 2 && $iPage >= ($iInterval + 3)){
                            $sNavigation .= '<li><a href="#" class="num" onclick="' . $sJavascript . '(1' . $sParam . ');">1</a></li><li>&hellip;</li>';
                    }
                    else if($iLink == 1 && $iPage == ($iInterval + 2)){
                            $sNavigation .= '<li><a href="#" class="num" onclick="' . $sJavascript . '(1' . $sParam . ');">1</a></li>';
                    }
                    if ($iLink == $iPage){
                            $sNavigation .= '<li><strong class="current">' .$iPage. '</strong></li>';
                    }
                    else if ($iLink >= ($iPage - $iInterval)){
                            if ($iLink == 1){
                                    $sNavigation .= '<li><a href="#" class="num" onclick="' . $sJavascript . '(' . $iLink . $sParam . ');">' . $iLink . '</a></li>';
                            }
                            else {
                                    $sNavigation .= '<li><a href="#" class="num" onclick="' . $sJavascript . '(' . $iLink . $sParam . ');">' . $iLink . '</a></li>';
                            }	
                    }
                    if ($iLink >= ($iPage + $iInterval) && ($iOptionlength - ($iInterval + 2)) >= $iPage){
                            $sNavigation .= '<li>&hellip;</li><li><a href="#" class="num" onclick="' . $sJavascript . '(' . $iOptionlength . $sParam . ');">' . $iOptionlength . '</a></li>';
                            break;
                    }	
            }

            $sNext = $iPage != $iOptionlength ? '<a href="#" class="activity" onclick="' . $sJavascript . '(' . ($iPage + 1) . $sParam . ');">next</a>' : "<span>next</span>";
            $sNavigation .= '<li>' . $sNext . '</li></ul>';

            return $sNavigation;
    }
    
    

    

}

$content = new Content();