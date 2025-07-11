<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h1 class="modal-title fs-5" id="createTaskModalLabel">Create New Task</h1>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div class="modal-body">
                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           name="title" id="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              name="description" id="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deadline -->
                <div class="mb-3">
                    <label for="deadline" class="form-label fw-bold">Deadline</label>
                    <input type="datetime-local" class="form-control @error('deadline') is-invalid @enderror" 
                           name="deadline" id="deadline" value="{{ old('deadline') }}">
                    @error('deadline')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label for="category" class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                    <select class="form-select @error('category') is-invalid @enderror" 
                            name="category" id="category" required>
                        <option value="" disabled {{ old('category') ? '' : 'selected' }}>Select category</option>
                        <option value="Work" {{ old('category') == 'Work' ? 'selected' : '' }}>Work</option>
                        <option value="Personal" {{ old('category') == 'Personal' ? 'selected' : '' }}>Personal</option>
                        <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Priority -->
                <div class="mb-3">
                    <label for="priority" class="form-label fw-bold">Priority <span class="text-danger">*</span></label>
                    <select class="form-select @error('priority') is-invalid @enderror" 
                            name="priority" id="priority" required>
                        <option value="Low" {{ old('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ old('priority') == 'Medium' || !old('priority') ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ old('priority') == 'High' ? 'selected' : '' }}>High</option>
                    </select>
                    @error('priority')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Assign To -->
                <div class="mb-3">
                    <label for="user_id" class="form-label fw-bold">Assign To <span class="text-danger">*</span></label>
                    <select class="form-select @error('user_id') is-invalid @enderror" 
                            name="user_id" id="user_id" required>
                        <option value="" disabled {{ old('user_id') ? '' : 'selected' }}>Select team member</option>
                        @foreach($users as $user)
                            @if($user->id === Auth::id() || Auth::user()->isAdmin())
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} 
                                    @if($user->id === Auth::id()) (You) @endif
                                    @if(Auth::user()->isAdmin()) ({{ $user->email }}) @endif
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Create Task
                </button>
            </div>
        </form>
    </div>
</div>