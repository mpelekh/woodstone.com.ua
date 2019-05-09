<?php defined('SYSPATH') OR die('No direct script access.'); ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?=$site_name." | ".$page_title?></title>
    <meta name="description" content="<?=$site_description;?>" />
    <meta name="keywords" content="<?=$site_keywords;?>" />

    <? foreach ($styles as $style): ?>
        <?=HTML::style("public/css/".$style) . "\n";?>
    <? endforeach; ?>

    <? foreach ($scripts as $script): ?>
        <?=HTML::script("public/js/".$script) . "\n";?>
    <? endforeach; ?>

    <script src="/scripts/ckeditor/ckeditor.js"></script>

    <?php $action = Request::current()->controller(); ?>

    <script type="text/javascript">
        $(document).ready(function () {
            var action = document.getElementById('<?php echo strtolower($action); ?>');
            $(action).addClass('selected');

            var div = document.createElement('div');
            div.innerHTML = '&nbsp;';
            div.className = 'selected-romb';

            $(action).append(div);
        });

        function destroy(id, lang)
        {
            if (confirm("Bи впевнені, що хочете видалити дану продукцію?")) {
                location = "/admin/products/delete/"+id+"/"+lang;
            }
        }

        function destroy_image(id, lang)
        {
            if (confirm("Bи впевнені, що хочете видалити дане зображення?")) {
                location = "/admin/photogallery/delete/"+id+"/"+lang;
            }
        }

        function destroy_services(id, lang)
        {
            if (confirm("Bи впевнені, що хочете видалити дане зображення?")) {
                location = "/admin/services/delete/"+id+"/"+lang;
            }
        }

        function destroy_cooperation(id, lang)
        {
            if (confirm("Bи впевнені, що хочете видалити дане зображення?")) {
                location = "/admin/cooperation/delete/"+id+"/"+lang;
            }
        }
    </script>



</head>

<body>
<div class="header">
    <div class="header-logo">
        <div class="container">
            <div class="row" id="header-row-logo">
                <div class="col-xs-3 col-xs-offset-2">
                    <a href="<?php echo URL::base(); ?>"><img src="<?php echo URL::base(); ?>public/images/logo-header.png" alt="" title="Карпати"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-9 col-xs-offset-2">
                    <ul class="nav navbar-nav">
                        <li id="main">
                            <a href="<?php echo URL::base(); ?>admin/main/edit">Головна</a>
                        </li>
                        <li id="about">
                            <a href="<?php echo URL::base(); ?>admin/about/edit">Про нас</a>
                        </li>
                        <li id="products">
                            <a href="<?php echo URL::base(); ?>admin/products/view">Продукція</a>
                        </li>
                        <li id="services">
                            <a href="<?php echo URL::base(); ?>admin/services/view">Послуги</a>
                        </li>
                        <li id="photogallery">
                            <a href="<?php echo URL::base(); ?>admin/photogallery/view">Фотогалерея</a>
                        </li>
                        <li id="contacts">
                            <a href="<?php echo URL::base(); ?>admin/contacts/edit">Контакти</a>
                        </li>
                        <li id="cooperation">
                            <a href="<?php echo URL::base(); ?>admin/cooperation/view">Співпраця</a>
                        </li>
                        <li id="static">
                            <a href="<?php echo URL::base(); ?>admin/static/view">Статика</a>
                        </li>
                        <li id="seo">
                            <a href="<?php echo URL::base(); ?>admin/seo/view">CEO</a>
                        </li>
                        <li>
                            <a href="<?php echo URL::base(); ?>logout">Вихід</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="content" id="content-admin">
    <div class="container">
        <?php echo $content; ?>
    </div>
    <div class="push"></div>
</div>



<div class="footer">
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-xs-4 col-xs-offset-5">
                    <p>
                        <a class="toup" href="#">
                            <img src="<?php echo URL::base(); ?>public/images/footer-copyright-to-up.png" alt=""/>
                        </a>
                        &nbsp;&nbsp;&nbsp;ТзОВ «Карпати» <?php echo date('Y') ?>. Всі права захищені.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>



</body>

</html>