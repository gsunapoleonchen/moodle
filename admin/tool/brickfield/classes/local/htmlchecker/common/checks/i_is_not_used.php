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

namespace tool_brickfield\local\htmlchecker\common\checks;

use tool_brickfield\local\htmlchecker\common\brickfield_accessibility_test;

/**
 * Brickfield accessibility HTML checker library.
 *
 * 'i' (italic) element is not used.
 * This error will be generated for all i elements.
 *
 * @package    tool_brickfield
 * @copyright  2020 onward: Brickfield Education Labs, www.brickfield.ie
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class i_is_not_used extends brickfield_accessibility_test {

    /** @var int The default severity code for this test. */
    public $defaultseverity = \tool_brickfield\local\htmlchecker\brickfield_accessibility::BA_TEST_SEVERE;

    /** @var string The tag this test will fire on. */
    public $tag = 'i';

    /**
     * Check for any i elements and flag them as errors
     * while allowing font awesome icons to be used.
     */
    public function check(): void {
        foreach ($this->get_all_elements('i') as $element) {
            // Ensure this is not a font awesome icon with aria-hidden.
            if (str_contains($element->getAttribute('class'), 'fa-') && $element->getAttribute('aria-hidden') === 'true') {
                continue;
            }
            $this->add_report($element);
        }
    }
}
