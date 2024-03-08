@extends('frontend.includes.head')
{{--  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">  --}}

@extends('frontend.includes.loader')
@extends('frontend.includes.footer')
<div class="card card-style">
    <div class="content mb-2">
    <h3>Teacher's Data </h3>


    <p>
    Dark tables are always gorgeous.
    </p>
    <table class="table table-borderless text-center rounded-sm shadow-l">
    <thead>
    <tr>
    <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Id</th>
    <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Name</th>
    <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Father Name</th>
    <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">DOB</th>
    <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Mobile Number</th>
    <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Anniversary Date</th>
    <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Joining Date</th>
    <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Teacher Image</th>
    <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Action</th>

    </tr>
    </thead>
    <tbody>
        @foreach ($data as $dt)
    <tr class="">
        <th scope="row">{{$loop->index+1}}</th>

    <th scope="row">{{$dt->full_name}}</th>
    <th scope="row">{{$dt->fathers_name}}</th>
    <th scope="row">{{$dt->dob}}</th>
    <th scope="row">{{$dt->mobile_number}}</th>
    <th scope="row">{{$dt->anniversary_date}}</th>
    <th scope="row">{{$dt->joining_date}}</th>
    <th scope="row"><img src="{{asset('storage/'.$dt->teacher_image)}}" alt="jpg" width="50" height="50"></th>
    <th scope="row"> <a href="{{ route('teacherEditData', $dt->id) }}" class="btn btn-primary mb-1" href="#">Edit</a>

        <form action="{{ route('teacherDeleteData', $dt->id)  }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete this student?')">
            @csrf
            @method('POST')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form></th>

    </tr>
    @endforeach

    </tbody>
    </table>
    {{ $data->links('pagination::bootstrap-5') }}
    </div>
    </div>

<script>

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
</script>

@extends('frontend.includes.foot')
