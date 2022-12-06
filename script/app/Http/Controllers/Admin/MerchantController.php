<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Website;

class MerchantController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:merchants-read')->only('index', 'log');
    }
    public function index(Request $request)
    {
        $search = $request->get('search');

        $merchants = Website::withCount('orders')->with('user')
            ->when(!is_null($search), function (Builder $builder) use($search){
                $builder->whereHas('user', function (Builder $builder) use ($search){
                    $builder->where('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('username', 'LIKE', '%'.$search.'%')
                        ->orWhere('email', 'LIKE', '%'.$search.'%');
                });
            })
            ->latest()
            ->paginate();
        return view('admin.merchants.index', compact('merchants'));
    }

    public function log(Website $merchant)
    {
        $merchant->load(['orders' => ['website', 'currency']]);
        return view('admin.merchants.log', compact('merchant'));
    }
}
