<?php
namespace App\Constants;

/**
 * @package User
 * @author Alaa <alaaragab34@gmail.com>
 * OrderStatus
 */
class OrderStatus {
    /**
     * @const UNDER_PREPARING
     */
    const UNDER_PREPARING = 'Under_Preparing';

    /**
     * @const ONGOING
     */
    const ONGOING = 'Ongoing';

    /**
     * @const CANCELLED
     */
    const CANCELLED = 'Cancelled';

    /**
     * Get user role
     * @author Alaa <alaaragab34@gmail.com>
     *
     * @return array
     */
    public static function getOrderStatus() {
        return array(
            self::UNDER_PREPARING => self::UNDER_PREPARING,
            self::ONGOING => self::ONGOING,
            self::CANCELLED => self::CANCELLED
        );
    }
}