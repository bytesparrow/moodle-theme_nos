<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme Nos - core_renderer class file
 *
 * @package    theme_nos
 * @copyright  2022 Bernhard Strehl <moodle@software.bernhard-strehl.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$THEME->name = 'nos';


######  See section "Duplicate the settings from Boost"
###### @ https://docs.moodle.org/dev/Creating_a_theme_based_on_boost 

$THEME->doctype = 'html5';
$THEME->parents = ['boost','boost_union','h5peventsystem', 'contentmodifier'];
$THEME->sheets = ['custom'];
$THEME->supportscssoptimisation = false;
$THEME->yuicssmodules = [];
$THEME->enable_dock = false;
$THEME->editor_sheets = [];

$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->requiredblocks = ''; #wichtig, sonst geht h5p nicht
$THEME->usefallback = true;
$THEME->haseditswitch = true;
// By default, all boost theme do not need their titles displayed.
$THEME->activityheaderconfig = [
    'notitle' => true
];
