<?php 

if (!class_exists('TwitterOAuth')) {
    require_once('twitteroauth/twitteroauth.php');
}


add_action('widgets_init', 'register_twitter_widget');
function register_twitter_widget(){
	register_widget('WP_Widget_Twitter');
}

class  WP_Widget_Twitter extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'twitter',
			__('* Recent Tweets', TEMPNAME),
			array( 'description' => __('Display tweets from twitter', TEMPNAME))
		);
	}

	public function widget($args, $instance){

		extract($args);
		global $nz_ninzio;
		$title               = apply_filters('widget_title', $instance['title']);
		$consumer_key        = ($nz_ninzio['tweets-consumer-key']) ? esc_attr($nz_ninzio['tweets-consumer-key']): "";
		$consumer_secret     = ($nz_ninzio['tweets-consumer-secret']) ? esc_attr($nz_ninzio['tweets-consumer-secret']) : "";
		$access_token        = ($nz_ninzio['tweets-access-token']) ? esc_attr($nz_ninzio['tweets-access-token']) : "";
		$access_token_secret = ($nz_ninzio['tweets-access-token-secret']) ? esc_attr($nz_ninzio['tweets-access-token-secret']) : "";
		$twitter_id          = isset($instance['twitter_id']) ? esc_attr($instance['twitter_id']) : "";
		$count               = (isset($instance['count']) && absint($instance['count'])) ? esc_attr($instance['count']) : "3";

		echo $before_widget;

		if($title) {echo $before_title.$title.$after_title;}

		if($twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count) {

			$transName = 'list_tweets_';
			$cacheTime = 10;
			delete_transient($transName);

			if(false === ($twitterData = get_transient($transName))) {
			     
				$twitterConnection = new TwitterOAuth(
					$consumer_key,
					$consumer_secret,
					$access_token,
					$access_token_secret
				);

				$twitterData = $twitterConnection->get(
					'statuses/user_timeline',
					array(
						'screen_name'     => $twitter_id,
						'count'           => $count,
						'exclude_replies' => false
					)
				);

				if($twitterConnection->http_code != 200){
					$twitterData = get_transient($transName);
				}

				set_transient($transName, $twitterData, 60 * $cacheTime);
			};

			$twitter = get_transient($transName);

			if($twitter && is_array($twitter)) { ?>

				<div class="twitter">
					<ul>
						<?php foreach($twitter as $tweet): ?>
							<li>
								<p>
									<?php
										$latestTweet = $tweet->text;
										$latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $latestTweet);
										$latestTweet = preg_replace('/@([a-z0-9_]+)/i', '<a class="tweet-author" href="http://twitter.com/$1" target="_blank">@$1</a>', $latestTweet);
										echo $latestTweet;
									?>
								</p>
									<?php
										$twitterTime = strtotime($tweet->created_at);
										$timeAgo = $this->ago($twitterTime);
									?>
								<a class="tweet-time" href="http://twitter.com/<?php echo $tweet->user->screen_name; ?>/statuses/<?php echo $tweet->id_str; ?>"><?php echo $timeAgo; ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>

			<?php }
		}

		echo $after_widget;
	}

	public function ago($time) {

	   $periods = array(__("second", TEMPNAME), __("minute", TEMPNAME), __("hour", TEMPNAME), __("day", TEMPNAME), __("week", TEMPNAME), __("month", TEMPNAME), __("year", TEMPNAME), __("decade", TEMPNAME));
	   $lengths = array("60","60","24","7","4.35","12","10");

	   $now = time();

	       $difference    = $now - $time;
	       $tense         = "ago";

	   for($i = 0; $difference >= $lengths[$i] && $i < count($lengths)-1; $i++) {
	       $difference /= $lengths[$i];
	   }

	   $difference = round($difference);

	   if($difference != 1) {
	       $periods[$i].= "s";
	   }

	   return "$difference $periods[$i] ago ";
	}

	public function form($instance) {

		$defaults = array(
			'title'      => __('Recent Tweets', TEMPNAME), 
			'twitter_id' => '',
			'count'      => 3
		);

		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p><a target="_blank" href="http://dev.twitter.com/apps"><?php echo __('Find or Create your Twitter App', TEMPNAME); ?></a></p>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __( 'Title:', TEMPNAME ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php echo __( 'Twitter ID:', TEMPNAME ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="<?php echo $instance['twitter_id']; ?>" />
		</p>

			<label for="<?php echo $this->get_field_id('count'); ?>"><?php echo __( 'Number of Tweets:', TEMPNAME ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>" />
		</p>

	<?php
	}

	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['title']               = strip_tags($new_instance['title']);
		$instance['twitter_id']          = strip_tags($new_instance['twitter_id']);
		$instance['count']               = strip_tags($new_instance['count']);
		return $instance;
	}

}

?>