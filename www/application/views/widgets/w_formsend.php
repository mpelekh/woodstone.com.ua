<div class="modal fade" id="myModal-cover" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?=__('Відправити повідомлення')?></h4>
            </div>
            <div class="modal-body">

                <?=Form::open('/'.$lang.'/send', array('name' => 'form'))?>

                    <?=Form::hidden('sdf', Security::token());?>

                    <div class="form-group">
                        <?=Form::input('name', '', array('placeholder' => __('Ваше Ім\'я'),
                                                            'class' => 'form-control',
                                                            'required' => ''))?>
                    </div>
                    <div class="form-group">
                        <?=Form::input('tel', '', array('placeholder' => __("Телефон"),
                                                        'class' => 'form-control',
                                                        'type' => 'number',
                                                        'required' => ''))?>
                    </div>
                    <div class="form-group">
                        <?=Form::input('email', '', array('placeholder' => "Email",
                                                    'class' => 'form-control',
                                                    'type' => 'email',
                                                    'required' => ''))?>
                    </div>
                    <div class="form-group">
                        <?=Form::textarea('question', '', array('placeholder' => __($text_question),
                                                                'class' => 'form-control',
                                                                'required' => ''))?>
                    </div>

                    <div class="form-group">
                        <img
                            class="form-captcha"
                            src="<?=URL::base().'captcha/default?'.rand()?>"
                            style="cursor: pointer; margin-bottom: 10px;"
                            alt="<?__('Змінити зображення')?>"
                            data-captcha-source="<?=URL::base().'captcha/default'?>"
                        />
                        <?=Form::input('captcha', "", array('placeholder' => __("Введіть код"), 'class' => 'form-control', 'required' => ''))?>
                    </div>

                    <?=Form::input('controller', strtolower($controller), array('type' => 'hidden'))?>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?=__('Закрити')?></button>

                <?=Form::submit('submit', __('Відправити'), array('class' => 'btn btn-warning',
                                                                'id' => 'btn-hover'))?>

                <?=Form::close()?>
            </div>
        </div>
    </div>
</div>