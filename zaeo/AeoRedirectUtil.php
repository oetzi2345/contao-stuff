<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

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
 * @version    1.2.1 stable
 * @license    GNU/LGPL
 * @filesource
 */

/**
 * Class AeoRedirectUtil
 */
class AeoRedirectUtil extends Frontend {
	
	/**
	 * Initialize the object
	 * @param array
	 */
	public function __construct($arrAttributes=false) {
		parent::__construct($arrAttributes);
		$this->import('AeoUtil');
	}
	
	/**
	 * Sofern Aliase deaktiviert sind oder die RootPage aufgerufen wird,
	 * ermittelt diese Methode die passende ID der Seite.
	 */
	function redirectFromRootPage() {
		$this->import('Environment');
		$strRequest = preg_replace(array('/^index.php\/?/', '/\?.*$/'), '', $this->Environment->request);
		$params = '';
		if (strstr($strRequest, '?')) {
			$arrRequest = explode('?', $strRequest);
			$strRequest = $arrRequest[0];
			$params = $arrRequest[1];
		}
		$strRequest = $this->removeUrlSuffix($strRequest);
		
		$arrFragments = explode('/', $strRequest);
		$arrFragments = $this->getRedirectPageAeo($arrFragments, true);
		if (is_numeric($arrFragments[0])) {
			// Add the fragments to the $_GET array
			for ($i=1; $i<count($arrFragments); $i+=2) {
				$this->Input->setGet($arrFragments[$i], $arrFragments[$i+1]);
			}
			return $arrFragments[0];
		}
		return FALSE;
	}
	
	/**
	 * Leitet den User ohne JavaScript auf die passende Formular-Seite weiter.
	 * @param $arrFragments
	 * @param $blnReturnId
	 */
	public function getRedirectPageAeo($arrFragments, $blnReturnId=false) {
		if ($GLOBALS['TL_CONFIG']['aeo_replace_standard_obfuscation'] === true) {
			$i18nl10nLanguage = '';
			if (in_array('i18nl10n', $this->Config->getActiveModules())) {
		  		if ($GLOBALS['TL_CONFIG']['i18nl10n_addLanguageToUrl']) {
		  			$i18nl10nLanguage = $arrFragments[count($arrFragments) - 1];
		  		}
			}

			$indexAeo = 2;
			if ($GLOBALS['TL_CONFIG']['useAutoItem']) {
				// auto-item-paramenter beruecksichtigen
				$indexAeo = 3;
			}
			
			if (is_array($arrFragments) && count($arrFragments) > 3 
			       && $arrFragments[0] == $GLOBALS['TL_CONFIG']['aeo_virtual_path']
			       && $arrFragments[$indexAeo] == 'aeo') {
			    $arrJumpTo = deserialize($GLOBALS['TL_CONFIG']['aeo_jump_to_no_js']);
			    
			    if ($GLOBALS['TL_CONFIG']['useAutoItem'] && $arrFragments[1] == 'auto_item') {
			    	// auto-item-paramenter entfernen
			    	unset($arrFragments[1]);
			    	$arrFragments = array_values($arrFragments);
			    }
			    
			    // Sprache ermitteln
			    $strLanguage = $arrFragments[1];
			    
			    $arrFallbackValue = array();
			    foreach ($arrJumpTo as $key => $value) {
					if ($value['aeo_language'] == $strLanguage) {
						$url = $this->getUrl($value, $blnReturnId);
						break;
					}
					if ($value['aeo_language_fallback']) {
						$arrFallbackValue = $value;
					}
			    }
			    
			    if (!isset($url) || strlen($url) == 0) {
			    	$url = $this->getUrl($arrFallbackValue, $blnReturnId);
			    }
			    
			    $i = 0;
				if (in_array('i18nl10n', $this->Config->getActiveModules()) &&
				     $GLOBALS['TL_CONFIG']['i18nl10n_alias_suffix']) {
					$this->AeoUtil->fixupCurrentLanguage();
					$url = str_replace('.'.$GLOBALS['TL_LANGUAGE'], '', $url);
				}
				$arrFragments[$i++] = $url;
				
				$strObfuscatedValues = $arrFragments[3];
			    if (in_array('i18nl10n', $this->Config->getActiveModules()) &&
				     $GLOBALS['TL_CONFIG']['i18nl10n_alias_suffix']) {
					$this->AeoUtil->fixupCurrentLanguage();
					$strObfuscatedValues = str_replace('.'.$GLOBALS['TL_LANGUAGE'], '', $strObfuscatedValues);
				}
				$arrObfuscatedValues = explode('+', $strObfuscatedValues, 4);
				
				$arrFragments[$i++] = 'n';
				$arrFragments[$i++] = $arrObfuscatedValues[0];
				$arrFragments[$i++] = 'd';
				$arrFragments[$i++] = $arrObfuscatedValues[1];
			    $arrFragments[$i++] = 't';
				$arrFragments[$i++] = $arrObfuscatedValues[2];
			    $arrFragments[$i++] = 'p';
				$arrFragments[$i++] = $arrObfuscatedValues[3];
				if (strlen($params) > 0) {
					$arrParams = explode('=', $params);
					$addNext = true;
					foreach ($arrParams as $param) {
						if (!$addNext) {
							continue;
						}
						if ($param == 'id') {
							$addNext = false;
							continue;
						}
						$arrFragments[$i++] = $param;
					}
				}
				
			    if (in_array('i18nl10n', $this->Config->getActiveModules()) &&
				     $GLOBALS['TL_CONFIG']['i18nl10n_addLanguageToUrl'] &&
				     strlen($i18nl10nLanguage)) {
		  			$arrFragments[$i++] = 'language';
		  			$arrFragments[$i++] = $i18nl10nLanguage;
 				}
			}
		}
		return $arrFragments;
	}
	
