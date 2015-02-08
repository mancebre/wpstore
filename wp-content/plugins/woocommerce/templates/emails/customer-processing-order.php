
<?php echo $order->email_order_items_table( $order->is_download_permitted(), true, $order->has_status( 'processing' ) ); ?>