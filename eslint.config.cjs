const js = require('@eslint/js');
const prettier = require('eslint-config-prettier');

/** @type {import('eslint').Linter.Config[]} */
module.exports = [
    js.configs.recommended,
    {
        languageOptions: {
            parser: require('@typescript-eslint/parser'),
            parserOptions: {
                ecmaVersion: 'latest',
                sourceType: 'module',
                ecmaFeatures: {
                    jsx: true,
                },
            },
            globals: {
                window: 'readonly',
                document: 'readonly',
                setTimeout: 'readonly',
                clearTimeout: 'readonly',
                console: 'readonly',
                module: 'readonly',
                define: 'readonly',
                self: 'readonly',
                Ziggy: 'readonly',
            },
        },
        plugins: {
            '@typescript-eslint': require('@typescript-eslint/eslint-plugin'),
        },
        rules: {
            'no-unused-vars': ['error', { argsIgnorePattern: '^_' }],
            '@typescript-eslint/no-unused-vars': ['error', { argsIgnorePattern: '^_' }],
            'no-prototype-builtins': 'off',
        },
    },
    {
        ignores: ['public/build/**', 'vendor/**'],
    },
    prettier,
];
