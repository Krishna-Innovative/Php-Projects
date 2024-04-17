<?php
$link = filter_input( INPUT_POST, 'link', FILTER_SANITIZE_STRING );
if ( ! empty( $link ) ) {
	$str = file_get_contents( $link );
	
	// This Code Block is used to extract title.
	if ( 0 < strlen( $str ) ) {
		$str = trim( preg_replace( '/\s+/', ' ', $str ) ); // Supports line breaks inside <title>.
		preg_match( "/\<title\>(.*)\<\/title\>/i", $str, $title );
	}

	// This Code block is used to extract description 
	$b          = $link;
	@$url       = parse_url( $b );
	$youtubeUrl = parse_url( $b, PHP_URL_QUERY );
	parse_str( $youtubeUrl );
	@$tags = get_meta_tags( $link );

	/**
	 * This Code Block is used to extract og:image which facebook extracts from webpage it is also considered
	 * the default image of the webpage
	 */
	$d = new DomDocument();
	@$d->loadHTML( $str );
	$xp = new domxpath( $d );
	foreach ( $xp->query( "//meta[@property='og:image']" ) as $el ) {
		$l2 = parse_url( $el->getAttribute( 'content' ) );

		if ( $l2['scheme'] ) {
			$img[] = $el->getAttribute( 'content' );
		}
	}

	$imggs = $d->getElementsByTagName( 'img' );
	$imgg  = $imggs->item(0);
	?>
	<a href="<?php echo $link; ?>" style="text-decoration: none;"  target="_blank">
		<?php
		// $img_src = $imgg->getAttribute( 'src' );
		if(preg_match("/\youtube.com\/watch/i", $b)){
			echo "<iframe class='post-video-iframe' width='100%' height='300px' src='https://www.youtube.com/embed/".$v."' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";

		  }
		elseif ( ! empty( $img ) ) {
			echo '<img class="container-resposne" src="' . $img[0] . '" style="max-height:100%; max-width:100%;" />';
		} elseif ( $imgg->getAttribute( 'src' ) ) {
			echo '<img class="container-resposne" src="' . $imgg->getAttribute( 'src' ) . '" />';
		}
		?>
		<h2 class="title"><?php echo ( ! empty( $title[1] ) ) ? $title[1] : ''; ?></h2>
	</a>
	<?php
}
