@extends('frontend.includes.main')
@section('content')
{{--  {{ $teacherleaves }}  --}}
{{--  <div class="card card-style">  --}}
    <div class="content mb-5">
        <a href="{{route('staff.teacher-leaves.index')}}">
            <div class="text-end mb-2">
                <button type="button" class="btn btn-primary" title="Teacher Leave"><i
                        class="fas fa-address-card"></i></button>
            </div>
        </a>
    </div>
    <div class="card card-style">
        <div class="content mb-1 ">
            <div class="table-responsive">
        <table class="table table-borderless text-center rounded-sm shadow-l" style="overflow: hidden;">
            <thead>
                <tr style="background-color:#2F539B; color:white;">
                <th scope="col">SR.NO.</th>
                <th scope="col">Subject</th>
                <th scope="col">Description</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">File</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody style="color:#2F539B;">
            @forelse($teacherleaves as $teacherleave)
            <tr>
                <th scope="row">{{ $loop->index+1}}</th>
                <td>{{ $teacherleave->subject ?? '' }}</td>
                <td>{{ $teacherleave->description ?? '' }}</td>
                <td>{{ $teacherleave->start_date ?? '' }}</td>
                <td>{{ $teacherleave->end_date ?? '' }}</td>
                <td>
                    <img src="{{asset('storage/'.$teacherleave->file) }}" width="100">
                </td>
                <td>
                    <a href="{{ route('staff.teacher-leaves.edit', $teacherleave->id) }}" class="btn btn-primary" title="Edit"><i class="fas fa-edit"></i></a>

                    <form action="{{ route('staff.teacher-leaves.destroy', $teacherleave->id)  }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this teacher leaves?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-1" title="Delete"><i class="fas fa-trash-alt" ></i></button>
                    </form>
                </td>

            </tr>
            @empty
            teacher leaves not found
            @endforelse
        </tbody>
    </table>
        </div>
</div>


</div>
@endsection
