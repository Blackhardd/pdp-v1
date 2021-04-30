<div class="gift-card-form">
    <form id="gift-card-form" class="form">
        <div class="backdrop"><div class="loader"><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div>

        <div class="form__row">
            <div class="form__col_half">
                <div class="inputWrap inputWrap_iconed">
                    <div class="inputWrap__input">
                        <div class="inputWrap__icon">
                            <svg width="14" height="14" fill="none">
                                <path d="M10.8 9.4C9.1 8.7 8.5 9 8.5 7.9v-.2h2.7c.4-.3-1-.8-1-4.5C10.2 1.3 9 0 7.1 0H7h-.1C5 0 3.8 1.3 3.8 3.2c0 3.7-1.4 4.2-1 4.5h2.6v.2c0 1.2-.5.8-2.2 1.5C1.4 10 .9 10.7.9 11V14h12.2v-2.9c0-.4-.5-1-2.3-1.7z" fill="#000"/>
                            </svg>
                        </div>
                        <input type="text" name="name" class="input input_text" placeholder="<?=__( 'Как к вам обращаться?', 'pdp' ); ?>" data-parsley-length="[3, 24]" required>
                    </div>
                    <div class="inputWrap__errors"></div>
                </div>
            </div>

            <div class="form__col_half">
                <div class="inputWrap inputWrap_iconed">
                    <div class="inputWrap__input">
                        <div class="inputWrap__icon">
                            <svg width="14" height="14" fill="none">
                                <path d="M13.7 11L11.5 9c-.4-.4-1.1-.4-1.6 0L9 10l-.3-.1C8 9.5 7 9 6 8 5 7 4.5 6 4.1 5.4L4 5.2l.7-.8.4-.3c.4-.5.4-1.2 0-1.6L3 .3C2.5 0 1.8 0 1.4.3L.8 1A3.5 3.5 0 000 2.8c-.2 2.3.8 4.5 3.8 7.4 4 4 7.3 3.8 7.4 3.8a3.7 3.7 0 001.8-.8l.7-.5c.4-.5.4-1.2 0-1.6z" fill="#000"/>
                            </svg>
                        </div>
                        <input type="tel" name="phone" class="input input_tel" placeholder="<?=__( 'Номер телефона', 'pdp' ); ?>" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" required>
                    </div>
                    <div class="inputWrap__errors"></div>
                </div>
            </div>
        </div>

        <div class="form__row">
            <div class="form__col_half">
                <div class="inputWrap inputWrap_iconed">
                    <div class="inputWrap__input">
                        <div class="inputWrap__icon">
                            <svg width="14" height="12" fill="none"><path d="M1.34 3.9A361.82 361.82 0 005 6.42a36.7 36.7 0 01.76.53c.1.08.24.17.4.26.16.1.31.16.45.21.14.05.27.07.4.07s.26-.02.4-.07.29-.12.45-.21A8.25 8.25 0 009 6.43l3.65-2.54c.38-.26.7-.59.96-.96.25-.38.38-.77.38-1.18 0-.34-.12-.64-.37-.88a1.2 1.2 0 00-.88-.37H1.25C.85.5.54.64.32.9.11 1.19 0 1.53 0 1.93c0 .33.14.69.43 1.07.29.38.6.68.91.9z" fill="#000"/><path d="M13.22 4.73a162.38 162.38 0 00-4.61 3.2c-.19.13-.44.25-.74.38-.31.13-.6.19-.86.19H7c-.27 0-.56-.06-.87-.2-.3-.12-.55-.24-.74-.37l-.72-.5c-.7-.52-2-1.42-3.88-2.7-.3-.2-.56-.43-.79-.68v6.2c0 .34.12.64.37.88.24.25.54.37.88.37h11.5c.34 0 .64-.12.88-.37.25-.24.37-.54.37-.88v-6.2a4.3 4.3 0 01-.78.68z" fill="#000"/></svg>
                        </div>
                        <input type="email" name="email" class="input input_tel" placeholder="<?=__( 'Электронная почта', 'pdp' ); ?>" />
                    </div>
                    <div class="inputWrap__errors"></div>
                </div>
            </div>

            <div class="form__col_half">
                <div class="inputWrap">
                    <div class="inputWrap__input">
                        <select name="card" class="selectric selectric_pdp iconed iconed_service">
                            <option value=""><?=__( 'Выберите сертификат', 'pdp' ); ?></option>
                            <option value="500"><?php printf( __( 'Номиналом %s грн.', 'pdp' ), '500' ); ?></option>
                            <option value="1000"><?php printf( __( 'Номиналом %s грн.', 'pdp' ), '1 000' ); ?></option>
                            <option value="3000"><?php printf( __( 'Номиналом %s грн.', 'pdp' ), '3 000' ); ?></option>
                            <option value="5000"><?php printf( __( 'Номиналом %s грн.', 'pdp' ), '5 000' ); ?></option>
                            <option value="10000"><?php printf( __( 'Номиналом %s грн.', 'pdp' ), '10 000' ); ?></option>
                        </select>
                    </div>
                    <div class="inputWrap__errors"></div>
                </div>
            </div>
        </div>

        <div class="form__response"></div>

        <div class="form__submit">
            <input type="submit" class="btn-default" value="<?=__( 'Заказать', 'pdp' ); ?>">
        </div>

        <input type="hidden" name="action" value="gift_card_order">
	    <?php wp_nonce_field( 'pdp_gift_card_order_nonce', 'pdp_nonce' ); ?>
	    <?php pdp_utm_fields(); ?>
    </form>
</div>