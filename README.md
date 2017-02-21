# Kalaponents (Kalamuna Components)

Kalaponents aims is to make components cheap and easy to create and manage.
Components to the masses! No longer dost thou need to be a badass PHP developer
with Features fairy dust just to get your components on the page. Let the
component names be specific and let the markup do its thing, all without needing
to create a ba-jillion Paragraph types!

In practice, Kalaponents facilitates rapid development of components from
styleguide/prototype (e.g.,
[kalastatic](https://github.com/kalamuna/kalastatic),
[kss](http://warpspire.com/kss/), [Pattern Lab](http://patternlab.io/)) to
implementation ([Drupals](https://www.drupal.org/) via
[Paragraphs](https://www.drupal.org/project/paragraphs)).

## Benefits

1.  Decrease development time/effort to wire new components to the CMS (don't
    need new Paragraph types for each one)

1.  Improve the editorial UX by decluttering the edit form (fewer Paragraph
    types) and adding logos/icons to help editors identify each type

1.  Make it possible to switch between component types without data loss /
    having to re-input the field data

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
