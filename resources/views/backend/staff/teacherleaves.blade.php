@extends('frontend.includes.main')
@section('content')

<div class="card card-style">

     @foreach ($errors->all() as $e)
    {{ $e }}
    @endforeach
 <form action="{{ isset($editteacherleave) ? route('staff.teacher-leaves.update',$editteacherleave->id) : route('staff.teacher-leaves.store') }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @isset($editteacherleave)
      @method('PATCH')
    @endisset
    <div class="content mb-0">
        <div class="row">
    <h1>Teacher Leaves</h1>

    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4 col-sm-12">
        <i class="fa fa-user font-12"></i>
        <!-- Select box -->
        {{-- <select class="form-select" name="leave_type" id="f1a">
                @forelse ( $leave as $l )
                @if ($l->name == 'casual leave' )
                @if ($allleaves[0]['leave_count'] = $totalcasualLeave)
                <option value="{{$l->id}}" {{ isset($editteacherleave)?($editteacherleave->leave_type == $l->id ?'selected':''):'' }}>{{ $l->name ?? 'NA'}}</option>
                @endif
                @endif
                @empty
                <option value="">Null</option>
                @endforelse
        </select> --}}
        <select class="form-select" name="leave_type" id="f1a">
            @forelse ($leave as $l)
                @php
                    $isDisabled = false;
                    $optionText = $l->name ?? 'NA';
                    // Check if it's casual leave and if the user has exhausted it
                    if ($l->name === 'casual leave' && isset($allleaves[0]) && $allleaves[0]['leave_count'] >= $totalcasualLeave) {
                        $isDisabled = true;
                        $optionText = 'Connect to Admin';
                    }
                    // Check if it's sick leave and if the user has exhausted it
                    if ($l->name === 'sick leave' && isset($allleaves[1]) && $allleaves[1]['leave_count'] >= $totalsickLeave) {
                        $isDisabled = true;
                        $optionText = 'Connect to Admin';
                    }
                @endphp
                @if (!$isDisabled)
                    <option value="{{ $l->id }}" {{ isset($editteacherleave) && $editteacherleave->leave_type == $l->id ? 'selected' : '' }}>
                        {{ $l->name ?? 'NA' }}
                    </option>
                @endif
            @empty
                <option value="" disabled>No leave types available</option>
            @endforelse
            @if ($isDisabled)
                <option value="" disabled> For Leave Connect to Admin</option>
            @endif
        </select>
        <!-- Error message -->
        @error('leave_type')
        <div><span class="text-danger">{{ $message }}</span></div>
        @enderror
        <label for="f1abcd" class="color-blue-dark font-13"> Leave Type </label>
        <i class="fa fa-times disabled invalid color-red-dark"></i>
        <i class="fa fa-check disabled valid color-green-dark"></i>
        <em>(required)</em>
    </div>

    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4 col-sm-12">
    <i class="fa fa-user font-12"></i>
    <input type="text" class="form-control validate-name" name="subject" id="f1a" placeholder="Subject" value="{{ isset($editteacherleave) ? $editteacherleave->subject : '' }}" value="{{ old('subject') }}">
    @error('subject')
    <div <span class="text-danger">{{ $message }}</span></div>
    @enderror
    <label for="f1abcd" class="color-blue-dark font-13">Subject</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>

    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4 col-sm-12">
        <i class="fa fa-user font-12"></i>
        <!-- Textarea for the description field -->
        <textarea class="form-control" name="description" id="description" rows="5" placeholder="Description">{{ isset($editteacherleave) ? $editteacherleave->description : old('description') }}</textarea>
        <!-- Error message -->
        @error('description')
        <div><span class="text-danger">{{ $message }}</span></div>
        @enderror
        <label for="description" class="color-blue-dark font-13">Description</label>
        <i class="fa fa-times disabled invalid color-red-dark"></i>
        <i class="fa fa-check disabled valid color-green-dark"></i>
        <em>(required)</em>
    </div>

    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4">
    <i class="fa fa-calendar font-12"></i>
    <input type="date" class="form-control validate-name" name="start_date" id="f1abc" placeholder="Start Date" value="{{ isset($editteacherleave) ? $editteacherleave->start_date : '' }}" value="{{ old('start_date') }}">
    @error('start_date')
    <div <span class="text-danger">{{ $message }}</span></div>
    @enderror
    <label for="f1abcd" class="color-blue-dark font-13">Start Date</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>

    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4">
    <i class="fa fa-calendar font-12"></i>
    <input type="date" class="form-control validate-name" name="end_date" id="f1abc" placeholder="End Date" value="{{ isset($editteacherleave) ? $editteacherleave->end_date : '' }}" value="{{ old('end_date') }}">
    @error('end_date')
    <div <span class="text-danger">{{ $message }}</span></div>
    @enderror
    <label for="f1abcd" class="color-blue-dark font-13">End Date</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>

    <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4 col-sm-12">
    <i class="fa fa- fa-image font-12"></i>
    <input type="file" class="form-control validate-name" name="file" id="f1abcd" placeholder="File">
    @isset($editteacherleave)
      <img src="{{ asset('storage/'.$editteacherleave->file ?? '') }}" width="50" >
    @endisset
     @error('file')
     <div <span class="text-danger">{{ $message }}</span></div>
    @enderror
    <label for="file" class="color-blue-dark font-13">File</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>

    <button type="submit" <a href="#" class="btn btn-full bg-green-dark btn-m text-uppercase rounded-sm shadow-l mb-3 mt-4 font-900">{{ isset($editteacherleave) ? 'Update' : 'Submit' }}</a></button>
    </div>

</form>
</div>
</div>
</div>

@endsection
