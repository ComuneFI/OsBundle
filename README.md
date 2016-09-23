OsBundle
=============

Installazione:
-------------

- Aggiungere nel file composer.json (root del progetto) nella sezione:
```
    {
    "name": "symfony/framework-standard-edition",
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
- Aggiungere nel file app/AppKernel.php nella funzione registerBundles;
