# onepageMD
### One page website template, with responsive display, content in Markdown, additionnals PHP generated values, translations, design configs, ...

## Goals
### As the website creator
- Be able **to create a one page website quickly** in a new repository.
- Write the general content inside Markdown files, including links and images. Markdown files can be local or remote, with automatic update activatable).
- Customizing of special values displayed at positions not usual in Markdown, with a config JSON file.
- Interpolate PHP generated values and generate them (to keep some information up-to-date).
- Write translations of the content in other files.
- Customizing the page appearance is important too: possibility to choose a stylesheet or write a new one, change content width, change font family and font sizes, import new fonts, ...
- Insert automatic table of contents generated in PHP.
- Export the dynamic website to a static site (that runs without PHP).

### As a visitor
- Be able to choose a language in the browser and save it (language stored in a cookie).
- Visit the website in different devices (responsive display is a must).
- Short time of page loading (the app should be light and fast).
- Use the table of content to read only the wanted information.

## Setup preview
At the start (only once):
1. [Create a new repos based on the repos template](https://github.com/KanFF/onepageMD/generate) (link only work when logged)
1. Clone the repos
1. Copy paste the `config.json` file to `localconfig.json`.
1. Write your first contents in markdown files: files are named like `content-en.md` (`en` is the language id, here it's english).
1. Start edit and fill the `localconfig.json` file. All the [configurations available are documented.](/CONFIGURATION.md). Choose app name, layout configs, content information (with content files path for each language), user settings, ...

### Advanced configurations:
1. Setup github webhooks to activate auto update of your markdown files (with a secret in the config file).

### Content production workflow
...
