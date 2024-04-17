<?php
/**
 * Template for the UM Friends. The list of user friends
 *
 * Page: Profile > Friends > My Friends
 * Call: UM()->Friends_API()->shortcode()->ultimatemember_friends()
 * Shortcode: [ultimatemember_friends]
 *
 * Call: UM()->Friends_API()->shortcode()->ultimatemember_friends_online()
 * Shortcode: [ultimatemember_friends_online]
 *
 * Page: Profile > Friends > Friends Reguests
 * Call: UM()->Friends_API()->shortcode()->ultimatemember_friend_reqs()
 * Shortcode: [ultimatemember_friend_reqs]
 *
 * Page: Profile > Friends > Friend Requests Sent
 * Call: UM()->Friends_API()->shortcode()->ultimatemember_friend_reqs_sent()
 * Shortcode: [ultimatemember_friend_reqs_sent]
 *
 * This template can be overridden by copying it to yourtheme/ultimate-member/um-friends/friends.php
 */
if ( ! defined( 'ABSPATH' ) ) exit;


if ( ! empty( $note ) ) {
	?>
		<div class="um-profile-note">
			<span><?php echo $note; ?></span>
		</div>
	<?php
}

if ( $friends ) {
	foreach ( $friends as $k => $arr ) {

		extract( $arr );

		if ( isset( $_sent ) ) {
			$user_id2 = $user_id1;
		}

		if ( $user_id2 == $user_id ) {
			$user_id2 = $user_id1;
		}

		um_fetch_user( $user_id2 ); ?>

		<div class="user-friends-section">
            <div class="user-friend-block">
                <div class="chat-with-friend">
                    <a href="<?php echo site_url();?>/your-chats/?new-message&to=<?php echo esc_attr( um_user( 'display_name' ) ); ?>&fast=1&scrollToContainer"><img src="<?php echo site_url();?>/wp-content/uploads/2022/01/Chat3.png" alt=""></a>
                </div>
                <div class="avatar-friend">
                    <a href="<?php echo esc_url( um_user_profile_url() ); ?>" class="" title="<?php echo esc_attr( um_user( 'display_name' ) ); ?>">
                        <?php //echo get_avatar( um_user('ID'), 80 ); ?>
                        <?php do_action('friend_url_avatar'); ?>
                    </a>
                    <h6>
                        <a href="<?php echo esc_url( um_user_profile_url() ); ?>" title="<?php echo esc_attr( um_user( 'display_name' ) ); ?>"><?php echo um_user( 'display_name' ); ?></a>

                        <?php do_action( 'um_friends_list_post_user_name', $user_id, $user_id2 );
                        do_action( 'um_friends_list_after_user_name', $user_id, $user_id2 ); ?>
                    </h6>
                </div>

                <div class="option-friend">
                    <div class="select-friend">
                        <select class="add_select">
                            <option>Add to..</option>
                        </select>
                        <button><img src="<?php echo site_url();?>/wp-content/uploads/2022/02/All.png" alt=""></button>
                    </div>
                    <button class="option-btn"><img src="https://cdn-icons-png.flaticon.com/512/16/16073.png" alt=""></button>
                </div>
            </div>


			<div class="um-friends-user-btn">
				<?php if ( $user_id2 == get_current_user_id() ) {
					echo '<a href="' . esc_url( um_edit_profile_url() ) . '" class="um-friend-edit um-button um-alt">' . __( 'Edit profile', 'um-friends' ) . '</a>';
				} else {
					echo UM()->Friends_API()->api()->friend_button( $user_id2, get_current_user_id(), true );
				} ?>
			</div>

<!--			<div class="um-friends-user-name">-->
<!--				<a href="--><?php //echo esc_url( um_user_profile_url() ); ?><!--" title="--><?php //echo esc_attr( um_user( 'display_name' ) ); ?><!--">--><?php //echo um_user( 'display_name' ); ?><!--</a>-->

<!--				--><?php //do_action( 'um_friends_list_post_user_name', $user_id, $user_id2 );
//				do_action( 'um_friends_list_after_user_name', $user_id, $user_id2 ); ?>

			</div>

			<?php do_action( 'um_friends_list_pre_user_bio', $user_id, $user_id2 ); ?>

<!--			<div class="um-friends-user-bio">-->
<!--				--><?php //echo um_filtered_value( 'description' ); ?>
<!--			</div>-->

<!--			--><?php //do_action( 'um_friends_list_post_user_bio', $user_id, $user_id2 ); ?>

		</div>

	<?php }
	um_reset_user();

}