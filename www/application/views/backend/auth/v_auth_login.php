<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <?if($errors):?>
            <?foreach ($errors as $error):?>
                <div class="error"><?=$error?></div>
            <?endforeach?>
        <?endif?>
    </div>
</div>

<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <?=Form::open('admin/auth/login')?>

        <div class="form-group">
            <div class="row">
                <div class="col-xs-4">
                    <?=Form::input('username', $data['username'], array('class' => 'form-control', 'placeholder' => 'Логiн'))?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-4">
                    <?=Form::password('password', $data['password'], array('class' => 'form-control', 'placeholder' => 'Пароль'))?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="checkbox-inline">
                <?=Form::checkbox('remember')?> Запам`ятати
            </label>
        </div>
        <div class="form-group">
            <?=Form::submit('submit', 'Увiйти', array('class' => 'btn btn-primary'))?>
        </div>
        <?=Form::close()?>
    </div>
</div>

