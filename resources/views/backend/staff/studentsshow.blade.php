@extends('frontend.includes.main')
@section('content')

<div class="content ">
    <div class="row">
        <div class="col">
            <h2 class="">Student Data</h2>
        </div>
        <div class="text-end col">
            <a href="{{route('student.student.create')}}">
                <div class="text-end mb-2">
                    <button type="button" class="btn btn-primary" title="Add Student"><i
                            class="fas fa-address-card"></i></button>
                </div>
            </a>
        </div>
    </div>
</div>


<div class="card card-style">
    <div class="content mb-1 ">
        <div class="table-responsive">
            <table class="table datatables  ">
                <thead>
                    <tr style="background-color:#2F539B;">
                        <th scope="col" class="color-white">Sr.No</th>
                        <th scope="col" class="color-white">Student Name</th>
                        <th scope="col" class="color-white">Date of Birth</th>
                        <th scope="col" class="color-white">Gender</th>
                        <th scope="col" class="color-white">Father Name</th>
                        <th scope="col" class="color-white" >Class</th>
                        <th scope="col" class="color-white">Section</th>
                        <th scope="col" class="color-white">Mobile Number</th>
                        <th scope="col" class="color-white">Student Image</th>
                        <th scope="col" class="color-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>
                {{-- <tbody style="color:#2F539B;">
                    @forelse($students as $student)
                    <tr>
                        <th scope="row">{{ $loop->index+1}}</th>
                        <td>{{ $student->student_name ?? '' }}</td>
                        <td>{{ $student->date_of_birth ?? '' }}</td>
                        <td>{{ $student->father_name ?? '' }}</td>
                        <td>{{ $student->class ?? '' }}</td>
                        <td>{{ $student->section ?? '' }}</td>
                        <td>{{ $student->mobile_number ?? '' }}</td>
                        <td>
                            <img src="{{asset('storage/'.$student->student_image) }}" width="100">
                        </td>
                        <td>
                            <a href="{{ route('student.student.edit', $student->id) }}" class="btn btn-primary"
                                title="Edit"><i class="fas fa-edit"></i></a>

                            <form action="{{ route('student.student.destroy', $student->id)  }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this student?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mt-1" title="Delete"><i
                                        class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>

                    </tr>
                    @empty
                    Student not found
                    @endforelse
                </tbody> --}}
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')

<script>
    $(document).ready(function() {
        var dataTable = $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('student.student.index') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                },
                {
                    data: 'student_name',
                    name: 'student_name',
                },
                {
                    data: 'date_of_birth',
                    name: 'date_of_birth',
                },
                {
                    data: 'gender',
                    name: 'gender',
                },
                {
                    data: 'father_name',
                    name: 'father_name',
                },
                {
                    data: 'class',
                    name: 'class',
                },
                {
                    data: 'section',
                    name: 'section',
                },
                {
                    data: 'mobile_number',
                    name: 'mobile_number',
                },
                {
                    data: 'student_image',
                    name: 'student_image',
                    render: function (data) {
                if (data !== null) {
                    return '<img src="' + data + '" alt="student Img" class="img-thumbnail" style="height: 100px; width:150px;">';
                } else {
                    return 'No Image';
                }
            }
        },
                {
                    data: 'action',
                    name: 'action',
                },
            ]
        });
    });
</script>
@endsection
