<div class="row">

	{{ csrf_field() }}

	<div class="form-group">
		<label for="business_name">Business Name:</label>
		<input type="text" name="business_name" id="business_name" class="form-control" value="{{ old('business_name') }}" required>
	</div>

	<div class="form-group">
		<label for="website">Website URL:</label>
		<input type="text" name="website" id="website" class="form-control" value="{{ old('website') }}" required>
	</div>

	<div class="form-group">
		<label for="description">Business Description:</label>
		<textarea type="text" name="description" id="description" class="form-control" rows="10" required></textarea>
	</div>

	<hr>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Create Your Profile!</button>
	</div>
</div>
