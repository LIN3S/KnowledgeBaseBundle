#Knowledge Base Bundle
> Symfony Bundle built on top of [LIN3S Knowledge Base][1].

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d1ca762c-2705-4a10-bfc9-3fb91f592d8f/mini.png)](https://insight.sensiolabs.com/projects/d1ca762c-2705-4a10-bfc9-3fb91f592d8f)
[![Build Status](https://travis-ci.org/LIN3S/KnowledgeBaseBundle.svg?branch=master)](https://travis-ci.org/LIN3S/KnowledgeBaseBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LIN3S/KnowledgeBaseBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/LIN3S/KnowledgeBaseBundle/?branch=master)
[![Total Downloads](https://poser.pugx.org/lin3s/knowledge-base-bundle/downloads)](https://packagist.org/packages/lin3s/knowledge-base-bundle)
&nbsp;&nbsp;&nbsp;&nbsp;
[![Latest Stable Version](https://poser.pugx.org/lin3s/knowledge-base-bundle/v/stable.svg)](https://packagist.org/packages/lin3s/knowledge-base-bundle)
[![Latest Unstable Version](https://poser.pugx.org/lin3s/knowledge-base-bundle/v/unstable.svg)](https://packagist.org/packages/lin3s/knowledge-base-bundle)

##Installation
Make sure you have composer installed in your computer.

Install the component launching the following composer command
```shell
$ composer require lin3s/knowledge-base-bundle
```
Install a theme for your knowledge base. We use the following at LIN3S:
```shell
$ composer require lin3s/knowledge-base-gfm-template
```
Add the docs in markdown format to a folder that you will later add to the config. By default this bundle will
read the docs from the `docs` folder located in your project root path.

Add the bundle to the `AppKernel.php`:
```php
$bundles = [
    (...)
    new LIN3S\KnowledgeBaseBundle\LIN3SKnowledgeBaseBundle()
];
```

Import required routes in your `app/config/routing.yml` file:
```yaml
lin3s_knowledge_base:
    resource: "@LIN3SKnowledgeBaseBundle/Resources/config/routing.yml"
```

##Configuration reference
The following options are available to add in your `config.yml`
```yaml
lin3_s_knowledge_base:
    #### Required ####
    template: LIN3S\KnowledgeBaseGFMTemplate\Template       # Fully qualified namespace of the class extending TemplateInterface

    #### Optional (Default values shown) ####
    docs_path: %kernel.root_dir%/../docs/                   # Path where the docs are located
    build_path: %kernel.cache_dir%/lin3s_knowledge_base/    # Path to the cache
    assets_base_url: /templates                             # Url from where the template will fetch the assets
```

##Generating the docs
Make sure you have properly added your docs folder and configured the `docs_path` in `config.yml`
```shell
$ php app/console lin3s:kb:docs:load
```

##Symlinking the assets
The following command will dump the assets required by the template to the web folder
```shell
$ php app/console lin3s:kb:assets:install
```

##How it works internally
For further technical and theming details check [LIN3S Knowledge Base][1] documentation.

[1]: http://github.com/LIN3S/KnowledgeBase
