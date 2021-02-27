<?php


namespace App\Http\Services;

use App\Model\Status\Status;
use App\Model\Status\StatusCategory;
use App\Model\Status\StatusType;

class StatusService
{
    public function createStatus(array $data) : Status
    {
        return Status::create($data);
    }

    public function updateStatus(array $data, Status $status) : Status
    {
        $status->update($data);

        return $status;
    }

    public function deleteStatus(Status $status) : bool
    {
        // todo mb soft delete and transfer all relations to delete status
    }

    public function createStatusType(array $data) : StatusType
    {
        return StatusType::create($data);
    }

    public function updateStatusType(array $data, StatusType $statusType) : StatusType
    {
        $statusType->update($data);

        return $statusType;
    }

    public function deleteStatusType(StatusType $statusType) : bool
    {
        // todo mb soft delete and transfer all relations to delete status
    }

    public function createStatusCategory(array $data) : StatusCategory
    {
        return StatusCategory::create($data);
    }

    public function updateStatusCategory(array $data, StatusCategory $statusCategory) : StatusCategory
    {
        $statusCategory->update($data);

        return $statusCategory;
    }

    public function deleteStatusCategory(StatusCategory $statusCategory) : bool
    {
        // todo mb soft delete and transfer all relations to delete status
    }
}
