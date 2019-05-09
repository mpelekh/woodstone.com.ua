<div class="gallery-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <h3><?=__('Фотогалерея')?></h3>
            </div>
        </div>

        <?foreach($parents_name as $name):?>

        <?if($name->subpage_name != "Загальні") {?>
        <div class="row" style="margin-top: 30px">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">

                <h4>
                    <?=__($name->subpage_name)?>
                </h4>
            </div>
        </div>
        <?}?>

        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-9 col-md-offset-2 col-lg-9 col-lg-offset-2">

                <? foreach ($items as $item):?>
                    <?if($item->parent_id == $name->id):?>

                        <a class="fancybox" data-fancybox-group="gallery" href="<?php echo URL::base(); ?>media/uploads/<?=$item->images->image_href?>" title="">
                            <img class="gallery-main-mini" src="<?php echo URL::base(); ?>media/uploads/small_<?=$item->images->image_href?>" alt="" />
                        </a>

                    <?endif?>
                <?endforeach?>

            </div>
        </div>

        <?endforeach?>


    </div>
</div>


