<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Contact;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Toate')
                ->badge(Contact::count()),
            'new' => Tab::make('Noi')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Contact::STATUS_NEW))
                ->badge(Contact::where('status', Contact::STATUS_NEW)->count())
                ->badgeColor('danger'),
            'read' => Tab::make('Citite')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Contact::STATUS_READ))
                ->badge(Contact::where('status', Contact::STATUS_READ)->count())
                ->badgeColor('warning'),
            'replied' => Tab::make('Răspunse')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Contact::STATUS_REPLIED))
                ->badge(Contact::where('status', Contact::STATUS_REPLIED)->count())
                ->badgeColor('success'),
        ];
    }
}
