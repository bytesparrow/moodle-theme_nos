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
 * Theme NOS - Version file
 *
 * @package    theme_nos
 * @copyright  2024 Bernhard Strehl <moodle@bytesparrow.de>
 *             based on  2023 Daniel Poggenpohl <daniel.poggenpohl@fernuni-hagen.de> and Alexander Bias <bias@alexanderbias.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->component = 'theme_nos';
$plugin->version = 2024112900;
$plugin->requires = 2024042200;
$plugin->supported = [404, 404];
$plugin->dependencies = [
  'theme_boost_union' => 2023102038,
  'theme_boost' => 2023042400,
  'theme_h5peventsystem' => 2024041700,
  'theme_contentmodifier' => 2024041700];
$plugin->maturity = MATURITY_ALPHA;