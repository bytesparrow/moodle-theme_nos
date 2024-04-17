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

namespace theme_nos\output;

use moodle_url;
use html_writer;
use get_string;


/**
 * Adds a dummy content to main. Used some day later...
 *
 * @package    theme_nos
 * @copyright   2022 Bernhard Strehl <moodle@software.bernhard-strehl.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_modifier extends \core_modifier_base {

    public function get_content_to_attach_to_main() {
        return '<!--<span style="background:orange">Injected aus Theme "nos"!!</span><hr>-->';
    }
}
