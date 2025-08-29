<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Associate;

class SyncAssociates implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): int
    {
        $res = Http::withOptions([
            'verify' => false,
        ])->get('https://intranet.apcas.es/ajax/listarPeritos.htm');

        if ($res->failed()) {
            echo "Something went wrong.\n";
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

        // \Log::info($newAssociates);

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

        return 0;
    }
}
