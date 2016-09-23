OsBundle
=============
[![Build Status](https://travis-ci.org/ComuneFI/OsBundle.svg?branch=master)]
(https://travis-ci.org/ComuneFI/OsBundle) [![Coverage Status](https://img.shields.io/coveralls/ComuneFI/OsBundle.svg)] 
(https://coveralls.io/r/ComuneFI/OsBundle)

Installazione:
-------------

- Aggiungere nel file composer.json (root del progetto) nella sezione:
```
    {
    "name": "ComuneFI/NomeProgetto",
        "license": "MIT",
        "type": "project",
        "description": "The \"Symfony Standard Edition\" distribution",

    "autoload": {
            "psr-4" : {
                "Fi\\OsBundle\\": "vendor/fi/osbundle/"
            }
        },
    }    
```
- E sempre nel composer.json, nella sezione require aggiungere:
```
    "fi/osbundle": "2.0.*",
```
