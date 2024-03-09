@extends('frontend.includes.head')
@extends('frontend.includes.loader')
@extends('frontend.includes.footer')
<div class="card card-style">
    <div class="content mb-0 ">
    <h3>Teacher Registration</h3>
    {{--  <form action="{{ route('storeTeacherRegister') }}" method="POST" enctype="multipart/form-data">  --}}

        <form action="{{ isset($data) ? route('teacherUpdateData',$data->id) : route('storeTeacherRegister') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @isset($editstudent)
              @method('PATCH')
            @endisset
        @csrf
    <div class="row">
    <div class="input-style has-borders has-icon validate-field mb-4 col-sm-12">
    <i class="fa fa-user"></i>
    <input type="name" name="f_name" value="{{$data->first_name??""}}" class="form-control validate-name" id="form1" placeholder="First Name">
    @error('f_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <label for="form1" class="color-highlight">Teacher First Name</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>
    <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12">
    <input type="text" name="l_name" value="{{$data->last_name ??""}}" class="form-control validate-text" id="form2" placeholder="Last Name">
    @error('l_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <label for="form2" class="color-highlight">Teacher Last Name</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>

    <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12">
    <input type="text" name="father_name" value="{{$data->fathers_name ??""}}" class="form-control validate-text" id="form3" placeholder="Teacher Father's Name">
    @error('father_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <label for="form3" class="color-highlight">Teacher Father's Nmae</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>
    <div class="input-style has-borders no-icon validate-field col-md-12 col-sm-12">
    <input type="text" name="number" value="{{$data->mobile_number ??""}}" class="form-control validate-text" id="form44" placeholder="mobile number">
    @error('number')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <label for="form44" class="color-highlight">Mobile Number</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>
    @if(isset($data))
    <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12">
        <input type="file" name="file" class="form-control validate-text" id="form4" placeholder="">
        <img src="{{asset('storage/'.$data->teacher_image ??"")}}" alt="jpg" width="50" height="50">
        <label for="form4" class="color-highlight">Teacher Profile Picture</label>
        <i class="fa fa-times disabled invalid color-red-dark"></i>
        <i class="fa fa-check disabled valid color-green-dark"></i>
        </div>
    @else
    <div class="input-style has-borders no-icon validate-field mb-4 col-sm-12">
        <input type="file" name="file" class="form-control validate-text" id="form4" placeholder="">
        <label for="form4" class="color-highlight">Teacher Profile Picture</label>
        <i class="fa fa-times disabled invalid color-red-dark"></i>
        <i class="fa fa-check disabled valid color-green-dark"></i>
        </div>
    @endif

    <div class="row">
            <div class="col-sm-12">
                <div class="input-style has-borders no-icon mb-4 col-sm-12">
                    <input type="date" class="form-control" id="form7"value="{{$data->dob ??""}}" name="dob">
                    @error('dob')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="form7" class="color-highlight">Enter your Message</label>
                    <em class="mt-n3">(required)</em>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="input-style has-borders no-icon mb-4 col-sm-12">
                    <input type="date" class="form-control" value="{{$data->anniversary_date??""}}" id="form7" name="anniversary_date">
                    @error('anniversary_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="form7" class="color-highlight">Enter your Message</label>
                    <em class="mt-n3">(required)</em>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="input-style has-borders no-icon mb-4 col-sm-12">
                    <input type="date" class="form-control" value="{{$data->joining_date??""}}" id="form7" name="joining_date">
                    @error('joining_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="form7" class="color-highlight">Enter your Message</label>
                    <em class="mt-n3">(required)</em>
                </div>
            </div>
        </div>

        <button class="btn btn-primary mb-5">Submit</button>

</div>
</form>
    </div>

    </div>
@extends('frontend.includes.foot')
