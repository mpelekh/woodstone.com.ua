<div class="production-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <h3><?=__('Продукція')?></h3>
            </div>
        </div>
    </div>

    <?$count = 0; $ItemCount = 1; ?>

    <?foreach($parents_name as $name):?>

    <div class="production-main-marge" id="<?= $ItemCount?>">
        <div class="<?$class = ((int)$count%2 == 0) ? "" : "production-main-gray-bg"; echo $class;?>">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2" style="margin-top: 5px">
                        <h4 ><?=__($name->subpage_name)?></h4>
                    </div>
                </div>
            </div>
        </div>

        <?$count++; $ItemCount++;?>


        <? foreach ($items as $item):?>
            <?if($item->parent_id == $name->id):?>


        <div class="<?$class = ((int)$count%2 == 0) ? "" : "production-main-gray-bg"; echo $class;?> " id="production-main-white">
            <div class="container">
                <div class="row">
                    <!--<div class="col-xs-1 col-xs-offset-2">
                        <img title="Бревно" src="<?php /*echo URL::base(); */?>public/images/g_1_85.jpg" alt="" />
                    </div>-->
                    <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2">
                        <p>
                            <?=$item->texts->text?>
                        </p>
                    </div>
                    <div class="col-xs-4 col-xs-offset-0 col-sm-4 col-sm-offset-0 col-md-1 col-md-offset-0 col-lg-1 col-lg-offset-0 text-center">
                        <p>
                        <h6><?=__('Од. вимір.')?></h6><br><br>
                        <h4><?=__($item->info->measures->measure)?></h4>
                        </p>
                    </div>
                    <div class="col-xs-4 col-xs-offset-0 col-sm-4 col-sm-offset-0 col-md-2 col-md-offset-0 col-lg-2 col-lg-offset-0 text-center">
                        <p>
                        <h6><?=__('Ціна, грн.')?></h6><br><br>
                        <h3 class="<?=($item->info->price != '0') ? "text-color-blue" : "text-color-red"?>"><?=($item->info->price != '0') ? (($item->info->is_from == 1)?__("від "):"") . $item->info->price : __('Договірна')?></h3>
                        </p>
                    </div>
                    <div class="col-xs-4 col-xs-offset-0 col-sm-4 col-sm-offset-0 col-md-1 col-md-offset-0 col-lg-1 col-lg-offset-0 text-center" id="production-main-btn">
                        <button type="submit" class="btn btn-warning" id="production-main-btn-hover" data-toggle="modal" data-target="#myModal-cover"><?=__('Замовити')?></button>
                    </div>
                </div>
            </div>
        </div>


                <?$count++;?>
            <?endif?>
        <?endforeach?>

    <?endforeach?>

        <? if($product_text != ''): ?>
        <div class="production-main-gray-bg">
           <div class="container">
               <div class="row">
                   <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">

                        <?= $product_text ?>

                   </div>
               </div>
           </div>
        </div>
        <? endif; ?>

    </div>
</div>

<?=$formsend?>