module.exports = {
	env: {
		node: true,
		browser: true,
		es6: true
	},
	extends: [
		'plugin:@wordpress/eslint-plugin/recommended',
		'plugin:compat/recommended',
	],
	parserOptions: {
		'sourceType': 'module'
	},
	rules: {
		'complexity': [
			'warn',
			{
				'max': 4
			}
		],
		'max-lines-per-function': [
			'error',
			{
				'max': 50,
				'skipBlankLines': true,
				'skipComments': true
			}
		],
		'max-depth': [
			'error',
			2
		]
	}
};
