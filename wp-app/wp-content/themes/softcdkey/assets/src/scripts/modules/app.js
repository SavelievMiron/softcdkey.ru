class App {
	constructor() {
		this.el = document.querySelector( '.el' );

		this.listeners();
		this.init();
	}

	init() {
		// eslint-disable-next-line no-console
		console.info( 'App Initialized' );
	}

	listeners() {
		if ( this.el ) {
			this.el.addEventListener( 'click', this.elClick );
		}

		const inputs = document.querySelectorAll("input, select, textarea");
		inputs.forEach(input => {
			input.addEventListener(
				"invalid",
				event => {
					input.classList.add("error");
				},
				false
			);
		});
	}

	elClick( e ) {
		e.target.classList.add( 'text-light-grey' );
		e.target.addEventListener( 'transitionend', ( event ) =>
			'color' === event.propertyName
				? event.target.classList.remove( 'text-light-grey' )
				: ''
		);
	}
}

export default App;
