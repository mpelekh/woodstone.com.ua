<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <?if($errors):?>
            <?foreach($errors as $error):?>
                <?=$error?>
            <?endforeach?>
        <?endif?>
    </div>
</div>

<?=Form::open('admin/static/edit/'.$id.'/'.$lang, array('enctype' => 'multipart/form-data'))?>

<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <?=Form::textarea('text', $text, array('id' => 'editor1',))?>

        <script>
            CKEDITOR.replace( 'editor1' );
        </script>
    </div>
</div>

<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <?=Form::submit('submit', 'Зберегти', array('class' => 'btn btn-primary'))?>
        <button type="button" class="btn" onclick="history.back();">Вiдмiна</button>
    </div>
</div>

<?=Form::close()?>

