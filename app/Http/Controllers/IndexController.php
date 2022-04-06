<?php

namespace App\Http\Controllers;

use App\Services\StoreService;
use Illuminate\Contracts\Support\Renderable;

class IndexController extends Controller
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
    public function __invoke()
    {
        return view('index', [
            'stores' => $this->storeService->getAllStores(),
        ]);
    }
}
