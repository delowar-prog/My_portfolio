@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('projects.create') }}" title="Create a project"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Introduction</th>
            <th>Location</th>
            <th>Cost</th>
            <th>Date Created</th>
            <th width="280px">Action</th>
        </tr>
       @foreach($projects as $project)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$project->name}}</td>
                <td>{{$project->introduction }}</td>
                <td>{{$project->location }}</td>
                <td>{{$project->cost }}</td>
                <td>{{ date_format($project->created_at, 'jS M Y') }}</td>
                <td>
                  

                        <a href="/projects/show/{{ $project->id }}" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="/projects/edit/{{ $project->id }}">
                            <i class="fas fa-edit  fa-lg"></i>

                        </a>
                        <a href="/projects/delete/{{ $project->id }}">
                            <i class="fas fa-trash fa-lg text-danger"></i>

                        </a>
                </td>
            </tr>
    @endforeach 
    </table>

   

@endsection