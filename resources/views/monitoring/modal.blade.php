<div class="modal fade" id="loginModal" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Mark Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('logAttendanceManual') }}" id="log-form" method="GET">
                    <div class="row">
                        <div class="col-6" id="user-type-div">
                            <span class="badge badge-secondary text-left" style="width: 70px; display: inline-block;">User Type:</span>
                            <input type="hidden" id="action" name="action">
                            <select type="text" class="form-control form-control-sm" onchange="typeChange(this.value)" style="height: 38px;" name="user_type" id="userType" required>
                                <option value="Students" selected>Student</option>
                                <option>Faculty</option>
                                <option>Staff</option>
                                <option>Guest</option>
                            </select>
                        </div>
                        <div class="col-6" id="user-name-div">
                            <span class="badge badge-secondary text-left" style="">Name:</span>
                            <select type="text" onchange="nameTrigger(this.value)" class="form-control form-control-sm select2" data-placeholder="Search Your Name" name="visit_id" id="fullName">
                            </select>
                        </div>
                        <div class="col-4 visitor-staff office">
                            <span class="badge badge-secondary text-left">Office:</span>
                            <select type="text" class="form-control form-control-sm select2" data-placeholder="Select Office" id="office" name="office">
                                <option value="">-- Select Office --</option>
                                @foreach($offices as $off)
                                    <option value="{{ $off->id }}">{{ $off->office_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4 visitor-staff campus">
                            <span class="badge badge-secondary text-left">Campus:</span>
                            <select type="text" class="form-control form-control-sm select2" data-placeholder="Select Campus" id="campus" name="campus">
                                <option value="">-- Select Campus --</option>
                                @foreach($campus as $camp)
                                    <option value="{{ $camp->id }}">{{ $camp->campus_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4 visitor-staff">
                            <span class="badge badge-secondary text-left" style="">Last Name:</span>
                            <input type="text" name="lname" class="form-control capitalize-first">
                        </div>
                        <div class="col-4 visitor-staff">
                            <span class="badge badge-secondary text-left" style="">First Name:</span>
                            <input type="text" name="fname" class="form-control capitalize-first">
                        </div>
                        <div class="col-4 visitor-staff">
                            <span class="badge badge-secondary text-left" style="">Middle Name:</span>
                            <input type="text" name="mname" class="form-control capitalize-first">
                        </div>
                        <div class="col-12 text-right mt-2 mb-2">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>