<?php


namespace App\repository;


use App\Models\Approval;
use Illuminate\Support\Facades\Log;

class ApprovalRepository
{
    public function save($managerId, $appealId, $comment, $status)
    {
        $approval = new Approval();
        $approval['manager_id'] = $managerId;
        $approval['appeal_id'] = $appealId;
        $approval['comment'] = $comment;
        $approval['status'] = $status;
        $approval->save();
        Log::info("Approval added:", ['comment' => $comment]);
    }

    public function hasEnoughApprovals($appealId)
    {
        $approvals = Approval::where('appeal_id', $appealId)->where('status', 'accepted')->get();
        return count($approvals) >= 3;
    }
}
