<?php
require($_SERVER['DOCUMENT_ROOT'] . '/lib/Common.php');

class Index
{
    protected $smarty;
    protected $con;
    protected $sPgDir;
   

    public function __construct() {
        
        $this->smarty = new Smarty;
        $this->con = new utilDb();

        $this->sPgDir = SERVER_PLUGIN_URL . PLUGIN_NAME . DS. PLUGIN_VERSION;
        $this->_init();
    }
    
    private function _init()
    {
       /* $this->getData();
        $this->getData2();
        $this->getData3();*/
        $this->_setPluginDefault();
        $this->_smartyconf();
        
    }
    
    private function _setPluginDefault()
    {
        $this->smarty->assign("sPgDir",PLUGIN_URL,true);
        $this->smarty->assign("sPgLib", SERVER_BASE_URL."lib/");
        $this->smarty->assign("jquery", SERVER_JQUERYJS_URL, true);
        $this->smarty->assign("emulation", SERVER_COMMONJS_URL, true);
        $this->smarty->assign("jqueryuijs", SERVER_JQUERYUIJS_URL, true);
        $this->smarty->assign("jqueryuicss", SERVER_JQUERYUICSS_URL, true);
    }
    public function _smartyconf()
    {
        
        $sHtmlTop = $this->smarty->fetch("header.tpl");
        $sHtmlBottom = $this->smarty->fetch("footer.tpl");
        $sHtmlContents = $this->smarty->fetch("body.tpl");

        $this->smarty->assign("template_top", $sHtmlTop,true);
        $this->smarty->assign("template_bottom", $sHtmlBottom,true);
        $this->smarty->assign("template_contents", $sHtmlContents,true);

        $this->smarty->display('main.tpl');
    }
    
   /* public function getUserIdx()
    {
        
        $sql = "SELECT pm_idx , pm_userid FROM ".$this->PG_BINGMAPS_MAIN." WHERE pm_userid = '".PLUGIN_USER_ID."'";
        $result =  $this->con->query($sql, 'row');

        return $result['pm_idx'];
    }
    
    public function getData()
    {
        $sql = "SELECT * FROM ".$this->PG_BINGMAPS_SETTING."  WHERE pbm_pm_idx = '".$this->getUserIdx()."'";
        $result = $this->con->query($sql, 'rows');
        
        $aData = array();
            foreach($result as $key => $value)
            {
                   $aData[] = array(
                                    "credential" => $value['pbm_key'],
                                    "center_point" => $value['pbm_center_point'],
                                    
                                    "map_location" => $value['pbm_address'],
                                    "map_size" => $value['pbm_size'],
                                    "height" => $value['pbm_height'],
                                    "width" => $value['pbm_width'],
                                    "map_zoom" => $value['pbm_zoom'],
                                    "map_view" => $value['pbm_map_view'],
                                    "map_dashboard" => $value['pbm_dashboard']
                              );

            }
        
         $this->smarty->assign('map_info', $aData);
         
    }
    
    public function getData2()
    {
        $sql = "SELECT * FROM ".$this->PG_BINGMAPS_DATA."  WHERE pbm_pm_idx = '".$this->getUserIdx()."'";
        $result = $this->con->query($sql, 'rows');
        
        $aData = array();
            foreach($result as $key => $value)
            {
                   $aData[] = array(
                                    
                                    
                                    "map_type" => $value['pbm_map_type'],
                                    "map_dyn_title" => $value['pbm_dyn_title'],
                                    "map_dyn_desc" => $value['pbm_dyn_desc']
                                
                              );

            }
        
         $this->smarty->assign('map_info2', $aData);
    }
    
     public function getData3()
    {
        $sql = "SELECT pbm_title, pbm_size FROM ".$this->PG_BINGMAPS_SETTING."  WHERE pbm_pm_idx = '".$this->getUserIdx()."'";
        $result = $this->con->query($sql, 'row');
		
        $size = explode("x", $result['pbm_size']);
	  
				
        $this->smarty->assign('bing_title', $result['pbm_title']);
        $this->smarty->assign('width', $size[0]);
        $this->smarty->assign('height', $size[1]);

         
    }
   */

}

$index = new Index();