@extends('frontend.includes.head')
@extends('frontend.includes.loader')
@extends('frontend.includes.footer')

<div class="card card-style">
     @foreach ($errors->all() as $e)
    {{ $e }}
    @endforeach
 <form action="{{ isset($editstudent) ? route('student.update',$editstudent->id) : route('student.store') }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @isset($editstudent)
      @method('PATCH')
    @endisset
    <div class="content mb-0">
        <div class="row">
    <h1>Student Registration</h1>
    <div class="input-style input-style-always-active has-borders has-icon validate-field mb-4 col-sm-4">
    <i class="fa fa-user font-12"></i>
    <input type="text" class="form-control validate-name" name="student_name" id="f1" placeholder="Student Name" value="{{ isset($editstudent) ? $editstudent->student_name : '' }}" value="{{ old('student_name') }}" >
     @error('student_name')
     <div <span class="text-danger">{{ $message }}</span></div>
      @enderror
   
    <label for="f1" class="color-blue-dark font-13">Student Name</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>
    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4">
    <i class="fa fa-calendar font-12"></i>
    <input type="date" class="form-control validate-name" name="date_of_birth" id="f1abc" placeholder="Date of Birth" value="{{ isset($editstudent) ? $editstudent->date_of_birth : '' }}" value="{{ old('student_name') }}">
    @error('date_of_birth')
    <div <span class="text-danger">{{ $message }}</span></div>
    @enderror
    <label for="f1abcd" class="color-blue-dark font-13">Date of Birth</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>
    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4">
    <i class="fa fa-user font-12"></i>
    <input type="text" class="form-control validate-name" name="father_name" id="f1a" placeholder="Father Name" value="{{ isset($editstudent) ? $editstudent->father_name : '' }}" value="{{ old('student_name') }}">
    @error('father_name')
    <div <span class="text-danger">{{ $message }}</span></div>
    @enderror
    <label for="f1abcd" class="color-blue-dark font-13">Father Name</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>
    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4">
    <i class="fa fa-building font-12"></i>
    <input type="text" class="form-control validate-name" name="class" id="f1abcd" placeholder="Class" value="{{ isset($editstudent) ? $editstudent->class : '' }}" value="{{ old('student_name') }}">
    @error('class')
    <div <span class="text-danger">{{ $message }}</span></div>
    @enderror
    <label for="f1abcd" class="color-blue-dark font-13">Class</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>
    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4">
    <i class="fa fa-building font-12"></i>
    <input type="text" class="form-control validate-name" name="section" id="f1abcd" placeholder="Sectioon" value="{{ isset($editstudent) ? $editstudent->section : '' }}" value="{{ old('section') }}">
    @error('section')
    <div <span class="text-danger">{{ $message }}</span></div>
    @enderror
    <label for="f1abcd" class="color-blue-dark font-13">Section</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>
    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4">
    <i class="fa fa-phone font-12"></i>
    <input type="tel" class="form-control validate-name" name="mobile_number" id="f1abcd" placeholder="Mobile Number" value="{{ isset($editstudent) ? $editstudent->mobile_number : '' }}" value="{{ old('mobile_number') }}">
    @error('mobile_number')
    <div <span class="text-danger">{{ $message }}</span></div>
    @enderror
    <label for="f1abcd" class="color-blue-dark font-13">Mobile Number</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>
    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4">
    <i class="fa fa- fa-image font-12"></i>
    <input type="file" class="form-control validate-name" name="student_image" id="f1abcd" placeholder="Student Image">
    @isset($editstudent)
      <img src="{{ asset('storage/'.$editstudent->student_image ?? '') }}" width="50" >
    @endisset
     @error('student_image')
     <div <span class="text-danger">{{ $message }}</span></div>
    @enderror
    <label for="file" class="color-blue-dark font-13">Student Image</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>
    <button type="submit" <a href="#" class="btn btn-full bg-green-dark btn-m text-uppercase rounded-sm shadow-l mb-3 mt-4 font-900">{{ isset($editstudent) ? 'Update' : 'Submit' }}</a></button>
    </div>

</form>
</div>
</div>
</div>
<div class="card card-style">
    <div class="content mb-5">

    <table class="table table-dark table-responsive">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Student Name</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Father Name</th>
                <th scope="col">Class</th>
                <th scope="col">Sectioon</th>
                <th scope="col">Mobile Number</th>
                <th scope="col">Student Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
            <tr>
                <th scope="row">{{ $loop->index+1}}</th>
                <td>{{ $student->student_name ?? '' }}</td>
                <td>{{ $student->date_of_birth ?? '' }}</td>
                <td>{{ $student->father_name ?? '' }}</td>
                <td>{{ $student->class ?? '' }}</td>
                <td>{{ $student->sectioon ?? '' }}</td>
                <td>{{ $student->mobile_number ?? '' }}</td>
                <td>
                    <img src="{{asset('storage/'.$student->student_image) }}" width="100">
                </td>
                <td>
                    <a href="{{ route('student.edit', $student->id) }}" class="btn btn-primary" href="#">Edit</a>

                    <form action="{{ route('student.destroy', $student->id)  }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this student?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>

            </tr>
            @empty
            Student not found
            @endforelse
        </tbody>
    </table>

</div>
</div>
@extends('frontend.includes.foot')

