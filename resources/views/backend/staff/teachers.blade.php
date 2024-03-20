@extends('frontend.includes.main')
@section('title', 'mark')
@section('content')
    <div class="content ">
        <div class="row">
            <div class="col">
                <h2 class="">Teacher Data</h2>
            </div>
            <div class="text-end col">
                <a href="{{ route('staff.TeacherRegester') }}">
                    <div class="text-end mb-2">
                        <button type="button" class="btn btn-primary" title="Add Teacher"><i
                                class="fas fa-chalkboard-teacher"></i></button>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="card card-style">
        <div class="content mb-1 ">
            <div class="table-responsive">
                <table class="table table-borderless text-center rounded-sm shadow-l datatables" style="overflow: hidden;">
                    <thead>
                        <tr style="background-color:#2F539B; ">
                            <th scope="col" class="color-white">Sr.No</th>
                            <th scope="col" class="color-white">Name</th>
                            <th scope="col" class="color-white">Father Name</th>
                            <th scope="col" class="color-white">DOB</th>
                            <th scope="col" class="color-white">Mobile Number
                            </th>
                            <th scope="col" class="color-white">Anniversary Date
                            </th>
                            <th scope="col" class="color-white">Joining Date
                            </th>
                            <th scope="col" class="color-white">Teacher Image
                            </th>
                            <th scope="col" class="color-white">Action</th>

                        </tr>
                    </thead>
                    {{-- <tbody>
                        @foreach ($data as $dt)
                        <tr style="color:#2F539B;">
                                <th scope="row">{{ $loop->index + 1 }}</th>

                                <th scope="row">{{ $dt->full_name }}</th>
                                <th scope="row">{{ $dt->father_name }}</th>
                                <th scope="row">{{ $dt->dob }}</th>
                                <th scope="row">{{ $dt->mobile_number }}</th>
                                <th scope="row">{{ $dt->anniversary_date }}</th>
                                <th scope="row">{{ $dt->joining_date }}</th>
                                <th scope="row"><img src="{{ asset('storage/' . $dt->teacher_image) }}" alt="jpg"
                                        width="50" height="50"></th>
                                <th scope="row"> <a href="{{ route('staff.teacherEditData', $dt->id) }}"
                                        class="btn btn-primary mb-1" href="#"><i class="fas fa-edit"></i></a>

                                    <form action="{{ route('staff.teacherDeleteData', $dt->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this student?')">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-danger"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </th>

                            </tr>
                        @endforeach

                    </tbody> --}}
                    <tbody> </tbody>
                </table>
                {{-- <div class="card-footer">
                    @if (isset($data))
                        {!! $data->links('pagination::bootstrap-5') !!}
                    @endif

                </div> --}}

            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
            // JavaScript functions for edit and delete actions
            function editItem(item) {
                alert('Editing ' + item);
                // Add your edit logic here
            }

        function deleteItem(item) {
            if (confirm('Are you sure you want to delete ' + item + '?')) {
                // Add your delete logic here
                alert('Deleting ' + item);
            }
        }
    </script>
    
<script>
    $(document).ready(function() {
        var dataTable = $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('staff.teacherRegisterData') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'father_name',
                    name: 'father_name',
                },
                {
                    data: 'dob',
                    name: 'dob',
                },
                {
                    data: 'mobile_number',
                    name: 'mobile_number',
                },
                {
                    data: 'anniversary_date',
                    name: 'anniversary_date',
                },
                {
                    data: 'joining_date',
                    name: 'joining_date',
                },
                {
                    data: 'image',
                    name: 'image',
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
