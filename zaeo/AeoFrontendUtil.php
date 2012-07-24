<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

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
 * Class AeoFrontendUtil
 */

define('REGEXP_EMAIL_PREFIX', '(\w[-._\w]*\w)\@');
define('REGEXP_MAILTO', "[\"\']mailto:(\w[-._\w]*\w)\@(\w[-._\w]*\w)\.(\w{2,6})[\"\'\?]");
define('REGEXP_EMAIL', '\w[-._\w]*\w@\w[-._\w]*\w\.\w{2,6}');
define('REGEXP_MAILTO_LINK', '/(?P<all>\<a(?P<before>[^>]+)href\=["\']mailto\:(?P<email>\w[-._\w]*\w)\@(?P<domain>\w[-._\w]*\w)\.(?P<suffix>\w{2,6})["\'](?P<after>[^>]*)\>).*?\<\/a\>/ism');

class AeoFrontendUtil extends Frontend {

	/**
	 * Replace default obfuscation, default is 1
	 * @var int
	 */
	protected $replace_standard_obfuscation = 1;

	/**
	 * Use additional ROT13 encryption, default is 1
	 * @var int
	 */
	protected $use_rot_13 = 1;

	/**
	 * Virtual path for non javascript users, default is 'contact'
	 * @var string
	 */
	protected $virtual_path = 'contact';

	/**
	 * Weiterleitungsseite für nicht JavaScript Nutzer
	 * @var string
	 */
	protected $jump_to_no_js;

	/**
	 * Methode zum Verschleiern der angezeigten E-Mail-Adresse im Frontend
	 * @var string
	 */
	protected $obfuscation_method;
	
	/**
	 * Instance of AEOUtility
	 * @var AEOUtility
	 */
	protected $aeo;

	/**
	 * Initialize the object
	 * @param array
	 */
	public function __construct($arrAttributes=false) {
		parent::__construct($arrAttributes);

		global $objPage;
		$objPage = $this->getPageDetails($objPage->id);
		
		if (TL_MODE == 'FE') {
			global $objPage;
			$this->import('AeoUtil');

			if ($GLOBALS['TL_CONFIG']['aeo_replace_standard_obfuscation'] === true) {
			  	$this->use_rot_13 = $GLOBALS['TL_CONFIG']['aeo_use_rot_13'];
			  	$this->virtual_path = $GLOBALS['TL_CONFIG']['aeo_virtual_path'];
			  	$this->jump_to_no_js = $GLOBALS['TL_CONFIG']['aeo_jump_to_no_js'];
			  	$this->obfuscation_method = $GLOBALS['TL_CONFIG']['aeo_obfuscation_method'];
			  	 
			  	$this->aeo = new Aeo();
			  	$this->aeo->root = 'system/modules/zaeo/html/';
			  	$this->aeo->setTooltipNoJS($GLOBALS['TL_LANG']['aeo']['tooltip_no_js']);
			  	$this->aeo->setTooltipJS($GLOBALS['TL_LANG']['aeo']['tooltip_js']);
			  	$folder = '';
			  	if (!$GLOBALS['TL_CONFIG']['rewriteURL']) {
			  		$folder .= 'index.php/';
			  	}
			  	if ($GLOBALS['TL_CONFIG']['addLanguageToUrl']) {
			  		$folder .= $objPage->rootLanguage.'/';
			  	}
			  	if (in_array('i18nl10n', $this->Config->getActiveModules())) {
			  		$this->AeoUtil->fixupCurrentLanguage();
			  		if ($GLOBALS['TL_CONFIG']['i18nl10n_addLanguageToUrl']) {
			  			$folder .= $GLOBALS['TL_LANGUAGE'] . '/';
			  		}
					$folder .= $this->virtual_path.'/'.$GLOBALS['TL_LANGUAGE'];
				} else {
					$folder .= $this->virtual_path.'/'.$objPage->rootLanguage;
				}
			  	
			  	$this->aeo->setFolder($folder);
			  	$this->aeo->setMethod($this->obfuscation_method);
			  	if ($this->use_rot_13) {
			  		$this->aeo->setROT13(true);
			  	} else {
			  		$this->aeo->setROT13(false);
			  	}
			  	$urlSuffix = '';
			  	if (strlen($GLOBALS['TL_CONFIG']['urlSuffix']) > 0) {
			  		if (in_array('i18nl10n', $this->Config->getActiveModules()) &&
			  		    $GLOBALS['TL_CONFIG']['i18nl10n_alias_suffix']) {
			  			$this->AeoUtil->fixupCurrentLanguage();
			  			$urlSuffix .= '.'.$GLOBALS['TL_LANGUAGE'];
			  		}
			  		$urlSuffix .= $GLOBALS['TL_CONFIG']['urlSuffix'];
			  	}
				$objResult = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")
													->limit(1)
													->execute($objPage->id)
													->fetchAssoc();
				$url = $this->generateFrontendUrl($objResult);
				if (strstr($url, '?')) {
					$arrParams = explode('?', $url);
					if (count($arrParams) == 2) {
						$arrParamValues = explode('&', $arrParams[1]);
						$added = false;
						foreach ($arrParamValues as $param) {
							if (!strstr($param, 'id=')) {
								$urlSuffix .= ($added ? '&' : '?').$param;
								$added = true;
							}
						}
					}
				}
				$this->aeo->urlSuffix = $urlSuffix;
		  	} else {
		  		// global deaktiviert
		  		$this->replace_standard_obfuscation = 0;
		  	}
		}
	}
	
