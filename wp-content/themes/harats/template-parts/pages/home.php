<?php


    $menu_name = 'map-menu';

    $tempMenuItems = wp_get_nav_menu_items($menu_name);

    $tempMenuItems =  json_decode(json_encode($tempMenuItems), true);
    $obls = [];

        print_r($tempMenuItems);

    foreach($tempMenuItems as $key => $tempMenuItem) {
        if(!$tempMenuItem['menu_item_parent']){
            $obls[$key]= $tempMenuItem;
            $oblUrl = explode('/', $tempMenuItem['url']);

            $obls[$key]['slug'] = $oblUrl[5];

            foreach($tempMenuItems as $key2 => $tempMenuItem2) {
                if($tempMenuItem['ID'] == $tempMenuItem2['menu_item_parent']) {
                    foreach($tempMenuItems as $key3 => $tempMenuItem3) {
                        if($tempMenuItem2['ID'] == $tempMenuItem3['menu_item_parent']) {
                            $obls[$key]['filials'][$key3] = $tempMenuItem3;

                            $oblUrl2 = explode('/', $tempMenuItem3['url']);

                            $obls[$key]['filials'][$key3]['slug'] = $oblUrl2[5];
                        }
                    }
                }
            }
        }
    }
?>
<section class="section welcome" style="background-image: url('<?=get_the_post_thumbnail_url() ?>');">
    <div class="uk-container uk-container-center">
        <div class="welcome-header uk-text-center">
            <a href=""><img src="<?php bloginfo('template_url')?>/public/img/welcome-logo.png" alt=""></a><br>
            <h4 class="uk-hidden-small"><?php the_content(); ?></h4>
        </div>
    </div>
    <div class="choose-branch">
        <div class="uk-container uk-container-center">
            <ul class="hide-switcher" data-uk-switcher="{connect:'#my-id', animation: 'slide-horizontal'}">
                <?php foreach($obls as $key => $obl): ?>
                    <?php $active = ($obl['slug'] == 'obl14') ? 'uk-active' : ''; ?>
                    <li class="for-check-obl <?=$active;?>" data-obl="<?=$obl['slug'];?>"><a href=""><?=$obl['title'];?></a></li>
                <?php endforeach; ?>
            </ul>

            <!-- This is the container of the content items -->
            <ul id="my-id" class="uk-switcher">
                <?php foreach($obls as $key => $obl): ?>
                    <?php if($obl['filials']): ?>
                        <li>
                            <div class="uk-slidenav-position" data-uk-slideset="{infinite: false, small: 1, medium: 2, animation: 'scale', duration: 200}">
                                <ul class="uk-grid uk-slideset">
                                    <?php foreach($obl['filials']as $key2 => $filial): ?>
                                        <li>
                                            <article>
                                                <a href="/<?=$filial['slug'];?>">
                                                    <p><?=$filial['title'];?></p>
                                                    <img src="<?=get_field('thumb', 'category_' . $filial['object_id'])?>" alt="">
                                                </a>
                                            </article>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php if(count($obl->filials) > 2): ?>
                                    <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideset-item="previous" draggable="false"></a>
                                    <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideset-item="next" draggable="false"></a>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php else : ?>
                        <li>
                            <h3 style="color: #fff;" class="uk-text-center">На данный момент в этом регионе нет филиалов</h3>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="map-wrapper uk-container uk-container-center uk-text-center uk-flex uk-flex-center">
        <?php get_template_part( 'template-parts/pages/map'); ?>
    </div>
</section>
