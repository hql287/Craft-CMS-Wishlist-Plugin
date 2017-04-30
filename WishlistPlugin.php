<?php
namespace Craft;

class WishlistPlugin extends BasePlugin
{
  public function getName() {
    return Craft::t('Wishlist');
  }

  public function getVersion() {
    return '1.0.0';
  }

  public function getDeveloper() {
    return 'Hung Q. Le';
  }

  public function getDeveloperUrl() {
    return 'https://www.lequochung.me';
  }

  public function getDocumentationUrl() {
    return 'https://www.lequochung.me';
  }

  public function hasCpSection()
  {
    return true;
  }
}
