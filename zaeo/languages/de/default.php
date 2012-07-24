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
 * front end modules
 */
$GLOBALS['TL_LANG']['FMD']['aeo']                 = array('Advanced eMail Obfuscation', 'Erzeugt ein Formular zur Entschlüsselung von E-Mail-Adressen Frontend-Benutzer ohne JavaScript.');

/**
 * content Elements
 */
$GLOBALS['TL_LANG']['CTE']['aeo']                 = array('Advanced eMail Obfuscation', 'Erzeugt ein Formular zur Entschlüsselung von E-Mail-Adressen Frontend-Benutzer ohne JavaScript.');

/**
 * errors
 */
$GLOBALS['TL_LANG']['aeo']['aeo_error_duplicate'] = 'Advanced eMail Obfuscation: Es sind Einträge im Feld %s doppelt vorhanden.';
$GLOBALS['TL_LANG']['aeo']['aeo_error_redirect']  = 'Advanced eMail Obfuscation: Bitte achten Sie darauf, dass alle Weiterleitungsseiten ein Modul oder Inhaltselement vom Typ "Advanced eMail Obfuscation" enthalten.'; 

/**
 * others
 */
$GLOBALS['TL_LANG']['aeo']['tooltip_no_js']       = 'Da Sie JavaScript deaktiviert haben müssen sie eine einfache Frage beantworten, um ihr E-Mail-Programm automatisch zu öffnen.';
$GLOBALS['TL_LANG']['aeo']['tooltip_js']          = 'E-Mail senden';

$GLOBALS['TL_LANG']['aeo']['buttonLabel']         = 'E-Mail-Programm öffnen';
$GLOBALS['TL_LANG']['aeo']['info']                = '<h2>Warum muss ich diese Frage beantworten?</h2><p>Das Ziel dieser Überprüfung ist es, den Inhaber der angegebenen E-Mail-Adresse vor dem Empfang von unerwünschten E-Mails zu schützen.</p><p>Da Sie kein JavaScript aktiviert haben, überprüfen wir durch diese Sicherheitsfrage, ob Sie wirklich ein Mensch sind. Mit aktiviertem JavaScript entfällt diese zusätzliche Frage.</p><p>Obwohl Spammer bestehende E-Mail-Listen mieten oder kaufen können, entscheiden viele sich eine Software als "E-Mail-Harvester" (oft auch "Spam Bots" genannt) einzusetzen, die E-Mail-Adressen auf Webseiten sucht. Diese "E-Mail-Harvester" arbeiten oft auf die gleiche Weise wie Suchmaschinen es tun und versuchen, jede E-Mail-Adresse, die sie im Internet finden, zu sammeln. Allerdings sind die Brute-Force-Algorithmen die sie verwenden nicht in der Lage, die einfache Frage oben zu beantworten.</p><p><a href="http://de.wikipedia.org/wiki/Spam" title="Artikel bei Wikipedia" target="_blank">Lesen Sie mehr über Spam und wie man es verhindern kann.</a></p>';
$GLOBALS['TL_LANG']['aeo']['success']             = 'Wir haben ihr E-Mail-Programm geöffnet. Wenn dies nicht geklappt hat, klicken sie bitte auf die E-Mail-Adresse: <a href="mailto:%s">%s</a>.';
?>
