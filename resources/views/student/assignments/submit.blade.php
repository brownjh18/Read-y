<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Submit Assignment') }}
            </h2>
            <a href="{{ route('student.assignments.show', $assignment) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Back to Assignment
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
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

                    <!-- Assignment Info -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">{{ $assignment->title }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ $assignment->course->name }}</p>
                        <div class="mt-2 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <p class="text-sm text-blue-800 dark:text-blue-200">
                                <strong>Due Date:</strong>
                                @if($assignment->due_date)
                                    {{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y \a\t g:i A') }}
                                @else
                                    No due date specified
                                @endif
                            </p>
                            <p class="text-sm text-blue-800 dark:text-blue-200 mt-1">
                                <strong>Total Marks:</strong> {{ $assignment->total_marks }}
                            </p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('student.assignments.storeSubmission', $assignment) }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Comments -->
                        <div class="mb-6">
                            <x-input-label for="comments" :value="__('Comments (Optional)')" />
                            <textarea id="comments" name="comments" rows="4"
                                      class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                      placeholder="Add any comments or notes about your submission...">{{ old('comments') }}</textarea>
                            <x-input-error :messages="$errors->get('comments')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">You can explain your approach, ask questions, or provide additional context.</p>
                        </div>

                        <!-- File Upload -->
                        <div class="mb-6">
                            <x-input-label for="file" :value="__('Upload Assignment File')" />
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md hover:border-gray-400 dark:hover:border-gray-500 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                        <label for="file" class="relative cursor-pointer bg-white dark:bg-gray-800 rounded-md font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="file" name="file" type="file" accept=".pdf,.doc,.docx,.txt,.zip,.rar,.jpg,.jpeg,.png" class="sr-only" required />
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        PDF, DOC, DOCX, TXT, ZIP, JPG, PNG up to 10MB
                                    </p>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />

                            <!-- File Preview -->
                            <div id="file-preview" class="mt-3 hidden">
                                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="flex items-center">
                                        <svg class="w-8 h-8 text-gray-600 dark:text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <div>
                                            <p id="file-name" class="text-sm font-medium text-gray-900 dark:text-gray-100"></p>
                                            <p id="file-size" class="text-xs text-gray-600 dark:text-gray-400"></p>
                                        </div>
                                    </div>
                                    <button type="button" id="remove-file" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Submission Guidelines -->
                        <div class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
                            <div class="flex">
                                <svg class="w-5 h-5 text-yellow-400 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Submission Guidelines</h4>
                                    <ul class="mt-2 text-sm text-yellow-700 dark:text-yellow-300 list-disc list-inside space-y-1">
                                        <li>Make sure your file is properly named and clearly identifies the assignment</li>
                                        <li>Check that all required content is included before submitting</li>
                                        <li>Once submitted, you cannot change your submission</li>
                                        <li>Submissions must be made before the due date</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('student.assignments.show', $assignment) }}"
                               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Submit Assignment') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('file-preview');
            const fileName = document.getElementById('file-name');
            const fileSize = document.getElementById('file-size');

            if (file) {
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                preview.classList.remove('hidden');
            } else {
                preview.classList.add('hidden');
            }
        });

        document.getElementById('remove-file').addEventListener('click', function() {
            document.getElementById('file').value = '';
            document.getElementById('file-preview').classList.add('hidden');
        });

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    </script>
</x-app-layout>