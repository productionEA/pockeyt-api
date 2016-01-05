<div class="row">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="title">Post title:</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
    </div>

    <div class="form-group">
        <label for="body">Message:</label>
        <textarea type="text" name="body" id="body" class="form-control" rows="10" required></textarea>
    </div>

    <hr>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Create Your Post!</button>
    </div>
</div>