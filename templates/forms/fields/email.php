<div class="input input--email">
	<div class="input__errors"></div>
	<div class="input__wrap">
		<input type="email" name="email" placeholder="<?=__( 'Электронная почта', 'pdp' ); ?><?=( $args['required'] ) ? '*' : ''; ?>" <?=( $args['required'] ) ? 'required' : ''; ?>>
        <svg width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M1.34 3.9A361.82 361.82 0 005 6.42a36.7 36.7 0 01.76.53c.1.08.24.17.4.26.16.1.31.16.45.21.14.05.27.07.4.07s.26-.02.4-.07.29-.12.45-.21A8.25 8.25 0 009 6.43l3.65-2.54c.38-.26.7-.59.96-.96.25-.38.38-.77.38-1.18 0-.34-.12-.64-.37-.88a1.2 1.2 0 00-.88-.37H1.25C.85.5.54.64.32.9.11 1.19 0 1.53 0 1.93c0 .33.14.69.43 1.07.29.38.6.68.91.9z" /><path d="M13.22 4.73a162.38 162.38 0 00-4.61 3.2c-.19.13-.44.25-.74.38-.31.13-.6.19-.86.19H7c-.27 0-.56-.06-.87-.2-.3-.12-.55-.24-.74-.37l-.72-.5c-.7-.52-2-1.42-3.88-2.7-.3-.2-.56-.43-.79-.68v6.2c0 .34.12.64.37.88.24.25.54.37.88.37h11.5c.34 0 .64-.12.88-.37.25-.24.37-.54.37-.88v-6.2a4.3 4.3 0 01-.78.68z" /></svg>
	</div>
</div>