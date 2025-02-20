<?php

/* ----------------------------------------------------------------------------
 * Car2dude - Open Source Web Scheduler
 *
 * @package     EasyAppointments
 * @author      A.Tselegidis <alextselegidis@gmail.com>
 * @copyright   Copyright (c) 2013 - 2020, Alex Tselegidis
 * @license     http://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        http://easyappointments.org
 * @since       v1.2.0
 * ---------------------------------------------------------------------------- */

namespace EA\Engine\Types;

/**
 * Class Email
 *
 * @deprecated
 *
 * @package EA\Engine\Types
 */
class Email extends NonEmptyText {
    /**
     * @param mixed $value
     * @return bool
     */
    protected function validate($value)
    {
        return parent::validate($value) && filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
