@extends('frontend.includes.main')
@section('title', 'mark')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

    <div class="card card-style">
        <div class="card-header row">
            <div class="form-group col-6">
                <label for="studentSelect">Select Students</label>
                <select class="form-select js-example-basic-single" id="studentSelect">
                    <!-- Option for default selection -->
                    <option value="">Select Student</option>
                </select>
            </div>
        </div>
        @if (isset($students))
            <div class="card-body">
                <div class="content">
                    <div class="container mt-5">
                        <div class="row mb-3">
                            <div class="col-md-4 d-flex">
                                <p><strong>Reg. No :</strong></p>&nbsp;&nbsp; <p>{{ $students->registration_number ?? '' }}
                                </p>
                            </div>
                            <div class="col-md-4 d-flex">
                                <p><strong>Student Name :</strong></p>&nbsp;&nbsp; <p>{{ $students->student_name ?? '' }}
                                </p>
                            </div>
                            <div class="col-md-4 d-flex">
                                <p><strong>Father Name :</strong></p>&nbsp;&nbsp; <p>{{ $students->father_name ?? '' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 d-flex">
                                <p><strong>Date Of birth :</strong></p>&nbsp;&nbsp; <p>{{ $students->date_of_birth ?? '' }}
                                </p>
                            </div>
                            <div class="col-md-4 d-flex">
                                <p><strong>Mobile Number :</strong></p>&nbsp;&nbsp; <p>{{ $students->mobile_number ?? '' }}
                                </p>
                            </div>
                            <div class="col-md-4 d-flex">
                                <p><strong>Class :</strong></p>&nbsp;&nbsp; <p>{{ $students->class ?? '' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 d-flex">
                                <p><strong>Section :</strong></p>&nbsp;&nbsp; <p>{{ $students->section ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @if (isset($students))
        <div class="card card-style">
            <div class="card-header">
                Billing
            </div>
            <div class="container mb-5">
                <form id="stepForm" method="POST" action="{{ route('staff.student-bill.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="step" id="step2">
                        <input type="hidden" value="{{$students->id}}" name="studentid">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>Description</th>
                                    <th>Late Fee</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="feeDetails">
                                <!-- Dynamic rows will be added here -->
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-success add-row"><i class="fa fa-plus"
                                aria-hidden="true"></i></button>
                    </div>
                    <div class="text-end mt-3">
                        Total Sum: <span id="totalSum"></span>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    @endif


@endsection
@section('script')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2 with AJAX support
            $('.js-example-basic-single').select2({
                ajax: {
                    url: '{{ route('staff.student-bill.index') }}',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250, // Add a delay to avoid too many requests while typing
                    processResults: function(data) {
                        // Process the fetched data and return it in the format expected by Select2
                        return {
                            results: $.map(data.studentData, function(student) {
                                return {
                                    id: student.id,
                                    text: student.student_name
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            // Handle the change event when an option is selected
            $('#studentSelect').on('change', function() {
                var selectedStudentId = $(this).val();
                // Make an AJAX call to fetch the details of the selected student
                location.href = '{{ route('staff.student-bill.edit', ':id') }}'.replace(':id', selectedStudentId);
            });
        });

            $(document).ready(function() {
                var currentStep = 1;

                $(".next-step").click(function() {
                    $("#step" + currentStep).hide();
                    currentStep++;
                    $("#step" + currentStep).show();
                });

                $(".prev-step").click(function() {
                    $("#step" + currentStep).hide();
                    currentStep--;
                    $("#step" + currentStep).show();
                });

                // Dynamic row addition
                var rowNumber = 1;
                $(".add-row").click(function() {
                    var newRow = `
                        <tr>
                            <td>${rowNumber}</td>
                            <td>
                                <select name="year[]" class="form-control year">
                                    <option value="">Select Year</option>
                                    @isset($year)
                                    @foreach($year as $yr)
                                    <option value="{{ $yr->id }}">{{ $yr->year}}</option>
                                    @endforeach
                                    @endisset

                                </select>
                            </td>
                            <td>
                                <select name="month[]" class="form-control month">
                                    <option value="" >Select Month</option>
                                    @isset($months)
                                    @foreach($months as $month)
                                    <option value="{{ $month->id }}">{{ $month->month }}</option>
                                    @endforeach
                                    @endisset

                                </select>
                            </td>
                            <td><input type="text" name="desc[]" class="form-control year"></td>
                            <td><input type="number" name="late_fee[]" class="form-control year"></td>
                            <td><input type="number" name="amount[]" class="form-control sum"></td>
                            <td><input type="hidden" name="student_id" class="form-control sum"></td>
                            <td><input type="hidden" name="totalsum" class="form-control sum"></td>
                            <td><span class="remove-row" style="cursor: pointer;"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></td>
                        </tr>
                    `;
                    $("#feeDetails").append(newRow);
                    rowNumber++;
                });

                // Dynamic row removal
                $("#feeDetails").on("click", ".remove-row", function() {
                    // Check if there is at least one row remaining before removal
                    if ($("#feeDetails tr").length > 1) {
                        $(this).closest("tr").remove();
                        // You may need to renumber the rows after removal
                        updateSum();
                    } else {
                        alert("At least one row must remain.");
                    }
                });

                // Update sum on input change
                // Update sum on input change
                $("#feeDetails").on("input", "input[name='fee[]'], input[name='late_fee[]'], input[name='sum[]']",
                    function() {
                        updateSum();
                        updateTotalSum();
                    });

                // Function to update the sum
                function updateSum() {
                    $("#feeDetails tr").each(function() {
                        const fee = parseFloat($(this).find(".fee").val()) || 0;
                        const lateFee = parseFloat($(this).find(".late-fee").val()) || 0;

                        const sum = fee * lateFee;

                        $(this).find(".sum").val(sum.toFixed(2));
                    });
                }

                // Function to update the total sum
                function updateTotalSum() {
                    let totalSum = 0;

                    $("input[name='amount[]']").each(function() {
                        const sum = parseFloat($(this).val()) || 0;
                        totalSum += sum;
                    });

                    $("#totalSum").text(totalSum.toFixed(2));
                }
            });
    </script>

    <script>
        // Update the hidden input value when the total sum changes
        function updateTotalSum() {
            var totalSumElement = document.getElementById('totalSum');
            var totalSumInput = document.querySelector('input[name="amount"]');

            if (totalSumElement && totalSumInput) {
                totalSumInput.value = totalSumElement.textContent;
            }
        }

        // Call the function when the sum changes (you need to call this in your existing code)
        updateSum();

        // Additional code to handle sum calculation and update
        function updateSum() {
            // Your existing code for sum calculation

            // After updating the sum, call the function to update the hidden input
            updateTotalSum();
        }
    </script>
@endsection
