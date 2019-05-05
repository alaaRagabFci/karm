<?php
namespace App\Constants;

/**
 * @package User
 * @author Alaa <alaaragab34@gmail.com>
 * UserStatus
 */
class UserStatus {
    /**
     * @const ACTIVE
     */
    const ACTIVE = 'Active';

    /**
     * @const BLOCKED
     */
    const BLOCKED = 'Blocked';

    /**
     * Get user role
     * @author Alaa <alaaragab34@gmail.com>
     *
     * @return array
     */
    public static function getUserStatus() {
        return array(
            self::ACTIVE => self::ACTIVE,
            self::BLOCKED => self::BLOCKED
        );
    }
}