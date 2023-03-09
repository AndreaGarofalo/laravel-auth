@if($project->exists)

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" novalidate>
    @method('PUT')
        
@else
           
    <form action="{{ route('admin.projects.store') }}" method="POST" novalidate>

@endif

        @csrf

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $project->title) }}" required minlength="5" maxlength="20">
                    <div class="text-muted">Insert title</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ Str::slug(old('title', $project->title), '-') }}" disabled>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="screen" class="form-label">Screen</label>
                    <input type="url" class="form-control" id="screen" name="screen" value="{{ old('screen', $project->screen) }}">
                    <div class="text-muted">Insert screen url</div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3" name="description" required>{{ old('description', $project->description) }}</textarea>
                    <div class="text-muted">Insert description</div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-small btn-success me-2">Save</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-small btn-secondary"><i class="fa-solid fa-arrow-left me-2"></i>Go back</a>
        </div>
    </form>

@section('scripts')
    <script>
        const slugInput = document.getElementById('slug');
        const titleInput = document.getElementById('title');

        console.log(slugInput.value);
        console.log(titleInput.value);

        titleInput.addEventListener('blur', () => {
            slugInput.value = titleInput.value.toLowerCase().split(' ').join('-');
        });
    </script>
@endsection