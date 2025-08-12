/*
 * Project: Retro AXD (Laravel 12)
 * Copyright (c) 2025 Dimitris Kanatas
 * Contact: labschool@sch.gr | https://labschool.gr | https://labschool.mysch.gr
 *
 * License: Non-Commercial, Attribution Required.
 * Non-commercial use only with attribution to the original author.
 * Commercial use is prohibited without prior written permission.
 * See LICENSE for full terms.
 */

import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    base: '/retro-axd/',
    build: {
        assetsDir: 'assets',
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
})
