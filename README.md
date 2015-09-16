#Knowledge Base Bundle

Symfony Bundle built on top of LIN3S Knowledge Base.

##Installation

Make sure you have composer installed in your computer.

Install the component launching the following composer command

    composer require lin3s/knowledge-base-bundle
    
Install a theme for your knowledge base. We use the following at LIN3S:
 
    composer require lin3s/knowledge-base-gfm-template
    
Add the docs in markdown format to a folder that you will later add to the config. By default this bundle will
read the docs from the `docs` folder located in your project root path.

Add the bundle to the `AppKernel.php`:

    $bundles = array(
        ...
        
        new LIN3S\KnowledgeBaseBundle\LIN3SKnowledgeBaseBundle()
    );
    
Import required routes in your `app/config/routing.yml` file:

    lin3s_knowledge_base:
        resource: "@LIN3SKnowledgeBaseBundle/Resources/config/routing.yml"
    
##Configuration reference

The following options are available to add in your `config.yml`

    lin3_s_knowledge_base:
        #Required
        template: LIN3S\KnowledgeBaseGFMTemplate\Template #Fully qualified namespace of the class extending TemplateInterface
        
        #Optional (Default values shown)
        docs_path: %kernel.root_dir%/../docs/ #Path where the docs are located
        build_path: %kernel.cache_dir%/lin3s_knowledge_base/ #Path to the cache
        assets_base_url: /templates #Url from where the template will fetch the assets

##Generating the docs

Make sure you have properly added your docs folder and configured the `docs_path` in `config.yml`

    $ php app/console lin3s:kb:docs:load
    
##Symlinking the assets

The following command will dump the assets required by the template to the web folder

    $ php app/console lin3s:kb:assets:install

##How it works internally

For further technical and theming details check KnowledgeBase documentation.
