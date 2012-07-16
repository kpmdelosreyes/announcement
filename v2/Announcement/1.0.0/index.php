<?php
require($_SERVER['DOCUMENT_ROOT'] . '/lib/Common.php');
require(SERVER_PLUGIN_PATH . PLUGIN_NAME . DS . PLUGIN_VERSION . '/libs/helper.php');
require(SERVER_PLUGIN_PATH . PLUGIN_NAME . DS . PLUGIN_VERSION . '/model/base.php');
require(SERVER_PLUGIN_PATH . PLUGIN_NAME . DS . PLUGIN_VERSION . '/model/exec.php');
require(SERVER_PLUGIN_PATH . PLUGIN_NAME . DS . PLUGIN_VERSION . '/model/get.php');
class Index
{
    protected $smarty;
    protected $con;
    protected $sPgDir;
    protected $PG_ANNOUNCEMENT_MAIN = null;
    protected $PG_ANNOUNCEMENT_SETTING = null;
   

    public function __construct() {
        $this->oHelper = new Helper();
        $this->oBase = new ModelBase();
        $this->oGet = new ModelGet();
        $this->oExec = new ModelExec();
        $this->smarty = new Smarty;
        $this->con = new utilDb();
        $this->PG_ANNOUNCEMENT_MAIN = 'PG_Announcement_main';
        $this->PG_ANNOUNCEMENT_SETTING = 'PG_Announcement_setting';
        $this->PG_ANNOUNCEMENT_DATA = 'PG_Announcement_data';
        $this->sPgDir = SERVER_PLUGIN_URL . PLUGIN_NAME . DS. PLUGIN_VERSION;
        
        $this->_init();
        $this->getAction();
    }
    
    private function _init()
    {
       // $this->getData();
        $this->latest();
        $this->getData2();
        $this->_setPluginDefault();
       
  
    }
    
   	private function getAction()
	{
            $sAction = $this->oHelper->getParam("action");
            $sAction = $sAction != "" ? "exec" . ucwords($sAction) : "_smartyconf";
            $this->$sAction();
	}
    
    private function _setPluginDefault()
    {
        $this->smarty->assign('sScriptCrossDomain', CAFE24_CROSS_DOMAIN);
        $this->smarty->assign("sPgDir",PLUGIN_URL,true);
        $this->smarty->assign("sPgLib", SERVER_BASE_URL."lib/");
        $this->smarty->assign("jquery", SERVER_JQUERYJS_URL, true);
        $this->smarty->assign("emulation", SERVER_COMMONJS_URL, true);
        $this->smarty->assign("jqueryuijs", SERVER_JQUERYUIJS_URL, true);
        $this->smarty->assign("jqueryuicss", SERVER_JQUERYUICSS_URL, true);
        $this->smarty->assign("server_url", $this->sPgDir);
    }
    public function _smartyconf()
    {
        
        $sHtmlTop = $this->smarty->fetch("header.tpl");
        $sHtmlBottom = $this->smarty->fetch("footer.tpl");
        $sHtmlContents = $this->smarty->fetch("body.tpl");

        $this->smarty->assign("template_top", $sHtmlTop,true);
        $this->smarty->assign("template_bottom", $sHtmlBottom,true);
        $this->smarty->assign("template_contents", $sHtmlContents,true);

        $this->smarty->display('index.tpl');
    }
    
    public function getUserIdx()
    {
        
        $sql = "SELECT pm_idx , pm_userid FROM ".$this->PG_ANNOUNCEMENT_MAIN." WHERE pm_userid = '".PLUGIN_USER_ID."'";
        $result =  $this->con->query($sql, 'row');

        return $result['pm_idx'];
    }
    
    public function latest()
    {
        $sql = "SELECT pad_idx, pad_title,pad_content,pad_modified_date FROM ".$this->PG_ANNOUNCEMENT_DATA." WHERE pad_pm_idx = ".$this->getUserIdx()." ORDER BY pad_modified_date DESC LIMIT ".$this->getData3()." ";
         $result = $this->con->query($sql, 'rows');
     
         $aData = array();
            foreach($result as $value)
            {
                   $aData[] = array(
                                    "id" => $value['pad_idx'],
                                    "title" => $value['pad_title'],
                                    "content" => $value['pad_content'],
                                    "date" => $value['pad_modified_date']
                              );

            }
        
       $this->smarty->assign('latest', $aData);
        
    }

    public function execGetcontent()
    {
        
        $aParams = $this->oHelper->getParams();
     
        $aResult = $this->oGet->getNoteInfo($aParams['idx']);
       			
        echo json_encode($aResult);
    
    }
    
    
    public function execShowComments()
    {
        $aParams = $this->oHelper->getParams();
        $aTotalRow = $this->con->query("SELECT COUNT(*) as iCount FROM ".$this->PG_ANNOUNCEMENT_DATA." WHERE pad_pm_idx  = ".$this->getUserIdx(), 'row');

        $sql = "SELECT pad_idx, pad_title,pad_content,pad_modified_date FROM ".$this->PG_ANNOUNCEMENT_DATA." WHERE pad_pm_idx = ".$this->getUserIdx()." ORDER BY pad_modified_date DESC LIMIT 1 ";
        $result = $this->con->query($sql, 'rows');

        $aData = array();
        foreach($result as $value)
        {
               $aData['aData'][] = array(
                                "id" => $value['pad_idx'],
                                "title" => $value['pad_title'],
                                "content" => $value['pad_content'],
                                "date" => $value['pad_modified_date']

                          );

        }

        $aData['rows'] = $aTotalRow['iCount'];

        echo json_encode($aData);
    }
    
    
    public function getData3()
    {
       $sql = "SELECT pas_num_display FROM ".$this->PG_ANNOUNCEMENT_SETTING."  WHERE pas_pm_idx = ".$this->getUserIdx()."  ";
       $result = $this->con->query($sql, 'row');
       
       return $result['pas_num_display'];
       
    }
    
    public function getData2()
    {
       $sql = "SELECT pas_template, pas_time FROM ".$this->PG_ANNOUNCEMENT_SETTING."  WHERE pas_pm_idx = ".$this->getUserIdx()."  ";
       $result = $this->con->query($sql, 'row');
       
       $this->smarty->assign('template', $result['pas_template']);
       $this->smarty->assign('setInterval', $result['pas_time']);
    }

}

$index = new Index();