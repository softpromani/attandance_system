@extends('frontend.includes.main')
@section('title', 'mark')
@section('content')
    <style></style>
    
    <div class="page-content clear-medium ">
        <div class="card card-style ">
            <div class="content">
                <h3>Teacher's Data </h3>

                <a href="{{ route('staff.TeacherRegester') }}">
                    <div class="text-end mb-2">
                        <button type="button" class="btn btn-primary" title="Add Teacher"><i
                                class="fas fa-chalkboard-teacher"></i></button>
                    </div>
                </a>

                <div class="table-responsive">
                    <table class="table table-borderless text-center rounded-sm shadow-l">
                        <thead>
                            <tr>
                                <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Id</th>
                                <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Name</th>
                                <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Father Name</th>
                                <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">DOB</th>
                                <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Mobile Number
                                </th>
                                <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Anniversary Date
                                </th>
                                <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Joining Date
                                </th>
                                <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Teacher Image
                                </th>
                                <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $dt)
                                <tr class="">
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

                        </tbody>
                    </table>
                </div>
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        < script >
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
    </script>

@endsection
