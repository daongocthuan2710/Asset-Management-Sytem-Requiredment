<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\Assignment;
use App\Models\Returning;
use App\Models\User;
use App\Repositories\ManageReturningRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class ManageReturningService extends BaseService
{
    protected $manageReturningRepository;
    public function __construct(ManageReturningRepository $manageReturningRepository)
    {
        $this->manageReturningRepository = $manageReturningRepository;
    }

    public function getAll($request)
    {
        return $this->manageReturningRepository->getAll($request);
    }

    public function update($request, $id)
    {
        //check request data
        $sanctumUser = auth('sanctum')->user();

        //if returning is not existed
        $returning = Returning::find($id);
        if (!$returning) {
            return response()->json([
                'message' => 'Returning not found'
            ], 404);
        }
        //if user is not existed
        $user = User::query()->find($returning->requested_by);
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        //if admin is not existed
        $admin = User::query()->find($returning->accepted_by);
        if (!$admin) {
            return response()->json([
                'message' => 'Admin not found'
            ], 404);
        }

        //if assignment is not existed
        $assignment = Assignment::query()->find($returning->assignment_id);
        if (!$assignment) {
            return response()->json([
                'message' => 'Assignment not found'
            ], 404);
        }
        //if asset is not existed
        $asset = Asset::query()->find($assignment->asset_id);
        if (!$asset) {
            return response()->json([
                'message' => 'Asset not found'
            ], 404);
        }
        //if user is not in the same location
        if ($user->location != $sanctumUser->location) {
            return response()->json(
                [
                    "message" => "You can't complete returning having asset in other location",
                ],
                400
            );
        }
        //if asset is not available
        if ($asset->state !== 1 && $asset->id != $assignment->asset_id) {
            return response()->json(
                [
                    "message" => "Asset is not available",
                ],
                400
            );
        }
        //if user is disable
        if ($user->state === -1) {
            return response()->json(
                [
                    "message" => "User is disabled",
                ],
                400
            );
        }

        if ($admin->state === -1) {
            return response()->json(
                [
                    "message" => "User is disabled",
                ],
                400
            );
        }
        if (
            $this->checkPermission($request, $sanctumUser, $returning, $assignment, $asset, $admin, $user)
            !== null
        ) {
            return $this->checkPermission($request, $sanctumUser, $returning, $assignment, $asset, $admin, $user);
        } else {
            return $this->manageReturningRepository->update($request, $id);
        }
    }

    public function checkPermission($request, $sanctumUser, $returning, $assignment, $asset, $admin, $user)
    {
        //check location
        if (
            ($sanctumUser->location !== $user->location)
            || ($sanctumUser->location !== $admin->location)
            || ($sanctumUser->location !== $asset->location)
        ) {
            return response()->json(['message' => 'You cannot accept the returning having asset in other location!'], 401);
        }
        //check state of returning
        if (!$request->destroy) {
            if ($returning->state !== 0) {
                return response()->json(['message' => 'You cannot accept this returning!'], 422);
            }
        } else {
            if ($returning->state === 1) {
                return response()->json(['message' => 'You cannot delete accepted this returning!'], 422);
            }
        }
        return null;
    }

    public function delete($id)
    {
        //check request data
        $sanctumUser = auth('sanctum')->user();

        //if returning is not existed
        $returning = Returning::find($id);
        if (!$returning) {
            return response()->json([
                'message' => 'Returning not found'
            ], 404);
        }
        //if user is not existed
        $user = User::query()->find($returning->requested_by);
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        //if admin is not existed
        $admin = User::query()->find($returning->accepted_by);
        if (!$admin) {
            return response()->json([
                'message' => 'Admin not found'
            ], 404);
        }

        //if assignment is not existed
        $assignment = Assignment::query()->find($returning->assignment_id);
        if (!$assignment) {
            return response()->json([
                'message' => 'Assignment not found'
            ], 404);
        }
        //if asset is not existed
        $asset = Asset::query()->find($assignment->asset_id);
        if (!$asset) {
            return response()->json([
                'message' => 'Asset not found'
            ], 404);
        }
        //if user is not in the same location
        if ($user->location != $sanctumUser->location) {
            return response()->json(
                [
                    "message" => "You can't delete returning having asset in other location",
                ],
                400
            );
        }
        //if asset is not available
        if ($asset->state !== 1 && $asset->id != $assignment->asset_id) {
            return response()->json(
                [
                    "message" => "Asset is not available",
                ],
                400
            );
        }
        //if user is disable
        if ($user->state === -1) {
            return response()->json(
                [
                    "message" => "User is disabled",
                ],
                400
            );
        }

        if ($admin->state === -1) {
            return response()->json(
                [
                    "message" => "User is disabled",
                ],
                400
            );
        }

        //check location
        if (
            ($sanctumUser->location !== $user->location)
            || ($sanctumUser->location !== $admin->location)
            || ($sanctumUser->location !== $asset->location)
        ) {
            return response()->json(['message' => 'You cannot delete the returning having asset in other location!'], 401);
        }
        //check state of returning
        if ($returning->state === 1) {
            return response()->json(['message' => 'You cannot delete this completed returning!'], 422);
        }

        return $this->manageReturningRepository->delete($id);
    }
}
