<?php

namespace App\Http\Controllers\Admin;

use App\Models\Moneyrequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class RequestMoneyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:money-requests-read')->only('index', 'show');
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $requests = Moneyrequest::with(['receiver', 'sender_currency', 'sender'])
                    ->when(!is_null($search), function (Builder $builder) use($search) {
                        $builder->WhereHas('sender', function (Builder $builder) use ($search){
                            $builder->where('name', 'LIKE', '%'.$search.'%')
                            ->orWhere('email', 'LIKE', '%'.$search.'%');
                        });
                    })
                    ->latest()
                    ->paginate();
        return view('admin.money-requests.index', compact('requests'));
    }

    public function show($id)
    {
        $request = Moneyrequest::with(['receiver', 'sender_currency', 'sender'])->findOrFail($id);
        return view('admin.money-requests.show', compact('request'));
    }

    public function getRequestMoney()
    {
        $data['total'] = Moneyrequest::count();
        $data['completed'] = Moneyrequest::whereStatus(1)->count();
        $data['pending'] = Moneyrequest::whereStatus(2)->count();
        $data['rejected'] = Moneyrequest::whereStatus(0)->count();
        return response()->json($data);
    }
}
