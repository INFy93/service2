<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Status;

use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

/**
 * @extends ModelResource<Status>
 */
class StatusResource extends ModelResource
{
    protected string $model = Status::class;

    protected string $title = 'Статусы';

    protected string $sortDirection = 'ASC';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;
    public function fields(): array
    {
        return [
            Block::make([
                Text::make('ID статуса', 'status_id'),
                Text::make('Название', 'name'),
                Text::make('Цвет', 'color')
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
