<?php

namespace App\Services;

class NotificationService
{

    /**
     * @return object
     */
    public function getContentNotificationByGroup($action, $groupName, $userId)
    {
        $message = __('notification.' . $action);

        return [
            'message' => $message . $groupName,
            'userId' => $userId,
            'read' => false,
        ];
    }

    public function getContentNotification($action, $userId)
    {
        return [
            'message' => __('notification.' . $action),
            'userId' => $userId,
            'read' => false,
        ];
    }
}
