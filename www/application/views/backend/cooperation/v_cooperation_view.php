<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <?if($errors):?>
            <?foreach($errors as $error):?>
                <?=$error?>
            <?endforeach?>
        <?endif?>
    </div>
</div>

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


<!--<div class="row">
    <div class="col-xs-3 col-xs-offset-2">

        <?/*=Form::open('admin/cooperation/view', array('enctype' => 'multipart/form-data'))*/?>

        <div class="input-group">
            <?/*=Form::input('text', "", array('placeholder' => "Введить назву", 'class' => 'form-control'))*/?>
            <span class="input-group-btn">
                <?/*=Form::submit('submit', 'Додати', array('class' => 'btn'))*/?>
            </span>
        </div>

        <?/*=Form::close()*/?>

    </div>
</div>-->

<? foreach ($parents_name as $name):?>

    <!--<div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <h3><?/*=$name->subpage_name*/?></td></h3>
        </div>
    </div>-->

    <? foreach ($items as $item):?>
        <?if($item->parent_id == $name->id):?>

            <div class="row">
                <div class="col-xs-5 col-xs-offset-2">
                    <?=$item->texts->text?></td>
                </div>

                <div class="col-xs-2 text-center">
                    <p>
                        <a class="btn btn-warning btn-sm btn-block" type="button" href="<? echo 'http://'.$_SERVER['SERVER_NAME'].'/admin/cooperation/edit/'.$item->id.'/'.$lang ?>">Редагувати</a>
                    </p>
                    <p>
                        <a class="btn btn-danger btn-sm btn-block" type="button" href="#" onclick="destroy_cooperation('<? echo $item->id?>','<? echo $item->language_id?>')">Видалити</a>
                    </p>
                </div>
            </div>
        <?endif?>
    <? endforeach?>


    <div class="row">
        <div class="col-xs-2 col-xs-offset-5">
            <a class="btn btn-primary btn-sm btn-block" type="button" href="<? echo 'http://'.$_SERVER['SERVER_NAME'].'/admin/cooperation/add/'.$name->id.'/'.$lang ?>">Додати</a>
        </div>
    </div>

<? endforeach?>