	public function aeoGetFrontendModule($objRow, $strBuffer) {
		return $this->checkAeoDisabled($objRow, $strBuffer);
	}

	public function aeoGetContentElement($objRow, $strBuffer) {
		return $this->checkAeoDisabled($objRow, $strBuffer);
	}

	public function obfuscateEmails($strContent, $strTemplate)
	{
		global $objPage;
		$objPage = $this->getPageDetails($objPage->id);
		$redirectPageId = $this->AeoUtil->getRedirectPageForLanguage(deserialize($this->jump_to_no_js), $objPage->rootLanguage);
		
		if (TL_MODE == 'FE' && $this->replace_standard_obfuscation && $objPage->id != $redirectPageId) {
			$strContent = $this->replaceInsertTags($strContent);
			
			$this->import('String');
			
			// erst alle Mailadresse decodieren (Verschleierung von Contao rückgänging machen)
			$intOffset = 0;
			$arrNoAeoAreas = $this->aeo->getNoAeoAreas($strContent);
			while (preg_match('/(&#[x]?\w+;)+/i', $strContent, $arrEmail, PREG_OFFSET_CAPTURE, $intOffset)) {
				if ($this->aeo->isEnabled($arrEmail[0][1], $arrNoAeoAreas)) {
					$strDecodedMail = $this->String->decodeEntities($arrEmail[0][0]);
					if (preg_match('/mailto:'.REGEXP_EMAIL.'/i', $strDecodedMail)) {
						// erst alle verlinkten eMail-Adressen entschleiern
						$strContent = $this->aeo->str_replace($arrEmail[0][0], $strDecodedMail, $strContent, $arrEmail[0][1]);
						$intOffset = $arrEmail[0][1] + strlen($strDecodedMail);
						
						// Array muss neu aufgebaut werden, da sich die offsets geändert haben
						$arrNoAeoAreas = $this->aeo->getNoAeoAreas($strContent);
					} else if (preg_match('/'.REGEXP_EMAIL.'/i', $strDecodedMail)) {
						// dann alle nicht verlinkten eMail-Adressen entschleiern
						$strContent = $this->aeo->str_replace($arrEmail[0][0], $strDecodedMail, $strContent, $arrEmail[0][1]);
						$intOffset = $arrEmail[0][1] + strlen($strDecodedMail);
						
						// Array muss neu aufgebaut werden, da sich die offsets geändert haben
						$arrNoAeoAreas = $this->aeo->getNoAeoAreas($strContent);
					} else {
						$intOffset = $arrEmail[0][1] + 1;
					}
				} else {
					$intOffset = $arrEmail[0][1] + 1;
				}
			}

			$strContent = $this->aeo->prepareOutput($strContent, $objPage->id);
		}

		return $strContent;
	}
	
	private function checkAeoDisabled($objRow, $strBuffer) {
		if ($objRow->aeo_disable == '1') {
			$strBuffer = "\n<!-- aeo::stop -->". $strBuffer ."<!-- aeo::continue -->\n";
		}
		return $strBuffer;
	}
}

