@extends('layouts.main',['title'=>'GRADES','active'=>'my_classes'])

@section('content')
    <div class="w-100 h-100 px-5 py-2">
        <!-- <h2 class="mb-3">DASHBOARD</h2> -->

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

        <div class="container my-4">
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="d-flex flex-column gap-1">
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">TEACHER:</strong>{{ $subject_teacher->faculty->fname }} {{ $subject_teacher->faculty->lname }}</p>
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">ACADEMIC TRACK:</strong>GENERAL ACADEMIC STRAND</p>
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">GRADE & SECTION:</strong>Grade {{ $subject_teacher->subject->level }} - {{ $subject_teacher->section->name }}</p>
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">SUBJECT:</strong>{{ $subject_teacher->subject->name }}</p>
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">REGION:</strong>V</p>
                        <!-- <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">Data:</strong> {{ $subject_teacher }}</p> -->
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="d-flex flex-column gap-1">
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">SCHOOL YEAR:</strong>{{ $subject_teacher->semester->start_year }}-{{ $subject_teacher->semester->end_year }}</p>
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">SCHOOL NAME:</strong>MORENO INTEGRATED SCHOOL</p>
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">SEMESTER:</strong>{{ $subject_teacher->semester->name }}</p>
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">QUARTER:</strong>{{ $subject_teacher->quarter->name }}</p>
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">DIVISION:</strong>CAMARINES NORTE</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 shadow rounded">
            <!-- Filters -->
            <div class="d-flex justify-content-between align-items-center">
                
                <div class="d-flex gap-4 my-4 text-center fw-bold w-100">
                    <div class="">
                        <label for="written" class="form-0 mb-0">Written Works</label>
                        <select id="written" class="form-select form-select-sm rounded-pill bg-transparent border-success">
                            <option selected>20%</option>
                            <option>30%</option>
                            <option>50%</option>
                        </select>
                    </div>
                    <div class="">
                        <label for="performance" class="form-label mb-0">Performance Task</label>
                        <select id="performance" class="form-select form-select-sm rounded-pill bg-transparent border-success">
                            <option>20%</option>
                            <option selected>30%</option>
                            <option>50%</option>
                        </select>
                    </div>
                    <div class="">
                        <label for="exam" class="form-label mb-0">Exam</label>
                        <select id="exam" class="form-select form-select-sm rounded-pill bg-transparent border-success">
                            <option>20%</option>
                            <option>30%</option>
                            <option selected>50%</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('teacher.grade.exportGradesCsv', $uuid) }}" class="btn text-white rounded-pill" style="background-color: #189993; width: 10rem">
                        Export Grades
                    </a>
                    <a href="{{ route('teacher.grade.edit', $uuid) }}" class="btn text-white rounded-pill" style="background-color: #189993; width: 10rem">
                        Input Grades
                    </a>
                </div>
            </div>

            <div class="mb-4">
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="fw-bold border-bottom">
                            <tr>
                                <th class="bg-transparent"></th>
                                <th class="bg-transparent">Students Name</th>
                                <th class="bg-transparent">Written Work</th>
                                <th class="bg-transparent">Performance Task</th>
                                <th class="bg-transparent">Exam</th>
                                <th class="bg-transparent">Grades</th>
                                <th class="bg-transparent">Remarks</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- Male -->
                            <tr>
                                <th class="bg-transparent">No.</th>
                                <th class="bg-transparent">Male</th>
                                <!-- Written Work -->
                                <th class="p-0 bg-transparent">
                                    <div class="exam" style="display: grid; grid-template-columns: repeat(5, 2rem); border: 1px solid #cbd5e1;">
                                        @for ($i = 0; $i < 5; $i++)
                                        <div
                                            class="grade-display text-center"
                                            data-max="10"
                                            data-index="{{ $i }}"
                                            style="border-right: 1px solid #cbd5e1; width: 100%; height: 100%; padding: 4px; background-color: transparent;"
                                        >10</div>
                                        @endfor
                                    </div>
                                    <div class="text-center pt-1">
                                        Total: <span id="writtenWorkTotal">{{ 10 * 5 }}</span>
                                    </div>
                                </th>
                                <!-- Performance Task -->
                                <th class="p-0 bg-transparent">
                                    <div class="exam" style="display: grid; grid-template-columns: repeat(5, 2rem); border: 1px solid #cbd5e1;">
                                        @for ($i = 0; $i < 5; $i++)
                                        <div
                                            class="grade-display text-center"
                                            data-max="10"
                                            data-index="{{ $i }}"
                                            style="border-right: 1px solid #cbd5e1; width: 100%; height: 100%; padding: 4px; background-color: transparent;"
                                        >10</div>
                                        @endfor
                                    </div>
                                    <div class="text-center pt-1">
                                        Total: <span id="performanceTaskTotal">{{ 10 * 5 }}</span>
                                    </div>
                                </th>
                                <!-- Exam -->
                                <th class="p-0 bg-transparent">
                                    <div class="exam" style="display: grid; grid-template-columns: repeat(5, 2rem); border: 1px solid #cbd5e1;">
                                        @for ($i = 0; $i < 5; $i++)
                                        <div
                                            class="grade-display text-center"
                                            data-max="10"
                                            data-index="{{ $i }}"
                                            style="border-right: 1px solid #cbd5e1; width: 100%; height: 100%; padding: 4px; background-color: transparent;"
                                        >50</div>
                                        @endfor
                                    </div>
                                    <div class="text-center pt-1">
                                        Total: <span id="examTotal">{{ 50 * 5 }}</span>
                                    </div>
                                </th>
                                <th class="bg-transparent">Quarterly</th>
                                <th class="bg-transparent"></th>
                            </tr>

                            @foreach ($Mstudents as $key => $student)
                            <input type="hidden" name="grades[{{ $student->id }}][student_id]" value="{{ $student->id }}">
                            <input type="hidden" name="grades[{{ $student->id }}][remarks]" class="remarks-input" value="">
                            <input type="hidden" name="grades[{{ $student->id }}][final_grade]" class="final-grade-input">
                            <input type="hidden" name="grades[{{ $student->id }}][total_grade]" class="total-grade-input">
                            
                            <tr data-student-id="{{ $student->id }}">
                                <td style="background-color: transparent;">{{ $key + 1 }}</td>
                                <td style="background-color: transparent;">{{ $student->fname }}</td>

                                <!-- Written Work -->
                                <td style="background-color: transparent; padding: 0;">
                                    <div class="written-work" style="display: grid; grid-template-columns: repeat(5, 2rem); border: 1px solid #cbd5e1;">
                                        @if (!empty($student->written_work_scores) && count($student->written_work_scores))
                                            @foreach ($student->written_work_scores as $i => $score)
                                                <div
                                                    class="grade-display text-center"
                                                    data-index="{{ $i }}"
                                                    name="grades[{{ $student->id }}][written_work][]"
                                                    data-value="{{ rtrim(rtrim(number_format($score, 2, '.', ''), '0'), '.') }}"
                                                >
                                                    <div class="border">
                                                        {{ rtrim(rtrim(number_format($score, 2, '.', ''), '0'), '.') }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            @for ($i = 0; $i < 5; $i++)
                                                <div
                                                    class="grade-display text-center"
                                                    data-index="{{ $i }}"
                                                    name="grades[{{ $student->id }}][written_work][]"
                                                    data-value="0"
                                                >
                                                    <div class="border">
                                                        0
                                                    </div>
                                                </div>
                                            @endfor
                                        @endif
                                    </div>
                                </td>

                                <!-- Performance Task -->
                                <td style="background-color: transparent; padding: 0;">
                                    <div class="performance-task" style="display: grid; grid-template-columns: repeat(5, 2rem); border: 1px solid #cbd5e1;">
                                        @if (!empty($student->performance_task_scores) && count($student->performance_task_scores))
                                            @foreach ($student->performance_task_scores as $i => $score)
                                                <div
                                                    class="grade-display text-center"
                                                    data-index="{{ $i }}"
                                                    data-value="{{ rtrim(rtrim(number_format($score, 2, '.', ''), '0'), '.') }}"
                                                    name="grades[{{ $student->id }}][performance_task][]"
                                                >
                                                    <div class="border">
                                                        {{ rtrim(rtrim(number_format($score, 2, '.', ''), '0'), '.') }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            @for ($i = 0; $i < 5; $i++)
                                                <div
                                                    class="grade-display text-center"
                                                    data-index="{{ $i }}"
                                                    data-value="0"
                                                    name="grades[{{ $student->id }}][performance_task][]"
                                                >
                                                    <div class="border">
                                                        0
                                                    </div>
                                                </div>
                                            @endfor
                                        @endif
                                    </div>
                                </td>

                                <!-- Exam -->
                                <td style="background-color: transparent; padding: 0;">
                                    <div class="exam" style="display: grid; grid-template-columns: repeat(5, 2rem); border: 1px solid #cbd5e1;">
                                        @if (!empty($student->exam_scores) && count($student->exam_scores))
                                            @foreach ($student->exam_scores as $i => $score)
                                                <div
                                                    class="grade-display text-center"
                                                    data-index="{{ $i }}"
                                                    name="grades[{{ $student->id }}][exam][]"
                                                    data-value="{{ rtrim(rtrim(number_format($score, 2, '.', ''), '0'), '.') }}"
                                                >
                                                    <div class="border">
                                                        {{ rtrim(rtrim(number_format($score, 2, '.', ''), '0'), '.') }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            @for ($i = 0; $i < 5; $i++)
                                                <div
                                                    class="grade-display text-center"
                                                    data-index="{{ $i }}"
                                                    data-value="0"
                                                    name="grades[{{ $student->id }}][exam][]"
                                                >
                                                    <div class="border">
                                                        0
                                                    </div>
                                                </div>
                                            @endfor
                                        @endif
                                    </div>
                                </td>

                                <!-- Quarterly Grade -->
                                <td class="total-grade bg-transparent">
                                    0
                                </td>

                                <!-- Remarks -->
                                <td class="bg-transparent">
                                    <div 
                                        class="remarks badge rounded-pill text-white" 
                                        style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;"
                                    >
                                        remarks...
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            <!-- Female -->
                            <tr>
                                <th class="bg-transparent">No.</th>
                                <th class="bg-transparent">Female</th>
                                <th class="bg-transparent" colspan="3"></th>
                                <th class="bg-transparent">Quarterly</th>
                                <th class="bg-transparent"></th>
                            </tr>

                            @foreach ($Fstudents as $key => $student)
                            <input type="hidden" name="grades[{{ $student->id }}][student_id]" value="{{ $student->id }}">
                            <input type="hidden" name="grades[{{ $student->id }}][remarks]" class="remarks-input" value="">
                            <input type="hidden" name="grades[{{ $student->id }}][final_grade]" class="final-grade-input">
                            <input type="hidden" name="grades[{{ $student->id }}][total_grade]" class="total-grade-input">
                            <tr data-student-id="{{ $student->id }}">
                                <td style="background-color: transparent;">{{ $key + 1 }}</td>
                                <td style="background-color: transparent;">{{ $student->fname }}</td>

                                <!-- Written Work -->
                                <td style="background-color: transparent; padding: 0;">
                                    <div class="written-work" style="display: grid; grid-template-columns: repeat(5, 2rem); border: 1px solid #cbd5e1;">
                                        @if (!empty($student->written_work_scores) && count($student->written_work_scores))
                                            @foreach ($student->written_work_scores as $i => $score)
                                                <div
                                                    class="grade-display text-center"
                                                    data-index="{{ $i }}"
                                                    name="grades[{{ $student->id }}][written_work][]"
                                                    data-value="{{ rtrim(rtrim(number_format($score, 2, '.', ''), '0'), '.') }}"
                                                >
                                                    <div class="border">
                                                        {{ rtrim(rtrim(number_format($score, 2, '.', ''), '0'), '.') }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            @for ($i = 0; $i < 5; $i++)
                                                <div
                                                    class="grade-display text-center"
                                                    data-index="{{ $i }}"
                                                    data-value="0"
                                                    name="grades[{{ $student->id }}][written_work][]"
                                                >
                                                    <div class="border">
                                                        0
                                                    </div>
                                                </div>
                                            @endfor
                                        @endif
                                    </div>
                                </td>

                                <!-- Performance Task -->
                                <td style="background-color: transparent; padding: 0;">
                                    <div class="performance-task" style="display: grid; grid-template-columns: repeat(5, 2rem); border: 1px solid #cbd5e1;">
                                        @if (!empty($student->performance_task_scores) && count($student->performance_task_scores))
                                            @foreach ($student->performance_task_scores as $i => $score)
                                                <div
                                                    class="grade-display text-center"
                                                    data-index="{{ $i }}"
                                                    data-value="{{ rtrim(rtrim(number_format($score, 2, '.', ''), '0'), '.') }}"
                                                    name="grades[{{ $student->id }}][performance_task][]"
                                                >
                                                    <div class="border">
                                                        {{ rtrim(rtrim(number_format($score, 2, '.', ''), '0'), '.') }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            @for ($i = 0; $i < 5; $i++)
                                                <div
                                                    class="grade-display text-center"
                                                    data-index="{{ $i }}"
                                                    data-value="0"
                                                    name="grades[{{ $student->id }}][performance_task][]"
                                                >
                                                    <div class="border">
                                                        0
                                                    </div>
                                                </div>
                                            @endfor
                                        @endif
                                    </div>
                                </td>

                                <!-- Exam -->
                                <td style="background-color: transparent; padding: 0;">
                                    <div class="exam" style="display: grid; grid-template-columns: repeat(5, 2rem); border: 1px solid #cbd5e1;">
                                        @if (!empty($student->exam_scores) && count($student->exam_scores))
                                            @foreach ($student->exam_scores as $i => $score)
                                                <div
                                                    class="grade-display text-center"
                                                    data-index="{{ $i }}"
                                                    name="grades[{{ $student->id }}][exam][]"
                                                    data-value="{{ rtrim(rtrim(number_format($score, 2, '.', ''), '0'), '.') }}"
                                                >
                                                    <div class="border">
                                                        {{ rtrim(rtrim(number_format($score, 2, '.', ''), '0'), '.') }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            @for ($i = 0; $i < 5; $i++)
                                                <div
                                                    class="grade-display text-center"
                                                    data-index="{{ $i }}"
                                                    name="grades[{{ $student->id }}][exam][]"
                                                    data-value="0"
                                                >
                                                    <div class="border">
                                                        0
                                                    </div>
                                                </div>
                                            @endfor
                                        @endif
                                    </div>
                                </td>

                                <!-- Quarterly Grade -->
                                <td class="total-grade bg-transparent">
                                    0
                                </td>

                                <!-- Remarks -->
                                <td class="bg-transparent">
                                    <div 
                                        class="remarks badge rounded-pill text-white" 
                                        style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;"
                                    >
                                        remarks...
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('teacher.index') }}" class="btn btn-outline-secondary">Back</a>
                    <div class="d-flex gap-2">
                        <button type="reset" class="btn btn-outline-secondary">Discard</button>
                        <button type="submit" class="btn btn-info text-white">Save</button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <script>
        function calculateTotal() {
            const rows = document.querySelectorAll('tr');
            
            rows.forEach(row => {
                const getTotal = (className) => {
                    const gradeDisplays = row.querySelectorAll(`.${className} .grade-display`);
                    let total = 0;
                    gradeDisplays.forEach(display => {
                        const val = parseFloat(display.dataset.value) || 0;
                        total += val;
                    });
                    return total;
                };

                const wwTotal = getTotal('written-work');
                const ptTotal = getTotal('performance-task'); // Adjust according to your other score classes
                const examTotal = getTotal('exam');

                // Normalize each to 100, then apply weights
                const wwScore = (wwTotal / 50) * 100 * 0.3;
                const ptScore = (ptTotal / 50) * 100 * 0.5;
                const examScore = (examTotal / 250) * 100 * 0.2;

                const finalGrade = wwScore + ptScore + examScore;

                const gradeCell = row.querySelector('.total-grade');
                if (gradeCell) gradeCell.textContent = finalGrade.toFixed(2);

                const remarksDiv = row.querySelector('.remarks');
                if (remarksDiv) {
                    if (finalGrade >= 75) {
                        remarksDiv.textContent = 'Passed';
                        remarksDiv.classList.remove('bg-danger');
                        remarksDiv.classList.add('bg-success');
                    } else {
                        remarksDiv.textContent = 'Failed';
                        remarksDiv.classList.remove('bg-success');
                        remarksDiv.classList.add('bg-danger');
                    }
                }
            });
        }

        // Call the function on page load
        document.addEventListener('DOMContentLoaded', calculateTotal);

    </script>
@endsection