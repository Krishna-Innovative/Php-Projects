<?php
$country_list     = (class_exists('Element_Country')) ? Element_Country::get_country_list() : array();
//echo '<pre>';print_r($country_list);
$um_buildin_obj   = (class_exists('um\core\Builtin')) ? new um\core\Builtin() : array();
$languages        = (!empty($um_buildin_obj)) ? $um_buildin_obj->get('languages') : array();
//$languages        = ( ! empty( $languages ) ) ? array_merge( array( '' => __( '', '' ) ), $languages ) : array();
$languages = $languages;
$logged_id = get_current_user_id();

?>
<div href="javascript:void(0);" @click="alert" class="item item8 language_section">
    
    <div class="d-flex justify-content-center">
        <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Language.png" title="Language" />
    </div>
    <?php
    $languages_option = get_user_meta(get_current_user_id(), 'languages', true);
    foreach ($languages_option as $languages_opt) {
        $langunagee[] = $languages_opt;
    }

    $loop = 0;
    if (!empty($languages) && is_array($languages)) { ?>
        <select multiple class="form-control info_select info_language selectpicker" data-live-search="true">
		<option value="All">All</option>
            <?php foreach ($languages as $language) {
                if ($languages_option[$loop] == $language) {
                    $selectedq = 'selected';
                ?>
                    <option value="<?php echo esc_attr($language); ?>" <?php echo $selectedq; ?>><?php echo esc_html($language); ?></option>
                <?php
                    $loop++;
                } else {
                    $selectedq = '';
                ?>
                    <option value="<?php echo esc_attr($language); ?>" <?php echo $selectedq; ?>><?php echo esc_html($language); ?></option>
            <?php }
            }
            ?>
        </select>
    <?php }
    $result = !empty(array_intersect($languages, $languages_option));
    //echo '<pre>';print_r($result);echo '</pre>';
    ?>
</div>