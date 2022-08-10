<?php

namespace App\Repositories;

use App\Http\Resources\ReturningResource;
use App\Models\Asset;
use App\Models\Assignment;
use App\Models\Returning;
use App\Repositories\BaseRepository;



class ManageReturningRepository extends BaseRepository
{
    public function __construct()
    {
        $this->query = Returning::query();
    }

    public function getAll($request)
    {
        $data = $this->query
            ->search($request)
            ->filterByState($request)
            ->filterByDate($request)
            ->sortByNo($request)
            ->sortByAssetCode($request)
            ->sortByAssetName($request)
            ->sortByRequestedBy($request)
            ->sortByAssignedDate($request)
            ->sortByAcceptedBy($request)
            ->sortByReturnedDate($request)
            ->sortByState($request);

        return ReturningResource::collection($data->paginate(config('app.limit')));
    }

    public function update($request, $id)
    {
        if ($request->state != 1) {
            return response()->json(['message' => 'You can not update this returning!'], 422);
        }

        $returning = Returning::query()->findOrFail($id);
        $assignment = Assignment::query()->findOrFail($returning->assignment_id);
        $asset = Asset::query()->findOrFail($assignment->asset_id);

        // update state returning = completed
        $returning->update([
                                'state' => Returning::COMPLETED,
                                'returned_date' => \Carbon\Carbon::now()->format('Y-m-d')
                            ]);

        // update asset state = available
        $asset->update(['state' => Asset::AVAILABLE_STATE]);

        // update assignment state = completed to remove from assignment list
        $assignment->update(['state' => Assignment::COMPLETED]);

        return response()->json([
            'message' => 'Returning updated successfully'
        ], 200);
    }

}
