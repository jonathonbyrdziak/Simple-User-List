<?php 

//loading resources
$user =& eFactory::getUser();

$class = "";
if (!$listing->published)
{
	$class = " unpublished";
}

?>

<?php if ($listing->published || $user->isSpecial()): ?>
	<li class="cat_listing_li<?php echo $class; ?>">
		<a href="<?php echo JRoute::_('index.php?record='.$listing->id ); ?>">
		<?php echo $listing->name; ?></a>
	</li>
<?php endif; ?>