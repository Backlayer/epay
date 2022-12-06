<?php

namespace App\Http\Controllers\User;

use App\Helpers\HasUploader;
use App\Http\Controllers\Controller;
use App\Models\Support;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupportController extends Controller
{
    use HasUploader;

    public function index()
    {
        $tickets = Support::whereUserId(Auth::id())->latest()->paginate();
        return view('user.supports.index', compact('tickets'));
    }

    public function create()
    {
        return view('user.supports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'reference_code' => ['nullable', 'string', 'max:255'],
            'priority' => ['required', Rule::in(['Low','Medium','High'])],
            'type' => [
                'required',
                Rule::in(["subscription","money_transfer","request_money","settlement","store","single_charge",
                    "donation","invoice","charges","bank_transfer","deposit","virtual_card","bill_payment",
                    "crypto_currency","others"
                ])
            ],
            'details' => ['required', 'string', 'max:1000'],
            'image' => ['required', 'array'],
            'image.*' => ['required', 'image', 'max:2048'], // Each image 2MB
        ]);

        $images = [];
        foreach ($request->image as $key => $image) {
            $images[] = $this->upload($request, 'image.'.$key);
        }

        Support::create([
                'images' => $images,
                'user_id' => Auth::id()
            ] + $validated);

        return response()->json([
            'message' => __('Support Ticket Created Successfully'),
            'redirect' => route('user.supports.index')
        ]);
    }

    public function show(Support $support)
    {
        abort_if($support->user_id !== Auth::id(), 404);
        return view('user.supports.show', compact('support'));
    }

    public function update(Request $request, Support $support)
    {
        if (!$support->status){
            return $request->wantsJson() ?
                response()->json([
                    'message' => __('Ticket status has been closed'),
                    'redirect' => route('user.supports.show', $support->id)
                ], 403)
                : to_route('user.supports.show', $support->id)->with('error', __('Ticket status has been closed'));
        }
        $request->validate([
            'comment' => ['required', 'string', 'max:1000']
        ]);

        $support->meta()->create([
            'comment' => $request->input('comment'),
            'type' => 0,
            'sender_id' => Auth::id()
        ]);

        return redirect()->back()->with('success', __('Reply Sent Successfully'));
    }

    public function destroy(Support $support)
    {
        abort_if($support->user_id !== Auth::id(), 404);
        $support->delete();

        return redirect()->back()->with('success', __('Ticket Deleted Successfully'));
    }
}
