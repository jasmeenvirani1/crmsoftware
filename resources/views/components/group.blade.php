<label class="col-lg-2 col-form-label mt-3 text-right"><b>Seleted group </b></label>
<div class="col-lg-4 col-xl-2 mt-3 float-right" style="margin-left: -393px;">
    <select class="form-control" id="group_id" name="group_id">
        @foreach ($data as $opction)
            <option value="{{ $opction->id }}" @if ($select_id == $opction->id) selected @endif>{{ $opction->name }}
            </option>
        @endforeach
    </select>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery("#group_id").change(function() {
            var group_id = jQuery(this).val();
            jQuery(".form-group-id").val(group_id);
            jQuery("#ChangeGroupId").submit();
        });
    });
</script>
