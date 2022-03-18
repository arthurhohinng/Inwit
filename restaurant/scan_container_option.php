<li class="dokan-hide">
                                    <form id="dokan-order-status-form" style="display: flex; flex-direction:column;" action="" method="post">

                                            <?php
                                            foreach ( $statuses as $status => $label ) {
                                                echo '<button type="button" style="margin: 5px 0;" onfocus="this.classList.toggle(\'dokan-btn-default\');" class="dokan-btn dokan-btn-success" value="' . esc_attr( $status ) . '" ' . selected( $status, 'wc-' . dokan_get_prop( $order, 'status' ), false ) . '>' . esc_html__( $label, 'dokan-lite' ) . '</button>';
                                            }
                                            ?>

                                        <input type="hidden" name="order_id" value="<?php echo esc_attr( dokan_get_prop( $order, 'id' ) ); ?>">
                                        <input type="hidden" name="action" value="dokan_change_status">
                                        <input type="hidden" name="_wpnonce" value="<?php echo esc_attr( wp_create_nonce( 'dokan_change_status' ) ); ?>">
                                        <input type="submit" class="dokan-btn dokan-btn-success dokan-btn-sm" style="background-color: blue;" name="dokan_change_status" value="<?php esc_attr_e( 'Update', 'dokan-lite' ); ?>">

                                        <a href="#" class="dokan-btn dokan-btn-default dokan-btn-sm dokan-cancel-status"><?php esc_html_e( 'Cancel', 'dokan-lite' ) ?></a>
                                    </form>
                                </li>
                            <?php endif ?>
                            <li>
                                <button type="button" style="margin: 5px 0;" onfocus="this.classList.toggle(\'dokan-btn-default\');" class="dokan-btn dokan-btn-success">Scan Container</button>
                            </li>