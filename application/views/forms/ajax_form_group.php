<form id='editSection' class='form-horizontal'>
<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'>Description</label>
    <div class='col-sm-8'>
        <input type='text' name='section_desc' value='<?= $values->section_desc;?>' class='form-control' autocomplete="off"/>
        <input type='hidden' name='section_code' value='<?= $values->section_code;?>' />
        <input type='hidden' name='document_id' value='<?= $document_id;?>' />
        <input type='hidden' name='template_id' value='<?= $template_id;?>' />
    </div>
</div>
<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'></label>
    <div class='col-sm-8 text-right'>
        <button type='submit' class='btn btn-sm btn-primary'>Update</button>
    </div>
</div>    
</form>
<script>
    $(function(){
        $('#editSection').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?= SITE_ROOT;?>/formview/edit-attributes/',
                data : { values: $(this).serializeArray()},
                success : function(){
                    $('#myModal').modal('hide');
                    location.reload();
                }
            });
        });
        
    });
    </script>

