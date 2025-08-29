<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Associate;

class AssociateController extends Controller
{
    function index(Request $request): View
    {
        $province = $request->get('province');
        $specialty = $request->get('specialty');

        $associates = Associate::where('active', true)
            ->when($province, function ($query, $province) {
                return $query->where('province', 'like', "%{$province}%");
            })
            ->when($specialty, function ($query, $specialty) {
                return $query->whereJsonContains('specialties', [['nombre' => $specialty]]);
            })
            ->orderBy('last_name')->get();

        $provinces = Associate::where('active', true)->distinct()->orderBy('province')->pluck('province')->filter();
        $specialties = Associate::where('active', true)->get()->pluck('specialties')->flatMap(function ($item) {
            return collect($item)->pluck('nombre');
        })->unique()->sort();

        return view('associates.index', [
            'associates' => $associates,
            'province' => $province,
            'specialty' => $specialty,
            'provinces' => $provinces,
            'specialties' => $specialties,
        ]);
    }

    function show(Associate $associate, Request $request): View
    {
        if (!$associate->active) {
            abort(404);
        }

        return view('associates.show', [
            'associate' => $associate
        ]);
    }
}
