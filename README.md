Less plugin for [Carew](http://github.com/carew/carew)
=============================================================

Installation
------------

Install it with composer:

```
composer require francisbesset/carew-less
```

Then configure `config.yml`

```
engine:
    extensions:
        - FrancisBesset\Carew\Less\LessExtension

less:
    input: bootstrap/bootstrap.less # find $theme/bootstrap/bootstrap.less
    output: css/main.css # write in $theme/assets/css/main.css
```
