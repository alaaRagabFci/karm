<?php
namespace App\Constants;

/**
 * @package User
 * @author Alaa <alaaragab34@gmail.com>
 * UserRole
 */
class UserRole {
    /**
     * @const DRIVER
     */
    const DRIVER = 'Driver';

    /**
     * @const CASHAIR
     */
    const CASHAIR = 'Cashair';

    /**
     * Get user role
     * @author Alaa <alaaragab34@gmail.com>
     *
     * @return array
     */
    public static function getUserRole() {
        return array(
            self::DRIVER => self::DRIVER,
            self::CASHAIR => self::CASHAIR
        );
    }
}