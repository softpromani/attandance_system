@extends('frontend.includes.main')
@section('content')
{{--  {{$staff}}  --}}
<div class="card card-style">
    <div class="content mb-0 ">
        <h3>Staff Update Information</h3>
        <form action="{{ route('admin.updateStaff',$staff->id) }}" method="POST" enctype="multipart/form-data">
            {{--  action="{{ isset($data) ? route('staff.teacherUpdateData', $data->id) : route('staff.storeTeacherRegister') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @isset($editstudent)
                @method('PATCH')
            @endisset  --}}
            @csrf
            <div class="row">
                <div class="input-style has-borders has-icon validate-field mb-4 col-sm-12">
                    <i class="fa fa-user"></i>
                    <input type="name" name="f_name" value="{{ $staff->first_name ?? '' }}"
                        class="form-control validate-name" id="form1" placeholder="First Name">
                    @error('f_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="form2" class="color-highlight">Teacher First Name</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>

                </div>
                <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12">
                    <input type="text" name="l_name" value="{{ $staff->last_name ?? '' }}"
                        class="form-control validate-text" id="form2" placeholder="Last Name">
                    @error('l_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="form2" class="color-highlight">Teacher Last Name</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>

                </div>
                <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12">
                    <input type="email" name="email" value="{{ $staff->email ?? '' }}"
                        class="form-control validate-text" id="form2" placeholder="Email">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="form2" class="color-highlight">Teacher Email</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>

                </div>
                @if (isset($staff))
                    <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12">
                        <input type="password" name="password" class="form-control validate-text" id="form2"
                            placeholder="Password" hidden>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="form2" class="color-highlight">Password</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>

                    </div>
                @else
                    <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12">
                        <input type="password" name="password" class="form-control validate-text" id="form2"
                            placeholder="Password">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="form2" class="color-highlight">Password</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>

                    </div>
                @endif
                <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12">
                    <input type="text" name="father_name" value="{{ $staff->father_name ?? '' }}"
                        class="form-control validate-text" id="form3" placeholder="Teacher Father's Name">
                    @error('father_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="form3" class="color-highlight">Teacher Father Nmae</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>

                </div>
                <div class="input-style has-borders no-icon validate-field col-md-12 col-sm-12">
                    <input type="number" name="number" value="{{ $staff->mobile_number ?? '' }}"
                        class="form-control validate-text" id="form44" placeholder="mobile number">
                    @error('number')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="form44" class="color-highlight">Mobile Number</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>

                </div>
                @if (isset($staff))
                    <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12">

                        <input type="file" name="file" class="form-control validate-text" id="form4"
                            placeholder="">
                        <img src="{{ asset('storage/' . $staff->teacher_image ?? '') }}" alt="jpg" width="50"
                            height="50">
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                    </div>
                @else
                    <div class="validate-field mb-4 col-sm-12">
                        <label for="form4" class="color-highlight">Teacher Profile Picture</label>
                        <input type="file" name="file" class="form-control validate-text" id="form4"
                            placeholder="">
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                    </div>
                @endif

                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-style has-borders no-icon mb-4 col-sm-12">
                            <input type="date" class="form-control" id="form7"value="{{ $staff->dob ?? '' }}"
                                name="dob">
                            @error('dob')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="form7" class="color-highlight">Date Of Birth</label>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-style has-borders no-icon mb-4 col-sm-12">
                            <input type="date" class="form-control" value="{{ $staff->anniversary_date ?? '' }}"
                                id="form7" name="anniversary_date">
                            @error('anniversary_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="form7" class="color-highlight">Enter Your Anniversry Date</label>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-style has-borders no-icon mb-4 col-sm-12">
                            <input type="date" class="form-control" value="{{ $staff->joining_date ?? '' }}"
                                id="form7" name="joining_date">
                            @error('joining_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="form7" class="color-highlight">Enter your Joining Date</label>

                        </div>
                    </div>
                </div>

                <button class="btn btn-primary mb-5">update</button>

            </div>
        </form>
    </div>

</div>
@endsection
