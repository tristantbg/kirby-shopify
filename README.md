# Kirby Pluginkit: Example plugin for Kirby

> Variant "Setup with Composer dependencies"

This is a boilerplate for a Kirby plugin that can be installed via all three [supported installation methods](https://getkirby.com/docs/guide/plugins/plugin-setup-basic#the-three-plugin-installation-methods).

You can find a list of Pluginkit variants on the [`master` branch](https://github.com/getkirby/pluginkit/tree/master).

****

## How to use the Pluginkit

1. Fork this repository
2. Change the plugin name and description in the `composer.json`
3. Change the plugin name in the `index.php`
4. Change the license if you don't want to publish under MIT
5. Add your plugin code to the `index.php` and the `src` directory
6. Require Composer dependencies with `composer require`
7. Update this `README` with instructions for your plugin

We have a tutorial on how to build your own plugin based on the Pluginkit [in the Kirby documentation](https://getkirby.com/docs/guide/plugins/plugin-setup-composer).

What follows is an example README for your plugin.

****

## Installation

### Download

Download and copy this repository to `/site/plugins/{{ plugin-name }}`.

### Git submodule

```
git submodule add https://github.com/{{ your-name }}/{{ plugin-name }}.git site/plugins/{{ plugin-name }}
```

### Composer

```
composer require {{ your-name }}/{{ plugin-name }}
```

## Setup

*Additional instructions on how to configure the plugin (e.g. blueprint setup, config options, etc.)*

## Options

*Document the options and APIs that this plugin offers*

## Development

*Add instructions on how to help working on the plugin (e.g. npm setup, Composer dev dependencies, etc.)*

## License

MIT

## Credits

- [Your Name](https://github.com/ghost)
