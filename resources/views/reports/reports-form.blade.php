@extends('layout.master_layout')

@section('body')

@php $cr = request()->route()->getName(); @endphp

<div class="container-fluid">
    <div class="row" style="padding-top: 20px;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Reports
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('reportsForm') }}" class="form-horizontal add-form-user" method="POST" id="addUser">
                        @csrf
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-3 mt-2">
                                    <span class="badge badge-secondary text-left" style="width: 70px; display: inline-block;">User Type:</span>
                                    <select class="form-control select_camp form-control-sm" name="user_type" required>
                                        <option>All</option>
                                        <option @if(isset($user_type)){{ ($user_type == 'Students') ? 'selected' : '' }}@endif>Students</option>
                                        <option @if(isset($user_type)){{ ($user_type == 'Faculty') ? 'selected' : '' }}@endif>Faculty</option>
                                        <option @if(isset($user_type)){{ ($user_type == 'Staff') ? 'selected' : '' }}@endif>Staff</option>
                                        <option @if(isset($user_type)){{ ($user_type == 'Visitor') ? 'selected' : '' }}@endif>Visitor</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <span class="badge badge-secondary text-left" style="width: 70px; display: inline-block;">Date Start:</span>
                                    <input type="date" name="date1" value="{{ isset($date1) ? $date1 : '' }}" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <span class="badge badge-secondary text-left" style="width: 70px; display: inline-block;">Date End:</span>
                                    <input type="date" name="date2" value="{{ isset($date2) ? $date2 : '' }}" class="form-control form-control-sm" required>   
                                </div>                                
                                <div class="col-md-3 mt-2" style="margin-top: 27px !important;">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-file-pdf"></i> Generate
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    @if(isset($date1) && isset($date2))
                        <iframe src="{{ route('reportsPdf') }}/?user_type={{ $user_type }}&&date1={{ $date1 }}&&date2={{ $date2 }}" width="100%" height="700px"></iframe>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection