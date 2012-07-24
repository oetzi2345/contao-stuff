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
$GLOBALS['TL_LANG']['FMD']['aeo']                 = array('Advanced eMail Obfuscation', 'Creates a form for decryption of e-mail addresses for front-end users without JavaScript.');

/**
 * content Elements
 */
$GLOBALS['TL_LANG']['CTE']['aeo']                 = array('Advanced eMail Obfuscation', 'Creates a form for decryption of e-mail addresses for front-end users without JavaScript.');

/**
 * errors
 */
$GLOBALS['TL_LANG']['aeo']['aeo_error_duplicate'] = 'Advanced eMail Obfuscation: There is a duplicate entry in field %s.';
$GLOBALS['TL_LANG']['aeo']['aeo_error_redirect']  = 'Advanced eMail Obfuscation: Please make sure that the redirect pages all include a module or content element of type "Advanced eMail Obfuscation".';

/**
 * others
 */
$GLOBALS['TL_LANG']['aeo']['tooltip_no_js']       = 'Since you have disabled JavaScript, you have to answer a simple question, to open your e-mail program automatically.';
$GLOBALS['TL_LANG']['aeo']['tooltip_js']          = 'send email';

$GLOBALS['TL_LANG']['aeo']['buttonLabel']         = 'Open email programm';
$GLOBALS['TL_LANG']['aeo']['info']                = '<h2>Why must I answer this question?</h2><p>The aim of this check is to protect the owner of the e-mail address from receiving unsolicited e-mail.</p><p>Since you have not activated JavaScript, we check by this security question whether you really are human. With JavaScript enabled this additional question will not show.</p><p>Although spammers can rent or buy existing e-mail lists, many opt to use software known as \'e-mail harvesters\' (often referred to as \'spam bots\') that extract e-mail addresses from web pages. These e-mail harvesters work very much the same way search engine spiders do and try to collect every e-mail adress they encounter on the web. However, the brute force algorithms they use, are not able to answer the simple question above.</p><p><a href="http://en.wikipedia.org/wiki/E-mail_spam" title="Article on Wikipedia" target="_blank">Read more about spam and how to prevent it.</a></p>';
$GLOBALS['TL_LANG']['aeo']['success']             = 'We\'ve opened up your e-mail program. If that didn\'t work, please click <a href="mailto:%s">%s</a>.';
?>
