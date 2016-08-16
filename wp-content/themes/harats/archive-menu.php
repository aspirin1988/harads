<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package harats
 */

get_header();
$currentObj = get_queried_object();
/*$menuItemsCat = get_categories(array(
    'parent' => $currentObj->term_id
));*/
$menuItemsCat=array();
$ParrentObj=get_category($currentObj->category_parent);
$menuItemsCats=wp_get_nav_menu_items($ParrentObj->slug.'-menu');
echo '<br>';
foreach ($menuItemsCats as $val ){
    $menuItemsCat[]=get_term($val->object_id);
}

?>
    <div class="uk-container uk-container-center">
        <div class="section">
            <div class="uk-grid">
                <div class="uk-width-small-1-1">
                    <?php
                        $currentCat = get_category($currentObj->category_parent);
                    ?>
                    <ul class="uk-breadcrumb">
                        <li><a href="/<?=$currentCat->slug?>">Главная</a></li>
                        <li><a href="<?=get_term_link($currentObj->term_id);?>">Меню</a></li>
                    </ul>
                </div>
                <div class="uk-width-small-1-1">
                    <h1 class="page-title"><?=$currentObj->name; ?>
                        <hr></h1>
                </div>
            </div>
            <div class="page-content uk-grid" data-uk-grid-margin>
                <div class="uk-width-small-1-1 uk-width-medium-1-3">
                    <ul data-uk-switcher="{connect:'#menu-items-tab', animation: 'slide-right'}" class="menu-items-link">
                        <?php foreach($menuItemsCat as $menuItem) :?>
                            <li><a id="<?=$menuItem->slug?>"><?=$menuItem->name; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="uk-width-small-1-1 uk-width-medium-2-3">
                    <ul id="menu-items-tab" class="uk-switcher">
                        <?php foreach($menuItemsCat as $menuItem) :?>
                            <?php
                                if($menuItem->name != 'Барная карта') :
                                    $currentItems = get_posts(array(
                                        'category' => $menuItem->term_id,
                                        'posts_per_page' => -1
                                    ));
                            ?>
                                <li>
                                    <h3><?=$menuItem->name; ?></h3>
                                    <div class="uk-grid uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-2">
                                        <?php foreach($currentItems as $item) : ?>
                                            <div>
                                                <article class="menu-items-solo-list">
                                                    <div>
                                                        <span><?=$item->post_title; ?></span>
                                                        <span class="has-dots"><i></i></span>
                                                        <span><?=get_field('price', $item->ID); ?> <i style="text-transform: lowercase; font-style: normal;">тг</i></span>
                                                    </div>
                                                    <div><i><?=$item->post_excerpt; ?></i></div>
                                                </article>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </li>
                            <?php
                                else:
                                    $subMenuItems = get_categories(array(
                                        'parent' => $menuItem->term_id
                                    ));
                            ?>
                                <li>
                                    <h3><?=$menuItem->name; ?></h3>
                                    <div class="uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-2" data-uk-grid="{gutter: 20}">
                                        <?php foreach($subMenuItems as $subMenuItem):
                                            $currentItems = get_posts(array(
                                                'category' => $subMenuItem->term_id,
                                                'posts_per_page' => -1
                                            ));
                                        ?>
                                            <div class="menu-items-has-border">
                                                <h4><?=$subMenuItem->name;?></h4>
                                                <?php foreach($currentItems as $item) : ?>
                                                    <div>
                                                        <article class="menu-items-solo-list">
                                                            <div>
                                                                <span><?=$item->post_title; ?></span>
                                                                <span class="has-dots"><i></i></span>
                                                                <span><?=get_field('price', $item->ID); ?> <i style="text-transform: lowercase; font-style: normal;">тг</i></span>
                                                            </div>
                                                            <div><i><?=$item->post_excerpt; ?></i></div>
                                                        </article>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();

