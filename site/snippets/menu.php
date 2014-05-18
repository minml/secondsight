<a class="toggle" href="#">Menu</a>
<nav class="menu">
	<ul> 
		<?php foreach($pages->visible() AS $p): ?>
		<li><a<?php echo ($p->isOpen()) ? ' class="active"' : '' ?> href="<?php echo $p->url() ?>"><?php echo html($p->title()) ?></a></li>
		<?php endforeach ?>
        <?php $cart = get_cart(); ?>
        <?php $count = cart_count($cart); ?>            
        <?php if ($count > 0): ?>
        <li><a href="<?php echo url('notes/cart')?>">Cart</a> (<?php echo $count ?>)</li>
        <?php endif ?>
	</ul>
</nav>
