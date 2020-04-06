@extends('layouts.index')

    @section('head')
    @endsection

    @section('header')
    @endsection

    @section('content')
    
        @auth <!-- are you logged in? -->
    
        <div class="container">
            <div class="card text-white bg-secondary mb-3">
                
                <div class="card-body">
                    <h4 class="card-title text-warning">PARDDON ME  - CLIENT MANAGEMENT</h4>
                    <div class="card-text">
                        <p>
                            <table style="width:75%" class="table table-hover">
                                <thead>
                                    <tr class="table-info">
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">&nbsp</th>
                                    </tr>
                                </thead>
                                @for($client in $clients)
                                    <tr class="table-dark">
                                        <td>{{ $client->name }} </td>
                                        <td><a href="mailto:{{ $client->email }}">{{ $client->email }}</a></td>
                                        <td><a href="/profile/{{ $client->id }}">view profile</a></td>
                                    </tr>
                                @endfor
                            </table>

                        </p>  
                    </div>
                </div>
            </div>
        </div>
        @endauth
    @endsection