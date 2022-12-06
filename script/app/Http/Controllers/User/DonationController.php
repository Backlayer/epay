<?php

namespace App\Http\Controllers\User;

use App\Helpers\HasUploader;
use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
    use HasUploader;
    public function index(Request $request)
    {
        $donations = Donation::whereUserId(\Auth::id())
            ->with('currency')
            ->latest()
            ->paginate();

        return view('user.donations.index', compact('donations'));
    }

    public function create()
    {
        $charge = get_option('charges')['donation_charge'] ?? ['rate' => 0, 'type' => 'percentage'];
        return view('user.donations.create', compact('charge'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'gaol' => ['nullable', 'numeric'],
            'image' => ['required', 'image','max:2048'], // 2MB
            'description' => ['required', 'string'],
        ]);

        Donation::create([
            'user_id' => \Auth::id(),
            'currency_id' => \Auth::user()->currency_id,
            'title' => $validated['title'],
            'amount' => $validated['gaol'],
            'image' => $this->upload($request, 'image'),
            'description' => $validated['description'],
            'status' => 1,
        ]);

        return response()->json([
            'message' => __('Payment Link Created Successfully'),
            'redirect' => route('user.donations.index')
        ]);
    }

    public function show(Donation $donation)
    {
        $orders = $donation->orders()->with('donation', 'currency')->latest()->paginate();
        return view('user.donations.show', compact('donation', 'orders'));
    }

    public function edit($id)
    {
        $charge = get_option('charges')['donation_charge'] ?? ['rate' => 0, 'type' => 'percentage'];
        $donation = Donation::whereUserId(auth()->id())->findOrFail($id);
        return view('user.donations.edit', compact('donation', 'charge'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'gaol' => ['nullable', 'numeric'],
            'image' => ['nullable', 'image','max:2048'], // 2MB
            'description' => ['required', 'string'],
        ]);

        $donation = Donation::whereUserId(auth()->id())->findOrFail($id);
        $donation->update([
            'title' => $validated['title'],
            'amount' => $validated['gaol'],
            'image' => $request->image ? $this->upload($request, 'image'):$donation->image,
            'description' => $validated['description'],
        ]);

        return response()->json([
            'message' => __('Payment Link Updated Successfully'),
            'redirect' => route('user.donations.index')
        ]);
    }

    public function destroy($id)
    {
        $donation = Donation::whereUserId(auth()->id())->findOrFail($id);
        $donation->delete();
        return response()->json([
            'redirect' => route('user.donations.index'),
            'message' => __('Donations has been deleted.')
        ]);
    }

    public function disable(Donation $charge)
    {
        abort_if(\Auth::id() !== $charge->user_id, 404);

        $charge->update([
            'status' => !$charge->status
        ]);

        $message = $charge->status ?
            __('Single Charge Link Has Been Activated') :
            __('Single Charge Link Has Been Disabled');

        return response()->json([
            'message' => $message,
            'redirect' => route('user.donations.index')
        ]);
    }

    public function getDonations()
    {
        $data['total'] = Donation::whereUserId(auth()->id())->count();
        $data['active'] = Donation::whereUserId(auth()->id())->whereStatus(1)->count();
        $data['paused'] = Donation::whereUserId(auth()->id())->whereStatus(0)->count();
        return response()->json($data);
    }
}
