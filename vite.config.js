import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/styles.css',
                'resources/js/app.js',
                'resources/js/sidebar.js',
                'resources/js/dashboard.js',
                'resources/js/general_ledger/ledger_accounts.js',
                'resources/js/general_ledger/journals.js',
                'resources/js/general_ledger/journal_entry_details.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '$': 'jquery',
            'jQuery': 'jquery',
        }
    }
});
