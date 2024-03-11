@extends('frontend.includes.head')
@extends('frontend.includes.loader')
<div class="card card-style">
    {{--  {{$data}}  --}}
    <div class="content mb-0">

        <div class="d-flex justify-content-end">
            <div class="btn-group">
                <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Students
                </button>
                <ul class="dropdown-menu text-center" id="studentDropdown">
                    <!-- Student data will be dynamically added here using JavaScript -->
                </ul>
            </div>
        </div>

        <p>
            Student Billing Page.
        </p>
        @if (isset($data))
            <div class="input-style no-borders no-icon validate-field mb-4">
                <input type="text" class="form-control validate-text" id="form4a"
                    value="{{ $data->registration_number }}" placeholder="Phone" disabled>
                <label for="form4aa" class="color-highlight">Phone</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(required)</em>
            </div>
            <div class="input-style no-borders has-icon validate-field mb-4">
                <i class="fa fa-user"></i>
                <input type="name" class="form-control validate-name" value="{{ $data->student_name }}"
                    id="form1a" placeholder="Name" disabled>
                <label for="form1a" class="color-highlight">Name</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(required)</em>
            </div>
            <div class="input-style no-borders no-icon validate-field mb-4">
                <input type="text" class="form-control validate-text" value="{{ $data->date_of_birth }}"
                    id="form3a" placeholder="Password" disabled>
                <label for="form3a" class="color-highlight">Date Of Birth</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(required)</em>
            </div>
            <div class="input-style no-borders no-icon validate-field mb-4">
                <input type="text" class="form-control validate-text" id="form4a" value="{{ $data->father_name }}"
                    placeholder="Website" disabled>
                <label for="form4a" class="color-highlight">Website</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(required)</em>
            </div>
            <div class="input-style no-borders no-icon validate-field mb-4">
                <input type="text" class="form-control validate-text" id="form4a"
                    value="{{ $data->mobile_number }}" placeholder="Phone" disabled>
                <label for="form4aa" class="color-highlight">Phone</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(required)</em>
            </div>

            <div class="input-style no-borders no-icon validate-field mb-4">
                <input type="text" class="form-control validate-text" id="form4a" value="{{ $data->class }}"
                    placeholder="Phone" disabled>
                <label for="form4aa" class="color-highlight">Phone</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(required)</em>
            </div>

            <div class="input-style no-borders no-icon validate-field mb-4">
                <input type="text" class="form-control validate-text" id="form4a" value="{{ $data->section }}"
                    placeholder="Phone" disabled>
                <label for="form4aa" class="color-highlight">Phone</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(required)</em>
            </div>
        @endif
    </div>
</div>
@extends('frontend.includes.footer')

@extends('frontend.includes.foot')

    <script>
        var studentData = {!! json_encode($studentData) !!};

        // Clear existing options
        document.getElementById('studentDropdown').innerHTML = '';

        // Append options dynamically
        studentData.forEach(function(student) {
            var anchor = document.createElement('a');
            anchor.href = "{{ route('student-bill.edit', '') }}/" + student.id;
            anchor.className = 'dropdown-item';
            anchor.innerText = student.student_name;

            document.getElementById('studentDropdown').appendChild(anchor);
        });
    </script>


