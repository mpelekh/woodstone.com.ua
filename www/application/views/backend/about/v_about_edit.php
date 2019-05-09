<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <?if($errors):?>
            <?foreach($errors as $error):?>
                <?=$error?>
            <?endforeach?>
        <?endif?>
    </div>
</div>

<?=Form::open('admin/about/edit/'.$lang, array('enctype' => 'multipart/form-data'))?>

<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <div class="row">
            <div class="col-xs-2">
                <select class="form-control" onchange="top.location=this.value">
                    <? foreach ($languages as $l):?>
                        <option <?$selected = ($lang_id == $l['id']) ? "selected" : ""; echo $selected; ?> value="<?php echo "http://" . $_SERVER['SERVER_NAME']?>/admin/<?= strtolower(Request::current()->controller())?>/<?= strtolower(Request::current()->action())?>/<?=strtolower($l['language'])?>"><?=$l['language']?></option>
                    <? endforeach?>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <?=Form::textarea('text', $text->texts->text, array('id' => "editor1"))?>
        <script>
            CKEDITOR.replace( 'editor1' );
        </script>
    </div>
</div>
<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <?=Form::submit('submit', 'Змінити', array('class' => 'btn btn-primary'))?>
        <?=Form::close()?>
    </div>
</div>