<!-- Modal -->
<div class="modal fade" id="map-popup" tabindex="-1" aria-labelledby="map-popup-label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="map-popup-label">Location</h5>
            </div>
            <div class="modal-body">
                <div class="acf-map"></div>
            </div>
            <div class="locations-options">
                <div class="option region-block">
                    <select id="option-region" class="form-control custom_select">
                        <option value="City region only">City region only</option>
                        <option value="Certain location">Saab</option>
                        <option value="Some location">Some location</option>
                        <option value="City and street">City and street</option>
                    </select>
                </div>
                <div class="option">
                    <input id="geo-agreement" type="checkbox">
                    <label for="geo-agreement">
                        I understand that the location listed will be shown publically and accept <a href="#"> site terms.</a>
                    </label>
                </div>
            </div>
            <div class="location-country"></div>
            <div class="modal-footer">
              <button disabled id="closeMap" type="button" class="btn btn-secondary" data-dismiss="modal" data-type="shadow">
                <img width="70" src="<?php echo site_url();?>/wp-content/uploads/2022/01/Check1.png" alt="" data-type="shadow">
              </button>
            </div>  
            <div class="text-center">
                <a class="close_sticker" data-dismiss="modal" aria-label="Close">
                        <img width="55" src="<?php echo imgPATH; ?>/X.png" alt="img">
                </a>
            </div> 
        </div>
    </div>
</div>
