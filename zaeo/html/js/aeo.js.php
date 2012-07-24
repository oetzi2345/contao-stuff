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
function aeo_onmouseover(anchor) {
	if (anchor.getAttribute('title') == tooltip_js_off) { // Set custom tooltip if specified
		anchor.setAttribute('title',tooltip_js_on);
		aeo_decode(anchor); // Encode links when hovered (so that the address appears correctly in the browser's status bar)
	}
}

function aeo_decode(anchor) { // function to recompose the orginal address
	var href = anchor.getAttribute('href');
	var address = href.replace(/.*<?=urldecode(strstr($_GET['folder'], '\\\\') ? stripslashes($_GET['folder']) : $_GET['folder'])?>\/aeo\/([a-z0-9._%-]+)\+([a-z0-9._%-]+)\+([a-z.]+)\+[0-9]+\..*/i, '$1' + '@' + '$2' + '.' + '$3');
	var linktext = anchor.innerHTML; // IE Fix
	if (href != address) {
		anchor.setAttribute('href','mailto:' + (rot13 ? str_rot13(address,map) : address)); // Add mailto link	
		anchor.innerHTML = linktext; // IE Fix
	}
}

var rot13 = <?=$_GET['rot13']?>;
if (rot13) // Initiate ROT13 only if needed
	var map = rot13init();
var tooltip_js_on = '<?=urldecode(stripslashes($_GET['tooltip_js_on']))?>';
var tooltip_js_off = '<?=urldecode(stripslashes($_GET['tooltip_js_off']))?>';

function rot13init() {
	var map = new Array();
	var s = "abcdefghijklmnopqrstuvwxyz";
	for (var i = 0 ; i < s.length ; i++)
		map[s.charAt(i)] = s.charAt((i+13)%26);
	for (var i = 0 ; i < s.length ; i++)
		map[s.charAt(i).toUpperCase()] = s.charAt((i+13)%26).toUpperCase();
	return map;
}

function str_rot13(a,map) {
	var s = "";
	for (var i = 0 ; i < a.length ; i++) {
		var b = a.charAt(i);
		s += (b>='A' && b<='Z' || b>='a' && b<='z' ? map[b] : b);
	}
	return s;
}