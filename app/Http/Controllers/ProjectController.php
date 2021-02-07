<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use DB;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::latest()->paginate(5);

        return view('projects.index', compact('projects'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'introduction' => 'required',
            'location' => 'required',
            'cost' => 'required'
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // $project=Project::findorfail($id);
       $project=DB::table('projects')->where('id',$id)->first();
       return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $project=Project::findorfail($id);
        $project=DB::table('projects')->where('id',$id)->first();
        return view('projects.edit', compact('project'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'introduction' => 'required',
            'location' => 'required',
            'cost' => 'required'
        ]);
        $project->update($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project=Project::findorfail($id);
        $project->delete();
        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully');
    }
}
