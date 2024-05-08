<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
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
                        <div class="col-6">
                            <span class="badge badge-secondary text-left" style="width: 70px; display: inline-block;">User Type:</span>
                            <input type="hidden" id="action" name="action">
                            <select type="text" class="form-control form-control-sm" onchange="typeChange(this.value)" style="height: 38px;" name="user_type" id="userType" required>
                                <option value="">-- Select --</option>
                                <option value="Students">Student</option>
                                <option>Faculty</option>
                                <option>Staff</option>
                                <option>Visitor</option>
                            </select>
                        </div>
                        <div class="col-6 student-faculty">
                            <span class="badge badge-secondary text-left" style="">Name:</span>
                            <select type="select" class="form-control form-control-sm select2bs4" name="visit_id" id="fullName" placeholder="Select Your Name">
                            </select>
                        </div>
                        <div class="col-6 visitor-staff office">
                            <span class="badge badge-secondary text-left" style="width: 70px; display: inline-block;">Office:</span>
                            <select type="text" class="form-control form-control-sm" style="height: 38px;" name="office" id="userType">
                                <option value="">-- Select --</option>
                                @foreach($offices as $off)
                                    <option value="{{ $off->id }}">{{ $off->office_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 visitor-staff campus">
                            <span class="badge badge-secondary text-left" style="width: 70px; display: inline-block;">Campus:</span>
                            <select type="text" class="form-control form-control-sm" style="height: 38px;" name="campus" id="userType">
                                <option value="">-- Select --</option>
                                @foreach($campus as $camp)
                                    <option value="{{ $camp->id }}">{{ $camp->campus_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4 visitor-staff">
                            <span class="badge badge-secondary text-left" style="">First Name:</span>
                            <input type="text" name="lname" class="form-control capitalize-first">
                        </div>
                        <div class="col-4 visitor-staff">
                            <span class="badge badge-secondary text-left" style="">Last Name:</span>
                            <input type="text" name="s_fname" class="form-control capitalize-first">
                        </div>
                        <div class="col-4 visitor-staff">
                            <span class="badge badge-secondary text-left" style="">Middle Name:</span>
                            <input type="text" name="s_mname" class="form-control capitalize-first">
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