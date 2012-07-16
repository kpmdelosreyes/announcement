<?php

require($_SERVER['DOCUMENT_ROOT'] . '/lib/Common.php');

class test
{
    
    private $PG_NAME = PLUGIN_NAME;
    private $PG_URL= PLUGIN_URL;
    protected $PG_Displayroute_states = null;
   // protected $PG_BINGMAPS_SETTING = null;
    protected $smarty;
    protected $con;

    
    public function __construct()
    {
        $this->smarty = new Smarty();
        $this->con = new utilDb();
        $this->PG_Displayroute_states = 'PG_Displayroute_states';
       /* $this->PG_BINGMAPS_SETTING = 'PG_Bingmaps_setting';
        $this->PG_BINGMAPS_DATA = 'PG_Bingmaps_data'; */
        $this->smarty->assign('sScriptCrossDomain', CAFE24_CROSS_DOMAIN);
        $this->_setPluginDefault();
        $this->getData();
        
    }
    
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

        $this->smarty->display('test.tpl');
    }
    
    public function getData()
    {
        $page = 1;	// The current page
        $sortname = 'id';	 // Sort column
        $sortorder = 'asc';	 // Sort order
        $qtype = "";	 // Search column
        $query = "";	 // Search string
        // Get posted data
        if (isset($_POST['page'])) {
        $page = mysql_real_escape_string($_POST['page']);
        }
        if (isset($_POST['sortname'])) {
        $sortname = mysql_real_escape_string($_POST['sortname']);
        }
        if (isset($_POST['sortorder'])) {
        $sortorder = mysql_real_escape_string($_POST['sortorder']);
        }
        if (isset($_POST['qtype'])) {
        $qtype = mysql_real_escape_string($_POST['qtype']);
        }
        if (isset($_POST['query'])) {
        $query = mysql_real_escape_string($_POST['query']);
        }
      /*  if (isset($_POST['rp'])) {
        $rp = mysql_real_escape_string($_POST['rp']);
        }
        
        
        $page = $_POST['page'];
        $sortname = $_POST['sortname'];
        $sortorder = $_POST['sortorder'];
        $qtype = $_POST['qtype'];
        $query = $_POST['query'];*/
      $rp = 10;
    
        // Setup sort and search SQL using posted data
        $sortSql = "order by $sortname,$sortorder";
        
        $searchSql = ($qtype != '' && $query != '') ? "WHERE $qtype = '$query'" : '';

        // Get total count of records
        $sql = "SELECT count(*) FROM {$this->PG_Displayroute_states} $searchSql";
        $result = $this->con->query($sql);
        
            $total = array();
            foreach($result as $value)
            {
                $total= $value;

            }
    
        // Setup paging SQL
        $pageStart = ($page-1)* $rp;
        $limitSql = "limit $pageStart, $rp";
   
        // Return JSON data
        $data = array();
        $data['page'] = $page;
        $data['total'] = $total;
        $data['rows'] = array();
        
        $sql = "SELECT * FROM {$this->PG_Displayroute_states}"; //$searchSql $sortSql $limitSql
        $results = $this->con->query($sql);

            $data = array();
            foreach($results as $value)
            {
                $data = array('id' => $value['pg_states_idx'],
                              'cell' => array($value['pg_states_idx'], 
                                                $value['state'], 
                                                $value['alpha_code'], 
                                                $value['country'])
                          );
                                                

            }
          
        echo json_encode($data);
        
    }
    
    
}

$test = new test();

/*End of file*/