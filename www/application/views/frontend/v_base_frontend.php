<?php defined('SYSPATH') OR die('No direct script access.'); ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?=htmlspecialchars_decode($page_title);?></title>
    <link rel='shortcut icon' href='http://woodstone.com.ua/favicon.ico' type='image/x-icon'/>
    <meta name="description" content="<?=htmlspecialchars_decode($site_description);?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <?php foreach($styles as $style): ?>
            <link href="/public/css/<?=$style;?>" rel="stylesheet"/>
        <?php endforeach; ?>
        <?php foreach($scripts as $script): ?>
            <script src="/public/js/<?=$script;?>"></script>
        <?php endforeach;  ?>

    <script type="text/javascript">
        $(document).ready(function () {
            var action = document.getElementById('<?php echo strtolower(Request::current()->controller()); ?>');
            $(action).addClass('selected');

            var div = document.createElement('div');
            div.innerHTML = '&nbsp;';
            div.className = 'selected-romb';

            $(action).append(div);
        });

        $(document).ready(function() {

            var width = $(window).width();

            var page = '<?php echo strtolower(Request::current()->controller()); ?>';

            var clone = $('#' + page).children().clone(true, true);
            clone = clone.text().split("\n").filter(String);
            $('.nav-main-menu').html(clone[0]);

            if (width < 767) {

                if(page != 'products') {
                    $('#' + page).css('display', 'none');
                } else {
                    $('#' + page).removeClass('selected');
                    $('.selected-romb').css('display','none');
                }

            }
        });
    </script>

</head>

<body>
<div class="header">
    <div class="header-logo">
        <div class="container">
            <div class="row" id="header-row-logo">
                <div class="col-xs-12 col-xs-offset-0 col-sm-5 col-sm-offset-1 col-md-3 col-md-offset-2 col-lg-3 col-lg-offset-2">
                    <a href="<?=URL::site($lang.'/main')?>"><img src="<?php echo URL::base(); ?>public/images/logo-header.png" alt="" title="Карпати"></a>
                </div>
                <div class="col-xs-8 col-xs-offset-0 col-sm-3 col-sm-offset-0 col-md-3 col-md-offset-0 col-lg-3 col-lg-offset-0 text-center header-phones">
                    <!-- <h6>+38</h6> <h4><strong>050 991 92 71</strong></h4><br> -->
                    <span style="margin-top: 5px;"><h6>+38</h6> <h4><strong>098 487 40 85</strong></h4></span>
                    </p>
                </div>
                <div class="col-xs-4 col-xs-offset-0 col-sm-3 col-sm-offset-0 col-md-3 col-md-offset-0 col-lg-3 col-lg-offset-0">
                    <div class="header-row-logo-flags">

                        <?
                        $controller = strtolower(Request::current()->controller());
                        if($controller == 'main')
                            $controller = '';
                        $action = Request::current()->action();
                        $action = ($action == 'index') ? '/' : '/'.$action;
                        ?>

                        <a href="<?=URL::site('/'.$controller.$action.$product_id)?>">
                            <img src="<?php echo URL::base(); ?>public/images/flag-ua.png" alt=""/>
                        </a>
                        <a href="<?=URL::site('/ru/'.$controller.$action.$product_id)?>">
                            <img src="<?php echo URL::base(); ?>public/images/flag-ru.png" alt=""/>
                        </a>
                        <a href="<?=URL::site('/en/'.$controller.$action.$product_id)?>">
                            <img src="<?php echo URL::base(); ?>public/images/flag-en.png" alt=""/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-2 col-lg-9 col-lg-offset-2 menu-nav">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-base">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="nav-main-menu visible-xs-block visible-sm-block"></div>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse-base">
                        <ul class="nav navbar-nav">
                            <li id="main">
                                <a href="<?=URL::site($lang)?>"><?=__('Головна')?></a>
                            </li>
                            <li id="about">
                                <a href="<?=URL::site($lang.'/about')?>"><?=__('Про нас')?></a>
                            </li>
                            <li id="products" class="dropdown">
                                <a href="<?=URL::site($lang.'/products')?>" class="dropdown-toggle">
                                    <?=__('Продукція')?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?=URL::site($lang.'/products')?>/7"><?=__('Мармурова крихта')?></a></li>
                                    <li><a href="<?=URL::site($lang.'/products')?>/8"><?=__('Деревообробний цех')?></a></li>
                                    <li><a href="<?=URL::site($lang.'/products')?>/502"><?=__('Цех готової продукції')?></a></li>
                                    <li><a href="<?=URL::site($lang.'/products')?>/503"><?=__('Столярний цех')?></a></li>
                                </ul>
                                <ul class="visible-xs-block">
                                    <li><a href="<?=URL::site($lang.'/products')?>/7"><?=__('Мармурова крихта')?></a></li>
                                    <li><a href="<?=URL::site($lang.'/products')?>/8"><?=__('Деревообробний цех')?></a></li>
                                    <li><a href="<?=URL::site($lang.'/products')?>/502"><?=__('Цех готової продукції')?></a></li>
                                    <li><a href="<?=URL::site($lang.'/products')?>/503"><?=__('Столярний цех')?></a></li>
                                </ul>
                            </li>
                            <li id="services">
                                <a href="<?=URL::site($lang.'/services')?>"><?=__('Послуги')?></a>
                            </li>
                            <li id="photogallery">
                                <a href="<?=URL::site($lang.'/photogallery')?>"><?=__('Фотогалерея')?></a>
                            </li>
                            <li id="contacts">
                                <a href="<?=URL::site($lang.'/contacts')?>"><?=__('Контакти')?></a>
                            </li>
                            <li id="cooperation">
                                <a href="<?=URL::site($lang.'/cooperation')?>"><?=__('Співпраця')?></a>
                            </li>

                            <li class="header-cover-li">
                                <a href="#" data-toggle="modal" data-target="#myModal-cover" id="header-cover-bg">
                                    <img class="header-cover" src="<?php echo URL::base(); ?>public/images/header-cover.png" alt="">
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
     <div class="header-main hidden-xs">
            <div class="row" id="header-main-img" >
            </div>
        <div id="header-main-img-bg">
        </div>
    </div>
