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
 * Theme NOS - Settings file
 *
 * @package    theme_nos
 * @copyright 2024 Bernhard Strehl <moodle@bytesparrow.de>
 *            based on  2023 Daniel Poggenpohl <daniel.poggenpohl@fernuni-hagen.de> and Alexander Bias <bias@alexanderbias.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig || has_capability('theme/boost_union:configure', context_system::instance())) {

    // How this file works:
    // Boost Union's settings are divided into multiple settings pages which resides in its own settings category.
    // You will understand it as soon as you look at /theme/boost_union/settings.php.
    // This settings file here is built in a way that it adds another settings page to this existing settings
    // category. You can add all child-theme-specific settings to this settings page here.

    // However, there is still the $settings variable which is expected by Moodle core to be filled with the theme
    // settings and which is automatically linked from the theme selector page.
    // To avoid that there appears a broken "NOS" settings page, we redirect the user to a settings
    // overview page if he opens this page.
    $mainsettingspageurl = new moodle_url('/admin/settings.php', ['section' => 'themesettingnos']);
    if ($ADMIN->fulltree && $PAGE->has_set_url() && $PAGE->url->compare($mainsettingspageurl)) {
        redirect(new moodle_url('/admin/settings.php', ['section' => 'theme_nos']));
    }

    // Create empty settings page structure to make the site administration work on non-admin pages.
    if (!$ADMIN->fulltree) {
        // Create NOS settings page
        // (and allow users with the theme/boost_union:configure capability to access it).
        $tab = new admin_settingpage('theme_nos',
                get_string('configtitle', 'theme_nos', null, true),
                'theme/boost_union:configure');
        $ADMIN->add('theme_boost_union', $tab);
    }

    // Create full settings page structure.
    // @codingStandardsIgnoreLine
    else if ($ADMIN->fulltree) {

        // Require the necessary libraries.
        require_once($CFG->dirroot . '/theme/boost_union/lib.php');
        require_once($CFG->dirroot . '/theme/boost_union/locallib.php');
        require_once($CFG->dirroot . '/theme/nos/lib.php');
        require_once($CFG->dirroot . '/theme/nos/locallib.php');

        // Prepare options array for select settings.
        // Due to MDL-58376, we will use binary select settings instead of checkbox settings throughout this theme.
        $yesnooption = [THEME_BOOST_UNION_SETTING_SELECT_YES => get_string('yes'),
                THEME_BOOST_UNION_SETTING_SELECT_NO => get_string('no'), ];


        // Create NOS settings page with tabs
        // (and allow users with the theme/boost_union:configure capability to access it).
        $page = new theme_boost_admin_settingspage_tabs('theme_nos',
                get_string('configtitle', 'theme_nos', null, true),
                'theme/boost_union:configure');


        // Create general settings tab.
        $tab = new admin_settingpage('theme_nos_general',
                get_string('generalsettings', 'theme_boost', null, true));

        // Create inheritance heading.
        $name = 'theme_nos/inheritanceheading';
        $title = get_string('inheritanceheading', 'theme_nos', null, true);
        $setting = new admin_setting_heading($name, $title, null);
        $tab->add($setting);

        // Prepare inheritance options.
        $inheritanceoptions = [
                THEME_NOS_SETTING_INHERITANCE_INHERIT =>
                        get_string('inheritanceinherit', 'theme_nos'),
                THEME_NOS_INHERITANCE_DUPLICATE =>
                        get_string('inheritanceduplicate', 'theme_nos'),
        ];

        // Setting: Pre SCSS inheritance setting.
        $name = 'theme_nos/prescssinheritance';
        $title = get_string('prescssinheritancesetting', 'theme_nos', null, true);
        $description = get_string('prescssinheritancesetting_desc', 'theme_nos', null, true).'<br />'.
                get_string('inheritanceoptionsexplanation', 'theme_nos', null, true);
        $setting = new admin_setting_configselect($name, $title, $description,
                THEME_NOS_SETTING_INHERITANCE_INHERIT, $inheritanceoptions);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $tab->add($setting);

        // Setting: Extra SCSS inheritance setting.
        $name = 'theme_nos/extrascssinheritance';
        $title = get_string('extrascssinheritancesetting', 'theme_nos', null, true);
        $description = get_string('extrascssinheritancesetting_desc', 'theme_nos', null, true).'<br />'.
                get_string('inheritanceoptionsexplanation', 'theme_nos', null, true);
        $setting = new admin_setting_configselect($name, $title, $description,
                THEME_NOS_SETTING_INHERITANCE_INHERIT, $inheritanceoptions);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $tab->add($setting);

        // Add tab to settings page.
        $page->add($tab);

        /**********************************************************
         * EXTENSION POINT:
         * Add your NOS settings here.
         *********************************************************/

        // Add settings page to the admin settings category.
        $ADMIN->add('theme_boost_union', $page);
    }
}
