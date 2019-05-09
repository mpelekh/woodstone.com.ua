<div class="span-3">

    <?=Form::open('admin/main/add', array('enctype' => 'multipart/form-data'))?>

        <?=Form::label('title', 'Мова')?>

        <select name="language">
            <? foreach ($languages as $l):?>
                <option value="<?=$l['id']?>"><?=$l['language']?></option>
            <? endforeach?>
        </select>

    <!--Заголовок Коментуємо-->
        <?/*=Form::label('name', 'Заголовок')*/?><!--
        --><?/*=Form::input('name', "", array('placeholder' => "Введите текст"))*/?>

        <?=Form::label('text', 'Текст')?>
        <?=Form::textarea('text', "", array('id' => 'editor1',))?>

        <script>
            CKEDITOR.replace( 'editor1' );
        </script>

    <!--Загрузка фото закоментована, так як тут не потрібна-->
       <!-- <?/*=Form::label('images', 'Виберіть фото')*/?>
        --><?/*=Form::file('images[]', array('id' => 'multi'))*/?>

        <?=Form::submit('submit', 'Зберегти')?>

    <?=Form::close()?>

</div>

