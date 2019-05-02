<?php
namespace App\Constants;

/**
 * @package Notification
 * @author Alaa <alaaragab34@gmail.com>
 * NotificationType
 */
class NotificationType {
    /**
     * @const KARMLEVEL
     */
    const KARMLEVEL = 'KarmLevel';

    /**
     * @const NEWMESSAGE
     */
    const NEWMESSAGE = 'NewMessage';

    /**
     * Get notification type
     * @author Alaa <alaaragab34@gmail.com>
     *
     * @return array
     */
    public static function getNotificationType() {
        return array(
            self::KARMLEVEL => self::KARMLEVEL,
            self::NEWMESSAGE => self::NEWMESSAGE
        );
    }
}