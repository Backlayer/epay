<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $websites = Website::where('user_id', auth()->id())->latest()->paginate();
        return view('user.websites.index', compact('websites'));
    }

    public function create()
    {
        return view('user.websites.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'merchant_name' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'mode' => 'required|boolean',
            'message' => 'nullable|string|max:1000',
        ]);

        Website::create($request->all() + [
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'redirect' => route('user.websites.index'),
            'message' => __('Website created successfully.')
        ]);
    }

    public function show(Request $request, Website $website)
    {
        abort_if($website->user_id !== \Auth::id(), 404);
        $search = $request->get('search');
        $orders = $website->orders()
            ->when(!is_null($search), function (Builder $builder) use ($search){
                $builder->where('trx', 'LIKE', '%'.$search.'%')
                    ->orWhere('reference_code', 'LIKE', '%'.$search.'%');
            })
            ->with('website', 'currency', 'gateway')
            ->latest()
            ->paginate();

        return view('user.websites.transactions', compact('website', 'orders'));
    }

    public function testTransactions(Website $website)
    {
        abort_if($website->user_id !== \Auth::id(), 404);
        $orders = $website->testOrders()
            ->with('website', 'currency', 'gateway')
            ->latest()
            ->paginate();

        return view('user.websites.testTransactions', compact('website', 'orders'));
    }

    public function edit(Website $website)
    {
        abort_if($website->user_id !== \Auth::id(), 404);
        return view('user.websites.edit', compact('website'));
    }

    public function update(Request $request, Website $website)
    {
        abort_if($website->user_id !== \Auth::id(), 404);
        $request->validate([
            'merchant_name' => 'required|string|max:100',
            'message' => 'nullable|string|max:1000',
            'email' => 'nullable|email|max:100',
            'mode' => 'required|boolean',
        ]);

        $website->update($request->all() + [
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'redirect' => route('user.websites.index'),
            'message' => __('Website updated successfully.')
        ]);
    }

    public function destroy(Website $website)
    {
        abort_if($website->user_id !== \Auth::id(), 404);
        $website->delete();
        return response()->json([
            'redirect' => route('user.websites.index'),
            'message' => __('Website deleted successfully.')
        ]);
    }

    public function live(Website $website)
    {
        abort_if($website->user_id !== \Auth::id(), 404);
        if ($website->mode){
            return response()->json([
                'message' => __('Website is already live')
            ], 403);
        }

        $website->update([
            'mode' => true
        ]);

        return response()->json([
            'message' => __('Your website is now live!'),
            'redirect' => route('user.websites.index')
        ]);
    }

    public function documentation()
    {
        $charge = get_option('merchant_charge');
        return view('user.websites.documentation', compact('charge'));
    }
}
