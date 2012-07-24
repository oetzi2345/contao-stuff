<?php
/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  cgo IT, 2012
 * @author     Carsten Götzinger (info@cgo-it.de)
 * @package    aeo
 * @version    1.1.0 stable
 * @license    GNU/LGPL
 * @filesource
 */

define("AEO_START", "############ Start Advanced eMail Obfuscation ############");
define("AEO_END", "############ Ende Advanced eMail Obfuscation ############");

/**
 * Class AeoBackendUtilJob
 */
class AeoBackendUtilJob extends Backend {

	/**
	 * Initialize the object
	 * @param array
	 */
	public function __construct($arrAttributes=false) {
		parent::__construct($arrAttributes);
		$this->import('Files');
	}

	public function run() {
		//nur ab Contao 2.9
    	if (version_compare(VERSION, '2.8', '>')) {
			if (!$this->Files->is_writeable('.htaccess')) {
				$_SESSION["TL_ERROR"][] = sprintf($GLOBALS['TL_LANG']['ERR']['notWriteable'], '.htaccess');
				return;
			}
	
			$htaccess = file_get_contents(TL_ROOT . '/.htaccess');
			$htaccess = $this->deleteRule($htaccess);
			$this->writeHtaccess($htaccess);
       }
	}

	protected function deleteRule($htaccess) {
		$begin = strpos($htaccess, AEO_START);
		if ($begin) {
			$htaccess = preg_replace('/'.AEO_START.'.*'.AEO_END.'/s', '', $htaccess, -1, $count);
		}
		return $htaccess;
	}

	protected function writeHtaccess($htaccess) {
		$htaccess_handle=$this->Files->fopen('.htaccess',w);
		$this->Files->fputs($htaccess_handle,$htaccess);
		$this->Files->fclose($htaccess_handle);
	}
}
$aeoBackendUtilJob = new AeoBackendUtilJob();
$aeoBackendUtilJob->run();
?>