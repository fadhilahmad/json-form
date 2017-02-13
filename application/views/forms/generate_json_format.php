<?= $header; ?>

<div class='panel panel-primary'>
    <div class='panel-heading text-uppercase'>List of Template Documents With Data</div>
    <div class='panel-body'>
        <div class='pull-right'>
            <div class='btn btn-xs btn-primary generateButton'>Select Generate</div>
            <div class='btn btn-xs btn-warning regenerateButton'>Select Re-generate</div>
            <div class='btn btn-xs btn-default executeAction'>Execute</div>
        </div>
        <div class='clearfix'></div>
        <br>
        <table class='table table-condensed table-bordered'>
            <thead>
                <tr>
                    <th>Discipline</th>
                    <th>Document Type</th>
                    <th>Document Title</th>
                    <th class='text-center'>Status</th>
                    <th class='text-center'>Action</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($available_documents as $document): ?>
                    <tr>
                        <td class='text-uppercase'><?= $document['discipline_name']; ?></td>
                        <td class='text-uppercase'><?= $document['dc_type_desc']; ?></td>
                        <td class='text-uppercase'><?= $document['doc_name_desc']; ?></td>
                        <td class='text-uppercase text-center'>
                            <?php if ($document['available']): ?>
                                <i class="text-success glyphicon glyphicon-ok-sign"></i>
                            <?php else: ?>
                                <i class='text-warning glyphicon glyphicon-exclamation-sign'></i>
                            <?php endif; ?>
                        </td>
                        <td class='text-center'>
                            <?php if (!$document['available']): ?>
                                <div class='btn btn-xs btn-primary'>Generate</div>
                            <?php else: ?>
                                <div class='btn btn-xs btn-warning'>Re-generate</div>
                            <?php endif; ?>
                        </td>
                        <td class='text-center'><input type='checkbox' class='<?= ($document['available']) ? 'checkAda' : 'checkTiada'; ?>' value='<?= $document['doc_name_id']; ?>' /></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>        
    </div>
</div>
<script>
    $(function () {
        $('.generateButton').on('click', function () {
            $('.checkAda').prop({
                checked: false,
                disabled: true,
            });
            $('.checkTiada').prop({
                checked: true,
                disabled: false
            });
        });
        $('.regenerateButton').on('click', function () {
            $('.checkAda').prop({
                checked: true,
                disabled: false
            });
            $('.checkTiada').prop({
                checked: false,
                disabled: true
            });
        });
        $('.generateButton').trigger('click');
        $('.executeAction').on('click', function () {
            var input = $('input[type=checkbox]');
            var selected = [];
            var type = '';
            $(input).each(function (key, value) {
                if (this.checked) {
                    if($(this).attr('class')=='checkAda'){
                        type = 'regenerate';
                    } else {
                        type = 'add';
                    }
                    selected.push($(value).val());
                }
            })
            $(this).text('Executing selected action...');
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/formbuilder/generate-json/',
                data : { type: type, documents : selected },
                success : function(data){
                    console.log(data);
                    swal('Generated!','System successfully created form template for selected data','success')
                }
            });
        })
    });
</script>