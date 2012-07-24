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
 * Hooks
 */
$GLOBALS['TL_HOOKS']['getFrontendModule'][] = array('AeoFrontendUtil', 'aeoGetFrontendModule');
$GLOBALS['TL_HOOKS']['getContentElement'][] = array('AeoFrontendUtil', 'aeoGetContentElement');
$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][] = array('AeoFrontendUtil', 'obfuscateEmails');
$GLOBALS['TL_HOOKS']['getPageIdFromUrl'][] = array('AeoRedirectUtil', 'getRedirectPageAeo');

/**
 * frontend moduls
 */
$GLOBALS['FE_MOD']['application']['aeo'] = 'AeoModule';

/**
 * content elements
 */
$GLOBALS['TL_CTE']['includes']['aeo'] = 'AeoContentElement';

/**
 * PageTypes
 */
$GLOBALS['TL_PTY']['root'] = 'PageRoot_Aeo';

?>
