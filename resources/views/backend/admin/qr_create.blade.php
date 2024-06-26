@extends('frontend.includes.main')
@section('content')
    <div class="card card-style">
        <div class="content ">
            <h2 class="pb-3">{{ isset($edit)?'Update QR':'Create QR' }}</h2>
            <form action="{{ isset($edit)?route('admin.qr.update',encrypt($edit->id)):route('admin.qr.store') }}" method="post">
                @csrf
                @isset($edit)
                @method('put')
                @endisset
                <div class="input-style input-style-always-active has-borders validate-field mt-4">
                    <input type="date" value="{{ isset($edit)?date('Y-m-d', strtotime($edit->valid_from)):'' }}" name="from" class="form-control" id="form6" >
                    <label for="form6" class="color-blue-dark font-13">Valid From</label>
                    <i class="fa fa-check disabled valid me-4 pe-3 font-12 color-green-dark"></i>
                    <i class="fa fa-check disabled invalid me-4 pe-3 font-12 color-red-dark"></i>
                    </div>

                    <div class="input-style input-style-always-active has-borders validate-field mt-4">
                        <input type="date" value="{{ isset($edit)?date('Y-m-d', strtotime($edit->valid_to)):'' }}" name="to" class="form-control" id="form7">
                        <label for="form7" class="color-blue-dark font-13">Valid To</label>
                        <i class="fa fa-check disabled valid me-4 pe-3 font-12 color-green-dark"></i>
                        <i class="fa fa-check disabled invalid me-4 pe-3 font-12 color-red-dark"></i>
                        </div>
                <button type="submit" class="btn btn-full bg-green-dark btn-m text-uppercase rounded-sm shadow-l mb-3 mt-4 font-900">{{ isset($edit)?'Update':'Submit' }}</button>
            </form>
        </div>
    </div>  
@endsection


