<li>
                                <span><?php esc_html_e( 'Order Status:', 'dokan-lite' ); ?></span>
                                <label class="dokan-label dokan-label-<?php echo esc_attr( dokan_get_order_status_class( dokan_get_prop( $order, 'status' ) ) ); ?>"><?php echo esc_html( dokan_get_order_status_translated( dokan_get_prop( $order, 'status' ) ) ); ?></label>

                                <?php if ( current_user_can( 'dokan_manage_order' ) && dokan_get_option( 'order_status_change', 'dokan_selling', 'on' ) == 'on' && $order->get_status() !== 'cancelled' && $order->get_status() !== 'refunded' ) {?>
                                <?php } ?>
                            </li>
                            <?php if ( current_user_can( 'dokan_manage_order' ) && dokan_get_option( 'order_status_change', 'dokan_selling', 'on' ) == 'on' && $order->get_status() !== 'cancelled' && $order->get_status() !== 'refunded' ): ?>
                                    <form id="dokan-order-status-form" style="display: flex; flex-direction:column;" action="" method="post">

                                            <?php
                                            $counter = 0;
                                            $prefix = "status_";
                                            foreach ( $statuses as $status => $label ) {
                                                $counter++;
                                                echo '<button style="margin: 5px 0;" onfocus="this.classList.toggle(\'dokan-btn-default\');" class="dokan-btn dokan-btn-success" value="' . esc_attr( $status ) . '" ' . selected( $status, 'wc-' . dokan_get_prop( $order, 'status' ), false ) . '>' . esc_html__( $label, 'dokan-lite' ) . '</button>';
                                            }
                                            ?>

                                        <input type="hidden" name="order_id" value="<?php echo esc_attr( dokan_get_prop( $order, 'id' ) ); ?>">
                                        <input type="hidden" name="action" value="dokan_change_status">
                                        <input type="hidden" name="_wpnonce" value="<?php echo esc_attr( wp_create_nonce( 'dokan_change_status' ) ); ?>">

                                    </form>
                            <?php endif ?>