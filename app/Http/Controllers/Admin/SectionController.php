<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\App;
use App\Models\Section;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('admin.sections.index')->with('sections' , $sections);
    }

    public function edit(Section $section)
    {
        return view('admin.sections.edit')->with('section' , $section);
    }

    public function update(Section $section , UpdateSectionRequest $request)
    {
        $section->update($request->only(['title']));
        $section->apps()->sync($request->apps);
        return redirect()->route('sections.index');
    }
}
