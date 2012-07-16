<?php

class ModelBase
{
    protected $PG_ANNOUNCEMENT_MAIN = null;
    protected $PG_ANNOUNCEMENT_DATA = null;
    protected $PG_ANNOUNCEMENT_SETTING = null;
    protected $db = null;

    public function __construct()
    {
        $this->db = new utilDb();
        $this->PG_ANNOUNCEMENT_MAIN = 'PG_Announcement_main';
        $this->PG_ANNOUNCEMENT_DATA = 'PG_Announcement_data';
        $this->PG_ANNOUNCEMENT_SETTING = 'PG_Announcement_setting';
    }

    public function getUserId()
    {
        $sSql = "SELECT pm_idx FROM " . $this->PG_ANNOUNCEMENT_MAIN . " WHERE pm_userid LIKE '" . PLUGIN_USER_ID . "'";
        $aId =  $this->db->query($sSql, 'row');
        return (int) $aId['pm_idx'];
    }
}

/* End of file base.php */