@extends('layouts.main', ['title' => 'SUBJECT', 'active' => 'subject'])


@section('content')
    <div class="container pt-5 w-100">
        <div class="d-flex justify-content-between items-center mb-3">
            <div class="d-flex gap-3 items-center w-50">
                <h4 class="fw-semibold">Subject List</h4>
                <p class="m-0">Home - Subject</p>
            </div>
        </div>
        @if (session('msg'))
            <script>
                Swal.fire({
                    title: 'Successful',
                    text: "{{ session('msg') }}",
                    icon: 'success',
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    title: 'Error',
                    text: "{{ session('error') }}",
                    icon: 'error',
                });
            </script>
        @endif

        <div class="bg-white p-4 shadow rounded">
            @if($formattedGrades->isEmpty())
                <p>No subjects assigned to your section yet.</p>
            @else
                <table id="studentSubjectsTable" class="table table-hover table-white rounded">
                    <thead>
                        <tr>
                            <th class="bg-transparent p-2 px-4">Subject</th>
                            <th class="bg-transparent p-2">Instructor</th>
                            <th class="bg-transparent p-2 text-start">Q1 Grade</th>
                            <th class="bg-transparent p-2 text-start">Q2 Grade</th>
                            <th class="bg-transparent p-2 text-start">Final Grade</th>
                            <th class="bg-transparent p-2">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($formattedGrades as $grade)
                            <tr>
                                <td class="bg-transparent p-2">{{ $grade['subject'] }}</td>
                                <td class="bg-transparent p-2">{{ $grade['instructor'] }}</td>
                                <td class="bg-transparent p-2 text-start">{{ $grade['q1_grade'] ?? 'N/A' }}</td>
                                <td class="bg-transparent p-2 text-start">{{ $grade['q2_grade'] ?? 'N/A' }}</td>
                                <td class="bg-transparent p-2 text-start">{{ $grade['final_grade'] ?? 'N/A' }}</td>
                                <td class="bg-transparent p-2">
                                    <span class="badge rounded-pill 
                                        {{ $grade['remarks'] === 'Failed' ? 'bg-danger' : 'bg-success' }}">
                                        {{ $grade['remarks'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#studentSubjectsTable').DataTable({
                responsive: true,
                paging: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25],
                searching: true,
                ordering: true,
                columnDefs: [
                    { orderable: false, targets: 3 }
                ],
                language: {
                    search: "Search Records:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No records available",
                    zeroRecords: "No matching records found",
                    paginate: {
                        previous: "Previous",
                        next: "Next"
                    }
                }
            });
        });
    </script>

@endsection