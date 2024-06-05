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
 * Theme NOS - Library
 *
 * @package    theme_nos
 * @copyright 2024 Bernhard Strehl <moodle@bytesparrow.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Constants which are use throughout this theme.
define('THEME_NOS_SETTING_INHERITANCE_INHERIT', 0);
define('THEME_NOS_INHERITANCE_DUPLICATE', 1);

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_nos_get_main_scss_content($theme) {
    global $CFG;

    // Require the necessary libraries.
    require_once($CFG->dirroot . '/theme/boost_union/lib.php');

    // As a start, get the compiled main SCSS from Boost Union.
    // This way, NOS will ship the same SCSS code as Boost Union itself.
    $scss = theme_boost_union_get_main_scss_content(theme_config::load('boost_union'));

    // And add NOS's main SCSS file to the stack.
    $scss .= file_get_contents($CFG->dirroot . '/theme/nos/scss/post.scss');

    return $scss;
}

/**
 * Get SCSS to prepend.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_nos_get_pre_scss($theme) {
    global $CFG;

    // Require the necessary libraries.
    require_once($CFG->dirroot . '/theme/boost_union/lib.php');

    // As a start, initialize the Pre SCSS code with an empty string.
    $scss = '';

    // Then, if configured, get the compiled pre SCSS code from Boost Union.
    // This should not be necessary as Moodle core calls the *_get_pre_scss() functions from all parent themes as well.
    // However, as soon as Boost Union would use $theme->settings in this function, $theme would be this theme here and
    // not Boost Union. The Boost Union developers are aware of this topic, but faults can always happen.
    // If such a fault happens, the NOS administrator can switch the inheritance to 'Duplicate'.
    // This way, we will add the pre SCSS code with the explicit use of the Boost Union configuration to the stack.
    $inheritanceconfig = get_config('theme_nos', 'prescssinheritance');
    if ($inheritanceconfig == THEME_NOS_INHERITANCE_DUPLICATE) {
        $scss .= theme_boost_union_get_pre_scss(theme_config::load('boost_union'));
        #todo: change to $scss .= theme_config::load('boost_union')->get_pre_scss_code()
    }

    // And add NOS's pre SCSS file to the stack.
    $scss .= file_get_contents($CFG->dirroot . '/theme/nos/scss/pre.scss');

    /**********************************************************
     * EXTENSION POINT:
     * Compose and add additional pre-SCSS code here.
     * It will be added on top of Boost Union's pre-SCSS code.
     *********************************************************/

    return $scss;
}

/**
 * Inject additional SCSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_nos_get_extra_scss($theme) {
    global $CFG;

    // Require the necessary libraries.
    require_once($CFG->dirroot . '/theme/boost_union/lib.php');

    // As a start, initialize the Extra SCSS code with an empty string.
    $scss = '';

    // Then, if configured, get the compiled extra SCSS code from Boost Union.
    // This should not be necessary as Moodle core calls the *_get_extra_scss() functions from all parent themes as well.
    // However, as soon as Boost Union would use $theme->settings in this function, $theme would be this theme here and
    // not Boost Union. The Boost Union developers are aware of this topic, but faults can always happen.
    // If such a fault happens, the NOS administrator can switch the inheritance to 'Duplicate'.
    // This way, we will add the extra SCSS code with the explicit use of the Boost Union configuration to the stack.
   $inheritanceconfig = get_config('theme_nos', 'extrascssinheritance');
    if ($inheritanceconfig == THEME_NOS_INHERITANCE_DUPLICATE) {
        $scss .= theme_config::load('boost_union')->get_extra_scss_code();
    }

    /**********************************************************
     * EXTENSION POINT:
     * Compose and add additional SCSS code here.
     * It will be added on top of Boost Union's SCSS code.
     *********************************************************/

    return $scss;
}

/**
 * Callback function for theme_nos to allow NOS to add cards to the Boost Union settings overview page.
 * This function is expected to return an array of arrays containing values with the keys 'label', 'desc', 'btn' and 'url'.
 *
 * @return array
 */
function theme_nos_extend_busettingsoverview() {

    $cards[] = [
        'label' => get_string('pluginname', 'theme_nos'),
        'desc' => get_string('settingsoverview_buc_desc', 'theme_nos'),
        'btn' => 'primary',
        'url' => new \moodle_url('/admin/settings.php', ['section' => 'theme_nos']),
    ];

    return $cards;
}
