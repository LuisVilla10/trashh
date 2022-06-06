const hamMenuOptionTemplate = (label, action) => {
	return `
		<li class="f f-align-center bg-tran-d2" onclick="${action}()">${label}</li>
	`;
}

const hamMenuListTemplate = (options) => {
	return `
        <ul class="dropdown-panel font-light-gray font-18">
            ${
            	options.map(({label, action}) => {
            		return hamMenuOptionTemplate(label, action);
            	}).join("")
            }
        </ul>
	`;
}