	private function getUrl($arrValue, $blnReturnId) {
		if ($blnReturnId) {
			$url = $this->AeoUtil->getPageId($arrValue['aeo_redirecturl']);
		} else {
			$url = $this->replaceInsertTags($arrValue['aeo_redirecturl']);
			$url = $this->removeUrlPrefix($url);
			if ($GLOBALS['TL_CONFIG']['addLanguageToUrl'] ||
			    (in_array('i18nl10n', $this->Config->getActiveModules()) &&
			     $GLOBALS['TL_CONFIG']['i18nl10n_addLanguageToUrl'])) {
				$arrUrlFragments = explode('/', $url);
				$url = $arrUrlFragments[1];
			}
			$params = '';
			if (strstr($url, '?')) {
				$arrUrl = explode('?', $url);
				$url = $arrUrl[0];
				$params = $arrUrl[1];
			}
			$url = $this->removeUrlSuffix($url);
		}
		return $url;
	}
	
	private function removeUrlPrefix($strUrl) {
		if (!$GLOBALS['TL_CONFIG']['rewriteURL']) {
			$strUrl = str_replace('index.php/', '', $strUrl);
		}
		return $strUrl;
	}
	
	private function removeUrlSuffix($strUrl) {
		// Remove the URL suffix if not just a language root (e.g. en/) is requested
		if ($strUrl != '' && (!$GLOBALS['TL_CONFIG']['addLanguageToUrl'] || !preg_match('@^[a-z]{2}/$@', $strUrl))) {
			$intSuffixLength = strlen($GLOBALS['TL_CONFIG']['urlSuffix']);

			// Return false if the URL suffix does not match (see #2864)
			if ($intSuffixLength > 0) {
				if (substr($strUrl, -$intSuffixLength) != $GLOBALS['TL_CONFIG']['urlSuffix']) {
					return -1;
				}

				$strUrl = substr($strUrl, 0, -$intSuffixLength);
			}
		}
		return $strUrl;
	}
}
?>