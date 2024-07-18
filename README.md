# App Store Redirect Plugin

## Description

The App Store Redirect plugin allows you to add shortcodes for automatically redirecting users to the appropriate app store based on their device (iOS or Android). It also provides shortcodes to display Apple App Store and Google Play Store badges.

## Shortcodes

`[auto_device_redirect]`

Automatically redirects users to the appropriate app store based on their device. If the device is neither iOS nor Android, it does nothing.

`[app_store_badge]`

Displays the Apple App Store badge.

- Attributes:
  - `size` (default: 'sml', options: 'sml', 'med', or 'lrg')
  - `apple_badge_color` (default: 'black', options: 'black', 'white')

`[google_play_badge]`

Displays the Google Play Store badge.

- Attributes:
  - `size` (default: 'sml', options: 'sml', 'med', or 'lrg')

`[both_badges]`

Displays both the Apple App Store and Google Play Store badges.

- Attributes:
  - `size` (default: 'sml', options: 'sml', 'med', or 'lrg')
  - `apple_badge_color` (default: 'black', options: 'black', 'white')

# Author

Zakary Loney

# Contributing

Make a pull request if you wan't but I don't plan on adding any new features.
