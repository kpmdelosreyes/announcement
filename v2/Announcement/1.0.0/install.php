<?php

require($_SERVER['DOCUMENT_ROOT'] . "/lib/conf.sys.php");
require($_SERVER['DOCUMENT_ROOT'] . "/plugin/" . PLUGIN_NAME . "/" . PLUGIN_VERSION . "/model/base.php");
require($_SERVER['DOCUMENT_ROOT'] . "/plugin/" . PLUGIN_NAME . "/" . PLUGIN_VERSION . "/model/table.php");

class Install
{
	private $oTable = null;

	public function __construct()
	{
		$this->oTable = new ModelTable;
		$this->init();
	}

	private function init()
	{
		$this->oTable->createTable();
	}
}

$install = new Install();