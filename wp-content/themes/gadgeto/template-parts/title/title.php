<?php
/**
 * Template part for displaying a post's title
 *
 * @package thebase
 */

namespace TheBase;

do_action( 'thebase_single_before_entry_title' );
the_title( '<h2 class="entry-title">', '</h2>' );
do_action( 'thebase_single_after_entry_title' );
