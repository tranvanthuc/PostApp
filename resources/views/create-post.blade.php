@extends('layouts.app')

@section('title')
    Create New Post
@endsection

@section('content')
    <div class="row">
        <div class="col-4 offset-4">
            <h1 class="text-center">Create New Post</h1>
            <form method="POST" action={{ route('store-post') }}>
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="title" class="form-control" name="title" id="title" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" class="form-control" id="body" placeholder="Enter body" cols="20" rows="5"></textarea>
                </div>
    
                <div class="form-group">
                    <label for="tags">Choose tags</label>
                    <select class="form-control" id="tags" name="tag_ids[]" multiple>
                      @foreach ($tags as $tag)
                        <option value={{ $tag->id }}>{{ $tag->name }}</option>
                      @endforeach
                    </select>
                  </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        
    </div>
@endsection
