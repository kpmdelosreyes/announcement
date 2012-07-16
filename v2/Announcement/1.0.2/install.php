<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/conf.sys.php');

class AnnouncementInstall
{
    private $sPrefix = "PG_";
    private $PG_ANNOUNCEMENT_SETTING = null;
    private $con;

    public function __construct()
    {
        $this->PG_ANNOUNCEMENT_SETTING = $this->sPrefix . "Announcement_setting";
        $this->PG_ANNOUNCEMENT_DATA = $this->sPrefix . "Announcement_data";
        $this->con = new utilDb();

        $this->install();
        $this->install2();
    }

    public function install()
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->PG_ANNOUNCEMENT_DATA} (
                    `pad_idx` INT(11) NULL AUTO_INCREMENT,
                    `pad_pm_idx` INT(11) NULL,
                    `pad_title` VARCHAR(200) NULL,
                    `pad_content` TEXT NULL,
                    `pad_modified_date` TIMESTAMP NULL,
                    PRIMARY KEY (`pad_idx`)
                    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
        
        $this->con->query($sql);
    }
    
    public function install2()
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->PG_ANNOUNCEMENT_SETTING} (
                    `pas_idx` INT(11) NULL AUTO_INCREMENT,
                    `pas_pm_idx` INT(11) NULL,
                    `pas_num_display` INT(11) NULL,
                    `pas_template` INT(11) NULL,
                    PRIMARY KEY (`pas_idx`)
                    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
        
        $this->con->query($sql);
    }
   
    
    
}

$install = new AnnouncementInstall;
