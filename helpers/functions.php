<?php

	function custom_asset($asset){
		if(config('app.https') == true || config('app.https') == 'true'){
			return secure_asset($asset);
		}

		return asset($asset);
	}
	
	function my_asset($asset){
		return custom_asset($asset);
	}


	function logo($type = 'normal'){
		if($type == 'normal'){
			$logo = 'logo.png';
		}elseif ($type == 'light') {
			$logo = 'logo-light.png';
		}elseif ($type == 'dark') {
			$logo = 'logo-dark.png';
		}else{
			$logo = 'logo.png';	
		}

		return custom_asset('images/' . $logo);
		
	}
	
	function logo_absolute($type = 'normal'){
		if($type == 'normal'){
			$logo = 'logo.png';
		}elseif ($type == 'light') {
			$logo = 'logo-light.png';
		}elseif ($type == 'dark') {
			$logo = 'logo-dark.png';
		}else{
			$logo = 'logo.png';	
		}

		return base_path(config('app.public_dir') . '/' . 'images' . '/' . $logo);
	}

	function word_count_from_string($string){
		$words = explode(' ', $string);

		return count($words);
	}

	function simple_date($date){
		return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('jS F, Y');
	}

	function simple_datetime($date){
		return \Carbon\Carbon::parse($date)->format('M j Y, ') . ' ' . \Carbon\Carbon::parse($date)->format('g:i A');
	}

	function profile_picture(App\User $user){
		$path = base_path() . '/' . config('app.public_dir') . '/' . 'images/uploads/';

		$image 	= $user->image;

		$file = $path . $image;

		if($image){
			if(file_exists($file)){
				return custom_asset('images/uploads/' . $image);
			}else{
				return custom_asset('images/default-user.png');	
			}
		}else{
			return custom_asset('images/default-user.png');
		}
	}
	
	function get_gravatar( $email, $size = 80) {
        
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( env('APP_DOMAIN')."/account/user/img/default-user.png" ) . "&s=" . $size;
    }

	if (! function_exists('words')) {
	    /**
	     * Limit the number of words in a string.
	     *
	     * @param  string  $value
	     * @param  int     $words
	     * @param  string  $end
	     * @return string
	     */
	    function words($value, $words = 100, $end = '...'){
	        return \Illuminate\Support\Str::words($value, $words, $end);
	    }
	}


	if (! function_exists('characters')) {
	    /**
	     * Limit the number of words in a string.
	     *
	     * @param  string  $value
	     * @param  int     $words
	     * @param  string  $end
	     * @return string
	     */
	    function characters($value, $characters = 100, $end = '...'){
	        return \Illuminate\Support\Str::limit($value, $characters, $end);
	    }
	}

	function generateRandomString($length = 10) {
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		return $randomString;
	}

	// rss feed

	function getFeed($feed_url){
		$context = stream_context_create(array(
			'ssl' => array(
				'verify_peer'      => false,
				'verify_peer_name' => false,
				'allow_self_signed'  => TRUE,
				),
			)
		);
		
		$contents = file_get_contents($feed_url, FALSE, $context);

		$x = new SimpleXmlElement($contents);

		$out =  '';
 
		foreach($x->channel->item as $entry) {
			$date = new \Carbon\Carbon($entry->pubDate);

			$out .= '<div class = "col-sm-4 mb-3">';
			$out .= 	'<div class = "card bg-dark text-light match-height">';
			$out .=			'<div class = "card-body">';
			$out .=				'<h5 class="card-title"><a class = "text-warning" href = "' . $entry->link . '">' . $entry->title . '</a></h5>';
			$out .=				'<p class="card-subtitle mb-2 text-muted">' . $date->format('D, jS M Y, g:i A') . '</p>';
			//$out .=				'<p class="card-text">' . $entry->description . '</p>';
			//$out .=				'<a href="' . $entry->link . '" class="card-link">Read More</a>';
			$out .= 		'</div>';
			$out .=		'</div>';
			$out .= '</div>';
		}

		return $out;

	}

	