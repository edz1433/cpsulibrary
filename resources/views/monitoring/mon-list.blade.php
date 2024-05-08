@extends('layout.master_layout')

@section('body')

<div class="content">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2>Monitoring</h2>
                <hr>
                <table id="example1" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Type</th>
                            <th>Time in</th>
                            <th>Time out</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($monitorings as $mon)
                            <tr>
                                <td>{{ ucfirst($mon->lname) }} {{ ucfirst($mon->s_fname) }} {{ ucfirst($mon->s_mname) }}</td>
                                <td>{{ $mon->user_type }}</td>
                                <td>{{ ($mon->time_in != '') ? \Carbon\Carbon::parse($mon->time_in)->format('h:i:s A') : '' }}</td>
                                <td>{{ ($mon->time_in != '') ? \Carbon\Carbon::parse($mon->time_out)->format('h:i:s A') : '' }}</td>
                                <td>{{ $mon->date }}</td>
                                <td><span class="badge badge-{{ ($mon->status == 'completed') ? 'success' : 'secondary' }}">{{ $mon->status }}</span></td>
                            </tr>
                        @endforeach
                        {{-- @foreach($patients as $p)
                            <tr>
                                <td>{{ $p->lname }} {{ $p->ext }} {{ $p->fname }} {{ $p->mname }}</td>
                                <td>{{ $p->age }}</td>
                                <td>{{ $p->sex }}</td>
                                <td>{{ $p->c_status}}</td>
                                <td>
                                    <a href="{{ route('moreInfo', ['id' => $p->category, 'mid' => $p->id]) }}" class="btn btn-info btn-sm" title="More Info">
                                        <i class="fas fa-exclamation-circle"></i> 
                                    </a>
                                    <a href="{{ route('peheReport', $p->id) }}" target="_blank" class="btn btn-warning btn-sm" title="Pre-Entrance Health Examination Reporto">
                                        <i class="fas fa-file-pdf"></i> 
                                    </a>
                                    <button class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            
        </div>
    </div>
</div>
@endsection