@extends('frontend.includes.main')
@section('title', 'Staff')
@section('content')
    <div class="card card-style">
        <div class="content mb-]1 ">
            <h3>Staff Registration</h3>

            <form
                action="{{ isset($data) ? route('staff.teacherUpdateData', $data->id) : route('staff.storeTeacherRegister') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @isset($editstudent)
                    @method('PATCH')
                @endisset
                @csrf
                <div class="row">
                    <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12 input-style-always-active pt-2">
                        <label for="form5a" class="color-green-dark">Select Role</label>
                        <select id="form5a" name="role">
                        <option value="default" disabled="" selected="">Select a Role</option>
                        <option value="staff">Staff</option>
                        <option value="driver">Driver</option>
                        </select>
                        <span><i class="fa fa-chevron-down"></i></span>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <i class="fa fa-check disabled invalid color-red-dark"></i>
                        <em></em>
                        </div>
                    <div class="input-style has-borders has-icon validate-field mb-4 col-sm-12 input-style-always-active">
                        <i class="fa fa-user"></i>
                        <input type="name" name="f_name" value="{{ $data->first_name ?? old('first_name') }}"
                            class="form-control validate-name" id="form1" placeholder="First Name">
                        @error('f_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="form2" class="color-green-dark">Staff First Name</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>

                    </div>
                    <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12 input-style-always-active">
                        <input type="text" name="l_name" value="{{ $data->last_name ?? old('l_name') }}"
                               class="form-control validate-text" id="form2" placeholder="Last Name">
                        @error('l_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="form2" class="color-green-dark">Staff Last Name</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                    </div>
                    <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12 input-style-always-active">
                        <input type="email" name="email" value="{{ $data->email ?? old('email') }}"
                            class="form-control validate-text" id="form2" placeholder="Email">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="form2" class="color-green-dark">Staff Email</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>

                    </div>
                    @if (isset($data))
                        <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12 input-style-always-active">
                            <input type="password" name="password" class="form-control validate-text" id="form2"
                                placeholder="Password" hidden>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="form2" class="color-green-dark">Password</label>
                            <i class="fa fa-times disabled invalid color-red-dark"></i>
                            <i class="fa fa-check disabled valid color-green-dark"></i>

                        </div>
                    @else
                        <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12 input-style-always-active">
                            <input type="password" name="password" class="form-control validate-text" id="form2"
                                placeholder="Password">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="form2" class="color-green-dark">Password</label>
                            <i class="fa fa-times disabled invalid color-red-dark"></i>
                            <i class="fa fa-check disabled valid color-green-dark"></i>

                        </div>
                    @endif
                    <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12 input-style-always-active">
                        <input type="text" name="father_name" value="{{ $data->father_name ?? old('father_name') }}"
                            class="form-control validate-text" id="form3" placeholder="Father's Name">
                        @error('father_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="form3" class="color-green-dark">Father's Name</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>

                    </div>
                    <div class="input-style has-borders no-icon validate-field col-md-12 col-sm-12 input-style-always-active">
                        <input type="number" name="number" value="{{ $data->mobile_number ?? old('mobile_number') }}"
                            class="form-control validate-text" id="form44" placeholder="mobile number">
                        @error('number')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="form44" class="color-green-dark">Mobile Number</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>

                    </div>
                    @if (isset($data))
                        <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12 input-style-always-active">

                            <input type="file" name="file" class="form-control validate-text" id="form4"
                                placeholder="">
                            <img src="{{ asset('storage/' . $data->teacher_image ?? '') }}" alt="jpg" width="50"
                                height="50">
                            <i class="fa fa-times disabled invalid color-red-dark"></i>
                            <i class="fa fa-check disabled valid color-green-dark"></i>
                        </div>
                    @else
                        <div class="validate-field mb-4 col-sm-12 input-style-always-active">
                            <label for="form4" class="color-green-dark"> Profile Picture</label>
                            <input type="file" name="file" class="form-control validate-text" id="form4"
                                placeholder="">
                            <i class="fa fa-times disabled invalid color-red-dark"></i>
                            <i class="fa fa-check disabled valid color-green-dark"></i>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-style has-borders no-icon mb-4 col-sm-12 input-style-always-active">
                                <input type="date" class="form-control" id="form7"value="{{ $data->dob ?? old('dob') }}"
                                    name="dob">
                                @error('dob')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="form7" class="color-green-dark">Date Of Birth</label>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-style has-borders no-icon mb-4 col-sm-12 input-style-always-active">
                                <input type="date" class="form-control" value="{{ $data->anniversary_date ?? old('anniversary_date') }}"
                                    id="form7" name="anniversary_date">
                                @error('anniversary_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="form7" class="color-green-dark">Enter Anniversary Date</label>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-style has-borders no-icon mb-4 col-sm-12 input-style-always-active">
                                <input type="date" class="form-control" value="{{ $data->joining_date ?? old('joining_date') }}"
                                    id="form7" name="joining_date">
                                @error('joining_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="form7" class="color-green-dark">Enter Joining Date</label>

                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary mb-5">{{ isset($data)?'Update':'Submit' }}</button>

                </div>
            </form>
        </div>

    </div>
@endsection
