<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ActivityLogService
{
    /**
     * Log an activity.
     *
     * @param string $action
     * @param string $description
     * @param string|null $model
     * @param int|null $modelId
     * @param Request|null $request
     * @return ActivityLog
     */
    public function log(
        string $action,
        string $description,
        ?string $model = null,
        ?int $modelId = null,
        ?Request $request = null
    ): ActivityLog {
        $request = $request ?? request();

        return ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'description' => $description,
            'model' => $model,
            'model_id' => $modelId,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }

    /**
     * Log food creation.
     *
     * @param int $foodId
     * @param string $foodName
     * @return ActivityLog
     */
    public function logFoodCreated(int $foodId, string $foodName): ActivityLog
    {
        return $this->log(
            'create',
            "Created food item: {$foodName}",
            'Makanan',
            $foodId
        );
    }

    /**
     * Log food update.
     *
     * @param int $foodId
     * @param string $foodName
     * @return ActivityLog
     */
    public function logFoodUpdated(int $foodId, string $foodName): ActivityLog
    {
        return $this->log(
            'update',
            "Updated food item: {$foodName}",
            'Makanan',
            $foodId
        );
    }

    /**
     * Log food deletion.
     *
     * @param int $foodId
     * @param string $foodName
     * @return ActivityLog
     */
    public function logFoodDeleted(int $foodId, string $foodName): ActivityLog
    {
        return $this->log(
            'delete',
            "Deleted food item: {$foodName}",
            'Makanan',
            $foodId
        );
    }

    /**
     * Log bulk deletion.
     *
     * @param int $count
     * @return ActivityLog
     */
    public function logBulkDelete(int $count): ActivityLog
    {
        return $this->log(
            'bulk_delete',
            "Bulk deleted {$count} food items"
        );
    }

    /**
     * Get recent activities.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecentActivities(int $limit = 50)
    {
        return ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get activities for a specific user.
     *
     * @param int $userId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserActivities(int $userId, int $limit = 50)
    {
        return ActivityLog::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
