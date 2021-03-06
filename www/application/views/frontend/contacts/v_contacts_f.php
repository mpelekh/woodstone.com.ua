<div class="contacts-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <h3><?=__('Контакти')?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2">
                <iframe class="googlemap" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10692.111572239255!2d24.166363186082418!3d47.935844165691655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4737ad9ba1cc6cff%3A0x9bea79acaba5a42e!2z0JTQtdC70L7QstC-0LUsINCX0LDQutCw0YDQv9Cw0YLRgdC60LDRjyDQvtCx0LvQsNGB0YLRjCwgOTA2MjU!5e0!3m2!1sru!2sua!4v1557427945631!5m2!1sru!2sua" width="100%" height="350" frameborder="0" style="border:0"></iframe>
            </div>
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-0 col-lg-3 col-lg-offset-0" id="contacts-main-text-col">

                <?=$text->texts->text?>

                <div class="contacts-main-form">
                    <h4><?=__('Задати запитання')?></h4>

                    <?=Form::open('/'.$lang.'/contacts')?>

                    <?if($errors):?>
                        <p class="bg-danger">
                            <?foreach($errors as $error):?>
                                <? if($error == 'validation.captcha.Captcha::valid'): ?>
                                    <?=__("Не вірний код")?><br>
                                <? else: ?>
                                    <?=$error?><br>
                                <? endif; ?>
                            <?endforeach?>
                        </p>
                    <?endif?>

                    <?=Form::hidden('sdf', Security::token());?>

                    <div class="form-group">
                        <?=Form::input('name', "", array('placeholder' => __("Ваше Ім'я"), 'class' => 'form-control'))?>
                    </div>
                    <div class="form-group">
                        <?=Form::input('town', "", array('placeholder' => __("Місто"), 'class' => 'form-control'))?>
                    </div>
                    <div class="form-group">
                        <?=Form::input('tel', "", array('placeholder' => __("Телефон"), 'class' => 'form-control'))?>
                    </div>
                    <div class="form-group">
                        <?=Form::input('email', "", array('placeholder' => "Email", 'class' => 'form-control'))?>
                    </div>
                    <div class="form-group">
                        <?=Form::textarea('question', "" , array('placeholder' => __("Запитання"), 'class' => 'form-control', 'id' => 'contacts-textarea'))?>
                    </div>
                    <div class="form-group">
                        <img
                            class="form-captcha"
                            src="<?=URL::base().'captcha/default?'.rand()?>"
                            style="cursor: pointer; margin-bottom: 10px;"
                            alt="<?__('Змінити зображення')?>"
                            data-captcha-source="<?=URL::base().'captcha/default'?>"
                        />
                        <?=Form::input('captcha', "", array('placeholder' => __("Введіть код"), 'class' => 'form-control'))?>
                    </div>
                    <div class="form-group">
                        <?=Form::submit('submit', __('Відправити'), array('class' => 'btn btn-warning', 'id' => 'btn-hover'))?>
                    </div>


                    <?=Form::close()?>

                </div>
            </div>
        </div>
    </div>
</div>