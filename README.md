# Kalaponents (Kalamuna Components)

Kalaponents aims is to make components cheap and easy to create and manage.
Components to the masses! No longer dost thou need to be a badass PHP developer
with Feeatures fairy dust just to get your components on the page. Let the
component names be specific and let the markup do its thing, all without needing
to create a ba-jillion Paragraph types!

In practice, Kalaponents facilitates rapid development of components from
[kalastatic](https://github.com/kalamuna/kalastatic) (styleguide/prototype) to
implementation ([Drupals](https://www.drupal.org/) via
[Paragraphs](https://www.drupal.org/project/paragraphs)).

## Nomenclature
The following terms are used in code comments and as variable names and deserve
some explanation.

-   **Parent**: Name or info array of a ["multiple"
    type](https://www.drupalcontrib.org/api/drupal/contributions%21variable%21variable.variable.inc/function/variable_variable_type_info/7)
    variable (instances per component type).
-   **Child**: Name or info array of _one instance_ of a "multiple" type
    variable.
-   **Composite**: Array of all the _children values_ for a "multiple" type
    variable, keyed by component type.
