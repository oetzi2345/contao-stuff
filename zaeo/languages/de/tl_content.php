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
$GLOBALS['TL_LANG']['tl_content']['aeo_legend']          = 'Advanced eMail Obfuscation Einstellungen';

/**
 * fields
 */
$GLOBALS['TL_LANG']['tl_content']['aeo_custom_template'] = array('Template', 'Hier können Sie das Template für das Formular auswählen.');
$GLOBALS['TL_LANG']['tl_content']['aeo_show_info']       = array('Standard-Info anzeigen', 'Zeigt dem Frontend-Benutzer eine Standard-Information an, warum er eine Sicherheitsfrage beantworten muss. Gilt nur für Frontend-Benutzer ohne JavaScript.');
$GLOBALS['TL_LANG']['tl_content']['aeo_info_text']       = array('Eigener Info-Text', 'Informations-Text, der dem Frontend-Benutzer angezeigt wird. Gilt nur für Frontend-Benutzer ohne JavaScript.');
$GLOBALS['TL_LANG']['tl_content']['aeo_disable']         = array('Advanced eMail Obfuscation deaktivieren', 'Deaktiviert die Funktionalität von Advanced eMail Obfuscation für dieses Inhaltselement.');
?>