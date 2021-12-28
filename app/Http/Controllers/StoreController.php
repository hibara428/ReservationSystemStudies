<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $store_id = $request->route('id');
        if (!$store_id) {
            abort(404);
        }

        $store = Store::find($store_id);
        if (!$store) {
            abort(400);
        }

        return view('store', [
            'store' => $store,
        ]);
    }
}
