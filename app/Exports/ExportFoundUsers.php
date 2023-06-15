<?php

namespace App\Exports;

use App\Http\Requests\FoundUsers\ExportRequest;
use App\Models\FoundUser;
use App\Models\SearchTask;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportFoundUsers implements FromQuery, WithHeadings
{
    use Exportable;

    protected string $taskUuid;

    public function __construct(ExportRequest $request)
    {
        $this->taskUuid = $request->get('task_id');
    }

    public function headings(): array
    {
        return [
            'VK ID',
            'Имя',
            'Фамилия',
            'Закрытый аккаунт',
            'Фотография пользователя'
        ];
    }

    /**
     * @return FoundUser|Builder
     */
    public function query(): FoundUser|Builder
    {
        $task = SearchTask::where('uuid', $this->taskUuid)->firstOrFail();
        return FoundUser::query()->select([
            'vk_id', 'first_name', 'last_name', 'is_closed', 'img_url'
        ])->where('task_id', $task->id);
    }
}
