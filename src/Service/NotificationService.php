<?php

namespace App\Service;

use App\Entity\Notification;
use App\Model\NotificationListItem;
use App\Model\NotificationListResponse;
use App\Repository\NotificationRepository;
use Symfony\Bundle\SecurityBundle\Security;

class NotificationService
{
    public function __construct(
        private Security $security,
        private NotificationRepository $notificationRepository
    ) {
    }

    public function createNewNotification(string $filename): void
    {
        $user = $this->security->getUser();

        $notification = (new Notification())
            ->setUser($user)
            ->setText('File'.$filename.'uploaded');

        $this->notificationRepository->save($notification, true);
    }

    public function getNotifications(): NotificationListResponse
    {
        return new NotificationListResponse(
            array_map([$this, 'map'],
                $this->notificationRepository->findUserNotifications($this->security->getUser()))
        );
    }

    private function map(Notification $notification): NotificationListItem
    {
        return (new NotificationListItem())
            ->setUsername($notification->getUser()->getUsername())
            ->setText($notification->getText());
    }
}
