<?php


namespace Modules\AdminStatuses\Services;

use Modules\AdminStatuses\Entities\Status;
use Modules\AdminStatuses\Entities\StatusCategory;
use Modules\AdminStatuses\Entities\StatusType;

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
        return $status->delete();
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
        return $statusType->delete();
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
