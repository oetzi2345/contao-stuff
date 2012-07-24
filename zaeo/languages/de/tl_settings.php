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
$GLOBALS['TL_LANG']['tl_settings']['aeo_legend']                       = 'Advanced eMail Obfuscation Einstellungen';

/**
 * fields
 */
$GLOBALS['TL_LANG']['tl_settings']['aeo_replace_standard_obfuscation'] = array('Aktiv', 'Ist diese Option aktiviert, wird die Standard-Verschleierung von E-Mail-Adressen durch Contao durch "Advanced eMail Obfuscation" ersetzt.');
$GLOBALS['TL_LANG']['tl_settings']['aeo_use_rot_13']                   = array('ROT13-Verschlüsselung nutzen', 'ROT13 (engl. rotate by 13 places, zu Deutsch in etwa "rotiere um 13 Stellen") ist eine Verschiebechiffre (auch Caesar-Chiffre genannt), mit der auf einfache Weise Texte verschlüsselt werden können. Dies geschieht durch Ersetzung von Buchstaben – bei ROT13 im Speziellen wird jeder Buchstabe des lateinischen Alphabets durch den im Alphabet um 13 Stellen davor bzw. dahinter liegenden Buchstaben ersetzt.');
$GLOBALS['TL_LANG']['tl_settings']['aeo_virtual_path']                 = array('Virtueller Pfad', 'Der virtuelle Pfad wird für Frontend-Benutzer verwendet, die über kein JavaScript verfügen.');
$GLOBALS['TL_LANG']['tl_settings']['aeo_jump_to_no_js']                = array('Weiterleitungsseite bei deaktiviertem JavaScript', 'Bei deaktiviertem JavaScript wird der Benutzer bei einem Klick auf eine E-Mail-Adresse je nach der Sprache der Seite auf die entsprechende Seite weitergeleitet. Auf dieser Seite muss das Modul oder Inhaltselement "Advanced eMail Obfuscation" eingebunden sein. Existiert keine Weiterleitungsseite für die entsprechende Sprache wird die Fallback-Weiterleitungsseite gewählt.');
$GLOBALS['TL_LANG']['tl_settings']['aeo_obfuscation_method']           = array('Verschleierungs-Methode', 'Art der Verschleierung. Betrifft nur die Anzeige auf der Webseite. Mailto-Links werden über den virtuellen Pfad (und optionale ROT13-Verschlüsselung) abgebildet.');
$GLOBALS['TL_LANG']['tl_settings']['aeo_language_fallback']            = array('Fallback', '');
$GLOBALS['TL_LANG']['tl_settings']['aeo_language']                     = array('Sprache', '');
$GLOBALS['TL_LANG']['tl_settings']['aeo_redirecturl']                  = array('Weiterleitungsseite', '');

/**
 * options
 */
$GLOBALS['TL_LANG']['tl_settings']['shorten']                          = array('Verkürzung', 'Die E-Mail-Adressen werden gekürzt auf der Webseite dargestellt (z.B. hal...@domain.de)');
$GLOBALS['TL_LANG']['tl_settings']['rtl']                              = array('RTL', 'right-to-left. Die E-Mail-Adresse wird im Quellcode von rechts nach links geschrieben, per CSS auf der Webseite von links nach rechts angezeigt.');
$GLOBALS['TL_LANG']['tl_settings']['nullspan']                         = array('"null" Span', 'In die E-Mail-Adresse werden span-Tags mit dem Wert "null" eingebaut. Diese Tags werden per CSS auf der Webseite ausgeblendet.');

?>
