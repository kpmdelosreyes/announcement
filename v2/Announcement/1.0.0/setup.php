<?php

require($_SERVER['DOCUMENT_ROOT'] . '/lib/Common.php');
require(SERVER_PLUGIN_PATH . PLUGIN_NAME . DS . PLUGIN_VERSION . '/libs/helper.php');
require(SERVER_PLUGIN_PATH . PLUGIN_NAME . DS . PLUGIN_VERSION . '/model/base.php');
require(SERVER_PLUGIN_PATH . PLUGIN_NAME . DS . PLUGIN_VERSION . '/model/exec.php');
require(SERVER_PLUGIN_PATH . PLUGIN_NAME . DS . PLUGIN_VERSION . '/model/get.php');

class Setup
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
        $this->oSmarty->assign('PLUGIN_NAME', PLUGIN_NAME);
        $this->oSmarty->assign('sBaseUrl', SERVER_BASE_URL);
        $this->oSmarty->assign('jquery', SERVER_JQUERYJS_URL);
        $this->oSmarty->assign('emulation', SERVER_COMMONJS_URL);
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
        $aResult = $this->oGet->getSetting();

        if (count($aResult) > 0) $this->oSmarty->assign("aData", $aResult);

        $this->oSmarty->display("setup.tpl");
    }

    private function execsaveSettings()
    {
        $aParam = $this->oHelper->getParams();
        $aResult = $this->oGet->getSetting();

        foreach ($aParam['aData'] as $sKey => $sVal){
                if ($sVal == "true" || $sVal == "false") $aParam['aData'][$sKey] = $sVal == "true" ? 1 : 0;
        }

        if ($aResult){
                $bResult = $this->oExec->updateSetting($aParam['aData']);
        }
        else {
                $aParam['aData']['pas_pm_idx'] = $this->oBase->getUserId();
                $bResult = $this->oExec->insertSetting($aParam['aData']);
        }

        echo $bResult;
    }
}

$setup = new Setup();

/* End of file setup.php */