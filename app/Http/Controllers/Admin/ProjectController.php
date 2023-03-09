<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('updated_at', 'DESC')->get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();

        return view('admin.projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:projects|min:5|max:20',
            'description' => 'required|string',
            'screen' => 'nullable|url',
        ],[
            'title.required' => 'Title is mandatory',
            'title.unique' => 'Title has to be different from other projects',
            'title.min' => 'Title has to be min 5 caracters',
            'title.max' => 'Title has to be max 20 caracters',
            'description.required' => 'Description is mandatory',
            'image.url' => 'Image url has to be valid',
        ]);

        $data = $request->all();

        $project = new Project();

        $data['slug'] = Str::slug($data['title'], '-');

        $project->fill($data);
        
        $project->save();

        return to_route('admin.projects.show', $project->id)->with('type', 'success')->with('msg', 'New project created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => ['required', 'string', Rule::unique('projects')->ignore($project->id), 'min:5', 'max:20'],
            'description' => 'required|string',
            'screen' => 'nullable|url',
        ],[
            'title.required' => 'Title is mandatory',
            'title.unique' => 'Title has to be different from other projects',
            'title.min' => 'Title has to be min 5 caracters',
            'title.max' => 'Title has to be max 20 caracters',
            'description.required' => 'Description is mandatory',
            'image.url' => 'Image url has to be valid',
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($data['title'], '-');

        $project->update($data);

        return to_route('admin.projects.show', $project->id)->with('type', 'success')->with('msg', 'Project updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')->with('type', 'danger')->with('msg', "$project->title has been deleted." );
    }
}
