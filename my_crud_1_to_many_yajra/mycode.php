
<div class="form-group">
    <label for="image">Image</label>
    <input class="form-control" id="image" name="image" type="file" accept="image/*">
    @if ($errors->has('image'))
        <span class="text-danger">{{ $errors->first('image') }}</span>
    @endif
    <input type="hidden" name="image_base64" id="image_base64" value="{{ old('image_base64') }}">
    <div style="padding: 10px;">
        <img id="imagePreview" src="{{ old('image_base64') }}" alt="Image Preview" style="display: {{ old('image_base64') ? 'block' : 'none' }}; max-width: 100px; max-height: 100px;">
    </div>
</div>
//////////////
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imageBase64 = e.target.result;
                document.getElementById('imagePreview').src = imageBase64;
                document.getElementById('imagePreview').style.display = 'block';
                document.getElementById('image_base64').value = imageBase64;
            };
            reader.readAsDataURL(file);
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        var imageBase64 = document.getElementById('image_base64').value;
        if (imageBase64) {
            document.getElementById('imagePreview').src = imageBase64;
            document.getElementById('imagePreview').style.display = 'block';
        }
    });
</script>
///////////////
{{-- <div class="form-group">
    <label for="hobby">Select Hobbies</label>
    <select class="dropdown col-sm-2" style="width:200px" name="hobby[]" id='hobby' multiple>
        @foreach ($data1 as $row) --}}
            {{-- Check if $info is defined and if the current hobby is associated with the product being edited --}}
            {{-- @php
                $selected = isset($info) && in_array($row->id, $info->hobbies->pluck('hobby')->pluck('id')->toArray()) ? 'selected' : ''; //  This is a ternary operator used to determine the value of $selected. It checks if $info is set and if the current $row->id is present in the list of countries associated with $info. If the condition is true, the string 'selected' is assigned to $selected, indicating that the option should be pre-selected. Otherwise, an empty string is assigned.
            @endphp
            <option value="{{$row->id}}" {{$selected}}>{{$row->hobby_name}}</option>
        @endforeach
    </select> 
    @if($errors->has('hobby'))
    <span class="text-danger">{{$errors->first('hobby')}}</span>
    @endif 
</div> --}}

///////////////
        $(document).on('click', '.status-toggle', function () {
            var productId = $(this).data('product-id');
            var newStatus = $(this).data('status') === 'active' ? 'inactive' : 'active';

            $.ajax({
                url: "{{ route('products.update_status') }}",
                type: "POST",
                data: {
                    productId: productId,
                    newStatus: newStatus,
                    _token: "{{ csrf_token() }}",
                },
                success: function (response) {

                        $('.datatable').DataTable().ajax.reload();
                }
        
            });
        });








