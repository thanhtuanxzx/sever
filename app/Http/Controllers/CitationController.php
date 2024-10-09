<?php

namespace App\Http\Controllers;

use App\Models\Citation;
use Illuminate\Http\Request;

class CitationController extends Controller
{
    public function index()
    {
        $citations = Citation::all();
        return view('citations.index', compact('citations'));
    }

    public function create()
    {
        return view('citations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
        ]);
    
        // Tạo một trích dẫn mới
        Citation::create([
            'title' => $request->input('title'),
            'link' => $request->input('link'),
        ]);
    
        return redirect()->route('citations.index')->with('success', 'Trích dẫn đã được thêm thành công.');
    }

    public function show(Citation $citation)
    {
        return view('citations.show', compact('citation'));
    }

    public function edit(Citation $citation)
    {
        return view('citations.edit', compact('citation'));
    }

    public function update(Request $request, Citation $citation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
        ]);

        $citation->update($request->all());
        return redirect()->route('citations.index');
    }

    public function destroy(Citation $citation)
    {
        $citation->delete();
        return redirect()->route('citations.index');
    }
    public function storeMultiple(Request $request)
    {
        $titles = $request->input('title');
        $links = $request->input('link');

        foreach ($titles as $index => $title) {
            Citation::create([
                'title' => $title,
                'link' => $links[$index],
            ]);
        }

        return redirect()->route('citations.index')->with('success', 'Thêm trích dẫn thành công!');
    }
}
