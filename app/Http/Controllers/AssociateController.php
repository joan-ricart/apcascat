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
        $name = $request->get('name');

        $associates = Associate::where('active', true)
            ->when($province, function ($query, $province) {
                return $query->where('province', 'like', "%{$province}%");
            })
            ->when($specialty, function ($query, $specialty) {
                return $query->whereJsonContains('specialties', [['nombre' => $specialty]]);
            })
            ->when($name, function ($query, $name) {
                return $query->where(function ($query) use ($name) {
                    $query->whereRaw('LOWER(first_name) like ?', ["%" . strtolower($name) . "%"])
                        ->orWhereRaw('LOWER(last_name) like ?', ["%" . strtolower($name) . "%"])
                        ->orWhereRaw('LOWER(city) like ?', ["%" . strtolower($name) . "%"])
                        ->orWhereRaw('LOWER(province) like ?', ["%" . strtolower($name) . "%"]);
                });
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
            'name' => $name,
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
