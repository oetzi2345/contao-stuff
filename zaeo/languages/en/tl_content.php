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
 * legends
 */
$GLOBALS['TL_LANG']['tl_content']['aeo_legend']          = 'Advanced eMail Obfuscation Settings';

/**
 * fields
 */
$GLOBALS['TL_LANG']['tl_content']['aeo_custom_template'] = array('Template', 'Here you can select the template for the form.');
$GLOBALS['TL_LANG']['tl_content']['aeo_show_info']       = array('Show standard info', 'Shows the front-end user a standarized information why he has to answer a security question. Applies only for front-end users without JavaScript.');
$GLOBALS['TL_LANG']['tl_content']['aeo_info_text']       = array('Own info text', 'Information text to the front-end user. Applies only for front-end users without JavaScript.');
$GLOBALS['TL_LANG']['tl_content']['aeo_disable']         = array('Disable Advanced eMail Obfuscation', 'Disables the functionality of Advanced eMail Obfuscation for this content element.');
?>