# php-boilerplate

## Description
A lean, mean MVC machine with routing. It uses Twig for Views, Sass for CSS and Typescript for JS.

Gulp tasks are used to translate and compile SASS and Typescript and to watch for changes to Twig views and delete the cache files. Development and production modes are included.

### Gulp Tasks
- sass - Preprocess and optionally minimize scss files the public folder.
- js - Concat and optionally minify required js files to the public folder.
- ts - Compile typescript files to JS.
- clear - Clear the Twig cache.
- statics - Copy source files to the public folder.
- watches - Watch for changes in source files and run the relevant tasks.
- checks - Optional CSS and JS linting.
