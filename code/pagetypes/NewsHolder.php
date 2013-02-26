<?php

class NewsHolder extends DatedUpdateHolder {

	static $allowed_children = array('NewsPage');

	static $default_child = 'NewsPage';

	public static $update_name = 'News';

	static $icon = 'cwp/images/icons/sitetree_images/news_listing.png';

	public $pageIcon =  'images/icons/sitetree_images/news_listing.png';

	/**
	 * Find all site's news items, based on some filters.
	 * Omitting parameters will prevent relevant filters from being applied. The filters are ANDed together.
	 *
	 * @param $parentID The ID of the holder to extract the news items from.
	 * @param $tagID The ID of the tag to filter the news items by.
	 * @param $dateFrom The beginning of a date filter range.
	 * @param $dateTo The end of the date filter range. If empty, only one day will be searched for.
	 * @param $year Numeric value of the year to show.
	 * @param $monthNumber Numeric value of the month to show.
	 *
	 * @returns DataList | PaginatedList
	 */
	public static function AllUpdates($parentID = null, $tagID = null, $dateFrom = null, $dateTo = null, $year = null,
			$monthNumber = null) {

		return parent::AllUpdates($parentID, $tagID, $dateFrom, $dateTo, $year, $monthNumber)->Sort('Date', 'DESC');
	}
}

class NewsHolder_Controller extends DatedUpdateHolder_Controller {
	public function rss() {
		$rss = new RSSFeed($this->Updates()->sort('Created DESC')->limit(20), $this->Link(), $this->getSubscriptionTitle());
		$rss->setTemplate('NewsHolder_rss');
		return $rss->outputToBrowser();
	}
}
