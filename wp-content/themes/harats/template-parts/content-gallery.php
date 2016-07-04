<div class="uk-container uk-container-center">
    <div class="section">
        <div class="uk-grid">
            <div class="uk-width-small-1-1">
                <?php
                $parentCat = get_the_category();

                $currentCat = get_category($parentCat[0]->category_parent);
                ?>
                <?php pp_get_breadcrumb('uk-breadcrumb', '/' . $currentCat->slug); ?>
            </div>
            <div class="uk-width-small-1-1">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </div>
            <div class="uk-width-small-1-1">
                <p><?php the_content(); ?></p>
            </div>
        </div>
        <div class="gallery-content uk-grid uk-grid-collapse uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4">
            <?php $gallery = pp_gallery_get($post->ID); ?>
            <?php foreach($gallery as $img) : ?>
                <div class="gallery-thumb-cont">
                    <div class="gallery-thumb" style="background-image: url(<?=$img->url;?>)">
                        <a href="<?=$img->url;?>" data-uk-lightbox="{group:'my-group'}"></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>