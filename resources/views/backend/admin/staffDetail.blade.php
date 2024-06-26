@extends('frontend.includes.main')
@section('content')
    <div class="page-content header-clear-medium mt-0">
        <div class="card card-style">
            <div class="content">
                <div class="row mb-0">
                    <div class="col-3">
                        <img src="{{asset('storage/'.$staff->teacher_image)}}" height="80" width="80" class="rounded-xl">
                    </div>
                    <div class="col-9 ps-4">
                        <div class="d-flex">
                            <div>
                                <p class="font-700 color-theme">Name</p>
                            </div>
                            <div class="ms-auto">
                                <p>{{ $staff->name ?? 'NULL' }}</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div>
                                <p class="font-700 color-theme">Email</p>
                            </div>
                            <div class="ms-auto">
                                <p> {{ $staff->email ?? 'NULL' }}</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div>
                                <p class="font-700 color-theme">Father Nmae</p>
                            </div>
                            <div class="ms-auto">
                                <p>{{ $staff->father_name ?? 'NULL' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider mt-3 mb-3"></div>
                <div class="row mb-0">
                    <div class="col-6">
                        <h4 class="font-15">Date Of Birth</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="font-15 text-end mt-1">{{ $staff->dob ?? 'NULL' }}</h4>
                    </div>
                    <div class="divider divider-margins w-100 mt-2 mb-2"></div>
                    <div class="col-6">
                        <h4 class="font-15 mt-1">Anniversary Date</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="font-15 text-end mt-1">{{ $staff->anniversary_date ?? 'NULL' }}</h4>
                    </div>
                    <div class="divider divider-margins w-100 mt-2 mb-2"></div>
                    <div class="col-6">
                        <h4 class="font-15 mt-1">Joining Date</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="font-15 text-end mt-1">{{ $staff->joining_date ?? 'NULL' }}</h4>
                    </div>
                    <div class="divider divider-margins w-100 mt-2 mb-2"></div>
                    <div class="col-6">
                        <h4 class="font-15 mt-1">Mobile Number</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="font-15 text-end mt-1">{{ $staff->mobile_number ?? 'NULL' }}</h4>
                    </div>
                    <div class="divider divider-margins w-100 mt-2 mb-2"></div>
                    <div class="col-6"><a href="{{ route('admin.editStaff', $staff->id) }}"
                            class="btn btn-full btn-m bg-blue-dark rounded-sm text-uppercase font-800 mt-3"><i
                                class="fas fa-edit"></i></a></div>

                    <div class="col-6"><a href="{{ route('admin.editPassword', $staff->id) }}"
                            class="btn btn-full btn-m bg-blue-dark rounded-sm text-uppercase font-800 mt-3"><i
                                class="fa fa-key" aria-hidden="true"></i></a></div>

                </div>
            </div>
        </div>
    </div>
@endsection
