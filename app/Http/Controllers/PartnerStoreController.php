<?php

namespace App\Http\Controllers;

use App\Models\PartnerStore;
use Illuminate\Http\Request;

class PartnerStoreController extends Controller
{
    public function index()
    {
        $stores = PartnerStore::latest()->paginate(10);
        return view('partner-stores.index', compact('stores'));
    }

    public function create()
    {
        return view('partner-stores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'product_link' => 'required|url|max:255'
        ]);

        PartnerStore::create($request->all());

        return redirect()->route('partner-stores.index')
            ->with('success', 'Partner store created successfully.');
    }

    public function show(PartnerStore $partnerStore)
    {
        return view('partner-stores.show', compact('partnerStore'));
    }

    public function edit(PartnerStore $partnerStore)
    {
        return view('partner-stores.edit', compact('partnerStore'));
    }

    public function update(Request $request, PartnerStore $partnerStore)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'product_link' => 'required|url|max:255'
        ]);

        $partnerStore->update($request->all());

        return redirect()->route('partner-stores.index')
            ->with('success', 'Partner store updated successfully.');
    }

    public function destroy(PartnerStore $partnerStore)
    {
        $partnerStore->delete();

        return redirect()->route('partner-stores.index')
            ->with('success', 'Partner store deleted successfully.');
    }
} 