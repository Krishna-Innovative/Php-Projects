<!--   Modal ADD BIO   -->
<div class="modal fade" id="add-info-popup" tabindex="-1" aria-labelledby="addInfo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form id="bees_add_info_form">
                    <input id="bees_info_user_id" type="text" hidden value="<?php echo idCurrentUser; ?>">
                    <div class="form-group">
                        <!-- <label for="info_post_type_image_by_url">Image by url</label> -->
                        <input name="info_preview_by_link" type="text" class="form-control" id="info_post_type_image_by_url" placeholder="Url Link (embed)">
                        <div class="bio-container-resposne">
                            <img style="max-height:100%; max-width:100%; width: 100%; object-fit: cover;" src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/New-Project-48.png">
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- <label for="tab_info_title">Title</label> -->
                        <input name="info_title" type="text" class="form-control" id="info_post_type_title" aria-describedby="emailHelp" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <!-- <label for="tab_info_description">Content</label> -->
                        <textarea name="info_content" class="form-control" id="info_post_type_description" rows="3" placeholder="Content"></textarea>
                    </div>
                    <!-- <button id="bees_create_info" type="button" class="btn btn-primary">Add Info</button> -->
                </form>
                <button id="bees_create_info" type="button" class="btn btn-primary" data-type="shadow">
                    <img width="65" src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Check1.png" data-type="shadow" alt="add">
                </button>
            </div>
            <div class="close-block">
                <button type="button" id="close-addInfo-popup" class="btn btn-secondary" data-dismiss="modal">
                    <img width="60" src="<?php echo imgPATH; ?>X.png" alt="close">
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal ADD BIO END -->