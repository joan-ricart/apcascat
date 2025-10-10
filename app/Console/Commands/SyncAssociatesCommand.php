<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Associate;
use Illuminate\Support\Facades\Log;

class SyncAssociatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'associates:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncs associates from the external API';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        Log::info('Syncing associates...');
        $this->info('Syncing associates...');

        $res = Http::withOptions([
            'verify' => false,
        ])->get('https://intranet.apcas.es/ajax/listarPeritos.htm');

        if ($res->failed()) {
            Log::error('Failed to fetch associates from API.');
            $this->error('Failed to fetch associates from API.');
            return 1;
        }

        $updatedAssociates = $res->json();
        $newAssociates = collect([]);

        foreach ($updatedAssociates as $associate) {
            $first_name = trim($associate['nombre']);
            $last_name = trim($associate['apellidos']);

            $newAssociates->push([
                'slug' => Str::slug($first_name . ' ' . $last_name),
                'first_name' => $first_name,
                'last_name' => $last_name,
                'category' => $associate['categoria'],
                'city' => $associate['localidad'],
                'province' => $associate['provincia'],
                'phone' => $associate['telefono'],
                'fax' => $associate['fax'],
                'email' => $associate['email'],
                'photo' => $associate['foto'],
                'specialties' => json_encode($associate['especialidades']),
                'active' => json_encode($associate['infoContactoVisible']),
            ]);
        }

        Associate::upsert($newAssociates->toArray(), ['slug'], [
            'first_name',
            'last_name',
            'category',
            'city',
            'province',
            'phone',
            'fax',
            'email',
            'photo',
            'specialties'
        ]);

        Log::info('Successfully synced ' . $newAssociates->count() . ' associates.');
        $this->info('Successfully synced ' . $newAssociates->count() . ' associates.');
        return 0;
    }
}
