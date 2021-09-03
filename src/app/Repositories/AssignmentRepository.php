<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AssignmentRepository.
 *
 * @package namespace App\Repositories;
 */
interface AssignmentRepository extends RepositoryInterface
{
    public function dataTables();
    public function exportDataInCSV($param);
    public function exportDataInXML($param);
}

