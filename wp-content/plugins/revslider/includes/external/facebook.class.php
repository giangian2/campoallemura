<?php
/**
 * External Sources Facebook Class
 * @since: 5.0
 * @author    ThemePunch <info@themepunch.com>
 * @link      https://www.sliderrevolution.com/
 * @copyright 2024 ThemePunch
 */

if(!defined('ABSPATH')) exit();

/**
 * Facebook
 *
 * with help of the API this class delivers album images from Facebook
 *
 * @package    socialstreams
 * @subpackage socialstreams/facebook
 * @author     ThemePunch <info@themepunch.com>
 */

class RevSliderFacebook extends RevSliderFunctions {

	const TRANSIENT_PREFIX = 'revslider_fb_';
	
	const URL_FB_AUTH = 'fb/login.php';
	const URL_FB_API = 'fb/api.php';

	const QUERY_SHOW = 'fb_show';
	const QUERY_TOKEN = 'fb_token';
	const QUERY_PAGE_ID = 'fb_page_id';
	const QUERY_CONNECTWITH = 'fb_page_name';
	const QUERY_ERROR = 'fb_error_message';

	/**
	 * @var int  Transient time in seconds
	 */
	private $transient_sec;

	public function __construct($transient_sec = 1200){
		$this->transient_sec = 	$transient_sec;
	}

	/**
	 * @return int
	 */
	public function getTransientSec(){
		return $this->transient_sec;
	}

	/**
	 * @param int $transient_sec
	 */
	public function setTransientSec($transient_sec){
		$this->transient_sec = $transient_sec;
	}

	public function add_actions(){
		add_action('init', array(&$this, 'do_init'), 5);
		add_action('admin_footer', array(&$this, 'footer_js'));
		add_action('revslider_slider_on_delete_slider', array(&$this, 'on_delete_slider'), 10, 1);
	}

	/**
	 * check if we have QUERY_ARG set
	 * try to login the user
	 */
	public function do_init(){
		// are we on revslider page?
		if($this->get_val($_GET, 'page') != 'revslider') return;

		//fb returned error
		if (isset($_GET[self::QUERY_ERROR])) return;

		//we need token and slide ID / slider alias to proceed with saving token
		if(!isset($_GET[self::QUERY_TOKEN]) || !( isset($_GET['id']) || isset($_GET['alias']) ) ) return;

		$sr_admin = RevSliderGlobals::instance()->get('RevSliderAdmin');
		if(!current_user_can($sr_admin->get_user_role())){
			$_GET[self::QUERY_ERROR] = __('Bad Request', 'revslider');
			return;
		}

		$token = $_GET[self::QUERY_TOKEN];
		$connectwith = isset($_GET[self::QUERY_CONNECTWITH]) ? $_GET[self::QUERY_CONNECTWITH] : '';
		$page_id = isset($_GET[self::QUERY_PAGE_ID]) ? $_GET[self::QUERY_PAGE_ID] : '';
		$id = $this->get_val($_GET, 'id');
		$alias = $this->get_val($_GET, 'alias');
		
		$nonce_name = '';
		$nonce = $this->get_val($_GET, 'rs_fb_nonce');

		$slider	= new RevSliderSlider();
		$slide	= new RevSliderSlide();

		if(!empty($alias)){
			$slider->init_by_alias($alias);
			if($slider->inited === false){
				$_GET[self::QUERY_ERROR] = __('Slider could not be loaded', 'revslider');
				return;
			}
			
			$nonce_name = self::get_nonce_name($alias);
			
		} else {
			$slide->init_by_id($id);

			$slider_id = $slide->get_slider_id();
			if(intval($slider_id) == 0){
				$_GET[self::QUERY_ERROR] = __('Slider could not be loaded', 'revslider');
				return;
			}

			$slider->init_by_id($slider_id);
			if($slider->inited === false){
				$_GET[self::QUERY_ERROR] = __('Slider could not be loaded', 'revslider');
				return;
			}

			$nonce_name = self::get_nonce_name($id);
			
		}

		if(wp_verify_nonce($nonce, $nonce_name) == false){
			$_GET[self::QUERY_ERROR] = __('Bad Request', 'revslider');
			return;
		}

		$slider->set_param(array('source', 'facebook', 'token_source'), 'account');
		$slider->set_param(array('source', 'facebook', 'appId'), $token);
		$slider->set_param(array('source', 'facebook', 'page_id'), $page_id);
		$slider->set_param(array('source', 'facebook', 'connect_with'), $connectwith);
		$slider->update_params(array());

		//redirect
		$url = set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
		$url = add_query_arg(array(self::QUERY_TOKEN => false, self::QUERY_PAGE_ID => false, self::QUERY_CONNECTWITH => false, 'rs_fb_nonce' => false, self::QUERY_SHOW => 1), $url);
		wp_redirect($url);
		exit();
	}

	public function footer_js() {
		// are we on revslider page?
		if($this->get_val($_GET, 'page') != 'revslider') return;

		if(isset($_GET[self::QUERY_SHOW]) || isset($_GET[self::QUERY_ERROR])) {
			echo '<script>jQuery(document).ready(function(){ RVS.DOC.one("builderInitialised", function(){RVS.F.mainMode({mode:"sliderlayout", forms:["*sliderlayout*#form_slidercontent"], set:true, uncollapse:true,slide:RVS.S.slideId});RVS.F.updateSliderObj({path:"settings.sourcetype",val:"facebook"});RVS.F.updateEasyInputs({container:jQuery("#form_slidercontent"), trigger:"init", visualUpdate:true});}); });</script>';
		}

		if(isset($_GET[self::QUERY_ERROR])){
			$err = __('Facebook API error: ', 'revslider') . esc_html($_GET[self::QUERY_ERROR]);
			echo '<script>jQuery(document).ready(function(){ RVS.DOC.one("builderInitialised", function(){ RVS.F.showInfo({content:"' . $err . '", type:"warning", showdelay:1, hidedelay:5, hideon:"", event:"" }); });});</script>';
		}
	}

