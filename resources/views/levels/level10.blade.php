@extends('layouts.index')

    @section('head')
    @endsection

    @section('header')
    @endsection
    
    @section('content')
        @auth <!-- are you logged in? -->
        @include('progress.progress', ['application' => $application])

        <div class="container">
            <div class="card text-white bg-secondary mb-3">
                
                <div class="card-body">
                    <h4 class="card-title text-warning">LEVEL 10: <span class="text-info">RECOMMENDATIONS & DOCUMENTATION</span></h4>
                    <div class="card-text">
                        The Board of Pardons is looking for professional and personal recommendations as well as evidence of any certifications or degrees you may have received. Upload your documents below.  Documents should be in a PDF or image format. If you only have a physical copy, you can use your phone to take a picture.  We recommend using the following apps:
                        <ul>
                            <li>PLSE will recommend.</li>
                            <li>PLSE will recommend.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title text-warning">Recommendations</h5>
                    <div class="card-text">
                        <p>Go to <a class="info" href="../level2/{{ $application->id }}">Level 2</a> to add additional work experience.</p>
                        <table style="width:75%" class="table table-hover">
                            <thead>
                                <tr class="table-info">
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                   <!-- <th scope="col">Place</th>-->
                                    <th scope="col">&nbsp</th>
                                    <th scope="col">&nbsp</th>
                                </tr>
                            </thead>
                        @if($recommends->count())
                            @foreach ($recommends as $recommend)
                                <tr class="table-dark">
                                    <td class="text-black">{{ $recommend->name }}</td>
                                    <td class="text-black">{{ $recommend->type }}</td>
                                         @if($recommend->filename)
                                            <td>   
                                                <a href="/applications/recommend/recfile/{{ $recommend->id }}" target="_blank">Download Document</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-info text-white" style="color:white;" href="/applications/recommend/norecs/{{ $recommend->id }}">Delete file</a>
                                            </td>
                                        @else
                                            <form method="POST" action="/applications/recommend/recs/{{ $recommend->id }}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <td>                                           
                                                    <input type="file" name="certfile"></input>
                                                </td>
                                                <td><button class="btn btn-info">Save</button></td>
                                            </form>
                                        @endif
                                </tr>
                            @endforeach
                        @else
                                <tr class="table-dark">
                                    <td colspan="5">No jobs or work experience listed.</td>
                                </tr>
                        @endif   
                        </table>
                    </div>                
                </div>
            </div>
                <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title text-warning">Certifications/Degrees</h5>
                    <div class="card-text">
                        <p>Go to <a class="info" href="../level2/{{ $application->id }}">Level 2</a> to add additional degrees or certifications.</p>
                        <table style="width:75%" class="table table-hover">
                            <thead>
                                <tr class="table-info">
                                    <th scope="col">Date</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">&nbsp</th>
                                    <th scope="col">&nbsp</th>
                                </tr>
                            </thead>
                        @if($schools->count())
                            @foreach ($schools as $school)
                                    <tr class="table-dark">
                                        <td class="text-black">{{ $school->education_date }}</td>
                                        <td class="text-black">{{ $school->location }}</td>
                                        <td class="text-black">{{ $school->edtype }}</td>
                                         @if($school->filename)
                                            <td>   
                                                <a href="/applications/education/certfile/{{ $school->id }}" target="_blank">Download Document</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-info text-white" style="color:white;" href="/applications/education/nocerts/{{ $school->id }}">Delete file</a>
                                            </td>
                                        @else
                                            <form method="POST" action="/applications/education/certs/{{ $school->id }}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <td>                                           
                                                    <input type="file" name="certfile"></input>
                                                </td>
                                                <td><button class="btn btn-info">Save</button></td>
                                            </form>
                                        @endif
                                    </tr>
                            @endforeach
                        @else
                                <tr class="table-dark">
                                    <td colspan="5">
                                        No degrees or certifications listed. 
                                    </td>
                                </tr>
                        @endif
                        </table>
                    </div>                
                </div>
            </div>
            <form method="POST" action="/applications/level10/{{ $application->id }}" enctype="multipart/form-data">
                <input type="hidden" name="savelevel" value="10" ></input>
                {{ csrf_field() }}
            <div class="row form-group">

                <div style="float:left;" class="col-md-6">
                    <a href="../level9/{{ $application->id }}" style="margin:20px;" class="btn btn-info">
                    BACK - LEVEL 9
                </a>
                </div>
                <div style="float:right;" class="col-md-6">
                    @if($application->status < 10)
                        <button style="margin:20px;"class="btn btn-info">FINISHED!</button>
                    @else
                        <a href="dashboard" style="margin:20px;" class="btn btn-info">FINISHED!</a>
                    @endif
                </div>
            </div>
            </form>
        </div>

        @endauth
    @endsection