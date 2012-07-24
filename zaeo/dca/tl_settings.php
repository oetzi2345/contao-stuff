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
 * palettes
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['__selector__'][] = 'aeo_replace_standard_obfuscation';

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default']  .= ';{aeo_legend:hide},aeo_replace_standard_obfuscation';

/**
 * Add subpalettes to tl_settings
 */
$GLOBALS['TL_DCA']['tl_settings']['subpalettes']['aeo_replace_standard_obfuscation']  = 'aeo_use_rot_13,aeo_obfuscation_method,aeo_virtual_path,aeo_jump_to_no_js';

/**
 * fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['aeo_replace_standard_obfuscation'] = array
(
      'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['aeo_replace_standard_obfuscation'],
      'default'                 => '',
      'exclude'                 => true,
      'inputType'               => 'checkbox',
      'eval'                    => array('tl_class'=>'w50', 'submitOnChange'=>true)
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['aeo_use_rot_13'] = array
(
      'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['aeo_use_rot_13'],
      'default'                 => '',
	  'exclude'                 => true,
      'inputType'               => 'checkbox',
      'eval'                    => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['aeo_virtual_path'] = array
(
      'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['aeo_virtual_path'],
      'default'                 => '',
      'exclude'                 => true,
      'inputType'               => 'text',
      'eval'                    => array('decodeEntities'=>true, 'mandatory'=>true, 'tl_class'=>'w50', 'trailingSlash'=>false)
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['aeo_obfuscation_method'] = array
(
      'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['aeo_obfuscation_method'],
	  'default'                 => 'shorten',
      'exclude'                 => true,
      'inputType'               => 'select',
      'options'                 => array('shorten', 'rtl', 'nullspan'),
      'reference'               => &$GLOBALS['TL_LANG']['tl_settings'],
      'eval'                    => array('helpwizard'=>true, 'mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['aeo_jump_to_no_js'] = array
(
	  'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['aeo_jump_to_no_js'],
	  'exclude'                 => true,
	  'inputType'               => 'multiColumnWizard',
      'save_callback'           => array(
                                      array("tl_settings_aeo", "checkForDuplicateOrNoLanguageFallback"),
                                      array("tl_settings_aeo", "checkForDuplicateLanguage"),
                                      array("tl_settings_aeo", "checkForModuleOrCE")
                                   ),
      'eval' => array(
        'style'                 => 'width:100%;',
        'tl_class'              => 'clr',
        'columnFields' => array(
            'aeo_language_fallback' => array(
                'label'             => &$GLOBALS['TL_LANG']['tl_settings']['aeo_language_fallback'],
                'default'           => '',
                'exclude'           => true,
                'inputType'         => 'checkbox',
                'eval'              => array(doNotCopy => true, multiple => false, 'tl_class' => 'm12', 'style' => 'width:50px; padding-bottom: 3px;', 'includeBlankOption' => true),
            ),
            'aeo_language' => array(
                'label'             => &$GLOBALS['TL_LANG']['tl_settings']['aeo_language'],
                'exclude'           => true,
                'inputType'         => 'select',
                'options_callback'  => array("tl_settings_aeo", "getAvailableLanguages"),
                'eval'              => array(doNotCopy => true, 'mandatory' => true, 'tl_class' => 'm12', 'style' => 'width:210px; padding-bottom: 3px; margin-top: 3px;', 'includeBlankOption' => true),
            ),
            'aeo_redirecturl' => array(
                'label'             => &$GLOBALS['TL_LANG']['tl_settings']['aeo_redirecturl'],
                'exclude'           => true,
                'inputType'         => 'text',
                'eval'              => array('mandatory' => true, 'rgxp' => 'url', 'decodeEntities' => true, 'maxlength' => 255, 'tl_class' => 'w50 wizard', 'style' => 'width:300px; padding-bottom: 3px;'),
                'wizard' => array(
                    array('tl_settings_aeo', 'pagePicker')
                )
            )
        )
      )
);

class tl_settings_aeo extends Backend
{
	
    /**
     * Alle unterschiedlichen Seitensprachen suchen und zurückgeben
     * 
     * @return array 
     */
    public function getAvailableLanguages() {
    	$this->loadLanguageFile('languages');
		include(TL_ROOT . '/system/config/languages.php');
    	
        $arrReturn = array();
        
        $arrLanguages = array();
        
        $objResult = $this->Database->prepare("SELECT DISTINCT language FROM tl_page WHERE type = 'root'")->execute()->fetchAllAssoc();
        foreach (array_values($objResult) as $value) {
        	array_push($arrLanguages, strtolower($value['language']));
        }
        
        if (in_array('i18nl10n', $this->Config->getActiveModules())) {
        	$languages = deserialize($GLOBALS['TL_CONFIG']['i18nl10n_languages']);
	        foreach ($languages as $language) {
	        	array_push($arrLanguages, strtolower($language));
	        }
	        $arrLanguages = array_unique($arrLanguages);
        }

        foreach ($arrLanguages as $language) {
	        $arrReturn[$language] = strlen($GLOBALS['TL_LANG']['LNG'][$language]) ? 
	            utf8_romanize($GLOBALS['TL_LANG']['LNG'][$language]).' ('.strtoupper($language).')' : strtoupper($language);
        }
        return $arrReturn;
    }
    
    public function checkForDuplicateOrNoLanguageFallback($varVal, DataContainer $dc) {
        $arrValue = deserialize($varVal);
        
        $count = 0;
        foreach ($arrValue as $key => $value) {
        	if ($value['aeo_language_fallback']) {
        		$count++;
        	}
            if ($count > 1) {
                $_SESSION["TL_ERROR"][] = sprintf($GLOBALS['TL_LANG']['aeo']['aeo_error_duplicate'], $GLOBALS['TL_LANG']['tl_settings']['aeo_language_fallback'][0]);
            }
        }
        
        if ($count == 0) {
        	$_SESSION["TL_ERROR"][] = sprintf($GLOBALS['TL_LANG']['ERR']['mandatory'], $GLOBALS['TL_LANG']['tl_settings']['aeo_language_fallback'][0]);
        }
        
        return serialize($arrValue);
    }
	
	/**
     * Prüfen, ob eine Sprache zwei mal gewählt wurde
     * 
     * @param string $varVal
     * @param DataContainer $dc
     * @return string 
     */
    public function checkForDuplicateLanguage($varVal, DataContainer $dc) {
        $arrValue = deserialize($varVal);
        $arrValueFound = array();
        
        foreach ($arrValue as $key => $value) {
            if (in_array($value["aeo_language"], $arrValueFound)) {
                $_SESSION["TL_ERROR"][] = sprintf($GLOBALS['TL_LANG']['aeo']['aeo_error_duplicate'], $GLOBALS['TL_LANG']['tl_settings']['aeo_language'][0]);
            }
            else {
                $arrValueFound[] = $value["aeo_language"];
            }
        }
        
        return serialize($arrValue);
    }

	/**
     * Prüfen, ob die Weiterleitungsseiten alle das Modul oder CE
     * "AEO" beinhalten.
     * 
     * @param string $varVal
     * @param DataContainer $dc
     * @return string 
     */
    public function checkForModuleOrCE($varVal, DataContainer $dc) {
    	$this->import('Database');
    	$this->import('AeoUtil');

    	$arrValue = deserialize($varVal);
        foreach ($arrValue as $key => $value) {
	        $objResult = $this->Database->prepare("SELECT count(*) as anzahl FROM tl_page p, tl_article a, tl_content c LEFT JOIN tl_module m ON c.module = m.id 
	                                               WHERE p.id = a.pid AND a.id = c.pid AND c.invisible <> 1 AND 
	                                               ( m.type = 'aeo' OR c.type = 'aeo' ) AND p.id = ?")->limit(1)->execute($this->AeoUtil->getPageId($value["aeo_redirecturl"]));
        	
        	if (($objResult->anzahl) == 0) {
        		$_SESSION["TL_ERROR"][] = &$GLOBALS['TL_LANG']['aeo']['aeo_error_redirect'];
        	}
        }
        
        return serialize($arrValue);
    }

    /**
	 * link picker wizard zurückgeben
	 * @param DataContainer
	 * @return string
	 */
	public function pagePicker(DataContainer $dc) {
		$strField = 'ctrl_' . $dc->field . (($this->Input->get('act') == 'editAll') ? '_' . $dc->id : '');
		return ' ' . $this->generateImage('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top;cursor:pointer" onclick="Backend.pickPage(\'' . $strField . '\')"');
	}
}
?>
