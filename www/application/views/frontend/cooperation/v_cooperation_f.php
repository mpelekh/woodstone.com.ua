<?$count = 0;?>

<?foreach($parents_name as $name):?>
<div class="cooperation-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <h3><?=__($name->subpage_name)?></h3>
            </div>
        </div>
    </div>

    <?$count++;?>

    <div class="cooperation-main-marge">
    <? foreach ($items as $item):?>

        <?if($item->parent_id == $name->id):?>

        <div class="<?$class = ((int)$count%2 == 0) ? "" : "cooperation-main-gray-bg"; echo $class;?>" id="production-main-white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-6 col-md-offset-2 col-lg-6 col-lg-offset-2" id="cooperation-main-text">
                        <p>
                            <?=$item->texts->text?>
                        </p>
                    </div>
                    <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-1 col-md-offset-0 col-lg-1 col-lg-offset-0 text-center" id="cooperation-main-btn">
                        <button type="submit" class="btn btn-warning" id="cooperation-main-btn-hover" data-toggle="modal" data-target="#myModal-cover"><?=__('Стати партнером')?></button>
                    </div>
                </div>
            </div>
        </div>


                <?$count++;?>
            <?endif?>
        <?endforeach?>
    </div>
    <?endforeach?>

</div>
        <!-- Modal -->
        <?=$formsend?>



