<link rel="stylesheet" href="/wp-content/plugins/pp-gallery/bower_components/uikit/css/uikit.min.css">
<link rel="stylesheet" href="/wp-admin/css/wp-admin.min.css">
<link rel="stylesheet" href="/wp-content/plugins/pp-gallery/bower_components/uikit/css/components/placeholder.min.css">
<link rel="stylesheet" href="/wp-content/plugins/pp-gallery/bower_components/uikit/css/components/form-file.min.css">
<link rel="stylesheet" href="/wp-content/plugins/pp-gallery/bower_components/uikit/css/components/upload.min.css">
<link rel="stylesheet" href="/wp-content/plugins/pp-gallery/bower_components/uikit/css/components/progress.min.css">
<link rel="stylesheet" href="/wp-content/plugins/pp-gallery/bower_components/uikit/css/components/notify.min.css">
<link rel="stylesheet" href="/wp-content/plugins/pp-gallery/pp-gallery.css">

<div class="pp-widget-container">
    <div class="pp-widget-images">
       <!-- <ul class="uk-grid uk-grid-small uk-grid-width-1-2 uk-grid-width-medium-1-5 uk-grid-width-large-1-5" data-uk-margin>
            <?php /*foreach($pp_gallery_current_images as $key => $val): */?>
                <li class="pp-widget-image">
                    <div class="uk-thumbnail">
                        <img src="<?/*=$val->url; */?>" alt="">
                        <div class="uk-thumbnail-caption">
                            <i class="uk-icon-remove remove-pp-img"  data-pp-id="<?/*=$val->id; */?>"></i>
                            <i class="uk-icon-cog" data-uk-modal="{target:'#my-id'}" ></i>
                        </div>
                    </div>
                </li>
            <?php /*endforeach; */?>
        </ul>-->
        <?php if (count($pp_gallery_current_images)):?>
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
            <?php foreach($pp_gallery_current_images as $key => $val): ?>
            <tr data-row="<?=$val->id?>" >
                <td style="width: 20%">
                    <div class="uk-thumbnail">
                        <img src="<?=$val->url; ?>" alt="">
                        <div class="uk-thumbnail-caption">
                            <i class="uk-icon-remove remove-pp-img"  data-pp-id="<?=$val->id; ?>"></i>
                            <i class="uk-icon-cog edit-pp-img" data-pp-id="<?=$val->id; ?>" ></i>
                        </div>
                    </div>
                </td>
                <td>
                    <input type="text" name="name<?=$val->id; ?>" id="name<?=$val->id; ?>" value="<?=$val->name?>" >
                </td>
                <td>
                    <input type="text" name="alt<?=$val->id; ?>" id="alt<?=$val->id; ?>" value="<?=$val->alt?>" >
                </td>
                <td style="width: 40%">
                    <textarea name="description<?=$val->id; ?>" id="description<?=$val->id; ?>" ><?=$val->description?></textarea>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>

    </div>
    <div class="pp-widget-file-uploader">
        <div id="upload-drop" class="uk-placeholder uk-text-center">
            <i class="uk-icon-cloud-upload uk-icon-medium uk-text-muted uk-margin-small-right"></i>
            Для загрузки перетащите изображение или
            <a class="uk-form-file">Выберите его<input id="upload-select" type="file" name="pp_widget_files[]" multiple></a>.
            <input type="hidden" name="post-id" value="<?=$postID;?>" id="postID">
        </div>

        <div id="progressbar" class="uk-progress uk-hidden">
            <div class="uk-progress-bar" style="width: 0%;">0%</div>
        </div>
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