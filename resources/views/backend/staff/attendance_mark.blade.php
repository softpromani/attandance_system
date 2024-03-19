@extends('frontend.includes.main')
@section('content')
    <div class="content ">
        <div class="row">
            <div class="col">
                <h2 class="">View Mark</h2>
            </div>
            <div class="text-end col"> 
                <p style="color: maroon; vertical-align: middle; font-size: 14pt; margin-top: 15px; font-weight: 700; ">{{ \Carbon\Carbon::now('Asia/Kolkata')->format('d, M, Y') }}
                </p>
            </div>
        </div>
    </div>
    <div class="card card-style">
        <div class="content mb-0">
            <h1 class="text-center mb-0">Mark Attendance</h1>
            <p class="text-center color-highlight mt-n1 font-12">{{ucwords(auth()->user()->name)}}</p>
            <p class="text-center mt-n3 mb-0 pb-0">
                @if ($punching == null)
                <a href="{{ route('staff.qrscanner') }}" class="btn btn-sm bg-green-dark text-uppercase font-700 text-uppercase rounded-s shadow-xl mb-2 mt-2">Punching </a>
                @else
                  <button class="btn btn-sm bg-green-dark font-700 rounded-s shadow-xl mb-2 mt-2"> <p class="text-light"><strong>Punching Time {{ DateTime::createFromFormat('Y-m-d H:i:s', $punching)->format('h:i A')??''}} </strong></p> </button>
                @endif
                @if ($punchout == null)
                <a href="{{ route('staff.qrscanner') }}" class="btn btn-sm bg-red-dark text-uppercase font-700 text-uppercase rounded-s shadow-xl mb-2 mt-2">Punchout</a>
                @else
                  <button class="btn btn-sm bg-red-dark font-700 rounded-s shadow-xl mb-2 mt-2"> <p class="text-light"><strong>Punchout Time {{ DateTime::createFromFormat('Y-m-d H:i:s', $punchout)->format('h:i A')??''}} </strong></p> </button>
                @endif
               
                </p>
        </div>
    </div>
@endsection
@section('script')
@endsection
