@extends('frontend.includes.main')
@section('title', 'mark')
@section('style')
<div class="card card-style mt-3">
    <div class="content mb-0">
        <h3>Set Up Your Leaves </h3>
        <p>


            These boxes will react to them when you type or select a value.
        </p>
        {{--  <form action="{{(route('leave-set-up.store'))}}" method="post">
        @csrf  --}}

        <form action="{{ isset($lvdata) ? route('leave-set-up.update', $lvdata->id) : route('leave-set-up.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @isset($lvdata)
                @method('PATCH')
            @endisset

            <div class="input-style has-borders no-icon mb-4">
                <label for="form5" class="color-highlight">Select Type</label>
                <select id="form5" name="type">
                    @if (@isset($lvdata))
                        <option value="{{ $lvdata->type }}" selected="">{{ $lvdata->type }}</option>
                        @foreach (\App\Models\LeaveSetup::$type as $casual => $casual)
                            <option value="{{ $casual }}">{{ $casual }}</option>
                        @endforeach
                    @else
                        <option value="Default" disabled="" selected="">Select Type</option>
                        @foreach (\App\Models\LeaveSetup::$type as $casual => $casual)
                            <option value="{{ $casual }}">{{ $casual }}</option>
                        @endforeach
                    @endif
                </select>
                <span><i class="fa fa-chevron-down"></i></span>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <i class="fa fa-check disabled invalid color-red-dark"></i>
                <em></em>
            </div>

            {{--  <div class="input-style has-borders no-icon mb-4">
            <input type="date" name="leave_date" value="Select Date" max="2030-01-01" min="2021-01-01" class="form-control validate-text" id="form6" placeholder="Phone">
            <label for="form6" class="color-highlight">Select Date</label>
            <i class="fa fa-check disabled valid me-4 pe-3 font-12 color-green-dark"></i>
            <i class="fa fa-check disabled invalid me-4 pe-3 font-12 color-red-dark"></i>
            </div>  --}}


<div class="input-style has-borders no-icon mb-4">
    <label for="form5" class="color-highlight">Select Year </label>
    @php $y=isset($lvdata)?$lvdata->years:old('year',''); @endphp
    <select id="form5" name="year">
        <option value='' selected>--Select Year --</option>
        @for($i=\Carbon\Carbon::now()->year; $i<\Carbon\Carbon::now()->year+6; $i++)
            <option value="{{$i}}" @selected($y==$i)>{{$i}}</option>
        @endfor
    </select>
    <span><i class="fa fa-chevron-down"></i></span>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <i class="fa fa-check disabled invalid color-red-dark"></i>
    <em></em>
</div>





            <div class="input-style has-borders no-icon validate-field mb-4">
                <input type="number" name="paid_leave" class="form-control validate-text"
                    value="{{ $lvdata->paid_leave ?? '' }}" id="form4" placeholder="Paid Leave">
                <label for="form4" class="color-highlight">Paid Leave</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(required)</em>
            </div>
            <div class="input-style has-borders no-icon validate-field mb-4">
                <input type="number" name="unpaid_leave" class="form-control validate-text"
                    value="{{ $lvdata->unpaid_leave ?? '' }}" id="form4" placeholder="Un-Paid Leave">
                <label for="form4" class="color-highlight">Un-Paid Leave</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(required)</em>
            </div>
            <div class="text-end mb-2">
                <input type="submit" class="btn btn-primary" value="Apply">
            </div>
        </form>
    </div>
</div>


<div class="page-content clear-medium ">
    <div class="card card-style ">
        <div class="content">
            <h3>Apply Leave Data </h3>

            <div class="table-responsive">
                <table class="table table-borderless text-center rounded-sm shadow-l">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Id</th>
                            <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Type</th>
                            <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Date</th>
                            <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Paid Leave</th>
                            <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Un Paid Leave
                            </th>
                            <th scope="col" class="bg-night-light border-dark-dark py-3 color-white">Edit Leave</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leave as $dt)
                            <tr class="">
                                <th scope="row">{{ $loop->index + 1 }}</th>

                                <th scope="row">{{ $dt->type }}</th>
                                <th scope="row">{{ $dt->years }}</th>
                                <th scope="row">{{ $dt->paid_leave }}</th>
                                <th scope="row">{{ $dt->unpaid_leave }}</th>
                                <th scope="row"> <a href="{{ route('leave-set-up.edit', $dt->id) }}"
                                        class="btn btn-primary mb-1" href="#"><i class="fas fa-edit"></i></a></th>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            {{ $leave->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
<script></script>

@endsection
