<?php 
$avatar_data = get_user_meta(get_current_user_id(), 'user_avatar_url', true );

?>

<!-- avatar -->
<div class="modal fade custom_trsparent_modal upload_modal" data-type="" id="pull_preview_popup" tabindex="-1" aria-labelledby="pull-preview-popup" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mb-3 text-center">
                    <img class="hover_hue" src="<?php echo imgPATH; ?>Shared-tab.png" />
                </div>

                <div class="modal_link_sec">
                    <div class="input_field">
                        <input type="text" class="avatar-meta-url input_url" placeholder="Url link" id="avatar_url_in_profile">
                        <button type="button" class="p-0 click_animation refresh_btn">
                            <img id="pull_data_btn" class="hover_hue" src="<?php echo imgPATH; ?>Check1.png" width="70" />
                        </button>
                    </div>
               </div>
               <!-- <div class="cover_img">
                    <div class="cover-container user-coverImage">
                        <div class="container-response-avatar cover-response" id="avatar_image_response">
                            <img class="hover_hue" src="<?php echo imgPATH; ?>giphy.gif" />
                        </div>
                    </div>
                </div> -->
                <div id="pull_preview_block">
                    <div class="cover_img cover-container user-coverImage" id="avatar_image_response">	
                        <div id="preview_position_controller" :style="{ transform: resize}">	
                            <div class="container-response-avatar">
                                <div style="transform:<?php echo $avatar_data['position']; ?>">
                                    <?php apply_filters('previewRender', $avatar_data['link']); ?>
                                </div>
                                <!-- <?php //apply_filters('previewRender', get_user_meta( idCurrentUser, 'user_avatar_url', true )); ?>  -->
                                <!-- <img class="hover_hue" src="<?php echo imgPATH; ?>giphy.gif" /> -->
                            </div>

                        </div>
                    </div>
                </div>
                <section id="resize">
                    <div class="form-group">
                        <label for="scale-controll">Scale</label>
                        <input type="range" class="form-control-range" v-model="scaleValue" id="scale-controll" min="100" max="500" />
                    </div>
                    <div class="form-group">
                        <label for="rotate-controll">Rotate</label>
                        <input type="range" class="form-control-range"  v-model="rotateValue" id="rotate-controll" min="0" max="360">
                    </div>
                    <div class="form-group">
                        <label for="translateX-controll">Translate X</label>
                        <input type="range" class="form-control-range"  v-model="translate.x" id="translateX-controll" min="-15" max="15">
                    </div>
                    <div class="form-group">
                        <label for="translateY-controll">Translate Y</label>
                        <input type="range" class="form-control-range"  v-model="translate.y" id="translateY-controll" min="-35" max="35">
                    </div>
                </section> 
            <div class="modal-footer justify-content-center position-relative">
                <a id="close_pull_data_btn" class="close_sticker" data-dismiss="modal" aria-label="Close">
                    <img class="hover_hue" src="<?php echo imgPATH; ?>X.png" />
                </a>
                <button type="button" id="save_pulled_data_btn" class="savebtn_url click_animation" data-added="">
                    <img class="hover_hue" src="<?php echo imgPATH; ?>Check.png" width="70" />
                </button>
            </div>
            </div>
        </div>
    </div>
</div>

<script>
let resize = Vue.createApp({
	data: () => ({
		scaleValue: 100,
		rotateValue: 0,
        translate: {
            x: 0,
            y: 0
        }
	}),
	computed:{
		scale(){
			return `scale(${this.scaleValue}%)`
		},
		rotate(){
			return `rotate(${this.rotateValue}deg)`
		},
        translateX(){
            return `translateX(${this.translate.x}%)`
        },
        translateY(){
            return `translateY(${this.translate.y}%)`
        },
        translateEl(){
            return `${this.translateX} ${this.translateY}`
        },
		resize(){
			return `${this.scale} ${this.rotate} ${this.translateEl}`
		},
	}
	
});
resize.mount('#pull_preview_popup');
</script>