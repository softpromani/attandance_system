@extends('frontend.includes.main')
@section('title', 'Setting')
@section('content')
<div class="content">
    <h2 class="">System Settings</h2>
</div>
<div id="page">
        <div class="content">
            <div class="row mb-n3">
                <div class="col-6 ps-2">
                    <a href="" class="text-success" data-bs-toggle="modal" data-bs-target="#classModal">
                        <div class="card card-style bg-danger shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="100">
                            <div class="card-top p-3">
                                <h3 class="color-white d-block  pt-1">Manage Class</h3>
                            </div>
                            
                        </div>
                    </a>
                </div>
                <div class="col-6 ps-2">
                    <a href="" class="text-success" data-bs-toggle="modal" data-bs-target="#SectionModal">
                        <div class="card card-style gradient-blue shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="100">
                            <div class="card-top p-3">
                                <h3 class="color-white d-block  pt-1">Manage Section</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 ps-2">
                    <a href="{{ route('admin.setmap') }}" >
                        <div class="card card-style gradient-yellow shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="100">
                            <div class="card-top p-3">
                                <h3 class="color-white d-block  pt-1">Set Area</h3>
                            </div>
                        </div>
                    </a>
                </div>
        {{-- <li><button type="button" class="text-success" data-bs-toggle="modal" data-bs-target="#classModal"><strong>Add Class</strong></button></li>
        <li><button type="button" class="text-success" data-bs-toggle="modal" data-bs-target="#SectionModal"><strong>Add Section</strong></button></li> --}}
            </div>
        </div>
</div>
<!-- Modal Class -->
<div class="modal fade" id="classModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ isset($edit) ? route('admin.jsfclass.update',$edit->id) : route('admin.jsfclass.store') }}" method="post">
                    @csrf
                    @isset($edit)
                    @method('put')
                    @endisset
                    <div class="input-style input-style-always-active has-borders validate-field mt-4">
                        <input type="text" name="addclass" value="{{ isset($edit)?$edit->class:'' }}" class="form-control" id="form6" placeholder="Enter Class name" required>
                        <label for="form6" class="color-blue-dark font-13">Class</label>
                        <i class="fa fa-check disabled valid me-4 pe-3 font-12 color-green-dark"></i>
                        <i class="fa fa-check disabled invalid me-4 pe-3 font-12 color-red-dark"></i>
                    </div>
                    <button type="submit" class="btn btn-full bg-green-dark btn-m text-uppercase rounded-sm shadow-l mb-3 mt-2 font-700">{{ isset($edit) ? 'Update' : 'Submit' }}</button>
                </form>
                <hr>
                <h5>All Class</h5>
                <div class="table-responsive">
                    <table class="table table-border rounded-sm shadow-l datatables" style="overflow: hidden; width:100%;" >
                        <thead>
                            <tr style="background-color:#2F539B;">
                                <th scope="col" style="color:white;">Sr. No</th>
                                <th scope="col" style="color:white;">Class</th>
                                <th scope="col" style="color:white;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="SectionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ isset($edit) ? route('admin.section.update',$edit->id) : route('admin.section.store') }}" method="post">
                    @csrf
                    @isset($edit)
                    @method('put')
                    @endisset
                    <div class="input-style has-borders no-icon validate-field input-style-always-active pt-2">
                        <label for="form5a" class="color-green-dark">Select Class</label>
                        <select id="form5a" name="ClassId">
                            <option selected disabled>select Class</option>
                            @foreach ($classes as $cl)
                            <option value="{{ $cl->id }}" @if(isset($edit) && $edit->class_id == $cl->id) selected @endif>{{ $cl->class }}</option>
                            @endforeach
                        </select>
                        <span><i class="fa fa-chevron-down"></i></span>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <i class="fa fa-check disabled invalid color-red-dark"></i>
                        <em></em>
                    </div>
                    
                    
                    <div class="input-style input-style-always-active has-borders validate-field mt-4">
                        <input type="text" name="section" class="form-control" value="{{ isset($edit)?$edit->section:'' }}" id="form6" placeholder="Enter section name" required>
                        <label for="form6" class="color-green-dark font-13">Section</label>
                        <i class="fa fa-check disabled valid me-4 pe-3 font-12 color-green-dark"></i>
                        <i class="fa fa-check disabled invalid me-4 pe-3 font-12 color-red-dark"></i>
                    </div>
                    <button type="submit" class="btn btn-full bg-green-dark btn-m text-uppercase rounded-sm shadow-l mb-3 mt-2 font-700">{{ isset($edit) ? 'Update' : 'Submit' }}</button>
                </form>
                <hr>
                <h5>All Class</h5>
                <div class="table-responsive">
                    <table class="table table-border rounded-sm shadow-l secdatatables" style="overflow: hidden; width:100%;" >
                        <thead>
                            <tr style="background-color:#2F539B;">
                                <th scope="col" style="color:white;">Sr. No</th>
                                <th scope="col" style="color:white;">Class</th>
                                <th scope="col" style="color:white;">Section</th>
                                <th scope="col" style="color:white;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
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
            ajax: "{{ route('admin.systemSetting') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                },
                {
                    data: 'class',
                    name: 'class',
                },
                
                {
                    data: 'action',
                    name: 'action',
                },
            ]
        });
    });
</script>
<script>
    $(document).ready(function() {
        var dataTable = $('.secdatatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.section.index') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                },
                {
                    data: 'clname',
                    name: 'clname',
                },
                {
                    data: 'section',
                    name: 'section',
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
