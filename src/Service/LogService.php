<?php

namespace App\Service;

use App\Entity\Log;
use App\Model\LogListItem;
use App\Model\LogListResponse;
use App\Repository\LogRepository;
use Doctrine\Common\Collections\Criteria;

class LogService
{
    public function __construct(private LogRepository $logRepository)
    {
    }

    public function getFiles(): LogListResponse
    {
        $files = $this->logRepository->findBy([], ['date' => Criteria::ASC]);
        $items = array_map(
            [$this, 'map'],
            $files
        );

        return new LogListResponse($items);
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
