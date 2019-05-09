<div class="row">
    <div class="col-xs-3 col-xs-offset-2">
        <ul class="nav nav-list">
            <? foreach($menu as $item => $param): ?>
                <? if(!$param['submenu']): ?>
                    <li<? if($param['active']): ?> class="active"<? endif; ?>>
                        <a href="<?=URL::site('admin/seo/view/'.$param['id']);?>">
                            <span class="menu-text"> <?=$item;?> </span>
                        </a>
                    </li>
                <? else: ?>
                    <li class="open<? if($param['active']): ?> active<? endif; ?>">
                        <a href="<?=URL::site('admin/seo/view/'.$param['id']);?>" class="dropdown-toggle">

							<span class="menu-text">
								<?=$item;?>
							</span>

                            <b class="arrow icon-angle-down"></b>
                        </a>

                        <ul class="submenu">
                            <? foreach($param['submenu'] as $subitem => $subparam): ?>
                                <li<? if($subparam['active']): ?> class="active"<? endif; ?>>
                                    <a href="<?=URL::site('admin/seo/view/'.$subparam['id']);?>">
                                        <i class="icon-double-angle-right"></i>
                                        <?=$subitem;?>
                                    </a>
                                </li>
                            <? endforeach; ?>

                        </ul>
                    </li>
                <? endif; ?>
            <? endforeach; ?>
        </ul><!--/.nav-list-->
    </div>

    <div class="col-xs-6">


        <form class="texts form-horizontal" action="<?=URL::site('admin/seo/view/'.$page_id);?>" method="post" id="seo" >

        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <?php foreach($langs as $lang): ?>
                    <li <?php if($lang == reset($langs)): ?>class="active"<?php endif; ?>>
                        <a data-toggle="tab" href="#<?=strtolower($lang->language);?>">
                            <?=$lang->language;?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content" id="wys">
                <?php foreach($langs as $lang): ?>
                    <div id="<?=strtolower($lang->language);?>" class="tab-pane<?php if($lang == reset($langs)): ?> in active<?php endif; ?>">

                        <div class="control-group">
                            <label class="control-label" for="meta-title-<?=strtolower($lang->language);?>">META Title</label>

                            <div class="controls">
                                <input type="text" id="meta-title-<?=strtolower($lang->language);?>" name="meta-title-<?=strtolower($lang->language);?>" placeholder="META Title" value="<?=$seo['meta_title_'.strtolower($lang->language)]?>"/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="meta-description-<?=strtolower($lang->language);?>">META Description</label>

                            <div class="controls">
                                <input type="text" id="meta-description-<?=strtolower($lang->language);?>" name="meta-description-<?=strtolower($lang->language);?>" placeholder="META Description" value="<?=$seo['meta_description_'.strtolower($lang->language)];?>"/>
                            </div>
                        </div>


                    </div>
                <?php endforeach; ?>

            </div>

            <div class="form-actions">
                <?=Form::submit('submit', 'Save all changes', array('class' => 'btn btn-info', 'id' => 'save-seo'))?>
            </div>


        </div>

        </form>

    </div>
</div>