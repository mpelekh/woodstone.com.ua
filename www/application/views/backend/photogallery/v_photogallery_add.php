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
    <?=Form::open('admin/photogallery/add/'.$parent_id.'/'.'add'.'/'.$item->id, array('enctype' => 'multipart/form-data'))?>
<?} else{?>
    <?=Form::open('admin/photogallery/add/'.$parent_id, array('enctype' => 'multipart/form-data'))?>
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
        <?if(isset($item->images->image_href)){?>
            <?=html::anchor('media/uploads/'. $item->images->image_href, html::image('media/uploads/small_' .$item->images->image_href), array('target' => '_blank'))?>
            <?=Form::input('image_href', $image_href, array('type' => 'hidden'))?>
        <?} else {?>
            <?=Form::label('image', 'Виберіть фото')?>
            <?=Form::file('image', array('id' => 'multi'))?>
        <?}?>
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
        <?=Form::submit('submit', 'Зберегти', array('class' => 'btn btn-primary'))?>
        <button type="button" class="btn" onclick="history.back();">Вiдмiна</button>
    </div>
</div>
<?=Form::close()?>



