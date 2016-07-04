<link rel="stylesheet" href="/wp-content/plugins/pp-gallery/bower_components/uikit/css/uikit.min.css">
<link rel="stylesheet" href="/wp-admin/css/wp-admin.min.css">
<link rel="stylesheet" href="/wp-content/plugins/pp-gallery/bower_components/uikit/css/components/placeholder.min.css">
<link rel="stylesheet" href="/wp-content/plugins/pp-gallery/bower_components/uikit/css/components/form-file.min.css">
<link rel="stylesheet" href="/wp-content/plugins/pp-gallery/bower_components/uikit/css/components/upload.min.css">
<link rel="stylesheet" href="/wp-content/plugins/pp-gallery/bower_components/uikit/css/components/progress.min.css">
<link rel="stylesheet" href="/wp-content/plugins/pp-gallery/bower_components/uikit/css/components/notify.min.css">
<link rel="stylesheet" href="/wp-content/plugins/pp-gallery/bower_components/uikit/css/components/accordion.min.css">
<link rel="stylesheet" href="/wp-content/plugins/pp-gallery/pp-gallery.css">

<div class="pp-widget-container">
<h2>Галерея изображкний</h2>
    <div class="pp-widget-images">
        <?php $current_post=0; if (count($pp_gallery_current_images)):?>
            <div class="uk-accordion" data-uk-accordion>
                <?php foreach ($pp_gallery_current_images as $value): if ($value->pp_id!=$current_post): $current_post=$value->pp_id ?>
                <h3 class="uk-accordion-title"><?=get_the_title($value->pp_id)?></h3>
                <div class="uk-accordion-content">
                    <table class="uk-table uk-table-striped">
                        <thead>
                        <tr>
                            <th style="width: 20%">Thumbnail</th>
                            <th>Name</th>
                            <th>Alt</th>
                            <th style="width: 40%">Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($pp_gallery_current_images as $val): if ($val->pp_id==$current_post):?>
                            <tr class="uk-form" data-row="<?=$val->id?>" >
                                <td style="width: 20%">
                                    <div class="uk-thumbnail">
                                        <a  href="<?=$val->url; ?>"  data-uk-lightbox title="<?=$val->name?>">
                                        <img src="<?=$val->url; ?>" alt=""></a>
                                    </div>
                                </td>
                                <td >
                                    <input type="text" class="uk-form-width-medium" name="name<?=$val->id; ?>" id="name<?=$val->id; ?>" value="<?=$val->name?>" >
                                </td>
                                <td>
                                    <input type="text" name="alt<?=$val->id; ?>" id="alt<?=$val->id; ?>" value="<?=$val->alt?>" >
                                </td>
                                <td style="width: 40%">
                                    <textarea name="description<?=$val->id; ?>" id="description<?=$val->id; ?>" ><?=$val->description?></textarea>
                                </td>
                                <td>
                                    <i class="uk-icon-remove remove-pp-img"  data-pp-id="<?=$val->id; ?>"></i>
                                    <i class="uk-icon-save edit-pp-img" data-pp-id="<?=$val->id; ?>" ></i>
                                </td>
                            </tr>
                        <?php endif; endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>

            <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</div>

<!-- This is the modal -->
<div id="my-id" class="uk-modal">
    <div class="uk-modal-dialog">
        <div class="uk-modal-header">...</div>
        ...
        <div class="uk-modal-footer">...</div>
    </div>
</div>