<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use App\Models\Setting;
use Filament\Notifications\Notification;

class SiteSettings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Configuració general';
    protected static ?string $title = 'Configuració general';
    protected static string $view = 'filament.pages.site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::first();

        // Initialize $data from database
        $this->form->fill([
            'data' => [
                'display_home_video' => $settings->display_home_video,
                'home_video_url'     => $settings->home_video_url,
            ]
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Toggle::make('data.display_home_video')
                ->label(__("Mostrar vídeo destacat a la home")),

            Forms\Components\TextInput::make('data.home_video_url')
                ->label(__("Enllaç del vídeo destacat de home"))
                ->url()
                ->nullable(),
        ];
    }

    public function submit(): void
    {
        $state = $this->form->getState()['data'];

        Setting::first()->update($state);

        Notification::make()
            ->title(__("Configuració guardada!"))
            ->success()
            ->send();
    }
}
