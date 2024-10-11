<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {

        $form_data = $request->validated();
        $project = new Project();

        if($request->hasFile('image')){
            $path = Storage::disk('public')->put('image', $form_data['image']);
            $form_data['image'] = $path;
        }

        $form_data['slug'] = Project::generateSlug($form_data['name'], '-');
        $project->fill($form_data);
        $project->save();
        return redirect()->route('admin.projects.index');
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
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();

        if($request->hasFile('image')){
            // cancello l'immagine
            if($project->image != null){
                Storage::delete($project->image);
            }
            // upload immagine nuova
            $path = Storage::put('projects_image', $form_data['image']);
            $form_data['image'] = $path;
        }

        $forma_data['slug'] = Project::generateSlug($form_data['name']);
        $project->update($form_data);
        return redirect()->route('admin.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // prima elimino l'immagine e dopo il progetto (altrimenti non potrei recuperare l'immagine)
        if($project->image !== null){
            Storage::delete($project->image);
        }

        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
