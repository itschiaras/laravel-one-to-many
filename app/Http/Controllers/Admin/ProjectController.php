<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(3);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        $slug = Str::slug($request->title, '-');
        $form_data['slug'] = $slug;
        if($request->hasFile('image')) {
            $img_path = Storage::put('uploads', $request->image);
            $form_data['image'] = asset('storage/'. $img_path);
        }

        $newProject = Project::create($form_data);
        return redirect()->route('admin.projects.show', $newProject->slug);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();
        $slug = Str::slug($request->title, '-');
        $form_data['slug'] = $slug;
        if($request->hasFile('image')) {
            if($project->image) {
                Storage::delete($project->image);
            }
            $img_path = Storage::put('uploads', $request->image);
            $form_data['image'] = asset('storage/'. $img_path);
        }

        $project->update($form_data);
        return redirect()->route('admin.posts.show', $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->image) {
            $toremove = "http://localhost:8000/storage/";
            $imagetoremove = str_replace($toremove, '', $project->image);
            Storage::delete($imagetoremove);

            // $toBeRemoved = "http://127.0.0.1:8000/storage/";
            // $project->image = str_replace($toBeRemoved, '', $project->image);
            // Storage::delete($project->image);
        }

        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "$project->title deleted successfully.");
    }
}
