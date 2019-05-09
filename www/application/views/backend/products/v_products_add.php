<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <?if($errors):?>
            <?foreach($errors as $error):?>
                <?=$error?>
            <?endforeach?>
        <?endif?>
    </div>
</div>


<?if(isset($item)){?>
    <?=Form::open('admin/products/add/'.$parent_id.'/'.'add'.'/'.$item->id, array('enctype' => 'multipart/form-data'))?>
<?} else{?>
    <?=Form::open('admin/products/add/'.$parent_id, array('enctype' => 'multipart/form-data'))?>
<?}?>

<div class="row">
    <div class="col-xs-2 col-xs-offset-2">
        <select class="form-control" name="language">
            <? foreach ($languages as $l):?>
                <?if(isset($item)){?>
                    <option <?$selected = (((int)$item->language_id + 1)%4 == $l['id']) ? "selected" : ""; echo $selected; ?> value="<?=$l['id']?>"><?=$l['language']?></option>
                <?} else{?>
                    <option value="<?=$l['id']?>"><?=$l['language']?></option>
                <?}?>
            <? endforeach?>
        </select>
    </div>
</div>


<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <?if(isset($item)){?>
            <?=Form::textarea('text', ($item->texts->text) ? $item->texts->text : $post['text'], array('id' => 'editor1',))?>
        <?} else{?>
            <?=Form::textarea('text', "" , array('id' => 'editor1',))?>
        <?}?>

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
                <?if(isset($item)){?>
                    <option <?$selected = ($item->info->measure_id == $m->id) ? "selected" : ""; echo $selected; ?> value="<?=$m->id?>"><?=$m->measure?></option>
                <?} else{?>
                    <option value="<?=$m->id?>"><?=$m->measure?></option>
                <?}?>
            <? endforeach?>
        </select>
    </div>
</div>

<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <?=Form::label('price', 'Ціна, грн.("0", якщо ціна договірна)')?>
        <?if(isset($item)){?>
            <?=Form::input('price', ($item->info->price) ? $item->info->price : $post['price'], array('placeholder' => "Введите цену",))?>
        <?} else{?>
            <?=Form::input('price', "", array('placeholder' => "Введите цену",))?>
        <?}?>
    </div>
</div>
<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <?=Form::submit('submit', 'Зберегти', array('class' => 'btn btn-primary'))?>
        <button type="button" class="btn" onclick="history.back();">Вiдмiна</button>
    </div>
</div>
<?=Form::close()?>