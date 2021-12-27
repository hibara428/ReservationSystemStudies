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
        $links = [];
        $stores = Store::all();
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
