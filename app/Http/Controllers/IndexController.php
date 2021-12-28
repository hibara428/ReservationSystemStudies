<?php

namespace App\Http\Controllers;

use App\Models\Store;

class IndexController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stores = Store::select(['id', 'name'])->get();

        $links = [];
        foreach ($stores as $store) {
            $links[] = [
                'href' => url('/stores/' . $store->id),
                'name' => $store->name,
            ];
        }
        return view('index', [
            'links' => $links,
        ]);
    }
}
