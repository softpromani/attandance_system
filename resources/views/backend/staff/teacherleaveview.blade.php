@extends('frontend.includes.main')
@section('content')
<div class="content ">
    <div class="row">
        <div class="col">
            <h2 class="">Apply Leave</h2>
        </div>
        <div class="text-end col">
            <a href="{{ route('staff.teacher-leaves.index') }}">
                <button type="button" class="btn btn-success" title="Leave"><i class="fa fa-id-card-o"></i></button>
            </a>
        </div>
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
                <th scope="col">Status</th>
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
                    @if($teacherleave->status==1)
                    <p class="text-white bg-success rounded-pill">Approved</p>
                    @elseif($teacherleave->status==2)
                    <p class="text-dark bg-danger rounded-pill">Declined</p>
                    @else
                    <p class="text-dark bg-warning rounded-pill">Pending</p>
                    @endif
                </td>
                    @if($teacherleave->status==1)
                    <td class="disabled">
                    <a href="{{ route('staff.teacher-leaves.edit', $teacherleave->id) }}" class="btn btn-primary" title="Edit"><i class="fas fa-edit"></i></a>

                    <form action="{{ route('staff.teacher-leaves.destroy', $teacherleave->id)  }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this teacher leaves?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-1" title="Delete"><i class="fas fa-trash-alt" ></i></button>
                    </form>
                </td>
                @elseif($teacherleave->status==0)
                <td class="disabled">
                    <a href="{{ route('staff.teacher-leaves.edit', $teacherleave->id) }}" class="btn btn-primary" title="Edit"><i class="fas fa-edit"></i></a>

                    <form action="{{ route('staff.teacher-leaves.destroy', $teacherleave->id)  }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this teacher leaves?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-1" title="Delete"><i class="fas fa-trash-alt" ></i></button>
                    </form>
                </td>
                else
                <td>
                    <a href="{{ route('staff.teacher-leaves.edit', $teacherleave->id) }}" class="btn btn-primary" title="Edit"><i class="fas fa-edit"></i></a>

                    <form action="{{ route('staff.teacher-leaves.destroy', $teacherleave->id)  }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this teacher leaves?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-1" title="Delete"><i class="fas fa-trash-alt" ></i></button>
                    </form>
                </td>
                @endif
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
