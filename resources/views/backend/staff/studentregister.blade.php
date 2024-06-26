@extends('frontend.includes.main')
@section('content')
@section('style')
@endsection
    <div class="card card-style">

        @foreach ($errors->all() as $e)
            {{ $e }}
        @endforeach
        <form
            action="{{ isset($editstudent) ? route('student.student.update', $editstudent->id) : route('student.student.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @isset($editstudent)
                @method('PATCH')
            @endisset
            <div class="content mb-0">
                <div class="row">
                    <h1>Student Registration</h1>
                    <div class="input-style input-style-always-active has-borders has-icon validate-field mb-4 col-sm-12">
                        <i class="fa fa-user font-12"></i>
                        <input type="text" class="form-control validate-name" name="student_name" id="f1"
                            placeholder="Student Name" value="{{ isset($editstudent) ? $editstudent->student_name : '' }}"
                            value="{{ old('student_name') }}">
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
                        <input type="date" class="form-control validate-name" name="date_of_birth" id="f1abc"
                            placeholder="Date of Birth" value="{{ isset($editstudent) ? $editstudent->date_of_birth : '' }}"
                            value="{{ old('student_name') }}">
                        @error('date_of_birth')
                            <div <span class="text-danger">{{ $message }}</span></div>
                        @enderror
                        <label for="f1abcd" class="color-blue-dark font-13">Date of Birth</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>(required)</em>
                    </div>
                    <div class="input-style input-style-always-active has-borders validate-field mt-4 col-sm-12">
                        <label for="gender" class="color-blue-dark font-13">
                            Gender 
                        </label>
                        <select class="form-select" id="gender" aria-label="Default select example" name="gender">
                            <option selected disabled>select Gender</option>
                            <option value="male" {{ (old('gender') ?? $editstudent->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ (old('gender') ?? $editstudent->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        
                        {{-- <em>(required)</em> --}}
                    </div>
                    
                    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4 col-sm-12">
                        <i class="fa fa-user font-12"></i>
                        <input type="text" class="form-control validate-name" name="father_name" id="f1a"
                            placeholder="Father Name" value="{{ isset($editstudent) ? $editstudent->father_name : '' }}"
                            value="{{ old('student_name') }}">
                        @error('father_name')
                            <div <span class="text-danger">{{ $message }}</span></div>
                        @enderror
                        <label for="f1abcd" class="color-blue-dark font-13">Father Name</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>(required)</em>
                    </div>
                    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4 col-sm-12">
                        <i class="fa fa-building font-12"></i>
                        {{-- <input type="text" class="form-control validate-name" name="class" id="f1abcd"
                            placeholder="Class" value="{{ isset($editstudent) ? $editstudent->class : '' }}"
                            value="{{ old('student_name') }}">
                        @error('class')
                            <div <span class="text-danger">{{ $message }}</span></div>
                        @enderror --}}
                        <select class="form-select class_name" aria-label="Default select example" name="classId">
                            <option selected disabled> select Class</option>
                            @foreach ($classData as $cd )
                            <option value="{{$cd->id }}" @if(isset($editstudent) && $editstudent->class == $cd->id) selected @endif >{{ $cd->class }}</option>
                            @endforeach
                          </select>
                        <label for="f1abcd" class="color-blue-dark font-13">Class</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>(required)</em>
                    </div>
                    {{-- <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4 col-sm-12">
                        <i class="fa fa-building font-12"></i>
                         <input type="text" class="form-control validate-name" name="section" id="f1abcd"
                            placeholder="Sectioon" value="{{ isset($editstudent) ? $editstudent->section : '' }}"
                            value="{{ old('section') }}">
                            @error('section')
                                <div <span class="text-danger">{{ $message }}</span></div>
                            @enderror 
                        <select class="form-select" id="select2Success" aria-label="Default select example" name="sectionId">
                                        
                        </select>
                        <label for="f1abcd" class="color-blue-dark font-13">Section</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>(required)</em>
                    </div> --}}
                    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4 col-sm-12">
                        <i class="fa fa-building font-12"></i>
                        <select class="form-select" id="select2Success" aria-label="Default select example" name="sectionId">
                            <option selected disabled>Select Section</option>
                            @if(isset($sections))
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}" @if(isset($editstudent) && $editstudent->section == $section->id) selected @endif>
                                        {{ $section->section }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <label for="f1abcd" class="color-blue-dark font-13">Section</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>(required)</em>
                    </div>
                    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4 col-sm-12">
                        <i class="fa fa-phone font-12"></i>
                        <input type="tel" class="form-control validate-name" name="mobile_number" id="f1abcd"
                            placeholder="Mobile Number"
                            value="{{ isset($editstudent) ? $editstudent->mobile_number : '' }}"
                            value="{{ old('mobile_number') }}">
                        @error('mobile_number')
                            <div <span class="text-danger">{{ $message }}</span></div>
                        @enderror
                        <label for="f1abcd" class="color-blue-dark font-13">Mobile Number</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>(required)</em>
                    </div>
                    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4 col-sm-12">
                        <i class="fa fa- fa-image font-12"></i>
                        <input type="file" class="form-control validate-name" name="student_image" id="f1abcd"
                            placeholder="Student Image">
                        @isset($editstudent)
                            <img src="{{ asset('storage/' . $editstudent->student_image ?? '') }}" width="50">
                        @endisset
                        @error('student_image')
                            <div <span class="text-danger">{{ $message }}</span></div>
                        @enderror
                        <label for="file" class="color-blue-dark font-13">Student Image</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>(required)</em>
                    </div>
                    <button type="submit" <a href="#"
                        class="btn btn-full bg-green-dark btn-m text-uppercase rounded-sm shadow-l mb-3 mt-4 font-900">{{ isset($editstudent) ? 'Update' : 'Submit' }}</a></button>
                </div>

        </form>
    </div>
    </div>
    </div>
@endsection
@section('script')

<script>
    $(document).ready(function () {
        $('.class_name').on('change', function () { 
        var class_id=$(this).val();
        var new_url = "{{url('student/sub-section')}}"+'/'+class_id;
        // alert(new_url);
          $.ajax({
            type: "get",
            url: new_url,
            success: function (response) {
                $('#select2Success').html(response);
            }
          });
       });

       @if(isset($edit))
            var class_id = '{{ $edit->classId }}';
            var new_url = "{{ url('student/sub-section') }}" + '/' + class_id;
            $.ajax({
                type: "GET",
                url: new_url,
                success: function (response) {
                    $('#select2Success').html(response);
                    $('#select2Success').val('{{ $edit->sectionId }}').change();
                }
            });
        @endif
    });
</script>
@endsection
