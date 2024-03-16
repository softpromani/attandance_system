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
            <table class="table table-borderless text-center sm-4 ">
                <thead>
                    <tr style="background-color:#2F539B; color:white;">
                        <th scope="col">SR.NO.</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Date of Birth</th>
                        <th scope="col">Father Name</th>
                        <th scope="col">Class</th>
                        <th scope="col">Section</th>
                        <th scope="col">Mobile Number</th>
                        <th scope="col">Student Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody style="color:#2F539B;">
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
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
