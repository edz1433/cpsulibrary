@extends('layout.master_layout')

@section('body')

<div class="content">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Monitoring
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('monitorReadPost') }}" class="form-horizontal add-form-user" method="POST" id="addUser">
                            @csrf
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-3 mt-2">
                                        <span class="badge badge-secondary pt-1 text-left" style="width: 70px; display: inline-block;">Date Start:</span>
                                        <input type="date" name="date1" value="{{ isset($date1) ? $date1 : '' }}" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <span class="badge badge-secondary pt-1 text-left" style="width: 70px; display: inline-block;">Date End:</span>
                                        <input type="date" name="date2" value="{{ isset($date2) ? $date2 : '' }}" class="form-control form-control-sm" required>   
                                    </div>                                
                                    <div class="col-md-3 mt-2" style="margin-top: 27px !important;">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-search"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if(isset($date1) && isset($date2))
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
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
                                                    <td>{{ strtoupper($mon->lname) }} {{ strtoupper($mon->fname) }} {{ strtoupper($mon->mname) }}</td>
                                                    <td>{{ $mon->user_type }}</td>
                                                    <td>{{ ($mon->time_in != '') ? \Carbon\Carbon::parse($mon->time_in)->format('h:i:s A') : '' }}</td>
                                                    <td>{{ ($mon->time_out != '00:00:00') ? \Carbon\Carbon::parse($mon->time_out)->format('h:i:s A') : '' }}</td>
                                                    <td>{{ $mon->date }}</td>
                                                    <td><span class="badge badge-{{ ($mon->status == 'completed') ? 'success' : 'secondary' }}">{{ $mon->status }}</span></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="col-md-12 card">
                        <h5 class="card-title mb-2 mt-2 ml-1">
                           <strong>Students</strong> 
                        </h5>
                        <hr style="margin-top: -6px;">
                        <table>
                            <tbody>
                                @php
                                    $studenttotal = 0;
                                    $facultyttotal = 0;
                                @endphp
                                @foreach($countmon as $countm)
                                    <tr>
                                        @if($countm->user_type == 'Students')
                                            <td width="50%">{{ $countm->course }}</td>
                                            <td width="50%" class="text-center"><span class="badge badge-success pt-1">{{ $countm->count }}</span></td>
                                            @php
                                                $studenttotal += $countm->count;
                                            @endphp
                                        @endif
                                    </tr>
                                @endforeach
                                <tr>
                                    <td width="50%"><strong>Total</strong></td>
                                    <td width="50%" class="text-center"><span class="badge badge-secondary pt-1">{{ number_format($studenttotal) }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 card">
                        <h5 class="card-title mb-2 mt-2 ml-1">
                            <strong>Faculty</strong>
                        </h5>
                        <hr style="margin-top: -6px;">
                        <table>
                            <tbody>
                                @foreach($countmon as $countm)
                                    <tr>
                                        @if($countm->user_type == 'Faculty')
                                            <td width="50%">{{ $countm->course }}</td>
                                            <td width="50%" class="text-center"><span class="badge badge-success pt-1">{{ number_format($countm->count) }}</span></td>
                                            
                                            @php
                                                $facultyttotal += $countm->count;
                                            @endphp
                                        @endif
                                    </tr>
                                @endforeach
                                <tr>
                                    <td width="50%"><strong>Total</strong></td>
                                    <td width="50%" class="text-center"><span class="badge badge-secondary pt-1">{{ number_format($facultyttotal) }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 card">
                        <table>
                            <tbody>
                                <tr>
                                    <td width="50%"><strong>Staff</strong></td>
                                    <td width="50%" class="text-center"><span class="badge badge-secondary pt-1">{{ number_format($monitorings->where('user_type', 'Staff')->count()) }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 card">
                        <table>
                            <tbody>
                                <tr>
                                    <td width="50%"><strong>Guest</strong></td>
                                    <td width="50%" class="text-center"><span class="badge badge-secondary pt-1">{{ number_format($monitorings->where('user_type', 'Guest')->count()) }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
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