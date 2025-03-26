<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-6">Add Advisor</h2>

        <form action="{{ route('advisors.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="user_id">
                    User
                </label>
                <select name="user_id" id="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="branch_id">
                    Branch
                </label>
                <select name="branch_id" id="branch_id" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select Branch</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="advisor_id">
                    Advisor ID
                </label>
                <input type="text" name="advisor_id" id="advisor_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="position">
                    Position
                </label>
                <input type="text" name="position" id="position" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="department">
                    Department
                </label>
                <input type="text" name="department" id="department" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Assigned Students
                </label>
                <div id="students-container" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Students will be loaded here dynamically -->
                    <div class="col-span-3 text-gray-500 italic">Please select a branch to view available students</div>
                </div>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Create Advisor
                </button>
            </div>
        </form>
    </div>

    <script>
        // Store all students data with their branch IDs
        const allStudents = @json($students);
        
        document.addEventListener('DOMContentLoaded', function() {
            const branchSelect = document.getElementById('branch_id');
            const studentsContainer = document.getElementById('students-container');
            
            // Function to filter students by branch_id
            function updateStudentsList() {
                const selectedBranchId = branchSelect.value;
                
                // Clear the container
                studentsContainer.innerHTML = '';
                
                if (!selectedBranchId) {
                    studentsContainer.innerHTML = '<div class="col-span-3 text-gray-500 italic">Please select a branch to view available students</div>';
                    return;
                }
                
                // Filter students by selected branch
                const filteredStudents = allStudents.filter(student => student.branch_id == selectedBranchId);
                
                if (filteredStudents.length === 0) {
                    studentsContainer.innerHTML = '<div class="col-span-3 text-gray-500">No students found for this branch</div>';
                    return;
                }
                
                // Add checkboxes for filtered students
                filteredStudents.forEach(student => {
                    const studentDiv = document.createElement('div');
                    studentDiv.className = 'flex items-center';
                    studentDiv.innerHTML = `
                        <input type="checkbox" name="students[]" value="${student.id}" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <label class="ml-2">
                            ${student.user.name} (${student.student_id})
                        </label>
                    `;
                    studentsContainer.appendChild(studentDiv);
                });
            }
            
            // Add event listener to branch select
            branchSelect.addEventListener('change', updateStudentsList);
            
            // Initial call to set up the form correctly
            updateStudentsList();
        });
    </script>
</x-app-layout>