// https://eslint.org/docs/user-guide/configuring

module.exports = {
  root: true,
  parserOptions: {
    parser: 'babel-eslint'
  },
  env: {
    browser: true,
    node: true,
    es6: true,
  },
  // https://github.com/vuejs/eslint-plugin-vue#priority-a-essential-error-prevention
  // consider switching to `plugin:vue/strongly-recommended` or `plugin:vue/recommended` for stricter rules.
  extends: ["plugin:vue/recommended", 'airbnb-base'],
  // required to lint *.vue files
  plugins: [
    'vue',
    'eslint-plugin',
  ],
  // settings: {
  //   'import/resolver': {
  //     [path.resolve(__dirname, '../')]
  //   },
  // },
  // add your custom rules here
  rules: {
    'no-param-reassign': ['error', {
      props: true,
      ignorePropertyModificationsFor: [
        'state', // for vuex state
        'acc', // for reduce accumulators
        'e' // for e.returnvalue
      ]
    }],
    'import/no-extraneous-dependencies': ['error', {
      optionalDependencies: ['test/unit/index.js']
    }],
    "arrow-body-style": [
      "warn",
      "as-needed"
    ],
    "comma-dangle": [
      "warn", {
        "arrays": "always-multiline",
        "imports": "always-multiline",
        "objects": "always-multiline",
        "functions": "only-multiline"
      }
    ],
    "no-template-curly-in-string": "warn",
    "object-curly-newline": "off",
    "no-param-reassign": ["warn", { "props": false }],
    "dot-notation": "warn",
    "function-paren-newline": "off",
    "generator-star-spacing": "off",
    "global-require": "off",
    'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off',
    'arrow-parens': 0,
    'generator-star-spacing': 0,
    "import/no-dynamic-require": "off",
    "import/no-extraneous-dependencies": ["error", { "devDependencies": true }],
    "import/no-unresolved": "off",
    "import/no-webpack-loader-syntax": "off",
    "import/no-named-as-default": "off",
    "import/prefer-default-export": "off",
  }
}
