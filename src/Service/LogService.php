<?php

namespace App\Service;

use App\Entity\Log;
use App\Model\LogListItem;
use App\Model\LogListResponse;
use App\Repository\LogRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\SecurityBundle\Security;

class LogService
{
    public function __construct(
        private LogRepository $logRepository,
        private Security $security)
    {
    }

    public function getAdminLogs(): LogListResponse
    {
        $files = $this->logRepository->findBy([], ['date' => Criteria::ASC]);
        $items = array_map(
            [$this, 'map'],
            $files
        );

        return new LogListResponse($items);
    }

    public function getUserLogs(): LogListResponse
    {
        return new LogListResponse(
            array_map([$this, 'map'],
                $this->logRepository->findUserLogs($this->security->getUser()))
        );
    }

    private function map(Log $log): LogListItem
    {
        return (new LogListItem())
            ->setId($log->getId())
            ->setUser($log->getUser()->getUsername())
            ->setDate($log->getDate()->getTimestamp())
            ->setOperation($log->getLogOperation()->getName());
    }
}
