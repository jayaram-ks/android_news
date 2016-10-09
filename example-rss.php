<?php
header('Content-Type: text/html; charset=utf-8');

if (!ini_get('date.timezone')) {
	date_default_timezone_set('Europe/Prague');
}

require_once 'src/Feed.php';

$rss = Feed::loadRss('https://www.youtube.com/feeds/videos.xml?channel_id=UCsP3Clx2qtH2mNZ6KolVoZQ');

?>

<h1><?php echo $rss->title ?></h1>

<p><i><?php echo htmlSpecialChars($rss->description) ?></i></p>

<?php foreach ($rss->item as $item): ?>
	<h2><a href="<?php echo htmlSpecialChars($item->link) ?>"><?php echo htmlSpecialChars($item->title) ?></a>
	<small><?php echo date("j.n.Y H:i", (int) $item->timestamp) ?></small></h2>

	<?php if (isset($item->{'content:encoded'})): ?>
		<div><?php echo $item->{'content:encoded'} ?></div>
	<?php else: ?>
		<p><?php echo htmlSpecialChars($item->description) ?></p>
	<?php endif ?>
<?php endforeach ?>
