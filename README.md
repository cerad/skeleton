Attempt to formalize a feature based Symfony application layout.

Also uses php for application level configuration.

It really was not necessary but adjusted Kernel.php to only load services.php and routes.php.
Need to keep an eye on Kernel.php as Symfony gets updated.  

Moved the twig default template directory to Shared/templates
The base class is for bootstrap 5 without any of the web pack stuff
Any feature directory that uses templates needs to be added to twig.yaml

TODO
Make service config classes per feature
Make route config classes per feature

Doctrine mapping

