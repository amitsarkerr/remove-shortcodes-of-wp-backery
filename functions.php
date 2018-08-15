
1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
36
37
38
39
/** add this to your function.php child theme to remove ugly shortcode on excerpt */
 
if(!function_exists('remove_vc_from_excerpt'))  {
  function remove_vc_from_excerpt( $excerpt ) {
    $patterns = "/\[[\/]?vc_[^\]]*\]/";
    $replacements = "";
    return preg_replace($patterns, $replacements, $excerpt);
  }
}
 
/** * Original elision function mod by Paolo Rudelli */
 
if(!function_exists('kc_excerpt')) {
 
/** Function that cuts post excerpt to the number of word based on previosly set global * variable $word_count, which is defined below */
 
  function kc_excerpt($excerpt_length = 20) {
 
    global $word_count, $post;
 
    $word_count = isset($word_count) && $word_count != "" ? $word_count : $excerpt_length;
 
    $post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content); $clean_excerpt = strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;
 
    /** add by PR */
 
    $clean_excerpt = strip_shortcodes(remove_vc_from_excerpt($clean_excerpt));
 
    /** end PR mod */
 
    $excerpt_word_array = explode (' ',$clean_excerpt);
 
    $excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);
 
    $excerpt = implode (' ', $excerpt_word_array).'...'; echo ''.$excerpt.'';
 
  }
 
}