</div>


<div class="content">

    <?php echo $content; ?>

    <div class="push"></div>
</div>



<div class="footer">
    <div class="footer-info">
        <div class="container">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-0 col-sm-10 col-sm-offset-0 col-md-3 col-md-offset-2 col-lg-3 col-lg-offset-2">
                    <p>
                    <h3 class="tnr"><?=__('Про нас')?></h3><br/><br/>
                    <?=$static[1]->texts->text?>
                    </p>
                </div>
                <div class="col-xs-10 col-xs-offset-0 col-sm-10 col-sm-offset-0 col-md-3 col-md-offset-0 col-lg-3 col-lg-offset-0" id="footer-info-border">
                    <p>
                    <h3 class="tnr"><?=__('Контакти')?></h3><br/><br/>
                    <?=$static[2]->texts->text?>
                    </p>
                </div>
                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-0 col-lg-3 col-lg-offset-0 text-center">
                    <div class="footer-info-logo">
                        <img src="<?php echo URL::base(); ?>public/images/footer-info-logo.png" alt="Карпати"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-xs-offset-0 col-sm-5 col-sm-offset-4 col-md-4 col-md-offset-5 col-lg-4 col-lg-offset-5">
                    <p>
                        <a class="toup" href="#">
                            <img src="<?php echo URL::base(); ?>public/images/footer-copyright-to-up.png" alt=""/>
                        </a>
                        &nbsp;&nbsp;&nbsp;<?=__('ТОВ «Карпати» '.date('Y').'. Всі права захищені.')?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$formsend?>


<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter28218221 = new Ya.Metrika({id:28218221,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/28218221" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>

</html>