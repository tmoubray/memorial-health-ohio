<!-- {{  Plan info. -->
<?php
/**
 * Listing information plan metabox
 *
 * @package Admin Templates/listing information plan
 */

echo wp_nonce_field( 'update listing plan', 'wpbdp-admin-listing-plan-nonce', false, false );
?>
<div id="wpbdp-listing-metabox-plan-info" class="wpbdp-listing-metabox-tab wpbdp-admin-tab-content" tabindex="1">
    <h4><?php _ex( 'General Info', 'listing metabox', 'business-directory-plugin' ); ?></h4>
    <dl>
        <dt><?php _ex( 'Listing Status', 'listing metabox', 'business-directory-plugin' ); ?></dt>
        <dd>
        <?php
        $status = apply_filters( 'wpbdp_admin_listing_display_status', array( $listing->get_status(), $listing->get_status_label() ), $listing );
        ?>
        <?php if ( 'incomplete' == $status[0] ) : ?>
            <?php _ex( 'N/A', 'listing metabox', 'business-directory-plugin' ); ?>
        <?php else : ?>
			<span class="tag plan-status paymentstatus <?php echo esc_attr( $status[0] ); ?>">
				<?php echo esc_html( $status[1] ); ?>
			</span>
        <?php endif; ?>
        </dd>
        <dt><?php _ex( 'Last renew date', 'listing metabox', 'business-directory-plugin' ); ?></dt>
        <?php if ( $renewal_date = $listing->get_renewal_date() ) : ?>
        <dd><?php echo esc_html( $renewal_date ); ?></dd>
        <?php else : ?>
        <dd><?php _ex( 'N/A', 'listing metabox', 'business-directory-plugin' ); ?></dd>
        <?php endif; ?>
    </dl>

    <h4><?php _ex( 'Plan Details', 'listing metabox', 'business-directory-plugin' ); ?></h4>
    <dl>
		<dt><?php esc_html_e( 'Plan', 'business-directory-plugin' ); ?></dt>
        <dd>
            <span class="display-value" id="wpbdp-listing-plan-prop-label">
				<?php if ( $current_plan ) : ?>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=wpbdp-admin-fees&wpbdp-view=edit-fee&id=' . $current_plan->fee_id ) ); ?>"><?php echo esc_html( $current_plan->fee_label ); ?></a>
				<?php else : ?>
                    -
                <?php endif; ?>
            </span>
            <a href="#" class="edit-value-toggle"><?php _ex( 'Change plan', 'listing metabox', 'business-directory-plugin' ); ?></a>
            <div class="value-editor">
				<input type="hidden" name="listing_plan[fee_id]" value="<?php echo esc_attr( $current_plan ? $current_plan->fee_id : '' ); ?>" />
                <select name="" id="wpbdp-listing-plan-select">
                <?php foreach ( $plans as $p ) : ?>
                    <?php
                    $plan_info = array(
                        'id'              => $p->id,
                        'label'           => $p->label,
                        'amount'          => $p->amount ? wpbdp_currency_format( $p->amount ) : '',
                        'days'            => $p->days,
                        'images'          => $p->images,
                        'sticky'          => $p->sticky,
                        'recurring'       => $p->recurring,
                        'expiration_date' => $p->calculate_expiration_time( $listing->get_expiration_time() ),
                    );
                    ?>
					<option value="<?php echo esc_attr( $p->id ); ?>" <?php selected( $p->id, $current_plan ? $current_plan->fee_id : 0 ); ?> data-plan-info="<?php echo esc_attr( json_encode( $plan_info ) ); ?>">
						<?php echo esc_html( $p->label ); ?>
					</option>
                <?php endforeach; ?>
                </select>

                <a href="#" class="update-value button"><?php _ex( 'OK', 'listing metabox', 'business-directory-plugin' ); ?></a>
                <a href="#" class="cancel-edit button-cancel"><?php _ex( 'Cancel', 'listing metabox', 'business-directory-plugin' ); ?></a>
        </div>
        </dd>
        <dt><?php esc_html_e( 'Amount', 'business-directory-plugin' ); ?></dt>
        <dd>
            <span class="display-value" id="wpbdp-listing-plan-prop-amount">
                <?php echo $current_plan ? wpbdp_currency_format( $current_plan->fee_price ) : '-'; ?>
            </span>
        </dd>
        <dt><?php _ex( 'Expires On', 'listing metabox', 'business-directory-plugin' ); ?></dt>
        <dd>
            <span class="display-value" id="wpbdp-listing-plan-prop-expiration">
                <?php echo ( $current_plan && $current_plan->expiration_date ) ? wpbdp_date_full_format( strtotime( $current_plan->expiration_date ) ) : ( $listing->get_fee_plan() ? 'Never' : '-' ); ?>
            </span>
			<?php if ( ! $listing->has_subscription() ) : ?>
				<a href="#" class="edit-value-toggle"><?php esc_html_e( 'Edit', 'business-directory-plugin' ); ?></a>
			<?php endif; ?>
            <div class="value-editor">
				<input type="text" name="listing_plan[expiration_date]" value="<?php echo esc_attr( ( $current_plan && $current_plan->expiration_date ) ? $current_plan->expiration_date : '' ); ?>" placeholder="<?php esc_attr_e( 'Never', 'business-directory-plugin' ); ?>" />
				<?php if ( ! $listing->has_subscription() ) : ?>
                <p>
                    <a href="#" class="update-value button"><?php _ex( 'OK', 'listing metabox', 'business-directory-plugin' ); ?></a>
                    <a href="#" class="cancel-edit button-cancel"><?php _ex( 'Cancel', 'listing metabox', 'business-directory-plugin' ); ?></a>
                </p>
				<?php endif; ?>
            </div>
        </dd>
        <dt><?php _ex( '# of images', 'listing metabox', 'business-directory-plugin' ); ?></dt>
        <dd>
            <span class="display-value" id="wpbdp-listing-plan-prop-images">
                <?php echo $current_plan ? $current_plan->fee_images : '-'; ?>
            </span>
			<a href="#" class="edit-value-toggle"><?php esc_html_e( 'Edit', 'business-directory-plugin' ); ?></a>
            <div class="value-editor">
                <input type="text" name="listing_plan[fee_images]" value="<?php echo $current_plan ? $current_plan->fee_images : 0; ?>" size="2" />

                <a href="#" class="update-value button"><?php _ex( 'OK', 'listing metabox', 'business-directory-plugin' ); ?></a>
                <a href="#" class="cancel-edit button-cancel"><?php _ex( 'Cancel', 'listing metabox', 'business-directory-plugin' ); ?></a>
            </div>
        </dd>
        <dt><?php _ex( 'Is Featured?', 'listing metabox', 'business-directory-plugin' ); ?></dt>
        <dd>
            <span class="display-value" id="wpbdp-listing-plan-prop-is_sticky">
                <?php echo esc_html( $current_plan && $current_plan->is_sticky ? __( 'Yes', 'business-directory-plugin' ) : __( 'No', 'business-directory-plugin' ) ); ?>
            </span>
<!-- Removed the ability to set a listing as "Featured" in "info" metabox for 5.1.6 according to instructions on issue #3413 -->
        </dd>
        <dt><?php _ex( 'Is Recurring?', 'listing metabox', 'business-directory-plugin' ); ?></dt>
        <dd>
            <span class="display-value" id="wpbdp-listing-plan-prop-is_recurring">
                <?php echo esc_html( $current_plan && $current_plan->is_recurring ? __( 'Yes', 'business-directory-plugin' ) : __( 'No', 'business-directory-plugin' ) ); ?>
            </span>
        </dd>
    </dl>

    <ul class="wpbdp-listing-metabox-renewal-actions">
        <li>
            <a href="#" class="button button-small" onclick="window.prompt('<?php _ex( 'Renewal url (copy & paste)', 'admin infometabox', 'business-directory-plugin' ); ?>', '<?php echo esc_url_raw( $listing->get_renewal_url() ); ?>'); return false;"><?php _ex( 'Get renewal URL', 'admin infometabox', 'business-directory-plugin' ); ?></a>
            <a class="button button-small" href="
            <?php
            echo esc_url(
                add_query_arg(
                    array(
                        'wpbdmaction' => 'send-renewal-email',
                        'listing_id'  => $listing->get_id(),
                    ),
                    get_edit_post_link( $listing->get_id() )
                )
            );
            ?>
            ">
                <?php _ex( 'Send renewal e-mail', 'admin infometabox', 'business-directory-plugin' ); ?>
            </a>
        </li>
        <?php if ( 'pending_renewal' == $listing->get_status() || ( $current_plan && $current_plan->expired ) ) : ?>
        <li>
            <a href="<?php echo esc_url( add_query_arg( 'wpbdmaction', 'renewlisting' ), get_edit_post_link( $listing->get_id() ) ); ?>" class="button-primary button button-small"><?php _ex( 'Renew listing', 'admin infometabox', 'business-directory-plugin' ); ?></a>
        </li>
        <?php endif; ?>
    </ul>
</div>
<!-- }} -->