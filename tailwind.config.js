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

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        retro: ['"IBM Plex Mono"', 'monospace'],
      },
    },
  },
  plugins: [],
};