class Aeo extends System {
	var $buffer;
	var $folder = "contact";
	var $tooltip_js_on;
	var $tooltip_js_off;
	var $rot13 = true;
	var $urlSuffix = '';
	var $method;

	function prepareOutput($output, $pageId) {
		// Erst alle verlinkten eMail-Adressen verschleiern
		$arrNoAeoAreas = $this->getNoAeoAreas($output);
		$intOffset = 0;
		while(preg_match(REGEXP_MAILTO_LINK, $output, $arrLink, PREG_OFFSET_CAPTURE, $intOffset)) {
			if ($this->isEnabled($arrLink['all'][1], $arrNoAeoAreas)) {
				$output = $this->obfuscate($arrLink, $output, $pageId, $this->urlSuffix == null ? '' : $this->urlSuffix, $arrLink['all'][1], &$intOffset);

				// Array muss neu aufgebaut werden, da sich die offsets geändert haben
				$arrNoAeoAreas = $this->getNoAeoAreas($output);
			} else {
				$intOffset = strlen($arrLink['all'][0]) + $arrLink['all'][1];
			}
		}

		// jetzt alle nicht verlinkten eMail-Adressen verschleiern.
		$arrNoAeoAreas = $this->getNoAeoAreas($output);
		$intOffset = 0;
		while(preg_match('/'.REGEXP_EMAIL_PREFIX.'/esm', $output, $arrNonLinkedeMail, PREG_OFFSET_CAPTURE, $intOffset)) {
			if ($this->isEnabled($arrNonLinkedeMail[0][1], $arrNoAeoAreas)) {
				$output = $this->str_replace($arrNonLinkedeMail[0][0], $this->obfuscateWithMethod($arrNonLinkedeMail[0][0], $arrNonLinkedeMail[0][1], &$intOffset), $output, $arrNonLinkedeMail[0][1]);

				// Array muss neu aufgebaut werden, da sich die offsets geändert haben
				$arrNoAeoAreas = $this->getNoAeoAreas($output);
			} else {
				$intOffset = strlen($arrNonLinkedeMail[0][0]) + $arrNonLinkedeMail[0][1];
			}
		}
		$close_head = array("</head>", "</HEAD>");
		$output = str_replace($close_head, $this->dropJS() . "\n</head>", $output);
		if ($this->method != 'shorten') {
			$output = str_replace($close_head, $this->dropCSS() . "\n</head>", $output);
		}
		return $output;
	}
	
	function obfuscate($arrLink, $output, $pageId, $urlSuffix, $intPos, $intOffset) {
		$newLink = '<a';
		$originalOnClick = '';
		if (stristr($arrLink['before'][0], 'onclick')) {
			preg_match('/onclick=[\"\'](?P<onclick>.*)[\"\']/i', $arrLink['before'][0], $matches);
			$originalOnClick = $matches['onclick'];
			$arrLink['before'][0] = preg_replace('/(.*)onclick=[\"\'].*[\"\'](.*)/i', '$1 $2', $arrLink['before'][0]);
		}
		if (stristr($arrLink['after'][0], 'onclick')) {
			preg_match('/onclick=[\"\'](?P<onclick>.*)[\"\']/i', $arrLink['after'][0], $matches);
			$originalOnClick = $matches['onclick'];
			$arrLink['after'][0] = preg_replace('/(.*)onclick=[\"\'].*[\"\'](.*)/i', '$1 $2', $arrLink['after'][0]);
		}
		
		$newLink .= ' '.trim($arrLink['before'][0]).' '.trim($arrLink['after'][0]);
		$newLink .= ' href="'.$this->folder.'/aeo/'.
		              ($this->rot13 ? str_rot13($arrLink['email'][0]) : $arrLink['email'][0]).'+'.
		              ($this->rot13 ? str_rot13($arrLink['domain'][0]) : $arrLink['domain'][0]).'+'.
		              ($this->rot13 ? str_rot13($arrLink['suffix'][0]) : $arrLink['suffix'][0]).'+'.
		              $pageId.$urlSuffix.'" rel="nofollow" title="'.$this->tooltip_js_off.'"';
		$newLink .= ' onclick="aeo_decode(this);'.$originalOnClick.'"';
		$newLink .= ' onmouseover="aeo_onmouseover(this);">';
		$output = $this->str_replace($arrLink['all'][0], $newLink, $output, $intOffset);
		$intOffset = $intPos + strlen($newLink);
		return $output;
	}

