<?php
/**
 * An example of extending the provider class.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://github.com/Nodge/yii2-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace yii\eauth\services\extended;

class TwitterOAuth1Service extends \yii\eauth\services\TwitterOAuth1Service {

	protected function fetchAttributes() {
		/** @var $info \stdClass */
		$info = $this->makeSignedRequest('account/verify_credentials.json');

		$this->attributes['id'] = $info['id'];
		$this->attributes['name'] = $info['name'];
		$this->attributes['url'] = 'http://twitter.com/account/redirect_by_id?id=' . $info['id_str'];

		$this->attributes['username'] = $info['screen_name'];
		$this->attributes['language'] = $info['lang'];
		$this->attributes['timezone'] = timezone_name_from_abbr('', $info['utc_offset'], date('I'));
		$this->attributes['photo'] = $info['profile_image_url'];

		return true;
	}
}