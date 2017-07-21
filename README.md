# Kalagraphs (Kalamuna Paragraphs)

Kalagraphs aims to empower front-end developers with the tools to maintain a warchest of components available to [Drupal](https://www.drupal.org/) site editors. It accomplishes this by making components cheap and easy to create and manage. No longer must you have badass [PHP](http://php.net/) developer skills with intimate knowledge of [Features module](https://www.drupal.org/project/features) voodoo just to get your components on a CMS page. Let the component names be specific and let the markup do its thing, all without needing to create an unmanagable number of [Paragraph](https://www.drupal.org/project/paragraphs) types!

In practice, Kalagraphs facilitates rapid development of components from a styleguide (e.g., [kalastatic](https://github.com/kalamuna/kalastatic), [kss](http://warpspire.com/kss/), or [Pattern Lab](http://patternlab.io/)) to implementation (Drupal via Paragraphs).

## Table of Contents

* [Rationale](#rationale)
  * [Benefits](#benefits)
  * [Life without Kalagraphs](#life-without-kalagraphs)
  * [Contra-indications](#contra-indications)
* [Usage](#usage)
  * [Getting Started](#getting-started)
  * [Field Formatting](#field-formatting)

## Rationale

### Benefits

1.  Decrease the development time and effort required to "CMSify" new components (make them available in Drupal) by removing the need for creation of new Paragraph types.

1.  Improve the editorial UX by decluttering the edit form (fewer Paragraph types) and adding logos/icons to help editors identify each type (planned).

1.  Make it possible to switch between component types without data loss / having to re-input the field data.

### Life without Kalagraphs

1.  Probably okay but potentially miserable.

1.  Necessitates availability of backend development resources with intricate knowledge of the Drupal 8 theming layer.

### Contra-indications

Don't attempt to shoehorn Kalagraphs onto very complex components; just create a new, custom Paragraphs bundle to fit the data model. One great thing about this module: Kalagraphs doesn't interfere with a standard Paragraphs workflow, so developers who wish to may continue using their familiar tools without any trouble. Furthermore, they can even leverage some of Kalagraphs utility functions with the other Paragraph bundles or with entirely different entity types.

For example, it's often necessary to output node teasers as components on a page, in lists or otherwise. By adjusting the teaser view mode's field display formatters to use the Kalagraphs versions, developers may leverage the same field processing magic that informs template variables on all the Kalagraphs-enabled components.

## Usage

### Getting Started

1.  Install the module (@todo Add link to Drupal documentation on installing modules).
1.  @todo Fill in more steps here.

### Field Formatting

To render individual fields with various atom components, manually create theme hooks for each of the Twig files. Then, extend each of the the Kalagraphs field formatters in `src/Plugin/Field/FieldFormatters` and override `viewValue()` to assign the appropriate theme hook to the `$value` render array. More documentation and links forthcoming to this section.
