<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Grade Submission') }}
            </h2>
            <a href="{{ route('teacher.submissions.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Back to Submissions
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Submission Header -->
                    <div class="mb-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $submission->assignment->title }}</h3>
                                <p class="text-lg text-gray-600 dark:text-gray-400">{{ $submission->assignment->course->name }} ({{ $submission->assignment->course->code }})</p>
                                <p class="text-sm text-gray-500 dark:text-gray-500">Submitted by: {{ $submission->student->name }}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-blue-600 dark:text-blue-400">{{ $submission->assignment->total_marks }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Total Marks</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-sm text-gray-600 dark:text-gray-400">Submitted On</div>
                                <div class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                    {{ \Carbon\Carbon::parse($submission->submitted_at)->format('M d, Y \a\t g:i A') }}
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-sm text-gray-600 dark:text-gray-400">Due Date</div>
                                <div class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                    {{ \Carbon\Carbon::parse($submission->assignment->due_date)->format('M d, Y') }}
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-sm text-gray-600 dark:text-gray-400">Status</div>
                                <div class="text-lg font-bold
                                    @if($submission->isLate()) text-red-600 dark:text-red-400
                                    @else text-green-600 dark:text-green-400 @endif">
                                    @if($submission->isLate()) Late @else On Time @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Assignment Description -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold mb-3">Assignment Description</h4>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $submission->assignment->description }}</p>
                        </div>
                    </div>

                    <!-- Student Submission -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold mb-3">Student Submission</h4>

                        <!-- Submission Text -->
                        @if($submission->submission_text)
                            <div class="mb-4">
                                <h5 class="text-md font-medium mb-2">Comments</h5>
                                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 p-4 rounded-lg">
                                    <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $submission->submission_text }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Submission File -->
                        @if($submission->file_path)
                            <div class="mb-4">
                                <h5 class="text-md font-medium mb-2">Submitted File</h5>
                                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4 rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <svg class="w-8 h-8 text-green-600 dark:text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ basename($submission->file_path) }}</p>
                                                <p class="text-xs text-gray-600 dark:text-gray-400">Click to download and review</p>
                                            </div>
                                        </div>
                                        <a href="{{ Storage::url($submission->file_path) }}" target="_blank"
                                           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm transition duration-200">
                                            Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(!$submission->submission_text && !$submission->file_path)
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 p-4 rounded-lg">
                                <p class="text-yellow-800 dark:text-yellow-200">No submission content provided.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Grading Section -->
                    <div id="grade-form" class="mb-6">
                        <h4 class="text-lg font-semibold mb-3">Grade Submission</h4>

                        @if($submission->marks_obtained)
                            <!-- Already Graded -->
                            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-6 rounded-lg">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <h5 class="text-lg font-semibold text-green-800 dark:text-green-200">Already Graded</h5>
                                        <p class="text-green-600 dark:text-green-400">This submission was graded on {{ \Carbon\Carbon::parse($submission->graded_at)->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $submission->marks_obtained }}/{{ $submission->assignment->total_marks }}</div>
                                        <div class="text-lg text-green-600 dark:text-green-400">{{ number_format($submission->percentage, 1) }}% - Grade {{ $submission->grade }}</div>
                                    </div>
                                </div>

                                @if($submission->feedback)
                                    <div class="mt-4">
                                        <h6 class="font-medium text-green-800 dark:text-green-200 mb-2">Teacher Feedback</h6>
                                        <div class="bg-white dark:bg-gray-800 p-4 rounded border">
                                            <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $submission->feedback }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <!-- Grading Form -->
                            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 p-6 rounded-lg">
                                <form method="POST" action="{{ route('teacher.submissions.grade', $submission) }}">
                                    @csrf

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                        <!-- Marks Input -->
                                        <div>
                                            <x-input-label for="marks" :value="__('Marks Obtained')" />
                                            <x-text-input id="marks" class="block mt-1 w-full" type="number" name="marks"
                                                          :value="old('marks')" min="0" :max="$submission->assignment->total_marks" required />
                                            <x-input-error :messages="$errors->get('marks')" class="mt-2" />
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Maximum: {{ $submission->assignment->total_marks }} marks</p>
                                        </div>

                                        <!-- Percentage Preview -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Percentage & Grade</label>
                                            <div id="grade-preview" class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 rounded-md">
                                                <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">-</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Feedback -->
                                    <div class="mb-6">
                                        <x-input-label for="feedback" :value="__('Feedback (Optional)')" />
                                        <textarea id="feedback" name="feedback" rows="4"
                                                  class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                                  placeholder="Provide constructive feedback to help the student improve...">{{ old('feedback') }}</textarea>
                                        <x-input-error :messages="$errors->get('feedback')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center justify-end">
                                        <a href="{{ route('teacher.submissions.index') }}"
                                           class="mr-4 bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200">
                                            Cancel
                                        </a>
                                        <x-primary-button>
                                            {{ __('Submit Grade') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>

                    <!-- Student Information -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold mb-3">Student Information</h4>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $submission->student->name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $submission->student->email }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Student ID</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $submission->student->student_id ?? 'Not assigned' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $submission->student->phone ?? 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!$submission->marks_obtained)
        <script>
            document.getElementById('marks').addEventListener('input', function() {
                const marks = parseFloat(this.value) || 0;
                const totalMarks = {{ $submission->assignment->total_marks }};
                const percentage = totalMarks > 0 ? (marks / totalMarks) * 100 : 0;

                let grade = 'F';
                if (percentage >= 80) grade = 'A';
                else if (percentage >= 70) grade = 'B';
                else if (percentage >= 60) grade = 'C';
                else if (percentage >= 50) grade = 'D';

                document.getElementById('grade-preview').innerHTML = `
                    <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        ${percentage.toFixed(1)}% - Grade ${grade}
                    </span>
                `;
            });
        </script>
    @endif
</x-app-layout>