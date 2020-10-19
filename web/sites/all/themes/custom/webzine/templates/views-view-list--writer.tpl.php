<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 *
 * @ingroup views_templates
 */
?>
<dl class="pGroup">
    <dt><?php print $title; ?></dt>
    <dd>
        <?php print $list_type_prefix; ?>
        <?php foreach ($rows as $id => $row): ?>
            <li class="<?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
        <?php endforeach; ?>
        <?php print $list_type_suffix; ?>
    </dd>
</dl>