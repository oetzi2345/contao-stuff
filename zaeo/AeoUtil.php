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
 * Class AeoUtil
 */
class AeoUtil extends Controller {

	/**
	 * Initialize the object
	 * @param array
	 */
	public function __construct() {
		parent::__construct();
		$this->import('Database');
	}

	/**
	 * Liefert die Redirect-Page je nach Sprache
	 * @param $pageId
	 */
	public function getRedirectPageForLanguage($arrRedirectPages, $language) {
		$defaultLanguage = $this->Database->prepare("SELECT language FROM tl_page WHERE type = 'root' and fallback = 1")->limit(1)->execute();
		
		if (is_array($arrRedirectPages)) {
			foreach ($arrRedirectPages as $key => $value) {
				if ($value['aeo_language'] == $language) {
					return $this->getPageId($value['aeo_redirecturl']);
				}
				if ($value['aeo_language'] == $defaultLanguage->language) {
					$defaultPage = $this->getPageId($value['aeo_redirecturl']);
				}
			}
		}
		return $defaultPage;
	}
	
	/**
	 * Liefert die PageId zu einem InsertTag
	 * @param $tag
	 */
	public function getPageId($tag) {
		$tags = preg_split('/\{\{([^\}]+)\}\}/', $tag, -1, PREG_SPLIT_DELIM_CAPTURE);
		foreach ($tags as $strTag) {
			if ($strTag == '') {
				continue;
			}
			$elements = explode('::', $strTag);
			return $elements[1];
		}
	}

    /**
     * Fix up current language depending on momentary user preference.
     * Strangely $GLOBALS['TL_LANGUAGE'] is switched to the current user language if user is just
     * authentitcating and has the language property set. 
     * See system/libraries/User.php:202
     * We override this behavior and let the user temporarily use the selected by him language.
     * One workaround would be to not let the members have a language property.
     * Then this method will not be needed any more.
     */
     public function fixupCurrentLanguage(){
         $selected_language = $this->Input->post('language');
         //allow GET request for language
         if(!$selected_language){
            $selected_language = $this->Input->get('language');
         }
         if(
            ($selected_language) && 
            in_array($selected_language,
                             deserialize($GLOBALS['TL_CONFIG']['i18nl10n_languages']))
         ) {
            $_SESSION['TL_LANGUAGE'] = $GLOBALS['TL_LANGUAGE'] = $selected_language;
         } elseif(isset($_SESSION['TL_LANGUAGE'])) {
             $GLOBALS['TL_LANGUAGE'] = $_SESSION['TL_LANGUAGE'];
         }
     }
}
?>