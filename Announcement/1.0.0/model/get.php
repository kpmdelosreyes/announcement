<?php

class ModelGet extends ModelBase
{
		
	public function getUserData()
	{	
		$sSql = "SELECT * FROM " . $this->PG_ANNOUNCEMENT_DATA . " WHERE psd_pm_idx = " . $this->getUserId() . " ORDER BY pad_idx ASC";
		return $this->db->query($sSql);
	}
	
	public function getNoteInfo($iIdx)
	{
		$sSql = "SELECT * FROM " . $this->PG_ANNOUNCEMENT_DATA . " WHERE pad_idx = " . $iIdx;
		return $this->db->query($sSql, "row");
	}
	
	public function getData($sWhere = "")
	{	
		$sSql = "SELECT * FROM " . $this->PG_ANNOUNCEMENT_DATA . " WHERE pad_pm_idx = " . $this->getUserId() . $sWhere;
		return $this->db->query($sSql);
	}
	
	public function getTotalRow($sWhere)
	{
		$sSql = "SELECT COUNT(*) as count FROM " . $this->PG_ANNOUNCEMENT_DATA . " WHERE pad_pm_idx = " . $this->getUserId() . $sWhere;
		return $this->db->query($sSql, "row");
	}
	
	public function getSetting()
	{
		$sSql = "SELECT * FROM " . $this->PG_ANNOUNCEMENT_SETTING . " WHERE pas_pm_idx = " . $this->getUserId();
		return $this->db->query($sSql, "row");
	}
}

/* End of file get.php */
