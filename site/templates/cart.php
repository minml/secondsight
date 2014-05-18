<?php $cart = cart_logic(get_cart()) ?>
<?php $products = $page->siblings()->visible() ?>
<?php snippet('header') ?>       

        <section class="content">

                <?php if(param('checkout') == 'complete'): ?>


                        <article>
                            
                            <div id="headnotes" class="cf">
                                <h1>Checkout Complete</h1>
                            </div>  
                            
                            <?php if($_POST['stripeToken']) $success = stripe($_POST['stripeToken'], $_POST['price'], $_POST['desc']); ?>
	
                            <?php if($_POST['stripeToken']): ?>

                            <article>
                                <div id="headnotes" class="cf">
                                    <h1><?php echo $page->title() ?></h1>
                                    <p><?php echo $page->text() ?></p>
                                </div>
                            </article>

                            <?php else: ?>

                            <article>
                                <div id="headnotes" class="cf">
                                    <h1><?php echo $page->title() ?></h1>
                                    <p>Sorry The order did not process. You have not been charged.</p>
                                </div>
                            </article>

                            <?php endif ?>
                            
                        </article>

                <?php elseif(param('checkout') == 'step2'): ?>
                    
                    <article>
                        <div id="headnotes" class="cf">
                                <h1>Confirmation</h1>
                        </div>

                                <form method="post" action="https://www.paypal.com/cgi-bin/webscr">
                                    <input type="hidden" name="cmd" value="_cart">
                                    <input type="hidden" name="upload" value="1">
                                    <input type="hidden" name="business" value="<?php echo $site->email() ?>">
                                    <input type="hidden" name="currency_code" value="GBP">

                                            <div class="table">

                                                <div class="table_header row">
                                                    <div class="cell title"><h1>Preview</h1></div>
                                                    <div class="cell title"><h1>Title</h1></div>
                                                    <div class="cell"><h1>Quantity</h1></div>
                                                    <div class="cell"><h1>VAT</h1></div>
                                                    <div class="cell"><h1>Price</h1></div>
                                                </div> 

                                                    <?php $desc = ''; ?>
                                                    <?php $i=0; $count = 0; $total = 0; ?>
                                                    <?php foreach ($cart as $id => $quantity): ?>
                                                        <?php if ($product = $products->findByUID($id)): ?>
                                                            <?php $product = $product->first() ?>
                                                            <?php $i++; ?>
                                                            <?php $count += $quantity ?>
                                                                <?php

                                                                    $desc .= $product->title();
                                                                    if($i+1 < count($cart)) $desc .= ', '; ?>

                                                                        <div class="table_body row">

                                                                            <div class="cell">
                                                                                <a href="<?php echo $product->url() ?>">
                                                                                    <?php if($product->hasImages()): ?>
                                                                                        <img src="<?php echo $product->images()->first()->url() ?>" class="cart_image" />
                                                                                    <?php else: ?>
                                                                                        <img src="<?php echo $site->url() ?>/assets/images/placeholder.png" class="cart_image" />
                                                                                    <?php endif ?>                                                                          
                                                                                </a>
                                                                            </div>

                                                                            <div class="cell title">
                                                                                <input type="hidden" name="item_name_<?php echo $i ?>" value="<?php echo $product->title() ?>" />
                                                                                <input type="hidden" name="amount_<?php echo $i ?>" value="<?php echo $product->price() ?>" />
                                                                                <?php echo kirbytext($product->title(), false) ?>
                                                                            </div>

                                                                            <div class="cell">
                                                                                <input data-id="<?php echo $product->uid() ?>" data-quantity="<?php echo $quantity ?>" pattern="[0-9]*"  class="quantity" type="hidden" name="quantity_<?php echo $i ?>" min="1" value="<?php echo $quantity ?>">
                                                                                <?php echo $quantity ?>
                                                                            </div>

                                                                            <div class="cell">
                                                                                VAT AMOUNT
                                                                            </div>

                                                                            <div class="cell">
                                                                                <?php $prodtotal = floatval($product->price()->value)*$quantity ?>
                                                                                 €<?php printf('%0.2f', $prodtotal) ?>
                                                                            </div>

                                                                        </div> 

                                                                    <?php $total += $prodtotal ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>

                                                        <div class="table_footer row">
                                                            <div class="cell large">
                                                                Subtotal
                                                            </div>
                                                            <div class="cell medium">
                                                                £<?php printf('%0.2f', $total) ?>
                                                            </div>
                                                        </div>

                                                        <div class="table_footer row">
                                                            <div class="cell large">
                                                                <?php $postage = cart_postage($total) ?>
                                                                Postage
                                                            </div>
                                                            <div class="cell medium">            
                                                                £<?php printf('%0.2f', $postage) ?>
                                                            </div>
                                                        </div>


                                                        <div class="table_footer row">
                                                            <div class="cell small">
                                                                Total
                                                            </div>
                                                            <div class="cell small"> 
                                                                £<?php printf('%0.2f', $total+$postage) ?>        
                                                            </div>
                                                        </div>

                                                </div>    

                                           <?php $stripe = ($total + $postage) * 100; ?> 

                                    <div class="purchase">

                                        <button type="submit" class="addcart">Pay With Paypal</button>
                                        </form>
                                        <form action="http://projects.minml.co/project/test/checkout:complete" method="POST">
                                            <input type="hidden" name="price" value="<?php echo $stripe   ?>" />
                                            <input type="hidden" name="desc" value="<?php printf('%0.2f', $total+$postage) ?>" />

                                            <script
                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                            data-key="pk_test_ootJ6zpRdwkKXatoZ6qfykjz"
                                            data-amount="<?php echo $stripe   ?>"
                                            data-name="<?php echo $site->url() ?>"
                                            data-description="<?php printf('%0.2f', $total+$postage) ?> "
                                            data-image="/128x128.png">
                                          </script>
                                        </form>

                                    </div>

                        </article>

                <?php elseif(param('checkout') == 'step1'): ?>

                        <?php

                            $form = new CheckoutForm(array(
                              'to'       => 'Website Admin <chris@minml.co>',
                              'from'     => $site->title() . 'Customer Details <chris@minml.co>',
                              'subject'  => 'Customer Details',
                              'goto'     => $page->url() . '/checkout:step2'
                            ));

                        ?>

                            <article>
                                <div id="headnotes" class="cf">
                                    <h1>Your Details</h1>
                                </div>

                                  <form action="" method="post">
                                    <fieldset>

                                      <?php if($form->isError('send')): ?>
                                      <div class="contactform-alert">The email could not be sent.<br />Please try again later.</div>
                                      <?php elseif($form->isError()): ?>
                                      <div class="contactform-alert">The form could not be submitted.<br />Please fill in all fields correctly.</div>
                                      <?php endif ?>

                                      <div class="contactform-field<?php if($form->isError('name')) echo ' error' ?>">
                                        <label class="contactform-label" for="contactform-name">Your Name <?php if($form->isRequired('name')) echo '*' ?> <?php if($form->isError('name')): ?><small>Please enter a name</small><?php endif ?></label>
                                        <input class="contactform-input" type="text" id="contactform-name" name="name" value="<?php echo $form->htmlValue('name') ?>" />
                                      </div>

                                      <div class="contactform-field<?php if($form->isError('email')) echo ' error' ?>">
                                        <label class="contactform-label" for="contactform-email">Email Address <?php if($form->isRequired('email')) echo '*' ?> <?php if($form->isError('email')): ?><small>Please enter a valid email address</small><?php endif ?></label>
                                        <input class="contactform-input" type="text" id="contactform-email" name="email" value="<?php echo $form->htmlValue('email') ?>" />
                                      </div>

                                      <div class="contactform-field<?php if($form->isError('address')) echo ' error' ?>">
                                        <label class="contactform-label" for="contactform-text">Delivery Address <?php if($form->isRequired('address')) echo '*' ?> <?php if($form->isError('address')): ?><small>Please enter your delivery address</small><?php endif ?></label>
                                        <textarea class="contactform-input" name="address" id="contactform-text"><?php echo $form->htmlValue('address') ?></textarea>
                                      </div>

                                    <p class="contactform-help">All fields with * are required</p>

                                        <input class="addcart" type="submit" name="submit" value="Next" />

                                    </fieldset>

                                  </form>

                            </article>

                <?php else: ?>


                        <article>
                                
                                <div id="headnotes" class="cf">
                                    <h1>Shopping Cart</h1>
                                </div>

                                        <form method="post" action="https://www.paypal.com/cgi-bin/webscr">
                                            <input type="hidden" name="cmd" value="_cart">
                                            <input type="hidden" name="upload" value="1">
                                            <input type="hidden" name="business" value="<?php echo $site->email() ?>">
                                            <input type="hidden" name="currency_code" value="GBP">

                                            <div class="table">

                                                <div class="table_header row">
                                                    <div class="cell title"><h1>Preview</h1></div>
                                                    <div class="cell title"><h1>Title</h1></div>
                                                    <div class="cell"><h1>Quantity</h1></div>
                                                    <div class="cell"><h1>VAT</h1></div>
                                                    <div class="cell"><h1>Price</h1></div>
                                                </div> 

                                                    <?php $i=0; $count = 0; $total = 0; ?>
                                                    <?php foreach ($cart as $id => $quantity): ?>
                                                        <?php if ($product = $products->findByUID($id)): ?>
                                                            <?php $product = $product->first() ?>
                                                            <?php $i++; ?>
                                                            <?php $count += $quantity ?>

                                                                <div class="table_body row">

                                                                    <div class="cell">
                                                                        <a href="<?php echo $product->url() ?>">
                                                                            <?php if($product->hasImages()): ?>
                                                                                <img src="<?php echo $product->images()->first()->url() ?>" class="cart_image" />
                                                                            <?php else: ?>
                                                                                <img src="<?php echo $site->url() ?>/assets/images/placeholder.png" class="cart_image" /> 
                                                                            <?php endif ?>                                                                          
                                                                        </a>
                                                                    </div>

                                                                    <div class="cell title">
                                                                        <input type="hidden" name="item_name_<?php echo $i ?>" value="<?php echo $product->title() ?>" />
                                                                        <input type="hidden" name="amount_<?php echo $i ?>" value="<?php echo $product->price() ?>" />
                                                                        <?php echo kirbytext($product->title(), false) ?>
                                                                    </div>

                                                                        <div class="cell">
                                                                            <a href="<?php echo url('notes/cart') ?>?action=add&amp;id=<?php echo $product->uid() ?>"><img src="<?php echo $site->url() ?>/assets/images/plus.png" class="icons" /></a>
                                                                            <?php if($quantity == 1){?>
                                                                                <span><img src="<?php echo $site->url() ?>/assets/images/minus_grey.png" class="icons" /></span>
                                                                            <?php }else{ ?>
                                                                                <a href="<?php echo url('notes/cart') ?>?action=remove&amp;id=<?php echo $product->uid() ?>"><img src="<?php echo $site->url() ?>/assets/images/minus.png" class="icons" /></a>
                                                                            <?php } ?>
                                                                            <a href="<?php echo url('notes/cart') ?>?action=delete&amp;id=<?php echo $product->uid() ?>"><img src="<?php echo $site->url() ?>/assets/images/cross.png" class="icons" /></a>
                                                                        </div>

                                                                    <div class="cell">
                                                                        VAT AMOUNT
                                                                    </div>

                                                                    <div class="cell">
                                                                        <?php $prodtotal = floatval($product->price()->value)*$quantity ?>
                                                                         €<?php printf('%0.2f', $prodtotal) ?>
                                                                    </div>

                                                                </div> 

                                                            <?php $total += $prodtotal ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>

                                                <div class="table_footer row">
                                                    <div class="cell"></div>
                                                    <div class="cell"></div>
                                                    <div class="cell"></div>
                                                    <div class="cell">
                                                        <ul>
                                                            <li>Subtotal</li>
                                                            <?php $postage = cart_postage($total) ?>
                                                            <li>+ VAT</li>
                                                            <li>Postage</li>
                                                            <li>Total</li>
                                                        </ul>
                                                    </div>
                                                    <div class="cell">
                                                        <ul>
                                                            <li>€<?php printf('%0.2f', $total) ?></li>
                                                            <?php $totalizer = cart_vat($prodtotal, (string)$page->vat())?>
                                                            <li>€<?php printf('%0.2f', $totalizer) ?></li>
                                                            <?php $postage = cart_postage($total) ?>
                                                            <li>€<?php printf('%0.2f', $postage) ?></li>
                                                            <li>€<?php printf('%0.2f', $total+$postage+$totalizer) ?></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>    

                                    <div class="purchase">

                                        <a href="<?php echo $page->url() ?>/checkout:step1" class="addcart">Next</a>

                                    </div>
                                                
                                </form>

                        </article>

                <?php endif ?>

        </section>

<?php snippet('footer') ?>