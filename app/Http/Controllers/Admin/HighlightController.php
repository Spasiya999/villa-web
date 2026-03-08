<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Highlight;
use Illuminate\Http\Request;

class HighlightController extends Controller
{
    /**
     * Display a listing of highlights.
     */
    public function index()
    {
        $highlights = Highlight::getAllOrdered();
        return view('admin.highlights.index', compact('highlights'));
    }

    /**
     * Show the form for creating a new highlight.
     */
    public function create()
    {
        return view('admin.highlights.create');
    }

    /**
     * Store a newly created highlight in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:100',
            'label' => 'required|string|max:255',
            'sublabel' => 'nullable|string|max:255',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        Highlight::create($validated);

        return redirect()->route('admin.highlights.index')
            ->with('success', 'Highlight created successfully!');
    }

    /**
     * Show the form for editing the specified highlight.
     */
    public function edit(Highlight $highlight)
    {
        return view('admin.highlights.edit', compact('highlight'));
    }

    /**
     * Update the specified highlight in storage.
     */
    public function update(Request $request, Highlight $highlight)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:100',
            'label' => 'required|string|max:255',
            'sublabel' => 'nullable|string|max:255',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $highlight->update($validated);

        return redirect()->route('admin.highlights.index')
            ->with('success', 'Highlight updated successfully!');
    }

    /**
     * Remove the specified highlight from storage.
     */
    public function destroy(Highlight $highlight)
    {
        $highlight->delete();

        return redirect()->route('admin.highlights.index')
            ->with('success', 'Highlight deleted successfully!');
    }

    /**
     * Update the order of highlights.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'highlights' => 'required|array',
            'highlights.*.id' => 'required|exists:highlights,id',
            'highlights.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->highlights as $item) {
            Highlight::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }
}
