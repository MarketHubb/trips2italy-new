<!-- related topics -->
<?php // BOF: CLW Related Topics & Children
       unset($RTs);
       $isTopic = get_post_meta($post->ID, 'wp_is_topic', true);
       //echo 'Is Topic? -->'. $isTopic .'<--';
       if ($isTopic === '1') {
           $RelatedTs = get_pages( array( 'parent' => $post->ID, 'hierarchical' => 0, 'meta_key' => 'wp_is_topic', 'meta_value' => 1, 'sort_column' => 'menu_order', 'sort_order' => 'asc'));
        } else if ($isTopic === '0') {
            $RelatedTs = get_pages( array( 'parent' => $post->post_parent, 'hierarchical' => 0, 'meta_key' => 'wp_is_topic', 'meta_value' => 1, 'sort_column' => 'menu_order', 'sort_order' => 'asc'));
        } else {
            $RelatedTs = [];
        }

       if (count($RelatedTs) > 0 ) :
         foreach ($RelatedTs as $topic) {
             $RTs .= '<li><a href="'. get_page_link($topic->ID) .'">'.
$topic->post_title .'</a></li>';
             //$count++;
             //if ($count===3){ $RTs .= "</tr>\n\t <tr>"; $count=0;}
         }
     ?>
<br /><hr /><h3>Related Topics</h3>
<ul id="rel_topics">
<?php echo $RTs; ?>
</ul>
<?php endif;?>

<?php
         unset($Arts);
         if ($isTopic === '1') {
            $articles = get_pages( array( 'parent' => $post->ID, 'hierarchical' => 0, 'meta_key' => 'wp_is_topic', 'meta_value' => 0, 'sort_column' => 'menu_order', 'sort_order' => 'asc'));
        } else if ($isTopic === '0') {
            $articles = get_pages( array( 'parent' => $post->post_parent, 'exclude' => $post->ID, 'hierarchical' => 0, 'meta_key' => 'wp_is_topic', 'meta_value' => 0, 'sort_column' => 'menu_order', 'sort_order' => 'asc'));
        } else {
            $articles = [];            
        }

         if (count($articles) > 0 ) :
           foreach ($articles as $article) {
             if (!empty($article->post_content) && (strpos($article->post_content, '<!--more-->'))) {
               $post_snippet = substr($article->post_content, 0, strpos($article->post_content, '<!--more-->')) .'<a href="'.
get_page_link($article->ID) .'"> Read more...</a>';
               $Arts .= '<li><p><a href="'. get_page_link($article->ID) .'">'. $article->post_title .'</a><br />'. $post_snippet .'</p></li>';
             } else { $Arts .= '<li><a href="'.
get_page_link($article->ID) .'">'. $article->post_title .'</a></li>'; }
           }
         if ($isTopic === '0') {
           echo '<br /><hr /><h3>Return to Main Topic: <a href="'.
get_page_link($post->post_parent) .'">'.
get_the_title($post->post_parent) .'</a></h3>';
         }
     ?>
<ul id="more_info">
<?php echo $Arts; ?>
</ul>
<?php endif; // EOF: CLW Related Topics & Children ?>
