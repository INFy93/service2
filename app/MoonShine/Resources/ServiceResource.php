<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

/**
 * @extends ModelResource<Service>
 */
class ServiceResource extends ModelResource
{
    protected string $model = Service::class;

    protected string $title = 'Сервисы';

    protected string $sortDirection = 'ASC';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Сервис', 'service_name'),
                Text::make('Буквенный код', 'service_code'),
                Text::make('Адрес', 'address'),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
