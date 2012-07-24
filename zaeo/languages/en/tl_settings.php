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
 * Name
 */
$GLOBALS['TL_LANG']['tl_settings']['aeo']                              = "Advanced eMail Obfuscation";

/**
 * legends
 */
$GLOBALS['TL_LANG']['tl_settings']['aeo_legend']                       = 'Advanced eMail Obfuscation Settings';

/**
 * fields
 */
$GLOBALS['TL_LANG']['tl_settings']['aeo_replace_standard_obfuscation'] = array('Active', 'If this option is enabled, the default obfuscation of e-mail addresses by TYPOlight is replaced by Advanced Mail Obfuscation.');
$GLOBALS['TL_LANG']['tl_settings']['aeo_use_rot_13']                   = array('Use ROT13 encryption', 'ROT13 (rotate by 13 places) is a shift cipher (also called the Caesar cipher) by which texts can be encrypted easily. This is done by replacing charactersw with other characters.');
$GLOBALS['TL_LANG']['tl_settings']['aeo_virtual_path']                 = array('Virtual path', 'The virtual path is used for front-end users who do not have JavaScript.');
$GLOBALS['TL_LANG']['tl_settings']['aeo_jump_to_no_js']                = array('Redirect page with JavaScript disabled', 'If JavaScript is disabled, the user is redirected - according to the language of the page - to the relevant page when clicking on an e-mail address. On this page, the module or content element "Advanced eMail Obfuscation" must be included. If there is no redirect page for the appropriate language the fallback redirect page is selected.');
$GLOBALS['TL_LANG']['tl_settings']['aeo_obfuscation_method']           = array('Obfuscation-Method', 'Type of obfuscation. Affects only the display on the site. Mailto links are obfuscated through the virtual path (and optional ROT13 encryption).');
$GLOBALS['TL_LANG']['tl_settings']['aeo_language_fallback']            = array('Fallback', '');
$GLOBALS['TL_LANG']['tl_settings']['aeo_language']                     = array('Language', '');
$GLOBALS['TL_LANG']['tl_settings']['aeo_redirecturl']                  = array('Redirect page', '');

/**
 * options
 */
$GLOBALS['TL_LANG']['tl_settings']['shorten']                          = array('Reduction', 'The e-mail addresses are displayd shortened on the website (e.g. hel...@domain.de)');
$GLOBALS['TL_LANG']['tl_settings']['rtl']                              = array('RTL', 'right-to-left. The e-mail address in the source code is written from right to left and displayed from left to right via CSS on the website.');
$GLOBALS['TL_LANG']['tl_settings']['nullspan']                         = array('"null" span', 'Span tags with the value "null" are inserted within the e-mail address. These tags are hidden by CSS on the website.');

?>
