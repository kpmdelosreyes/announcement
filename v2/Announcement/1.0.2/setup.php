<?php

require($_SERVER['DOCUMENT_ROOT'] . '/lib/Common.php');

class Setup
{
    private $PG_NAME = PLUGIN_NAME;
    private $PG_URL= PLUGIN_URL;
   // protected $PG_BINGMAPS_MAIN = null;
   // protected $PG_BINGMAPS_SETTING = null;
    protected $smarty;
    protected $con;

    
    public function __construct()
    {
        $this->smarty = new Smarty();
        $this->con = new utilDb();
       /* $this->PG_BINGMAPS_MAIN = 'PG_Bingmaps_main';
        $this->PG_BINGMAPS_SETTING = 'PG_Bingmaps_setting';
        $this->PG_BINGMAPS_DATA = 'PG_Bingmaps_data'; */
        $this->smarty->assign('sScriptCrossDomain', CAFE24_CROSS_DOMAIN);
        $this->init();
        
    }
    
    public function init()
    {
        $this->_setPluginDefault();
      //  $this->requestHandler();
        
    }
    
	
    /*request handler from ajax*/
   /* public function requestHandler()
    {

        switch(@$_POST['requestType'])
        {
            case'saveData':  
                  $this->saveData();
            break;
        
            case'saveThis':  
                  $this->saveThis();
            break;
        
            default:
                $this->_setSmartyConfig();
            break;
        }

    }
    

    private function _setSmartyConfig()
    {
        
    }*/

    private function _setPluginDefault()
    {
        $this->smarty->assign("sPgDir",PLUGIN_URL,true);
        $this->smarty->assign("sPgPath", PLUGIN_PATH);
        $this->smarty->assign("PLUGIN_NAME", $this->PG_NAME);
        $this->smarty->assign("PG_URL", $this->PG_URL);
        $this->smarty->assign("sPgLib", SERVER_BASE_URL."lib/");
        $this->smarty->assign("sCommonRoot", SERVER_BASE_URL . 'lib/js/common.js');
        $this->smarty->assign("sPopUp", SERVER_BASE_URL . 'lib/js/popup.js');
        $this->smarty->assign("jquery", SERVER_JQUERYJS_URL, true);
        $this->smarty->assign("emulation", SERVER_COMMONJS_URL, true);
        $this->smarty->assign("jqueryuijs", SERVER_JQUERYUIJS_URL, true);
        $this->smarty->assign("jqueryuicss", SERVER_JQUERYUICSS_URL, true);
        $this->smarty->assign("sJsValidate", true); 

        $this->smarty->display('setup.tpl');
    }
    /*
    public function getUserIdx()
    {
        
        $sql = "SELECT pm_idx , pm_userid FROM ".$this->PG_BINGMAPS_MAIN." WHERE pm_userid = '".PLUGIN_USER_ID."'";
        $result =  $this->con->query($sql, 'row');

        return $result['pm_idx'];
    }
    */
    /*save set user settings*/
  /*  public function saveData()
    {	
        
       
        $sql = "SELECT pbm_pm_idx FROM ".$this->PG_BINGMAPS_SETTING." WHERE pbm_pm_idx = '".$this->getUserIdx()."'";
        $result = $this->con->query($sql, 'rows');
        
            if(!$result)
            {
                
                $sql = "INSERT INTO ".$this->PG_BINGMAPS_SETTING." ( pbm_pm_idx,
                                                                pbm_center_point,
                                                                pbm_key,
                                                                pbm_title,
                                                                pbm_address,
                                                                pbm_size,
                                                                pbm_height,
                                                                pbm_width,
                                                                pbm_zoom,
																pbm_map_type,
                                                                pbm_map_view,
                                                                pbm_dashboard)
                    VALUES (" .$this->getUserIdx() . ",'" . $_POST['searchResult'] . "','" . $_POST['map_key'] . "','" . $_POST['map_title'] . "','" . $_POST['map_loc'] . "','" . $_POST['map_size'] . "'," . $_POST['height'] . "," . $_POST['width'] . "," . $_POST['map_zoom'] . ",'" . $_POST['map_type'] . "','" . $_POST['map_view'] . "', '" . $_POST['map_dashboard'] . "')";

                  $resultInsert = $this->con->query($sql);
            }
            else
            {
                $sql = "UPDATE ".$this->PG_BINGMAPS_SETTING." SET pbm_pm_idx = " .$this->getUserIdx() . ",
                                                                pbm_center_point = '" . $_POST['searchResult'] . "',
                                                                pbm_key = '" . $_POST['map_key'] . "',
                                                                pbm_title = '" . $_POST['map_title']."',
                                                                pbm_address = '" . $_POST['map_loc'] . "',
                                                                pbm_size = '" . $_POST['map_size'] . "',
                                                                pbm_height = " . $_POST['height'] . ",
                                                                pbm_width = " . $_POST['width'] . ",
                                                                pbm_zoom = " . $_POST['map_zoom'] . ",
																 pbm_map_type = '" . $_POST['map_type'] . "',
                                                                pbm_map_view = '" . $_POST['map_view'] . "',
                                                                pbm_dashboard = '" . $_POST['map_dashboard'] . "'

                                                    WHERE pbm_pm_idx = '".$this->getUserIdx()."'";

                $resultUpdate = $this->con->query($sql);

            }

    }
    
    public function saveThis()
    {
        $sql = "SELECT pbm_pm_idx FROM ".$this->PG_BINGMAPS_DATA." WHERE pbm_pm_idx = '".$this->getUserIdx()."'";
        $result = $this->con->query($sql, 'rows');
        
        if(!$result)
        {
            $sql = "INSERT INTO ".$this->PG_BINGMAPS_DATA." ( pbm_pm_idx,
     
                                                               
                                                                pbm_map_type,
                                                                pbm_dyn_title,
                                                                pbm_dyn_desc
                                                               )
                    VALUES ('".$this->getUserIdx()."','" . $_POST['map_type'] . "', '" . $_POST['dyn_title'] . "', '" . $_POST['dyn_desc'] . "')";

              $resultInsert = $this->con->query($sql);
            
        }
        else
        {
            
            $sql = "UPDATE ".$this->PG_BINGMAPS_DATA." SET pbm_pm_idx = " .$this->getUserIdx() . ",
                                                         
                                                          
                                                            pbm_map_type = '" . $_POST['map_type'] . "',
                                                            pbm_dyn_title = '" . $_POST['dyn_title'] . "',
                                                            pbm_dyn_desc = '" . $_POST['dyn_desc'] . "'
                                                                
                                                        WHERE pbm_pm_idx = '".$this->getUserIdx()."'";

                $resultUpdate = $this->con->query($sql);

            
        }
        
        
    }
    */
    

}

$setup = new Setup();

/* End of file setup.php */