	function dropJS() {
		return "\n<script type=\"text/javascript\" src=\"" . $this->root . "js/aeo.js.php?folder=" . urlencode(str_replace("/", "\/", $this->folder)) . "&amp;tooltip_js_on=" . urlencode($this->tooltip_js_on) . "&amp;tooltip_js_off=" . urlencode($this->tooltip_js_off) . "&amp;rot13=" . ($this->rot13 ? "true" : "false") . "\"></script>";
	}

	function dropCSS() {
		$css = "\n<style type=\"text/css\">\n\t";
		switch ($this->method) {
			case 'rtl':
				$css .= '.obfuscated { unicode-bidi: bidi-override; direction: rtl; }';
				break;
			case 'nullspan':
				$css .= 'span.obfuscated { display: none; }';
				break;
		}
		$css .= "\n</style>"; 
		return $css;
	}

	function setTooltipJS($tooltip) {
		$this->tooltip_js_on = $tooltip;
	}

	function setTooltipNoJS($tooltip) {
		$this->tooltip_js_off = $tooltip;
	}
	
	function setFolder($folder) {
		$this->folder = $folder;
	}
	
	function setROT13($rot13) {
		$this->rot13 = $rot13;
	}
	
	function setMethod($method) {
		$this->method = $method;
	}
	
	function obfuscateWithMethod($email, $intPos, $intOffset) {
		switch ($this->method) {
			case 'rtl' :
				$strEmail = $this->rtl($email);
				break;
			case 'nullspan' :
				$strEmail = $this->nullspan($email);
				break;
			default:
				$strEmail = $this->shorten($email);
		}
		
		// Offset korrigieren
		$intOffset = $intPos + strlen($strEmail);
		return $strEmail;
	}
	
	function shorten ($email) {
		if (strlen ($email) <= 4) {
			$email = substr ($email, 0, 1);
		} else if (strlen ($email) <= 6) {
			$email = substr ($email, 0, 3);
		} else {
			$email = substr ($email, 0, 4);
		}
		return $email.'...&#64;';
	}
		
	function rtl ($email) {
		return '<span class="obfuscated">'.strrev($email).'</span>';
	}
			
	function nullspan ($email) {
		if (strlen ($email) <= 4) {
			$email1 = substr ($email, 0, 1);
			$email2 = substr ($email, 1);
		} else if (strlen ($email) <= 6) {
			$email1 = substr ($email, 0, 3);
			$email2 = substr ($email, 3);
		} else {
			$email1 = substr ($email, 0, 4);
			$email2 = substr ($email, 4);
		}
		return $email1.'<span class="obfuscated">null</span>'.$email2;
	}
	
	function getNoAeoAreas($output) {
		$arrNoAeoAreas = array();
		$intOffset = 0;
		while (preg_match('/<!-- aeo::stop -->/', $output, $arrOuter, PREG_OFFSET_CAPTURE, $intOffset)) {
			$intOffset = strlen($arrOuter[0][0]) + $arrOuter[0][1];
			preg_match('/<!-- aeo::continue -->/', $output, $arrInner, PREG_OFFSET_CAPTURE, $intOffset);
			$arrNoAeoAreas[] = array('start' => $arrOuter[0][1], 'end' => $arrInner[0][1]);
			$intOffset = strlen($arrInner[0][0]) + $arrInner[0][1];
		}
		return $arrNoAeoAreas;
	}
	
	function isEnabled($intPos, $arrNoAeoAreas) {
		foreach ($arrNoAeoAreas as $arrDisabledArea) {
			if ($arrDisabledArea['start'] < $intPos && 
			    $arrDisabledArea['end'] > $intPos) {
			    	return false;
			    }
		}
		return true;
	}
	
	function str_replace($search, $replacement, $subject, $offset) {
		$mysubject = substr($subject, 0, $offset);
		$strRest = substr($subject, $offset);
		$mysubject .= preg_replace('/'.preg_quote($search, '/').'/sm', $replacement, $strRest, 1);
		return $mysubject;
	}
}
?>
