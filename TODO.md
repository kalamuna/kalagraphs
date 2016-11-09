# Things to do on the Kalamuna Components project
Convert this list to GitHub issues.

## Paragraphs Preview view mode
-   Make "Component Type" bold, append a colon, and float it left, so that it
    looks like a field label for the "Administrative label" field.

## Component Type display
-   Apply an image style to "Component Type" icons instead of hard-coding size.
-   Other style enhancements?

## Code
-   MAJOR: Delete "field_component_type" and replace it with a custom form
    element to actuate the conditional visibility states, as you can't change
    the "allowed values" list of a "list" field once it has data.
-   Pass form values into _kalacomponents_set_allowed_values() from
    kalaponents_fields_form_submit() to fix PHP notice.
-   When I move the theme implementation to an external file and
    specify its path in `hook_theme()`, it only gets included on initial page
    load after cache clear and not on subsequent page loads.
-   Move form callbacks to admin.inc or equivalent
-   Organize functions into groups or external files included by info file.
