@extends('layouts.admin')

@section('content')
    <h1>Edit Post: {{$project->title}}</h1>

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" required minlength="10" value="{{ old('title', $project->title) }}">
            @error('title')
            <div class="invalid-feedback">
                {{$mesagge}}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" value="{{ old('image', $project->image) }}">
            @error('image')
            <div class="invalid-feedback">
                {{$mesagge}}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="type_id">Tipo</label>
            <select name="type_id" id="type_id" class="form-control @error('type_id') is-invalid @enderror">
                <option value="">Seleziona tipo</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}"
                        {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            @error('type_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description">Body</label>
            <textarea name="description" id="description" rows="10" class="form-control @error('title') is-invalid @enderror" maxlength="3000" value="{{ old('description', $project->description) }}"></textarea>
            @error('description')
            <div class="invalid-feedback">
                {{$mesagge}}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <button type="reset" class="btn btn-primary">Reset</button>
    </form>
    <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(nicEditors.allTextAreas);
    </script>
@endsection
