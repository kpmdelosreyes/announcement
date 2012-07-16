<?php

class ModelTable extends ModelBase
{
	public function createTable()
	{
		$this->installAnnouncementData();
		$this->installAnnouncementSetting();
	}

	private function installAnnouncementData()
	{
            $sql = "CREATE TABLE IF NOT EXISTS {$this->PG_ANNOUNCEMENT_DATA} (
                `pad_idx` INT(11) NULL AUTO_INCREMENT,
                `pad_pm_idx` INT(11) NULL,
                `pad_title` VARCHAR(200) NULL,
                `pad_content` TEXT NULL,
                `pad_modified_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`pad_idx`)
                ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";

            $this->db->query($sql);
	}

	private function installAnnouncementSetting()
	{
            $sql = "CREATE TABLE IF NOT EXISTS {$this->PG_ANNOUNCEMENT_SETTING} (
                `pas_idx` INT(11) NULL AUTO_INCREMENT,
                `pas_pm_idx` INT(11) NULL,
                `pas_num_display` INT(11) NULL,
                `pas_time` INT(11) NULL,
                `pas_template` INT(11) NULL,
                PRIMARY KEY (`pas_idx`)
                ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";

            $this->db->query($sql);
	}

	public function dropTable()
	{
		$sql = "DROP TABLE IF EXISTS `" . $this->PG_ANNOUNCEMENT_DATA . "`, `" . $this->PG_ANNOUNCEMENT_SETTING . "`";	
		$this->db->query($sql);
	}
}

/* End of file table.php */