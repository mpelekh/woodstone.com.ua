<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <?if($errors):?>
            <?foreach($errors as $error):?>
                <?=$error?>
            <?endforeach?>
        <?endif?>
    </div>
</div>

<?=Form::open('admin/products/edit/'.$id.'/'.$lang, array('enctype' => 'multipart/form-data'))?>

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
        <?=Form::label('measure', 'Одиниця виміювання')?>
        <select name="measure">
            <? foreach ($measures as $m):?>
                <option <?$selected = ($measure == $m->id) ? "selected" : ""; echo $selected; ?> value="<?=$m->id?>" ><?=$m->measure?></option>
            <? endforeach?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <?=Form::label('price', 'Ціна, грн.')?>
        <select name="is_from">
            <option <?=($info->is_from == 0)?"selected" : "";?> value="0">рівно</option>
            <option <?=($info->is_from == 1)?"selected" : "";?> value="1">від</option>
        </select>
        <?=Form::input('price', $price, array('placeholder' => "Введите цену",))?>
    </div>
</div>
<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <?=Form::submit('submit', 'Зберегти', array('class' => 'btn btn-primary'))?>
        <button type="button" class="btn" onclick="history.back();">Вiдмiна</button>
    </div>
</div>

<?=Form::close()?>