	public static function get_login_url(){
		$rslb = RevSliderGlobals::instance()->get('RevSliderLoadBalancer');
		$id = (isset($_GET['id'])) ? $_GET['id'] : '';
		$alias = (isset($_GET['alias'])) ? $_GET['alias'] : '';
		if (!empty($id)) {
			$link = $rslb->get_url('updates') . '/' . self::URL_FB_AUTH . '?state=' . base64_encode( admin_url('admin.php?page=revslider&view=slide&id='.$id.'&rs_fb_nonce='.wp_create_nonce(self::get_nonce_name($id))) );
		} else if (!empty($alias)) {
			$link = $rslb->get_url('updates') . '/' . self::URL_FB_AUTH . '?state=' . base64_encode( admin_url('admin.php?page=revslider&view=slide&alias='.$alias.'&rs_fb_nonce='.wp_create_nonce(self::get_nonce_name($alias))) );
		} else {
			$link = esc_attr('javascript:RVS.F.showInfo({content:"Slider ID or alias unavailable", type:"warning", showdelay:1, hidedelay:5, hideon:"", event:"" });');
		}

		return $link;
	}

	protected function _make_api_call($args = array()){
		global $wp_version;

		$rslb = RevSliderGlobals::instance()->get('RevSliderLoadBalancer');

		$response = wp_remote_post($rslb->get_url('updates') . '/' . self::URL_FB_API, array(
			'user-agent' => 'WordPress/'.$wp_version.'; '.get_bloginfo('url'),
			'body'		 => $args,
			'timeout'	 => 45
		));

		if(is_wp_error($response)) {
			return array(
				'error' => true,
				'message' => 'Facebook API error: ' . $response->get_error_message(),
			);
		}

		$responseData = json_decode($response['body'], true);
		if(empty($responseData)) {
			return array(
				'error' => true,
				'message' => 'Facebook API error: Empty response body or wrong data format',
			);
		}

		return $responseData;
	}

	protected function _get_transient_fb_data($requestData){
		$transient_name = self::TRANSIENT_PREFIX . $requestData['slider_id'] . '_' . md5(json_encode($requestData));
		if($this->transient_sec > 0 && false !== ($data = get_transient($transient_name))){
			return $data;
		}

		$responseData = $this->_make_api_call($requestData);
		//code that use this function do not process errors
		//return empty array
		if($responseData['error']){
			return array();
		}

		if(isset($responseData['data'])){
			set_transient($transient_name, $responseData['data'], $this->transient_sec);
			return $responseData['data'];
		}

		return array();
	}

	/**
	 * Get Photosets List from User
	 *
	 * @param	string	$access_token 	page access token
	 * @param	string	$page_id 	page id
	 * @return	mixed
	 */
	public function get_photo_sets($access_token, $page_id){
		return $this->_make_api_call(array(
			'token' => $access_token,
			'page_id' => $page_id,
			'action' => 'albums',
		));
	}

	/**
	 * Get Photosets List from User as Options for Selectbox
	 *
	 * @param	string	$access_token 	page access token
	 * @param	string	$page_id 	page id
	 * @return	mixed	options html string | array('error' => true, 'message' => '...');
	 */
	public function get_photo_set_photos_options($access_token, $page_id){
		$photo_sets = $this->get_photo_sets($access_token, $page_id);

		if($photo_sets['error']) return $photo_sets;

		$return = array();
		if(is_array($photo_sets['data'])){
			foreach($photo_sets['data'] as $photo_set){
				$return[] = '<option title="'.$photo_set['name'].'" value="'.$photo_set['id'].'">'.$photo_set['name'].'</option>"';
			}
		}
		return $return;
	}

	/**
	 * Get Photoset Photos
	 *
	 * @param	mixed	$slider_id 	slider id
	 * @param	string	$access_token 	page access token
	 * @param	string	$album_id 	Album ID
	 * @param	int 	$item_count 	items count
	 * @return	array
	 */
	public function get_photo_set_photos($slider_id, $access_token, $album_id, $item_count = 8){
		$requestData = array(
			'slider_id' => $slider_id,
			'token' => $access_token,
			'action' => 'photos',
			'album_id' => $album_id,
			'limit' => $item_count,
		);
		return $this->_get_transient_fb_data($requestData);
	}

	/**
	 * Get Feed
	 *
	 * @param	mixed	$slider_id 	slider id
	 * @param	string	$access_token 	page access token
	 * @param	string	$page_id 	page id
	 * @param	int 	$item_count 	items count
	 * @return	array
	 */
	public function get_photo_feed($slider_id, $access_token, $page_id, $item_count = 8){
		$requestData = array(
			'slider_id' => $slider_id,
			'token' => $access_token,
			'page_id' => $page_id,
			'action' => 'feed',
			'limit' => $item_count,
		);
		return $this->_get_transient_fb_data($requestData);
	}

	/**
	 * delete slider fb transients upon deletion
	 * 
	 * @param	$id		slider id
	 * @return	void
	 */
	public function on_delete_slider($id)
	{
		global $wpdb;

		if (empty($id)) return;

		$prefix = self::TRANSIENT_PREFIX . $id;
		$wpdb->query($wpdb->prepare("DELETE FROM $wpdb->options WHERE `option_name` LIKE '%s'", '%'.$prefix.'%'));
	}

	/**
	 * @param int|string $p
	 * @return string
	 */
	public static function get_nonce_name($p)
	{
		return self::TRANSIENT_PREFIX . 'nonce_' . $p;
	}

}
