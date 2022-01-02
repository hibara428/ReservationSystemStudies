<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Services\StoreService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /** @var StoreService */
    protected $storeService;

    /**
     * Constructor.
     *
     * @param StoreService $storeService
     */
    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(Request $request)
    {
        $store_id = $request->route('id');
        $store = $this->storeService->getStore($store_id);
        if (!$store) {
            abort(404);
        }
        return view('store', [
            'store' => $store,
        ]);
    }
}
