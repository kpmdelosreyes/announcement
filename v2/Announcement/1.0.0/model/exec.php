<?php

class ModelExec extends ModelBase
{
	public function createNote($aData)
	{
		return $this->db->insert($this->PG_ANNOUNCEMENT_DATA, $aData);
	}
	
	public function updateNote($aData, $sWhere)
	{
		return $this->db->update($this->PG_ANNOUNCEMENT_DATA, $aData, $sWhere);
	}
	
	public function deleteNote($sWhere)
	{
		$sSql = "DELETE FROM " . $this->PG_ANNOUNCEMENT_DATA . " WHERE " . $sWhere;	
		return $this->db->query($sSql);
	}
	
	public function updateSetting($aData)
	{
		$sWhere = "pas_pm_idx = " . $this->getUserId();
		return $this->db->update($this->PG_ANNOUNCEMENT_SETTING, $aData, $sWhere);
	}
	
	public function insertSetting($aData)
	{
		return $this->db->insert($this->PG_ANNOUNCEMENT_SETTING, $aData);
	}
}

/* End of file exec.php */